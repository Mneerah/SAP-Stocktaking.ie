<?php


	//$list=	json_decode(stripslashes($_GET['list']));
    //_addNewDateACTION.php?userid="+userid+"&date="+date+"&flag="+AvailabilityStatus
	$userid= $_GET['userid'];
	$date = $_GET['date'];
	$flag = $_GET['flag'];
/*
	
	
	 
	
*/
	require ("db_connect.php");

	if($flag!='0')
	{
		$sql = "INSERT INTO `tblUserAvailability` 
							(`UserAvailabilityId`, `UserId`, `AvailabilityDate`, `IsAvailable`) 
				VALUES (NULL, '$userid', '$date', 1);";

		if ($conn->query($sql) === TRUE) {
			echo " <b>Success!</b> (".substr($date,0,-8).") has been added..";
		} else {
		    echo "-Error updating record: " . $conn->error."<br>";
		}
			
	}

	else
	{
        $sql = "DELETE FROM tblUserAvailability
                WHERE AvailabilityDate  = '$date'
                AND UserId='$userid';";

		if ($conn->query($sql) === TRUE) {
			echo " <b>Success!</b> (".substr($date,0,-8).") has been removed..";
		} else {
		    echo "-Error updating record: " . $conn->error."<br>";
		}
	}		
	mssql_close($conn);


?>
