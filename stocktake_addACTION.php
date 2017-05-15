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

					$id= $_POST['id'];
					$date = $_POST['date'];
					$time = $_POST['time'];
					$comment= $_POST['comment'];
$date .=" ".$time;
					if($_POST['mybutton'] == 'Send Offer')
					{
						
					  	//header("location: mailto:");
						//echo "<a href='mailto:" . $to . "?body=" . $body . "'></a>";
					  $status="Pending";
					}
					if($_POST['mybutton'] == 'Save Details')
					{
					  $status="Temp";
					}
					if ($_POST['mybutton'] == 'Confirm')
					{
					  $status="Confirmed";
					}
if ($_POST['mybutton'] == 'Reset')
{
	 $status="New";
	 $date = null;
}

					$sql = "UPDATE tblStockTakes
							SET StockTakeStatus='$status', StockTakeDate='$date', Comments='$comment'
							WHERE StockTakeId='$id';";
					
					$button= '<input class="buttonstyle" type="submit" onclick="javascript:window.close()" value="Close">';

					if ($conn->query($sql) === TRUE) {
						//echo "- Record updated successfully <br>".$button;
echo "<script>window.close();</script>";
					} else {
					    echo "-Error updating record: " . $conn->error."<br>".$button;
					}

					mssql_close($conn);
			?>		
		</div>
				
		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>
