<?php
/**
 * Created by PhpStorm.
 * User: Austin
 * Date: 5/20/2015
 * Time: 7:12 PM
 */

//Prints information regarding stadium(s)
function SortStadium(){
    if (isset($_POST['minCap']) && isset($_POST['maxCap']))
    {
        if ($_POST['minCap'] < $_POST['maxCap'])
        {
            global $mysqli;
            echo '<table border = 1> <tr> <th>Name</th> <th>Maximum Capacity</th> <th>City</th> <th>Year Built</th></tr>';
            $res = $mysqli->query("SELECT name, max_capacity, city, year_built FROM stadium WHERE max_capacity BETWEEN '" . $_POST['minCap'] . "' AND " . $_POST['maxCap'])->fetch_all();
            for ($i = 0; $i < count($res); $i++){
                echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td>";
            }
            echo "</table>";
        }
        else if ($_POST['minCap'] >= $_POST['maxCap'])
        {
            echo "<script type='text/javascript'>alert('Please make sure the min capacity is less than the max capacity!');</script>";
        }
    }
}

function OddEvenNumbers(){
    global $mysqli;
		
    if ($_POST['odd_even']=='Odd') {
        echo '<table border = 1> <tr><th>Team Name</th> <th>First Name</th> <th>Last Name</th> <th>Position</th> <th>Jersey Number</th></tr>';
        $res = $mysqli->query("SELECT t.name, first_name, last_name, position, jersey FROM player p INNER JOIN team t ON t.id = p.team_id WHERE (t.name ='" . $_POST['teamName'] . "'AND p.position='" . $_POST['position'] . "'AND (p.jersey % 2 != 0))")->fetch_all();
        for ($i = 0; $i < count($res); $i++) {
            echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>" . $res[$i][4] . "</td>";
        }
        echo "</table>";
    }
    else if ($_POST['odd_even']=='Even')
    {
		echo '<table border = 1> <tr> <th>Team Name</th> <th>First Name</th> <th>Last Name</th> <th>Position</th> <th>Jersey Number</th></tr>';
        $res = $mysqli->query("SELECT t.name, first_name, last_name, position, jersey FROM player p INNER JOIN team t ON t.id = p.team_id WHERE (t.name ='" . $_POST['teamName'] . "'AND p.position='" . $_POST['position'] . "'AND (p.jersey % 2 = 0))")->fetch_all();
        for ($i = 0; $i < count($res); $i++) {
            echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>" . $res[$i][4] . "</td>";
        }
        echo "</table>";
    }
}

function RareScorers(){
    global $mysqli;
    if (isset($_POST['rareScorer_Team']))
    {
      echo '<table border = 1> <tr><th>Team Name</th> <th>Player Name</th> <th>Position</th> <th>Total Goals</th></tr>';
      $res = $mysqli->query("SELECT p.id, t.name, CONCAT(p.first_name, ' ', p.last_name) AS 'playerName', p.position, SUM(pg.goals)
        FROM player p
        INNER JOIN team t ON t.id = p.team_id
        INNER JOIN player_game pg ON pg.player_id = p.id
        WHERE p.position != 'Forward'
	    AND t.name = '" . $_POST['rareScorer_Team'] . "'
        GROUP BY p.id
        HAVING SUM(pg.goals) > 0")->fetch_all();
      for ($i =0; $i < count($res); $i++) {
        echo "<tr><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td><td>" . $res[$i][4] . "</td>";
      }
      echo "</table>";
    }
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
<h2>ADVANCED</h2>
<h4>Enter amount to show the stadiums within the min and max capacity below!</h4>
        <form action="advanced.php" method="post">

            Min Capacity:<input type="number" name="minCap" value="20000" min="1" max="999999">
            Max Capacity:<input type="number" name="maxCap" value="25000" min="1" max="999999">
            <input type="submit">
        </form>
<br />
<?php
    SortStadium();
?>

<br />

<h4>Want to see which players on your chosen team has either odd or even jersey numbers at that specific position?  Check this out below!</h4>
<form action="advanced.php" method="post">
    Team: <select name="teamName">
        <?php
        $temp = "SELECT name FROM team";
        $rows = $mysqli->query($temp)->fetch_all();
        foreach($rows as $value){
            echo "<option value = '$value[0]'>$value[0]</option>";
        } ?>
    </select>
    Position: <select name="position">
        <?php
        $temp2 = "SELECT distinct position FROM player";
        $rows2 = $mysqli->query($temp2)->fetch_all();
        foreach($rows2 as $value2) {
            echo "<option value = '$value2[0]'>$value2[0]</option>";
        }
        ?>
    </select>
    Odd/Even: <select name="odd_even">
        <option value ='Odd'>Odd</option>;
        <option value ='Even'>Even</option>;
    </select>
    <input type="submit">
</form>
<br />
<?php
    OddEvenNumbers();
?>
<br />

<h4>Forwards get all the glory! See if any players in OTHER positions scored any goals for your team:</h4>
<form action="advanced.php" method="post">
    Team: <select name="rareScorer_Team">
        <?php
        $temp = "SELECT name FROM team";
        $rows = $mysqli->query($temp)->fetch_all();
        foreach($rows as $value){
            echo "<option value = '$value[0]'>$value[0]</option>";
        } ?>
    </select>
    <input type="submit">
</form>
<br/>

<?php
    RareScorers();
?>
<br />

<h4></h4>

<?php include "footer.php"?>
</body>
</html>