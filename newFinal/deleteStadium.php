 <?php
include 'userinfo.php';

if(isset($_POST['name'])){
	$name = $_POST['name'];
	
  if(!($stmt = $mysqli->prepare("DELETE FROM stadium WHERE name = ?"))){
    echo "Error preparing the statement.";
  }
  
  if(!($stmt->bind_param('s', $name))){
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
