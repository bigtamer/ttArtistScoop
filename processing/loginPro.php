<?php 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$email = trim($email);
$password = md5(trim($password));

include"../include/dbconnect.php";

$sql="SELECT * FROM tbluser WHERE email='$email' AND password='$password' AND active=1;";

$resultset = mysql_query($sql);

$numrows = mysql_num_rows($resultset);

if($numrows > 0){	
	$row = mysql_fetch_array($resultset);
	
	$_SESSION['email'] 	= $row['email'];
	$_SESSION['fname'] 	= $row['firstName'];
	$_SESSION['userType'] 	= $row['userType'];
	$_SESSION['userid'] 	= $row['userid'];
	$_SESSION['error'] 		= '';
	$_SESSION['success'] 	= '';
	
	if($row['userType'] == 2){
		
		header("Location: ../label_home.php");
	}else if($row['userType'] == 3){
	
		header("Location: ../getMusic.php");
	}	
}else{
	$_SESSION['error'] 		= "Invalid Username and or Password";
	header("Location: ../login.php");
	}

	
?>