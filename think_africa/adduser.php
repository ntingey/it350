<?php
session_start();
include 'db.php';
$firstName = mysqli_real_escape_string($connection, $_POST['first_name']);
$lastName = mysqli_real_escape_string($connection, $_POST['last_name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$pwdFirst = mysqli_real_escape_string($connection, $_POST['password_first']);
$pwdSecond = mysqli_real_escape_string($connection, $_POST['password_second']);
if($pwdFirst != $pwdSecond){
  echo("Passwords do not match!");
}
// else{
//     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo("$email is a valid email address");
//   } else {
//     echo("$email is not a valid email address");
//   }
   
  $sql = "SELECT * FROM Owners WHERE email='$email' AND password='$pwdFirst'"; 
  $result = $connection->query($sql);
  if(!$row = mysqli_fetch_assoc($result)){
    echo "Your Username or Password is incorrect";
  }
  else{
    $_SESSION['id'] = $row['id'];
    header("Location: admin.php");
  }
}
?>