<?php
session_start();

if(isset($_SESSION['userid']))
{	
$date= time();
$genre = $_POST['genre'];
$url = $_POST['url'];
$uid = $_SESSION['userid'];
$title = $_POST['title'];
$desc = $_POST['desc'];

$url = addslashes (trim($url));
$genre = addslashes (trim($genre));
$title = addslashes (trim($title));
$desc = addslashes (trim($desc));

include"../include/dbConnect.php";

$sql = "INSERT INTO `tblsample`(`sampleId`, `genre`, `uploader`, `title`, `description`, `featured`, `dateadded`, `url`) 
		VALUES (NULL,'$genre','$uid','$title','$desc','0',CURRENT_TIMESTAMP,'$url');";
		
if( $url!='')
	{
	$_SESSION['error'] = 'Music Ref added sucessfully';
	
	$resultset = mysql_query($sql);
	header("Location: ../getMusic.php");
	
	}else{
			$_SESSION['error'] = 'Invalid Url';
			header("Location: ../getMusic.php");
			}

}

?> 