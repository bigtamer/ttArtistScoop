<?php
session_start(); 
include "../include/dbConnect.php";
if($_GET)
{
$artist=$_GET['q'];

$result = mysql_query("SELECT u.firstName AS uname, u.lastName AS lname FROM tbluser u, tblartist a WHERE u.userid = a.artistid AND u.email = '$artist'");


if ($row = mysql_fetch_assoc($result));
	{
		echo $row['uname']." &nbsp ".$row['lname']; 
	}
}
mysql_close($connection);
?>