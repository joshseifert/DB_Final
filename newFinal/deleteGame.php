<?php
include 'userinfo.php';

if(isset($_POST['game_id'])){
	$id = $_POST['game_id'];
	
  if(!($stmt = $mysqli->prepare("DELETE FROM game WHERE id = ?"))){
    echo "Error preparing the statement.";
  }
  
  if(!($stmt->bind_param('i', $id))){
    echo "Error binding the statement.";
  }

  if(!($stmt->execute())){
    echo "Error executing the statement.";
  }
  
  $stmt->close();
header("location: game.php");
exit();
}
echo "ID NOT SET";
?>
