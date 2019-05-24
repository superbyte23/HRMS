<?php require 'includes/header.php';
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add'])) {
          
            $room_number = mysqli_real_escape_string($conn, $_POST['room_number']);
            $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);

            $check_room = mysqli_query($conn, "SELECT * FROM `tbl_rooms` WHERE `room_number` = '$room_number'");
            if (mysqli_num_rows($check_room)>0) {
               ?>
                    <script type="text/javascript">
                        alert("Room number already exist.");
                    </script>
                <?php
            }else{
                $add_room = mysqli_query($conn, "INSERT INTO `tbl_rooms`(`room_number`, `room_type`) VALUES ('$room_number','$room_type')");

                    if ($add_room) {
                        ?>
                            <script type="text/javascript">
                                window.location = "room_numbers.php?success"
                            </script>
                        <?php
                    }else{
                        ?>
                            <script type="text/javascript">
                                alert("Error adding new room. Review details");
                                history.back();
                            </script>
                        <?php
                    }
                 }
            }
        }
    $room_type_query = mysqli_query($conn, "SELECT `rm_type_id`, `rm_type_name` FROM `tbl_room_type`");
    
?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>

        <div class="content"><!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb" style="padding: 0; background: none; margin-top: -20px;">
                <li class="breadcrumb-item"><a href="#" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</a></li>
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Rooms</li>
              </ol>
            </nav>
            <div class="page-title">
                <h2><i class="fa fa-hotel"></i> Room Numbers <a href="#" data-toggle="modal" data-target="#add_room" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i>  Add Room</a></h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive dataTable">
                                <table class= "table table-hover table-sm text-center"  cellspacing="0" width="100%" >
                                    <thead> 
                                    <tr>
                                        <th width="10">room Id</th>
                                        <th>Room Number</th>
                                        <th>Room Category</th>
                                        <th>Room Status</th>
                                        <th width="10">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="rooms_table">
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM `tbl_rooms` r left join `tbl_room_type` rt on r.`room_type` = rt.`rm_type_id`");
                                            if (mysqli_num_rows($sql)>0) {
                                               while ($row = mysqli_fetch_assoc($sql)) {
                                                if ($row['room_status'] == 'active') {
                                                    echo '<tr class="bg-red text-light">';
                                                }else{
                                                    echo '<tr>';
                                                }
                                                    
                                                    echo '    <td>'.$row['room_id'].'</td>';
                                                    echo '    <td><i class="fa fa-key"></i>  '.$row['room_number'].'</td>';
                                                    echo '    <td>'.$row['rm_type_name'].'</td>';
                                                    echo '    <td>'.$row['room_status'].'</td>';
                                                    echo '<td><a class="btn btn-xs room_edit btn-block btn-info" href="#" data-toggle="modal" data-target="#update_room" data-index="'.$row['room_id'].'">Update</a></td>';
                                                    echo '</tr>';
                                                

                                               }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-primary border-0">
                    <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Add Room Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="dbname">Room Number</label>
                              <input type="text" class="form-control" id="dbname" placeholder="Room Number" name="room_number" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="single-select">Example select</label>
                                <select id="single-select" class="form-control" name="room_type">
                                    <?php
                                        $r_type = mysqli_query($conn, "SELECT * FROM `tbl_room_type`");
                                        if (mysqli_num_rows($r_type)>0) {
                                            while ($r = mysqli_fetch_assoc($r_type)) {
                                                echo '<option value="'.$r["rm_type_id"].'">'.$r["rm_type_name"].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                      <div class="form-group pull-right">
                            <button type="submit" type="button" class="btn btn-primary" name="add"><i class="fa fa-check"></i> Add Room</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                      </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="update_room_details">
                    
            </div>
        </div>
    </div>
</div>
<style type="text/css">
                            
                            .bd-example-border-utils [class^=border] {
                                display: inline-block;
                                width: 5rem;
                                height: 5rem;
                                margin: .25rem;
                                background-color: #f5f5f5;
                                text-align: center; 
                            }
                            .bd-example-border-utils [class^=border] i {
                                font-size: 3rem;
                            }
                            .bd
                            </style>
<script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,               
            });
        })
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.room_edit').on('click',function(){
        var room_id = $(this).data('index');
        if(room_id){
            $.ajax({
                type:'POST',
                url:'backend_load_rooms.php',
                data:'room_id='+room_id,
                success:function(html){
                    $('#update_room_details').html(html);
                }
            });
        }else{
            $('#rooms').html('<option value="">Select Room Type first</option>'); 
        }
    });
});
</script>
</body>
</html>
