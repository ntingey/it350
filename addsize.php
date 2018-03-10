<?php
include 'database.php';

//NEED TO EDIT FOR MY FUNCTIONS
$size = $_POST['Size'];


  
$stmt = $conn->prepare("INSERT INTO clothing (Size) VALUES (?)");
$stmt->bind_param("s", $size);
$stmt->execute();

		$stmt->close();
		$conn->close();
		header("Location: http://192.168.50.53/admin.php");
	
?>