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


		<div id="onediv" >
		<h2> Modify Stocktake </h2>
			<?php 
					require ("db_connect.php");

					$staff= $_POST['staff'];
					$stocktake = $_POST['stocktake'];

					if($_POST['mybutton'] == 'Add as Team Leader')
					{
						$sql = "UPDATE tblStockTakes
								SET SupervisorUserId='$staff'
								WHERE StockTakeId='$stocktake';";
					}
					if ($_POST['mybutton'] == 'Add as Member')
					{
					  	$sql = "INSERT INTO tblStockTakeUsers (StockTakeUserId ,StockTakeId,  UserId, UserPayRateId, IsDriver)
								VALUES (NULL, $stocktake, $staff, null, null); ";
					}
if ($_POST['mybutton'] == 'Add as Driver')
					{
					  	$sql = "INSERT INTO tblStockTakeUsers (StockTakeUserId ,StockTakeId,  UserId, UserPayRateId, IsDriver)
								VALUES (NULL, $stocktake, $staff, null, '1'); ";
					}
					/*
					StockTakeUserId |	StockTakeId |  UserId |	UserPayRateId |	IsDriver

					*/
					
					$button= '<input class="buttonstyle" type="submit" onclick="javascript:window.close()" value="Close">';

					if ($conn->query($sql) === TRUE) {
						echo "- Record updated successfully <br>".$button;
					} else {
					    echo "-Error updating record: " . $conn->error."<br>".$button;
					}

					mysqli_close($conn);
			?>		
		</div>
				
		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>