
<?php
//Include the database configuration file
include 'includes/config.php';

//Fetch all the country data
$query = mysqli_query($conn, "SELECT * FROM `tbl_room_type`");

//Count total number of rows
$rowCount = mysqli_num_rows($query);
?>
<link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="css/app.css">
<link href="./vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
<link rel="stylesheet" href="./css/styles.css">
<style type="text/css">
    div.viola:hover{
            transition-property: all;
            transition-duration: 5s;
            transition-timing-function: ease;
            transition-delay: 5s;
    }
</style>
<body class="container"><br><br><br><br>
    <div class="align-center">
        <h1>Chained Select with PHP MYSQL jQuery AJAX</h1>
        <h3>Room Reservation Check Availability</h3>
    </div>
                <div class="row">
                    <div class="col-md-4 mb-3">

                        <div class="form-group">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Select Room Type</label>
                        <select class="form-control" id="room_type">
                            <option value="">Select Room Type</option>
                            <?php
                            if($rowCount > 0){
                                while($row = $query->fetch_assoc()){
                                    echo '<option value="'.$row['rm_type_id'].'">'.$row['rm_type_name'].'</option>';
                                }
                            }else{
                                    
                            }
                            ?>
                        </select>

                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Select Room</label>
                            <select class="form-control" id="room_number">
                                <option value="">Select Room</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group" id="date_1">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Arrival Date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-dark"></span>
                                        <input class="form-control" type="text" name="arr_date" id="arr_date">
                                    </div>
                                </div>
                       <!--  
                        <input type="text" class="form-control" id="arr_time" placeholder="Arrival Time" required name="arr_time">
                        <div class="invalid-feedback">
                            Please provide a time
                        </div> -->
                    </div>
                    <div id="viola" class="btn-block">
                        
                    </div>
                    
                    <button class="btn btn-info col-md-12 btn-block" id="check">Check Reservation</button>
                </div>

                <form >
                    <input type="file" id="try2" />
                    <img src="assets/images/rooms/truck.jpg" id="try" alt="Upload" class="img-thumbnail" height="50" width="50">

                </form>
                <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h4 class="card-title">Custom Javascript Alerts</h4>
                            <h6 class="card-subtitle">SweetAlert 2 is beautiful replacement for javascript alert. SweetAlert automatically centers itself on the page and looks great no matter if you're using a desktop computer, mobile or tablet. It's even highly customizeable, as you can see below!</h6>

                            <h3 class="card-body__title">Basic examples</h3>
                            <p>Alerts can be customized to display custom variants using optional settings.</p>

                            <div class="btn-demo mt-4">
                                <button class="btn btn-light" id="sa-basic">Basic Message</button>

                                <button class="btn btn-light" id="sa-info">Info Message</button>

                                <button class="btn btn-light" id="sa-success">Success Message</button>

                                <button class="btn btn-light" id="sa-warning">Warning Message</button>

                                <button class="btn btn-light" id="sa-question">Question</button>
                            </div>

                            <br>
                            <br>

                            <h3 class="card-body__title">Advanced examples</h3>

                            <br>

                            <p>A warning message, with a function attached to the "Confirm"-button":</p>
                            <button class="btn btn-light mb-1" id="sa-funtion">This ain't any normal browser alert</button>

                            <br>
                            <br>

                            <p>Auto closing alert with timer.</p>
                            <button class="btn btn-light mb-1" id="sa-timer">Show me the timer alert</button>

                            <br>
                            <br>

                            <p>A message with custom Image Header</p>
                            <button class="btn btn-light mb-1" id="sa-image">Custom headers are cool in an alert</button>

                        </div>
                    </div>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" type="text/javascript"></script> 
<script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>

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
$(document).ready(function(){
    $('#room_type').on('change',function(){
        var room_type = $(this).val();
        if(room_type){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'room_type='+room_type,
                success:function(html){
                    $('#room_number').html(html);
                }
            });
        }else{
            $('#room_number').html('<option value="">Select Room Type First</option>'); 
        }
    });
});
</script>
<script>
    $(document).ready(function(){
        $("#check").click(function(){
            var arr_date = $("#arr_date").val();
            var room_number = $("#room_number").val();
            var room_type = $("#room_type").val();
            if (arr_date && room_number && room_type) {
                $.ajax({
                type:'POST',
                url:'ajaxCheckRoomAvail.php',
                data: {arr_date:arr_date, room_number:room_number},
                success:function(html){
                    $('#viola').html(html);
                }
            });
            }else if (!room_type){
                alert('Select room type first'); 
            }else if (!room_number){
                alert('Select room number'); 
            }else{
               alert('Enter Date'); 
            }
        });
    });
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e){
                $('#try').attr('src', e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#try2').change(function(){
        readURL(this);
    })
</script>
<script>
    /*--------------------------------------
                Sweet Alert Dialogs
            ---------------------------------------*/

            // Basic
            $('#sa-basic').click(function(){
                swal({
                    title: "Here's a message!",
                    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info',
                    background: 'rgba(0, 0, 0, 0.96)'
                })
            });

            // Success Message
            $('#sa-success').click(function(){
                swal({
                    title: 'Good job!',
                    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis',
                    type: 'success',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info',
                    background: 'rgba(0, 0, 0, 0.96)'
                })
            });

            // Success Message
            $('#sa-info').click(function(){
                swal({
                    title: 'Information!',
                    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis',
                    type: 'info',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info',
                    background: 'rgba(0, 0, 0, 0.96)'
                })
            });

            // Warning Message
            $('#sa-warning').click(function(){
                swal({
                    title: 'Not a good sign...',
                    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis',
                    type: 'warning',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-info',
                    background: 'rgba(0, 0, 0, 0.96)'
                })
            });

            // Question Message
            $('#sa-question').click(function(){
                swal({
                    title: 'Hmm.. what did you say?',
                    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis',
                    type: 'question',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-sm btn-info',
                    background: 'rgba(0, 0, 0, 0.96)'
                })
            });

            // Warning Message with function
            $('#sa-funtion').click(function(){
                
            });

            // Custom Image
            $('#sa-image').click(function(){
                swal({
                    title: 'Sweet!',
                    text: "Here's a custom image.",
                    imageUrl: 'demo/img/thumbs-up.png',
                    buttonsStyling: true,
                    confirmButtonClass: 'btn btn-info btn-sm',
                    confirmButtonText: 'Super!',
                    background: 'rgba(0, 0, 0, 0.96)'
                });
            });

            // Auto Close Timer
            $('#sa-timer').click(function(){
                swal({
                    title: 'Auto close alert!',
                    text: 'I will close in 2 seconds.',
                    timer: 2000,
                    showConfirmButton: false,
                    buttonsStyling: false,
                    background: 'rgba(0, 0, 0, 0.96)'
                });
            });
</script>
<style>
    .swal2-modal .swal2-buttonswrapper .btn {
    margin: 0 3px;
    box-shadow: none!important;
}
</style>
</body>
<!--  -->