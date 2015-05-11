<?php
session_start();

$mysqli = mysqli_connect("oniddb.cws.oregonstate.edu", "seiferjo-db", "XXXXXXXXX", "seiferjo-db");
if($mysqli->connect_errno){
	echo "Connection Error: (" . $mysqli->connect_errono . ") " . $mysqli->connect_error;
} 
?>