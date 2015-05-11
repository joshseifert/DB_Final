<?php
session_start();
// If user is logged in, reroute them to main page
if(isset($_SESSION["username"])){
	header("location: main.php");
    exit();
}

//Contains information about the database, and instantiates a mysqli object.
include "userinfo.php";

//Validates that the user entered necessary data, compares user password to hashed database password.
//If valid, user is logged in, session created, rerouted to main page.
if(isset($_POST["username"])){
  $username = $mysqli->real_escape_string($_POST['username']);
  $password = md5($_POST['password']);  
 
  $res = $mysqli->query("SELECT username, password FROM users WHERE username='$username'")->fetch_all();
  
  $sessionUsername = $res[0][0];
  $sessionPassword = $res[0][1];
  
  if($password != $sessionPassword){
    echo "error";
    exit();
  } 
  else {
    $_SESSION['username'] = $sessionUsername;
    $_SESSION['password'] = $sessionPassword;
    exit();
  }
  exit();
}
?>