<!DOCTYPE HTML>
<html>
	<head>
		  <link rel="stylesheet" type="text/css" media="screen" href="css/form.css">

			<script>
				function allowDrop(ev) {
				    ev.preventDefault();
				}

				function drag(ev) {
				    ev.dataTransfer.setData( Text, ev.target.id);
				}

				function drop(ev) {
				    var data = ev.dataTransfer.getData(Text);
				    if( ev.target.className=='daylist'){
					    ev.target.appendChild(document.getElementById(data));
					    openStaffStocktake(data, ev.target.id );
					}					    
					ev.preventDefault();

				}
				
function alertDelete(staff, stocktake){
	window.open('_alertDelete.php?staff='+staff+'&stocktake='+stocktake, "delete-STOCKTAKE", "width=520,height=400");
				}
				function openStaffStocktake(staff, stocktake){
					window.open('add_staffStocktake.php?staff='+staff+'&stocktake='+stocktake, "ADD-STOCKTAKE", "width=520,height=630");
				}
				
				//-------------------------display regions ---------------------------------
				function onlyTL(){ 
					staffVisibility('Member','none');
					staffVisibility('D','none');
					staffVisibility('TD','none');
					staffVisibility('DTD','none');
					staffVisibility('TL','block');
					staffVisibility('DTL','block');
				}
				function onlyTD(){ 
					staffVisibility('Member','none');
					staffVisibility('D','none');
					staffVisibility('TL','none');
					staffVisibility('DTL','none');
					staffVisibility('TD','block');
					staffVisibility('DTD','block');
				}
				function onlyD(){ 
					staffVisibility('Member','none');
					staffVisibility('TL','none');
					staffVisibility('TD','none');
					staffVisibility('D','block');
					staffVisibility('DTD','block');
					staffVisibility('DTL','block');
				}
				function displayAll(){ 
					staffVisibility('Member','block');
					staffVisibility('TL','block');
					staffVisibility('TD','block');
					staffVisibility('D','block');
					staffVisibility('DTD','block');
					staffVisibility('DTL','block');
				}

				//----------------main diplay hide method------------------------------------
				function staffVisibility(classname, value){
					var cols = document.getElementsByClassName(classname);
					  for(i=0; i<cols.length; i++) {
					    cols[i].style.display = value;
					  } 
				}
				//---------------------------------------------------------------------------
function CarGroup(str){
	date = document.getElementById("todayDate").innerHTML;

	//var hint= str;
//hint = document.getElementById("CarGroup").value;
/*
var text =" ";

if (hint.length==0) {
var text =" <?php include ('staffCall.php'); ?>";
    }
else{
text ="<?php include ('staffCall.php?CarGroup="+hint+"'); ?>";
     }
document.getElementById("tasks").innerHTML=text;


// START CREATE XHR OBJECT	
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			// END CREATE XHR OBJECT
					
			//When the XHR Object is ready, assign the response text as a hint
		xmlhttp.onreadystatechange=function() {		
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("tasks").innerHTML=xmlhttp.responseText;
			}
		}
if (str.length==0) {
       //retrieve the XHR response text from the external page.
	xmlhttp.open("GET","staffCall.php?date="+date,true);
    }
else{
	//retrieve the XHR response text from the external page.
	xmlhttp.open("GET","staffCall.php?CarGroup="+str+"&date="+date,true);
     }
	xmlhttp.send();	*/
}			
</script>
	</head>
	<body id="body">

		<div id="header">
			<img src="images/logo.png"  /> &nbsp;&nbsp;
			<a class="logout" style="float:right; " href="#logout"> Logout</a> 
			<ul class="navigation">
			  <li><a href="AddNewStockTakes.php"  >New Stocktakes</a></li>
			  <li ><a href="home.php"  class="activeTab">Home</a></li>
			  <li><a href="StaffAvailabilityHome.php" >Staff Availability</a></li>
			</ul>
							
				
		</div>

		<span style="clear:both;"><br></span>

		<div id="leftdiv">
			<div style="text-align:center;">
				<a href="#TeamLeadersLink" id="TeamLeadersLink" onclick="onlyTL()">TL</a> |
				<a href="#TeamDeputiesrLink" id="TeamDeputiesrLink" onclick="onlyTD()">TD</a> | 
				<a href="#DriversLink" id="DriversLink" onclick="onlyD()">D</a> | 
				<a href="#AllStaff" id="AllStaff" onclick="displayAll()">All</a>
		</div>				

		<!-- ========================================================== -->
		<input type="text" placeholder="Car Group" class="searchfield" id="CarGroup" 
 onkeyup="CarGroup(this.value)" />
		<!-- to be implemented with jquery -->
		<!-- ========================================================== -->

			<h4> Available Staff </h4>
			<div id="tasks">
				<?php
				//$date= "20170311"; 
				//$CarGroup=''; $info='all';
				include ('staffCall.php');
				?>
				<span id="todayDate" hidden><?php echo $_GET['year']."-".$_GET['month']."-".$_GET['day'] ?></span>
			</div>
		</div>

		<div id="rightdiv" >
			<div id="calbox" >
					<?php

						//include and create the object !!
						include ("schStaff_dayJobs.php");
						$calendar = new dayJobs ($_GET['dayName'], $_GET['day'],$_GET['month'], $_GET['year']);
						echo $calendar->showCalendar ();

					?>		

			</div>
		</div>

		<div id="footer">
			<p>
				&copy All rights reserved (2017)...
			</p>
		</div>
	</body>
</html>