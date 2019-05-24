<?php require 'includes/header.php';

    if (isset($_POST['add'])) {
    /*Declare Variables */

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pricing = mysqli_real_escape_string($conn, $_POST['pricing']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (!$_FILES["cover_img"]["name"]) {
        $query = mysqli_query($conn, "INSERT INTO `tbl_room_type`(`rm_type_name`, `rm_type_pricing`, `rm_type_desc`, `rm_type_cover_img`)
                                        VALUES ('$name','$pricing','$description','assets/images/rooms/no_image.jpg')");

        if ($query) {
                ?>
                    <script>
                        window.location = "rooms.php?success";
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        alert("Error Adding New Room");
                        window.location = "rooms.php?error";
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


        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["cover_img"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
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
                
                $sql=mysqli_query($conn, "INSERT INTO `tbl_room_type`(`rm_type_name`, `rm_type_pricing`, `rm_type_desc`, `rm_type_cover_img`)
                                            VALUES ('$name','$pricing','$description','$target_file')");
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
                            window.location = "rooms.php?error";
                        </script>
                    <?php
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
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
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Room Types</li>
              </ol>
            </nav>
            <div class="page-title"><h2><i class="fa fa-hotel"></i> Types of Rooms <a href="#" data-toggle="modal" data-target="#add_room" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i>  Add Room Type</a></h2></div>
            <div class="row">
                <?php
                $rooms_types = mysqli_query($conn, "SELECT * FROM `tbl_room_type`");
                if (mysqli_num_rows($rooms_types)>0) {
                   while ($row = mysqli_fetch_assoc($rooms_types)) {
                       echo '<div class="col-lg-3 col-md-3">
                                <div class="card border-0">
                                    <div class="card-header bg-default">
                                        <span class="float-right">
                                            <a href="UpdateRoomType.php?id='.$row["rm_type_id"].'" class="text-info"><i class="fa fa-edit"></i> Edit</a>
                                        </span>
                                        <strong class="h4">
                                            '.$row["rm_type_name"].'
                                        </strong>
                                    </div>
                                    <div class="card-body bg-default">
                                    <a class="gallery-item" href="'.$row["rm_type_cover_img"].'" title="'.$row["rm_type_name"].'" data-gallery>
                                        <div class="cover-img" >
                                            <img src="'.$row["rm_type_cover_img"].'" alt="" class="card-img">
                                        </div>

                                    </a>
                                        <div class="room_description"><br>
                                            <strong>Price</strong> :  <strong class="text-danger">'.$row["rm_type_pricing"].'.00 php</strong>
                                            <p>Description :</p>
                                            <p>'.$row["rm_type_desc"].'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                   }
                }
                ?>
                <!-- BLUEIMP GALLERY -->
                <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>      
                <!-- END BLUEIMP GALLERY -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-primary border-0">
                    <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Add Room Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="test">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="dbname">Room Type Name</label>
                          <input type="text" class="form-control" id="dbname" placeholder="Room Type Name" name="name" required="">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="pricing">Pricing</label>
                          <input type="number" class="form-control" id="pricing" placeholder="(Php)" name="pricing" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control" id="desc" placeholder="Description" rows="5" name="description" required=""></textarea>
                      </div>
                      <div class="form-group">
                        <label for="_room_image">Select Cover Image</label>
                        <input type="file" class="form-control-file" id="_room_image" name="cover_img">
                      </div>
                       <div class="form-group" id="image">
                            <img src="assets/images/rooms/no_image.jpg" class="img-thumbnail" width="200" height="200" id="img-thumbnail">    
                        </div>
                        <div class="form-group pull-right">
                            <button type="submit" type="button" class="btn btn-primary" name="add"><i class="fa fa-check"></i> Add Room</button>
                            <button type="button" class="btn btn-danger" id="dismiss" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    .cover-img img{
        height: 200px;  
        max-height: auto;
        min-height: auto;
        max-width: auto;
        min-width: auto;
    }
    .list{ 
  padding: 3px;
  margin-right: 0;
  margin-bottom: 0;
  margin-left: 0;
  border-width: .2rem;
}
</style>
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
    }); 
        $('#dismiss').click(function(){
            // alert("");
        });
</script>
</body>
</html>
