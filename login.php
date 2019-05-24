<?php
require_once 'includes/session.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>R-Seven Inn</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
<div class="page-wrapper flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        <img src="imgs/logo.jpg">
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="card-body py-5">
                            <div class="form-group">
                                <label class="form-control-label">Username</label>
                                <input type="text" class="form-control" name="username" required="" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input type="password" class="form-control" name="password" required="" autocomplete="off">
                            </div>
                            <!-- 
                            <div class="custom-control custom-checkbox mt-4">
                                <input type="checkbox" class="custom-control-input" id="login">
                                <label class="custom-control-label" for="login">Check this custom checkbox</label>
                            </div> -->
                            
                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="form-group">
                                 <a href="#" class="btn btn-link">Forgot password?</a>
                            </div> 
                        </div>
                        <div class="card-footer">
                            <ul>
                                <li><a href="#"><img src="imgs/social/Facebook.png"></a></li>
                                <li><a href="#"><img src="imgs/social/Gmail.png"></a></li>
                                <li><a href="#"><img src="imgs/social/twitter.png"></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
</body>
</html>
<?php
if ($_SESSION) {
    header("location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =  mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql=mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE `username` = '$username' AND `password` = sha1('$password')");
    if (mysqli_num_rows($sql)==1) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];
            $user_type = $row['user_type'];
        }
        if ($user_type == "administrator") {
            echo("<script>alert('Welcome ".$user_type."');window.location = 'index.php';</script>");
        }else{
            echo("<script>alert('Welcome ".$user_type."');window.location = 'index.php';</script>");
        }
    }else{
        ?>
        <script>
            alert('Invlid Username and Password');
            window.location = 'login.php';
        </script>
        <?php
    }
}
?>