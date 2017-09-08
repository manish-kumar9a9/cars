<?php
$this->load->view('header');
$this->load->view('include/account_header'); ?>

<?php
$request_data = array(
    [
        'id'        =>  1,
        'car_from'  =>  '2017-06-12',
        'car_to'    =>  '2017-06-20',
        'car_renter_data'=> array(
            'user_image'    =>  base_url() . "assets/image/profileicon.png",
            'user_rating'   =>  4,
            'firstName' =>  'Tony',
            'lastName' =>  'Bonano',
        ),
        'car_details'   =>  array(
            'car_brought_year'  =>  '2009',
            'carPickUpLocation'   =>  'Syntagma',
            'carDropOffLocation'  =>  'El. Venizelos ',
            'get_make_name'    =>  'BMW',
            'get_model_name'    =>  'X5',
            'get_city_name'    =>  'Athens',
            'car_images'    =>  array([
                'CarImage_path' =>  base_url().'assets/image/carimagerequests.png',
            ])
        )],
    [
        'id'        =>  2,
        'car_from'  =>  '2017-06-1',
        'car_to'    =>  '2017-06-5',
        'car_renter_data'=> array(
            'user_image'    =>  base_url() . "assets/image/profileicon.png",
            'user_rating'   =>  3.6,
            'firstName' =>  'Tony',
            'lastName' =>  'Bonano',
        ),
        'car_details'   =>  array(
            'car_brought_year'  =>  '2009',
            'carPickUpLocation'   =>  'Syntagma',
            'carDropOffLocation'  =>  'El. Venizelos ',
            'get_make_name'    =>  'Mercedes',
            'get_model_name'    =>  'E-class',
            'get_city_name'    =>  'Athens',
            'car_images'    =>  array([
                'CarImage_path' =>  base_url().'assets/image/carimagerequests.png',
            ])
        )]
);

$notification_data = array(
    array(
        "id"  => "4",
        "user_id"=> "2",
        "text" => "Your car with No. Plate VVV222 is listed successfully.",
        "notification_time" => "2017-06-15 11:10:54",
        "view_status" =>  "0"
    ),
    array(
        "id"  => "4",
        "user_id"=> "2",
        "text" => "Your car with No. Plate VVV222 is listed successfully.",
        "notification_time" => "2017-06-15 11:10:54",
        "view_status" =>  "0"
    )
);

$review_data = array(
    array(
        'id'        =>  1,
        'givenby_username'  =>  'bingo',
        'date'    =>  '2017-06-20',
        'givenby_user_image'    =>  base_url() . "assets/image/profileicon.png",
        'rating'   => 4.6,
        'remarks'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys.
        It has survived not only five centuries, but also the leap into electronic'
    ),
    array(
        'id'        =>  2,
        'givenby_username'  =>  'alexa',
        'date'    =>  '2017-06-21',
        'givenby_user_image'    =>  base_url() . "assets/image/profileicon.png",
        'rating'   => 3.8,
        'remarks'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys.
        It has survived not only five centuries, but also the leap into electronic'
    )
);

?>


<div id="account_wrapper">
    <div class="container">
        <div class="row margin-top-20">
            <div class="col-sm-3 col-md-3 margin-top-20">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="active gradient_filter"><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
                    <li><a href='<?php echo site_url('notification') ?>'>Notifications (2)</a></li>
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
                <div class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <a class="all_segment" href="<?php echo site_url('notification') ?>" >See all Notifications</a>
                    </div>
                </div>
                <div class="clr"></div>
                <div id="notification_wrapper" class="col-xs-12 no-padding">
                    <?php
                    $i = 1;
                    //use the class danger or info to have the colored stripe on the left. i%2==0 is for demo, remove it
                    foreach($notification_data as $nd ){ $i++; ?>
                        <?php include(__DIR__.'/include/ui_blocks/notification.php'); ?>
                    <?php } ?>
                </div>


                <div class="clr margin-top-20"></div>
                <div class="col-sm-3 no-padding">
                    <h3>Rental Requests</h3>
                </div>
                <div id="filter-requests" class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <a class="all_segment" href="<?php echo site_url('request/received') ?>">See all Requests</a>
                    </div>
                </div>
                <div class="clr"></div>
                <div id="booking_wrapper" class="col-xs-12 no-padding">
                    <?php
                    $i = 1 ;
                    foreach($request_data as $r_data){ ?>
                        <?php include(__DIR__.'/include/ui_blocks/request.php'); ?>
                    <?php } ?>
                </div>


                <div class="clr margin-top-20"></div>
                <div class="col-sm-3 no-padding">
                    <h3>Bookings</h3>
                </div>
                <div id="filter-bookings" class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <a class="all_segment" href="<?php echo site_url('request/current_booking') ?>">See all Bookings</a>
                    </div>
                </div>
                <div class="clr"></div>
                <div class="col-xs-12 no-padding">
                    <?php
                    $i = 1 ;
                    foreach($request_data as $r_data){ ?>
                        <?php include('include/ui_blocks/booking.php'); ?>
                    <?php } ?>
                </div>


                <div class="clr margin-top-20"></div>
                <div class="col-sm-3 no-padding">
                    <h3>Reviews</h3>
                </div>
                <div id="filter-reviews" class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <a class="all_segment" href="<?php echo site_url('user/reviews') ?>">See all Reviews</a>
                    </div>
                </div>
                <div class="clr"></div>
                <div class="col-xs-12 no-padding">
                    <?php
                    $i = 1 ;
                    foreach($review_data as $review){ ?>
                        <?php include(__DIR__.'/include/ui_blocks/reviews.php'); ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>


<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->
