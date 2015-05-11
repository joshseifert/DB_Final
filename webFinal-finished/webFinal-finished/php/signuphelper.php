<?php
session_start();
// If user is logged in, reroute them to main page
if(isset($_SESSION["username"])){
	header("location: main.php");
    exit();
}

//Contains information about the database, and instantiates a mysqli object.
include "userinfo.php";

//Queries the user's requested name via an AJAX call to 'users' database. Checks availability and validity
if(isset($_POST["usernamecheck"])){
  $username = $mysqli->real_escape_string($_POST['usernamecheck']);
  $res = $mysqli->query("SELECT id FROM users WHERE username='$username'")->fetch_all();
  $nameCheck = count($res);
  
  
  if (strlen($username) < 4 || strlen($username) > 20) {
    echo '<span class="badData">Usernames must be between 4 and 20 characters.</span>';
    exit();
  }
	if($nameCheck < 1) {
    echo '<span class="goodData">' . $username . ' is available!</span>';
    exit();
  } 
  else {
    echo '<span class="badData">' . $username . ' is already taken, Please try again.</span>';
    exit();
  }
}

//Registers new username. If the user chose to ignore warnings about name availability, prevents them from registering
if(isset($_POST["username"])){
  $username = $mysqli->real_escape_string($_POST['username']);
//Admittedly, this hashing is very rudimentary security, and protects against only the least dedicated hackers.
  $password = md5($_POST['password']);
  
  $res = $mysqli->query("SELECT id FROM users WHERE username='$username'")->fetch_all();
  $nameCheck = count($res);
  if ($nameCheck > 0){ 
    echo "<span class='badData'>Names taken, bro.</span>";
    exit();
  } 
  else {
//Binds parameters, inserts new user into users database.
    if (!($stmt = $mysqli->prepare("INSERT INTO users(username, password) VALUES (?, ?)")))
      echo 'Sorry, an error occurred. Error: (' . $mysqli->errno . ') ' . $mysqli->error . ')';
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->close();
    echo "success";
    exit();
  }
  exit();
}
?>