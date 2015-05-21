<?php
/**
 * Created by PhpStorm.
 * User: Austin
 * Date: 5/20/2015
 * Time: 7:12 PM
 */

//Prints information regarding stadium(s)
function SortStadium(){
    if (isset($_POST['sortCap']))
    {
        global $mysqli;
        echo '<table border = 1> <tr> <td>Name</td> <td>Maximum Capacity</td> <td>City</td> <td>Year Built</td></tr>';
        $res = $mysqli->query("SELECT name, max_capacity, city, year_built FROM stadium WHERE max_capacity <= '" . $_POST['sortCap'] . "'")->fetch_all();
        for ($i = 0; $i < count($res); $i++){
            echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td>";
        }
        echo "</table>";
    }
}

function OddEvenNumbers(){
    global $mysqli;
    if ($_POST['odd_even']=='Odd') {
        echo '<table border = 1> <tr><td>Team Name</td> <td>First Name</td> <td>Last Name</td> <td>Position</td> <td>Jersey Number</td></tr>';
        $res = $mysqli->query("SELECT t.name, first_name, last_name, position, jersey FROM player p INNER JOIN team t ON t.id = p.team_id WHERE (t.name ='" . $_POST['teamName'] . "'AND p.position='" . $_POST['position'] . "'AND (p.jersey % 2 != 0))")->fetch_all();
        for ($i = 0; $i < count($res); $i++) {
            echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td>";
        }
        echo "</table>";
    }
    else if ($_POST['odd_even']=='Even')
    {
        echo '<table border = 1> <tr> <td>Team Name</td> <td>First Name</td> <td>Last Name</td> <td>Position</td> <td>Jersey Number</td></tr>';
        $res = $mysqli->query("SELECT t.name, first_name, last_name, position, jersey FROM player p INNER JOIN team t ON t.id = p.team_id WHERE (t.name ='" . $_POST['teamName'] . "'AND p.position='" . $_POST['position'] . "'AND (p.jersey % 2 == 0))")->fetch_all();
        for ($i = 0; $i < count($res); $i++) {
            echo "<tr><td>" . $res[$i][0] . "</td><td>" . $res[$i][1] . "</td><td>" . $res[$i][2] . "</td><td>" . $res[$i][3] . "</td>";
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
<h4>Want to sort Stadiums by it's capacity?  Enter a value below!</h4>
        <form action="advanced.php" method="post">
            <h4>Enter amount to show the stadiums with that max capacity and below!</h4>
            <input type="number" name="sortCap" value="20000" min="1" max="999999">
            <input type="submit">
        </form>
<br />
<?php
    SortStadium();
?>

<br />

<h4> Want to see which players on your chosen team has either odd or even jersey numbers at that specific position?  Check this out below!</h4>
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
<?php include "footer.php"?>
</body>
</html>