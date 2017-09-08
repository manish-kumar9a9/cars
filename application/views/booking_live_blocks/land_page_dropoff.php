<?php
$owner_data = $booking_data['car_owner_data'];
$renter_data = $booking_data['car_renter_data'];
$car_data = $booking_data['car_details'];

//var_dump($booking_data);

$user_image = base_url() . "assets/image/Icon-user-1.png";
if ($car_data['get_user_image'] != "") {
	$user_image = $car_data['get_user_image'];
}
?>

<?php $this->load->view('header'); ?>

<div xmlns="http://www.w3.org/1999/html">
	<div class="header-banner gradient_filter">
		<div class="container">
			<?php if ($booking_data['booking_user_type'] == "renter") { ?>
				<h3 style="color: #fff">Rental Summary</h3>
			<?php } else { ?>
				<h3 style="color: #fff">Rental Request</h3>
			<?php } ?>
		</div>
	</div>
	<div id="overview-panel" class="view-car">
		<div class="container">
			<div class="row">
				<div class="col-md-8 margin-bottom-50">

					<?php if ($booking_data['booking_user_type'] == "renter") { ?>
						<h5 class="margin-top-30">Please review the information below, before sending your rental request.</h5>
					<?php } else { ?>
						<h5 class="margin-top-30">Please review the information below, before approving or rejecting rental request.</h5>
					<?php } ?>

					<div class="clr"></div>

					<?php if ($booking_data['booking_user_type'] == "renter") { ?>
						<div class="row margin-top-10">
							<div class="col-md-12">
								<h3><?php echo $this->lang->line('VEHICLE_DETAILS'); ?></h3>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('MAKE'); ?></div>
										<div class="col-xs-6 text-right">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle button white pull-right" type="button">
													<span><?php echo $car_data['get_make_name'] ;?></span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('CATEGORY'); ?></div>
										<div class="col-xs-6 text-right">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle button white pull-right" type="button">
													<span><?php echo $car_data['get_type_name'] ;?></span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('MODEL'); ?></div>
										<div class="col-xs-6 text-right">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle button white pull-right" type="button">
													<span><?php echo $car_data['get_model_name'] ;?></span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('YEAR'); ?></div>
										<div class="col-xs-6 text-right">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle button white pull-right" type="button">
													<span><?php echo $car_data['car_brought_year'] ;?></span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="clr"></div>
						<div class="row margin-top-10">
							<div class="col-md-12">
								<h3><?php echo $this->lang->line('VEHICLE'). ' '.$this->lang->line('SPECIFICATION'); ?></h3>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('KILOMETERS'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo $car_data['mileage']; ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('ENGINE_SIZE'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo $car_data['cubicCapacity']; ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('FUEL_TYPE'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo $car_data['get_fuel_type_name']; ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('TRANSMISSION'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo $car_data['get_transmission_name']; ?></strong></div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('COLOR'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo $car_data['get_car_color']; ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('DOORS'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo current(explode(' ', $car_data['doors'])); ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('SEATS'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo current(explode(' ', $car_data['seat'])); ?></strong></div>
									</div>
								</div>
								<div class="col-sm-12 spec">
									<div class="row">
										<div class="col-xs-6"><?php echo $this->lang->line('AIRBAGS'); ?></div>
										<div class="col-xs-6 text-right"><strong><?php echo current(explode(' ', $car_data['airbags'])); ?></strong></div>
									</div>
								</div>
							</div>
						</div>

						<div class="clr"></div>
						<div class="row margin-top-10">
							<div class="col-md-12">
								<h3><?php echo $this->lang->line('VEHICLE'). ' '.$this->lang->line('EXTRAS'); ?></h3>
							</div>
							<?php
							$fcnt = 0;
							$openeddiv = 0;
							$ftotalcnt = count($car_data['car_features']);

							foreach ($car_data['car_features'] as $ci) {
								if( $this->input->cookie('lang') == "greek"){
									$keyname =  "feature_name_greek";
								}else{
									$keyname =  "feature_name";
								}
								if($fcnt == 0 || round($ftotalcnt/2) == $fcnt ){
									if($openeddiv >= 1) echo '</div>';
									echo '<div class="col-sm-6">'; //echo $fcnt;
									$openeddiv++;
								}
								?>
								<div class="col-sm-12 spec ">
									<div class="row">
										<div class="col-xs-8"><?php echo $ci[$keyname]; ?></div>
										<div class="col-xs-4 text-right"><img src="<?php echo base_url(); ?>assets/image/speccheckicon.png"/></div>
									</div>
								</div>
								<?php
								if( $ftotalcnt/2 == $fcnt || $ftotalcnt == $fcnt){
									$openeddiv--;
								}
								$fcnt++;
							}
							if($openeddiv != 0) echo '</div>';
							?>
						</div>

						<div id="owner" class="row">
							<div class="col-xs-12">
								<h3><?php echo $this->lang->line('INSURANCE_COVERAGE'); ?></h3>
								<div class="col-xs-12 box-shadow ownerdata padding-top-10 padding-bottom">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
												when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
												but also the leap into electronic </p>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php } else { ?>

						<div id="renter" class="row" style="padding-top: 70px;margin-top: -60px;">
							<div class="col-xs-12">
								<h3>Renter details</h3>
								<div class="col-xs-12 ownerdata">
									<div class="row">
										<div class="col-xs-12 col-sm-10">
											<h3><?php echo current(explode(' ', $car_data['get_username'])); ?></h3>
											<span class="joined"><?php echo $this->lang->line('JOINED_IN'); ?> <?php echo date('M Y ', strtotime('2017/05/11')); ?></span>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
												when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
												but also the leap into electronic </p>
											<div class="col-sm-12 no-padding txt-bold margin-bottom-10">
												Rentals: 0 &nbsp;&nbsp;
												Reviews: 0 &nbsp;&nbsp;
												Vehicles: 0
											</div>
										</div>
										<div class="col-xs-12 col-sm-2 ">
											<div class="row">
												<div class="col-xs-11 margin-top-40">
													<img class="profile-pic" src="<?php echo $user_image; ?>">
												</div>
												<div class="col-xs-11 margin-top-20 margin-bottom-20 no-padding">
													<button class="button gradient_filter">
														<span><?php echo $this->lang->line('CONTACT');?></span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

					<div class="clr"></div>
					<div class="row margin-top-10">
						<div class="col-md-12">
							<h3>Pick up</h3>
							<div class="col-xs-12 box-shadow padding-bottom-20 margin-bottom-30" style="background: #fff; min-height: 250px;">
								<div class="col-xs-12 no-padding margin-top-10">
									<?php echo $car_data['carPickUpLocation']; ?>
								</div>
								<div id="google-map1" class="google-map col-xs-12 margin-top-10" style="height: 200px;"></div><!-- #google-map -->
							</div>
							<h3>Drop Off</h3>
							<div id="location_return" class="col-xs-12 box-shadow" style="background: #fff; min-height: 250px;">
								<div class="col-xs-12 no-padding margin-top-10">
									<?php echo $car_data['carDropOffLocation']; ?>
								</div>
								<div id="google-map2" class="google-map col-xs-12 margin-top-10" style="height:200px;"></div>
							</div>
						</div>
					</div>

					<div class="clr"></div>

					<?php if ($booking_data['booking_user_type'] == "renter") { ?>
						<div id="owner" class="row" style="padding-top: 70px;margin-top: -60px;">
							<div class="col-xs-12">
								<h3><?php echo $this->lang->line('VEHICLE_OWNER'); ?></h3>
								<div class="col-xs-12 ownerdata">
									<div class="row">
										<div class="col-xs-12 col-sm-10">
											<h3><?php echo current(explode(' ', $car_data['get_username'])); ?></h3>
											<span class="joined"><?php echo $this->lang->line('JOINED_IN'); ?> <?php echo date('M Y ', strtotime('2017/05/11')); ?></span>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
												when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
												but also the leap into electronic </p>
										</div>
										<div class="col-xs-12 col-sm-2 ">
											<div class="row">
												<div class="col-xs-11 margin-top-40">
													<img class="profile-pic" src="<?php echo $user_image; ?>">
												</div>
												<div class="col-xs-11 margin-top-20 margin-bottom-20 no-padding">
													<button class="button gradient_filter">
														<span><?php echo $this->lang->line('CONTACT');?></span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

				</div>

				<div class="col-md-3 gradient_filter summary sidebar " style="padding-top: 0;">
					<div class="center">
						<img src="<?php echo 'http://localhost/urend/assets/image/porsche.png';
						//echo $car_data['car_images'][0]['CarImage'];
						?>"/>
					</div>
					<h4 style="color:#fff" class="center">BMW M2</h4>
					<?php if ($booking_data['booking_user_type'] == "renter") { ?>
						<h6 class="center">You won't be charged until owner accepts request</h6>
					<?php } else { ?>
						<h6 class="center">Check all details are correct before approving rental</h6>
					<?php } ?>

					<form action="">

						<div class="searchbox no-margin">

							<div class="col-md-12" style="background: #fff;padding: 5px 10px;">
								<h6>Pick up date and location</h6>
								<div class="reqdetail"><b><?php echo $booking_data['car_from']; ?></b></div>
								<div class="reqdetail"><?php echo $car_data['carPickUpLocation']; ?></div>
							</div>
							<div class="col-md-12 margin-top-10" style="background: #fff;padding: 5px 10px;">
								<h6>Drop off date and location</h6>
								<div class="reqdetail"><b><?php echo $booking_data['car_to']; ?></b></div>
								<div class="reqdetail"><?php echo $car_data['carDropOffLocation']; ?></div>
							</div>
							<div class="col-md-12 margin-top-10" style="background: #fff;padding: 5px 10px;">
								<h6>Kilometer Allowance</h6>
								<div class="reqdetail"><b>400 kilometers for 4 days</b></div>
								<div class="reqdetail" style="font-size: 12px">Additional kilometers charged at &euro; 0,15 per km</div>
							</div>

							<div class="col-md-12 margin-top-10 margin-bottom-10" style="color:initial;background: #fff;padding: 5px 10px;">

								<div class="col-md-12 margin-top-10 no-padding">
									<div class="col-md-6 no-padding pricedetail">Price per Day</div>
									<div class="col-md-6 text-right">&euro;350,00</div>
								</div>
								<div class="col-md-12 margin-top no-padding">
									<div class="col-md-6 no-padding pricedetail">Number of Days</div>
									<div class="col-md-6 text-right">x4</div>
								</div>
								<div class="col-md-12 margin-top no-padding">
									<div class="col-md-6 no-padding pricedetail">Delivery Charge</div>
									<div class="col-md-6 text-right">+&euro;85,00</div>
								</div>
								<?php if ($booking_data['booking_user_type'] == "owner") { ?>
									<div class="col-md-12 margin-top no-padding">
										<div class="col-md-6 no-padding pricedetail">Total Rental Cost</div>
										<div class="col-md-6 text-right"><b>&euro;1485,00</b></div>
									</div>
									<div class="col-md-12 margin-top no-padding">
										<div class="col-md-6 no-padding pricedetail ">Our fees(7%)</div>
										<div class="col-md-6 text-right"><b>&euro;103,95</b></div>
									</div>
								<?php } ?>
								<div class="col-md-12 margin-top-10 no-padding">
									<div class="col-md-6 no-padding pricedetail margin-top">Total Cost</div>
									<div class="col-md-6 text-right" style="font-size: 21px"><b>&euro;1485,00</b></div>
								</div>

								<?php if ($booking_data['booking_user_type'] == "renter") { ?>
									<div class="col-md-12 margin-bottom-15 margin-top-20 no-padding">
										<input  class="button gradient_filter " type="submit" value="SEND RENTAL REQUEST">
									</div>
								<?php } else { ?>
									<div class="col-md-12 margin-top-20 no-padding">
										<input class="col-md-12 button gradient_filter " type="submit" value="APPROVE RENTAL">
									</div>
									<div class="col-md-12 margin-bottom-10 margin-top-10 no-padding">
										<input class="col-md-12 button cancel" type="submit" value="REJECT RENTAL">
									</div>
								<?php } ?>

								<div class="col-md-12 margin-top-10 margin-bottom center">
									<p><input type="checkbox" value="" id="terms_condition" > I agree to Urend <a href="#"> Terms of Service </a> </p>
								</div>
							</div>

						</div>
					</form>

				</div>

			</div>
		</div>
	</div>

</div>


<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&callback=initMap&language=en">
</script>
<script>

	function initMap() {
		var myLatLng = {lat: <?php echo $car_data['carPickUpLat']; ?>, lng:<?php echo $car_data['carPickUpLon']; ?>};
		var is_touch_device = 'ontouchstart' in document.documentElement;
		var map = new google.maps.Map(document.getElementById('google-map1'), {
			zoom: 10,
			center: myLatLng,
			scrollwheel: false,
			draggable: !is_touch_device
		});
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			infoWindow: {
				location_address: '<?php echo $car_data['carPickUpLocation']; ?>',
				content: '<?php echo $car_data['carPickUpLocation']; ?>'
			},
			icon: "<?php echo base_url(); ?>assets/image/cars_on_map.png"
		});

		var map2 = new google.maps.Map(document.getElementById('google-map2'), {
			zoom: 10,
			center: myLatLng,
			scrollwheel: false,
			draggable: !is_touch_device
		});
		var marker2 = new google.maps.Marker({
			position: myLatLng,
			map: map,
			infoWindow: {
				location_address: '<?php echo $car_data['carDropOffLocation']; ?>',
				content: '<?php echo $car_data['carDropOffLocation']; ?>'
			},
			icon: "<?php echo base_url(); ?>assets/image/cars_on_map.png"
		});
	}
</script>

<!--footer-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->





<?php if ($booking_data['booking_user_type'] == "owner") { ?>
	<div class="container hide transaction_form">
		<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
			<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS'); ?></h1>
			<div class="underline"></div>
		</div>

		<form id="form_owner_pickup_form" enctype="multipart/form-data" method="post">
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
				<div id="form_user_pickup_owner_error" class="">
				</div>
				<input type="hidden" name="request_id" value="<?php echo $booking_data['id']; ?>">
				<input type="hidden" name="car_owner_id" value="<?php echo $booking_data['car_user_id']; ?>" >
				<input type="hidden" name="car_id" value="<?php echo $booking_data['car_id']; ?>" >
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<h3>Meter Reading</h3>
						<input type="text" name="car_meter_reading" class="car-booking-input" value="">
					</div>

				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<label>The renter provide his/her driving lisence </label><input type="checkbox" class="car-booking-input" name="verify_renter_dl" >
					</div>
				</div>

				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<div class="file_up margin-bottom ">
							<input name="car_image1" class="file_upper theme-btn theme-btn-basic " type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom">
							<input name="car_image2" class="file_upper theme-btn theme-btn-basic " type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom">
							<input name="car_image3"  class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image4" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image5" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image6" class="file_upper  theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image7" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button">Cancel</button></br>
							<img class="imagepreview hide ">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image8" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button">Cancel</button></br>
							<img class="imagepreview hide ">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image9" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview">
						</div>

					</div>
				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
						<h3> Remarks</h3>
						<textarea rows="5" name="car_remarks" class="remarks-textarea"></textarea>
					</div>
				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">

					<input class="theme-btn theme-btn-green cancel_transaction_button" type="button" name="cancel" value="cancel">
					<input class="theme-btn theme-btn-green" type="submit" name="submit" value="Save">
				</div>
		</form>
	</div>
<?php } ?>
<!-- Modal -->
<?php if ($booking_data['booking_user_type'] == "renter") { ?>
	<div class="container hide transaction_form" >
		<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
			<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS'); ?></h1>
			<div class="underline"></div>
		</div>

		<form id="form_owner_pickup_form" enctype="multipart/form-data" method="post">
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
				<div id="form_user_pickup_owner_error" class="">	</div>
				<input type="hidden" name="request_id" value="<?php echo $booking_data['id']; ?>">
				<input type="hidden" name="car_renter_id" value="<?php echo $booking_data['car_renter_id']; ?>" >
				<input type="hidden" name="car_id" value="<?php echo $booking_data['car_id']; ?>" >
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<h3>Meter Reading</h3>
						<input type="text" name="car_meter_reading" class="car-booking-input" value="">
					</div>

				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<label>The owner provide his/her insurence contarct & registration papers</label><input type="checkbox" class="car-booking-input" name="verify_renter_dl" >
					</div>
				</div>

				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
					<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
						<div class="file_up margin-bottom ">
							<input name="car_image1" class="file_upper theme-btn theme-btn-basic " type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom">
							<input name="car_image2" class="file_upper theme-btn theme-btn-basic " type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom">
							<input name="car_image3"  class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic"  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image4" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image5" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview  hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image6" class="file_upper  theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image7" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button">Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image8" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button">Cancel</button></br>
							<img class="imagepreview hide">
						</div>
						<div class="file_up margin-bottom ">
							<input name="car_image9" class="file_upper theme-btn theme-btn-basic" type='file' >
							<button class="img_closer theme-btn theme-btn-basic "  type="button" >Cancel</button></br>
							<img class="imagepreview hide ">
						</div>

					</div>
				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
						<h3> Remarks </h3>
						<textarea rows="5" name="car_remarks" class="remarks-textarea"></textarea>
					</div>
				</div>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">

					<input class="theme-btn theme-btn-green cancel_transaction_button" type="button" name="cancel" value="cancel">
					<input class="theme-btn theme-btn-green" type="submit" name="submit" value="Save">
				</div>
			</div>
		</form>

	</div>

<?php } ?>
<div class="modal fade" id="cancel_request" role="dialog">
	<div class="modal-dialog modal-dialog-new">

		<!-- Modal content-->
		<div class="modal-content modal-content-new">
			<div class="modal-header modal-header-new bg-black text-center">

				<img src="<?php echo base_url(); ?>assets/image/LOGO.png" />
			</div>
			<div class="modal-body text-center">
				<p class="cancel-message"><?php echo $this->lang->line('CHARGES_APPLY_FOR_CANCEL'); ?><br>
					<strong><?php echo $this->lang->line('ARE_YOU_SURE'); ?></strong>
				</p>
			</div>
			<div class="modal-body text-center ">

				<div class="row">
					<div class="col-new-lg-6 col-new-md-6">
						<a href="<?php echo site_url('booking_auth/reject_request'); ?>?booking_id=<?php echo $booking_data['id']; ?>&id_tokken=<?php echo id_hasher($booking_data['id']); ?>">
							<div class="col-new-lg-12 col-new-md-12 yes-button theme-btn ">
								<?php echo $this->lang->line('YES'); ?>
							</div>
						</a>
					</div>

					<div class="col-new-lg-6 col-new-md-6 ">
						<div class="col-new-lg-12 col-new-md-12 no-button theme-btn" data-dismiss="modal" >
							<?php echo $this->lang->line('NO'); ?>
						</div>
					</div>
				</div>
			</div>
			<div style="display:none" class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>


<div class="modal fade" data-backdrop="static" data-keyboard="false" id="wait_process" role="dialog">
	<div class="modal-dialog modal-dialog-new">

		<!-- Modal content-->
		<div class="modal-content modal-content-new">

			<div class="modal-body text-center">
				<img src="<?php echo base_url(); ?>assets/image/booking_car/wheele-spin.gif" />
				<p class="verifying">Verifying....</p>
				<p class="waiting-message">Please Wait Until Renter <br> Confirm Pickup</p>
			</div>
			<div class="modal-body text-center green-body">

				<p class="waiting-message1">"Don't get away until the<br> Renter accepts the deliver"</p>
			</div>
			<div style="display:none" class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('CLOSE'); ?></button>
			</div>
		</div>

	</div>
</div>

<div class="modal fade"  id="proceed_to_pay" role="dialog">
	<div class="modal-dialog modal-dialog-new">

		<!-- Modal content-->
		<div class="modal-content modal-content-new">

			<div class="modal-body text-center">
				<i class="fa fa-credit-card fa-4x" ></i>
				<p class="waiting-message"><?php echo $this->lang->line('PROCEED_TO_PAYMENT_GATEWAY'); ?></p>
			</div>
			<div class="modal-body text-center green-body">

				<i class="fa fa-hand-o-right fa-lg "></i> <?php echo $this->lang->line('PAYMENT_PRE_WARNING'); ?>
			</div>
			<div class="modal-body text-center ">

				<div class="row">
					<div class="col-new-lg-6 col-new-md-6">
						<a href="<?php echo site_url("banking/payment/" . $booking_data['id']); ?>">
							<div class="col-new-lg-12 col-new-md-12 yes-button theme-btn ">
								<?php echo $this->lang->line('YES'); ?>
							</div>
						</a>
					</div>

					<div class="col-new-lg-6 col-new-md-6 ">
						<div class="col-new-lg-12 col-new-md-12 no-button theme-btn" data-dismiss="modal" >
							<?php echo $this->lang->line('NO'); ?>
						</div>
					</div>
				</div>
			</div>

			<div style="display:none" class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<?php if ($this->input->get('payment_process_state')) { ?>
	<div class="modal fade"  id="Payment_status" role="dialog">
		<div class="modal-dialog modal-dialog-new">

			<!-- Modal content-->
			<div class="modal-content modal-content-new">

				<div class="modal-body text-center">
					<?php
					if ($this->input->get('payment_process_state') == "success") {
						echo '<i class="fa fa-check fa-4x" ></i>';
					} else {
						echo '<i class="fa fa-warning fa-4x" ></i>';
					}
					?>
					<p class="waiting-message">
						<?php
						if ($this->input->get('payment_process_state') == "success") {
							echo "Payment process successfull.";
						} else {
							echo "Unable to process your payment.";
						}
						?>
					</p>
				</div>
				<?php if ($this->input->get('payment_process_state') == "success") { ?>
					<div class="modal-body text-center green-body">
						<i class="fa fa-hand-o-right fa-lg "></i>
						<?php
						$transaction_tokken = "";
						$booking_renter_transaction = $booking_data['booking_renter_transaction'];
						if (is_array($booking_renter_transaction) && array_key_exists("transaction_id", $booking_renter_transaction)) {
							$transaction_tokken = $booking_renter_transaction['transaction_id'];
						}
						?>
						Please use this id <?php echo $transaction_tokken; ?> as a reference for your payment transaction.
					</div>
				<?php } ?>
				<?php if (count($transaction_id_data) > 0) { ?>

					<div class="modal-body text-center green-body">
						<i class="fa fa-hand-o-right fa-lg "></i>
						<?php echo $transaction_id_data->ResultMessage; ?>
					</div>

				<?php } ?>

				<div class="modal-body text-center ">

					<div class="row">
						<div class="col-new-lg-6 col-new-md-6 ">
							<div class="col-new-lg-12 col-new-md-12 no-button theme-btn" data-dismiss="modal" >
								Close
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- model popup ends -->


<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$(input).siblings('.imagepreview').prop('src', e.target.result).show('slow');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function () {

		$(".file_upper").change(function () {
			readURL(this);
		});

		$('.img_closer').click(function (e) {
			$(this).siblings('.file_upper').val("");
			$(this).siblings('img').attr("src", "").hide();
		});

		$('.cancel_transaction_button').click(function () {
			$('.container').show('slow');
			$('.transaction_form').hide('fast');
		});

	});

	$('body').on('click', '.fill_form_element', function () {
		$('.transaction_form').show();
		$('.container').hide();
		$('.transaction_form').show();
		$(window).scrollTop($('.transaction_form').offset().top - 69);

	});

	function sync_page() {
		jQuery.ajax({
			url: '<?php echo site_url('booking_auth/sync_page/'); ?>',
			method: 'POST',
			dataType: 'json',
			data: {
				id: '<?php echo $booking_data['id']; ?>',
				tokken: '<?php echo id_hasher($booking_data['id']); ?>'
			},
			success: function (data) {
				if (data.html) {
					$('#action_button_element').html(data.html).show('slow');
				}
			}
		});
	}

	sync_page();

	setInterval(function () {
		sync_page();
	}, 10000);

	<?php
    /* show owner waiting spinner */
    if ($booking_data['booking_user_type'] == "owner") {
        ?>
	$(document).ready(function (e) {
		$('#form_owner_pickup_form').on('submit', (function (e) {
			e.preventDefault();
			$('#form_user_pickup_owner_error').html('');
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/service_initialize_car_info_by_owner',
				type: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				success: function (data) {
					if (data.isSuccess) {
						location.reload();
					} else {
						$('#form_user_pickup_owner_error').html(data.message);
					}
				}
			});
		}));
	});
	<?php
}
?>

	<?php
    /* show owner waiting spinner */
    if ($booking_data['booking_user_type'] == "renter") {
        ?>
	$(document).ready(function (e) {
		$('#form_owner_pickup_form').on('submit', (function (e) {
			e.preventDefault();
			$('#form_user_pickup_owner_error').html('');
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/service_initialize_car_info_by_renter',
				type: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				success: function (data) {
					if (data.isSuccess) {
						location.reload();
					} else {
						$('#form_user_pickup_owner_error').html(data.message);
					}
				}
			});
		}));
	});
	<?php
}
?>

	<?php
    /* show owner waiting spinner */
    if ($booking_data['forms_towards_renter']['owner'] != '' && $booking_data['booking_user_type'] == "owner" && $booking_data['pickup_confirmed'] == 0) {
        ?>
	$('#wait_process').modal('show');

	function owner_waiting() {
		jQuery.ajax({
			url: '<?php echo site_url('booking_auth/owner_waiting_for_pickup/'); ?>',
			method: 'POST',
			dataType: 'json',
			data: {
				id: '<?php echo $booking_data['id']; ?>',
				tokken: '<?php echo id_hasher($booking_data['id']); ?>'
			},
			success: function (data) {
				if (data.status) {
					location.reload();
				}
			}
		});
	}

	owner_waiting();

	setInterval(function () {
		owner_waiting();
	}, 10000);

	<?php
}
?>
	<?php if ($this->input->get('payment_process_state')) { ?>
	$('#Payment_status').modal();
	<?php } ?>
</script>

