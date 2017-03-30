<?php
	session_start();
	if (!isset($_SESSION['login_user'])||!isset($_SESSION['login_pass'])) {
	  //snter the home page  
		header("Location: index.php");
	} else {
	 
?>
<!DOCTYPE HTML>
<html>
	<head>
		  <link rel="stylesheet" type="text/css" media="screen" href="css/form.css">

			<script>
					//AddDayToCal(29,03,2017)
					function AddDayToCal(data, day, month, year){
						//add or remove flag
						AvailabilityStatus= '1';
						//delete entry
					    if ( document.getElementById(data).classList.contains('IAmAvailable'))
					    {					    	
					    	document.getElementById(data).classList.add('IAmNotAvailable');
					    	document.getElementById(data).classList.remove('IAmAvailable');
					    	AvailabilityStatus= '0';
					    }
					    // add entry
						else if ( document.getElementById(data).classList.contains('IAmNotAvailable'))
					    {
					    	document.getElementById(data).classList.remove('IAmNotAvailable');
					    	document.getElementById(data).classList.add('IAmAvailable');
					    	AvailabilityStatus= '1';
					    }
					    //IAmAvailable or "IAmNotAvailable 

						date= year+"-"+month+"-"+day+" 00:00:00";

						userid= document.getElementById("staffSelect").value;
	    
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
								document.getElementById("alert").style.visibility='visible';
								document.getElementById("alertmsg").innerHTML=xmlhttp.responseText;
							}
						}
						
						//retrieve the XHR response text from the external page.
						xmlhttp.open("GET","_addNewDateACTION.php?userid="+userid+"&date="+date+"&flag="+AvailabilityStatus,true);
						xmlhttp.send();	
					} 

					function CalendarFunction(){

						// START CREATE XHR OBJECT
						userid= document.getElementById("staffSelect").value;
						document.getElementById("dateSelect").hidden= false;

						date=  document.getElementById("dateSelect").value;
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
								document.getElementById("StaffCalendar").innerHTML=xmlhttp.responseText;
							}
						}
						
						//retrieve the XHR response text from the external page.
						xmlhttp.open("GET","_DisplayCalendarACTION.php?userid="+userid+"&date="+date,true);
						xmlhttp.send();	
					}
			</script>
	</head>
	<body id="body">

		<div id="header">
			<img src="images/logo.png"  /> &nbsp;&nbsp;
			<a class="logout" style="float:right; " href="logout.php"> Logout</a> 
			<ul class="navigation">
			  <li><a href="AddNewStockTakes.php"  >New Stocktakes</a></li>
			  <li ><a href="home.php"  >Home</a></li>
			  <li><a href="StaffAvailabilityHome.php" class="activeTab">Staff Availability</a></li>
			</ul>			
		</div>

		<span style="clear:both;"><br></span>

		<div id="normaldiv">	
			<section class="checklistbox" style="float:left; width:15%; text-align: center;">
				<h4>Staff Availability <BR>(Turn ON/OFF)</h4>
				<form>
					<!--
						<input name="staffAvailability" type="radio" value="ON" /> Turn ON <BR>
						<input name="staffAvailability" type="radio" value="OFF" /> Turn OFF <br>
						 TO BE COMPLETED		from DB			
					 -->
					 <label class="switch">
					  	<input type="checkbox" checked>
					  	<div class="slider round"></div>
					</label>
				</form><br>
				

				
				
			</section> 
			<section class="checklistbox" style="float:right; width:60%; text-align: left;">
				<div id="alert" class="alert" style="visibility:hidden;">
				  <span class="closebtn" onclick="this.parentElement.style.visibility='hidden';">&times;</span> 
				  <span id="alertmsg"></span>
				</div>
				<h3>Show Availability for Staff :<br>

					<Select id="staffSelect" class="searchfield" onchange="CalendarFunction()" >
					  	<option selected disabled>-- Select Staff --</option>
						<?php
							include ("_ShowStaffSelect.php");
							?>	
					</Select>
					<input class="searchfield" style='max-width:680px' id= "dateSelect" type="date"  value="2017-03-01" hidden onchange="CalendarFunction()" />
				</h3>
				<div id="StaffCalendar">
<!--
				
				<?php
				/*
						$dia = date ("d"); $mes = date ("n"); $ano = date ("Y");
						if($dia[0]=='0') $dia=substr($dia, -1);

						if (isset($_GET["dia"])){
							$dia = $_GET["dia"]; $mes = $_GET["mes"]; $ano = $_GET["ano"];
						} 

						//include the WeeklyCalClass and create the object !!
						include ("_DisplayCalendar.php");
						$calendar = new StaffCalendarClass (3, $dia, $mes, $ano);
						echo $calendar->showCalendar ();
					*/
					?>	

				 new===============================================-->
	<!--				
						<ul class="weekdays">
						  <li>Mo</li><li>Tu</li><li>We</li><li>Th</li><li>Fr</li><li>Sa</li><li>Su</li>
						</ul>

						<ul class="days"> 
						  <li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li>
						  <li ><span class="active">10</span></li>
						  <li>11</li><li>12</li><li>13</li><li>14</li><li>15</li><li>16</li>
						  <li>17</li><li>18</li><li>19</li><li>20</li><li>21</li><li>22</li>
						  <li>23</li><li>24</li><li>25</li><li>26</li><li>27</li><li>28</li> <li>29</li><li>30</li>
						</ul>

				 =========================================================== -->
				</div>
			</section> 
			<div style="clear:both; ">
			</div>

		</div>				


		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>
<?php
}
?>