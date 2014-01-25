<html>
<body>
<?php
	require_once('conf.inc.php');
	session start();

	$db_handle = mysqli_connect($CFG->hostname, $CFG->username, $CFG->password, $CFG->dbName);

	if (mysqli_connect_errno($db_handle))
		exit(1);

	$result = mysqli_query("SELECT username FROM users WHERE email='".$_POST["email"]."'");
	if ($success = mysqli_fetch_assoc($result)) {

		/*TODO: add password generator code here*/

	$body = "Dear ".$success['username'].",\n
		\n
		Someone (probably you) has requested a password reset for your account. Your password has been changed to a temporary password, and \n
		that password is printed below. You may log in using this password, and it is strongly recommended that you change it upon login to something \n
		that you will remember. You can change your password by logging in to OurCorner and clicking on \"My Account\".\n
		\n
		Your new password is: ".$txt."\n
		\n
		Love,\n
		\n
		The OurCorner Team"

	email($_POST['email'], "Ourcorner - Your Temporary Password", $body,"From:doNotReply@ourcorner.com");
?>

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
