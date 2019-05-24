<?php include 'session.php';
 
    $settings = mysqli_query($conn, "SELECT * FROM `settings`");
if (!isset($_SESSION['user_id'])) {
   ?>
        <script type="text/javascript">
            window.location = "login.php";
        </script>
    <?php
}else{
    $sql = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE `user_id` =".$_SESSION['user_id']);
    if (mysqli_num_rows($sql)>0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $username = $row['username'];
            $user_type = $row['user_type'];
        }
    }
}
	
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="author" description="mr.superbyte"/>
    <title>R-Seven Star</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!--  external stylesheets -->
    <!-- <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css"> -->
    <link rel="stylesheet" href="./vendor/font-awesome 4/css/font-awesome.min.css">
    <link rel="stylesheet" href="./vendor/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="./vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="./vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/color.css">
    <link rel="stylesheet" type="text/css" href="./vendor/jquery-confirm/jquery-confirm.min.css"/>
    <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./vendor/blueimp/css/blueimp-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="./css/custom.css">
    <!--  external stylesheets -->

    <!-- internal stylesheet -->
    <style type="text/css">
        
    </style>
    <!-- internal stylesheet -->

    <!-- javascript plugins -->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper.js/popper.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/chart.js/chart.min.js"></script> 
    <script src="./vendor/DataTables/datatables.min.js"></script>
    <script src="./vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>    
    <script src="./vendor/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="./js/carbon.js"></script>
    <script src="./js/demo.js"></script>
    <script src="./vendor/blueimp/js/jquery.blueimp-gallery.min.js"></script>
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- javascript plugins -->
    <script>
        function click_logout(){
            $(document).ready(function(){
                $.confirm({

                            icon: 'fa fa-question-circle-o',
                            theme: 'supervan',
                            title: 'Logout',
                            content: '<p>Are you sure you want to logout?</p>',
                            closeIcon: true,
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            animateFromElement: false,
                            animationSpeed: 100, // 0.1 seconds
                            backgroundDismiss: true,
                            type: 'orange',
                            buttons: {
                                confirm: {
                                    text: 'Yes',
                                    btnClass: 'btn-sm bg-blue-dark',
                                    action: function () {
                                        window.location = "app/logout.php";
                                        
                                    }
                                },
                                Cancel: function () {
                                    // lets the user close the modal.
                                }
                            },
                        });
            });
        }
    </script>
</head>
<body class="sidebar-fixed header-fixed" id="tester" style="background-image: url(imgs/bg.jpg);">
<div class="page-wrapper">
    <nav class="navbar page-header no-print">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="index.php">
            <img src="./imgs/logo1.png" alt="R-Seven Star" style="margin-left: -10px; margin-top: -10px; position: relative;">
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto no-print">
            <!-- <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li>

            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-envelope-open"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li> -->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="./imgs/administrator.png" class="avatar avatar-sm bg-teal-lighter" alt="logo">
                    <span class="small ml-1 d-md-down-none"><?php echo $username; ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Account</div>

                   

                    <!-- <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope"></i> Messages
                    </a>

                    <div class="dropdown-header">Settings</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-bell"></i> Notifications
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-wrench"></i> Settings
                    </a> -->
                    <?php 
                           
                        if ($_SESSION['user_type'] == 'administrator' || $_SESSION['user_type'] == 'Administrator') {
                            echo '<a href="settings.php" class="dropdown-item">
                                    <i class="fa fa-cogs text-danger"></i> Settings
                                </a>';
                        }
                        echo '<a href="#" class="dropdown-item" onclick="click_logout();">
                                    <i class="fa fa-sign-out text-info"></i> Logout '.$user_type.'
                                </a>';
                     ?>
                    
                </div>
            </li>
        </ul>
    </nav>