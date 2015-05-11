<?php
session_start();
//If user is not logged in, redirect to login page
if(!isset($_SESSION["username"])){
	header("location: ../final/login.php");
    exit();
}
//Contains information about the database, and instantiates a mysqli object.
include 'userinfo.php';

//Adds a new statistic to the user's database
if(isset($_POST["weight"])){
  $username = $_SESSION['username'];
  $date = date("Y-m-d");
  $lift = $_POST['lift'];
  $weight = $_POST['weight'];
  $sets = $_POST['sets'];
  $reps = $_POST['reps'];
  $notes = $_POST['notes'];

  if(!($stmt = $mysqli->prepare("INSERT INTO lifts (username, date, lift, weight, reps, sets, notes) VALUES (?, ?, ?, ?, ?, ?, ?)"))){
    echo "Error preparing the statement.";
  }
  if(!($stmt->bind_param('sssiiis', $username, $date, $lift, $weight, $reps, $sets, $notes))){
    echo "Error binding the statement.";
  }
  if(!($stmt->execute())){
    echo "Error executing the statement.";
  }
  $stmt->close();
  echo "success";
  exit();
}
//This function creates a dropdown menu, letting the user view their stats by lift. Adapted from PHP assignment 2

function sortLift(){
  global $mysqli;
  $temp = "SELECT DISTINCT lift FROM lifts";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form id="sortLift" action = "main.php" method = "post"><select name = "lift"><option value = "All">All</option>';
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  }
  echo '</select><input class="button" type = "submit" value="Submit, bro"></input></form>';
}

//This function displays the statistics selected by the user. Adapted from PHP assignment 2
function printTable(){
  global $mysqli;
  $username = $_SESSION['username'];
  echo '<table class="liftTable" border = 1> <tr> <th>Date</th> <th>Lift</th> <th>Weight</td> <td>Sets</td> <td>Reps</td> <td>Notes</td></th>';
//Unless user selects a specific lift to display, all are shown. Ordered by most recent.
  if(!isset($_POST['lift']) || $_POST['lift'] == "All"){
	$res = $mysqli->query("SELECT date, lift, weight, reps, sets, notes FROM lifts WHERE username='$username' ORDER BY date DESC")->fetch_all();
  }
  else{
	$res = $mysqli->query("SELECT date, lift, weight, reps, sets, notes FROM lifts WHERE username='$username' AND lift='".$_POST['lift']."'ORDER BY date DESC")->fetch_all();
  }
  for ($i = 0; $i < count($res); $i++){
    echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>" . $res[$i][4] ."</td><td>" . $res[$i][5] ."</td></tr>";
  }
  echo "</table>";
}
?>