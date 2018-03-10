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

<form action='authenticate.php' method="POST">

        <input type="email" name="user_email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Login</button><br>
        <a href="signup.php">Sign Up</a>

    </form>

   </BODY>
</HTML>