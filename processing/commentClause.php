<?php
session_start(); 

include "../include/dbConnect.php";
if($_POST && isset($_SESSION['userid']))
{
$uid = $_SESSION['userid'];
$comment_dis=$_POST['comment'];
$cl_id=$_POST['cl_id'];
$agree=$_POST['agree'];

mysql_query("INSERT INTO `tblclcomment`(`ClCommentid`, `ClComment`, `commenter`, `clause`, `dateposted`, `agree`) VALUES (NULL,'$comment_dis','$uid','$cl_id',CURRENT_TIMESTAMP,'$agree')");

$result = mysql_query("SELECT MAX(c.ClCommentId) AS CID, u.firstName AS fn from tbluser u, tblclcomment c WHERE u.userid = c.commenter AND u.userid = '$uid'");

while ($row = mysql_fetch_assoc($result));
	{
	?>
	<?php echo $comment_dis ?><br/>
	<?php 
	}

}
else { ?>
	 <a href="registration.php">Register</a>to leave a comment 
<?php
	}
mysql_close($connection);
?>