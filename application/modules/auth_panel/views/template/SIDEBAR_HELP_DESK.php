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
                    <li><a href="<?php echo AUTH_PANEL_URL.'web_user/non_verified_user_list';?>">Non Verified</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_user/verified_user_list';?>">Verified</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_user/all_user_list';?>">All</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa  fa-truck "></i>
                    <span>Cars </span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo AUTH_PANEL_URL.'car/non_approved_car_list';?>">Non Approved</a></li>
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
                    <li><a  href="<?php echo AUTH_PANEL_URL.'booking/get_current_booking';?>">Current Booking</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL.'booking/get_complete_booking';?>">Complete Booking</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL.'booking/get_all_booking';?>">All Booking</a></li>
                </ul>
            </li>

          

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cog"></i>
                    <span>Car Setting </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL.'make_model/car_makes';?>">Car Maker(s) List</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL.'make_model/index';?>">Car Model(s) List</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'Car_features/index';?>">Car Feature(s) List</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span>Car Claim </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL.'car_claim/index';?>">Car Claim(s) List</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>Report</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_user_report/index';?>">User Report</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_car_report/index';?>">Car Report</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL.'web_request_report/index';?>">Request Report</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
