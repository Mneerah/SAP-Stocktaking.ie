<?php
        /*
** Connect to database:
*/
 
// Connect to the database (host, username, password)
$con = mssql_connect('localhost','sa','foo') 
    or die('Could not connect to the server!');
 
// Select a database:
mssql_select_db('Test') 
    or die('Could not select a database.');
 

/*
$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbo";

        // Create connection
        global $conn ;
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        */

        //echo "Connected successfully";
        //session_start();// Starting Session
        // Storing Session
        //$user_check=$_SESSION['login_user'];
        // SQL Query To Fetch Complete Information Of User
        //$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
        //$row = mysql_fetch_assoc($ses_sql);
        //$login_session =$row['username'];
        //if(!isset($login_session)){
          //  mysql_close($connection); // Closing Connection
          //  header('Location: index.php'); // Redirecting To Home Page
        //}
?>
