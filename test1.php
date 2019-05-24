<?php require 'includes/header.php'; ?>
	<table border="1">
		<thead>
			<th>id</th>
			<th>Room #</th>
			<th>Arrival date</th>
			<th># nights</th>
			<th>check Out Date</th>
		</thead>
		<tbody>
		<?php
			include 'includes/config.php';
			if (isset($_POST['check'])) {

				$a = date_create($_POST['new_date']);
				$new_date = date_format($a, "m/d/Y");

			$query1 = mysqli_query($conn, "SELECT r.`room_id`, r.`room_number`, rt.`rm_type_name`, rs.`status`, rs.`guest_arrival`,`number_of_nights`
                                   FROM `tbl_rooms` r
                                   LEFT JOIN `tbl_room_type` rt ON r.`room_type` = rt.`rm_type_id`
                                   LEFT JOIN tbl_reservations rs ON r.`room_id` = rs.`room_number`
                                   WHERE r.`room_type` = 1
                                   AND rs.`guest_arrival` <= '06/09/2018' AND rs.guest_arrival >= rs.guest_arrival AND rs.`status` <> 'inactive' ORDER BY rs.guest_arrival DESC LIMIT 1");

			if (mysqli_num_rows($query1)>0) {

				while ($row=mysqli_fetch_assoc($query1)) {

					$date1=date_create($row['guest_arrival']);
					$numberOfnights = $row['number_of_nights'];
					date_add($date1,date_interval_create_from_date_string("$numberOfnights days"));
					//$checkout_date = date_add($new_date,date_interval_create_from_date_string("$numberOfnights days"));
					$endDate =  date_format($date1,"m/d/Y");
						echo $new_date;
						echo '<tr>';
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['room_number']."</td>";
						echo "<td>".$row['guest_arrival']."</td>";
						echo "<td>".$row['number_of_nights']."</td>";
						echo "<td>".$endDate."</td>";
						echo '<tr>';


					if ($endDate >= $new_date) {
						echo ' not Avail for room '.$row["room_number"].'<br> ';
					}else{
						echo ' Avail for room '.$row["room_number"].'<br> ';
					}
				}

			  }	else{
				echo "no record";
				}
			}
		?>
		</tbody>
</table>

	<form method="POST" action="">
		<input type="date" name="new_date" required=""><br>

		<button name="check" type="submit">check</button>
	</form>


	<br>
	<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp<h1 style="font-size: 300px; padding: 50px;"><i class="fa fa-hotel"></i></h1>
</body>
</html>
