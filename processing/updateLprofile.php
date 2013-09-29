<?php 
session_start();

if(isset($_SESSION['userid']))
{			

// Step 3 - Create your database server connection & db
include"../include/dbConnect.php";
			
$uid = $_SESSION['userid'];
$cname = $_POST['cname'];
$ccontact = $_POST['ccontact'];
$cemail = $_POST['cemail'];
$address = $_POST['address'];

$cname = addslashes (trim($cname));
$ccontact = addslashes (trim($ccontact));
$cemail = addslashes (trim($cemail));
$address = addslashes (trim($address));

$sql =("UPDATE `tbllabel` SET `address`='$address',`companyName`='$cname',`companyContact`='$ccontact',`companyEmail`='$cemail' WHERE labelId = '$uid'");
mysql_query($sql);

$_SESSION['error'] = 'Information editted successfully';
header("Location: ../lProfile.php");
}
?>