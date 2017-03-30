<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>SAP Login</title>
	<meta name="description" content="slick Login">
	<meta name="author" content="Webdesigntuts+">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
	<script type="text/javascript" src="placeholder.js"></script>

	<script language="javascript">

		function showHint(str){
		
			//if there is no text, delete the hint and return.
			if (str.length==0){ 
				document.getElementById("txtHint").innerHTML="";
				return;
			}
			
			// else? there is text
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
					document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
				}
			}
			
			//retrieve the XHR response text from the external page.
			xmlhttp.open("GET","loginVerify.php?q="+str,true);
			xmlhttp.send();
			
		} //end method showHint
	</script>

</head>
<body><?php $error="";?>

<div id="header">
			<img src="images/logo.png"  /> 		
</div>

<form id="slick-login" action="login.php" autocomplete="off" method="post">
	<span>use Google Chrome <br></span><br>

	<span id="txtHint"></span>

	<label for="username">username</label>
	<input type="text" id="txt1" name="username" class="placeholder" placeholder="username" onkeyup="showHint(this.value)"/>

	
	<label for="password">password</label>
	<input type="password" name="password" class="placeholder" placeholder="password"/>
	
	<br><span><?php echo $error; ?></span><br>

	<input type="submit" value="Log In"/>

</form>
</body>
</html>