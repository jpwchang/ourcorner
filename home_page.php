<?php
/*
 * home_page.php
 * 
 * Copyright 2014 Marisol Beck <mbeck@hmc.edu>, Paige Rinnert <prinnert@hmc.edu>
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

//Make sure unauthenticated users cannot get in
if(!isset($_SESSION['authenticated'])) {
	$_SESSION['denied'] = 1;
	header('Location: index.php');
} else {
	if(isset($_SESSION['denied']))
	  unset($_SESSION['denied']);
}

$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

if(mysqli_connect_errno($db_handle))
	exit(1);
?>

<html>
<body>



<div>

<h1>OurCorner</h1>

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>

</div>



<div>
<h3>Actions</h3>
<a href="newThread.html">New Thread</a>
<a href="URL">My Account</a>
</div>



<div>
<h3>My Threads</h3>
<a href="URL">I heart sewing</a>
<a href="URL">SUPERNATURAL!!</a>
</div>



<!-- switch to tabs later? -->
<!-- Drop-down menu to allow user to choose which threads to view -->
<div>
<form action="">
<select name="threads">
<option value="recent">Recent Threads</option>
<option value="my">My Threads</option>
<option value="subscribed">Subscribed Threads</option>
</select>
</form>
</div>



<div>
<a href="URL">Fuck Cats</a>
<p>Members: Zach, Jonathan</p>
</div>

<div>
<a href="URL">Cats are dabes</a>
<p>Members: Adam, Paige</p>
</div>



</body>
</html>
