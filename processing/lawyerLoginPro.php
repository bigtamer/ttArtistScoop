<?php 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$email = trim($email);
$password = trim($password);

include"../include/dbConnect.php";

$sql="SELECT * FROM tbllawyer WHERE email='$email' AND password='$password' AND status=1;";

$resultset = mysql_query($sql);

$numrows = mysql_num_rows($resultset);

if($numrows > 0){	
	$row = mysql_fetch_array($resultset);
	
	$_SESSION['email'] 	= $row['email'];
	$_SESSION['client'] 	= $row['client'];
	$_SESSION['lawyerId'] 	= $row['lawyerId'];
	$_SESSION['userType'] 	= $row['userType'];
	$_SESSION['error'] 		= '';
	$_SESSION['success'] 	= '';
	
	if($row['userType'] == 4){
		
		header("Location: ../lawyer_home.php");
	}else{
		$_SESSION['error'] = "Invalid Username and or Password";
		header("Location: ../lawyerlogin.php");
		}

}else{
		$_SESSION['error'] = "Account not activated";
		header("Location: ../lawyerlogin.php");	
		}
?>