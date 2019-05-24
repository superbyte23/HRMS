<?php require 'includes/header.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['btn_search'])) {
                function search(){
                include 'includes/config.php';

                // declare variable
                $from = mysqli_real_escape_string($conn, $_POST['arr_date']);
                $to = mysqli_real_escape_string($conn, $_POST['end_date']);
                $rm_type = mysqli_real_escape_string($conn, $_POST['rm_type']);

                $search = mysqli_query($conn, "SELECT
                                                    *
                                                FROM
                                                    `tbl_reservations` rs
                                                LEFT JOIN `tbl_room_type` rt ON
                                                    rs.`room_type` = rt.`rm_type_id`
                                                LEFT JOIN `tbl_rooms` r ON
                                                    rs.`room_number` = r.`room_id`
                                                WHERE
                                                    (
                                                        rs.`guest_arrival` >= '$from' AND rs.`end_reserve_date` <= '$to'
                                                    ) OR(
                                                        rs.`guest_arrival` <= '$to' AND rs.`end_reserve_date` >= '$from'
                                                    ) AND(
                                                        rs.`status` = 'reserve' AND rs.`room_type` = '$rm_type'
                                                    )
                                                ORDER BY
                                                    rs.`trans_date`
                                                DESC");
                                            if (mysqli_num_rows($search)>0) {
                                               while ($row = mysqli_fetch_assoc($search)) {
                                                    $date=date_create($row['trans_date']);
                                                    $check_in_time=date_create($row['guest_check_in']);
                                                    $check_out_time=date_create($row['guest_check_out']);
                                                    echo '<tr style="padding: 0; margin: 0;">';
                                                    echo '<td>'.date_format($date,"m-d-Y").'</td>';
                                                    echo '<td class="text-nowrap">'.$row['guest_name'].'</td>';
                                                    echo '<td>'.$row['guest_address'].'</td>';
                                                    echo '<td>'.$row['guest_contact'].'</td>';
                                                    echo '<td>'.$row['guest_arrival'].'</td>';
                                                    echo '<td>'.$row['number_of_nights'].'</td>';
                                                    echo '<td><i class="fa fa-hotel"></i> '.$row['rm_type_name'].'</td>';
                                                    if ($row['room_number'] == "") {
                                                       echo '<td>Not Set</td>';
                                                    }else{
                                                         echo '<td>'.$row['room_number'].'</td>';
                                                    }

                                                    if ($row['guest_check_in'] == "")
                                                    {
                                                       echo '<td><a href="backend_check_in.php?id='.$row['id'].'" class="btn btn-xs btn-success btn-block"><i class="fa fa-sign-in"></i> In</a> </td>';
                                                    }
                                                    else
                                                    {

                                                        echo '<td>'.date_format($check_in_time,"h:i a").'</td>';
                                                    }
                                                    if ($row['guest_check_out'] == "") {
                                                        echo '    <td><a href="backend_check_out.php?id='.$row['id'].'" class="btn btn-xs btn-danger btn-block"><i class="fa fa-sign-out"></i> Out</a> </td>';
                                                    }else{
                                                        echo '<td>'.date_format($check_out_time,"h:i a").'</td>';
                                                    }
                                                    if ($_SESSION['user_type'] == "administrator") {
                                                       echo'<td><a href="reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a> | <a href="app/delete_reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-danger">Delete</a> </td>';
                                                    }else{
                                                         echo'<td><a href="reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Update</a></td>';
                                                    }

                                                    echo '</tr>';
                                               }
                                            }

                
            }
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
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Reservations</li>
              </ol>
            </nav>
            <div class="card">
                        <div class="card-header bg-teal-dark text-white">
                            <strong class="h3"> List Reservations</strong>
                            <div class="d-inline float-right">
                                <a href="new_reservation.php" class="btn btn-success"> <i class="fa fa-plus"></i> Add New Reservation</a> 
                                <a href="#" data-toggle="modal" data-target="#advance_search" class="btn btn-primary d-inline"><i class="fa fa-search"></i> Advance Search</a>
                                <a href="" class="btn btn-danger d-inline"><i class="fa fa-eraser"></i> Clear Search</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dataTable">
                                <table class= "table table-striped table-bordered table-hover table-sm text-center" id="reservation_table" cellspacing="0" width="100%" >
                                    <thead class="thead-dark">
                                    <tr style="font-size: 12px;">
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact #</th>
                                        <th>Arrival Date</th>
                                        <th width="2">Nights</th>
                                        <th>Room Type</th>
                                        <th>Room #</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>More Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (isset($_POST['btn_search'])) {
                                            search();
                                        }
                                        else{
                                            $sql = mysqli_query($conn, "SELECT * FROM `tbl_reservations` rs 
                                                LEFT JOIN `tbl_room_type` rt ON rs.`room_type` = rt.`rm_type_id`
                                                LEFT JOIN `tbl_rooms` r ON rs.`room_number` = r.`room_id` WHERE `status` = 'reserve'  ORDER BY rs.`trans_date` DESC");
                                            if (mysqli_num_rows($sql)>0) {
                                               while ($row = mysqli_fetch_assoc($sql)) {
                                                    $date=date_create($row['trans_date']);
                                                    $check_in_time=date_create($row['guest_check_in']);
                                                    $check_out_time=date_create($row['guest_check_out']);
                                                    echo '<tr style="padding: 0; margin: 0;">';
                                                    echo '<td>'.date_format($date,"m-d-Y").'</td>';
                                                    echo '<td class="text-nowrap">'.$row['guest_name'].'</td>';
                                                    echo '<td>'.$row['guest_address'].'</td>';
                                                    echo '<td>'.$row['guest_contact'].'</td>';
                                                    echo '<td>'.$row['guest_arrival'].'</td>';
                                                    echo '<td>'.$row['number_of_nights'].'</td>';
                                                    echo '<td><i class="fa fa-hotel"></i> '.$row['rm_type_name'].'</td>';
                                                    if ($row['room_number'] == "") {
                                                       echo '<td>Not Set</td>';
                                                    }else{
                                                         echo '<td>'.$row['room_number'].'</td>';
                                                    }

                                                    if ($row['guest_check_in'] == "")
                                                    {
                                                       echo '<td><a href="backend_check_in.php?id='.$row['id'].'" class="btn btn-xs btn-success btn-block"><i class="fa fa-sign-in"></i> In</a> </td>';
                                                    }
                                                    else
                                                    {

                                                        echo '<td>'.date_format($check_in_time,"h:i a").'</td>';
                                                    }
                                                    if ($row['guest_check_out'] == "") {
                                                        echo '    <td><a href="backend_check_out.php?id='.$row['id'].'" class="btn btn-xs btn-danger btn-block"><i class="fa fa-sign-out"></i> Out</a> </td>';
                                                    }else{
                                                        echo '<td>'.date_format($check_out_time,"h:i a").'</td>';
                                                    }
                                                    if ($_SESSION['user_type'] == "administrator") {
                                                       echo'<td><a href="reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a> | <a id="delete" href="app/delete_reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-danger">Delete</a> </td>';
                                                    }else{
                                                         echo'<td><a href="reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Update</a></td>';
                                                    }

                                                    echo '</tr>';
                                               }
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
<div class="modal fade" id="advance_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="exampleModalLabel">Advance Search Reservations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
              <div class="modal-body bg-dark text-white">
                <div class="row">
                      <div class="col">
                        <div class="form-group" id="date_1">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Arrival Date <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <span class="input-group-addon bg-dark"></span>
                                <input class="form-control" type="text" name="arr_date" id="from" placeholder="Select Date" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" id="date_2">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Chec-Out Date <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <span class="input-group-addon bg-dark"></span>
                                <input class="form-control" type="text" name="end_date" id="to" placeholder="Select Date" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" id="date_2">
                            <label for="check_in"><i class="fa fa-calendar-o"></i> Room Type <span class="text-danger">*</span></label>
                            <select class="form-control" id="rm_type" name="rm_type">
                                <?php $query = "SELECT * FROM tbl_room_type";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["rm_type_id"].'">'.$row['rm_type_name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer bg-dark text-white">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="btn_search" name="btn_search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
              </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(function() {
            $('#reservation_table').DataTable({
                pageLength: 10,
                "order": [[0, "desc"]]
            });
        })

    // Bootstrap datepicker
    $('#date_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        todayHighlight: true,
        format: 'mm/dd/yyyy',
        autoclose: true
    });

    $('#date_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        todayHighlight: true,
        format: 'mm/dd/yyyy',
        autoclose: true
    });


    $(document).ready(function(){
       $('#btn_search').on('click',function(){
            var from = $('#from').val();
            var to = $('#to').val();
            var rm_type = $('#rm_type').val();
            if (!from || !to || !rm_type) {
                emtpy_field();
                return false;
            }else if(from > to){

                invalidDate();
                return false;
            }
        });
    });
    function emtpy_field(){
        $.alert({
            title: 'Alert!',
            content: '<i class="fa fa-calendar"></i> <strong class="text-danger">Enter required input fields.',
            icon: 'fa fa-warning',
            type: 'red',
            animation: 'zoom',
            closeAnimation: 'zoom',
            animateFromElement: false,
            animationSpeed: 100, // 0.1 seconds
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
        });
    }
    function invalidDate(){
        $.alert({
            title: 'Alert!',
            content: '<i class="fa fa-calendar"></i> <strong class="text-danger">Invalid Date Range</strong><em>',
            icon: 'fa fa-warning',
            type: 'red',
            animation: 'zoom',
            closeAnimation: 'zoom',
            animateFromElement: false,
            animationSpeed: 100, // 0.1 seconds
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
        });
    }
</script>
<?php include 'notify_delete.php';?>
</body>
</html>
