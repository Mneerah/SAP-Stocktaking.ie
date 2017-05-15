<?php


	$list=	json_decode(stripslashes($_GET['list']));

	$storeslist="<BR>";

	if(count($list)==0)
	{
		echo "<br> NO STORES TO DISPLAY <br><br>";
	}

	else
	{
		foreach($list as $d){		     

			require ("db_connect.php");
			$sql = "SELECT 	CustomerStoreId, CustomerId, StoreName, Address1, Town	
            		FROM    tblCustomerStores 
					WHERE CustomerId= $d;";
		    $result = mssql_query($conn, $sql); 
		    //if sql succeed
			if (mssql_num_rows($result) > 0) 
			{
				while($row = mssql_fetch_assoc($result)) 
				{
					$storeslist .=	'<p id="">
							<input type="checkbox" name="Stores[]"  
								value="'. $row["CustomerStoreId"].'"> '
							. $row["StoreName"].' '. $row["Address1"].', '.$row["Town"]
							.'</p>';
				}
			}
			else
			{
		    	$storeslist .= "0 results";
			}	
		}//close for loop 

		mssql_close($conn);
		echo $storeslist.'<br>';
	}

?>
