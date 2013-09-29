<?php
session_start(); 
include "../include/dbConnect.php";
if($_POST && isset($_SESSION['userid']))
{
$date= date("Y-m-d");
$uid = $_SESSION['userid'];
$comment_dis=$_POST['comment'];
$cl_id=$_POST['cl_id'];

$comment_dis = addslashes (trim($comment_dis));
  
mysql_query("UPDATE `tblcustomclause` SET `clause`= '$comment_dis',`dateUpdated` = '$date' WHERE clauseId = '$cl_id'");

}

mysql_close($connection);
?>