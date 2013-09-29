<?php 
include"dbConnect.php";
if(isset($_SESSION['userid']))
{
$uid = $_SESSION['userid'];
//if any lawyer for this user
$lsql = "select * from tbllawyer where client = '$uid'";
$lresult = mysql_query($lsql);
$lcount=mysql_num_rows($lresult);
}
?>
<div id="lnav">
		<li>
			<a href="lProfile.php">Profile</a>
		</li>
		<li>
			<a href="#">Draft Contract</a>
			<ul>
			<?php 
			$resultset = mysql_query( "SELECT * FROM tblctype;");
			while ($row = mysql_fetch_array($resultset))
				{ ?>
				<li><a href="contractDraft.php?c=<?php echo $row["cTypeId"]?>"><?php echo $row["cType"]?></a></li>
			<?php } ?>
			</ul>
		</li>
		<li>
			<a href="label_home.php">Contracts</a>
		</li>
		<li>
				<a href="#">My Lawyer</a>
				<ul class="sub-level">
					<?php if ($lcount == 0 ) { ?>
					<li><form method="post" action = "processing/addLawyerPro.php"><input type="text" name="lawyer" placeholder="lawyer email"/><input type="submit" value = "Add"/></form></li>
					<?php }else { $lrow = mysql_fetch_assoc($lresult); ?>
					<li><?php echo $lrow["email"];?><a onclick="return confirm('Are you sure you want to delete?')" href="processing/deleteLawyer.php?c=<?php echo $lrow['lawyerId'];?>"><img src="images/delete.png" width="15px" height="15px"/></a></li>
					<?php }?>
				</ul>
		</li>
</div>