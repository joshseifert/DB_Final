<?php include "php/mainhelper.php";?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTR-8">
<title>FUTBOL</title>
<link rel="stylesheet" href="style.css">
<script src="js/utility.js"></script>
<script src="js/main.js"></script>
</head>
<body>
<?php include "php/header.php"?>  
  
  <h1>VIEW DATA</h1> 
  <h3>SUBTITLE 1</h3>
  <h3>INSTRUCTIONS</h3>
<?php
	sortLift();
	printTable();
?>

  <h1>SUBMIT DATA</h1>
  <h3>ENTER INFO INTO DATABASE</h3>
  <form name="liftdata" id="liftdata" onsubmit="return false;">
    <strong>*Lift:</strong> (Choose one) <br />
    <label>Deadlift</label><input type='radio' name='lift' value='deadlift'><br />
    <label>Squat</label><input type='radio' name='lift' value='squat'><br />
    <label>Bench Press</label><input type='radio' name='lift' value='bench'><br />
    <label>Overhead Press</label><input type='radio' name='lift' value='press'><br />
    <label>Row</label><input type='radio' name='lift' value='row'><br />
	<span id="liftstatus"></span><br />
	
	<label><strong>*Weight</strong> (1-1000):</label> <input type='number' id='weight' onblur="checkweight()">
	<span id="weightstatus"></span><br />
    <label>Reps (1-100):</label> <input type='number' id='reps' onblur="checkreps()">
	<span id="repsstatus"></span><br />
    <label>Sets (1-100):</label> <input type='number' id='sets' onblur="checksets()">
	<span id="setsstatus"></span><br />
    <label>Notes:</label> <input type='text' id='notes' onblur="checknotes()">
	<span id="notesstatus"></span><br />
    Record your swole for posterity: <button class ="button" onclick="submitlift()">Submit, bro</button>
	<span id="status"></span><br />
	* Denotes a required field
  </form>


  
  <?php include "php/footer.php"?>
</body>
</html>