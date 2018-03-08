<?php
include 'database.php';
$email = $_SESSION['user_email'];
$sql=$conn->prepare("UPDATE users SET loggedin=0 WHERE user_email=?");
$sql->bind_param("s", $email);
$sql->execute();
$sql->close();
$conn->close();

session_destroy();
header('Location: login.php');
exit;
?>
