<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="<?php echo AUTH_PANEL_URL . 'admin/index'; ?>">
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
					<li><a href="<?php echo AUTH_PANEL_URL . 'web_user/add_web_user'; ?>"> Add New User </a></li>			
                    <li><a href="<?php echo AUTH_PANEL_URL . 'web_user/non_verified_user_list'; ?>">Non Verified</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_user/verified_user_list'; ?>">Verified</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_user/all_user_list'; ?>">All</a></li>
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-users"></i>
                    <span>Backend User </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'admin/create_backend_user'; ?>">Add New</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL . 'admin/backend_user_list'; ?>">Backend User List</a></li>
                </ul>
            </li>		

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa  fa-truck "></i>
                    <span>Cars </span>
                </a>
                <ul class="sub">
					<li><a href="<?php echo AUTH_PANEL_URL . 'web_option/google_map'; ?>">Cars on Map </a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL . 'car/non_approved_car_list'; ?>">Non Approved</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'car/approved_car_list'; ?>">Approved</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'car/approved_car_list'; ?>">Featured</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'car/deleted_car_list'; ?>">Deleted Cars</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'car/reported_car_list'; ?>">Reported Cars</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-list"></i>
                    <span>Request </span>
                </a>
                <ul class="sub">
					<li><a  href="<?php echo AUTH_PANEL_URL . 'booking/get_new_booking_request'; ?>">New Requests</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'booking/get_rejected_booking_request'; ?>">Rejected Requests</a></li>
					<li><a href="<?php echo AUTH_PANEL_URL . 'booking/get_all_booking'; ?>">All Records</a></li>	
				</ul>
            </li>			

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-thumbs-up"></i>
                    <span>Booking </span>
                </a>
                <ul class="sub">
					<li><a  href="<?php echo AUTH_PANEL_URL . 'booking/get_pending_payments_booking'; ?>">Pending Payments</a></li>			
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'booking/get_pending_pickup_booking'; ?>">Pending Pickup </a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'booking/get_current_booking'; ?>">Active Booking</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL . 'booking/get_complete_booking'; ?>">Complete Booking</a></li>		
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cog"></i>
                    <span>Car Setting </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'make_model/car_makes'; ?>">Car Maker(s) List</a></li>
                    <li><a href="<?php echo AUTH_PANEL_URL . 'make_model/index'; ?>">Car Model(s) List</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'Car_features/index'; ?>">Car Feature(s) List</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/car_details_settings'; ?>">Car input fields</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span>Car Claim </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'car_claim/index'; ?>">Car Claim(s) List</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>Report</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_user_report/index'; ?>">User Report</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_car_report/index'; ?>">Car Report</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_request_report/index'; ?>">Request Report</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span>Transaction </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'transaction/index'; ?>">Transaction(s) List</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span> Under dev. option </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/index'; ?>">Footer Setting(s)</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/google_analytics'; ?>">Google Analytics</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/social_login_settings'; ?>">Social Login Setting(s)</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/database_backup'; ?>">Database backup</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/mango_pay_credentials'; ?>">Mango Pay Credentials</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/you_earn_value'; ?>">Commission Rate</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/security_deposit'; ?>">Security Deposit Value</a></li>
					<li><a  href="<?php echo AUTH_PANEL_URL . 'web_option/terms_and_policy'; ?>">Terms and Policy</a></li>
				</ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span>Meta data</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'page_meta_data/edit_page_meta_data'; ?>">Edit Meta Data</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span> Help option </span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'faq_help/index'; ?>">Create FAQ Help</a></li>
                    <li><a  href="<?php echo AUTH_PANEL_URL . 'faq_help/faq_help_list'; ?>">FAQ Help(s) List</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
