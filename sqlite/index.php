<?php require_once '_db.php';

	if ($_SERVER['PHP_SELF']) {
		if (isset($_POST['add'])) {
			$stmt = $db->prepare("INSERT INTO tbl_users (user_fname, user_lname, user_email, user_username, user_pass) VALUES (:user_fname, :user_lname, :user_email, :user_username, :user_pass)");
			$stmt->bindParam(':user_fname', $_POST['user_fname']);
			$stmt->bindParam(':user_lname', $_POST['user_lname']);
			$stmt->bindParam(':user_email', $_POST['user_email']);
			$stmt->bindParam(':user_username', $_POST['user_username']);
			$stmt->bindParam(':user_pass', $_POST['user_pass']);
			$stmt->execute();

			class Result {}

			$response = new Result();
			$response->result = 'OK';
			$response->message = 'Created with id: '.$db->lastInsertId();
			$response->id = $db->lastInsertId();

		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="./vendor/font-awesome 4/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendor/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="../vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="../vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/color.css">
    <link rel="stylesheet" type="text/css" href="../vendor/jquery-confirm/jquery-confirm.min.css"/>
    <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">

<body>
	<br>
	<div class="container">
		<form class="col-md-6" method="POST" action="">
			<div class="form-group">
			<label>First Name :</label><input type="" name="user_fname" class="form-control">
			</div>
			<div class="form-group">
			<label>Last Name :</label><input type="" name="user_lname" class="form-control">
			</div>
			<div class="form-group">
			<label>Email :</label><input type="" name="user_email" class="form-control">
			</div>
			<div class="form-group">
			<label>Usernam :</label><input type="" name="user_username" class="form-control">
			</div>
			<div class="form-group">
			<label>Password	 :</label><input type="" name="user_pass" class="form-control">
			</div>
			<button type="submit" class="btn btn-success" name="add">Add</button>
		</form>
	</div>
</body>
</html>