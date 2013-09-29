<?php 
session_start();

include"../include/dbConnect.php";

$sql = "SELECT * FROM tblgenre";

$result = mysql_query($sql);

$genre = "genre";
$t = "text";
$d = "desc";
$s = "width:300px;";
$submit = "submit";
$ADD = "Add to my music";
 echo  "Description &nbsp <input type=".$t." name=".$d." style=".$s."/><br/>";
 echo "Genre <select name=".$genre." >";
while($row = mysql_fetch_array($result))
  {
  echo "<option value=".$row['genreId'].">".$row['genre']."</option>";
  }
  echo "</select>
		 <input type=".$submit." value=".$ADD."/>";
mysql_close($connection);
?> 