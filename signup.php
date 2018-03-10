<!DOCTYPE html>
<script src="databasefunction.py"></script>
<HTML>
   <HEAD>
      <TITLE>
         A Small Hello
      </TITLE>
   </HEAD>
<BODY>
   <H1>My Admin Site</H1>

  <form action='adduser.php' method="POST">

        
        <input type="text" name="first_name" placeholder="First Name"><br>
        <input type="text" name="last_name" placeholder="Last Name"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="password_first" placeholder="Enter Password"><br>
        <input type="password" name="password_second" placeholder="Confirm Password"><br>
        <button type="submit">Submit</button><br>

    </form>

   </BODY>
</HTML>