<?php	
require ("db_connect.php");
if(isset($_GET['hint']) && ($_GET['hint']!=""))
    {
$hint =$_GET['hint'];
    $sql = "SELECT 			
			CustomerId,
			CustomerName1,
			CustomerName2

                FROM    tblCustomers where CustomerName1 LIKE '".$hint."%' ORDER BY CustomerName1;";
} else {
    $sql = "SELECT 			
					CustomerId,
					CustomerName1,
					CustomerName2

                FROM    tblCustomers ORDER BY CustomerName1;";
}
	
    $result = mssql_query($sql) or die('A error occured: ' . mysql_error());
    //if sql succeed
	if (mssql_num_rows($result) > 0) 
	{
		while($row = mssql_fetch_assoc($result)) 
		{
			echo
				'<input type="checkbox" name="Customers[]" 
						onchange="ChangeStoresList()" 
						value="'. $row["CustomerId"].'"> '
						. $row["CustomerName1"].' '
						. $row["CustomerName2"]
						.'<br>';

		}
	}
	else
	{
    	echo "0 results";
	}

	mssql_close($conn);
?>
