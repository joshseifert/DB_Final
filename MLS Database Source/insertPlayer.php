<?php
include 'userinfo.php';

if(isset($_POST['first_name'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$DOB = $_POST['age'];
	$position = $_POST['position'];
	$jersey = $_POST['jersey'];
	$team_name = $_POST['teamName'];
	$team_id = $mysqli->query("SELECT id FROM team WHERE name = '" . $team_name . "'")->fetch_row()[0]; //Problem is here!
	
  if(!($stmt = $mysqli->prepare("INSERT INTO player (first_name, last_name, DOB, position, jersey, team_id) VALUES (?, ?, ?, ?, ?, ?)"))){
    echo "Error preparing the statement.";
  }
  if(!($stmt->bind_param('ssisii', $first_name, $last_name, $DOB, $position, $jersey, $team_id))){
    echo "Error binding the statement.";
  }
  if(!($stmt->execute())){
    echo "Error with $team_name 1 $team_id";
  }
  $stmt->close();
header("location: player.php");
exit();
}
?>