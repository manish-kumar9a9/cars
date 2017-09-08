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

        <link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/components/imgareaselect/css/imgareaselect-default.css" rel="stylesheet" media="screen">

    <style>
        .imagepreview{
            height:100px;
            width:100px;
        }
        .file_up input{
            max-width:300px;
        }
        #form_user_pickup_owner_error{
            color:#fff;
            background:red;
        }
    </style>
		<?php $this->load->view('include/head_block'); ?>
        <!--header-->
		<?php
		$owner_data = $booking_data['car_owner_data'];
		$renter_data = $booking_data['car_renter_data'];
		$car_details = $booking_data['car_details'];
		?>
 

        <!-- slider starts -->
        <div class="slider">
            <div class="slide_viewer">
                <div class="slide_group">
					<?php
					foreach ($car_details['car_images'] as $cl) {
						?>
						<div class="slide">
							<img src="<?php echo $cl['CarImage_path']; ?>" />
						</div>
						<?php
					}
					?>
                </div>

                <div class="container">
                    <div class="car-center-text">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-center-detail">
                            <div class="col-new-lg-12 col-new-md-12 col-sm-12 col-xs-12 car-name-2 text-center">
				<?php if ($booking_data['transaction_complete'] == 1) { ?>
					<h2><?php echo $this->lang->line('BOOKING_TRANSACTION_COMPLETE');?></h2>
					<h4>&nbsp;</h4>
				<?php } else { ?>
					<?php if ($booking_data['booking_user_type'] == "renter") { ?>
						<h2><?php echo $this->lang->line('YOU_HAVE_TO_RETURN_BACK_CAR');?></h2>
					<?php } ?>
					<?php if ($booking_data['booking_user_type'] == "owner") { ?>
						<h2><?php echo $this->lang->line('YOU_HAVE_TO_GET_BACK_CAR');?></h2>
					<?php } ?>
					<h4><?php echo $this->lang->line('ON');?> <?php echo date("jS \of M Y H:i a", strtotime($booking_data['car_to'])); ?></h4>
				<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="directional_nav">
            <div class="previous_btn" title="Previous">
                <img src="<?php echo base_url(); ?>assets/image/booking_car/left.png" />
            </div>
            <div class="next_btn" title="Next">
                <img src="<?php echo base_url(); ?>assets/image/booking_car/right.png" />
            </div>
        </div>
        <!-- slider ends -->

        <!-- main section starts -->
        <div class="container">
            <div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
                <h1 class="text-center"><?php echo $this->lang->line('CAR_REQUEST');?></h1>
                <div class="underline"></div>
            </div>

            <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
                <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                    <h3><?php echo $this->lang->line('FROM');?></h3>
                    <input readonly="readonly"  type="text" class="car-booking-input" value="<?php echo $booking_data['car_from']; ?>" />
                </div>

                <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                    <h3><?php echo $this->lang->line('TO');?></h3>
                    <input readonly="readonly"  type="text" class="car-booking-input" value="<?php echo $booking_data['car_to']; ?>" />
                </div>

                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">

                    <span class="price-text"><?php echo $this->lang->line('DAILY_PRICE');?></span>
                    <span class="price-number"><i class="fa fa-euro" aria-hidden="true"></i> <?php echo $booking_data['car_daily_price']; ?></span>

                </div>

                <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 address">
                    <h3><?php echo $this->lang->line('PICKUP_ADDRESS');?> <i class="fa fa-map-marker" aria-hidden="true"></i></h3>
                    <input readonly="readonly"  type="text" class="car-booking-input" value="<?php echo $booking_data['pickup_location']; ?>" />
                </div>

                <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 address">
                    <h3><?php echo $this->lang->line('DROPOFF_ADDRESS');?><i class="fa fa-map-marker" aria-hidden="true"></i></h3>
                    <input readonly="readonly"  type="text" class="car-booking-input" value="<?php echo $booking_data['drop_off_location']; ?>" />
                </div>

                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">

                    <span class="price-text"><?php echo $this->lang->line('DELIVERY_CHARGES');?></span>
                    <span class="price-number"><i class="fa fa-euro" aria-hidden="true"></i> <?php echo $car_details['price']; ?></span>

                </div>

                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 trip-detail-section no-padding">

                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
                        <h3><?php echo $this->lang->line('TRIP_DETAILS');?></h3>
                    </div>

                    <div class="col-new-lg-4 col-new-md-4 col-new-sm-12 col-new-xs-12">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding trip-box">
                            <ul class="trip-details-tabs">
                                <li class="text-center"><?php echo $this->lang->line('DAILY');?></li>
                                <li class="text-center green-body"><?php echo $booking_data['car_distance_per_day']; ?>  Km</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-new-lg-4 col-new-md-4 col-new-sm-12 col-new-xs-12">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding trip-box">
                            <ul class="trip-details-tabs">
                                <li class="text-center"><?php echo $this->lang->line('WEEKLY');?></li>
                                <li class="text-center green-body"><?php echo $booking_data['car_distance_per_day'] * 7; ?> Km</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-new-lg-4 col-new-md-4 col-new-sm-12 col-new-xs-12">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding trip-box">
                            <ul class="trip-details-tabs">
                                <li class="text-center"><?php echo $this->lang->line('MONTHLY');?></li>
                                <li class="text-center green-body"><?php echo $booking_data['car_distance_per_day'] * 30; ?> Km</li>
                            </ul>
                        </div>
                    </div>
                </div>
				<?php if ($booking_data['booking_user_type'] == "renter") { ?>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-50">
						<h3><?php echo $this->lang->line('CAR_DESCRIPTION');?></h3>
						<textarea readonly="readonly"  rows=7 class="remarks-textarea"><?php echo $car_details['description']; ?></textarea>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-50">
						<h3><?php echo $this->lang->line('CAR_FEATURES');?></h3>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-features-points">
							<?php
							foreach ($car_details['car_features'] as $cf) {
								echo "<h4>" . $cf['feature_name'] . "</h4>";
							}
							?>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">

						<span class="price-text"><?php echo $this->lang->line('AVAILABLILTY_LAST_UPDATED');?></span>
						<span class="price-number"><?php echo $car_details['last_avail_string'] . " ago"; ?></span>

					</div>
				<?php } ?>

                <!-- owner information  start here -->

                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
                    <h3>Reviews</h3>
					<?php
					if ($booking_data['booking_user_type'] == "owner") {
						$user_tab_data = $renter_data;
						$tab_text =  $this->lang->line('REQUESTED_BY');
					} else {
						$user_tab_data = $owner_data;
						$tab_text = $this->lang->line('OWNED_BY');
					}
					?>
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding review-section">
                        <div class="col-new-lg-9 col-new-md-9 col-new-sm-9 col-new-xs-9">
                            <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 owned-by">
                                <h3><?php echo $tab_text; ?></h3>
                                <h1><?php echo $user_tab_data['firstName'] . ' ' . $user_tab_data['lastName']; ?> </h1>
                            </div>

                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-6 col-new-xs-6 response-section">
                                <h1><?php echo $this->lang->line('RESPONSE_RATE');?>  <span class="green-text"><?php echo round($user_tab_data['response_rate'], 2); ?>%</span></h1>
                            </div>
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-6 col-new-xs-6 response-section">
                                <h1><?php echo $this->lang->line('RESPONSE_TIME');?>  <span class="green-text"><?php echo response_time($user_tab_data['response_time']); ?></span></h1>
                            </div>
                        </div>

                        <div class="col-new-lg-3 col-new-md-3 col-new-sm-3 col-new-xs-3 review-rating-section text-center">
                            <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 review-image">
                                <img src="<?php echo $user_tab_data['user_image']; ?>" />
                            </div>

                            <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
                                <span class="rating">

									<?php genrate_star_html($user_tab_data['user_rating'], ""); ?>
                                </span>
                            </div>

                            <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 rating-number">
                                <h1><?php echo ($user_tab_data['user_rating'] > 0 ) ? $user_tab_data['user_rating'] : ''; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- owner information  end here -->
            </div>

            <div id="action_button_element" class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 button-section">

            </div>
        </div>
        <!-- main section ends -->
		<?php if ($booking_data['booking_user_type'] == "owner") { ?>
			<div class="container hide transaction_form">
				<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
					<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS');?></h1>
					<div class="underline"></div>
				</div>
				<div id="form_user_pickup_owner_error">

				</div>
				<form id="form_owner_pickup_form" enctype="multipart/form-data" method="post">
					<input type="hidden" name="request_id" value="<?php echo $booking_data['id']; ?>">
					<input type="hidden" name="car_owner_id" value="<?php echo $booking_data['car_user_id']; ?>" >
					<input type="hidden" name="car_id" value="<?php echo $booking_data['car_id']; ?>" >
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
							<h3><?php echo $this->lang->line('METER_READING'); ?></h3>
							<input type="text" name="car_meter_reading" class="car-booking-input" value="">
						</div>

					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('DAMAGE_TYPE'); ?> </h3>
							<select name="damage_type" class="">
								<option value="">no-damage </option>
								<option  value="Tyre Damage" >Tyre Damage</option>
								<option  value="Body Damage" >Body Damage </option>
								<option  value="Scratch" >Scratch </option>
							</select>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('RATE_RENTER');?></h3>
							<select name="rating" class="">
								<option  value = "1">1 </option>
								<option  value = "2">2</option>
								<option  value = "3" >3</option>
								<option  value = "4">4</option>
								<option  value = "5" selected >5</option>
							</select>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
							<h3> <?php echo $this->lang->line('REVIEW_RENTER');?></h3>
							<textarea rows="5" name="remarks" class="remarks-textarea"></textarea>
						</div>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">

						<input class="theme-btn theme-btn-green cancel_transaction_button" type="button" name="cancel" value="<?php echo $this->lang->line('CANCEL');?>">
						<input class="theme-btn theme-btn-green" type="submit" name="submit" value="<?php echo $this->lang->line('SAVE');?>">
					</div>

				</form>

			</div>
			<div class="container hide claim_form">
				<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
					<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS');?></h1>
					<div class="underline"></div>
				</div>
				<div id="form_user_claim_owner_error">

				</div>
				<form id="form_owner_claim_form" enctype="multipart/form-data" method="post">
					<input type="hidden" name="booking_id" value="<?php echo $booking_data['id']; ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
							<h3><?php echo $this->lang->line('CAR_CLAIM');?></h3>
							<textarea rows="5" name="claim" class="remarks-textarea"></textarea>
						</div>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
							<div class="file_up margin-bottom ">
								<input name="car_image1" class="file_upper theme-btn theme-btn-basic " type='file' >
								<button class="img_closer theme-btn theme-btn-basic"  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom">
								<input name="car_image2" class="file_upper theme-btn theme-btn-basic " type='file' >
								<button class="img_closer theme-btn theme-btn-basic"  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom">
								<input name="car_image3"  class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic"  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image4" class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image5" class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image6" class="file_upper  theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image7" class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button"><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide ">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image8" class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button"><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview hide ">
							</div>
							<div class="file_up margin-bottom ">
								<input name="car_image9" class="file_upper theme-btn theme-btn-basic" type='file' >
								<button class="img_closer theme-btn theme-btn-basic "  type="button" ><?php echo $this->lang->line('CANCEL');?></button></br>
								<img class="imagepreview">
							</div>

						</div>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">

						<input class="theme-btn theme-btn-green cancel_claim_button" type="button" name="cancel" value="<?php echo $this->lang->line('CANCEL');?>">
						<input class="theme-btn theme-btn-green" type="submit" name="submit" value="<?php echo $this->lang->line('SAVE');?>">
					</div>

				</form>

			</div>
		<?php } ?>
        <!-- Modal -->
		<?php if ($booking_data['booking_user_type'] == "renter") { ?>
			<div class="container hide transaction_form">
				<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
					<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS');?></h1>
					<div class="underline"></div>
				</div>
				<div id="form_user_pickup_owner_error">

				</div>
				<form id="form_owner_pickup_form" enctype="multipart/form-data" method="post">
					<input type="hidden" name="request_id" value="<?php echo $booking_data['id']; ?>">
					<input type="hidden" name="car_renter_id" value="<?php echo $booking_data['car_renter_id']; ?>" >
					<input type="hidden" name="car_id" value="<?php echo $booking_data['car_id']; ?>" >
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">
						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
							<h3><?php echo $this->lang->line('METER_READING'); ?></h3>
							<input type="text" name="car_meter_reading" class="car-booking-input" value="">
						</div>

					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('DAMAGE_TYPE'); ?>  </h3>
							<select name="damage_type" class="">
								<option value="">no-damage </option>
								<option  value="Tyre Damage" >Tyre Damage</option>
								<option  value="Body Damage" >Body Damage </option>
								<option  value="Scratch" >Scratch </option>
							</select>
						</div>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('REPORT'); ?> </h3>
							<textarea rows="5" name="report" class="remarks-textarea"></textarea>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('RATE_CAR'); ?></h3>
							<select name="rating" class="">
								<option  value = "1">1 </option>
								<option  value = "2">2</option>
								<option  value = "3" >3</option>
								<option  value = "4">4</option>
								<option  value = "5" selected >5</option>
							</select>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
							<h3><?php echo $this->lang->line('REVIEW_CAR'); ?></h3>
							<textarea rows="5" name="remarks" class="remarks-textarea"></textarea>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
						<input class="theme-btn theme-btn-green cancel_transaction_button" type="button" name="cancel" value="<?php echo $this->lang->line('CANCEL');?>">
						<input class="theme-btn theme-btn-green" type="submit" name="submit" value="<?php echo $this->lang->line('SAVE');?>">
					</div>
				</form>
			</div>

		<?php } ?>

        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="wait_process" role="dialog">
            <div class="modal-dialog modal-dialog-new">
                <!-- Modal content-->
                <div class="modal-content modal-content-new">

                    <div class="modal-body text-center">
                        <img src="<?php echo base_url(); ?>assets/image/booking_car/wheele-spin.gif" />
                        <p class="verifying"><?php echo $this->lang->line('VERIFYING'); ?>....</p>
                        <p class="waiting-message"><?php echo $this->lang->line('PLEASE_WAIT_FOR_OWNER'); ?></p>
                    </div>
                    <div class="modal-body text-center green-body">

                        <p class="waiting-message1">"<?php echo $this->lang->line('DONTGO_AWAY_UNTILL_OWNER_ACCEPT'); ?>"</p>
                    </div>

                </div>

            </div>
        </div>
		<?php
		if ($this->input->get('rating_state') == 1 && $booking_data['booking_user_type'] == "owner" && $booking_data['transaction_complete'] == 1) {
			?>
			<div class="container ">
				<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
					<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS');?></h1>
					<div class="underline"></div>
				</div>
				<form id="form_give_rating_to_renter" enctype="multipart/form-data" method="post">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">

					</div>
					<input type="hidden" name="car_renter_id" value="<?php echo $booking_data['car_renter_id']; ?>" />
					<input type="hidden" name="car_owner_id" value="<?php echo $booking_data['car_user_id']; ?>" />
					<input type="hidden" name="booking_id" value="<?php echo $booking_data['id']; ?>" />

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('FILL_DETAILS');?> </h3>
							<select name="rating" class="">
								<option  value = "1">1 </option>
								<option  value = "2">2</option>
								<option  value = "3" >3</option>
								<option  value = "4">4</option>
								<option  value = "5" selected >5</option>
							</select>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
							<h3><?php echo $this->lang->line('REVIEW_RENTER');?> </h3>
							<textarea rows="5" name="remarks" class="remarks-textarea"></textarea>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
						<input class="theme-btn theme-btn-green" type="submit" name="submit" value="<?php echo $this->lang->line('SAVE');?>">
					</div>
				</form>
			</div>
		<?php } ?>

		<?php if ($this->input->get('rating_state') == 1 && $booking_data['booking_user_type'] == "renter" && $booking_data['transaction_complete'] == 1 ) { ?>
			<div class="container ">
				<div class="col-new-lg-12 col-new-12 col-new-12 col-new-xs-12 car-request-heading">
					<h1 class="text-center"><?php echo $this->lang->line('FILL_DETAILS');?></h1>
					<div class="underline"></div>
				</div>
				<form id="form_give_rating_to_car" enctype="multipart/form-data" method="post">
					<input type="hidden" name="car_renter_id" value="<?php echo $booking_data['car_renter_id']; ?>" />
					<input type="hidden" name="car_id" value="<?php echo $booking_data['car_id']; ?>" />
					<input type="hidden" name="booking_id" value="<?php echo $booking_data['id']; ?>" />
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-booking-form">

					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
							<h3><?php echo $this->lang->line('RATE_CAR');?> </h3>
							<select name="rating" class="">
								<option  value = "1">1 </option>
								<option  value = "2">2</option>
								<option  value = "3" >3</option>
								<option  value = "4">4</option>
								<option  value = "5" selected >5</option>
							</select>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 car-pricing">
							<h3><?php echo $this->lang->line('REVIEW_CAR');?>  </h3>
							<textarea rows="5" name="remarks" class="remarks-textarea"></textarea>
						</div>
					</div>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 ">
						<input class="theme-btn theme-btn-green" type="submit" name="submit" value="<?php echo $this->lang->line('SAVE');?>">
					</div>
				</form>
			</div>
		<?php } ?>

		<!-- model popup ends -->

		<!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
		<!--/footer-->



		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
		<!-- Modal popup script starts -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- Modal popyp script ends -->


		<!-- slider script starts  -->
		<script src="<?php echo base_url(); ?>assets/js/booking_element_slider.js"></script>
		<!-- slider script ends -->


		<script>
            $(document).ready(function () {
                $('.cancel_transaction_button').click(function () {
                    $('.container').show('slow');
                    $('.transaction_form').hide('fast');
                    $('.claim_form').hide('fast');
                });
            });

            $('body').on('click', '.fill_form_element', function () {
                $('.transaction_form').show();
                $('.container').hide();
                $('.transaction_form').show();
                $(window).scrollTop($('.transaction_form').offset().top - 69);

            });

            $('body').on('click', '.claim_form_element', function () {
                $('.container').hide();
                $('.claim_form').show();
                $(window).scrollTop($('.claim_form').offset().top - 69);

            });

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
                $('.cancel_claim_button').click(function () {
                    $('.container').show('slow');
                    $('.transaction_form').hide('fast');
                    $('.claim_form').hide('fast');
                });
            });

<?php if ($booking_data['transaction_complete'] != 1) { ?>

	            function sync_page() {
	                jQuery.ajax({
	                    url: '<?php echo site_url('booking_auth/sync_page_dropoff/'); ?>',
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
<?php } ?>

<?php
/* show owner waiting spinner */
if ($booking_data['booking_user_type'] == "owner") {
	?>
	            $(document).ready(function (e) {
	                $('#form_owner_pickup_form').on('submit', (function (e) {
	                    e.preventDefault();
	                    $('#form_user_pickup_owner_error').html('');
	                    $.ajax({
	                        url: '<?php echo base_url(); ?>index.php/service_return_initialize_car_info_by_owner',
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
	                        url: '<?php echo base_url(); ?>index.php/service_return_initialize_car_info_by_renter',
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
if ($booking_data['forms_towards_owner']['renter'] != '' && $booking_data['booking_user_type'] == "renter" && $booking_data['transaction_complete'] == 0) {
	?>
	            $('#wait_process').modal('show');

	            function renter_waiting() {
	                jQuery.ajax({
	                    url: '<?php echo site_url('booking_auth/renter_waiting_for_dropoff/'); ?>',
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

	            renter_waiting();

	            setInterval(function () {
	                renter_waiting();
	            }, 10000);

	<?php
}
?>
            $(document).ready(function (e) {
                $('#form_owner_claim_form').on('submit', (function (e) {
                    e.preventDefault();
                    $('#form_owner_claim_form_error').html('');
                    $.ajax({
                        url: '<?php echo base_url(); ?>index.php/service_return_claim_for_car',
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
                                $('#form_owner_claim_form_error').html(data.message);
                            }
                        }
                    });
                }));
            });

            $(document).ready(function (e) {
                $('#form_give_rating_to_renter').on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo site_url('service_give_rate_to_user'); ?>',
                        type: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data.isSuccess) {
                                window.location.href = "<?php echo site_url('booking_auth/booking/' . $booking_data['id']); ?>";
                            } else {

                            }
                        }
                    });
                }));
            });

            $(document).ready(function (e) {
                $('#form_give_rating_to_car').on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo site_url('service_give_rate_to_car'); ?>',
                        type: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data.isSuccess) {
                                window.location.href = "<?php echo site_url('booking_auth/booking/' . $booking_data['id']); ?>";
                            } else {

                            }
                        }
                    });
                }));
            });
			
        </script>
    </body>

</html>
