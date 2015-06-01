<?php
include 'userinfo.php';

if(isset($_POST['name'])){
	$name = $_POST['name'];
	$mascot = $_POST['mascot'];
	$year_founded = $_POST['yearFounded'];
	$home_attendance = $_POST['homeAttendance'];
	$stadiumName = $_POST['stadiumName'];
	$stadium_id = $mysqli->query("SELECT id FROM stadium WHERE name = '" . $stadiumName . "'")->fetch_row()[0];
	
  if(!($stmt = $mysqli->prepare("INSERT INTO team (name, mascot, year_founded, home_attendance, stadium_id) VALUES (?, ?, ?, ?, ?)"))){
    echo "Error preparing the statement.";
  }
  if(!($stmt->bind_param('ssiii', $name, $mascot, $year_founded, $home_attendance, $stadium_id))){
    echo "Error binding the statement.";
  }
  if(!($stmt->execute())){
    echo "Error with $stadiumName 1 $stadium_id.";
  }
  $stmt->close();
header("location: team.php");
exit();
}

?>
