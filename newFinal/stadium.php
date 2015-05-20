<?php

//Allows user to view the stadium information. User may view all stadiums at once, or select a specific stadium.
function viewStadium()
{
  global $mysqli;
  $temp = "SELECT name FROM stadium";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form action = "stadium.php" method = "post"><select name = "name"><option value = "All">All</option>';
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  }
  echo '</select><input type = "submit"></input></form>';
}


//Prints information regarding stadium(s)
function printStadium(){
  global $mysqli;
  echo '<table border = 1> <tr> <td>Name</td> <td>Maximum Capacity</td> <td>City</td> <td>Year Built</td></tr>';
  if($_POST['name'] == "All"){	//Get name of every stadium
    $res = $mysqli->query("SELECT name, max_capacity, city, year_built FROM stadium")->fetch_all();
  }
  else{	//Get name of specific stadium
    $res = $mysqli->query("SELECT name, max_capacity, city, year_built FROM stadium WHERE name = '" . $_POST['name'] . "'")->fetch_all();
  }  
  for ($i = 0; $i < count($res); $i++){
    echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td>";
  }
  echo "</table>";
}

function deleteStadium()
{
  global $mysqli;
  $temp = "SELECT name FROM stadium";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form action = "deleteStadium.php" method = "post"><select name = "name">';
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  }
  echo '</select><input type = "submit" value = "Delete" onclick = "return confirmDelete()"></input></form>';
}
?>



<!DOCTYPE HTML>
<html>
<head>
  <title>MLS Database</title>
  <link rel="stylesheet" href="style.css">
  <script src="functions.js"></script>
  <meta charset='UTF-8'/>
  <?php 
    include "userinfo.php";
  ?>
</head>
<body>
<?php include "header.php";?>
  <h2>STADIUMS</h2>
  <h4>Pick a stadium to see it's details:<h4>
  <?php 
    viewStadium(); 
	printStadium();
  ?>
  <h4>Don't like any of these stadiums? Make your own!</h4>
  
  <form action="insertStadium.php" method="post" >
	<h4>ADD A STADIUM:</h4>
	Name:* <input type="text" name="name" value="" required><br />
	Maximum Capacity: <input type="number" name="maxCap" value="10000" min="1" max = "999999"><br />
	City: <input type="text" name="city" value=""><br />
	Year Built: <input type="number" name="yearBuilt" value="2000" min="1900" max = "2015"><br />
	<p>* Denotes a required field.</p>
  <input type="submit">
  </form>
  
  <h4>Out with the old, in with the new. Demolish a stadium, and build a new one in its place.</h4>
  
  <?php
    deleteStadium();
  ?>
 <br />
<?php include "footer.php"?>
</body>
</html>