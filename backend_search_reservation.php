<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["from"])){
    $arr = date_create($_POST['from']);
    $end = date_create($_POST['to']);
    $from = date_format($arr, 'm/d/Y');
    $to = date_format($end, 'm/d/Y');

    //Fetch all state data
$query = mysqli_query($conn, "SELECT * FROM `tbl_reservations` WHERE (`guest_arrival` >= '$from' AND `end_reserve_date` <= '$to') OR (`guest_arrival` <= '$to' AND `end_reserve_date` >= '$from') AND (`status` = 'reserve')");

// $query = mysqli_query($conn, "SELECT DISTINCT(`room_number`) FROM `tbl_reservations` WHERE `guest_arrival` >= '$from' AND `guest_arrival` <= '$to' AND `status` = 'reserve'");
    
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
            echo '    <td>'.$row['end_reserve_date'].'</td>';
            echo '    <td><i class="fa fa-hotel"></i> '.$row['room_number'].'</td>';
            echo '</tr>';
        }
    }else{
        echo '<script type="text/javascript"> alertRecord(); </script>'; 
    }
}
?>

<!--  -->