<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["arr_date"])){
    //Fetch all state data
    $query = mysqli_query($conn, "SELECT * FROM `tbl_reservations` WHERE `guest_arrival` = '".$_POST['arr_date']."' AND `room_number` ='".$_POST['room_number']."'");
    
    //Count total number of rows
    $rowCount = mysqli_num_rows($query);
    
    //State option list
    if($rowCount > 0){
        echo '<div class=" alert alert-danger">Room Already reserved in the date '.$_POST['arr_date'].'</div>';
    }else{
        echo '<div class=" alert alert-success">Room Availabe</div>';
    }
}elseif (empty($_POST["room_number"])) {
    echo '<div class=" alert alert-danger">Select Room First</div>';
}
?>