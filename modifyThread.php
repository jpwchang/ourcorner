<?php

require_once('conf.inc.php');
session_start();

$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);
if (mysqli_connect_errno($db_handle)) {
	exit(1);
}

//For the user specified by $user, put $latestThread at the front of the list
function updateThreadList($user, $latestThread, $db) {
  $updateQuery = mysqli_query($db, "SELECT ThreadsSubscribed FROM users WHERE username='".$user."';");
  if($threadList = mysqli_fetch_assoc($updateQuery)) {
    $threads = $threadList['ThreadsSubscribed'];
    $threads = str_replace($latestThread."`", "", $threads);
    $threads = $latestThread."`".$threads;
    //Insert the updated list of threads into the database
    $restoreQuery = mysqli_query($db, "UPDATE users SET ThreadsSubscribed='".$threads."' WHERE username='".$user."';");
  }
}

//We need to read the file to get the list of subscribers
$newfile = fopen("threads/".$_POST['name'].".cr", 'r') or die("Modification Failure!");
$admins = fgets($newfile);
$subscribers = fgets($newfile);
fclose($newfile);

//Get the list of subscribers to this thread
$subList = explode("`", $subscribers);

//Now we open the same file for writing, putting the file pointer at the end of file
$newfile = fopen("threads/".$_POST['name'].".cr", 'a') or die("Modification Failure!");
$t = time();
fwrite($newfile, $_SESSION['cur_user']." ".date("d/m/Y H:i:s", $t)." ".str_replace("\n", "<br />", $_POST['reply'])."\n");
fclose($newfile);

//Update the order of the MySQL admin threads entry
$updateQuery = mysqli_query($db_handle, "SELECT AdminThreads FROM users WHERE id='".$_SESSION['cur_id']."';");
if($threadList = mysqli_fetch_assoc($updateQuery))
{
  $threads = $threadList['AdminThreads'];
  $threads = str_replace($_POST['name']."`", "", $threads);
  $threads = $_POST['name']."`".$threads;
  $restoreQuery = mysqli_query($db_handle, "UPDATE users SET AdminThreads='".$threads."' WHERE id='".$_SESSION['cur_id']."';");
}

//For each user subscribed to this thread, update the order of the posts
foreach($subList as $curUser) {
	$curUser = trim($curUser);
  if(strlen($curUser) > 0) {
    updateThreadList($curUser, $_POST['name'], $db_handle);
  }
}

header("Location: view_thread.php?filename=".$_POST['name']);



?>
