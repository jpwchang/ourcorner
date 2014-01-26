<?php
  require_once('conf.inc.php');
  session_start();

	$name = $_POST['user'];
	$email = $_POST['email'];
	$password = $_POST['pwd1'];
	
	$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

	if(mysqli_connect_errno($db_handle))
		exit(1);
	
	$queryText = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('".$name."', '".$password."', '".$email."');";
	$queryResult = mysqli_query($db_handle, $queryText);
	
	$body = <<<EOD
				Dear "$name",
				Welcome to OurCorner! We are very excited for you to begin posting and sharing with your buddies. 
				This email contains your login information so that you don't forget it; be sure to keep this information somewhere safe.
				In addition, keep this email address active, as it is how you will recover your password in case you forget it.
				
				Username: "$name"
				Password: "$password"
				
				We are glad to have you in OurCorner!
				
				Love,
				The OurCorner Team

EOD;

		email($_POST['email'], "Welcome to OurCorner", $body,"From:doNotReply@ourcorner.com");
	
	header('Location: index.php');
?>
