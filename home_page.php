<?php
/*
 * home.php
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
	<title>OurCorner - Home</title>
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
+ <a href="manageSubs.php">Manage Subscriptions</a>
</div>
</div>

<div class="main">

<?php
$adminQuery = mysqli_query($db_handle, "SELECT * FROM users WHERE id='".$_SESSION['cur_id']."';");
if($queryData = mysqli_fetch_assoc($adminQuery)) {
	$adminThreads = $queryData['AdminThreads'];
	$subscriptions = $queryData['ThreadsSubscribed'];
	$splitAdminThreads = explode("`", $adminThreads);
	$splitSubThreads = explode("`", $subscriptions);
	echo "<h3>My Admin Corners</h3>";
	foreach($splitAdminThreads as $value) {
		if(strlen($value)  == 0) break;
		$corner=fopen("threads/".$value.".cr", "r");
		$admins = fgets($corner);
		$contribs = fgets($corner);
		$adminList = explode("`", $admins);
		$contribList = explode("`", $contribs);

		fclose($corner);

		echo '<div class="thread">';
		echo "<a href=\"view_thread.php?filename={$value}\" style=\"font-size:22;\">{$value}</a>";
		echo "<p>Buddies: ";
		for($i=0; $i<count($adminList)-1; $i++) {
			if($i < 5) echo $adminList[$i].", ";
		}
		for($i=0; $i<count($contribList)-1; $i++) {
			if($i < 5-count($adminList)) echo $contribList[$i].", ";
		}
		if(count($adminList)+count($contribList) > 5) echo "...";
		echo "(Total ".(count($adminList)+count($contribList)-2).")</p>";
		echo "</div>";
	}

	echo "<h3>My Subscribed Corners</h3>";
	foreach($splitSubThreads as $value) {
		if(strlen($value)  == 0) break;
		$corner=fopen("threads/".$value.".cr", "r");
		$admins = fgets($corner);
		$contribs = fgets($corner);
		$adminList = explode("`", $admins);
		$contribList = explode("`", $contribs);

		fclose($corner);

		echo '<div class="thread">';
		echo "<a href=\"view_thread.php?filename={$value}\" style=\"font-size:22;\">{$value}</a>";
		echo "<p>Buddies: ";
		for($i=0; $i<count($adminList)-1; $i++) {
			if($i < 5) echo $adminList[$i].", ";
		}
		for($i=0; $i<count($contribList)-1; $i++) {
			if($i < 5-count($adminList)) echo $contribList[$i].", ";
		}
		if(count($adminList)+count($contribList) > 5) echo "...";
		echo "(Total ".(count($adminList)+count($contribList)-2).")</p>";
		echo "</div>";
	}
}
?>


</div>
</div>

</body>
</html>
