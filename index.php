<?php
/*
 * index.php
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>OurCorner - Login</title>
	<link rel="stylesheet" type="text/css" href="styles/ourcorner.css" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body style="background-color:#aeebff;">
	<div style="text-align:center;">
	<img src="img/logo.png" height="200px" style="border:0; margin-top:50px;" />
	<form action="authenticate.php" method="post">
	  <input type="text" name="username" id="username" placeholder="Username" />
	  <br />
	  <input type="password" name="password" id="password" placeholder="Password" />
	  <br />
	  <input type="submit" id="login" name="login" value="Login" />
	</form>
	<br />
	Don't have an account? <a href="new_registration.php">Click here</a>
	<br />
	<a href="forgot_pwd.php">Forgot Password?</a>
	</div>
</body>

</html>
