<?php
session_start();

if(isset($_SESSION['userid']))
{	
$s = $_GET['s'];

$s = addslashes (trim($s));

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT commenter FROM tblscomment WHERE SCommentid = '$s' AND commenter = '$utest'");
$count = mysql_num_rows($result);


$sql = "DELETE FROM `tblscomment` WHERE SCommentid = '$s'";
		
if( $s!='' && $count != 0)
	{
	$_SESSION['error'] = 'Comment Deleted';
	mysql_query($sql);
	header("Location: ../getMusic.php");
	}else{
			$_SESSION['error'] = 'try again';
			header("Location: ../getMusic.php");
			}

}else{
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../home.php");
		}