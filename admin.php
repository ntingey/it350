<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php

include 'database.php';


     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
           echo "Welcome to the member's area, " . $_SESSION['user_email'] . "!";
     } 
     else {
       header("Location: http://192.168.50.53/login.php");
           
     }


?>



<HTML>
   <HEAD>
      <TITLE>
         A Small Hello
      </TITLE>
   </HEAD>
<BODY>
   <H1>My Admin Site</H1>
   <P>This is very minimal "hello world" HTML document.</P>

<form action="functions.php" method="post">
	<h2>Add Product</h2>
  <select name="product_type">
    <option value="Hat">hat</option>
    <option value="necklace">necklace</option>
    <option value="tshirt">tshirt</option>
  </select><br>
  Color:
  <input type="text" name="color"><br>
  Stock:
  <input type="text" name="quantity"><br>
  Price:
  <input type="text" name="price"><br>
  
<br>
  <h2>Add Size</h2>
 
  <?php
  // Assume $db is a PDO object
$query2 = $conn->prepare("SELECT * FROM clothing"); // Run your query
$query2->execute();
$result2 = $query2->get_result();
echo '<select name="Size">'; // Open your drop down box


while ($row = $result2->fetch_assoc()) {
  echo "<option value='" . $row['Size']. "'>". $row['Size']. "</option>";

}

echo '</select>';
?>
  <br>

  <h2>Add Style</h2>

  <?php
  // Assume $db is a PDO object
$query = $conn->prepare("SELECT * FROM style"); // Run your query
$query->execute();
$result = $query->get_result();
echo '<select name="style">'; // Open your drop down box


// Loop through the query results, outputing the options one by one
// while ($row = $result->fetch_assoc()) {
//    echo '<option value='.$row['cloth_type'].'>' .$row['logo_style'].'</option>';
// }

while ($row = $result->fetch_assoc()) {
  echo "<option value='" . $row['style']. "'>". $row['style']. "</option>";

}

echo '</select>';

echo '<input type="submit">'
?>

</form>


<br>

<form action='logout.php' method="post">
    
   <button type="submit">Logout</button><br>
        
 </form>

  <h1>Delete a product</h1>
    <form action='drop.php' method="post">
        <label for='deleteproduct'>Select Product ID:</label>
       <select name="product_id">

        <?php 
          
            $sql = mysqli_query($conn, "SELECT product_id FROM products");
            while ($row = $sql->fetch_assoc()){
                echo "<option name=\"product_id\">" . $row['product_id'] . "</option>";
            }
          
        ?>
        </select>
        <button type="submit">Delete</button><br>
      

    </form>   

<?php 
echo "<h1>Customers</h1>";
$resultcustomers = mysqli_query($conn ,"SELECT * FROM customer");
//echo $resultcustomers;
echo "<div class='container'>    
  <div class='row'>";
while($row = mysqli_fetch_array($resultcustomers,MYSQLI_ASSOC))
{
  echo "<div class='col-sm-6'>";
      echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'>" . $row['name']."</div>";
        echo "<div class='panel-footer'>Email: ". $row['user_email'] ."</div>";
        
      echo "</div>";
  echo "</div>";
}
 echo "</div>";
  echo "</div>";

echo "<h1>Products</h1>";

$result = mysqli_query($conn ,"SELECT * FROM products");
echo "<div class='container'>    
  <div class='row'>";
while($row = mysqli_fetch_array($result))
{
  echo "<div class='col-sm-6'>";
      echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'>" . $row['make'] ."</div>";
        echo "<div class='panel-body'><img src='https://placehold.it/150x80?text=IMAGE' class='img-responsive' style='width:100%'' alt='Image'></div>";
        echo "<div class='panel-footer'>ProductID: ". $row['product_id'] ."</div>";
        echo "<div class='panel-footer'>Type: ". $row['product_type'] . "</div>";
        echo "<div class='panel-footer'>color: ". $row['color'] ."</div>";
        echo "<div class='panel-footer'>stock: ". $row['quantity'] ."</div>";
        echo "<div class='panel-footer'>price: ". $row['price'] ."</div>";
        
      echo "</div>";
  echo "</div>";
}
 echo "</div>";
  echo "</div>";


?>

</BODY>
</HTML>