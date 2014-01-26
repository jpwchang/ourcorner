<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle)) {
	exit(1);
}
$newfile = fopen("/var/www/html/ourcorner/threads/".$_POST['name'].".cr", 'w+') or die("First Failure!");
fclose($newfile);
//now that the file has been created, we can write to it
$newfile = fopen("/var/www/html/ourcorner/threads/".$_POST['name'].".cr", 'a') or die("Second Failure!");
$t = time();
$output = $_SESSION['cur_user']."`\n";

$adminQuery = mysqli_query($db_handle, "SELECT AdminThreads FROM users WHERE id='".$_SESSION['cur_id']."';");
if($queryData = mysqli_fetch_assoc($adminQuery)) {
	$adminThreads = $queryData['AdminThreads'];
	$adminThreads = $_POST['name']."`".$adminThreads;
  $updateQuery = mysqli_query($db_handle, "UPDATE users SET AdminThreads='".$adminThreads."' WHERE id='".$_SESSION['cur_id']."';");

}

for ($i = 0; $i < count($_POST)-2; $i++) {
	//setSubscriber($_POST["user".$i]);
	$SubQuery = mysqli_query($db_handle, "SELECT * FROM users WHERE username='".$_POST["user".$i]."';");
	if ($queryData = mysqli_fetch_assoc($SubQuery)) {
		$subs = $queryData['ThreadsSubscribed'];
		$subs = $_POST['name']."`".$subs;
		$updateQuery = mysqli_query($db_handle, "UPDATE users SET ThreadsSubscribed='".$subs."' WHERE username='".$_POST["user".$i]."';");
		$output .= $_POST['user'.$i]."`";
	}
}
if(count($_POST) >2) $output .= "\n";

$output .= $_SESSION['cur_user']." ".date("d/m/Y H:i:s", $t)." ".str_replace("\n", "<br />", $_POST['content'])."\n";
fwrite($newfile, $output);
fclose($newfile);


function setSubscriber($name) {
	$SubQuery = mysqli_query($db_handle, "SELECT * FROM users WHERE username='".$name."';");
	$queryData = mysqli_fetch_assoc($SubQuery) or die("error: ".mysqli_error());
	if ($queryData) {
		$subs = $queryData['ThreadsSubscribed'];
		$subs = $_POST['name']." ".$subs;
		echo "Hi";
		$updateQuery = mysqli_query($db_handle, "UPDATE users SET ThreadsSubscribed='".$subs."' WHERE username='".$name."';");
	}
}

header('Location:home_page.php');



?>
