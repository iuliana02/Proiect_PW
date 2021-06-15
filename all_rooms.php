<!DOCTYPE html>
<html lang="en">
<head>
  <title>Room reservation - Radisson Blue</title>
  <link rel="stylesheet" href="style2.css">
</head>
<body>
<?php

  // Connect database
  // error_reporting(E_ERROR | E_PARSE);
  require_once('db_config.php');

 $query = "SELECT * FROM room";
 $result = mysqli_query($conn, $query);
 $output = "";

 if (mysqli_num_rows($result) > 0) {

 $output.="<form method='post'>
       <table class='table'>
       <thead>
           <tr>
             <th>Hotel</th>
              <th>Type</th>
              <th>Category</th>
              <th>Capacity</th>
              <th>Price</th>
            </tr>
       </thead>
          <tbody>";
 while ($row = mysqli_fetch_assoc($result)) {

 $output.="<tr>
             <td>{$row['hotel']}</td>
             <td>{$row['type']}</td>
             <td>{$row['category']}</td>
             <td>{$row['capacity']}</td>
             <td>{$row['price']}</td>
             <td class='reserve'><a href='reservation.php?section=room&category=".$row['category']."&type=".$row['type']."&price=".$row['price']."&capacity=".$row['capacity']."&hotel=".$row['hotel']."'>Book room</a></td>
    </tr>";
 }
 $output.="</tbody>
   </table>";

 echo $output;
 }
 ?>
</body>
</html>
