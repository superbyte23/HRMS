
<?php
//Include the database configuration file
include 'includes/config.php';

if(!empty($_POST["id"])){
    //Fetch all state data
    $sql = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE `user_id` =".$_POST['id']);
    if (mysqli_num_rows($sql)>0) {
       while ($row = mysqli_fetch_assoc($sql)) {
       		$user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['password'];
            $user_type = $row['user_type'];
       }

    }
}
?>
        <form action="backend_update_user.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header bg-primary border-0">
              <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Update User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
				  <div class="modal-body">
           <div class="col-md-12">
            <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
              <label>Username</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username ?>">
              </div>
              <label>Password <span class="text-danger">(Auto encrypt function)</span></label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-eye"></i></span>
                  </div>
                  <input type="text" class="form-control" name="password" placeholder="Password" value="<?php echo $password ?>">
              </div>
              <div class="input-group mb-3">
                  <button type="submit" name="btn_update" class=" btn btn-primary btn-block"> Update</button>
              </div>
            </div>
          </div>
        </form>