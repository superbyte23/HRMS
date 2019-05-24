    <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">Navigation</li>

                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <!-- <i class="fa fa-desktop"></i> --><i><img src="imgs/png/24/home.png"></i> Dashboard
                        </a>
                    </li>


                    <li class="nav-item nav-dropdown open">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i><img src="imgs/png/24/book2.png"></i> Hotel Booking <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="new_check_in.php" class="nav-link">
                                    <!-- <i class="fa fa-check-square"></i> --><i><img src="imgs/png/24/checkmark.png"></i> Check In
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="new_reservation.php" class="nav-link">
                                    <!-- <i class="fa fa-plus"></i> --><i><img src="imgs/png/24/pencil.png"></i> Add Reservation
                                </a>
                            </li>
                            <?php

                                if (mysqli_num_rows($settings)>0) {
                                    while ($set = mysqli_fetch_assoc($settings)) {
                                        $menu_id = $set['id'];
                                        $menu_name = $set['menu'];
                                        $value = $set['value'];

                                        if ($menu_name == "Insert Old Records" && $value == 1) {
                                            echo '<li class="nav-item">
                                                <a href="old_transaction.php" class="nav-link">
                                                <!--    <i class="fa fa-plus-square"></i> --> <i><img src="imgs/png/24/fountain_pen.png"></i>  Old Transaction
                                                </a>
                                            </li>';
                                        }
                                    }
                                }       
                            ?>
                            
                            <li class="nav-item">
                                <a href="manage_check_in.php" class="nav-link">
                                   <!--  <i class="fa fa-hotel"></i> --><i><img src="imgs/png/24/window.png"></i> Manage Check-In
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage_reservations.php" class="nav-link">
                                    <!-- <i class="fa fa-hotel"></i> --><i><img src="imgs/png/24/windows.png"></i> Manage Reservations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="records.php" class="nav-link">
                                    <!-- <i class="fa fa-table"></i> --><i><img src="imgs/png/24/file.png"></i> Records
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reports.php" class="nav-link">
                                    <!-- <i class="fa fa-files-o"></i> --><i><img src="imgs/png/24/software.png"></i> Reports
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown open">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <!-- <i class="fa fa-puzzle-piece"></i> --><i><img src="imgs/png/24/network.png"></i> Hotel Management <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="rooms.php" class="nav-link">
                                    <!-- <i class="fa fa-link"></i>  --><i><img src="imgs/png/24/overlapping_squares.png"></i> Manage Room Types
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="room_numbers.php" class="nav-link">
                                    <!-- <i class="fa fa-link"></i> --><i><img src="imgs/png/24/key.png"></i> Manage Rooms
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="gallery.php" class="nav-link">
                                    <!-- <i class="fa fa-image"></i> --><i><img src="imgs/png/24/camera.png"></i> Gallery
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-users"></i> Employee Management <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="alerts.html" class="nav-link">
                                    <i class="icon icon-energy"></i> Alerts
                                </a>
                            </li>
                        </ul>
                    </li> -->
                       <!--  <li class="nav-item nav-dropdown">
                            <a href="gallery.php" class="nav-link">
                                <i class="fa fa-image"></i> Image Gallery
                            </a>

                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="alerts.html" class="nav-link">
                                        <i class="icon icon-energy"></i> Alerts
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                </ul>
            </nav>
        </div>