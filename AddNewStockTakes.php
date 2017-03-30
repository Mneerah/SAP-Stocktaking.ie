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


				function checkAll(flag) {
				     var checkboxes = document.getElementsByName('Stores[]');
			         for (var i = 0; i < checkboxes.length; i++) {
			             if (checkboxes[i].type == 'checkbox') {
			                 checkboxes[i].checked = flag;
			             }
			         }
				 }

				function ChangeStoresList() {
					//str="";
					list= [];
					var CustomersArray = document.getElementsByName( 'Customers[]');

					for (var i=0; i < CustomersArray.length; i++) {
				        if(CustomersArray[i].checked ) 
				        	list.push(CustomersArray[i].value); //str+=( CustomersArray[i].value )+", ";
				    }

					var jsonString = JSON.stringify(list);
				    // array is filled? there is text
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
							document.getElementById("StoresList").innerHTML=xmlhttp.responseText;
						}
					}
					
					//retrieve the XHR response text from the external page.
					xmlhttp.open("GET","_ShowStores.php?list="+jsonString,true);
					xmlhttp.send();	
				}

				function AddNewStocktakes() {
					list= [];
					var StoresArray = document.getElementsByName( 'Stores[]');

					for (var i=0; i < StoresArray.length; i++) {
				        if(StoresArray[i].checked ) 
				        	list.push(StoresArray[i].value); //str+=( StoresArray[i].value )+", ";
				    }

					var jsonString = JSON.stringify(list);
				    // array is filled? there is text
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
							document.getElementById("add_result").innerHTML=xmlhttp.responseText;
						}
					}
					
					//retrieve the XHR response text from the external page.
					xmlhttp.open("GET","_AddNewST.php?list="+jsonString,true);
					xmlhttp.send();	
				}
				function searchCustomer(){
					var hint = document.getElementById("searchCustomer").value;
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
							document.getElementById("customerscheckList").innerHTML=xmlhttp.responseText;
						}
					}
					
					//retrieve the XHR response text from the external page.
					xmlhttp.open("GET","CustomersChecklist.php?hint="+hint,true);
					xmlhttp.send();	
				}
			</script>
	</head>
	<body id="body">

		<div id="header">
			<img src="images/logo.png"  /> &nbsp;&nbsp;
			<a class="logout" style="float:right; " href="logout.php"> Logout</a> 
			<ul class="navigation">
			  <li><a href="AddNewStockTakes.php" class="activeTab" >New Stocktakes</a></li>
			  <li ><a href="home.php"  >Home</a></li>
			  <li><a href="StaffAvailabilityHome.php" >Staff Availability</a></li>
			</ul>			
		</div>

		<span style="clear:both;"><br></span>

		<div id="normaldiv">	
			<section class="checklistbox" style="float:left; width:25%;">

				<h3> Select Clients </h3>
				<!-- ========================================================== -->
				<input id="searchCustomer" type="text" placeholder="client name" class="searchfield" onkeyup="searchCustomer()" />
				<!-- to be implemented with jquery -->
				<!-- ========================================================== -->
				<br><br>
				<form id= "CustomersList" class="innercheckliststyle">
					<br><div id="customerscheckList">
					<?php include ("CustomersChecklist.php"); ?>
					</div>
<br>
				</form>
				
			</section> 
			<section class="checklistbox" style="float:right; width:50%;">
				<h3>Select Stores </h3>				
				<span id="add_result" > </span >

				<input type="button" value="Select All" class="buttonstyle" style="float:left;" onclick="checkAll(true)" />
				<input type="button" value="Deselect All" class="buttonstyle" style="float:right;" onclick="checkAll(false)" />
				<div style="clear:both; ">	</div>
				<form>
				<div id= "StoresList" class="innercheckliststyle">
							<br> NO STORES TO DISPLAY <br><br>
				</div>
				<input type="submit" value="Add new Stocktakes" class="buttonstyle" onclick="AddNewStocktakes()" /> <br>
				</form>
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