<?php

date_default_timezone_set('Asia/Manila');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbnme = "rsevenstar_database";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbnme);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
?>