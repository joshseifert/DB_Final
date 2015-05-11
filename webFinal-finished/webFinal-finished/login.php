<?php include "php/loginhelper.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>LOG IN</title>
<link rel="stylesheet" href="style.css">
<script src="js/utility.js"></script>
<script src="js/login.js"></script>
</head>
<body>
  <?php include "php/header.php"?>
  <h2>Bro, do you even lift? Gotta log in to use this site.</h2>
  <form onsubmit="return false;">
    <div>Username:</div>
    <input type="text" id="username" onfocus="clearField('status')" maxlength="100">
    <div>Password:</div>
    <input type="password" id="password" onfocus="clearField('status')" maxlength="100">
    <br /><br />
    <button class="button" onclick="login()">Log In</button> 
    <p id="status"></p>
  </form>
  <p>Need an account? <a href="signup.php">Sign up here</a>.</p>
  <?php include "php/footer.php"?>
</body>
</html>