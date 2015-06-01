<?php
include 'userinfo.php';

if(isset($_POST['name'])){
	$name = $_POST['name'];
	$maxCap = $_POST['maxCap'];
	$city = $_POST['city'];
	$yearBuilt = $_POST['yearBuilt'];

  if(!($stmt = $mysqli->prepare("INSERT INTO stadium (name, max_capacity, city, year_built) VALUES (?, ?, ?, ?)"))){
    echo "Error preparing the statement.";
  }
  if(!($stmt->bind_param('sisi', $name, $maxCap, $city, $yearBuilt))){
    echo "Error binding the statement.";
  }
  if(!($stmt->execute())){
    echo "Error executing the statement.";
  }
  $stmt->close();
header("location: stadium.php");
exit();
}

?>
