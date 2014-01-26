<?php
/*
 * my_account.php
 * 
 * Copyright 2013 Unknown <jonathan@jpc-pc>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
 
 

 
require_once('conf.inc.php');
session_start();

//Prevent unauthenticated users from getting in
if(!isset($_SESSION['authenticated']))
{
	$_SESSION['denied'] = 1;
	header('Location: index.php');
}
else
{
	if(isset($_SESSION['denied']))
		unset($_SESSION['denied']);
}
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
$emailQuery=mysqli_query($db_handle, "SELECT email FROM users WHERE id='".$_SESSION['cur_id']."';");
$addr = '';
if ($email = mysqli_fetch_assoc($emailQuery)) {
	$addr = $email['email'];
}
if (!isset($_SESSION['Try']))
	$_SESSION['Try']= 0;
if(mysqli_connect_errno($db_handle))
	exit(1);
?>

<html>
<head>
	<title>OurCorner - My Account</title>
	<link rel="stylesheet" type="text/css" href="styles/ourcorner.css" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>
<body>
	<?php 
		if ($_POST['ChangeRequest']) {
				$passQuery=mysqli_query($db_handle, "SELECT password FROM users WHERE id='".$_SESSION['cur_id']."';");
				if ($pass = mysqli_fetch_assoc($passQuery)) {
					if ($pass['password'] == $_POST['pwd']) {
							$updateQuery = mysqli_query($db_handle, "UPDATE users SET password='".$_POST['npwd1']."' WHERE id='".$_SESSION['cur_id']."';");
							$_SESSION['Try'] = 2;
				} else $_SESSION['Try'] = 1;
			
			
			}
			unset($_POST['ChangeRequest']);
		}
		?>
	
	<script>
function checkPwds() {
	var val1 = document.getElementById("npwd1").value;
	var val2 = document.getElementById("npwd2").value;
	
	if (val1 == val2) {
		document.getElementById("submit").style.display="inline";
	} else { 
		document.getElementById("submit").style.display="none";
	}
	
}
</script>



<div style="height:120px;">
<div class="logo">
<a href="home_page.php"><img src="img/logo.png" height="100px" style="border:0;" /></a>
</div>
<div class="usercontrol">
Hello, <?php echo $_SESSION['cur_user']; ?>
<br />
<br />

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>
</div>
</div>

<div>
<div class="sidebar">
<div>
<h3>Actions</h3>
+ <a href="newThread.php">New Corner</a>
<br />
+ My Account
<br />
+ <a href="manageSubs.php">Manage Subscriptions</a>
</div>
</div>


<div class="main">
<?php
if ($_SESSION['Try'] == 1)
	echo "<p style='color:red;'>Your current password is incorrect. Please verify your password and try again.</p>";
else if ($_SESSION['Try'] == 2)
	echo "<p style='color:blue;'>Your password was changed successfully.</p>";

?>
<p>Username: <?php echo $_SESSION['cur_user']; ?></p>

<p>Email: <?php echo $addr; ?> </p>

<h4>Change Password:</h4>
<form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Current Password: <input type="password" name="pwd" />
<br />
New Password: <input type="password" id="npwd1" onChange="checkPwds()" name="npwd1" />
<br />
Confirm New Password: <input type="password" id="npwd2" onChange="checkPwds()" name="npwd2" />
<br />
<input type="hidden" name="ChangeRequest" value=true>
<input type="submit" id="submit" value="Submit" style="display:none"/>
</form>

</div>


</body>
</html>
