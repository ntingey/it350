<?php
include 'database.php';

//NEED TO EDIT FOR MY FUNCTIONS
$product_type = $_POST['product_type'];
$color =$_POST['color'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];


  
$stmt = $conn->prepare("INSERT INTO products (product_type, color, quantity, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $product_type, $color, $quantity, $price);
$stmt->execute();

		$stmt->close();
		$conn->close();
		header("Location: http://192.168.50.53/admin.php");
	
?>