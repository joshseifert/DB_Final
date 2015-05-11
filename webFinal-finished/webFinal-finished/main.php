<?php include "php/mainhelper.php";?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTR-8">
<title>TRACK YOUR STATS</title>
<link rel="stylesheet" href="style.css">
<script src="js/utility.js"></script>
<script src="js/main.js"></script>
</head>
<body>
<?php include "php/header.php"?>  
  
  <h1>Track Your Stats!</h1> 
  <h3>Stay motivated by seeing how far you've come. Crush your PRs!</h3>
  <h3>Once you log some stats, come back here to see your progress.</h3>
  <h3>Sort by Lift:</h3>
  <h3>BROTIP: Sort by individual lift to see a graph of your weights</h3>
<?php
	sortLift();
	printTable();
?>
  <div id="visualization"></div>
<?php
/*Some of this code is based on Google's documentation on the Google Charts API,
at https://developers.google.com/chart/interactive/docs/quick_start
Query values do not accept user input, thus are not prepared statements.*/
  include 'php/userinfo.php';
  $username = $_SESSION['username'];
  $query = "SELECT date, lift, weight FROM lifts WHERE username='$username' AND lift='".$_POST['lift']."' ORDER BY date ASC";
  $res = $mysqli->query( $query );
  $num_results = $res->num_rows;
  if( $num_results > 0){
?>
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Date', 'Weight'],
<?php
          while( $row = $res->fetch_assoc() ){
            extract($row);
            echo "['{$date}', {$weight}],";
          }
?>
      ]);
      var options = {'title':'Everyone is \'mirin your strengh gains','width':800,'height':300};
      var chart = new google.visualization.LineChart(document.getElementById('visualization'));
      chart.draw(data, options);	  
      draw(data, {title:"Everyone is 'mirin your strength gains."});
    }
   google.setOnLoadCallback(drawChart);
  </script>
<?php } ?>



  <h1>Record Your Swole!</h1>
  <h3>Enter how much you lifted.</h3>
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

  <h1>Compare your Brogress!</h1>
  <h3>The most important thing about lifting is letting other people know you lift.</h3>
  <h3>Take a selfie looking all pumped, and upload it for the world to see.</h3>
  
  <form id="upload_form" enctype="multipart/form-data" method="post">
  <input class="button" type="file" name="upFile" id="upFile"><br>
  <input class="button" type="button" value="Upload File" onclick="upload()">
  <progress id="bar" value="0"></progress>
  <h3 id="upStatus"></h3>
  </form>
  
  Click <a href="logout.php">here</a> to logout.
  
  <?php include "php/footer.php"?>
</body>
</html>