<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle)) {
	exit(1);
}
//now that the file has been created, we can write to it
$newfile = fopen("threads/".$_POST['name'].".cr", 'a') or die("Modification Failure!");
$t = time();
fwrite($newfile, $_SESSION['cur_user']." ".date("d/m/Y H:i:s", $t)." ".str_replace("\n", "<br />", $_POST['reply'])."\n");
fclose($newfile);


header("Location: view_thread.php?filename=".$_POST['name']);



?>
