
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Room reservation - Radisson Blue</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="db_styling.css">
  <link rel="stylesheet" href="style2.css">

</head>
<script type="text/javascript">
  $(document).ready(function(){
    $("body").css({'background-color': ' #d4d4f7'});
    $("ul").css({'list-style-type': 'none', 'margin': '0', 'padding': '0', 'overflow': 'hidden', 'background-color': '#333333'});
    $("li").css('float','left');
    $("li a").css({'display': 'block', 'color': 'white', 'text-align': 'center', 'padding': '16px', 'text-decoration': 'none'});
    $("li a hover").css('background-color', '#111111');
    $("table, td, th").css({'border': '1px solid black', 'border-collapse': 'collapse'});
    $(".reserve").css({'margin':'auto', 'text-align': 'center'});
    function loadData(page){
      $.ajax({
        url  : "pagination1.php",
        type : "POST",
        cache: false,
        data : {page_no:page},
        success:function(response){
          $("#table-data").html(response);
        }
      });
    }
    loadData();
    // Pagination code
    $(document).on("click", ".pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");

      loadData(pageId);
    });
  });
</script>

<body>

<div >
  <h1>Room reservation - Radisson Blue</h1>
</div>

<div >
  <div >
    <div >
      <div id="table-data">
        <?php
        session_start();
        unset($_SESSION["check_in"]);
        unset($_SESSION["check_out"]);
        unset($_SESSION["hotel"]);
        unset($_SESSION["type"]);
        unset($_SESSION["category"]);
        unset($_SESSION["capacity"]);
        unset($_SESSION["price"]);

        	// Connect database
          // error_reporting(E_ERROR | E_PARSE);
        	require_once('db_config.php');

          //create table booking
          $table_exist = "select * from information_schema.tables where table_schema = 'pw_lab' and table_name = 'booking' limit 1";
          $result_exist = mysqli_query($conn,$table_exist);
          $num_rows_exist = mysqli_num_rows($result_exist);
          if ($num_rows_exist==0) {
            $query_create = "create table booking (user_id int, room_id int, date_of_booking date default current_timestamp, check_in varchar(30), check_out varchar(30), foreign key (user_id) references user(id), foreign key (room_id) references room(id_room), primary key (user_id, room_id, date_of_booking))";
            $result_create = mysqli_query($conn, $query_create);
          }

          $option_from = isset($_POST['check_in']) ? $_POST['check_in'] : false;
          if ($option_from){
            $in = $_POST['check_in'];
            $_SESSION["check_in"] = $in;
          }
          $option_until = isset($_POST['check_out']) ? $_POST['check_out'] : false;
          if ($option_until){
            $out = $_POST['check_out'];
            $_SESSION["check_out"] = $out;
          }

          $query = "SELECT * FROM room where";
          $i=0;
         $option1 = isset($_POST['hotel']) ? $_POST['hotel'] : false;
         if ($option1){
           $i=$i+1;
           $hotel = $_POST['hotel'];
           $_SESSION["hotel"] = $hotel;
           $query.= " hotel = '" . $hotel ."'";
         }
         $option2 = isset($_POST['category']) ? $_POST['category'] : false;
         if ($option2){
           $category = $_POST['category'];
           $_SESSION["category"] = $category;
           $query.= " and category = '" . $category ."'";
         }
         $option3 = isset($_POST['type']) ? $_POST['type'] : false;
         if ($option3) {
           $type = $_POST['type'];
           $_SESSION["type"] = $type;
           $query.= " and type = '" . $type . "'";
         }
         $option4 = isset($_POST['capacity']) ? $_POST['capacity'] : false;
         if ($option4){
           $capacity = $_POST['capacity'];
           $_SESSION["capacity"] = $capacity;
           $query.= " and capacity = " . $capacity;
         }
         $sql=$query;
         echo $sql;
        	$limit = 4;

        	if (isset($_POST['page_no'])) {
        	    $page_no = $_POST['page_no'];
        	}else{
        	    $page_no = 1;
        	}
          echo $page_no;
        	$offset = ($page_no-1) * $limit;

          $query.= " LIMIT ". $offset .",". $limit ;

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
                      <td><div class='reserve'><a href='reservation.php?section=room&category=".$row['category']."&type=".$row['type']."&price=".$row['price']."&capacity=".$row['capacity']."&hotel=".$row['hotel']."'>Book room</a></div></td>
        		 </tr>";
        	}
        	$output.="</tbody>
        		</table>";

        	$records = mysqli_query($conn, $sql);

        	$totalRecords = mysqli_num_rows($records);

        	$totalPage = ceil($totalRecords/$limit);

        	$output.="<ul class='pagination justify-content-center' style='display: flex; justify-content: center; margin:20px 0'>";

        	for ($i=1; $i <= $totalPage ; $i++) {
        	   if ($i == $page_no) {
        		$active = "active";
        	   }else{
        		$active = "";
        	   }

        	    $output.="<li><a class='page-link' id='$i' href=''>$i</a></li>";
        	}

        	$output .= "</ul>";
          $output .= "</form>";

        	echo $output;
        	}

          else {
            echo "You must choose at least one category to filter results.";
            unset($_SESSION["check_in"]);
            unset($_SESSION["check_out"]);
            unset($_SESSION["hotel"]);
            unset($_SESSION["type"]);
            unset($_SESSION["category"]);
            unset($_SESSION["capacity"]);
            unset($_SESSION["price"]);

          }

        ?>
      </div>
    </div>
  </div>
</div>

<form method ='get' action='lab10_1.php'>
<button  type='submit' style ='font-size:30px'> Back</button>
</form>

<form method ='get' action='reservation.php'>
<button class = 'show_reservations' type='submit'> Show my reservations</button>
</form>

</body>
</html>
