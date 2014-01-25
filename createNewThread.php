<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
echo $_SESSION['cur_id'];
$result = mysqli_query("SELECT username FROM users WHERE id='0';");

if ($worked = mysqli_fetch_assoc($result)) {
	echo "WOOHOOO";
	$user = $worked['username'];
	fclose($newfile);
	//now that the file has been created, we can write to it
	$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
	$t = time();
	//fwrite($newfile, $user." ".date("d/m/Y", $Y).$_POST['content']);
	fwrite($newfile, "HI!");
	fclose($newfile);
}

#header('Location: home_page.php');



?>
