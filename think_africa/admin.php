<!DOCTYPE html>
<?php session_start();


session_start(); 

     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
           echo "Welcome to the member's area, " . $_SESSION['user_email'] . "!";
     } 
     else {
       header("Location: http://192.168.50.53/login.php");
           echo "Please log in first to see this page.";
     }


?>


<script src="databasefunction.py"></script>
<HTML>
   <HEAD>
      <TITLE>
         A Small Hello
      </TITLE>
   </HEAD>
<BODY>
   <H1>My Admin Site</H1>
   <P>This is very minimal "hello world" HTML document.</P>

<form action="/databasefunction.py" method="post">
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
  <input type="submit">
</form>
<h2>Add Size</h2>
<form action="/action_page.php">
  <select name="Clothing_size">
  	<option value="n_a">n_a</option>
    <option value="small">small</option>
    <option value="medium">medium</option>
    <option value="large">large</option>
  </select>
  <br><br>
  <input type="submit">
</form>
<h2>Add Style</h2>
<form action="/action_page.php">
  <select name="cloth_style">
  	<option value="n_a">n_a</option>
    <option value="cotton">cotton</option>
    <option value="polycotton">polycotton</option>
  </select>
  <select name="logo_style">
  	<option value="n_a">n_a</option>
    <option value="think_africa">think_africa</option>
    <option value="african_elephant">african_elephant</option>
  </select>
  <br><br>
  <input type="submit">
</form>
<br>
<input type="button" value="Click Me">
<form action='logout.php' method="POST">
    
   <button type="submit">Logout</button><br>
        
 </form>





</BODY>
</HTML>