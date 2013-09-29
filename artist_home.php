<?php 
session_start(); 
include "include/dbConnect.php";
include "include/securitytest.php";

if(isset($_SESSION['userid']))
{						
	$uid = $_SESSION['userid'];

	//get artist info 
	$sql1 = "SELECT * FROM tbluser u, tblartist a WHERE u.userid=a.artistId and u.userid = '$uid';";

	$resultset1 = mysql_query($sql1);

	$count1=mysql_num_rows($resultset1);
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">

	<title>Artist Home</title>
		
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/artist_content.css" rel="stylesheet" type="text/css" media="all"/>
	<script type="text/javascript" src="js/addSample.js"></script>
	
	<script>
	function show(str)
				{
				if (url=="")
				  {
				  document.getElementById("gen").innerHTML="";
				  return;
				  }
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("gen").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","processing/getGenre.php",true);
				xmlhttp.send();
				}
	</script>
</head>

<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		
		<div id="content">
			<?php include "include/artistNav.php";?>
			<div id="aContent">
			<?php include "include/addUrl.php";?>
			
			</div>
		</div>
	
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>