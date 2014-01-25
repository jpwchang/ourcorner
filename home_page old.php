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



<div>

<h1>OurCorner</h1>

<h5>Marisol Beck</h5>

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>

</div>


<div class="sidebar">
<div>
<h3>Actions</h3>
<a href="newThread.html">New Thread</a>
<br />
<a href="URL">My Account</a>
</div>



<div>
<h3>My Threads</h3>
<a href="URL">I heart sewing</a>
<br />
<a href="URL">SUPERNATURAL!!</a>
</div>
</div>


<!-- switch to tabs later? -->
<!-- Drop-down menu to allow user to choose which threads to view -->
<div class="main">
<form action="">
<select name="threads">
<option value="recent">Recent Threads</option>
<option value="my">My Threads</option>
<option value="subscribed">Subscribed Threads</option>
</select>
</form>



<div class="thread">
<a href="URL">Fuck Cats</a>
<p>Members: Zach, Jonathan</p>
</div>

<div class="thread">
<a href="URL">Cats are dabes</a>
<p>Members: Adam, Paige</p>
</div>
</div>


</body>
</html>
