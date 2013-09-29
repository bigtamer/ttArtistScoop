<?php 
session_start();

$q=$_GET["q"];

$q= addslashes (trim($q));

include"../include/dbConnect.php";

$sql = "SELECT * FROM tbluser u, tblartist a WHERE u.userid = a.artistid and u.userid = '$q'";

$result = mysql_query($sql);

$pic = "images/profiles/";
$w = "60px";
$h = "60px";
$pro = "getMusic.php?u=";
while($row = mysql_fetch_assoc($result))

  {
  echo "Name: ".$row['firstName']."<br/><br/>";
  echo "Stage Name: ".$row['stageName']."<br/><br/>";
  echo "Prefered Genre: ".$row['preferedGenre']."<br/><br/>";
  echo "Checkout artist's profile &nbsp<a href=".$pro.$q.">here</a>";
  }
  
mysql_close($connection);
?> 