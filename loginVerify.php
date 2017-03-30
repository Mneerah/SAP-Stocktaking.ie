<?php
    require ("db_connect.php");

$hint = "";

    //retrive the get method attribute from the GET array
    //which represent what's written in the text field right now
    $q=$_GET["q"];


$sql = "SELECT Username, Password
		FROM tblUsers where Username='$q'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         //if there is a text, and surely there will be, because i already checked that in the index page.
        if (strlen($q) > 0) {
            //initialize the hint string.. 
            $hint="";
            //compare the q string which is the input string 
            //with array a elements in a loop.
            for($i=0; $i<count($row["Username"]); $i++){
                if (strtolower($q)==strtolower($row["Username"])){
                    $hint="<span style='color:green'> This username is registered </span>";
                }
            }
        }   
    }
} 

    //after we went throgh the array, if the hint is still empty
    if ($hint == ""){
        $response="<span style='color:red'>Not registered...</span>";
    }
    //and if it was not.
    else{
        $response=$hint;
    }
    //finally return the $response as the response text to the index page.
    echo $response;
/*
mysqli_close($conn);
*/
?>