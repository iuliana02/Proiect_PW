<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="db_styling.css">
  <link rel="stylesheet" href="style2.css">

<!-- <script>
$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'functions.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
</script> -->
</head>

<body>

<?php
error_reporting(E_ERROR | E_PARSE);
require_once("db_config.php");

  $category = $_GET["category"];
  $type = $_GET["type"];
  $price = $_GET["price"];
  $capacity = $_GET["capacity"];
  $hotel = $_GET["hotel"];
  $check_in = $_SESSION["check_in"];
  $check_out = $_SESSION["check_out"];


     //fac select pe hotel ca sa am id-ul camerei alese (verific dupa egalitatea celorlalte atribute)
     $query_select_room = "select * from room where category='$category' and type='$type' and price='$price' and capacity='$capacity' and hotel='$hotel'";
     $result_rooms = mysqli_query($conn,$query_select_room);

     while ($row = $result_rooms->fetch_assoc()) {
       $id_room = $row['id_room'];
     }

     $email_user = $_SESSION["email"];
     $password_user = $_SESSION["password"];
     $query_user = "select * from user where email='$email_user' and password='$password_user'";
     $result_user = mysqli_query($conn,$query_user);
     while ($row = $result_user->fetch_assoc()) {
       $id_user = $row['id'];
     }
     $_SESSION["user_id"] = $id_user;
     $query_booking = "insert into booking(user_id, room_id, check_in, check_out) values ('$id_user', '$id_room', '$check_in', '$check_out')";
     if (mysqli_query($conn,$query_booking))
        echo "Booking succesfully!"."<br>";

    echo "<div style='margin: 0px; padding: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; line-height: 150%; background-color: rgb(212, 212, 247); text-align: center'>";
    echo "Your Reservations:";
    echo "</div>";
    $id = $_SESSION["user_id"];
    $query = "select * from room inner join booking on room.id_room = booking.room_id inner join user on user.id=booking.user_id where user.id='$id'";
    $result = mysqli_query($conn,$query);
    $i=1;
    if ($result->num_rows > 0)
      while ($row = $result->fetch_assoc()) {
        echo "<form id='form2' method='POST'>";
        echo "<div class='box'>";
        echo "Reservation nr. ".$i."<br>"."<br>";
        echo "Hotel: " . $row['hotel']."<br>";
        echo "Category: " . $row['category']."<br>";
        echo "Type: " . $row['type']."<br>";
        echo "Price: " . $row['price']."<br>";
        echo "Capacity: " . $row['capacity']."<br>";

        echo "<p> <a href='profile.php?section=booking&user_id=".$id."&room_id=".$row['id_room'] ."'  class='delete_button'> Delete reservation </a> </p>";
        echo "</div>";
        echo "</form>";
        $i+=1;
      }

      // function destroy_session() {
      //   // remove all session variables
      //   session_unset();
      //
      //   // destroy the session
      //   session_destroy();
      // }
 ?>

<form method="post" action="functions.php">
 <input type="submit" class = "button1" name="log_out" style ="font-size:30px" value="Log out">
 <input type="submit" class = "button2" name="reserve_again" style ="font-size:30px" value="Make another reservation">
</form>


</body>
</html>
