<?php
    
        if (isset($_POST['update'])) {
            require 'includes/config.php';

            $room_id = mysqli_real_escape_string($conn, $_POST['update_room_id']);
            $room_number = mysqli_real_escape_string($conn, $_POST['update_room_number']);
            $room_type = mysqli_real_escape_string($conn, $_POST['update_room_type']);
            $room_status = mysqli_real_escape_string($conn, $_POST['update_room_status']);

            $update_query = mysqli_query($conn, "UPDATE `tbl_rooms` SET `room_number`= '$room_number' ,`room_type`= '$room_type' ,`room_status`= '$room_status' WHERE `room_id` = '$room_id'");
            if ($update_query) {
                header('location: room_numbers.php?success');
            }
        }
?>