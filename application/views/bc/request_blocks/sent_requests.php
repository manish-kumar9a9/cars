<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">

		<?php $this->load->view('include/head_block'); ?>

	<div class="findcar-no-bg bg-333">
        <div class="findcar-inner rental-noti">
			<div class="width-50 float-left">
				<h2 class="text-white no-margin padding-15-0 bg-333"><?php echo $this->lang->line('RENTAL_NOTIFICATION'); ?></h2>
			</div>
			<div class="width-50 float-left req-btn">
				<a href="<?php echo site_url('request/sent'); ?>" class="theme-btn-green theme-btn <?php echo ($this->router->fetch_method() == "sent") ? " theme-btn-green-active " : " "; ?>"><?php echo $this->lang->line('REQUEST_SENT'); ?></a>
				<a href="<?php echo site_url('request/received'); ?>" class="theme-btn-green theme-btn <?php echo ($this->router->fetch_method() != "sent") ? " theme-btn-green-active " : " "; ?>"><?php echo $this->lang->line('REQUEST_RECEIVED'); ?></a>
			</div>
			<div class="clr"></div>

			<div class="text-white padding text-center width-100 theme-text-color ralewaybold"> <?php echo $this->session->flashdata('page_message'); ?>  </div>


			<?php
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_get_all_sent_request',
				'data' => $params = array('car_renter_id' => $this->session->userdata('userId'))
			);
			$result = get_data_with_curl($option);

			$i = 1;
			rsort($request_data);
			foreach ($request_data as $r_data) {
				if ($i % 2 != 0) {
					?>
					<div class="width-100 rental-noti-box ">
						<div class="width-60 float-left img">
		                    <a href="<?php echo site_url('booking_auth/booking/' . $r_data['id']); ?>"><img src="<?php echo $r_data['car_details']['car_images'][0]['CarImage_path']; ?>"></a>
						</div>
						<div class="width-40 float-left padding-15-0">
		                    <div class="normal-div width-90 padding-right-15 float-right">
								<a href="<?php echo site_url('booking_auth/booking/' . $r_data['id']); ?>"> <p class="no-margin padding-5-0"><?php echo $r_data['car_details']['get_city_name']; ?></p>
									<h3 class="no-margin padding-5-0"><?php echo $r_data['car_details']['get_make_name'] . " " . $r_data['car_details']['get_model_name'] ?> <span class="theme-text-color"><?php echo $r_data['car_details']['car_brought_year']; ?></span></h3></a>
								<div class="clr"></div>
								<ul class="trip-date-element ">
									<li>
										<i class="fa fa-calendar theme-text-color"></i>
										<h4 class="no-margin"><span><?php echo $this->lang->line('FROM');?> </span><br><?php echo date("d-m-Y H:i ", strtotime($r_data['car_from'])); ?>
										</h4>
									</li>
									<li>
										<i class="fa fa-calendar theme-text-color"></i>
										<h4 class="no-margin"><span><?php echo $this->lang->line('TO');?></span><br><?php echo date("d-m-Y H:i", strtotime($r_data['car_to'])); ?>
										</h4>
									</li>
								</ul>
								<div class="clr"></div>
								<ul>
									<li>
										<i class="fa fa-map-marker theme-text-color"></i> <h4 class="no-margin"><span><?php echo $this->lang->line('CAR_PICKUP_LOCATION');?></span><br><?php echo $r_data['pickup_location']; ?></h4>
										<div class="clr"></div>

									</li>
								</ul>
								<ul>
									<li>
										<i class="fa fa-map-marker theme-text-color"></i> <h4 class="no-margin"><span><?php echo $this->lang->line('CAR_DROPOFF_LOCATION');?></span><br><?php echo $r_data['drop_off_location']; ?></h4>
										<div class="clr"></div>

									</li>

								</ul>
								<div class="clr"></div>
		                        <div class="theme-text-color ralewaybold" ><?php echo $this->lang->line('OWNED_BY');?> </div>
								<ul class="rental-pic">
									<li>
										<img src="<?php echo $r_data['car_owner_data']['user_image']; ?>">
										<div class="i-tag">

											<div class="clr"></div>
											<?php genrate_star_html($r_data['car_owner_data']['user_rating'], ""); ?>
											</br>
											<span class="text-white ralewaymedium  width-100"> <?php echo $r_data['car_owner_data']['firstName'] . " " . $r_data['car_owner_data']['lastName'] ?> </span>
										</div>
									</li>
								</ul>
		                    </div>
						</div>
					</div>

					<?php
				} else {
					?>
					<div class="width-100 rental-noti-box ">
						<div class="width-40 float-left padding-15-0">
		                    <div class="normal-div width-90 padding-right-15 float-right">
								<a href="<?php echo site_url('booking_auth/booking/' . $r_data['id']); ?>"> <p class="no-margin padding-5-0"><?php echo $r_data['car_details']['get_city_name']; ?></p>
									<h3 class="no-margin padding-5-0"><?php echo $r_data['car_details']['get_make_name'] . " " . $r_data['car_details']['get_model_name'] ?> <span class="theme-text-color"><?php echo $r_data['car_details']['car_brought_year']; ?></span></h3></a>
								<div class="clr"></div>
								<ul class="trip-date-element ">
									<li>
										<i class="fa fa-calendar theme-text-color"></i>
										<h4 class="no-margin"><span><?php echo $this->lang->line('FROM');?> </span><br><?php echo date("d-m-Y H:i ", strtotime($r_data['car_from'])); ?>
										</h4>
									</li>
									<li>
										<i class="fa fa-calendar theme-text-color"></i>
										<h4 class="no-margin"><span><?php echo $this->lang->line('TO');?></span><br><?php echo date("d-m-Y H:i", strtotime($r_data['car_to'])); ?>
										</h4>
									</li>
								</ul>
								<div class="clr"></div>
								<ul>
									<li>
										<i class="fa fa-map-marker theme-text-color"></i> <h4 class="no-margin"><span><?php echo $this->lang->line('CAR_PICKUP_LOCATION');?></span><br><?php echo $r_data['pickup_location']; ?></h4>
										<div class="clr"></div>
								</ul>
								<ul>
									</li>
									<li>
										<i class="fa fa-map-marker theme-text-color"></i> <h4 class="no-margin"><span><?php echo $this->lang->line('CAR_DROPOFF_LOCATION');?></span><br><?php echo $r_data['drop_off_location']; ?></h4>
										<div class="clr"></div>

									</li>
								</ul>
								<div class="clr"></div>
		                        <div class="theme-text-color ralewaybold" ><?php echo $this->lang->line('OWNED_BY');?></div>
								<ul class="rental-pic">
									<li>
										<img src="<?php echo $r_data['car_owner_data']['user_image']; ?>">
										<div class="i-tag">

											<div class="clr"></div>
											<?php genrate_star_html($r_data['car_owner_data']['user_rating'], ""); ?>
											</br>
											<span class="text-white ralewaymedium  width-100"> <?php echo $r_data['car_owner_data']['firstName'] . " " . $r_data['car_owner_data']['lastName'] ?> </span>
										</div>
									</li>
								</ul>
		                    </div>
						</div>
						<div class="width-60 float-left img">
		                    <a href="<?php echo site_url('booking_auth/booking/' . $r_data['id']); ?>"><img src="<?php echo $r_data['car_details']['car_images'][0]['CarImage_path']; ?>"></a>
						</div>
					</div>
					<?php
				}
				?>

				<?php
				$i++;
			}
			?>
        </div>
	</div>


	<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
	<!--/footer-->


	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>

</body>
</html>
<?php //pre($request_data); ?>
