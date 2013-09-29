<?php 
session_start(); 
include "include/securitytest.php";
include "include/dbConnect.php";

if(!isset($_GET['u']) || 
	isset($_GET['page']) && !isset($_GET['u']) ||
   (isset($_SESSION['userid']) && isset($_GET['page']) && isset($_SESSION['userid']) != isset($_GET['u'])) )
{			
	$uid = $_SESSION['userid'];
}else {
		$uid = $_GET['u'];
		}
	
	//get artist info 
	$sql1 = "SELECT * FROM tbluser u, tblartist a WHERE u.userid=a.artistId and u.userid = '$uid';";

	$resultset1 = mysql_query($sql1);

	$count1=mysql_num_rows($resultset1);
	
	
/**pagination
**Found at : http://www.phpeasystep.com/phptu/29.html
*/

	$tbl_name="tblsample";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE uploader = '$uid'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages["num"];
	
	/* Setup vars for query. */
	if (!isset($_GET['u']))
	{
	$targetpage = "getMusic.php?";
	}
	else 
	{
	$targetpage = "getMusic.php?u=".$uid."&"; 
	}     //your file name  (the name of this file)
	$limit = 3; //how many items to show per page
	if(isset($_GET["page"]))
	{
		$page  = $_GET["page"];
		$start = ($page - 1) * $limit; 			//first item to display on this page
	}else
	{
		$start = 0;			//if no page var is given, set start to 0
	}
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE uploader = '$uid' ORDER BY sampleId DESC LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if (!isset($_GET["page"])) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"".$targetpage."page=$prev\">? previous</a>";
		else
			$pagination.= "<span class=\"disabled\">? previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"".$targetpage."page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"".$targetpage."page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"".$targetpage."page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"".$targetpage."page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"".$targetpage."page=1\">1</a>";
				$pagination.= "<a href=\"".$targetpage."page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"".$targetpage."page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"".$targetpage."page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"".$targetpage."page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"".$targetpage."page=1\">1</a>";
				$pagination.= "<a href=\"".$targetpage."page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"".$targetpage."page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"".$targetpage."page=$next\">next ?</a>";
		else
			$pagination.= "<span class=\"disabled\">next ?</span>";
		$pagination.= "</div>\n";		
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
	
	<!--youtube scripts-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/youtube.js"></script>
    <script type="text/javascript">
        $(function () {
            $("a.youtube").YouTubePopup({ autoplay: 0 });
        });
		
			//elastic textarea
			$('#comment').elastic();
    </script>

	<!--get genre select box-->
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
	
	<!--get sample comments-->
	<style type="text/css">
		.section {
			display: none;
		}
	</style>
	<script type="text/javascript">
		function toggleVisibility(newSection) {
			$(".section").not("#" + newSection).hide();
			$("#" + newSection).toggle("fast");
		}
	</script>
	
	<!--add comment-->
	<script type="text/javascript">
		(function ($) {
			$.fn.addCom = function(com) {

			var comment = $("#comment"+com+"").val();
			var sample_id = $("#sample_id"+com+"").val();
			var dataString = 'comment=' + comment + '&sample_id=' + sample_id;
			if( comment == '')
			 {
			alert('Please Give Details');
			 }
			else
			{
		$.ajax({
			type: "POST",
			url: "processing/commentSample.php",
			data: dataString,
			cache: false,
			success: function(html){
		 
			$("ol#update"+com+"").append(html);
			$("ol#update li:last").fadeIn("slow");
			document.getElementById('comment').value='';
			$("#name").focus();
		  }
		 });
		}
		return false;
			};

		})(jQuery);
	</script>
	
	<!--Find Sample-->
	<script>	
	function showSample(str, uid)
	{
	if (str.length==0)
	  { 
	  document.getElementById("searchResults").innerHTML="";
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
		document.getElementById("searchResults").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","processing/samSearch.php?c="+str+"&u="+uid,true);
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
			
			<?php if(isset($_SESSION['error']))
			{
			echo($_SESSION['error']);
			$_SESSION['error']='';
			}
			?>  
			
			<div id ="cSearch">
				<div>
					<form>
						<span><input type="text" class="search rounded" placeholder="Find a Sample..." onkeyup="showSample(this.value, <?php echo $uid ?>)"></span>
					</form>
				</div>
			</div>
			<div id = "searchResults" ></div>
			
			<h3>My Music</h3>
			<?php include "include/addUrl.php";?>
				<?php
					if ($total_pages == 0)
					{ ?>
					<img src="images/nosong.png" width="200px" height="200px"/>
					<h3>No Music Added Yet</h3>
				<?php } ?>
				<?php
					while($row = mysql_fetch_array($result))
					{
					$img = str_replace("www.youtube.com/embed/", "img.youtube.com/vi/", $row["url"]);
					$img = $img."/1.jpg";
				?>
				<div class="music">
					<div class="mImg">
						<a class="youtube" href="<?php echo $row["url"]?>" title=""><img src="<?php echo $img ?>"/></a>
					</div>
					<div class="mInfo">
						<ul>
						<li>Title: &nbsp <?php echo $row["title"]?></li>
						<li>Description: &nbsp <?php echo $row["description"]?></li>
						<li><a href="#" onclick="toggleVisibility('<?php echo $row["sampleId"]?>');">View/Add Comments</a><li>
						<li>
							<div id="<?php echo $row["sampleId"]?>" class="section">
							
								<ol  id="update<?php echo $row["sampleId"]?>" class="timeline">
									<div id="flash" align="left"  ></div>
									<?php
									$s = $row["sampleId"];
									//$post_id value comes from the POSTS table
									$sqlsc=mysql_query("select * from tblscomment c, tblartist a WHERE a.artistId = c.commenter AND c.sample='$s' ORDER BY SCommentid DESC");
									while($rowsc=mysql_fetch_array($sqlsc))
									{
									$comment=$rowsc['SComment'];
									?>
									<li class="box">
									<img src="images/profiles/<?php echo $rowsc["profilePhoto"]?>" class="com_img" width="75px" height="75px">
									<span class="com_name"><?php echo $comment?></span>
									<?php 
										if (isset($_SESSION["userid"])){
											$comm = $_SESSION["userid"];
											if ($comm == $rowsc["commenter"]) {
										?>
										<a onclick="return confirm('Are you sure you want to delete?')" style="float:right; margin-right:15px; margin-top:15px" href="processing/deleteScomment.php?s=<?php echo $rowsc['SCommentid'];?>"><img src="images/delete.png" width="10px" height="10px"/></a>
										<?php } } ?>
									<br/>
									</li>
									<?php
									}
									?>

									</ol>
				
									<div style="margin-left:100px">
									<div class ='form'>
									<input type="hidden" name="sample_id" id="sample_id<?php echo $row["sampleId"]; ?>" value="<?php echo $row["sampleId"]; ?>"/>
									<textarea name="comment" id="comment<?php echo $row["sampleId"]; ?>"></textarea><br />
									<input type="submit" class="submit" onClick="$(this).addCom('<?php echo $row["sampleId"]?>');" value="Submit Comment " />
									</div>
									</div>
									
							</div>
						</li>
						</ul>
					</div>
					<?php 
					if (!isset($_GET["u"])){
					?>
					<a onclick="return confirm('Are you sure you want to delete?')" style="float:right; margin-right:15px; margin-top:15px" href="processing/deleteSample.php?s=<?php echo $row['sampleId'];?>"><img src="images/delete.png" width="12px" height="12px"/></a>
					<?php } ?>
				</div>
				<?php } ?>
				
				<center><?=$pagination?></center>
				
			</div>
	
		</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>