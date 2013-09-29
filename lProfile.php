<?php 
session_start(); 
include "include/securitytest.php";

if(isset($_SESSION['userid']) && isset($_SESSION['userType']))
{
$uid = $_SESSION['userid'];

$ut = $_SESSION['userType'];
if ($ut != 2)
{
header("Location: home.php");
}

include "include/dbConnect.php";

} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	
	<title>template</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/label_content.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		<?php include "include/labelNav.php";?>
		
		<div id="content">
			<?php 
			$presult = mysql_query("SELECT * FROM tbluser u, tbllabel l WHERE u.userid=l.labelId and u.userid = '$uid';");
			while($row1 = mysql_fetch_array($presult))
			{ ?>
			<div id="profile">
				<form method="POST" action="processing/updateLprofile.php">
					<label >Company Name</label><br/><input   type="text" id="cname" name="cname"  value = "<?php echo $row1['companyName'];?>" ></input><br/><br/>
					<label >Company Contact</label><br/><input   type="text" id="ccontact" name="ccontact" value = "<?php echo $row1['companyContact'];?>" ></input><br/><br/>
					<label >Company Email</label><br/><input   type="text" id="cemail" name="cemail" value = "<?php echo $row1['companyEmail'];?>" ></input><br/><br/>
					<label >Address</label><br/><textarea name="address" ><?php echo $row1['address'];?></textarea><br/><br/>
					<input type="submit" value = "submit changes"/><br/>
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