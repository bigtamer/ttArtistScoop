<?php
session_start();

if(isset($_SESSION['userid']) && isset($_GET['c']) && isset($_SESSION['userType']))
{	
$con = $_GET['c'];

$con = addslashes (trim($con));

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT drafter FROM tblcontract WHERE contractId = '$con' AND drafter = '$utest'");
$count = mysql_num_rows($result);

$sql = "DELETE FROM `tblcontract` WHERE contractId = '$con'";

$sql2 = "DELETE FROM `tblcustomclause` WHERE `contract` = '$con'";

$sql3 = "DELETE FROM `tblclcomment` WHERE clause IN (SELECT clauseid FROM tblcustomclause WHERE contract = '$con')";
		
if( $con!=''&& $count != 0)
	{
	$_SESSION['error'] = 'Contract Deleted';
	mysql_query($sql3);
	mysql_query($sql2);
	mysql_query($sql);
	header("Location: ../label_home.php");
	}else{
			$_SESSION['error'] = 'try again';
			header("Location: ../label_home.php");
			}

}else{
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../home.php");
		}