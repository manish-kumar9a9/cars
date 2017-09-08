<?php
$this->load->view('header');
$this->load->view('include/account_header'); ?>

<?php
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
    <div class='container'>
        <div class='row margin-top-20'>
            <div class='col-sm-3 col-md-3 margin-top-20'>
                <ul class="nav nav-tabs nav-stacked">
                    <li class=""><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
                    <li><a href='<?php echo site_url('notification') ?>'>Notifications (2)</a></li>
                    <li><a href='#'>My Rentals (120)</a></li>
                    <li><a href='<?php echo site_url('request/received') ?>'>Rental Requests (4)</a></li>
                    <li><a href='<?php echo site_url('request/current_booking') ?>'>Bookings (1)</a></li>
                    <li class="active gradient_filter"><a href='<?php echo site_url('user/reviews') ?>'>Reviews (48)</a></li>
                    <li><a href='<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>'><?php echo $this->lang->line('PROFILE');?></a></li>
                    <li><a href='<?php echo site_url('account_information/index') ?>'>Account Settings</a></li>
                    <li><a href='<?php echo base_url() ?>index.php/user/logout'>Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="col-sm-3 no-padding">
                    <h3>Reviews</h3>
                </div>
                <div id="filter-reviews" class="col-sm-9 text-right no-padding">
                    <div class="pull-right">
                        <div class="all active"><?php echo $this->lang->line('ALL');?>(154)</div>
                        <div class="my">My Reviews (2)</div>
                        <div class="cutomers">Customer Reviews(33)</div>
                        <div class="search"><img src="<?php echo base_url(); ?>assets/image/searchicon.png"/>Search</div>
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
