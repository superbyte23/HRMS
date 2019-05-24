
<?php   include 'includes/config.php';
$arr_date = '06/06/2018';
    echo '<option value="">Select Room</option>';

    // select reservations where status is active or reserve according to date
    $query1 = mysqli_query($conn, "SELECT DISTINCT r.`room_id`, rs.`number_of_nights` as  nights, r.`room_number`, rt.`rm_type_name`, rs.`status`
                                   FROM `tbl_rooms` r
                                   LEFT JOIN `tbl_room_type` rt ON r.`room_type` = rt.`rm_type_id`
                                   LEFT JOIN tbl_reservations rs ON r.`room_id` = rs.`room_number`
                                   WHERE r.`room_type` = 1 AND rs.`status` <> 'inactive'");


    if (mysqli_num_rows($query1)>0) {

        while($row1 = mysqli_fetch_assoc($query1)){

          
          $id[] = $row1['room_id']; // array ID

          if ($row1['status'] == "active")
              {
                echo '<option class="text-danger" disable value="'.$row1['room_id'].'">'.$row1['room_number'].' - '.$row1["rm_type_name"].' Active</option>';
              }elseif($row1['status'] == "reserve"){
                echo '<option class="text-info" value="'.$row1['room_id'].'">'.$row1['room_number'].' - '.$row1["rm_type_name"].' Reserve</option>';
              }

        }

          $nights = $row1['nights'];
          $date1 = date_create($row1['guest_arrival']);
          $date2 = date_create($arr_date);
          $diff=date_diff($date1,$date2);
          $interval = $diff->format("%a");
          echo $row1['nights'];
          echo "interval : $interval ";
          if ($interval <= $nights) {
            echo "Active until";
          }

    }
?>