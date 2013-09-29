<?php 
session_start();

include"../include/dbConnect.php";

$c=$_GET["c"];

$c= addslashes (trim($c));

if(!isset($_GET['u']))
{		
	$uid = $_SESSION['userid'];
}else if (isset($_GET['u']))
{
	$uid = $_GET['u'];
}

$sqlsearch = "SELECT * FROM tblSample WHERE uploader = '$uid' and title LIKE '%$c%' LIMIT 0, 5";

$rsearch = mysql_query($sqlsearch);

$sc = mysql_num_rows($rsearch);

while($srow = mysql_fetch_array($rsearch))
  {
  $img = str_replace("www.youtube.com/embed/", "img.youtube.com/vi/", $srow["url"]);
  $img = $img."/1.jpg";
?>	
	<div class="music">
			<div class="mImg">
				<a class="youtube" href="<?php echo $srow["url"]?>" title=""><img src="<?php echo $img ?>"/></a>
			</div>
			<div class="mInfo">
				<ul>
				<li>Title: &nbsp <?php echo $srow["title"]?></li>
				<li>Description: &nbsp <?php echo $srow["description"]?></li>
				<li><a href="#" onclick="toggleVisibility('<?php echo $srow["sampleId"]?>');">View/Add Comments</a><li>
				<li>
					<div id="<?php echo $srow["sampleId"]?>" class="section">
					
						<ol  id="update<?php echo $srow["sampleId"]?>" class="timeline">
							<div id="flash" align="left"  ></div>
								<?php
								$s = $srow["sampleId"];
								//$post_id value comes from the POSTS table
								$sqlsc=mysql_query("select * from tblscomment c, tblartist a WHERE a.artistId = c.commenter AND c.sample='$s' ORDER BY SCommentid DESC");
								while($rowsc=mysql_fetch_array($sqlsc))
								{
								?>
								<li class="box">
								<img src="images/profiles/<?php echo $rowsc["profilePhoto"]?>" class="com_img" width="75px" height="75px">
								<span class="com_name"><?php echo $rowsc["SComment"]?></span>
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
									<input type="hidden" name="sample_id" id="sample_id<?php echo $srow["sampleId"]; ?>" value="<?php echo $srow["sampleId"]; ?>"/>
									<textarea name="comment" id="comment<?php echo $srow["sampleId"]; ?>"></textarea><br />
									<input type="submit" class="submit" onClick="$(this).addCom('<?php echo $srow["sampleId"]?>');" value="Submit Comment " />
									</div>
								</div>
							</div>
							
			</div>
			<?php 
			if (isset($_GET["u"]) && isset($_SESSION['userid'])){
				if ($_GET["u"] == $_SESSION['userid'])
					{
					?>
					<a onclick="return confirm('Are you sure you want to delete?')" style="float:right; margin-right:15px; margin-top:15px" href="processing/deleteSample.php?s=<?php echo $srow['sampleId'];?>"><img src="images/delete.png" width="12px" height="12px"/></a>
					<?php 
					} 
				}
				?>
		</div>
<?php
	}
	if( $srow["sampleId"] == '0')
	{
	echo 'No Suggestions Available';
	}  
	mysql_close($connection);
?> 