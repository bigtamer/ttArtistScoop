<?php
session_start(); 

if (isset($_GET["con"]) && isset($_GET["i"]) && isset($_GET["t"]))
{
	$active = $_GET['con'];
	$user = $_GET['i'];
	$email = $_GET['t'];

	$active = addslashes (trim($active));
	$user = addslashes (trim($user));
	$email = addslashes (trim($email));

	include"include/dbconnect.php";

	$sql1="Select email from tbluser where email = '$email'";
	$result = mysql_query($sql1);
	$count=mysql_num_rows($result);
	if ($count > 0){
		$row=mysql_fetch_array($result);
		$sEmail = $row['email'];
		if(md5($sEmail) == $user){
		$sql="UPDATE tbluser set active=$active where email ='$email';";
		mysql_query($sql);
		}else{
			$_SESSION['error'] = 'sorry you are not permitted to enter this section';
			header("Location:registration.php");
			}
	}
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
	<link href="css/loginStyle.css" rel="stylesheet" type="text/css" media="all"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script>
	
jQuery(function($){
		   
	// simple jQuery validation script
	$('#login').submit(function(){
		
		var valid = true;
		var errormsg = 'This field is required!';
		var errorcn = 'error';
		
		$('.' + errorcn, this).remove();			
		
		$('.required', this).each(function(){
			var parent = $(this).parent();
			if( $(this).val() == '' ){
				var msg = $(this).attr('title');
				msg = (msg != '') ? msg : errormsg;
				$('<span class="'+ errorcn +'">'+ msg +'</span>')
					.appendTo(parent)
					.fadeIn('fast')
					.click(function(){ $(this).remove(); })
				valid = false;
			};
		});
		
		return valid;
	});
	
})



</script>
</head>
<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		
		<div id="content">
		
			<form id="login" method="post" action="processing/loginPro.php"> 

				<div>
					<label for="login_username">Email</label> 
					<input autocomplete="off" type="text" name="email" id="login_username" class="field required" title="please enter email address" />
				</div>			

				<div>
					<label for="login_password">Password</label>
					<input autocomplete="off" type="password" name="password" id="login_password" class="field required" title="Password is required" />
				</div>			
							
				<div class="submit">
					<button type="submit">Log in</button> 
					<?php if(isset($_SESSION['error']))
						{
						echo($_SESSION['error']);
						$_SESSION['error']='';
						}
					?>    
				</div>
	
				<p class="back">Not a member? <a href="registration.php">Register here!</a></p>
			  
			</form>	
				
		</div>
	
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>