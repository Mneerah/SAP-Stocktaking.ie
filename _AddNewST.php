<?php


	$list=	json_decode(stripslashes($_GET['list']));

	$counter=0;

	if(count($list)==0)
	{
		echo "";
	}

	else
	{
		foreach($list as $d){		     

			require ("db_connect.php");

			$presql = "SELECT 
							CustomerStoreId, CustomerId, StoreName, Address1, Town	
		            		FROM    tblCustomerStores 
							WHERE CustomerStoreId= $d;";
				
		    $result = mysqli_query($conn, $presql); 
		    //if sql succeed
			if (mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					
					$sql = "INSERT INTO `tblStockTakes` 
										(`StockTakeId`, `CustomerId`, `CustomerStoreId`, 
											`StockTakeStatus`, `SupervisorUserId`, `StockTakeName`, 
												`StockTakeDate`, `StockTakeDuration`, `Comments`) 
								VALUES 
									(NULL, '". $row['CustomerId']
											 . "', '"
											 . $row['CustomerStoreId']
											 ."', 'New', NULL, NULL, NULL, NULL, NULL);";

					if ($conn->query($sql) === TRUE) {
						echo "- Record updated successfully <br>";
						$counter++;
					} else {
					    echo "-Error updating record: " . $conn->error."<br>";
					}
				
				}
			}
			else
			{
		    	echo "0 results";
			}	
		}//close for loop 

		mysqli_close($conn);
	}

?>