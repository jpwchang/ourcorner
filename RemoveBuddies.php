<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle)) 
	exit(1);

$corner=fopen("threads/".$_GET['filename'].".cr", "r");
$admins = trim(fgets($corner));
$contribs = trim(fgets($corner));
$rest = "";
while(!feof($corner))
	$rest .= fgets($corner);
fclose($corner);
for ($i = 0; $i < count($_GET); $i++) {
	$SubQuery = mysqli_query($db_handle, "SELECT * FROM users WHERE username='".$_GET["member".$i]."';");
	if ($queryData = mysqli_fetch_assoc($SubQuery)) {
		$subs = $queryData['ThreadsSubscribed'];
		$subs = str_replace($_GET['filename']."`", "", $subs);
		$updateQuery = mysqli_query($db_handle, "UPDATE users SET ThreadsSubscribed='".$subs."' WHERE username='".$_GET["member".$i]."';");
		
		$contribs = str_replace($_GET["member".$i]."`", "", $contribs);
	}
}
$rebuiltThread = $admins."\n".$contribs."\n".$rest;
$corner=fopen("threads/".$_GET['filename'].".cr", "w");
fwrite($corner, $rebuiltThread);
fclose($corner);

header("Location: manage_corner.php?filename=".$_GET['filename']);
?>
