<?php 

//get lawyer info for ths user
$lsql = "select * from tbllawyer where client = '$uid'";
$lresult = mysql_query($lsql);
$lcount=mysql_num_rows($lresult);
?>

<div id="umenu">
	<div id="navigation">
		<?php
			if($count1 > 0){
			$row1=mysql_fetch_array($resultset1);	
				if ($row1["profilePhoto"] != ""){
		?>
				<img src="images/profiles/<?php echo $row1["profilePhoto"]?>" alt="profile pic"/>
				<?php 	} else{ ?>
				<img src="images/no_pic.jpg" alt="no pic"/>
				<?php 
					}
				?>
		<?php 
		if (!isset($_GET["u"])){
		?>
		<ul class="top-level">
			<li><a href="aProfile.php">My Profile</a></li>
			<li><a href="getMusic.php">My Music</a></li>
			<li><a href="artistContracts.php">My Contracts</a></li>
			<li>
				<a href="#">My Lawyer</a>
				<ul class="sub-level">
					<?php if ($lcount == 0 ) { ?>
					<li><form method="post" action = "processing/addLawyerPro.php"><input type="text" name="lawyer" placeholder="lawyer email"/><input type="submit" value = "Add"/></form></li>
					<?php }else { $lrow = mysql_fetch_assoc($lresult); ?>
					<li><?php echo $lrow["email"];?> &nbsp <a onclick="return confirm('Are you sure you want to delete?')" href="processing/deleteLawyer.php?c=<?php echo $lrow['lawyerId'];?>">Delete</a></li>
					<?php }?>
				</ul>
			</li>
			<li>Add Music &nbsp <input type="text" size="30" id="url" oninput="search(this.value)" placeholder="..Paste Youtube Address Here" onchange="show(this.value)"/></li>
		</ul>
		<?php
		}else{
		?>
		<p>Name: <?php echo $row1["firstName"]?> <?php echo $row1["lastName"]?><p>
		<p>Stage Name: <?php echo $row1["stageName"]?><p>
		<p>Email: <?php echo $row1["email"]?><p>
		<p>Interest: <?php echo $row1["interest"]?><p>
		<P>Experience: <?php echo $row1["experience"]?>
		<?php 	
			}	
		}
		?>
	</div>
</div>
