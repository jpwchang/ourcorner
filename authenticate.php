<?php
/*
 * authenticate.php
 * 
 * Copyright 2014 Jonathan Chang <jonathan.chang13@gmail.com>
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

$dbHandle = mysqli_connect($CFG->hostname, $CFG->username, 
                           $CFG->password, $CFG->db_name);

if(mysqli_connect_errno($db_handle))
  $login = false;

//Login will be true if we find a user matching the given
//username and password. If we find that user, we save the user's
//id in a session variable for reference later.
if(!isset($_POST['username']) || !isset($_POST['password']))
  $login = false;
else {
	$userQuery = "SELECT * FROM users WHERE ".
	             "username='{$_POST['username']}' ".
	             "AND password='{$_POST['password']}';"
  $userInfo = mysqli_query($dbHandle, $userQuery);
  if($userFound = mysqli_fetch_assoc($userInfo)) {
		$_SESSION['cur_id'] = $userFound['id'];
		$login = true;
	}
}

//If we are successfully logged in, set session variables to indicate
//it, and then redirect to profile page. Else, redirect to login.
if($login) {
  $_SESSION['authenticated'] = 1;
  if(isset($_SESSION['failure'])) {
	  unset($_SESSION['failure']);
	}
	header('Location: home_page.php');
} else {
	$_SESSION['failure'] = 1;
	header('Location: index.php');
}
?>
