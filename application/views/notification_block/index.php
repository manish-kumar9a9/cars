<?php
$this->load->view('header');
$this->load->view('include/account_header'); ?>


<?php //var_dump($notification_data);?>

<div id="account_wrapper">
    <div class='container'>
        <div class='row margin-top-20'>
            <div class='col-sm-3 col-md-3 margin-top-20'>
                <ul class="nav nav-tabs nav-stacked">
                    <li class=""><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
                    <li class="active gradient_filter"><a href='<?php echo site_url('notification') ?>'>Notifications (12)</a></li>
                    <li><a href='#'>My Rentals (120)</a></li>
                    <li><a href='<?php echo site_url('request/received') ?>'>Rental Requests (4)</a></li>
                    <li><a href='<?php echo site_url('request/current_booking') ?>'>Bookings (1)</a></li>
                    <li><a href='<?php echo site_url('user/reviews') ?>'>Reviews (48)</a></li>
                    <li><a href='<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>'><?php echo $this->lang->line('PROFILE');?></a></li>
                    <li><a href='<?php echo site_url('account_information/index') ?>'>Account Settings</a></li>
                    <li><a href='<?php echo base_url() ?>index.php/user/logout'>Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="col-sm-3 no-padding">
                    <h3>Notifications</h3>
                </div>
                <div id="filter-notifications" class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <div class="all active"><?php echo $this->lang->line('ALL');?>(10)</div>
                        <div class="new">New(3)</div>
                        <div class="search"><img src="<?php echo base_url(); ?>assets/image/searchicon.png"/>Search</div>
                    </div>
                </div>

                <div class="clr"></div>
                <div id="notification_wrapper" class="col-xs-12 no-padding">
                    <?php
                    $i = 1;
                    //use the class danger or info to have the colored stripe on the left. i%2==0 is for demo, remove it
                    foreach($notification_data as $nd ){ $i++; ?>
                        <?php include(__DIR__.'/../include/ui_blocks/notification.php'); ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->
