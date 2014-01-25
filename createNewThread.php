<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle)) {
	exit(1);
}
$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
fclose($newfile);
//now that the file has been created, we can write to it
$newfile = fopen("/srv/http/threads/".$_POST['name'].".cr", 'w+') or die("Failure!");
$t = time();
fwrite($newfile, $_SESSION['cur_user']." ".date("d/m/Y H:i:s", $t)." ".$_POST['content']);
fclose($newfile);


header('Location: home_page.php');



?>
