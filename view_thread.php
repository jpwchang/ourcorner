<?php
session_start();
require_once('conf.inc.php');
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
<img src="img/logo.png" height="100px" />
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
+ <a href="newThread.html">New Thread</a>
<br />
+ <a href="URL">My Account</a>
</div>



<div>
<h3>My Threads</h3>
+ <a href="URL">I heart sewing</a>
<br />
+ <a href="URL">SUPERNATURAL!!</a>
</div>
</div>

<div class="main">
<?php
echo "<h2>".$_GET['filename']."</h2>";
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

echo "<div class=\"response\">";
echo "<b>".$name."</b> on ".$date." at ".$time."<br /><br />";
echo $rest;
echo "</div>";
}
echo "</div>";
fclose($file);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<textarea rows=10 cols=80 name="reply" value="Leave a reply..."></textarea>
<br />
<input type="submit" value="Submit" />
</form>
</div>
</div>



</body>
</html>
