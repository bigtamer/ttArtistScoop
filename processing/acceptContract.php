<?php 
session_start();

if(isset($_SESSION['userid']))
{
$date= date("Y-m-d");
$cid = $_GET['c'];
$drafter = $_GET['d'];
$link = "http://localhost/ttArtistScoop/login.php";

include"../include/dbConnect.php";

//permissions 
$utest = $_SESSION['userid'];
$result = mysql_query("SELECT participant FROM tblcontract WHERE contractId = '$cid' AND participant = '$utest'");
$count = mysql_num_rows($result);

$sql = "Select email from tbluser where userid = '$drafter'";
$result = mysql_query($sql);

$sql1 = "UPDATE `tblcontract` SET `status`= 'accepted',`dateConfirmed`= '$date' WHERE contractId = '$cid'";

	if( $cid!=''&& $count != 0)
	{

		while($row = mysql_fetch_assoc($result))
		{
		$email = $row["email"];
		mysql_query($sql1);
		$to = $email;
		$subject = "Artist has accepted the terms of contract $cid";
		$message = "Hey the terms of contract $cid has been accepted <a href=$link> login </a> to finalize";
		$from = "test@carex.com";
		$headers = "From:" .$from. "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$message,$headers);
		$_SESSION['error'] = 'Email notification sent to label';
		header("Location: ../getMusic.php");										
		}

	}else{
		$_SESSION['error'] = 'try again';
		header("Location: ../home.php");
		}
											
}else { 
		header("Location: ../registration.php");	
		}								
?>