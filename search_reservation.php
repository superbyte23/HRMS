<?php require 'includes/header.php'; ?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>
        <div class="content">
            <div class="print">
                <div class="text-center">
                    <h1>R-Seven Star Tourist Inn</h1>
                    <div class="address">
                        <p>Corner San Jose, Bonifacio St., Brgy. 2, Kabankalan City, Negros Occidental</p>
                        <p><i class="fa fa-mobile"></i> Mobile No.: 0999-733-352 | 0905-512-4430</p>
                        <p><i class="fa fa-phone"></i> Tel. No. 4712-34567</p>
                    </div>
                </div>
                <br><br><br>
                <h3>Date : <?php echo date('M-d-Y'); ?></h3>
            </div>
            <div class="page-title"><h2><i class="fa fa-files-o"></i> Reservation Reports</h2></div>
            <div class="row no-print">
            <div class="col col-xs-12">
                <div class="form-group" id="date_1">
                    <label for="check_in"><i class="fa fa-calendar-o"></i> From</label>
                    <div class="input-group date">
                        <span class="input-group-addon bg-dark"></span>
                        <input class="form-control" type="text" name="arr_date1" id="from" placeholder="Select Date" required="">
                    </div>
                </div>
            </div>
            <div class="col col-xs-12">
                <div class="form-group" id="date_2">
                    <label for="check_in"><i class="fa fa-calendar-o"></i> To</label>
                    <div class="input-group date">
                        <span class="input-group-addon bg-dark"></span>
                        <input class="form-control" type="text" name="arr_date2" id="to" placeholder="Select Date" required="">
                    </div>
                </div>
            </div>
            <div class="col col-xs-12">
                <div class="form-group" id="date_2">
                    <label for="check_in"><i class="fa fa-calendar-o"></i> To</label>
                    <select class="form-control" id="rm_type">
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
            <div class="col col-xs-12">
                <div class="form-group">
                    <label for="check_in"><i class="fa fa-calendar-do"></i></label>
                    <div class="input-group">
                        <input type="submit" class="btn btn-success" name="" id="load" value="Load">
                    </div>
                </div>    
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="form-group">
                    <label for="check_in"><i class="fa fa-calendar-do"></i></label>
                    <div class="input-group">
                    </div>
                </div>    
            </div>
            </div>
            <div class="panel-table">
                <div class="table-responsive bg-light">
                     <table class="table table-bordered table-sm text-center">
                            <thead> 
                            <tr>
                                <th>Date</th>
                                <th>Guest Name</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Arrival Date</th>
                                <th>End Date</th>
                                <th>Room #</th>
                            </tr>
                            </thead>
                            <tbody id="report">
                                        
                            </tbody>
                        </table>       
                </div>
            </div>
            <a class="pull-right btn btn-success no-print" onclick="window.print();"><i class="fa fa-print"></i> Print Report</a>
    </div>
</div>
<style type="text/css">

</style>
<script>
    // Bootstrap datepicker
    $('#date_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        todayHighlight: true,
        format: 'mm/dd/yyyy',
        startDate: new Date,
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
</script>
<script>
    var page = document.URL;
    // report PAGE
    if (page === "http://localhost/rseveninn/reports.php") {                      
        $(document).ready(function(){
             $("#tester").addClass("sidebar-hidden");
        })
    }
    $(document).ready(function(){
       $('#load').on('click',function(){
        var from = $('#from').val();
        var to = $('#to').val();
        var rm_type = $('#rm_type').val();
        if (!from || !to) {
            noDate();
            return false;
        }else if(from > to){

        	invalidDate();
            return false;
        }	
        else if(from && to){
            $.ajax({
                type:'POST',
                url:'backend_search_reservation.php',
                data:{from:from, to:to, rm_type:rm_type},
                success:function(html){
                   $('#report').html(html);
                }
            });
        }else{

            $('#report').html('<tr><td>Select Date</td></tr>');
        }
    });
    });

	function alertRecord(){
        // alert
        $.alert({
            title: 'Alert alert!',
            content: '<strong>No Record Availabe</strong>',
            icon: 'fa fa-file',
            type: 'red',
            animation: 'zoom',
            closeAnimation: 'zoom',
            animateFromElement: false,
            animationSpeed: 100, // 0.1 seconds
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            });
    }
    function noDate(){
        $.alert({
            title: 'Alert!',
            content: '<i class="fa fa-calendar"></i> <strong class="text-danger">No Date Selected</strong><em> Please select a date',
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
</body>
</html>