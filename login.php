<?php

session_start(); // Starting Session
/*
$error=''; // Variable To Store Error Message


if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

		// Selecting Database
		$db = mysql_select_db("SAP", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from user where Password='$password' AND Username='$username'", $connection);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			header("location: form-new.php"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}
		mysql_close($connection); // Closing Connection
	}
}
*/

require ("db_connect.php");

$hint = "";

//retrive the get method attribute from the GET array
//which represent what's written in the text field right now
$username=$_POST["username"];
$password=$_POST["password"];

$sql = "SELECT Username, Password FROM tblUsers where Username='$username' AND Password='$password'";

$result = mssql_query($conn, $sql);

if (mssql_num_rows($result) > 0) {
    // output data of each row
    while($row = mssql_fetch_assoc($result)) {
         //if there is a text, and surely there will be, because i already checked that in the index page.
            //initialize the hint string.. 
            $hint="";
            //compare the q string which is the input string 
            //with array a elements in a loop.
                if (strtolower($username)==strtolower($row["Username"])){
                    header("location: home.php"); // Redirecting To Other Page
                    $hint="<span style='color:green'> This username is registered </span>";
                    $_SESSION['login_user']=$username; // Initializing Session
                    $_SESSION['login_pass']=$password; // Initializing Session

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
