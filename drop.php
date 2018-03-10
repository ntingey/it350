<?php

include 'database.php';
$product_id = $_POST['product_id'];
	$stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
	
	$stmt->bind_param("s", $product_id);
	$stmt->execute();
	header("Location:/admin.php");
	$stmt->close();
	$conn->close();
?>