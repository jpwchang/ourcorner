<html>
<body>
<div>

<?php
$corner=fopen($_GET['filename'], "r");
echo "Manage: ";
echo $_GET['filename'];

fclose($file);
?>

<p>Select members to give them admin status or delete them from this corner.</p>

<h4>Members:</h4>

<form>
<input type="checkbox" name="member" value="m1">Zamru<br />
<input type="checkbox" name="member" value="m2">JChang<br />
<input type="checkbox" name="member" value="m3">Adam<br />
<input type="checkbox" name="member" value="m4">Prinnert
</form>

<form name="input" action="blank2.php" method="get">
<input type="submit" value="Delete">

<form name="input" action="blank3.php" method="get">
<input type="submit" value="Make Admin">


<p>Add members to this corner:</p><br />
<!-- code to add people -->

</div>
</body>
</html>
