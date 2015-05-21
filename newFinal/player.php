<?php
function viewTeam()
{
  global $mysqli;
  $temp = "SELECT name FROM team";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form action = "player.php" method = "post"><select name = "teamName">';
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  }
  echo '</select><input type = "submit"></input></form>';
}

function printTeamPlayers(){
  global $mysqli;
  echo '<table border = 1> <tr> <td>First Name</td> <td>Last Name</td> <td>Age</td> <td>Position</td> <td>Jersey #</td></tr>';
  $res = $mysqli->query("SELECT p.first_name, p.last_name, p.DOB, p.position, p.jersey FROM player p INNER JOIN team t ON t.id = p.team_id WHERE t.name = '" . $_POST['teamName'] . "'")->fetch_all();
  for ($i = 0; $i < count($res); $i++){
    echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>" . $res[$i][4] . "</td>";
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
  <?php include "userinfo.php"?>
</head>
<body>
<?php include "header.php"?>

    <h2>PLAYERS</h2>
	<h4>View players by team.</h4>
	<p>(The table has been prepopulated for the Portland Timbers and Seattle Sounders)</p>
	
	<?php 
	  viewTeam(); 
	  printTeamPlayers();
	?>

    <h4>Create a new player in your own likeness.</h4>

  <form action="insertPlayer.php" method="post" >
	<h4>ADD A PLAYER:</h4>
	First Name:* <input type="text" name="first_name" value="" required><br />
	Last Name:* <input type="text" name="last_name" value="" required><br />
	Age: <input type="number" name="age" value="20" min="18" max="40"><br />
	Position: 
	  <select name="position">
	  <option value = 'Forward'>Forward</option>
	  <option value = 'Midfielder'>Midfielder</option>
	  <option value = 'Defender'>Defender</option>
	  <option value = 'Goalkeeper'>Goalkeeper</option>
	  </select>	<br />
	Jersey #: <input type="number" name="jersey" min="0" max="99"><br />
	Team:
	  <select name="teamName">
	  <?php
	    $temp = "SELECT name FROM team";
        $rows = $mysqli->query($temp)->fetch_all();
        foreach($rows as $value){
          echo "<option value = '$value[0]'>$value[0]</option>";
        } 
	  ?>
    </select>	
	
	<p>* Denotes a required field.</p>
  <input type="submit">
  </form>

<br />



  <?php include "footer.php"?>

</body>
</html>