<?php
include 'userinfo.php';

if(isset($_POST['home_team'])){
	$home_team = $_POST['home_team'];
	$away_team = $_POST['away_team'];
	$home_score = $_POST['home_score'];
	$away_score = $_POST['away_score'];
	$date = $_POST['date'];
	
	
	//Adds the game to the 'game' table
	
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
//		echo "<script type='text/javascript'>alert('" . $home_team_id . "," . $away_team_id . "');</script>";
		echo "<script type='text/javascript'>alert('Teams can\'t play themselves! Choose different Home and Away teams.');</script>";
        echo '<script type="text/javascript">window.location="game.php"</script>';
        exit();
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
	
	
	//If a player played in a game, says how many goals they scored that game. Stored in "player-game" table.
/*	$i = 0;
    foreach($_POST as $key=>$value) {
	if(is_int($key) && $value > 0)
    {
	  echo "i: '$i'   $key:   $value  <br />";
	  $i += 1;
	}*/
	
	//We want the ID of the most recently added game. Since it auto-increments, it will be the largest ID in the table.
	$game_id = $mysqli->query("SELECT MAX(id) FROM game")->fetch_row()[0];

    foreach($_POST as $key=>$value) {
	if(is_int($key))
    {
	  if(!($stmt = $mysqli->prepare("INSERT INTO player_game (player_id, game_id, goals) VALUES (?, ?, ?)"))){
        echo "Error preparing the statement.";
      }
      if(!($stmt->bind_param('iii', $key, $game_id, $value))){
        echo "key: " . $key . "game_id:" . $game_id . "value: " . $value;
      }
      if(!($stmt->execute())){
        echo "key: " . $key . "game_id:" . $game_id . "value: " . $value . "<br />";
      }
      $stmt->close();
	}
	
	
}

header("location: game.php");
exit();
}

?>