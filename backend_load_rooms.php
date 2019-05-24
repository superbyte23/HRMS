
<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["room_id"])){
    //Fetch all state data
    $sql = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r LEFT JOIN `tbl_room_type` rt ON r.`room_type` = rt.`rm_type_id` WHERE `room_id` = ".$_POST['room_id']);
    if (mysqli_num_rows($sql)>0) {
       while ($row = mysqli_fetch_assoc($sql)) {
       		$room_id = $row['room_id'];
            $room_number = $row['room_number'];
            $room_type_id = $row['rm_type_id'];
            $room_type = $row['rm_type_name'];
            $room_status = $row['room_status'];
       }

    }
}
?>
<form action="backend_update_room.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-primary border-0">
                    <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Update Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="modal-body">
                    <div class="form-row">                    	
                            <input type="text" name="update_room_id" hidden="" value="<?php echo $room_id; ?>">
                            <div class="form-group col-md-6">
                              <label for="dbname">Room Number</label>
                              <input type="text" value="<?php echo $room_number; ?>" class="form-control" id="dbname" placeholder="Room Number" name="update_room_number"  required="">
                            </div>

                            <div class="form-group col-md-6">
                              	<label for="dbname">Status</label>
                              	<select id="single-select" class="form-control" name="update_room_status" required="">
                              		<option value="active">Active</option>
                              		<option value="inactive">Inactive</option>
                              	</select>
                        	</div>
                            <div class="form-group col-md-12">
                                <label for="single-select">Select Room Type</label>
                                <select id="single-select" class="form-control" name="update_room_type">

                                    <?php
                                    echo "<option value='".$room_type_id."' selected>".$room_type."</option>";
                                        $r_type = mysqli_query($conn, "SELECT * FROM `tbl_room_type` WHERE `rm_type_id` <> '$room_type_id'");
                                        if (mysqli_num_rows($r_type)>0) {
                                            while ($r = mysqli_fetch_assoc($r_type)) {
                                                echo '<option value="'.$r["rm_type_id"].'">'.$r["rm_type_name"].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                      <div class="form-group pull-right">
                            <button type="submit" type="button" class="btn btn-primary" name="update"><i class="fa fa-check"></i> Update Room</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                      </div>
                </div>
            </div>
        </form>