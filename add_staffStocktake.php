<!DOCTYPE HTML>
<html>
	<head>
		  <link rel="stylesheet" type="text/css" media="screen" href="css/form.css">

		<script>
		    window.onunload = refreshParent;
		    function refreshParent() {
		      window.opener.location.reload();
		    }
		</script>
	</head>
	<body>
		<div id="header">
			<img src="images/logo.png" >
		</div>

		<span style="clear:both;"><br></span>


		<form id="onediv" action="_staffAddToST_ACTION.php" method="post" >
		<h2> Modify Stocktake </h2>
						<?php 
							require ("db_connect.php");

							$staff= $_GET['staff'];
							$stocktake= $_GET['stocktake'];

								
							$sql = "SELECT 		tblStockTakes.StockTakeId AS ST_ID, 
					                            tblStockTakes.StockTakeStatus AS ST_STATUS,
					                            tblStockTakes.CustomerStoreId AS S_ID,
					                            tblStockTakes.SupervisorUserId as SUP_ID,

					                            tblCustomerStores.StoreName AS S_NAME,
					                            tblCustomerStores.Address1 AS S_ADD, 
					                            tblCustomerStores.Town AS S_TOWN,
					                            tblCustomerStores.CountyId AS S_County

					                    FROM    tblCustomerStores, tblStockTakes
					                    WHERE   tblStockTakes.CustomerStoreId= tblCustomerStores.CustomerStoreId 
					                    and     tblStockTakes.StockTakeId  ='$stocktake';";
					        $Region="";

							$Connacht = array(33, 34, 37, 53, 60);
							$Munster=	array(35, 38, 39, 46, 48, 55);
							$Leinster= 	array(36, 40,41,42,43,44, 47, 54,56,57,63,64);
							$Ulster= 	array(45, 49,50,51,52, 58,59,61,62);

							$SupervisorIsSet="No Team Leader assigned yet.";
							$result = mysqli_query($conn, $sql);
							//echo $result;
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
							    // output data of each row
									if (in_array(($row["S_County"]), $Connacht)) $Region= "Connacht";
							    	if (in_array(($row["S_County"]), $Munster)) $Region= "Munster";
							    	if (in_array(($row["S_County"]), $Leinster)) $Region= "Leinster";
							    	if (in_array(($row["S_County"]), $Ulster)) $Region= "Ulster";

									if($row["SUP_ID"]!= null)
										$SupervisorIsSet="Team Leader is assigned!";
									

							        echo'
										<div>
					        				<label id="'. $row["ST_ID"].'" 
												class="btn '.$Region.'" style="width:50%; float:left;">'  
					        			 		. $row["S_NAME"].'<br>
					        			 	</label> 
					        				
										</div>
										<span style="clear:both;"><br></span><br><br><br>
				        				<div> 
				        					<i> '.$SupervisorIsSet.'</i>	<br>
				        				</div>

					     <input  value="'.$staff.'" type="text" name="staff" hidden>	
					     <input  value="'.$stocktake.'" type="text" name="stocktake" hidden>					        			  
					        			  ' ;
							    }
							} else {
							    echo "0 results";
							}

							mysqli_close($conn);

						?>
  					
  				
  				
  				

				<br><div style="text-align:center;">
  				<input class="threebuttonstyle green" style="width:100%;" type="submit" name="mybutton" value="Add as Team Leader"> 
 				<input class="threebuttonstyle orange" style="width:100%;" type="submit" name="mybutton" value="Add as Driver"> 
				<input class="threebuttonstyle grey" style="width:100%;" type="submit" name="mybutton" value="Add as Member"> 


	<br><input class="threebuttonstyle white" style="width:100%;" type="submit" onclick="javascript:window.close()" value="Cancel">
</div>
			
		</form>
				

		<div id="footer">
			<p>
			</p>
		</div>
	</body>
</html>