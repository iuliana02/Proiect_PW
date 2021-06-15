<!DOCTYPE html>
<html lang="en">

<head>
  <title>Room reservation - Radisson Blue Hotels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="db_styling.css">
  <link rel="stylesheet" href="style2.css">
</head>

<body>
  <div>
    <h1>Room reservation - Radisson Blue Hotels</h1>
  </div>
  <br>
  <br>
  <form name="booking" action="ajax.php" method="post">
    <select name="hotel" class="select" required>
      <option value="">Select a hotel:</option>
      <option value="Radisson Blue Paris">Radisson Blue Paris</option>
      <option value="Radisson Blue Maldive">Radisson Blue Maldive</option>
      <option value="Radisson Blue Amsterdam">Radisson Blue Amsterdam</option>
    </select>
<br><br>
    <select name="category" class="select">
      <option value="">Search by category (food):</option>
      <option value="All-Inclusive">All-Inclusive</option>
      <option value="Breakfast">Breakfast</option>
      <option value="Breakfast and dinner">Breakfast and dinner</option>
      <option value="Self catering">Self catering</option>
    </select>
<br>
    <select name="type" class="select">
      <option value="">Search by room type:</option>
      <option value="single">Single</option>
      <option value="standard">Standard</option>
      <option value="double">Double</option>
      <option value="twin">Twin</option>
      <option value="apartment">Apartment</option>
      <option value="villa">Villa</option>
    </select>
<br>
    <select name="capacity" class="select">
      <option value="">Search by room capacity:</option>
      <option value="1-2">1-2</option>
      <option value="2">2</option>
      <option value="4-6">4-6</option>
      <option value="6-8">6-8</option>
    </select>

<br>
<br>
<br>
<br>
    <select name="check_in" class="select" required>
      <option value="">Check-in:</option>
      <option value="20.05.2021">20.05.2021</option>
      <option value="27.05.2021">27.05.2021</option>
      <option value="3.06.2021">3.05.2021</option>
      <option value="10.06.2021">10.06.2021</option>
      <option value="17.06.2021">17.06.2021</option>
      <option value="23.06.2021">23.06.2021</option>
      <option value="30.06.2021">30.06.2021</option>
    </select>

    <select name="check_out" class="select" required>
      <option value="">Check-out:</option>
      <option value="27.05.2021">27.05.2021</option>
      <option value="3.06.2021">3.05.2021</option>
      <option value="10.06.2021">10.06.2021</option>
      <option value="17.06.2021">17.06.2021</option>
      <option value="23.06.2021">23.06.2021</option>
      <option value="30.06.2021">30.06.2021</option>
      <option value="06.07.2021">06.07.2021</option>
    </select>

<br> <br> <br>
    <input class="button" type="submit" value="Browse rooms"/>
  </form>


<form name="all_rooms" action="all_rooms.php" method="post">
  <input class="show_reservations" type="submit" value="See all rooms"/>
</form>

  <div>
    <div >
      <div >
        <div id="table-data">


        </div>
      </div>
    </div>
  </div>


</body>
</html>
