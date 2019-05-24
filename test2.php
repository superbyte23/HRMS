<?php 
require_once 'includes/config.php';

//  $query = mysqli_query($conn, "SELECT DISTINCT(`room_number`) FROM `tbl_reservations` WHERE ((`guest_arrival` >= '06/11/2018' AND `end_reserve_date` <= '06/13/2018') OR (`guest_arrival` <= '06/13/2018' AND `end_reserve_date` >= '06/11/2018')) AND (`status` IN ('active', 'reserve'))");


//     if (mysqli_num_rows($query)>0) {
//         // populate room_id
//         while ($row = mysqli_fetch_assoc($query)) {
//            $id[] = $row['room_number'];
//         }

//         echo implode(',', $id);
// }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!--  external stylesheets -->
    <!-- <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css"> -->
    <link rel="stylesheet" href="./vendor/font-awesome 4/css/font-awesome.min.css">
    <link rel="stylesheet" href="./vendor/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="./vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="./vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/color.css">
    <link rel="stylesheet" type="text/css" href="./vendor/jquery-confirm/jquery-confirm.min.css"/>
    <link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./vendor/blueimp/css/blueimp-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="./css/custom.css">
    <!--  external stylesheets -->

    <!-- internal stylesheet -->
    <style type="text/css">
        
    </style>
    <!-- internal stylesheet -->

    <!-- javascript plugins -->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper.js/popper.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/chart.js/chart.min.js"></script> 
    <script src="./vendor/DataTables/datatables.min.js"></script>
    <script src="./vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>    
    <script src="./vendor/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="./js/carbon.js"></script>
    <script src="./js/demo.js"></script>
    <script src="./vendor/blueimp/js/jquery.blueimp-gallery.min.js"></script>
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<body>
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
                                                    echo'<td><a href="reservation_details.php?id='.$row['id'].'" class="facebook btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a> | <a href="app/delete_reservation_details.php?id='.$row['id'].'" class="btn btn-xs btn-danger">Delete</a> </td>';
                                                    echo '</tr>';
                                               }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
 <div class="col-md-3">
                        <button class="btn btn-primary btn-block example-p-2">Confirmation</button>
                        <p class="text-success">Stacked Confirmations</p>
                    </div>


                    <br>
                    <a href="www.facebook.com" class="facebook  btn btn-info" data-title="Visit Facebook">Visit Facebook</a>

 <button type="button" id="alert">Try</button>

 <link rel="stylesheet" type="text/css" href="vendor/jquery/jquery.min.js">

 <script>
 	$(document).ready(function(){
 		$('#alert').onclick(function(){
 			$confi
 		})
 	})
 	$('.example-p-2').on('click', function () {
                        $.confirm({
                            title: 'A secure action',
                            content: 'Its smooth to do multiple confirms at a time. <br> Click confirm or cancel for another modal',
                            icon: 'fa fa-question-circle',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'Proceed',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        $.confirm({
                                            title: 'This maybe critical',
                                            content: 'Critical actions can have multiple confirmations like this one.',
                                            icon: 'fa fa-warning',
                                            animation: 'scale',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'Yes, sure!',
                                                    btnClass: 'btn-orange',
                                                    action: function () {
                                                        $.alert('A very critical action <strong>triggered!</strong>');
                                                    }
                                                },
                                                cancel: function () {
                                                    $.alert('you clicked on <strong>cancel</strong>');
                                                }
                                            }
                                        });
                                    }
                                },
                                cancel: function () {
                                    $.alert('you clicked on <strong>cancel</strong>');
                                },
                                moreButtons: {
                                    text: 'something else',
                                    action: function () {
                                        $.alert('you clicked on <strong>something else</strong>');
                                    }
                                },
                            }
                        });
                    });


 	$('a.facebook').confirm({
 		icon: 'fa fa-spinner fa-spin',
 		theme: "dark",
 		type: 'red',
	    title: 'Delete Data!',
	    animation: 'rotateX',
    	closeAnimation: 'rotateX',

	    animationSpeed: 400,
	     buttons: {
	        Yes: function () {
            location.href = this.$target.attr('href');
	        },
	        cancel: function () {
	            //$.alert('Canceled!');
	        }
		    }
	});
 </script>



</body>
</html>