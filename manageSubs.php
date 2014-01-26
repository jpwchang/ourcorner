<?php
/*
 * manageSubs.php
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

if(mysqli_connect_errno($db_handle))
	exit(1);
?>

<html>
<head>
	<title>OurCorner - Manage <?php echo $_GET['filename']; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/ourcorner.css" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>
<body>



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
+ <a href="my_account.php">My Account</a>
<br />
+ Manage Subscriptions
</div>
</div>

<div class="main">

<?php
$corner=fopen("threads/".$_GET['filename'].".cr", "r+");

$admins = fgets($corner);
$contribs = fgets($corner);
$adminList = explode("`", $admins);
$contribList = explode("`", $contribs);

fclose($corner);
?>

<p>Manage your active Corner subscriptions.</p>

<form action="removeSub.php" method="post">
<?php
$subQuery = mysqli_query($db_handle, "SELECT ThreadsSubscribed FROM users WHERE id='".$_SESSION['cur_id']."';");
if($subscrips = mysqli_fetch_assoc($subQuery)) {
	$subData = $subscrips['ThreadsSubscribed'];
	$allSubs = explode("`", $subData);
  for($i=0; $i<count($allSubs)-1; $i++) {
	  echo '<input type="checkbox" name="subscription[]" value="'.$allSubs[$i].'"/>'.$allSubs[$i].'<br />';
	}
	echo '<input type="submit" name="sumbit" value="Unsubscribe from Selected" />';
}
?>
</form>

</div>
</body>
</html>
