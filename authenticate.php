<?php
/*
 * authenticate.php
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
$login = false;

$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

if(mysqli_connect_errno($db_handle))
	exit(1);

if(!isset($_POST['username']) || !isset($_POST['password']))
	$login = false;
else
{
	$result = mysqli_query($db_handle, "SELECT id FROM users WHERE username='".$_POST['username']."' AND password='".$_POST['password']."';");
	if($success = mysqli_fetch_assoc($result))
	{
		$_SESSION['cur_id'] = $success['id'];
		$login = true;
	}
}

if($login)
{
	$_SESSION['authenticated'] = 1;
	if(isset($_SESSION['failure']))
		unset($_SESSION['failure']);
	header('Location: home_page.php');
}
else
{
	$_SESSION['failure'] = 1;
	header('Location: index.php');
}
?>

