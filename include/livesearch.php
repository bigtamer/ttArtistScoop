<?php 
session_start();

$q=$_GET["q"];

$q= addslashes (trim($q));

include"../include/dbConnect.php";

$sql = "SELECT * FROM tbluser u, tblartist a WHERE u.userid = a.artistid and a.stageName LIKE '%$q%' LIMIT 0, 10";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
	$pro = "artist_profile.php?";
	$sn = $row["stageName"];
	$u = $row["userid"];
  {
  echo "Checkout ".$sn."'s &nbsp<a href=".$pro.$u.">profile</a>";
  }
  
mysql_close($connection);
?> 