<?php

	//userid="+userid+"&date
	$dia = date ("d"); $mes = date ("n"); $ano = date ("Y");
	if($dia[0]=='0') $dia=substr($dia, -1);

	if (isset($_GET["userid"])){
		$userid= ($_GET["userid"]);
	} 
	//ECHO $_GET["date"];
	//substr("Hello world",1,8);
	//2017-04-01
	//(YYYY-MM-DD)
	//(0123-56-89)

	if (isset($_GET["date"])){
		//$dia = substr(($_GET["date"]),8,2);
		$dia = "01";
		$mes = substr(($_GET["date"]),5,2);
		$ano = substr(($_GET["date"]),0,4);
	} 

	//include the WeeklyCalClass and create the object !!
	include ("_DisplayCalendar.php");
	$calendar = new StaffCalendarClass ($userid, $dia, $mes, $ano);
	echo $calendar->showCalendar ();


?>