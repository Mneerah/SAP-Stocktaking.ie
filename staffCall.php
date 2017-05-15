<?php
require ("db_connect.php");

if(isset($_GET["date"]))
	$date= $_GET["date"]; 

if(isset($_GET["CarGroup"])){
                $carGroup= $_GET["CarGroup"]; 

		$sql =  "SELECT AvailabilityDate, 
				tblUserAvailability.UserId as UserId,
				FirstName,LastName, CanDrive, CarGroup, DefaultUserPayRateId, 
				UserPayRateId, PayRate
				FROM tblUserAvailability, 
					 tblUsers, 
					 tblUserPayRates
				WHERE DefaultUserPayRateId=UserPayRateId 
				and tblUserAvailability.UserId 
				=   tblUsers.UserId
 and CarGroup = '1'   ORDER BY FirstName;";
}

else{
		$sql =  "SELECT AvailabilityDate, 
						tblUserAvailability.UserId as UserId,
						FirstName,LastName, CanDrive, CarGroup, DefaultUserPayRateId, 
						UserPayRateId, PayRate
					FROM tblUserAvailability, tblUsers, tblUserPayRates
					WHERE DefaultUserPayRateId=UserPayRateId 
					and tblUserAvailability.UserId = tblUsers.UserId
                    ORDER BY FirstName;";
}
//echo $sql;
		//add call to user rates and car groups 

		/*

			 members €9.50
			TD (deputies) €10
			Team leader €11 or €15

		*/
if(isset($_GET["day"])
	&&isset($_GET['month'])
	&&isset($_GET['year']))
{

		$day = $_GET['day'];
		$month = $_GET['month'];
		$year = $_GET['year'];

		 if ($day<10){
                switch ($day) {
                    case 1: $day="01"; break;
                    case 2: $day="02"; break;
                    case 3: $day="03"; break;
                    case 4: $day="04"; break;
                    case 5: $day="05"; break;
                    case 6: $day="06"; break;
                    case 7: $day="07"; break;
                    case 8: $day="08"; break;
                    case 9: $day="09"; break;
                }
            }
            if ($month<10){
                switch ($month) {
                    case 1: $month="01"; break;
                    case 2: $month="02"; break;
                    case 3: $month="03"; break;
                    case 4: $month="04"; break;
                    case 5: $month="05"; break;
                    case 6: $month="06"; break;
                    case 7: $month="07"; break;
                    case 8: $month="08"; break;
                    case 9: $month="09"; break;
                }
            }
            $fullDate1 =$year."-".$month."-".$day." 00:00:00";
            $fullDate2 =$year."-".$month."-".$day." 23:59:59";
}
else
{
	$fullDate1 =$date." 00:00:00";
    $fullDate2 =$date." 23:59:59";
}
		//$CarGroup=$_GET["CarGroup"];
		//$info=$_GET["info"];
		//echo $date."???";
		$result = mssql_query($conn, $sql);
		if (mssql_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mssql_fetch_assoc($result)) {
		    		$staffInfo="";
$Classes ="";
		    		//$Classes ="CarGroup".$row["CarGroup"]." ";
		    		//=========================
		    		if($row["CanDrive"]==1)
		    		{
		    			$staffInfo .="[D]";
		    			$Classes .="D";
		    		}
		    		//==========================
		    		if($row["PayRate"]==10)
		    		{
		    			$staffInfo .="[TD]";
		    			$Classes .="TD";
		    		}
		    		else if($row["PayRate"]>=11)
		    		{
		    			$staffInfo .="[TL]";
		    			$Classes .="TL";
		    		}
		    		//=============================
		    		if($Classes=="")
		    			$Classes= "Member";
		    		//=====================================
		    		if($fullDate1==$row["AvailabilityDate"])
		        		echo'<label id="'. $row["UserId"].'" class="btn '.$Classes.' CarGroup'.$row["CarGroup"].'" draggable="true" ondragstart="drag(event)" style="cursor:move">'
		        	. $row["FirstName"].' '.$row["LastName"].' '.$staffInfo.'</label> ';
		        	//echo $row["AvailabilityDate"];
		        	//echo $date;
		        	// {'.$row["AvailabilityDate"].'}';

		    }
		} else {
		    echo "0 results";
		}

		mssql_close($conn);
?>
