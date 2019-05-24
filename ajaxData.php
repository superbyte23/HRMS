
<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["room_type"])){
  echo '<option value="">Select Room Number</option>';
    $arr_date = $_POST['arr_date'];
    //select all rooms if above statements are false where status is active
      $query3 = mysqli_query($conn, "SELECT r.*, rt.*
                                     FROM `tbl_rooms` r
                                     left join `tbl_room_type` rt on r.`room_type` = rt.`rm_type_id`
                                     WHERE r.`room_type` =".$_POST['room_type']);


      if (mysqli_num_rows($query3)>0) {
          while($row3 = mysqli_fetch_assoc($query3)){
              if ($row3['room_status'] == "active")
                  {
                      echo '<option class="text-danger" disable value="'.$row3['room_id'].'" disabled>'.$row3['room_number'].' - '.$row3["rm_type_name"].' Active</option>';
                  }
              else
                  {
                      echo '<option class="text-success" value="'.$row3['room_id'].'">'.$row3['room_number'].' - '.$row3["rm_type_name"].' Ready</option>';
                  }
          }
      }else{
          echo '<option value="">No Available Rooms</option>';
      }
}
?>
<!--  -->
