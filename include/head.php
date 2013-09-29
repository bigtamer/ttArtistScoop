<!--get sample comments-->
	<style type="text/css">
		#livesearch {
			display: none;
		}
	</style>
<script>	
	function showResult(str)
	{
	if (str.length==0)
	  { 
	  document.getElementById("livesearch").innerHTML="";
	  document.getElementById("livesearch").style.border="0px";
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
		$('#livesearch').show();
		document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
		document.getElementById("livesearch").style.border="1px solid #FFA03D";
		}
	  }
	xmlhttp.open("GET","processing/livesearch.php?r="+str,true);
	xmlhttp.send();
	}
</script>
<div id="header">	
		<div id="banner">
			<a href="home.php"><img src="images/logo2.png" align="left" width="75x" height="50px"/></a>
			<a href="home.php"><img src="images/logo.gif" align="left" width="200x" height="50px"/>	</a>
		</div>
		
		<div id ="search">
			<div class="lighter">
				<form>
					<span><input type="text" class="search rounded" placeholder="Find An Artist..." onkeyup="showResult(this.value)"></span>
				</form>
			</div>
		</div>
		<div class="login">
		<?php if(isset($_SESSION['userType']))
						{
					
							if($_SESSION['userType']==3 ){
							?>
							<a href="getMusic.php"><?php echo $_SESSION['fname']."'s"?>
							<img src="images/my_page.png" width="75px" height="30px" />
							</a>&nbsp; &nbsp;
							<a href="processing/logout.php"><b>LOG OUT</b></a>
							<?php
							}else { ?>
									<a href="label_home.php"><img src="images/label.png" width="40x" height="30px" /></a>&nbsp; &nbsp;
									<a href="processing/logout.php"><b>LOG OUT</b></a>
									<?php
									}
							
					
						}else { ?> 
								<a href="registration.php" style="margin-top:30px">Register with TTAS</a>&nbsp; &nbsp; &nbsp; &nbsp;
								<a href="login.php"><b>LOG IN</b></a> 
								<?php
								}
								?>
		<div id="livesearch"></div>
		</div>
</div>