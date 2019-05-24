<?php require 'includes/header.php';
    if (isset($_GET['id'])) {
        $sql = mysqli_query($conn, "SELECT r.*, t.* FROM `tbl_reservations` r LEFT JOIN `tbl_room_type` t ON r.`room_type` = t.`rm_type_id` WHERE r.`id` =".$_GET['id']);
        if (mysqli_num_rows($sql)>0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                // Populate Data into Variables
                $id = $row['id'];
                $guest_name = $row['guest_name'];
                $guest_address = $row['guest_address'];
                $guest_contact = $row['guest_contact'];
                $guest_arrival = $row['guest_arrival'];
                $room_number = $row['room_number'];
                $guest_check_in = $row['guest_check_in'];
                $guest_check_out = $row['guest_check_out'];
                $number_of_nights = $row['number_of_nights'];

                $extra_bed = $row['extra_bed'];
                $extra_person = $row['extra_person'];
                $extra_pillow = $row['extra_pillow'];
                $extra_towel = $row['extra_towel'];
                $extra_blanket = $row['extra_blanket'];
                // Rtype

                $rm_type_id = $row['rm_type_id'];
                $rm_type_name = $row['rm_type_name'];
                $rm_type_pricing = $row['rm_type_pricing'];

                $status = $row['status'];
            }
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // declare variable
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
        $room_number = mysqli_real_escape_string($conn, $_POST['room_number']);
        $arr_date = mysqli_real_escape_string($conn, $_POST['arr_date']);
        // $check_in = mysqli_real_escape_string($conn, $_POST['check_in']);
        // $check_out = mysqli_real_escape_string($conn, $_POST['check_out']);
        $num_nights = mysqli_real_escape_string($conn, $_POST['num_nights']);

        $extra_bed = mysqli_real_escape_string($conn, $_POST['ex_bed']);
        $extra_person = mysqli_real_escape_string($conn, $_POST['ex_person']);
        $extra_towel = mysqli_real_escape_string($conn, $_POST['ex_towel']);
        $extra_pillow = mysqli_real_escape_string($conn, $_POST['ex_pillow']);
        $extra_blanket = mysqli_real_escape_string($conn, $_POST['ex_blanket']);

        // UPDATE QUERY
        $date = date_create($arr_date);
        date_add($date,date_interval_create_from_date_string("$num_nights days"));
        $end_reserve_date = date_format($date, 'm/d/Y');
        $update = mysqli_query($conn, "UPDATE `tbl_reservations` SET
                                        `guest_name`='$name',
                                        `guest_address`='$address',
                                        `guest_contact`='$contact',
                                        `guest_arrival`='$arr_date',
                                        `end_reserve_date` = '$end_reserve_date',
                                        `room_type`='$room_type',
                                        `room_number`='$room_number',
                                        `number_of_nights`='$num_nights',
                                        `extra_bed`='$extra_bed',
                                        `extra_person`='$extra_person',
                                        `extra_pillow`='$extra_pillow',
                                        `extra_blanket` = '$extra_blanket',
                                        `extra_towel`='$extra_towel',
                                        `last_update` = NOW() WHERE `id`=".$id);

        if ($update) {
            switch ($status) {
                case "active":
                    echo "<script> window.location = 'manage_check_in.php'; </script>";
                    break;
                case "reserve":
                    echo "<script> window.location = 'manage_reservations.php'; </script>";
                    break;
                default:
                    echo "<script> window.location = 'records.php'; </script>";
            }
            
        }else{
            ?>
                <script type="text/javascript">
                    alert("Error Updating Reservation Information. Please review details");
                    history.back();
                </script>
            <?php
        }

    }
     ?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>
        <div class="content">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb" style="padding: 0; background: none; margin-top: -20px;">
                <li class="breadcrumb-item"><a href="#" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</a></li>
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Reservation Details</li>
              </ol>
            </nav>
            <div class="card">
                 <div class="card-body">
            <div class="page-title text-center bg-teal-light" style="padding-top: 10px; padding-bottom: 1px;"><h2><i class="fa fa-hotel"></i> Update Reservation Detail</h2></div>
            <hr>
           <form id="needs-validation" novalidate method="POSt" action="#">
              <div class="row">
                <input value="<?php echo $id; ?>" type="text" id="id" hidden="" name="id">
                <!-- <div class="col-md-12 mb-3">
                    <label for="room_type"><i class="fa fa-hotel"></i> Transaction</label>
                    <select class="form-control" id="trans_type" name="trans_type" required>
                        <option selected value="">Select Transaction Type</option>
                        <option value="short-time">Short Time</option>
                        <option value="reserve">Reservation</option>
                    </select>
                    <div class="invalid-feedback">
                        Please Select options
                    </div>
                </div> -->
                <div class="col-md-6 mb-3">
                    <label for="name"><i class="fa fa-user"></i> Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" required value="<?php echo $guest_name; ?>">
                    <div class="invalid-feedback">
                        Please provide a valid name.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contact"><i class="fa fa-phone"></i> Contact Number</label>
                    <input type="number" class="form-control" id="contact" placeholder="Contact Number" name="contact" required value="<?php echo $guest_contact; ?>">
                    <div class="invalid-feedback">
                        Please provide a valid contact number
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address"><i class="fa fa-map-marker"></i> Address</label>
                    <textarea class="form-control" id="address" placeholder="Address" name="address" required><?php echo $guest_address; ?></textarea>
                    <div class="invalid-feedback">
                        Please provide a valid address.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group" id="date_1">
                        <label for="check_in"><i class="fa fa-calendar-o"></i> Arrival Date</label>
                        <div class="input-group date">
                            <span class="input-group-addon bg-dark"></span>
                            <input class="form-control" type="text" name="arr_date" id="arr_date" required value="<?php echo $guest_arrival; ?>">
                            <div class="invalid-feedback">
                            Please provide a date.
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="room_type"><i class="fa fa-hotel"></i> Types of Room (Rates)</label>
                    <select class="form-control" id="room_type" name="room_type" required>
                        <option value="">Select Room Type</option>
                        <option selected="" value="<?php echo $rm_type_id; ?>"><?php echo $rm_type_name." ($rm_type_pricing php)"; ?></option>
                        <?php
                            $r_type = mysqli_query($conn, "SELECT * FROM `tbl_room_type` WHERE `rm_type_id` <> '$rm_type_id'");
                            if (mysqli_num_rows($r_type)>0) {
                                while ($r = mysqli_fetch_assoc($r_type)) {
                                    echo '<option value="'.$r["rm_type_id"].'">'.$r["rm_type_name"].' ('.$r["rm_type_pricing"].' php)</option>';
                                }
                            }else{
                                echo '<option value="">Room Type Not Avilable</option>';
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a Room Type
                    </div>
                </div>
                <!-- <div class="col-md-6 mb-3">
                    <label for="check_in"><i class="fa fa-clock-o"></i> Check-In Time</label>
                    <input type="time" class="form-control" id="check_in" placeholder="Check-In Time" name="check_in">
                    <div class="invalid-feedback">
                        Please provide a valid time.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_out"><i class="fa fa-clock-o"></i> Check-Out Time</label>
                    <input type="time" class="form-control" id="check_out" placeholder="Check-Out Time" name="check_out">
                    <div class="invalid-feedback">
                        Please provide a valid time.
                    </div>
                </div> -->
                <div class="col-md-6 mb-3">
                    <label for="num_nights"><i class="fa fa-lightbulb-o"></i> Number of Nights</label>
                     <input type="number" class="form-control" id="num_nights" placeholder="Number of Nights" name="num_nights" required value="<?php echo $number_of_nights; ?>">
                    <div class="invalid-feedback">
                        Please provide a valid value.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="room_numbers"><i class="fa fa-hotel"></i> Room Number</label>
                    <select class="form-control" id="room_numbers" name="room_number">

                        <?php 
                            $query3 = mysqli_query($conn, "SELECT r.*, rt.*
                                     FROM `tbl_rooms` r
                                     left join `tbl_room_type` rt on r.`room_type` = rt.`rm_type_id`
                                     WHERE r.`room_id` = $room_number");


                              if (mysqli_num_rows($query3)>0) {
                                  while($row3 = mysqli_fetch_assoc($query3)){
                                      if ($row3['room_status'] == "active")
                                          {
                                              echo '<option class="text-danger" disable value="'.$row3['room_id'].'">'.$row3['room_number'].' - '.$row3["rm_type_name"].' Active</option>';
                                          }
                                      else
                                          {
                                              echo '<option class="text-success" value="'.$row3['room_id'].'">'.$row3['room_number'].' - '.$row3["rm_type_name"].'</option>';
                                          }
                                  }
                              }else{
                                  echo '<option value="">Select Room Type First</option>';
                              }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a Room Number
                    </div>
                </div>
              </div>
              <div class="rounded" style="height: 5px; width: 100%; background-color: #E91E63; margin-bottom: 5px;"></div>
              <p class="h3 text-center font-weight-bold">Add On (Optional)</p>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-hotel"></i> Extra Bed (Good for 2-3) - 300.00 php</label>
                        <input type="number" name="ex_bed" class="form-control" placeholder="Enter Value" value="<?php echo $extra_bed;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-hotel"></i> Extra Person - 150.00 php</label>
                        <input type="number" name="ex_person" class="form-control" placeholder="Enter Value" value="<?php echo $extra_person;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-hotel"></i> Extra Pillow - 50.00 php</label>
                        <input type="number" name="ex_pillow" class="form-control" placeholder="Enter Value" value="<?php echo $extra_pillow;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-hotel"></i> Extra Blanket - 150.00 php</label>
                        <input type="number" name="ex_blanket" class="form-control" placeholder="Enter Value" value="<?php echo $extra_blanket;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-hotel"></i> Extra Towel - 50.00 php</label>
                        <input type="number" name="ex_towel" class="form-control" placeholder="Enter Value" value="<?php echo $extra_towel;?>">
                    </div>
                </div>
              <button class="btn btn-primary btn-block" name="reserve" type="submit" id="finish"><i class="fa fa-check"></i> Update Information</button>
            </form>
        </div>
    </div>
        </div>
    </div>
</div>
<script>
    // Bootstrap datepicker
    $('#date_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        startDate: new Date()
    });
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('needs-validation');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        alert_form();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#room_type').on('change',function(){
                var room_type = $(this).val();
                var arr_date = $('#arr_date').val();
                var nights = $('#num_nights').val();
                var id = $('#id').val();
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{id:id, room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#arr_date').on('change',function(){
                var room_type = $('#room_type').val();
                var nights = $('#num_nights').val();
                var arr_date = $(this).val();
                var id = $('#id').val();
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{id:id, room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#num_nights').on('change',function(){
                var room_type = $('#room_type').val();
                var nights = $(this).val();
                var id = $('#id').val();
                var arr_date = $('#arr_date').val();
                if (nights < 0) {
                    invalidvalue()
                    $(this).val('<?php echo $number_of_nights; ?>');
                }
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{id:id, room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#room_type').on('click', function(){
                var arr_date = $('#arr_date').val();
                var nights = $('#num_nights').val();
                if (arr_date == '') {
                    try_date()
                }else if (nights == '') {
                    no_nights();
                }
            })
        });
        function alert_form(){
            $(document).ready(function(){
                $.alert({
                    icon: 'fa fa-warning',
                    theme: 'material',
                    title: 'Alert Alert',
                    content: '<p>Some required input is empty</p>',
                    closeIcon: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false,
                    animationSpeed: 100, // 0.1 seconds
                    backgroundDismiss: true,
                    type: 'red',
                });
            });
        }
        function try_date(){
            $(document).ready(function(){
                $.alert({
                    icon: 'fa fa-calendar',
                    theme: 'material',
                    title: 'Alert Alert',
                    content: '<strong>Select Date first!</strong>',
                    closeIcon: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false,
                    animationSpeed: 100, // 0.1 seconds
                    backgroundDismiss: true,
                    type: 'red',
                });
            });
        }
        function invalidvalue(){
            $.alert({
                icon: 'fa fa-warning',
                theme: 'dark',
                title: 'Invalid Input',
                content: 'Enter a valid value',
                type: 'red',
                typeAnimated: true,
                animation: 'zoom',
                closeAnimation: 'zoom',
                animateFromElement: false,
                animationSpeed: 100, // 0.1 seconds
                backgroundDismiss: true,
                type: 'red',
            });
        }
        function no_nights(){
            $(document).ready(function(){
                $.alert({
                    icon: 'fa fa-calendar',
                    theme: 'material',
                    title: 'Alert Alert',
                    content: '<strong>Select Number of Nights</strong>',
                    closeIcon: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false,
                    animationSpeed: 100, // 0.1 seconds
                    backgroundDismiss: true,
                    type: 'red',
                });
            });
        }
</script>
<!-- <script type="text/javascript">
    // Load Room numbers after loading the page
        // document.getElementById('tester').onload = function(){
        //         $(document).ready(function(){
        //             var room_type = $('#room_type').val();
        //             var arr_date = $('#arr_date').val();
        //             if(room_type){
        //                 $.ajax({
        //                     type:'POST',
        //                     url:'ajaxData.php',
        //                     data:{room_type:room_type, arr_date:arr_date},
        //                     success:function(html){
        //                         $('#room_numbers').html(html);
        //                     }
        //                 });
        //             }
        //             else{
        //                 $('#room_numbers').html('<option value="">Select Room Type First</option>');
        //             }
        //         })
        //    }

        $(document).ready(function(){
            // load room number after changing select
             $(document).ready(function(){
            $('#room_type').on('change',function(){
                var room_type = $(this).val();
                var arr_date = $('#arr_date').val();
                var nights = $('#num_nights').val();
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#arr_date').on('change',function(){
                var room_type = $('#room_type').val();
                var nights = $('#num_nights').val();
                var arr_date = $(this).val();
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#num_nights').on('change',function(){
                var room_type = $('#room_type').val();
                var nights = $(this).val();
                var arr_date = $('#arr_date').val();
                if (nights < 0) {
                    invalidvalue()
                    $(this).val('0');
                }
                if(room_type){
                    $.ajax({
                        type:'POST',
                        url:'backend_update_reservation.php',
                        data:{room_type:room_type, arr_date:arr_date, nights:nights},
                        success:function(html){
                            $('#room_numbers').html(html);
                        }
                    });
                }
                else{
                    $('#room_numbers').html('<option value="">Select Room Type First</option>');
                }
            });
            $('#room_type').on('click', function(){
                var arr_date = $('#arr_date').val();
                var nights = $('#num_nights').val();
                if (arr_date == '') {
                    try_date()
                }else if (nights == '') {
                    no_nights();
                }
            })
        });
        function alert_form(){
            $(document).ready(function(){
                $.alert({
                    icon: 'fa fa-warning',
                    theme: 'material',
                    title: 'Alert Alert',
                    content: '<p>Some required input is empty</p>',
                    closeIcon: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false,
                    animationSpeed: 100, // 0.1 seconds
                    backgroundDismiss: true,
                    type: 'red',
                });
            });
        }
        function invalidvalue(){
            $.alert({
                icon: 'fa fa-warning',
                theme: 'dark',
                title: 'Invalid Input',
                content: 'Enter a valid value',
                type: 'red',
                typeAnimated: true,
                animation: 'zoom',
                closeAnimation: 'zoom',
                animateFromElement: false,
                animationSpeed: 100, // 0.1 seconds
                backgroundDismiss: true,
                type: 'red',
            });
        }
        function try_date(){
            $(document).ready(function(){
                $.alert({
                    icon: 'fa fa-calendar',
                    theme: 'material',
                    title: 'Alert Alert',
                    content: '<strong>Select Date first!</strong>',
                    closeIcon: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false,
                    animationSpeed: 100, // 0.1 seconds
                    backgroundDismiss: true,
                    type: 'red',
                });
            });
        }
</script> -->
</body>
</html>
