<?php 
session_start(); 
include "include/securitytest.php";

include "include/dbConnect.php";

if(isset($_SESSION['userid']) && isset($_SESSION['userType']))
{						
	$uid = $_SESSION['userid'];
	
	$ut = $_SESSION['userType'];
	if ($ut != 3)
	{
	header("Location: home.php");
	}

	//get artist info 
	$sql1 = "SELECT * FROM tbluser u, tblartist a WHERE u.userid=a.artistId and u.userid = '$uid';";

	$resultset1 = mysql_query($sql1);

	$count1=mysql_num_rows($resultset1);
	
	//get genres
	$sql = "SELECT * FROM tblgenre";

	$resultset = mysql_query($sql);

	$count=mysql_num_rows($resultset);
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">

	<title>Artist Home</title>
		
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/artist_content.css" rel="stylesheet" type="text/css" media="all"/>
	<script type="text/javascript" src="js/addSample.js"></script>
</head>

<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		
		<div id="content">
			<?php include "include/artistNav.php";?>
			<div id="aContent">
			<?php include "include/addUrl.php";?>
			<?php 
			$presult = mysql_query("SELECT * FROM tbluser u, tblartist a, tblgenre g WHERE u.userid=a.artistId and g.genre = a.preferedGenre and u.userid = '$uid';");
			while($row1 = mysql_fetch_array($presult))
			{ ?>
			<div id="profile">
				<form method="POST" action="processing/updateAprofile.php">
					<label >Date Of Birth</label><input type="text" name ="DOB" value = "<?php echo $row1['DOB'];?>"/><br/><br/>
					<label >Bio</label><textarea name ="bio"><?php echo $row1['bio'];?></textarea><br/><br/>
					<label >Stage Name</label><input type="text" name ="sname" value = "<?php echo $row1['stageName'];?>"/><br/><br/>
					<label >Prefered Genre</label>
						<select name="genre" id="genre" > 
						<option value="<?php echo $row1['preferedGenre'];?>"><?php echo $row1['genre'];?></option>
						<?php
							for($i=0; $i<$count; $i++){
							$row=mysql_fetch_array($resultset);
						?>
						<option value="<?php echo $row['genre'];?>"><?php echo $row['genre'];?></option>
						<?php
							}
						?>	
						</select>
					<br/><br/>
					<label >Interest</label><input   type="text" id="interest" name="interest" value = "<?php echo $row1['interest'];?>" ></input><br/><br/>
					<label >Experience</label><input   type="text" id="experience" name="experience"  value = "<?php echo $row1['experience'];?>" ></input><br/><br/>
					<input type="submit" name ="submit" value = "Submit Changes"/>
					<?php if(isset($_SESSION['error']))
						{
						echo($_SESSION['error']);
						$_SESSION['error']='';
						}
					?>  
				</form>
			</div>
			<?php } ?>
		</div>
	
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>