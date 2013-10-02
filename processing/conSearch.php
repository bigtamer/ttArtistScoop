<?php 
session_start();

$c=$_GET["c"];

$c= addslashes (trim($c));

if(isset($_SESSION['userid']))
{			
	$uid = $_SESSION['userid'];

include"../include/dbConnect.php";

$sqlsearch = "SELECT * FROM tblcontract d, tbluser u WHERE Drafter = '$uid' AND d.participant = u.userid and contractId LIKE '%$c%' LIMIT 0, 5";

$rsearch = mysql_query($sqlsearch);

$sc = mysql_num_rows($rsearch);

while($srow = mysql_fetch_array($rsearch))
  {
?>	
		<div id="contract">
			<ul>
				<li>
					<span style="color:#670000">id :</span> <?php echo $srow['contractId'];?> 
					<span style="color:#670000">Participating Party :</span> <?php echo $srow['firstName'];?> <?php echo $srow['lastName'];?> 
					<span style="color:#670000">Date Drafted :</span> <?php echo $srow['dateDrafted'];?> 
					<span style="color:#670000">Status:</span> <?php echo $srow['status'];?> &nbsp 
					<?php if ($srow['status'] != "accepted"){ ?>	
						<a href="#" onclick="toggleContract('<?php echo $srow["contractId"].'a'?>');">
							<img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
						<a onclick="return confirm('Are you sure you want to delete?')" href="processing/deleteContract.php?c=<?php echo $srow['contractId'];?>">
							<img src="images/delete.png" width="20px" height="20px"/></a>
					<?php } else 
						  echo $srow["dateConfirmed"]." &nbsp <a href ='pdf/Contract/Contract.php?c=".$srow['contractId']."' target='_blank'>Build</a>"; 
				    ?>
				</li>
			</ul>
		</div>
		<!--clause list-->
		<div id="<?php echo $srow['contractId'].'a';?>" class="clauses">
			<?php
			if ($srow['status'] != "accepted"){
			$cid = $srow['contractId'];
			$result1 = mysql_query("Select * FROM tblcustomclause WHERE contract = '$cid'");
			while($row1 = mysql_fetch_array($result1)) 
			{ ?>
				<ul>
					<li>
						<span style="color:#670000"><?php echo $row1['title'];?></span> &nbsp 
						<a href="#" onclick="toggleClause('<?php echo $row1["clauseId"].'b'?>');" ><img src="images/view.png" width="20px" height="20px"/></a> &nbsp 
						<?php 	$clid = $row1['clauseId']; 
								$rs = mysql_query("SELECT * FROM tblcritique t, tbllawyer l WHERE t.lawyer = l.lawyerId AND clause = '$clid' AND l.client = '$uid' ORDER BY critiqueId DESC LIMIT 0, 5"); 
								$count=mysql_num_rows($rs); 
								if ($count != 0) 
								{ 
								?>
									<img src="images/lcom.gif" class="tooltip" width="20px" height="20px" title = "<?php for($i=0; $i<$count; $i++){ $row=mysql_fetch_array($rs); echo $row["comment"]."<br/>";	 }?>"/>
								<?php } ?>
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
								<pre><span style="color:#000">
									<div class='inline-edit' style='border: none;'>
										<div class='display'><?php echo $row1['clause'];?></span></div>
										<div class='form'>
											<textarea class='text' id = 'text<?php echo $row1["clauseId"]?>'></textarea><br/>
											<input type = 'hidden' id = 'clid<?php echo $row1["clauseId"]?>' value = '<?php echo $row1["clauseId"]?>'/>
											<input type='submit' class='save'  onClick="$(this).editClause('<?php echo $row1["clauseId"]?>');"  value='Save'/> &nbsp <input type='submit' class='cancel' value=' Cancel ' />
										</div>
									</div>
								</pre>
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
										$result3 = mysql_query("SELECT * FROM tblclcomment c, tbluser u WHERE u.userid = c.commenter AND c.clause='$clid' ORDER BY CLCommentid DESC ");
										while($row3 = mysql_fetch_array($result3))
										{
										?>
										<li id = "l<?php echo $row1["clauseId"]?>" class="box">
											<?php 
											if (isset($_SESSION["userid"])){
												$comm = $_SESSION["userid"];
												if ($comm == $row3["commenter"]) {
											?>
											<a onclick="return confirm('Are you sure you want to delete?')" style="float:right; margin-right:15px" href="processing/deleteCcomment.php?s=<?php echo $row3['ClCommentid'];?>"><img src="images/delete.png" width="10px" height="10px"/></a>
											<?php } } ?>
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
			} 
		}	
			?>
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