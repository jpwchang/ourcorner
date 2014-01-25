


<html>
<body>



<div>

<h1>OurCorner</h1>

<h5>Muddysoul</h5>

<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>

</div>



<div>
<h3>Actions</h3>
<a href="newThread.html">New Thread</a>
<br />
<a href="URL">My Account</a>
</div>



<div>
<h3>My Threads</h3>
<a href="URL">I heart sewing</a>
<br />
<a href="URL">SUPERNATURAL!!</a>
</div>



<?php
$corner=fopen($_GET['filename'], "r");
echo filename;

while(!feof($corner))
{
$post = fgets($corner);
$space = strpos($post, " ");
$name = substr($post, 0, $space);
echo $name;

$post = substr($post, $space+1);
$space = strpos($post, " ");
$date = substr($post, 0, $space);
echo $date;

$post = substr($post, $space+1);
$space = strpos($post, " ");
$time = substr($post, 0, $space);
echo $time;

$rest = substr($post, $space+1);
echo $rest;
}

fclose($file);
?>






</body>
</html>