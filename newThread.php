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
+ New Corner
<br />
+ <a href="my_account.php">My Account</a>
<br />
+ <a href="manageSubs.php">Manage Subscriptions</a>
</div>
</div>
<script>
function displayBoxes() {
var span = document.getElementById("users");
var numBoxes = span.getElementsByTagName("input").length;
var txt = "";
for (var i = 0; i < numBoxes; i++) {
	var val = document.getElementById("user"+i).value;

	txt = txt + "<input type='text' name=\"user"+i+"\" id=\"user"+i+"\" value=\""+val+"\"><br>";
}
txt = txt + "<input type='text' name=\"user"+numBoxes+"\" id=\"user"+numBoxes+"\"><br>";
span.innerHTML = txt;
}
</script>

<div class="main">
	<h3>New Corner</h3>
<form id="newthread" action="createNewThread.php" method="post">

<p>Corner Name: <input type="text" name="name"></p>
<p>To add others to this Corner, enter their user names below:</p>
<span id="users">
<input type='text' name="user0" id="user0"><br>
</span>
<input type="button" onClick="displayBoxes()" value="Add Additional Users">
<br>
<br>
<textarea rows=20 cols=100 name="content" value="Type Your Post Here..."></textarea>
<br>

<input type="submit" value="Submit">
</form>
</div>

</html>
