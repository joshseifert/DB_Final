<?php
include "userinfo.php";

function showTeams()
{
  
  $temp = "SELECT name FROM team";
  $rows = $mysqli->query($temp)->fetch_all();
  foreach($rows as $value){
    echo "<option value = '$value[0]'>$value[0]</option>";
  } 	
}

function deleteGame()
{
  global $mysqli;
  $temp = "SELECT id, home_team, away_team, home_score, away_score, date FROM game ORDER BY date ASC";
  $rows = $mysqli->query($temp)->fetch_all();
  echo '<form action="deleteGame.php" method="post" ><select name="game_id" required>';
  foreach($rows as $value){
    $tempHomeTeam = $mysqli->query("SELECT name FROM team WHERE id = '" . $value[1] . "'")->fetch_row()[0];
    $tempAwayTeam = $mysqli->query("SELECT name FROM team WHERE id = '" . $value[2] . "'")->fetch_row()[0];
    echo "<option value = '$value[0]'>$value[5]: $tempHomeTeam:$value[3], $tempAwayTeam:$value[4]</option>";
  } 
  echo '</select><input type="submit" value = "Delete" onclick = "return confirmDelete()"></input></form>';
	
}

function addGame()
{
  global $mysqli;
  $temp = "SELECT name FROM team";
  $rows = $mysqli->query($temp)->fetch_all();
  
	echo '<form action="game.php" method="post" >
	  Home Team*: <select name="home_team" required>';
    foreach($rows as $value){
      echo "<option value = '$value[0]'>$value[0]</option>";
    }
    echo '</select><br />
	
	Away Team*: <select name="away_team" required>';
    foreach($rows as $value){
      echo "<option value = '$value[0]'>$value[0]</option>";
    }
  echo '</select><br />
	Home Score*: <input type="number" name="home_score" value="0" min="0" max = "99" required><br />
	Away Score*: <input type="number" name="away_score" value="0" min="0" max = "99" required><br />
	Date*: <input type="date" name="date" value="2015-01-01" min="2000-01-01" max="2015-12-31"><br />
	<p>* Denotes a required field.</p>
  <input type="submit">
  </form>';
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>MLS Database</title>
  <link rel="stylesheet" href="style.css">
  <script src="functions.js"></script>
  <meta charset='UTF-8'/>
</head>
<body>
<?php include "header.php"?>

  <h2>GAMES</h2>
  <h4>Record all the details of the latest match</h4>
  <h4>ADD A GAME:</h4>
 
<!--  <form action="insertGame.php" method="post" > -->
	
<!-- START OF PAGE HERE -->  
  <?php 
  if(!isset($_POST['home_team']))
    addGame();
    
  if(isset($_POST['home_team']))
  {
	$home_id = $mysqli->query("SELECT id FROM team WHERE name = '" . $_POST['home_team'] . "'")->fetch_row()[0];
	$away_id = $mysqli->query("SELECT id FROM team WHERE name = '" . $_POST['away_team'] . "'")->fetch_row()[0];

	echo 'Home Team: ' . $_POST['home_team'] . '<br />
	Away Team: ' . $_POST['away_team'] . '<br />
	Home Score: ' . $_POST['home_score'] . '<br />
	Away Score: ' . $_POST['away_score'];	
	

    echo '<form action="insertGame.php" method="post">';
	echo '<table border = 1> <tr><td>First Name</td> <td>Last Name</td> <td>Position</td> <td>Team</td> <td>Score</td></tr>';
	$temp = "SELECT p.id, p.first_name, p.last_name, p.position, t.name 
	  FROM player p 
	  INNER JOIN team t ON p.team_id = t.id 
	  WHERE t.id IN ('$home_id','$away_id')  ";
    $rows = $mysqli->query($temp)->fetch_all();
    for ($i = 0; $i < count($rows); $i++){
      echo "<tr><td>" . $rows[$i][1] . "</td><td>" . $rows[$i][2] . "</td><td>" . $rows[$i][3] . "</td><td>" . $rows[$i][4] . "</td>";
	  echo "<td><input type='number' name=" . $rows[$i][0] . " value=0 min=0 max=99>"; //Set name equal to player's id.
    }
	//"Hidden" variables Re-POST previous information regarding teams, scores.
    echo "</table>
      <input type='hidden' name='home_team' value='" . $_POST['home_team'] . "'/>
	  <input type='hidden' name='away_team' value='" . $_POST['away_team'] . "'/>
	  <input type='hidden' name='home_score' value='" . $_POST['home_score'] . "'/>
	  <input type='hidden' name='away_score' value='" . $_POST['away_score'] . "'/>
	  <input type='hidden' name='date' value='" . $_POST['date'] . "'/>
      <input type='submit'>
      </form>";
  }
  ?>
  
  <h4>Some games are so ugly, you want to pretend they never happened. Now you can! Get rid of evidence that your favorite team is a perennial disappointment.</h4>
  Select Game:
    <?php deleteGame(); ?>

  <h4></h4>
  
<?php include "footer.php"?>
</body>
</html>