
<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["room_type"])){

    $room_type = $_POST['room_type'];
    $from = $_POST['arr_date'];
    $nights = $_POST['nights'];
    $pre = date_create($from);
    date_add($pre,date_interval_create_from_date_string("$nights days"));
    $to = date_format($pre, 'm/d/Y');


    echo "<option value=''>Select Room Number</option>";
        $query = mysqli_query($conn, "
                        SELECT DISTINCT
                            (`room_number`)
                        FROM
                            `tbl_reservations`
                        WHERE
                            (
                                (`guest_arrival` >= '$from' AND `end_reserve_date` <= '$to')
                                OR
                                (`guest_arrival` <= '$to' AND `end_reserve_date`)

                            )
                            AND
                            (
                                `status` IN('active', 'reserve')
                            )");


    if (mysqli_num_rows($query)>0) {
        // populate room_id
        while ($row = mysqli_fetch_assoc($query)) {
           $id[] = $row['room_number'];
        }

        $room_reserved = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r WHERE r.`room_type` = '$room_type'  AND r.`room_id` IN (".implode(",",$id).")");

        if (mysqli_num_rows($room_reserved)>0) {
            // display active rooms
           while ($row1 = mysqli_fetch_assoc($room_reserved)) {
               if ($row1['room_status'] == 'active') {
                   echo '<option class="text-danger" value="'.$row1['room_id'].'" disabled>'.$row1['room_number'].' Active</option>';
               }
               else{
                echo '<option class="text-danger" value="'.$row1['room_id'].'" disabled>'.$row1['room_number'].' Reserved</option>';
               }
           }

           $available = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r WHERE r.`room_type` = '$room_type' AND r.`room_id` NOT IN (".implode(",",$id).")");

            // display only  available rooms
            if (mysqli_num_rows($available)>0) {
                while ($avl = mysqli_fetch_assoc($available)) {
                    echo '<option class="text-success" value="'.$avl['room_id'].'">'.$avl['room_number'].' Available</option>';
                }
            }

        }
        else{
            // statement trigger when above statement failed
            $all_rooms = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r WHERE r.`room_type` = '$room_type'");

            // display rooms according to room type and available rooms
            // this statement is executed to insert first data of each room type
            if (mysqli_num_rows($all_rooms)>0) {
                while ($avl = mysqli_fetch_assoc($all_rooms)) {
                    echo '<option class="text-success" value="'.$avl['room_id'].'">'.$avl['room_number'].' Available</option>';
                }
            }
        }
    }
    else{
        // this query is dislay all rooms if reservations table is empty.
        $all_rooms = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r WHERE r.`room_type` = '$room_type'");

        if (mysqli_num_rows($all_rooms)>0) {
            while ($room = mysqli_fetch_assoc($all_rooms)) {
                echo '<option class="text-success" value="'.$room['room_id'].'">'.$room['room_number'].' Available</option>';
            }
        }
    } // end first if else statement
}
?>
