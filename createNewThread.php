0<?php

require_once("conf.inc.php");
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
$result = mysqli_query("SELECT username FROM users WHERE id='".$_SESSION['cur_id']."';");

if ($worked = mysqli_fetch_assoc($result)) {
	$user = $worked['username'];
	fclose($newfile);
	//now that the file has been created, we can write to it
	$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
	fwrite($newfile, $user." ".date("d/m/Y", time()).$_POST['content']);
	fclose($newfile);
}

header('Location: home_page.php');



?>
