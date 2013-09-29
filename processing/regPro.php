<?php 
session_start();

//All users
$date= time();
$utype = $_POST['user_type'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$sig = $_FILES["signature"]["name"];
if ($sig != "")
{
$sphoto = $email.'_'.$date.'_'.$sig;
}else $sphoto = "";

$profileYN = $_POST["company_name_toggle_group"];
$SigYN = $_POST["special_accommodations_toggle"];

$active = 0;
$md5email= md5($email);
$link = "http://localhost/ttArtistScoop/login.php?con=1";
$link= $link."&i=".$md5email."&t=".$email;


//artist info
$gender = $_POST['gender'];
$yr = $_POST['Yr'];
$mth = $_POST['Mth'];
$day = $_POST['Day'];
$DOB = $yr."/".$mth."/".$day;
$bio = $_POST['bio'];
$sname = $_POST['sname'];
$genre = $_POST['genre'];
$interest = $_POST['interest'];
$experience = $_POST['experience'];
$pPhoto = $_FILES["profilePic"]["name"];
if($pPhoto != "")
{
$photo = $email.'_'.$date.'_'.$pPhoto;
}else $photo = "";

//label info
$cname = $_POST['cname'];
$ccontact = $_POST['ccontact'];
$cemail = $_POST['cemail'];
$address = $_POST['address'];
$lPhoto = $_FILES["lhead"]["name"];
if ($lPhoto != "")
{
$lhead = $email.'_'.$date.'_'.$lPhoto;
}else $lhead = "";

// Step 2 - Trim, Encrypt (MD5), AddSlashes (Insert/Update Specific)
$utype = addslashes (trim($utype));
$fname = addslashes (trim($fname));
$lname = addslashes (trim($lname));
$email = addslashes (trim($email));
$password = md5 (addslashes (trim($password)));

$gender = addslashes (trim($gender));
$yr = addslashes (trim($yr));
$mth = addslashes (trim($mth));
$day = addslashes (trim($day));
$bio = addslashes (trim($bio));
$sname = addslashes (trim($sname));
$genre = addslashes (trim($genre));
$interest = addslashes (trim($interest));
$experience = addslashes (trim($experience));

$cname = addslashes (trim($cname));
$ccontact = addslashes (trim($ccontact));
$cemail = addslashes (trim($cemail));
$address = addslashes (trim($address));



// Step 3 - Create your database server connection & db
include"../include/dbConnect.php";



$sql1="SELECT * FROM tbluser where email='$email';";
$resultset1 = mysql_query($sql1);
$count = mysql_num_rows($resultset1);



		
if($count >0){	
			$row = mysql_fetch_array($resultset1);
			//checks to see if email address already exists
			$_SESSION['error'] = 'Your email already exist. Please sign up with a new email address';
			header("Location: ../registration.php");
			
			//checks for blanks
			}elseif($_POST['email']==""){
			 $_SESSION['bad4'] = 'ERROR: Email field was left blank!!';  
			header("Location: ../registration.php");
			
			//checks for valid email addresses eg text@text.com
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				 $_SESSION['bad3'] = 'ERROR: Not a Valid Email!!';  
				  header("Location: ../registration.php");
			
					
	

			}else
				{
				$to = $email;
				if ($utype == 3)
				{
					$sql2="INSERT INTO `tbluser`(`userid`, `firstName`, `lastName`, `email`, `password`, `dSigniture`, `userType`, `active`, `dateAdded`) 
							VALUES (NULL, '$fname', '$lname', '$email', '$password', '$sphoto', '3', '0', CURRENT_TIMESTAMP)";
					mysql_query($sql2);
					move_uploaded_file($_FILES["signature"]["tmp_name"],
					"../pdf/Contract/" . $sphoto);	
					if ($profileYN = 1)
					{
					$sql = "SELECT MAX(userid) AS uid FROM tbluser";
					$result = mysql_query($sql);
					$row=mysql_fetch_array($result);
					$uid = $row['uid'];
					$sql4="INSERT INTO `tblartist`(`artistId`, `gender`, `DOB`, `bio`, `stageName`, `preferedGenre`, `interest`, `experience`, `profilePhoto`, `featured`) 
							VALUES ('$uid', '$gender', '$DOB', '$bio', '$sname', '$genre', '$interest', '$experience', '$photo', '0');";
					mysql_query($sql4);
					move_uploaded_file($_FILES["profilePic"]["tmp_name"],
					"../images/profiles/" . $photo);
					}
					$subject = "Just a few steps left to become a registered Artist at TTAS";
					$message = "Hello $fname please proceed to:<a href=$link>login page</a> to confirm your registration";
					$from = "test@ttas.com";
					$headers = "From: " . $from. "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$message,$headers);
					$_SESSION['good1'] = 'Email address is a Valid Email! Please visit your email account for your confirmation link';  
					header("Location: ../home.php");
				}else{
						$sql5="INSERT INTO `tbluser`(`userid`, `firstName`, `lastName`, `email`, `password`, `dSigniture`, `userType`, `active`, `dateAdded`) 
								VALUES (NULL, '$fname', '$lname', '$email', '$password', '$sphoto', '2', '0', CURRENT_TIMESTAMP)";
						$resultset5 = mysql_query($sql5);
						move_uploaded_file($_FILES["signature"]["tmp_name"],
						"../pdf/Contract/" . $sphoto);	
						if ($profileYN = 1)
						{
						$sql = "SELECT MAX(userid) AS uid FROM tbluser";
						$result = mysql_query($sql);
						$row=mysql_fetch_array($result);
						$uid = $row['uid'];
						$sql6="INSERT INTO `tbllabel`(`labelId`, `address`, `companyName`, `companyContact`, `companyEmail`, `companyLetterHead`) 
								VALUES ('$uid', '$address', '$cname', '$ccontact','$cemail', '$lhead');";
						$resultset6 = mysql_query($sql6);
						move_uploaded_file($_FILES["lhead"]["tmp_name"],
						"../images/letterHeads/" . $lhead);
						}
						$subject = "Just a few steps left to become a registered Label at TTAS";		
						$message = "Hello $fname please proceed to:<a href=$link>login page</a> to confirm your registration";
						$from = "test@ttas.com";
						$headers = "From: " . $from. "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						mail($to,$subject,$message,$headers);
						$_SESSION['good1'] = 'Email address is a Valid Email! Please visit your email account for your confirmation link';  
						header("Location: ../home.php");										
					}
			}

?>