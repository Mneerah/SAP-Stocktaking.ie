<?php

session_start(); // Starting Session
require ("db_connect.php");
$hint = "";

//retrive the get method attribute from the GET array
//which represent what's written in the text field right now
$username=$_POST["username"];
$password=$_POST["password"];

$sql = "SELECT UserId, Username, Password FROM tblUsers where Username='$username' AND Password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         //if there is a text, and surely there will be, because i already checked that in the index page.
            //initialize the hint string.. 
            $hint="";
            //compare the q string which is the input string 
            //with array a elements in a loop.
                if (strtolower($username)==strtolower($row["Username"])){
                	$userID= $row["UserId"];
                	$sql = "SELECT GroupId FROM tblUserGroups where UserId='$userID'";
                	$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					    	switch ($row["GroupId"]) {
					    		case '1':
					    			    header("location: home.php"); // Redirecting To Other Page
					                    $hint="<span style='color:green'> This username is registered </span>";
					                    $_SESSION['login_user']=$username; // Initializing Session
					                    $_SESSION['login_pass']=$password; // Initializing Session# code...
					                    $_SESSION['userID']=$userID; // Initializing Session# code...
					    			break;
					    		case '2':
					    			    header("location: Team_Home.php"); // Redirecting To Other Page
					                    $hint="<span style='color:green'> This username is registered </span>";
					                    $_SESSION['login_user']=$username; // Initializing Session
					                    $_SESSION['login_pass']=$password; // Initializing Session# code...
					                    $_SESSION['userID']=$userID; // Initializing Session# code...
					    			break;
					    		case '3':
					    			    header("location: Staff_Home.php"); // Redirecting To Other Page
					                    $hint="<span style='color:green'> This username is registered </span>";
					                    $_SESSION['login_user']=$username; // Initializing Session
					                    $_SESSION['login_pass']=$password; // Initializing Session# code...
					                    $_SESSION['userID']=$userID; // Initializing Session# code...
					    			break;
					    		default:
					    				$hint="<span style='color:red'>Not registered...</span>";
                    					header("location: index.php"); // Redirecting To Other Page
					    			break;
					    	}
					    }
					}


                }
                else
                {
                    $hint="<span style='color:red'>Not registered...</span>";
                    header("location: index.php"); // Redirecting To Other Page

                }
    }
} 

    //after we went throw the array, if the hint is still empty
    if ($hint == ""){
        header("location: index.php"); // Redirecting To Other Page
        $hint="<span style='color:red'>Not registered...</span>";
    }

    //finally return the $response as the response text to the index page.
    echo $hint;
/*
mysqli_close($conn);
*/


?>
