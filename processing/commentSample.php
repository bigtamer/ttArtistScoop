<?php
session_start(); 
include "../include/dbConnect.php";
if($_POST && isset($_SESSION['userid']))
{
$uid = $_SESSION['userid'];
$comment_dis=$_POST['comment'];
$sample_id=$_POST['sample_id'];
  
mysql_query("INSERT INTO `tblscomment`(`SCommentid`, `SComment`, `commenter`, `sample`, `dateposted`) VALUES (NULL,'$comment_dis','$uid','$sample_id',CURRENT_TIMESTAMP)");

$result = mysql_query("SELECT MAX(c.SCommentId) AS SID, a.ProfilePhoto AS pf from tbluser u, tblartist a, tblscomment c WHERE u.userid = a.artistid and u.userid = c.commenter AND u.userid = '$uid'");

while ($row = mysql_fetch_row($result));
	{
	$sid = $row["SID"];
	?>
	<li class="box">
	<span >Your comment: <?php echo $comment_dis ?></span>
	</li>
	<?php 
	}

}
else { ?>
	 <a href="registration.php">Register</a> to leave a comment 
<?php
	}
mysql_close($connection);
?>