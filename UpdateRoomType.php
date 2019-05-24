<?php require 'includes/header.php';
    if (isset($_GET['id'])) {
        $query = mysqli_query($conn, "SELECT * FROM `tbl_room_type` WHERE `rm_type_id` =".$_GET['id']);
        $result = $query->num_rows;
        if ($result > 0) {
           while ($row = $query->fetch_assoc()) {
                $rm_type_id = $row['rm_type_id'];
                $rm_type_name = $row['rm_type_name'];
                $rm_type_pricing  = $row['rm_type_pricing'];
                $rm_type_desc = $row['rm_type_desc'];
                $rm_type_cover_img = $row['rm_type_cover_img'];
           }
        }
    }elseif (isset($_POST['Update'])) {
        /*Declare Variables */
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $pricing = mysqli_real_escape_string($conn, $_POST['pricing']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $rm_id = mysqli_real_escape_string($conn, $_POST['rm_id']);

        if (!$_FILES["cover_img"]["name"]) {
            $sql=mysqli_query($conn, "UPDATE `tbl_room_type` SET `rm_type_name`= '$name',`rm_type_pricing`= '$pricing',`rm_type_desc`= '$description' WHERE `rm_type_id`= '$rm_id'");
                if ($sql) {
                    ?>
                        <script>
                            window.location = "rooms.php?success";
                        </script>
                    <?php
                }else{
                    ?>
                        <script>
                            alert("Error Adding New Room");
                            window.location = "";
                        </script>
                    <?php
                }
        }else{
            /*  Cover Image Upload Complete Script  */
            $target_dir = "assets/images/rooms/";
            $target_file = $target_dir . basename($_FILES["cover_img"]["name"]);  
            $file_loc = $_FILES['cover_img']['tmp_name'];
            $file_size = $_FILES['cover_img']['size'];
            $file_type = $_FILES['cover_img']['type'];
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file

            } else {
                if (move_uploaded_file($_FILES["cover_img"]["tmp_name"], $target_file)) {
                    
                    $sql=mysqli_query($conn, "UPDATE `tbl_room_type` SET `rm_type_name`= '$name',`rm_type_pricing`= '$pricing',`rm_type_desc`= '$description', `rm_type_cover_img` = '$target_file' WHERE `rm_type_id`= '$rm_id'");
                    if ($sql) {
                        ?>
                            <script>
                                window.location = "rooms.php?success";
                            </script>
                        <?php
                    }else{
                        ?>
                            <script>
                                alert("Error Adding New Room");
                                window.location = "";
                            </script>
                        <?php
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }else{
    header('location: 404.php');
}
?>
<!--  -->
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>
        <div class="content">
        <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb" style="padding: 0; background: none; margin-top: -20px;">
                <li class="breadcrumb-item"><a href="#" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</a></li>
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Update Room Type</li>
              </ol>
            </nav>
            <div class="card">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                    <div class="card-header bg-dark border-0">
                        <h5 class="modal-title text-white"><i class="fa fa-plus-square"></i><strong> Update Room Type</strong></h5>
                    </div>
                    <div class="card-body" id="test">

                        <input type="text" name="rm_id" value="<?php echo $rm_type_id; ?>" hidden>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="dbname">Bedroom Name</label>
                              <input type="text" class="form-control" id="dbname" placeholder="Bedroom Name" name="name" required="" value="<?php echo $rm_type_name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="pricing">Pricing</label>
                              <input type="number" class="form-control" id="pricing" placeholder="(Php)" name="pricing" required="" value="<?php echo $rm_type_pricing; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id="desc" placeholder="Description" rows="5" name="description" required=""><?php echo $rm_type_desc; ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="_room_image">Change Cover Image</label>
                            <input type="file" class="form-control-file" id="_room_image" name="cover_img">
                                
                            </div>
                        <div class="form-group" id="image">
                            <img src="<?php echo $rm_type_cover_img; ?>" class="img-thumbnail" width="200" height="200" id="img-thumbnail">    
                        </div>
                    </div>
                    <div class="card-footer">
                          <div class="form-group">
                                <button type="submit" type="button" class="btn btn-primary" name="Update"><i class="fa fa-check"></i> Update Room</button>
                                <button type="button" class="btn btn-danger" onclick="history.back();"><i class="fa fa-times"></i> Cancel</button>
                          </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e){
                $('#img-thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#_room_image').change(function(){
        readURL(this);
    })
</script>
</body>
</html>
