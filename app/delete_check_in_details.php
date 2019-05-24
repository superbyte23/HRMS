<?php
require_once '../includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	// Delete reservation query

	$sql = mysqli_query($conn, "DELETE FROM `tbl_reservations` WHERE `id` =".$_GET['id']);

	if (!$sql) {
		echo "<script>alert('Error Removing Data'); window.location = '../manage_reservations.php'; </script>";
	}else{
		echo "<script>window.location = '../manage_check_in.php?remove'; </script>";
	}
}