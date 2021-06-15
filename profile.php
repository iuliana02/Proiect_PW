<!DOCTYPE html>
<html lang="de">

<head>
</head>

<body>

  <?php
  require_once("db_config.php");

  $user_id = $_GET["user_id"];
  $room_id = $_GET["room_id"];
  $query = "delete from booking where user_id = '$user_id' and room_id='$room_id'";
  $result = mysqli_query($conn,$query);
  if ($result)
    echo "<div> <h3> Your reservation has been successfully deleted! </h3> </div>";
  ?>

<form method ='get' action='reservation.php'>
<button  type='submit' style ='font-size:30px;'> Back</button>
</form>

</body>
