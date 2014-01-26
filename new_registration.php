<html>
<body>

<script>
function checkPwds() {
	var val1 = document.getElementById("pw1").value;
	var val2 = document.getElementById("pw2").value;
	
	if (val1 == val2) {
		document.getElementById("submit").style.display="inline";
	} else { 
		document.getElementById("submit").style.display="none";
	}
	
}


</script>

<div>
<h3>Create a New Account</h3>
</div>
<p id="info">After ensuring that your passwords match, press Return, and the Submit button will appear.</p>
<div style="float:left;">
<div style="text-align:right;">

<form name="input" action="makeAccount.php" method="post">
Username: <input type="text" name="user" id="user">
<br />
Email: <input type="text" name="email">
<br />
Password:<input type="password" onChange="checkPwds()" id="pw1" name="pwd1">
<br />
Confirm Password: <input type="password" onChange="checkPwds()" id="pw2" name="pwd2">
<br />
<input type="submit" name="submit" id="submit" value="Submit" style="display:none">
</form>

</div>
</div>
</body>
</html>
