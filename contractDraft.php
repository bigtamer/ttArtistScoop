<?php 
session_start(); 
include "include/securitytest.php";

if(isset($_GET['c']) && isset($_SESSION['userid']))
{
$c = $_GET['c'];

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
	
	<!-- form wizard-->
	<style type="text/css">
        #main { width:960px; margin: 0px auto; border:solid 1px #b2b3b5; -moz-border-radius:10px; padding:20px;}
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}
        .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        .prev:hover, .next:hover { background-color:#FFA03D; text-decoration:none;}
        .prev { float:left;}
        .next { float:right;}
        #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px;}
        #steps li {font-size:20px; float:left; padding:10px; color:#b0b1b3;}				
        #steps li span {font-size:9px; display:block;
					 white-space: pre-wrap;       /* css-3 */
					 white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
					 white-space: -pre-wrap;      /* Opera 4-6 */
					 white-space: -o-pre-wrap;    /* Opera 7 */
					 word-wrap: break-word;       /* Internet Explorer 5.5+ */}
        #steps li.current { color:#FFA03D;}
        #makeWizard { color:#fff; padding:2px; text-decoration:none; font-size:18px;}
        #makeWizard:hover { background-color:#FFA03D;}
		#SaveCon {float:right; padding-right:20px;}
		.tooltip {position:relative;}
    </style>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="jsForm/formToWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#conDraft").formToWizard({ submitButton: 'SaveCon' })
        });
    </script>
	
	<!-- tooltip-->
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
	<script type="text/javascript" src="js/jquery.tooltipster.js"></script>
	<script type="text/javascript" src="https://raw.github.com/desandro/masonry/master/jquery.masonry.min.js"></script>
	 <script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
        });
    </script>
	
	<script>
	function showUser(str)
				{
				if (str=="")
				  {
				  document.getElementById("txtHint").innerHTML="";
				  return;
				  }
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("flash").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","processing/getArtist.php?q="+str,true);
				xmlhttp.send();
				}
	</script>
</head>
<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		<?php include "include/labelNav.php";?>
		
		<div id="content">
		<?php if(isset($_SESSION['error']))
			{
			echo($_SESSION['error']);
			$_SESSION['error']='';
			}
			?>  
		<form id="conDraft" method="POST" action="processing/addDraftpro.php">
			<input id="SaveCon" type="submit" value="Save Document" />
			<input type="hidden" name="ctype"  value="<?php echo $c ?>" />
			<fieldset>
				<img src="images/hint.png" class="tooltip" width="40px" height="40px" title="enter artist email address to add, if correct artist info will be displayed below textbox"> 
				<legend>Engaging Party</legend>
				<input type="text" name="artist" id = "artist" onkeyup="showUser(this.value)"/>
				<div id="flash" align="left"></div>
			</fieldset>
			<?php 
			//get template clause related to selection (c)
			$resultset = mysql_query("SELECT * FROM tbltemplateclause WHERE cType = '$c'");
			while ($row = mysql_fetch_array($resultset))
			{ ?>
			<input type="hidden" name="title_<?php echo $row["orderNum"] ?>" value="<?php echo $row["title"] ?>" />
			<fieldset>
				<img src="images/hint.png" class="tooltip" width="40px" height="40px "title="<?php echo $row["clauseTip"] ?>"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <img src="images/help.png" class="tooltip" width="70px" height="45px" title="<p>1. Use the <img src='images/hint.png' width='30px' height='30px'/> to get tips specific each clause</p> <p>2. Text enclosed in [[ ]] braces signify key terms</p><p>3. Key term braces will be removed on submission but can be removed at user's discretion</p><p>4. spaces, line breaks, indentations are preserved on submission</p><p>5. Submit document button will appear on the right on reaching the last step</p><p>Happy Drafting!</p>"/>
				<legend><?php echo $row["title"] ?></legend>
				<pre><textarea rows="15" cols="116" class="description" name="<?php echo $row["orderNum"] ?>" ><?php echo $row['clause'];?>"</textarea></pre><br/><br/>
			</fieldset>
			<?php } ?>
        </form>

		</div>
	
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>