<?php
include 'database.php';	

//NEED TO EDIT FOR MY FUNCTIONS
$cloth_style = $_POST['cloth_style'];
$logo_style =$_POST['logo_style'];

  
$stmt = $conn->prepare("INSERT INTO style (cloth_type, logo_style) VALUES (?, ?)");
$stmt->bind_param("ss", $cloth_style, $logo_style);
$stmt->execute();

		$stmt->close();
		$conn->close();
		header("Location: http://192.168.50.53/admin.php");
	
?>		