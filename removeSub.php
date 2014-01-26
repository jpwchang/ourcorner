<?php

require_once('conf.inc.php');
session_start();
$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle))
	exit(1);
	
$subsToRemove = $_POST['subscription'];
$query = mysqli_query($db_handle, "SELECT ThreadsSubscribed FROM users WHERE id='".$_SESSION['cur_id']."';");
if($subsData = mysqli_fetch_assoc($query)) {
  $sublist = $subsData['ThreadsSubscribed'];
  foreach($subsToRemove as $value) {
		$sublist = str_replace($value."`", "", $sublist);
		
		$corner=fopen("threads/".$value.".cr", "r");
		$admins = fgets($corner);
		$contribs = fgets($corner);
		$rest = "";
		while(!feof($corner))
		  $rest .= fgets($corner);
		fclose($corner);
		$contribs = str_replace($_SESSION['cur_user']."`", "", $contribs);
		
		$rebuiltThread = $admins.$contribs.$rest;
		$corner=fopen("threads/".$value.".cr", "w");
		fwrite($corner, $rebuiltThread);
		fclose($corner);
	}
	mysqli_query($db_handle, "UPDATE users SET ThreadsSubscribed='".$sublist."' WHERE id='".$_SESSION['cur_id']."';");
}
header('Location: home_page.php');
?>
