<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["from"])){

    $from = $_POST['from'];
    $to = $_POST['to'];
    //Fetch all state data
    $query = mysqli_query($conn, "SELECT rs.`id`, rs.`guest_name`, rs.`guest_address`, rs.`guest_contact`, rs.`guest_arrival`, rs.`room_type`, r.`room_number`, rs.`guest_check_in`, rs.`guest_check_out`, rs.`number_of_nights`, rs.`extra_bed`, rs.`extra_person`, rs.`extra_pillow`, rs.`extra_towel`, rs.`last_update`, DATE_FORMAT(`trans_date`, '%Y-%m-%d') AS trans_date FROM `tbl_reservations` rs LEFT JOIN `tbl_rooms` r ON rs.`room_number` = r.`room_id` WHERE trans_date BETWEEN '$from 00:00:00' AND '$to 00:00:00' AND rs.`status` = 'inactive'" );
    
    //Count total number of rows
    $rowCount = mysqli_num_rows($query);
    
    //State option list
    if($rowCount > 0){
        while ($row = mysqli_fetch_assoc($query)) {
            $date=date_create($row['trans_date']);
           
            echo '<tr style="padding: 0; margin: 0;">';
            echo '    <td>'.date_format($date,"m-d-Y").'</td>';
            echo '    <td>'.$row['guest_name'].'</td>';
            echo '    <td>'.$row['guest_address'].'</td>';
            echo '    <td>'.$row['guest_contact'].'</td>';
            echo '    <td>'.$row['guest_arrival'].'</td>';
            echo '    <td><i class="fa fa-hotel"></i> '.$row['room_number'].'</td>';
            echo '    <td>'.$row['guest_check_in'].'</td>';
            echo '    <td>'.$row['guest_check_out'].'</td>';
            echo '</tr>';
        }
    }else{
        echo '<script type="text/javascript">
    alertRecord();
</script>';
    }
}elseif (empty($_POST["arr_date"])) {
    echo '<div class=" alert alert-danger">Select Room First</div>';
}
?>

