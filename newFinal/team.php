<?php
function viewTeam()
{
  global $mysqli;
  $temp = "SELECT name FROM team";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form action = "team.php" method = "post"><select name = "name"><option value = "All">All</option>';
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  }
  echo '</select><input type = "submit"></input></form>';
}

function printTeam(){
  global $mysqli;
  echo '<table border = 1> <tr> <td>Name</td> <td>Mascot</td> <td>Year Founded</td> <td>2014 Avg Home Attendance</td><td>Stadium</td></tr>';
  if($_POST['name'] == "All"){
	  //Must do LEFT JOIN to get teams that do not have a stadium!
    $res = $mysqli->query("SELECT t.name, t.mascot, t.year_founded, t.home_attendance, s.name FROM team t LEFT JOIN stadium s ON s.id = t.stadium_id")->fetch_all();
  }
  else{
    $res = $mysqli->query("SELECT t.name, t.mascot, t.year_founded, t.home_attendance, s.name FROM team t LEFT JOIN stadium s ON s.id = t.stadium_id WHERE t.name = '" . $_POST['name'] . "'")->fetch_all();
  }
  for ($i = 0; $i < count($res); $i++){
    echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>". $res[$i][4] . "</td></tr>";
  }
  echo "</table>";
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>MLS Database</title>
  <link rel="stylesheet" href="style.css">
  <meta charset='UTF-8'/>
  <link rel="stylesheet" href="style.css">
  <?php 
    include "userinfo.php";
  ?>
</head>
<body>
0<.?php include "header.php"?>

  <h2>TEAMS</h2>
  
  <h4>Get info on your local team.</h4>
  <?php
  viewTeam();
  printTeam();
  ?>
  
  <h4>Create your own fantasy team. Almost as exciting as the real deal. Almost.</h4>
  
  <form action="insertTeam.php" method="post" >
	<h4>ADD A TEAM:</h4>
	Name:* <input type="text" name="name" value="" required><br />
	Mascot: <input type="text" name="mascot" value= ""><br />
	Year Founded: <input type="number" name="yearFounded" value="1990" min="1950" max="2015"><br />
	Avg 2014 Home Attendance: <input type="number" name="homeAttendance" value="5000" min=1 max=999999><br />
	Stadium: <select name="stadiumName">
	<?php
	$temp = "SELECT name FROM stadium";
    $rows = $mysqli->query($temp)->fetch_all();
    foreach($rows as $value){
      echo "<option value = '$value[0]'>$value[0]</option>";
    } ?>
    </select>	
	
	<p>* Denotes a required field.</p>
  <input type="submit">
  </form>
  
<?php include "footer.php"?>
</body>
</html>