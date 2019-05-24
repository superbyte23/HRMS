<?php
	require_once 'includes/config.php';
	// QUERY TO CHECK IF ALREADY HAVE A ROOM
	$query = mysqli_query($conn, "SELECT * FROM `tbl_reservations` WHERE `id` =".$_GET['id']);

	$date = date_create();
	$new_date = date_format($date, 'm/d/Y');

	if (mysqli_num_rows($query)>0) {
		while ($row = mysqli_fetch_assoc($query)) {

			if ($row['guest_arrival'] != $new_date) {
				?><script type="text/javascript">alert('Arrival Date is not Today'); history.back();</script><?php

			}else{ // IF ABOVE STATEMENT RETURN FALSE THEN UPDATE ROOM STATUS AND RESERVATION STATUS
				$Update_checkin = mysqli_query($conn, "UPDATE `tbl_reservations` SET `guest_check_in`= CURTIME(), `status`='active' WHERE `id`=".$_GET['id']);
				if ($Update_checkin) {
					// extract room Id according to check-in
					header('location: manage_check_in.php?check_in_success');
					$room_extract = mysqli_query($conn, "SELECT `room_number` FROM `tbl_reservations` WHERE `id`=".$_GET['id']);
					


					if (mysqli_num_rows($room_extract)>0) {
						while ($row = mysqli_fetch_assoc($room_extract)) {
							$room_id = $row['room_number'];
						} // end while statement
						



						$sql_update_room = mysqli_query($conn, "UPDATE `tbl_rooms` SET `room_status`= 'active' WHERE `room_id` = '$room_id'");
						if ($sql_update_room) {
							header('location: manage_check_in.php?check_in_success');
						



						}else{
							header('location: manage_reservations.php?check_in_error');
						} // end if statement
					




					}else{
						header('location: manage_reservations.php?check_in_error');
					}	// end if statement
				






				}else{
					header('location: reservations.php?check_in_error');
				}	// end if statement
			}
		}
	}
?>
<!--  -->