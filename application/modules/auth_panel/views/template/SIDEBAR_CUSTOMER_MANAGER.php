<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-users"></i>
                    <span>Web User </span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo AUTH_PANEL_URL.'web_user/non_verified_user_list';?>">Non verified</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_user/verified_user_list';?>">Verified</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa  fa-truck "></i>
                    <span>Cars </span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo AUTH_PANEL_URL.'car/non_approved_car_list';?>">Non approved</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'car/approved_car_list';?>">Approved</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-list"></i>
                    <span>Booking </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL.'booking/get_new_booking_request';?>">New Requests</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'booking/get_current_booking';?>">Current booking</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL.'booking/get_complete_booking';?>">Complete booking</a></li>

                </ul>
            </li>

            
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
