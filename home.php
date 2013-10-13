<?php 
session_start(); 
include "include/dbConnect.php";

/* If this line below is true, means the DB connects successfully:

	if(isset($database)) { echo "true"; } else { echo "false"; }
	echo "<br />";

	

   If the code below echos on web pages as "It\'s working" with that slash it means that mysql DB is successfully escaping illegal apostrophes:

	echo $database->escape_value("It's working?<br />");
	
	
   How to insert with query() function:
	// $sql  = "INSERT INTO tableName (id, field1, field2) ";
	// $sql .= "VALUES (NULL, 'content1', 'content2')";
	// $result = $database->query($sql);

*/


$sql = "SELECT clause FROM tbltemplateclause;";
$resultset = mysql_query($sql);
$count=mysql_num_rows($resultset);

//get featured artist content for small items
$sql1 = "SELECT * FROM tbluser u, tblartist a WHERE u.userId = a.artistId and a.featured = '1';";
$result = mysql_query($sql1);
$count1=mysql_num_rows($result);

//get featured artist content for large items
$sql2 = "SELECT * FROM tbluser u, tblartist a WHERE u.userId = a.artistId and a.featured = '1';";
$result1 = mysql_query($sql2);
$count2=mysql_num_rows($result1);

//get recently added music
$sql3 = "SELECT * FROM tblsample ORDER BY dateadded desc LIMIT 0, 4;";
$result2 = mysql_query($sql3);
$count3=mysql_num_rows($result2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	
	<title>Home</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
		
	<link rel="stylesheet" type="text/css" href="css/featuredStyle.css" />
	<script type="text/javascript" src="jsFeatured/jquery-1.3.2.min.js" ></script>
	<script type="text/javascript" src="jsFeatured/jquery-ui-1.7.2.custom.min.js" ></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);  
		});
		
		//elastic textarea
		$('.description').elastic();
	</script>

	<script>
	function show(str)
				{
				if (str=="")
				  {
				  document.getElementById("featuredinfo").innerHTML="";
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
					document.getElementById("featuredinfo").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","processing/getInfo.php?q="+str,true);
				xmlhttp.send();
				}
	</script>	
</head>

<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		<?php if(isset($_SESSION['error']))
			{
			echo($_SESSION['error']);
			$_SESSION['error']='';
			}
			?>
		<div id="content">
		
			<div id="featuredwrap" >	
			
			
				<div id="featured" >
				
 <!--
				<script type="text/javascript" src="http://feed.informer.com/widgets/WEMVSSRSUF.js"></script>
				<noscript><a href="http://feed.informer.com/widgets/WEMVSSRSUF.html">"Caribbean Surge RSS feed"</a>
				Powered by <a href="http://feed.informer.com/">RSS Feed Informer</a></noscript>
  -->
  
  
		
				
				  <ul class="ui-tabs-nav">
					<?php 
					for($j=0; $j<$count1; $j++){
					$row1=mysql_fetch_array($result);
					$y = $j+2;
					$y = $y-1;
					?>
					<li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $y; ?>"><a href="#fragment-<?php echo $y; ?>"><img src="images/profiles/<?php echo $row1["profilePhoto"];?>" width="75px" height="50px" alt="artist profile photo" /><span><?php echo $row1["bio"];?></span></a></li>
					<?php } ?>
				  </ul>
					
					<?php
					for($k=0; $k<$count2; $k++){
					$row2=mysql_fetch_array($result1);
					$l = $k+2;
					$l = $l-1;
					?>
					<!-- Large Content -->
					<div id="fragment-<?php echo $l; ?>" class="ui-tabs-panel ui-tabs-hide" style="">
						<img src="images/profiles/<?php echo $row2["profilePhoto"];?>" alt="artist profile photo" width="400px" height="250px"/>
						 <div class="info" >
							<h2><a href="#" >Get To Know " <?php echo $row2["stageName"];?> " </a></h2>
							<p><?php echo $row2["bio"];?>....<a href="#" onclick="show(<?php echo $row2["userid"];?>)">read more</a></p>
						 </div>
					</div>
					<?php } ?>
			
				</div>
				<br />
				
				<div id="featured" > 
				
				</div>
			
				<div id="RSS" > <!-- RSS-->
				<script type="text/javascript" src="http://feed.informer.com/widgets/WEMVSSRSUF.js"></script>
				<noscript><a href="http://feed.informer.com/widgets/WEMVSSRSUF.html">"Caribbean Surge RSS feed"</a>
				Powered by <a href="http://feed.informer.com/">RSS Feed Informer</a></noscript>
				</div>
			</div>
		    
		
			
			
			
			<div id="newvids">
					<center><h3>Recently Added</h3></center>
					<ul>
						<?php
							for($l=0; $l<$count3; $l++){
							$row3=mysql_fetch_array($result2);
							$img = str_replace("www.youtube.com/embed/", "img.youtube.com/vi/", $row3["url"]);
							$img = $img."/1.jpg";
						?>
							<li><a href="<?php echo $row3["url"]?>" target="_blank"><img src="<?php echo $img ?>"/></a></li>
						<?php } ?>
					</ul>
			</div>
			
			<div id="featuredinfo">
			

  
			   <!-- confirms valid email and reminds you to check email account for your confirmation link -->
				<p style="color:blue;font-weight:bold;font-size:14pt;"><?php
				if(isset($_SESSION['good1'])){
				echo($_SESSION['good1']);
				$_SESSION['good1'] = '';
				}
				?></p>
			
					
			</div>
	
		</div>
		
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>
