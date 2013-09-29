<?php 
session_start();

if(isset($_SESSION['userid']))
{						
$uid = $_SESSION['userid'];
$DOB = $_POST['DOB'];
$bio = $_POST['bio'];
$sname = $_POST['sname'];
$genre = $_POST['genre'];
$interest = $_POST['interest'];
$experience = $_POST['experience'];

$DOB = addslashes (trim($DOB));
$bio = addslashes (trim($bio));
$sname = addslashes (trim($sname));
$genre = addslashes (trim($genre));
$interest = addslashes (trim($interest));
$experience = addslashes (trim($experience));

// Step 3 - Create your database server connection & db
include"../include/dbConnect.php";

$sql =("UPDATE `tblartist` SET `DOB`='$DOB',`bio`='$bio',`stageName`='$sname',`preferedGenre`='$genre',`interest`='$interest',`experience`='$experience' WHERE artistId = '$uid'");
		
mysql_query($sql);

$_SESSION['error'] = 'Information editted successfully check out how others see you <a href = "getMusic.php?u='.$uid.'">here</a>';
header("Location: ../aProfile.php");
}
?>