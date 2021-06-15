<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>User Account Activation by Email Verification</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
if($_GET['key'] && $_GET['token'])
{
include "db_config.php";
$email = $_GET['key'];
$token = $_GET['token'];
$query = mysqli_query($conn,"SELECT * FROM `user` WHERE `email_verification_link`='".$token."' and `email`='".$email."';");
$d = date('Y-m-d H:i:s');
if (mysqli_num_rows($query) > 0) { //daca user-ul cu mail-ul si codul respectiv exista deja in baza de date
  $row= mysqli_fetch_array($query); //gasesc randul la care se afla si modific coloana email_verified_at cu data actuala (inregistrarea finala)
  if($row['email_verified_at'] == NULL){
    mysqli_query($conn,"UPDATE user set email_verified_at ='" . $d . "' WHERE email='" . $email . "'");
    $msg = "Congratulations! Your email has been verified.";
  }else
  {
    $msg = "You have already verified your account with us";
  }
}
else
{
$msg = "This email has not been registered on our website.";
}
}
?>
<div class="container mt-3">
<div class="card">
<div class="card-header text-center">
User Account Activation by Email Verification
</div>
<div class="card-body">
<p><?php echo $msg; ?></p>
</div>
</div>
</div>
</body>
</html>
