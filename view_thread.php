<?php
session_start();
require_once('conf.inc.php');

//Prevent unauthenticated users from getting in
if(!isset($_SESSION['authenticated']))
{
	$_SESSION['denied'] = 1;
	header('Location: index.php');
}
else
{
	if(isset($_SESSION['denied']))
		unset($_SESSION['denied']);
}

$corner=fopen("threads/".$_GET['filename'].".cr", "r+");

?>

<html>
<head>
  <title><?php echo $_GET['filename']." - OurCorner"; ?></title>
  <link rel="stylesheet" type="text/css" href="styles/ourcorner.css" />
</head>
<body>



<div style="height:120px;">
<div class="logo">
<a href="home_page.php"><img src="img/logo.png" height="100px" style="border:0;" /></a>
</div>
<div class="usercontrol">
Hello,
<?php echo $_SESSION['cur_user']; ?>
<br />
<br />

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>
</div>
</div>

<div>
<div class="sidebar">
<div>
<h3>Actions</h3>
+ <a href="newThread.php">New Corner</a>
<br />
+ <a href="my_account.php">My Account</a>
<br />
+ <a href="manageSubs.php">Manage Subscriptions</a>
</div>
</div>

<div class="main">
<?php
$admins = fgets($corner);
$contribs = fgets($corner);
$adminList = explode("`", $admins);
$contribList = explode("`", $contribs);
echo "<span style=\"font-size:30;\">".$_GET['filename']." </span>";
foreach($adminList as $value) {
	if($value == $_SESSION['cur_user'])
		echo "<a href=\"manage_corner.php?filename=".$_GET['filename']."\">Manage Corner</a>";
}
echo "<div style=\"align:center;\">";
while(!feof($corner))
{
$post = fgets($corner);
$space = strpos($post, " ");
$name = substr($post, 0, $space);

$post = substr($post, $space+1);
$space = strpos($post, " ");
$date = substr($post, 0, $space);

$post = substr($post, $space+1);
$space = strpos($post, " ");
$time = substr($post, 0, $space);

$rest = substr($post, $space+1);

if(strlen($rest) > 0) {
	echo "<div class=\"response\">";
	echo "<b>".$name."</b> on ".$date." at ".$time."<br /><br />";
	echo $rest;
	echo "</div>";
}
}
echo "</div>";
fclose($file);
?>

<form action="modifyThread.php" method="post">
<textarea rows=10 cols=80 name="reply" value="Leave a reply..."></textarea>
<br />
<input type="hidden" name="name" id="name" value="<?php echo $_GET['filename']; ?>" />
<input type="submit" value="Submit Reply" />
</form>
</div>
</div>



</body>
</html>
