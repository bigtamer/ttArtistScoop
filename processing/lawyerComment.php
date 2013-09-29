<?php
session_start(); 
include "../include/dbConnect.php";
if($_POST && isset($_SESSION['lawyerId']))
{
$uid = $_SESSION['lawyerId'];
$comment_dis=$_POST['comment'];
$cl_id=$_POST['cl_id'];
$agree=$_POST['agree'];

mysql_query("INSERT INTO `tblcritique`(`critiqueId`, `lawyer`, `clause`, `comment`, `agree`) VALUES (NULL,'$uid','$cl_id','$comment_dis', '$agree')");

$lresult = mysql_query("SELECT MAX(critiqueId) AS CID FROM tblcritique WHERE lawyer = '$uid'");

while ($lrow = mysql_fetch_assoc($lresult));
	{
	?>
	<span ><?php echo $comment_dis ?></span> <span><a href="<?php echo $lrow["CID"]; ?>" onclick="deleteComment()"> Delete </a></span><br/>
	<?php 
	}

}
else { ?>
	 <a href="registration.php">Register</a>to leave a comment 
<?php
	}
mysql_close($connection);
?>