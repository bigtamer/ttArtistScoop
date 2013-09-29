<?php 
session_start();

if(isset($_SESSION['userid']))
{
	
	$ct = $_POST['ctype'];
	$artist = $_POST['artist'];
	$artist = addslashes (trim($artist));
		
	$uid = $_SESSION['userid'];
	
	include"../include/dbconnect.php";
	
	if ($ct == 1)//distribution contract has 6 clauses 
	{
	//clause contents
	$a = $_POST['1'];
	$b = $_POST['2'];
	$c = $_POST['3'];
	$d = $_POST['4'];
	$e = $_POST['5'];
	$f = $_POST['6'];

	$a = addslashes (trim($a));
	$b = addslashes (trim($b));
	$c = addslashes (trim($c));
	$d = addslashes (trim($d));
	$e = addslashes (trim($e));
	$f = addslashes (trim($f));
	
	//clause titles
	$ta = $_POST['title_1'];
	$tb = $_POST['title_2'];
	$tc = $_POST['title_3'];
	$td = $_POST['title_4'];
	$te = $_POST['title_5'];
	$tf = $_POST['title_6'];

	$ta = addslashes (trim($ta));
	$tb = addslashes (trim($tb));
	$tc = addslashes (trim($tc));
	$td = addslashes (trim($td));
	$te = addslashes (trim($te));
	$tf = addslashes (trim($tf));

	//get max contract id 
	$result1 = mysql_query("SELECT userid FROM tbluser WHERE email = '$artist'");
	$count = mysql_num_rows($result1);
	
		if ($count != 0)
		{
		$row1=mysql_fetch_assoc($result1);
		$pid = $row1["userid"];
		
		//add to contract info to contract table
		mysql_query("INSERT INTO `tblcontract`(`contractId`, `drafter`, `participant`, `Ctype`, `dateDrafted`, `status`, `dateConfirmed`) VALUES (NULL,'$uid','$pid','1',CURRENT_TIMESTAMP, 'pending', NULL)");
		
		
		//get max contract id 
		$result = mysql_query("SELECT MAX(contractId) AS cid FROM `tblcontract`");
		$row=mysql_fetch_assoc($result);
		$cid = $row["cid"];

		// add clauses to custom clause table 
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$ta','$a','1',CURRENT_TIMESTAMP, NULL)");
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$tb','$b','2',CURRENT_TIMESTAMP, NULL)");	
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$tc','$c','3',CURRENT_TIMESTAMP, NULL)");
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$td','$d','4',CURRENT_TIMESTAMP, NULL)");
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$te','$e','5',CURRENT_TIMESTAMP, NULL)");
		mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$tf','$f','6',CURRENT_TIMESTAMP, NULL)");
			
		$_SESSION['error'] 		= "Contract Added Sucessfully";
		header("Location: ../label_home.php");
		}else {
				$_SESSION['error'] = "Incorrect email";
				header("Location: ../contractDraft.php?c=".$ct."");
					}
					
	}else if ($ct == 2)//production contract has 5 clauses 
			{
			//clause contents
			$a = $_POST['1'];
			$b = $_POST['2'];
			$c = $_POST['3'];
			$d = $_POST['4'];
			$e = $_POST['5'];

			$a = addslashes (trim($a));
			$b = addslashes (trim($b));
			$c = addslashes (trim($c));
			$d = addslashes (trim($d));
			$e = addslashes (trim($e));
			
			//clause titles
			$ta = $_POST['title_1'];
			$tb = $_POST['title_2'];
			$tc = $_POST['title_3'];
			$td = $_POST['title_4'];
			$te = $_POST['title_5'];

			$ta = addslashes (trim($ta));
			$tb = addslashes (trim($tb));
			$tc = addslashes (trim($tc));
			$td = addslashes (trim($td));
			$te = addslashes (trim($te));

			//get max contract id 
			$result1 = mysql_query("SELECT userid FROM tbluser WHERE email = '$artist'");
			
			$count = mysql_num_rows($result1);
			
			if ($count != 0)
				{
				$row1=mysql_fetch_assoc($result1);
				$pid = $row1["userid"];
		
				//add to contract info to contract table
				mysql_query("INSERT INTO `tblcontract`(`contractId`, `drafter`, `participant`, `Ctype`, `dateDrafted`, `status`, `dateConfirmed`) VALUES (NULL,'$uid','$pid','2',CURRENT_TIMESTAMP, 'pending', NULL)");
				
				
				//get max contract id 
				$result = mysql_query("SELECT MAX(contractId) AS cid FROM `tblcontract`");
				$row=mysql_fetch_assoc($result);
				$cid = $row["cid"];

				// add clauses to custom clause table 
				mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$ta','$a','1',CURRENT_TIMESTAMP, NULL)");
				mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$tb','$b','2',CURRENT_TIMESTAMP, NULL)");	
				mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$tc','$c','3',CURRENT_TIMESTAMP, NULL)");
				mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$td','$d','4',CURRENT_TIMESTAMP, NULL)");
				mysql_query("INSERT INTO `tblcustomclause`(`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES (NULL,'$cid','$te','$e','5',CURRENT_TIMESTAMP, NULL)");
					
				$_SESSION['error'] 		= "Contract Added";
				header("Location: ../label_home.php");
				}else {
					$_SESSION['error'] = "Incorrect email";
					header("Location: ../contractDraft.php?c=".$ct."");
					}

			}
			
}else {
		$_SESSION['error'] = "Incorrect url";
		header("Location: ../home.php");
		}
?>