<?php
session_start();
	// Connect database

	require_once('db_config.php');

	$query = "SELECT * FROM room where";

	// $option1 = isset($_POST['hotel']) ? $_POST['hotel'] : false;
		if ($_SESSION["hotel"]){
			// $hotel = $_POST['hotel'];
			$query.= " hotel = '" . $_SESSION["hotel"] ."'";
		}
		// $option2 = isset($_POST['category']) ? $_POST['category'] : false;
		if ($_SESSION["category"]){
			// $category = $_POST['category'];
			$query.= " and category = '" . $_SESSION["category"] ."'";
		}
		// $option3 = isset($_POST['type']) ? $_POST['type'] : false;
		if ($_SESSION["type"]) {
			// $type = $_POST['type'];
			$query.= " and type = '" . $_SESSION["type"] . "'";
		}
		// $option4 = isset($_POST['capacity']) ? $_POST['capacity'] : false;
		if ($_SESSION["capacity"]){
			// $capacity = $_POST['capacity'];
			$query.= " and capacity = " . $_SESSION["capacity"];
		}
		$sql=$query;

	$limit = 4;

	if (isset($_POST['page_no'])) {
	    $page_no = $_POST['page_no'];
	}else{
	    $page_no = 1;
	}

	$offset = ($page_no-1) * $limit;

	$query.= " LIMIT ". $offset .",". $limit ;
	$result = mysqli_query($conn, $query);

	$output = "";

	if (mysqli_num_rows($result) > 0) {

		$output.="<table class='table'>
					<thead>
							<tr>
								 <th>Id</th>
								 <th>Category</th>
								 <th>Type</th>
								 <th>Price</th>
								 <th>Capacity</th>
								 <th>Hotel</th>
							 </tr>
					</thead>
						 <tbody>";
		while ($row = mysqli_fetch_assoc($result)) {

		$output.="<tr>
								<td>{$row['id_room']}</td>
								<td>{$row['category']}</td>
								<td>{$row['type']}</td>
								<td>{$row['price']}</td>
								<td>{$row['capacity']}</td>
								<td>{$row['hotel']}</td>
			 </tr>";
		}
	$output.="</tbody>
		</table>";

	$records = mysqli_query($conn, $sql);

	$totalRecords = mysqli_num_rows($records);

	$totalPage = ceil($totalRecords/$limit);

	$output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";

	for ($i=1; $i <= $totalPage ; $i++) {
	   if ($i == $page_no) {
		$active = "active";
	   }else{
		$active = "";
	   }

	    $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
	}

	$output .= "</ul>";

	echo $output;

	}

?>
