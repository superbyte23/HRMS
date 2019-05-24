	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
       	<form>
		<select class="form-control form-control-lg" required="">
      	<option selected="" value="">Select Room</option>
      		<?php
				require_once 'includes/config.php';
				$rooms = mysqli_query($conn, "SELECT * FROM `tbl_rooms` WHERE `room_type` = ".$_POST['room_type']);
				if (mysqli_num_rows($rooms)>0) {
					while ($row = mysqli_fetch_assoc($rooms)) {
						if ($row['room_status'] == 'active') {
							echo '<option class="text-danger">'.$row['room_number'].' Active</option>';
						}else{
							echo '<option class="text-success">'.$row['room_number'].' Ready</option>';
						}
							
					}
				}
			?>
		</select>
		</form>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Set Room</button>
    </div>