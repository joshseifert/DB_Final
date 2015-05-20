<!DOCTYPE HTML>
<html>
<head>
  <title>MLS Database</title>
  <link rel="stylesheet" href="style.css">
  <meta charset='UTF-8'/>
</head>
<body>
<?php include "header.php"?>
<div id="content">
  <h1> Futbol fans and sports stats geeks, rejoice!</h1>
  <h3>Enjoy perusing a database of your favorite MLS teams. Add, change, remove, and view data based on Teams, Stadiums, Players, and Games.
  Click on one of the buttons below to get started.</h3>
  <br />
  
  <form action="stadium.php">
    <button class ="button">Stadium</button>
  </form>
  <br />

  <form action="team.php">
    <button class ="button">Team</button>
  </form>
  <br />

  <form action="player.php">
    <button class ="button">Player</button>
  </form>
  <br />

  <form action="game.php">
    <button class ="button">Game</button>
  </form>
  <br />

</div>
<?php include "footer.php"?>
</body>
</html>