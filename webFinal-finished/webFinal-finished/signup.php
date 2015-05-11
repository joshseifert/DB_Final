<?php include "php/signuphelper.php";?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SIGN UP</title>
<link rel="stylesheet" href="style.css">
<script src="js/utility.js"></script>
<script src="js/signup.js"></script>
</head>
<body>
  <?php include "php/header.php"?>
  <h2>The first step on the path to greatness!</h2>
  <form name="signupform" id="signupform" onsubmit="return false;">
    <div>Username: </div>
    <input id="username" type="text" onblur="checkusername()" maxlength="100">
    <span id="usernamestatus"></span>
    <div>Create Password:</div>
    <input id="pass1" type="password" onfocus="clearField('status')" onblur="checkpassword()" maxlength="100">
    <div>Confirm Password:</div>
    <input id="pass2" type="password" onfocus="clearField('status')" onblur="checkpassword()" maxlength="100">
	<span id="pwstatus"></span>
    <br /><br />
    <button class="button" onclick="signup()">Create Account</button>
    <span id="status"></span>
	<p>Already have an account? <a href="login.php">Login here.</a></p>
  </form>
  <?php include "php/footer.php"?>
</body>
</html>