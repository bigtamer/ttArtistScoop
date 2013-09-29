<?php 
session_start();

$r=$_GET["r"];

$r= addslashes (trim($r));

include"../include/dbConnect.php";

$sqlsearch = "SELECT * FROM tbluser u, tblartist a WHERE u.userid = a.artistid and a.stageName LIKE '%$r%' LIMIT 0, 10";

$rsearch = mysql_query($sqlsearch);

$sc = mysql_num_rows($rsearch);

$pro = "getMusic.php?u=";
$pic = "images/profiles/";
$w = "60px";
$h = "60px";

while($srow = mysql_fetch_array($rsearch))
  {
  echo '<li><a href="'.$pro.$srow["userid"].'"><img src="'.$pic.$srow["profilePhoto"].'" width="'.$w.'" height="'.$h.'"/></a>&nbsp &nbsp<a href="'.$pro.$srow["userid"].'">'.$srow["stageName"].'</a> <br/></li>';
  }  
 
if($sc == 0)
{
echo 'No Suggestions Available';
}
 
 

  
mysql_close($connection);
?> 