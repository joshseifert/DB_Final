<?php
/**
 * Created by PhpStorm.
 * User: Austin
 * Date: 5/20/2015
 * Time: 7:12 PM
 */
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
<h2>STADIUMS</h2>
<h4>Want to sort Stadiums by it's capacity?  Enter a value below!</h4>
        <form action="advanced.php" method="post">
            <h4>Enter amount to get Stadiums with that capacity and below!</h4>
            <input type="number" name="sortCap" value="10000" min="1" max="999999">
            <input type="submit" name="SortCap">
        </form>
<br />
<?php include "footer.php"?>
</body>
</html>