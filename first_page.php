<?php
include 'registration.php';
 ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style2.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  <script type="text/javascript" src="dropdown2.js"></script>

  <title>Login</title>

<script>
function show(button) {
       	var e = document.getElementById(button);
       	e.style.display = 'block';
     }
function hide(button) {
      	var e = document.getElementById(button);
      	e.style.display = 'none';
    }
function hide_div(message) {
      	d.style.display = 'none';
    }
</script>

<style>
body {
  background-image: url('photos/maldive.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
</head>

<?php
include 'lab7.html';
// error_reporting(0);
?>
<body>

<div class="message" style="text-align:center; vertical-align:middle">
  <img style="width: 100px;height: 100px;" src="photos/travel-logo.jpg" alt="travel" />
</div>

<div class="message">  <h1> Welcome!
<br> We are happy to find you the best travelling accommodation </h1>
    <div class="login_div">
    <a href="javascript:show('signup'), hide('login')" class="login">	Sign up </a>
    <br><br>
    <a href="javascript:show('login'), hide('signup')" class="login">	Login </a>
    </div>
</div>

<br><br>
<br><br>
<div id="signup" style="display:none; background-color: #E6E6FA;">
<form method="post">
  <fieldset>
    <label for="fname">Name:</label>
    <input type="text" id="fname" name="fname" value="" required><br><br>
    <label for="lname">Vorname:</label>
    <input type="text" id="lname" name="lname" value="" required><br><br>
    <label for="email_sign">Email:&emsp;</label>
    <input type="text" id="email_sign" name="email_sign" size = "30" value = "" required><br><br>
    <label for="password_sign">Password:&emsp;</label>
    <input type="password" id="password_sign" name="password_sign" size = "30" value = "" required><br><br>
    <input type="submit" class="btn btn-primary" name="submit_sign" value="Sign up" >
  </fieldset>
</form>
</div>


<div id="login" style="display:none; background-color: #E6E6FA">
<form method="post">
  <fieldset>
    <label for="email_login">Email:&emsp;</label>
    <input type="text" id="email_login" name="email_login" size = "30" value = "" required><br><br>
    <label for="password_login">Password:&emsp;</label>
    <input type="password" id="password_login" name="password_login" size = "30" value = "" required><br><br>
    <input type="submit" class="btn btn-primary" name="submit_login" value="Login">
  </fieldset>
</form>
</div>



</body>
</html>
