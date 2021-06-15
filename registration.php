<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pw_lab";

$conn = mysqli_connect($servername, $username, $password, "$dbname");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//create table user
$table_exist = "select * from information_schema.tables where table_schema = 'pw_lab' and table_name = 'user' limit 1";
$result_exist = mysqli_query($conn,$table_exist);
$num_rows_exist = mysqli_num_rows($result_exist);
if ($num_rows_exist==0) {
  $query_create = "create table user (id int AUTO_INCREMENT primary key, first_name varchar(30), last_name varchar(30), email varchar(30), password varchar(30), email_verification_link varchar(100), email_verified_at timestamp)";
  $result_create = mysqli_query($conn, $query_create);
}

$message = null;
if(isset($_POST['submit_login']))
{
     $message="";
     $email = $_POST['email_login'];
     $_SESSION["email"] = $email;
     $password = $_POST['password_login'];
     $_SESSION["password"] = $password;
     $sql = "select * from user where email = '$email' and password = '$password' LIMIT 1";
     $result = mysqli_query($conn,$sql);
     $num_rows = mysqli_num_rows($result);
     if ($num_rows != 0) {
        header("Location: lab10_1.php"); /* Redirect browser */
     } else {
        $message = "User does not appear in the database. \n You can register again in 5 seconds!";
        header("Refresh:5; url=first_page.php");
     }
     mysqli_close($conn);
}

if(isset($_POST['submit_sign']))
{
     $message="";
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $email = $_POST['email_sign'];
     $password = $_POST['password_sign'];
     $_SESSION["email"] = $email;
     $_SESSION["password"] = $password;

     $user_exists = "SELECT * FROM user WHERE '$email' in (select email from user)";
     $result = mysqli_query($conn,$user_exists);
     $num_rows = mysqli_num_rows($result);
     if ($num_rows!=0){
        $message = "There is already a user registered with this email! \n You can register again in 5 seconds!";
        header("Refresh:5; url=first_page.php");
      }
     else {
       //the subject
       $sub = "Confirmation for registration";
       //the message
       $token = md5($_POST['email_sign']).rand(10,9999);
       $query = "INSERT INTO user(first_name, last_name, email, password, email_verification_link) VALUES('$fname', '$lname','$email','$password', '$token')";
       $link = "<a href='localhost/Lab1/verify-email.php?key=".$email."&token=".$token."'>Click and Verify Email</a>";
       $msg = "Just one more step until your registration at our website! \n Follow the link to confirm the registration:\n $link; ";
       //recipient email here
       $rec = $email;
       //send email
       $email_header = "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: \"$rec\" \r\nReply-To: \"$rec\" \r\nX-Priority: 3\r\nX-Mailer: PHP 4\r\n";

       if (mysqli_query($conn, $query)) {
          mail($rec,$sub,$msg,$email_header);
          $message = "You have almost registered at our website!\n We sent you an email with a link for verification. Please click on the received link! ";
          header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
       }
       else
       {
          $message = "Error: " . $sql . ":-" . mysqli_error($conn);
       }
     }

     mysqli_close($conn);

}
?>
<div id="message">
<p> <h3> <?php echo nl2br($message);
?> </h3> </p>

</div>
