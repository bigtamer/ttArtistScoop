<?php
session_start();

if(isset($_SESSION['userid']) && isset($_SESSION['userType']))
{	
$s = $_GET['s'];
$ut = $_SESSION['userType'];

$s = addslashes (trim($s));

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT commenter FROM tblclcomment WHERE ClCommentid = '$s' AND commenter = '$utest'");
$count = mysql_num_rows($result);

$sql = "DELETE FROM `tblclcomment` WHERE ClCommentid = '$s'";
		
if( $s!=''&& $count != 0)
	{
	$_SESSION['error'] = 'Comment Deleted';
	mysql_query($sql);
		if ($ut == 2)
		{
		header("Location: ../label_home.php");
		}else {
				header("Location: ../artistContracts.php");
				}
	}else{
			$_SESSION['error'] = 'try again';
			if ($ut == 2)
				{
				header("Location: ../label_home.php");
				}else {
						header("Location: ../artistContracts.php");
						}
			}

}else{
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../home.php");
		}