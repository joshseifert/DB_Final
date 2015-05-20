<?php
include 'userinfo.php';

if(isset($_POST['home_team'])){
	$home_team = $_POST['home_team'];
	$away_team = $_POST['away_team'];
	$home_score = $_POST['home_score'];
	$away_score = $_POST['away_score'];
	$date = $_POST['date'];

	$home_team_id = $mysqli->query("SELECT id FROM team WHERE name = '" . $home_team . "'")->fetch_row()[0];
	$away_team_id = $mysqli->query("SELECT id FROM team WHERE name = '" . $away_team . "'")->fetch_row()[0];
	
	if($home_score > $away_score)
	{
	  $winner = $home_team_id;
	}
	else if($away_score > $home_score)
	{
	  $winner = $away_team_id;
	}
	
	if($home_team_id == $away_team_id)
	{
		echo "<script type='text/javascript'>alert('Teams can\'t play themselves! Choose different Home and Away teams.');</script>";

	}
	else
	{
      if(!($stmt = $mysqli->prepare("INSERT INTO game (home_team, away_team, home_score, away_score, winner, date) VALUES (?, ?, ?, ?, ?, ?)"))){
        echo "Error preparing the statement.";
      }
      if(!($stmt->bind_param('iiiiis', $home_team_id, $away_team_id, $home_score, $away_score, $winner, $date))){
        echo "Error binding the statement.";
      }
      if(!($stmt->execute())){
        echo "Error executing the statement.";
      }
      $stmt->close();
	}

header("location: InsertGame.php");
exit();
}

?>