<?php
		require ("db_connect.php");
		
		/*
			THERE WILL BE STATUS FIELD IN THE STOCKTAKE TABLE AS AGREED
			it will hold three values: new, pending , confirmed 

		*/
if(isset($_GET['hint']) && ($_GET['hint']!=""))
    {
$hint =$_GET['hint'];
    $sql = "SELECT 	tblStockTakes.StockTakeId AS ST_ID, 
                            tblStockTakes.StockTakeStatus AS ST_STATUS,
                            tblStockTakes.CustomerStoreId AS S_ID,

                            tblCustomerStores.StoreName AS S_NAME,
                            tblCustomerStores.Address1 AS S_ADD, 
                            tblCustomerStores.Town AS S_TOWN,
                            tblCustomerStores.CountyId AS S_County

                    FROM    tblCustomerStores, tblStockTakes
                    WHERE   tblStockTakes.CustomerStoreId= tblCustomerStores.CustomerStoreId 
AND tblCustomerStores.StoreName LIKE '".$hint."%' order by tblCustomerStores.StoreName;"; 
} else {
		$sql = "SELECT 		tblStockTakes.StockTakeId AS ST_ID, 
                            tblStockTakes.StockTakeStatus AS ST_STATUS,
                            tblStockTakes.CustomerStoreId AS S_ID,

                            tblCustomerStores.StoreName AS S_NAME,
                            tblCustomerStores.Address1 AS S_ADD, 
                            tblCustomerStores.Town AS S_TOWN,
                            tblCustomerStores.CountyId AS S_County


                    FROM    tblCustomerStores, tblStockTakes
                    WHERE   tblStockTakes.CustomerStoreId= tblCustomerStores.CustomerStoreId 
order by tblCustomerStores.StoreName;";
}
		$result = mysqli_query($conn, $sql);

		$Region="";

		$Connacht = array(33, 34, 37, 53, 60);
		$Munster=	array(35, 38, 39, 46, 48, 55);
		$Leinster= 	array(36, 40,41,42,43,44, 47, 54,56,57,63,64);
		$Ulster= 	array(45, 49,50,51,52, 58,59,61,62);

		/*
		ACCOURDING TO YOUR DATABASE 
		ID FOR COUNTIES THAT ARE IN SAME REGION
		Connacht  33, 34, 37, 53, 60 
		Munster 35, 38, 39, 46, 48, 55
		Leinster 36, 40,41,42,43,44, 47, 54,56,57,63,64
		Ulster 45, 49,50,51,52, 58,59,61,62
		*/

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	if (in_array(($row["S_County"]), $Connacht)) $Region= "Connacht";
		    	if (in_array(($row["S_County"]), $Munster)) $Region= "Munster";
		    	if (in_array(($row["S_County"]), $Leinster)) $Region= "Leinster";
		    	if (in_array(($row["S_County"]), $Ulster)) $Region= "Ulster";

		        if($row["ST_STATUS"] == "New")
		        	echo'<label id="'. $row["ST_ID"].'" class="btn '.$row["ST_STATUS"].' '.$Region.'"
		        			 	draggable="true" ondragstart="drag(event)">

		        			<span onclick="openstocktake('. $row["ST_ID"].', this.parentNode.parentNode.id)">'
		        			 . $row["S_NAME"].', <br>'.$row["S_TOWN"].'
							</span>

							<span class="deleteX" onclick="DeleteStockTake('. $row["ST_ID"].')"> X </span>
		        		</label>';
		    }
		} else {
		    echo "0 results";
		}

		mysqli_close($conn);
?>