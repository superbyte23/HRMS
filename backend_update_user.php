<?php
    
        if (isset($_POST['btn_update'])) {
            require 'includes/config.php';

            $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $update_query = mysqli_query($conn, "UPDATE `tbl_users` SET `username`= '$username' ,`password`= sha1('$password')
                WHERE `user_id` = '$user_id'");
            if ($update_query) {
                header('location: settings.php?updated');
            }
        }else{
            
        }
?>