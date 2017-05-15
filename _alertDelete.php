<!DOCTYPE HTML>
<html>
	<head>
		<script>
		    window.onunload = refreshParent;
		    function refreshParent() {
		      window.opener.location.reload();
		    }
		</script>
	</head>
	<body>
	<?php

		require ("db_connect.php");
		    $staff=$_GET["staff"]; $stocktake= $_GET["stocktake"];


		$sql = "
		DELETE FROM `tblStockTakeUsers` 
		WHERE `StockTakeId` ='$stocktake'
AND `UserId` ='$staff'";

		$result = mssql_query($conn, $sql);
		if ($conn->query($sql) === TRUE) {
			//echo "Stocktake Deleted successfully";
echo "<script>window.close();</script>";
		} else {
		    echo "Error updating record: " . $conn->error;
		}
		
	mssql_close($conn);

?>
</body>
</html>
