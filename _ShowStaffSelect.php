<?php
	require ("db_connect.php");
	$sql =  "SELECT UserId,FirstName,LastName FROM tblUsers;";
	//add call to user rates and car groups 

	$result = mssql_query($conn, $sql);
	if (mssql_num_rows($result) > 0) {
		    // output data of each row
	    while($row = mssql_fetch_assoc($result)) {
		echo'<option id="'. $row["UserId"].'" value="'. $row["UserId"].'">'. $row["FirstName"].' '.$row["LastName"].'</option>';
	    }
	} else {
	    echo "0 results";
	}
	mssql_close($conn);
?>
