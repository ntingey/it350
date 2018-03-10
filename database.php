<?php
session_start();
$dbServer = 'localhost';
$dbUsername = 'nate';
$dbPassword = 'natespassword';
$dbName = 'think_africa';
$conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);
if($conn->connect_error){
	die("Connection failed: ".mysqli_connect_error());
}
