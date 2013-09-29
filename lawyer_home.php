<?php 
session_start(); 

include "include/dbConnect.php";

if(isset($_SESSION['lawyerId']) && isset($_SESSION['userType'])  && isset($_SESSION['client']) )
{			
	$uid = $_SESSION['client'];
	$ut =  $_SESSION['userType'];
	$lid =  $_SESSION['lawyerId'];
	
	$csql = "Select userType from tbluser where userid = '$uid'";
	$cresults = mysql_query($csql);
	
	while ($crow = mysql_fetch_assoc($cresults))
	{
		$cType = $crow["userType"]; 
	}
	
	if ($ut != 4)
	{
	header("Location: ../home.php");
	}
	
/**pagination
**Found at : http://www.phpeasystep.com/phptu/29.html
*/

	$tbl_name="tblcontract";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	if($cType == 2)
	{
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE Drafter = '$uid'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages["num"];
	}else {
			$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE participant = '$uid'";
			$total_pages = mysql_fetch_array(mysql_query($query));
			$total_pages = $total_pages["num"];
			}
	
	/* Setup vars for query. */
	$targetpage = "lawyer_home.php?";
	//your file name  (the name of this file)
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
	if($cType == 2)
	{
	$sql = "SELECT * FROM $tbl_name d, tbluser u WHERE Drafter = '$uid' AND d.participant = u.userid ORDER BY contractId DESC LIMIT $start, $limit";
	$result = mysql_query($sql);
	}else {
			$sql = "SELECT * FROM $tbl_name d, tbluser u WHERE participant = '$uid' AND d.Drafter = u.userid ORDER BY contractId DESC LIMIT $start, $limit";
			$result = mysql_query($sql);
			}
	
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
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	
	<title>template</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/label_content.css" rel="stylesheet" type="text/css" media="all"/>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
	
	<!--get clause list-->
	<style type="text/css">
		.clauses {
			display: none;
		}
	</style>
	<script type="text/javascript">
		function toggleContract(newSection) {
			$(".clauses").not("#" + newSection).hide();
			$("#" + newSection).toggle("fast");
		}
	</script>
	
	<!--get clause info-->
	<style type="text/css">
		.clInfo {
			display: none;
		}
	</style>
	<script type="text/javascript">
		function toggleClause(newSection) {
			$(".clInfo").not("#" + newSection).hide();
			$("#" + newSection).toggle("fast");
		}
	</script>
		
	<!--add comment-->
	<script type="text/javascript">
		(function ($) {
			$.fn.addComment = function(com) {

			var comment = $("#comment"+com+"").val();
			var cl_id = $("#cl_id"+com+"").val();
			
			if($('input:radio[name=agree'+com+']:checked').val() == 1){
			var agree = $("#agree"+com+"").val();
			var dataString = 'comment=' + comment + '&cl_id=' + cl_id + '&agree=' + agree;
			} else {
			var agree = $("#dagree"+com+"").val();
			var dataString = 'comment=' + comment + '&cl_id=' + cl_id + '&agree=' + agree;
			}
			
			if( comment == '' || !$('input:radio[name= agree'+com+']:checked').val())
			 {
			alert('Please specify if you agree or disagree and give comment');
			 }
			else
			{
		$.ajax({
			type: "POST",
			url: "processing/lawyerComment.php",
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
		
	<!--Find Contract-->
	<script>	
	function showContract(str)
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
	xmlhttp.open("GET","processing/lawyerConSearch.php?c="+str,true);
	xmlhttp.send();
	}
</script>

</head>

<body>	
	<div id="wrapper">
		
		<div id="content">
			<?php if(isset($_SESSION['error']))
			{
			echo($_SESSION['error']);
			$_SESSION['error']='';
			}
			?>
		<div id ="cSearch">
			<div>
				<form>
					<span><input type="text" class="search rounded" placeholder="Find A Contract..." onkeyup="showContract(this.value)"></span>
				</form>
			</div>
		</div>
		<div id = "searchResults" ></div>
		<?php
		while($row = mysql_fetch_array($result))
		{ ?>
		<div id="contract">
			<ul>
				<li>
					<span style="color:#670000">Contract id :</span> <?php echo $row['contractId'];?> 
					<span style="color:#670000">Participating Party :</span> <?php echo $row['firstName'];?> <?php echo $row['lastName'];?> 
					<span style="color:#670000">Date Drafted :</span> <?php echo $row['dateDrafted'];?> 
					<span style="color:#670000">Status:</span> <?php echo $row['status'];?> &nbsp 
					<?php if ($row['status'] != "accepted"){ ?>		
					<a href="#" onclick="toggleContract('<?php echo $row["contractId"].'c'?>');"><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
					<?php } else echo $row["dateConfirmed"]; ?>
				</li>
			</ul>
		</div>
		<!--clause list-->
		<div id="<?php echo $row['contractId'].'c';?>" class="clauses">
			<?php
			$cid = $row['contractId'];
			$result1 = mysql_query("Select * FROM tblcustomclause WHERE contract = '$cid'");
			while($row1 = mysql_fetch_array($result1)) 
			{ ?>
				<ul>
					<li>
						<span style="color:#670000"><?php echo $row1['title'];?></span> &nbsp 
						<a href="#" onclick="toggleClause('<?php echo $row1["clauseId"].'cl'?>');" ><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
						<?php if ($row1["dateUpdated"] != ""){?>
						<span style="color:#670000; float:right"> Updated on: <?php echo $row1["dateUpdated"];?></span> &nbsp 
						<?php } ?>
					</li>
				</ul>
					<!--clause info-->
					<div id="<?php echo $row1['clauseId'].'cl';?>" class="clInfo">
						<?php
						$clid = $row1['clauseId'];
						$result2 = mysql_query("Select * FROM tblcustomclause WHERE clauseId = '$clid'");
						while($row2 = mysql_fetch_array($result2)) 
						{ ?>
						<ul>
							<li>
								<pre><span style="color:#000"><?php echo $row2['clause'];?></span></pre>
							</li>
						</ul>
						<?php 
						} ?>
							<!--clause comments-->
							<div class="comments">
								<h5 style="color:#670000; padding-left:35px">Comments</h5>
								<ol  id="update<?php echo $row1["clauseId"]?>" class="timeline">
										<?php
										//values from comment table
										$result3 = mysql_query("SELECT * FROM tblclcomment c, tbluser u WHERE u.userid = c.commenter AND c.clause='$clid' ORDER BY CLCommentid DESC");
										while($row3 = mysql_fetch_array($result3))
										{
										?>
										<li id = "l<?php echo $row1["clauseId"]?>" class="box">
										<?php echo $row3["firstName"]?> <?php echo $row3["lastName"]?> states <?php echo $row3["ClComment"]?>
										<?php
										if ($row3["agree"] == 1)
										{
										?>
										<img src = "images/agree.png" width="20px" height ="20px"/>
										<?php }else{ ?>
										<img src = "images/disagree.png" width="20px" height ="20px"/>
										<?php } ?>
										</li>
										<?php
										}
										?>
								</ol>
										
								<div id="flash" align="left"  ></div>
										
								<div style="margin-left:220px">
									<div class ='form'>
									<input type="hidden" name="cl_id" id="cl_id<?php echo $row1["clauseId"]?>" value="<?php echo $clid; ?>"/>
									<input type="radio" name="agree<?php echo $row1["clauseId"]?>" id="agree<?php echo $row1["clauseId"]?>" value = "1"></input>
									<label><img src = "images/agree.png" width="20px" height ="20px"/></label>
									&emsp;
									<input type="radio" name="agree<?php echo $row1["clauseId"]?>" id ="dagree<?php echo $row1["clauseId"]?>" value = "2"></input>
									<label><img src = "images/disagree.png" width="20px" height ="20px"/></label> <br/>
									<textarea name="comment<?php echo $row1["clauseId"]?>" id="comment<?php echo $row1["clauseId"]?>"></textarea><br />
									<input type="submit" class = "submit" onClick="$(this).addComment('<?php echo $row1["clauseId"]?>');" value="Submit Comment " />
									</div>
								</div>
							</div>
					</div>
		<?php 
			} ?>
		</div>
		<?php 
		}
		?>
		<center><?=$pagination?></center>
		<a  href="processing/logout.php"><b>LOG OUT</b></a>
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>
