<?php
session_start();

if(isset($_SESSION['userid']) && isset($_GET['c']) && isset($_SESSION['userType']))
{	
$c = $_GET['c'];

$c = addslashes (trim($c));

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT client FROM tbllawyer WHERE lawyerId = '$c' AND client = '$utest'");
$count = mysql_num_rows($result);

$sql = "DELETE FROM `tbllawyer` WHERE lawyerId = '$c'";

$sql2 = "DELETE FROM `tblcritique` WHERE lawyer = '$c'";
		
if( $c!=''&& $count != 0)
	{
	$_SESSION['error'] = 'Lawyer Removed';
	mysql_query($sql2);
	mysql_query($sql);
	header("Location: ../home.php");
	}else{
			$_SESSION['error'] = 'try again';
			header("Location: ../home.php");
			}

}else{
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../home.php");
		}