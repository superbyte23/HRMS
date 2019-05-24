<?php require 'includes/header.php'; ?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>
        <div class="content">
        	<div class="row">
        		<div class="col-lg-3 col-sm-3">
		            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user"></i> Users</a>
					 <!--  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
					  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a> -->
					  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-hotel"></i> Hotel Settings</a>
					</div>
        		</div>
	        	<div class="col-lg-9 col-sm-9">
					<div class="tab-content" id="v-pills-tabContent">
					  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					  	<h3 class="lead"><i class="fa fa-users"></i> Users</h3>
					  	<div class="table-responsive dataTable">
					  		 <table class= "table table-striped table-bordered table-hover table-sm text-center" id="reservation_table" cellspacing="0" width="100%" >
						  		<thead>
						  			<th>Id</th>
						  			<th>Username</th>
						  			<th>Passsword</th>
						  			<th>User Type</th>
						  			<th>Actions</th>
						  		</thead>
						  		<tbody>
                                        <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM `tbl_users`");
                                            if (mysqli_num_rows($sql)>0) {
                                               while ($row = mysqli_fetch_assoc($sql)) {
                                               	echo "<tr>";
                                               	echo "<td>".$row['user_id']."</td>";
                                               	echo "<td>".$row['username']."</td>";
                                               	echo "<td>".$row['password']."</td>";
                                               	echo "<td>".$row['user_type']."</td>";
                                               	echo "<td><a href='#' data-toggle='modal' data-target='#update_user' data-index='".$row['user_id']."'  class='btn btn-info btn-xs user_edit'><i class='fa fa-edit'></i></a> | <a href='#' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>";
                                               	echo "</tr>";
                                               }
                                                    
                                            }
                                        ?>
                                    </tbody>
						  	</table>
					  	</div>
					  </div>
					  <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					  	
					  </div>
					  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
					  	
					  </div> -->
					  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr> 
                                        <th>Menu</th>
                                        <th>Enable / Disable</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $settings_query = mysqli_query($conn, "SELECT * FROM `settings`");
                                        if (mysqli_num_rows($settings_query)>0) {
                                          while ($set = mysqli_fetch_assoc($settings_query)) {
                                            echo '<tr>';
                                            echo '<td>'.$set['menu'].'</td>';
                                            if ($set['value'] == '1') {
                                              echo '<td>
                                                      <div class="toggle-switch" data-ts-color="success">
                                                        <input id="ts4" type="checkbox" hidden="hidden" checked="" data-index="'.$set["id"].'" value="'.$set["value"].'" class="iorm">
                                                        <label for="ts4" class="ts-helper pull-right" ></label>
                                                      </div>
                                                    </td>';
                                            }else{
                                              echo '<td>
                                                      <div class="toggle-switch" data-ts-color="success">
                                                        <input id="ts4" type="checkbox" hidden="hidden" data-index="'.$set["id"].'" value="'.$set["value"].'" class="iorm">
                                                        <label for="ts4" class="ts-helper pull-right" ></label>
                                                      </div>
                                                    </td>';
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
        </div>
    </div>
</div>
<div class="modal fade" id="update_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="update_user_settings">
                    
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.user_edit').on('click',function(){
        var id = $(this).data('index');
        if(id){
            $.ajax({
                type:'POST',
                url:'backend_user_settings.php',
                data:{id:id},
                success:function(html){
                    $('#update_user_settings').html(html);
                }
            });
        }
    });

    $('.iorm').on('change',function(){
      var value = $(this).val();
      var id = $(this).data('index');
      $.ajax({
        type:'POST',
        url:'backend_settings.php',
        data:{id:id, value:value},
        success:function(){
            
        }
      });
    })


 
});



</script>
</body>
</html>
