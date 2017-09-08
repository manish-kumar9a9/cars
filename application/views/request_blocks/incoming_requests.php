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
?>


<div id="account_wrapper">
	<div class='container'>
		<div class='row margin-top-20'>
			<div class='col-sm-3 col-md-3 margin-top-20'>
				<ul class="nav nav-tabs nav-stacked">
					<li class=""><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
					<li><a href='<?php echo site_url('notification') ?>'>Notifications (2)</a></li>
					<li><a href='#'>My Rentals (120)</a></li>
					<li class="active gradient_filter"><a href='<?php echo site_url('request/received') ?>'>Rental Requests (4)</a></li>
					<li><a href='<?php echo site_url('request/current_booking') ?>'>Bookings (1)</a></li>
					<li><a href='<?php echo site_url('user/reviews') ?>'>Reviews (48)</a></li>
					<li><a href='<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>'><?php echo $this->lang->line('PROFILE');?></a></li>
					<li><a href='<?php echo site_url('account_information/index') ?>'>Account Settings</a></li>
					<li><a href='<?php echo base_url() ?>index.php/user/logout'>Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-9 col-md-9">
				<div class="col-sm-3 no-padding">
					<h3>Rental Requests</h3>
				</div>
				<div id="filter-requests" class="col-sm-9 text-right no-padding">
					<div class="pull-right">
						<div class="all active"><?php echo $this->lang->line('ALL');?>(154)</div>
						<div class="new">New(2)</div>
						<div class="approved">Approved(4)</div>
						<div class="rejected">Rejected(1)</div>
						<div class="search"><img src="<?php echo base_url(); ?>assets/image/searchicon.png"/>Search</div>
					</div>
				</div>

				<div class="clr"></div>
				<div id="booking_wrapper" class="col-xs-12 no-padding">
					<?php
					$i = 1 ;
					foreach($request_data as $r_data){ ?>
						<?php include(__DIR__.'/../include/ui_blocks/request.php'); ?>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</div>


<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->
