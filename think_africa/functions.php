<?php
include 'database.php';

//NEED TO EDIT FOR MY FUNCTIONS
$email = $_POST['user_email'];
$pwd =md5($_POST['password']);
  
$stmt = $conn->prepare("SELECT * FROM users WHERE user_email=? AND password=?");
$stmt->bind_param("ss", $email, $pwd);
$stmt->execute();
$result = $stmt->get_result();
	if($row = $result->fetch_assoc()){
		
		$_SESSION['loggedin'] = true;
		$_SESSION['user_email'] = $row['user_email'];
		$sql=$conn->prepare("UPDATE users SET loggedin=1 WHERE user_email=?");
		$sql->bind_param("s", $email);
		$sql->execute();
		$stmt->close();
		$conn->close();
		header("Location: http://192.168.50.53/admin.php");
	}
	else{
		echo "Your email and/or password are incorrect";
	}
?>