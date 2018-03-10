<?php
include 'database.php';

//NEED TO EDIT FOR MY FUNCTIONS
$product_type = $_POST['product_type'];
$color =$_POST['color'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$size = $_POST['Size'];

$style = $_POST['style'];
//echo $style;



// $sql = "SELECT id, firstname, lastname FROM MyGuests";
// $result = $conn->query($sql);

// $stmt1 = "SELECT style_id FROM style WHERE style='$style'";
// $result1 = $conn->query($stmt1);
// if ($result1->num_rows > 0) {
//     // output data of each row
//     while($row = $result1->fetch_assoc()) {
//         echo "style: " . $row["style_id"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }
// $stmt5 = $conn->prepare("INSERT INTO products (product_type) VALUES (?)");
// $stmt5->bind_param("s", $product_type);

// $stmt5->execute();
// $stmt5->close();




$stmt1 = $conn->prepare("SELECT style_id FROM style WHERE style=?");
$stmt1->bind_param("s", $style);
$stmt1->execute();
$result1 = $stmt1->get_result();
$row = $result1->fetch_assoc();
	
$style_result=$row['style_id'];
$stmt1->close();
//echo $style_result;


#$stmt2 = $conn->prepare("SELECT clothing_id FROM clothing WHERE Size=?");
#$stmt2->bind_param("s", $size);
#$stmt2->execute();
#$stmt2->get_result();
#$result2 = $stmt2->fetch_assoc();

//Just used
$stmt4 = $conn->prepare("SELECT clothing_id FROM clothing WHERE Size=?");
$stmt4->bind_param("s", $size);
$stmt4->execute();
$result2 = $stmt4->get_result();
$row2 = $result2->fetch_assoc();
$size_result=$row2['clothing_id'];
$stmt4->close();

//$result2 = $conn->query($sql2);
// $row = $result2->fetch_assoc();
// $variable2 = $row['clothing_id'];


//What I'm working on  
$stmt = $conn->prepare("INSERT INTO products (product_type, color, quantity, price, style_id, clothing_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssidii", $product_type, $color, $quantity, $price, $style_result, $size_result);
//echo $stmt;
$stmt->execute();



//echo "it worked";
// $stmt2 = $conn->prepare("INSERT INTO clothing (Size) VALUES (?)");
// $stmt2->bind_param("s", $size);
// $stmt2->execute();

// $stmt3 = $conn->prepare("INSERT INTO style (cloth_type, logo_style) VALUES (?, ?)");
// $stmt3->bind_param("ss", $cloth_style, $logo_style);
// $stmt3->execute();


		
		$conn->close();
		header("Location:/admin.php");
	
?>