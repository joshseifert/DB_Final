<?php
include "php/userinfo.php";
$username = $_SESSION['username'];

$name = $_FILES["upFile"]["name"];
$tempDir = $_FILES["upFile"]["tmp_name"];
$error = $_FILES["upFile"]["error"];

if (!$tempDir) {
    echo "Bro, choose a file before you upload it!";
    exit();
}

$size = getimagesize($tempDir);
if(!$size){
	echo "Pics (of pecs) only, bro.";
	exit();
}

if(move_uploaded_file($tempDir, "userImages/$username")){
    echo "Picture uploaded! Go to <a href='compare.php'>Compare</a> to see how you stack up against your fellow bro.";
} else {
    echo "Bummer, bro. You're too swole for the internet. Try again later.";
}
?>