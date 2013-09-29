<?php 
session_start(); 

include"include/dbconnect.php";

$sql = "SELECT * FROM tblgenre";

$resultset = mysql_query($sql);

$count=mysql_num_rows($resultset);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="template" content="text/html" charset="utf-8"/>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	
	<title>Registration</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
		
	<link rel="stylesheet" type="text/css" href="css/regStyle.css" media="screen" />	
	<script src="jsReg/jquery-1.2.6.js" type="text/javascript" charset="utf-8"></script>	
	<script src="jsReg/form-fun.jquery.js" type="text/javascript" charset="utf-8"></script>
		<!--[if IE]>
		<style type="text/css">
			legend { 
				position: relative;
				top: -30px;
			}
			
			fieldset {
				margin: 30px 10px 0 0;
			}
		</style>
		
		<script type="text/javascript">
			$(function(){
				$("#step_2 legend").css({ opacity: 0.5 });
				$("#step_3 legend").css({ opacity: 0.5 });
			});
		</script>
	<![endif]-->
</head>

<body>

	<?php include "include/head.php";?>
	
	<div class="break"></div>
	
	<div id="wrapper">
		
		<?php include "include/topNav.php";?>
		
		<div id="content">
		<noscript>Please Enable JavaScript</noscript>
			<div id="page-wrap">
				
				<h2><span>Registration</span></h2> 
				<!-- checks for duplicate email -->
				<p style="color:yellow;font-weight:bold;"><?php 
				if(isset($_SESSION['error'])){
				echo($_SESSION['error']);
				$_SESSION['error'] = '';
				}
				?></p>
				<!-- checks for invalid email -->
				<p style="color:yellow;font-weight:bold;"><?php
			if(isset($_SESSION['bad3'])){
			echo($_SESSION['bad3']);
			$_SESSION['bad3'] = '';
			}
			?></p>
			<!-- checks for blank email -->
				<p style="color:yellow;font-weight:bold;"><?php
			if(isset($_SESSION['bad4'])){
			echo($_SESSION['bad4']);
			$_SESSION['bad4'] = '';
			}
			?></p>
		

				<form id="reg_form" action="processing/regPro.php" method="post" enctype="multipart/form-data">

					<fieldset id="step_1">
						<legend>Step 1</legend>
					
						<label for="User Type">As</label>
						
						<select id="user_type" name="user_type" autocomplete="off">
							<option id="opt_0" value="0">Please Choose</option>
							<option id="opt_1" value="3">An Artist</option>
							<option id="opt_2" value="2">A Label</option>
						</select>
						<br />
						
						<div id="User_wrap" class="name_wrap push">
							<h3>Please provide info below:</h3>
							<label>First Name</label><input autocomplete="off"  type="text" id="fname" name="fname" class="name_input"></input><br/><br/>
							<label>Last Name</label><input autocomplete="off"  type="text" id="lname" name="lname" class="name_input"></input><br/><br/>
							<label>Email</label><input autocomplete="off"  type="text" id="email" name="email" class="name_input"/><br/><br/>
							<label>Password</label><input autocomplete="off"  type="password" id="password" name="password" class="name_input"/>
						</div>
					</fieldset>
				
					<fieldset id="step_2">
					
						<legend>Step 2</legend>
					
						<p>
							Would you like create profile now?
						</p>
						
						
						<input autocomplete="off" type="radio" id="company_name_toggle_on" name="company_name_toggle_group"></input>
						<label for="company_name_toggle_on">Yes</label>
						&emsp;
						<input autocomplete="off" type="radio" id="company_name_toggle_off" name="company_name_toggle_group"></input>
						<label for="company_name_toggle_off">No</label>
						
						<div id="company_name_wrap">
							<div id="artist_wrap" class="name_wrap push">
								<h4>Please provide Profile info:</h4>
								<label >Gender</label><select autocomplete="off" id="gender" name="gender" autocomplete="off">
											<option id="null" value="0">Please Choose</option>
											<option id="male" value="M">Male</option>
											<option id="female" value="F">Female</option>
										</select><br/><br/>
								<font size="2"><i>Date Of Birth</i></font>
								<select name="Yr">
										<option>Yr</option>
										<option value="2008">2008</option>
										<option value="2007">2007</option>
										<option value="2006">2006</option>
										<option value="2005">2005</option>
										<option value="2004">2004</option>
										<option value="2003">2003</option>
										<option value="2002">2002</option>
										<option value="2001">2001</option>
										<option value="2000">2000</option>
										<option value="1999">1999</option>
										<option value="1998">1998</option>
										<option value="1997">1997</option>
										<option value="1996">1996</option>
										<option value="1995">1995</option>
										<option value="1994">1994</option>
										<option value="1993">1993</option>
										<option value="1992">1992</option>
										<option value="1991">1991</option>
										<option value="1990">1990</option>
										<option value="1989">1989</option>
										<option value="1988">1988</option>
										<option value="1987">1987</option>
										<option value="1986">1986</option>
										<option value="1985">1985</option>
										<option value="1984">1984</option>
										<option value="1983">1983</option>
										<option value="1982">1982</option>
										<option value="1981">1981</option>
										<option value="1980">1980</option>
										<option value="1979">1979</option>
										<option value="1978">1978</option>
										<option value="1977">1977</option>
										<option value="1976">1976</option>
										<option value="1975">1975</option>
										<option value="1974">1974</option>
										<option value="1973">1973</option>
										<option value="1972">1972</option>
										<option value="1971">1971</option>
										<option value="1970">1970</option>
										<option value="1969">1969</option>
										<option value="1968">1968</option>
										<option value="1967">1967</option>
										<option value="1966">1966</option>
										<option value="1965">1965</option>
										<option value="1964">1964</option>
										<option value="1963">1963</option>
										<option value="1962">1962</option>
										<option value="1961">1961</option>
										<option value="1960">1960</option>
										<option value="1959">1959</option>
										<option value="1958">1958</option>
										<option value="1957">1957</option>
										<option value="1956">1956</option>
										<option value="1955">1955</option>
										<option value="1954">1954</option>
										<option value="1953">1953</option>
										<option value="1952">1952</option>
										<option value="1951">1951</option>
										<option value="1950">1950</option>
										<option value="1949">1949</option>
										<option value="1948">1948</option>
										<option value="1947">1947</option>
										<option value="1946">1946</option>
										<option value="1945">1945</option>
										<option value="1944">1944</option>
										<option value="1943">1943</option>
										<option value="1942">1942</option>
										<option value="1941">1941</option>
										<option value="1940">1940</option>
										<option value="1939">1939</option>
										<option value="1938">1938</option>
										<option value="1937">1937</option>
										<option value="1936">1936</option>
										<option value="1935">1935</option>
										<option value="1934">1934</option>
										<option value="1933">1933</option>
										<option value="1932">1932</option>
										<option value="1931">1931</option>
										<option value="1930">1930</option>
										<option value="1929">1929</option>
										<option value="1928">1928</option>
										<option value="1927">1927</option>
										<option value="1926">1926</option>
										<option value="1925">1925</option>
										<option value="1924">1924</option>
										<option value="1923">1923</option>
										<option value="1922">1922</option>
										<option value="1921">1921</option>
										<option value="1920">1920</option>
										<option value="1919">1919</option>
										<option value="1918">1918</option>
										<option value="1917">1917</option>
										<option value="1916">1916</option>
										<option value="1915">1915</option>
										<option value="1914">1914</option>
										<option value="1913">1913</option>
										<option value="1912">1912</option>
										<option value="1911">1911</option>
										<option value="1910">1910</option>
										<option value="1909">1909</option>
										<option value="1908">1908</option>
										<option value="1907">1907</option>
										<option value="1906">1906</option>
										<option value="1905">1905</option>
										<option value="1904">1904</option>
										<option value="1903">1903</option>
										<option value="1902">1902</option>
										<option value="1901">1901</option>
										<option value="1900">1900</option>
									</select>
									<select name="Mth">
										<option>Mth</option>
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">June</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sept</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<select name="Day">
										<option>Day</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select><br/><br/>
								<label >Bio</label><input autocomplete="off"  type="text" id="bio" name="bio" class="profile_input" ></input><br/><br/>
								<label >Stage Name</label><input autocomplete="off"  type="text" id="sname" name="sname" class="profile_input" ></input><br/><br/>
								<label >Prefered Genre</label>
									<select name="genre" id="genre" class="profile_input"> 
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
								<label >Interest</label><input autocomplete="off"  type="text" id="interest" name="interest" class="profile_input" ></input><br/><br/>
								<label >Experience</label><input autocomplete="off"  type="text" id="experience" name="experience" class="profile_input" ></input><br/><br/>
								<label >Profile Photo</label><input autocomplete="off"  type="file" id="profilePic"  name="profilePic" class="profile_input" accept="image/jpeg,image/gif,image/png"></input><br/><br/>
							</div>
							
							<div id="label_wrap" class="name_wrap push">
								<h4>Please provide Profile info:</h4>
								<label >Company Name</label><input autocomplete="off"  type="text" id="cname" name="cname" class="profile_input" ></input><br/><br/>
								<label >Company Contact</label><input autocomplete="off"  type="text" id="ccontact" name="ccontact" class="profile_input" ></input><br/><br/>
								<label >Company Email</label><input autocomplete="off"  type="text" id="cemail" name="cemail" class="profile_input" ></input><br/><br/>
								<label >Address</label><textarea autocomplete="off" id="address" name="address" class="profile_input" ></textarea><br/><br/>
								<label >Letter Head</label><input autocomplete="off"  type="file" id="lhead" name="lhead" class="profile_input" accept="image/jpeg,image/gif,image/png"></input><br/><br/>
							</div>	
						</div>
						<div class="push">			
							<p>
								Will you like to add a digital signiture?
							</p>
							
							<input type="radio" id="special_accommodations_toggle_on" name="special_accommodations_toggle"></input>
							<label for="special_accommodations_toggle_on">Yes</label>
							&emsp;
							<input type="radio" id="special_accommodations_toggle_off" name="special_accommodations_toggle"></input>
							<label for="special_accommodations_toggle_off">No</label>
						</div>
						<div id="special_accommodations_wrap">
							<input autocomplete="off"  type="file" id="signature"  name="signature" class="profile_input" accept="image/jpeg,image/gif,image/png"></input><br/>
						</div>
					</fieldset>
				
					<fieldset id="step_3">
						<legend>Step 3</legend>
						
						<div id="terms_wrap" class="name_wrap push">
						You hereby acknowledge and agree that you are solely responsible for all materials that you post or publish on the Web Site, 
						including without limitation, information, code, data, text, software, music, sound, links, photographs, pictures, graphics, video, chat, messages, files and any other materials ("Content"). 
						You represent, warrant and agree that no Content submitted by you or through your account will violate or infringe upon the rights of any third party, including copyright, trademark, privacy, publicity 
						or other personal or proprietary rights; or contain libelous, defamatory or otherwise unlawful material<br/>
						<b>I Agree to the Terms.</b> <input autocomplete="off" type="checkbox" id="agree"></input>
						</div>
						
						<input type="submit" id="submit_button" class="push" value="Complete Registration"></input>
					</fieldset>

				</form>
			
			</div>
	
		</div>
	
	</div>	
	
	<div class="break"></div>
	
	<?php include "include/footer.php";?>
	
</body>

</html>