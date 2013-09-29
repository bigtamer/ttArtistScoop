<?php
session_start();

if(isset($_SESSION['userid']) && isset($_GET['s']) && isset($_SESSION['userType']))
{	
$s = $_GET['s'];
$s = addslashes (trim($s));

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT uploader FROM tblsample WHERE sampleId = '$s' AND uploader = '$utest'");
$count = mysql_num_rows($result);


$sql = "DELETE FROM `tblsample` WHERE sampleId = '$s'";

$sql2 = "DELETE FROM `tblscomment` WHERE sample = '$s'";
		
if( $s!='' && $count !=0)
	{
	$_SESSION['error'] = 'Sample Deleted';
	mysql_query($sql2);
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
?>