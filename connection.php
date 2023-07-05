<?php
$databaseHost = 'localhost';
$databaseName = 'project';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
	if (mysqli_connect_error()) {
		die('There was an error while connecting to database');
	}else{
		echo "Successfully connnected to database";
	}
?>
