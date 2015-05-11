<!DOCTYPE html>
<html>
<head>
<meta charset="UTR-8">
<title>COMPARE YOUR BROGRESS</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include "php/header.php"?>  
  <h1>BROGRESS</h1>
  <h3>The only thing better than lifting, is making sure everyone around you knows that you lift.</h3>
  <h3>Be a man, take your shirt off, slather yourself in oil, and take a ton of pictures of yourself in the bathroom mirror.</h3>
  <h3>Then share it with a bunch of strangers on the internet.</h3>
  <h1>LIKE A MAN.</h1>
  <h3>BROTIP: Hover over the thumbnails to see who submitted it!</h3>
  
  <div class="gallery" align="center">
    <div class="thumbnails">
      <?php 
        include "php/userinfo.php";
        global $mysqli;
        $temp = "SELECT DISTINCT username FROM users";
        $rows = $mysqli->query($temp)->fetch_all();
//Displays an uploaded picture for every user in the database. If user has not uploaded a picture, skips that user.
        foreach($rows as $value){
		  $file = 'http://web.engr.oregonstate.edu/~seiferjo/final/userImages/'.$value[0];
          if (@getimagesize($file))		  
		    echo "<img src=userImages/$value[0] name=$value[0] onmouseover=preview.src='userImages/$value[0]' title='$value[0]'/>";
        }
	  ?>
	</div>
	<div class="preview" align="center">
      <img name="preview" src='userImages/CatLifter' alt=""/>
    </div>
  </div>
  
  <p><a href="main.php">Get back to the action.</a></p>
  <?php include "php/footer.php"?>  
</body>
</html>