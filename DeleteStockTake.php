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
		    $ID=$_GET["id"];


		$sql = "
		DELETE FROM `tblStockTakes` 
		WHERE `tblStockTakes`.`StockTakeId` ='$ID'";

		$result = mysqli_query($conn, $sql);
		if ($conn->query($sql) === TRUE) {
			//echo "Stocktake Deleted successfully";
echo "<script>window.close();</script>";
		} else {
		    echo "<h3>Database Error!</h3><h4>You can't delete a stocktake that has staff members assigned.</h4><br> Error updating record: " . $conn->error;
		}
		
	mysqli_close($conn);

?>
</body>
</html>