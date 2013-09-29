<?php 
session_start();

$c=$_GET["c"];

$c= addslashes (trim($c));

if(isset($_SESSION['lawyerId']) && $_SESSION['client'])
{			
	include"../include/dbConnect.php";
	
	$uid = $_SESSION['client'];
	
	$consql = "Select userType from tbluser where userid = '$uid'";
	$conresults = mysql_query($consql);
	
	while ($conrow = mysql_fetch_assoc($conresults))
	{
		$clType = $conrow["userType"]; 
	}

if($clType == 2)
	{
	$sqlsearch = "SELECT * FROM tblcontract d, tbluser u WHERE Drafter = '$uid' AND d.participant = u.userid and contractId LIKE '%$c%' LIMIT 0, 5";
	$rsearch = mysql_query($sqlsearch);
	$sc = mysql_num_rows($rsearch);
	}else {
			$sqlsearch = "SELECT * FROM tblcontract d, tbluser u WHERE participant = '$uid' AND d.Drafter = u.userid and contractId LIKE '%$c%' LIMIT 0, 5";
			$rsearch = mysql_query($sqlsearch);
			$sc = mysql_num_rows($rsearch);
			}

while($srow = mysql_fetch_array($rsearch))
  {
?>	
		<div id="contract">
			<ul>
				<li>
					<span style="color:#670000">Contract id :</span> <?php echo $srow['contractId'];?> 
					<span style="color:#670000">Participating Party :</span> <?php echo $srow['firstName'];?> <?php echo $srow['lastName'];?> 
					<span style="color:#670000">Date Drafted :</span> <?php echo $srow['dateDrafted'];?> 
					<span style="color:#670000">Status:</span> <?php echo $srow['status'];?> &nbsp 
					<?php if ($srow['status'] != "accepted"){ ?>		
					<a href="#" onclick="toggleContract('<?php echo $srow["contractId"].'a'?>');"><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
					<?php } else echo $srow["dateConfirmed"]; ?>
				</li>
			</ul>
		</div>
		<!--clause list-->
		<div id="<?php echo $srow['contractId'].'a';?>" class="clauses">
			<?php
			$cid = $srow['contractId'];
			$result1 = mysql_query("Select * FROM tblcustomclause WHERE contract = '$cid'");
			while($row1 = mysql_fetch_array($result1)) 
			{ ?>
				<ul>
					<li>
						<span style="color:#670000"><?php echo $row1['title'];?></span> &nbsp 
						<a href="#" onclick="toggleClause('<?php echo $row1["clauseId"].'b'?>');" ><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
						<?php if ($row1["dateUpdated"] != ""){?>
						<span style="color:#670000; float:right"> Updated on: <?php echo $row1["dateUpdated"];?></span> &nbsp 
						<?php } ?>
					</li>
				</ul>
					<!--clause info-->
					<div id="<?php echo $row1['clauseId'].'b'?>" class="clInfo">
						<?php
						$clid = $row1['clauseId'];
						$result2 = mysql_query("Select * FROM tblcustomclause WHERE clauseId = '$clid'");
						while($row2 = mysql_fetch_array($result2)) 
						{ ?>
						<ul>
							<li>
								<span style="color:#670000"><?php echo $row1['title'];?></span> &nbsp 
								<a href="#" onclick="toggleClause('<?php echo $row1["clauseId"]?>');" ><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
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
	} ?>
	<h5>Search Results....<img src="images/uparrow.gif" width = "60px" height = "30px"/></h5>
<?php
}
if($sc == 0)
{
echo 'No Suggestions Available';
}  
mysql_close($connection);
?> 