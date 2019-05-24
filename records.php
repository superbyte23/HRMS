<?php require 'includes/header.php'; ?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>
        <div class="content">
        <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb" style="padding: 0; background: none; margin-top: -20px;">
                <li class="breadcrumb-item"><a href="#" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</a></li>
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Records</li>
              </ol>
            </nav>
            <div class="card">
                        <div class="card-header bg-teal text-white">
                            <strong class="h3"> Records </strong>
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
                                        <th>No. of Nights</th>
                                        <th>Room #</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>More Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM `tbl_reservations` rs LEFT JOIN `tbl_rooms` r ON rs.`room_number` = r.`room_id` WHERE `status` = 'inactive'  ORDER BY rs.`trans_date` DESC ");
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
                                                    echo '<td><i class="fa fa-hotel"></i> '.$row['room_number'].'</td>';

                                            if ($row['guest_check_in'] == "")
                                            {
                                               echo '<td><a href="backend_check_in.php?id='.$row['id'].'" class="btn btn-xs btn-success"><i class="fa fa-check"></i> In</a> </td>';
                                            }
                                            else
                                            {

                                                echo '<td>'.date_format($check_in_time,"h:i a").'</td>';
                                            }
                                            if ($row['guest_check_out'] == "") {
                                                echo '    <td><a href="backend_check_out.php?id='.$row['id'].'" class="btn btn-xs btn-danger"><i class="fa fa-check"></i> Out</a> </td>';
                                            }else{
                                                echo '<td>'.date_format($check_out_time,"h:i a").'</td>';
                                            }
                                            if ($_SESSION['user_type'] == "administrator") {
                                               echo'<td><a href="view_record_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> View</a> <a href="app/delete_reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-danger">Delete</a> </td>';
                                            }else{
                                                 echo'<td><a href="view_old_record_details.php?id='.$row['id'].'" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> View</a></td>';
                                            }

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
<script type="text/javascript">
        $(function() {
            $('#reservation_table').DataTable({
                pageLength: 10,
                "order": [[0, "desc"]]
            });
        })
    </script>
</body>
</html>
