<?php
session_start();

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "seiferjo-db", "Od0oj3W6i4eNqlgr", "seiferjo-db");
if($mysqli->connect_errno){
	echo "Connection Error: (" . $mysqli->connect_errono . ") " . $mysqli->connect_error;
} 
?>