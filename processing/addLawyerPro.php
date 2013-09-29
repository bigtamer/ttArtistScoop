<?php 
session_start();

if(isset($_SESSION['userid']))
{
$uid = $_SESSION['userid'];
$email = $_POST['lawyer'];

$email = addslashes (trim($email));
$md5email= md5($email);
$password = rand();
$link = "http://localhost/ttArtistScoop/lawyerlogin.php?con=1";
$link = $link."&i=".$md5email."&t=".$email;

include"../include/dbConnect.php";

$sql = "Select * from tbluser where userid = '$uid'";
$result = mysql_query($sql);

$sql1 = "INSERT INTO `tbllawyer`(`lawyerId`, `client`, `userType`, `email`, `password`, `status`) VALUES (NULL,'$uid', '4', '$email', '$password','0')";

while($row = mysql_fetch_assoc($result))
{
	if ($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$uname = $row["firstName"];
		mysql_query($sql1);
		$to = $email;
		$subject = "Yuor client $uname wishes to have you critique his contracts";
		$message = "Good day please proceed to <a href=$link>laywer's login page</a> to login use your email address and $password as password";
		$from = "test@carex.com";
		$headers = "From:" .$from. "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$message,$headers);
		$_SESSION['error'] = 'Email notification sent to lawyer';
		header("Location: ../home.php");
	}else{
		$_SESSION['error'] = 'invalid email';
		header("Location: ../home.php");	
			}
}
											
}else { 
		header("Location: ../registration.php");	
		}								
?>