<?php
	require_once('conf.inc.php');
	session_start();

	$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

	if (mysqli_connect_errno($db_handle))
		exit(1);

	$result = mysqli_query("SELECT username FROM users WHERE email='".$_POST["email"]."';");
	if ($success = mysqli_fetch_assoc($result)) {
  $letters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $numbers="0123456789";
	$txt = "";
	for ($i = 0; $i < 10; $i++) {
	  $char = "";
		$coinflip = lcg_value();
		if ($coinflip >= 0.5) {
				$ind = mt_rand(0, 51);
				$arr = str_split($letters);
				$char = $arr[$ind];
		} else {
				$char = mt_rand(0,9);
		}
		$txt .= $char;
  }
	$body = <<<EOD
	
	Dear {$success['username']},
	
		Someone (probably you) has requested a password reset for your 
		account. Your password has been changed to a temporary password, 
		and that password is printed below. You may log in using this 
		password, and it is strongly recommended that you change it upon 
		login to something that you will remember. You can change your 
		password by logging in to OurCorner and clicking on "My Account".
		
		Your new password is: "{$txt}".
		
		Love,
		The OurCorner Team
EOD
;

	mail($_POST['email'], "Ourcorner - Your Temporary Password", $body,"From:doNotReply@ourcorner.com"); }
?>
<html>
<body>

<div>

<form name="input" action="forgot_pwd.php" method="post">

<p>Enter your email below and you will receive a message with a new password.</p>
<p>To change your password, go to "My Accounts."</p>

Email: <input type="text" name="email">

<input type="submit" value="Submit">
</form>

</div>

</body>
</html>
