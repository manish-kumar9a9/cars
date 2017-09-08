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
		<link href="<?php echo base_url(); ?>assets/css/skdslider.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/components/imgareaselect/css/imgareaselect-default.css" rel="stylesheet" media="screen">

		<?php $this->load->view('include/head_block'); ?>
	<div class="view-car">
		<div class="banner">

			<ul id="demo1">
				<?php foreach ($car_data['car_images'] as $ci) { ?>

					<li> <img src="<?php echo $ci['CarImage_path']; ?>" /></li>
				<?php }
				?>

			</ul>
		</div>
		<div class="clr"></div>
		<div class="abt-owner">
			<?php
			$user_image = base_url() . "assets/image/Icon-user-1.png";
			if ($car_data['get_user_image'] != "") {
				$user_image = $car_data['get_user_image'];
			}
			?>
			<div class="abt-left"><img src="<?php echo $user_image; ?>" ></div>
			<div class="abt-center">
				<h4><?php echo current(explode(' ', $car_data['get_username'])); ?> </br><span><?php echo $this->lang->line('MEMBER_SINCE'); ?> <?php echo date('M Y ', strtotime($user_data['createdAt'])); ?></span></h4><div class="clr"></div>
				<span class="">
					<?php genrate_star_html($car_data['car_rating'], "fa-fw fa-lg"); ?>
				</span>
				<div class="clr"></div><p><?php echo $car_data['total_car_trips'] ?> Rentals - 5 Reviews</p>
			</div>
			<div class="abt-right"><h2><?php echo $car_data['get_make_name'] . ' ' . $car_data['get_model_name']; ?><br><span><?php echo $car_data['get_fuel_type_name'] . '  , Transmission ' . $car_data['get_transmission_name']; ?></span></h2></div>
		</div>
		<div class="clr"></div>
		<div class="viewcar-inner">

			<div class="listcar-details">
				<div class="clr"></div>
				<div class="margin-top-20 ">
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
						<button class="padding-10 facebook-button text-white cursor"><i class="fa fa-facebook"></i> Share with facebook
						</button></a>
					<a href="https://plus.google.com/share?url=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
						<button class="padding-10 google-button text-white cursor " >	<i class="fa fa-google"></i> Share with Google
						</button></a>
					<a href="https://twitter.com/share?url=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
						<button class="padding-10 twitter-button text-white cursor" >	<i class="fa fa-twitter"></i> Share with twitter</button>
					</a>
				</div>
			</div>

			<div class="listcar-details">
				<h2><?php echo $this->lang->line('CAR_DESCRIPTION'); ?></h2>
				<div class="clr"></div>
				<div class="txt"><?php echo $car_data['description']; ?></div>
			</div>

			<div class="clr"></div>
			<div class="view-left">

				<div class="clr"></div>
				<div class="description">
					<h2><?php echo $this->lang->line('SPECIFICATIONS'); ?></h2>
					<div class="clr"></div>
					<div class="padding-10 normal-div width-90">
						<div class="width-40 float-left">
							<div class="normal-div width-100 bg-color1">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('TRANSMISSION'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['get_transmission_name']; ?></p>
							</div>
							<div class="normal-div width-100">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('FUEL_TYPE'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['get_fuel_type_name']; ?></p>
							</div>
							<div class="normal-div width-100 bg-color1">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('YEAR'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['car_brought_year']; ?></p>
							</div>
							<div class="normal-div width-100">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('SEATS'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['seat']; ?></p>
							</div>
						</div>
						<div class="width-40 float-right">
							<div class="normal-div width-100 bg-color1">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('DOORS'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['doors']; ?></p>
							</div>
							<div class="normal-div width-100">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('TYPE'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['get_type_name']; ?></p>
							</div>
							<div class="normal-div width-100 bg-color1">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('CUBIC_CAPACITY'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['cubicCapacity']; ?></p>
							</div>
							<div class="normal-div width-100">
								<p class="float-left margin-5-0 padding ralewaysemibold"><?php echo $this->lang->line('MILEAGE'); ?></p>
								<p class="float-right margin-5-0 padding ralewaysemibold"><?php echo $car_data['mileage']; ?></p>
							</div>
						</div>
					</div>
				</div>


				<div class="description">
					<h2><?php echo $this->lang->line('FEATURES'); ?></h2>
					<div class="clr"></div>
					<ul>
						<?php foreach ($car_data['car_features'] as $ci) { 
							if( $this->input->cookie('lang') == "greek"){ 
								$keyname =  "feature_name_greek";
								
							}else{ 
								$keyname =  "feature_name";
							}
							?>
							<li class="col-new-md-6" > <?php echo $ci[$keyname]; ?></li>
						<?php } 
						
						?>
					</ul>
				</div>
				<div class="description">
					<h2 class="float-left line-height-15"><?php echo $this->lang->line('DISTANCE_INCLUDED'); ?> </h2>
					<div class="clr"></div>
					<div class="width-30 float-left"><p><?php echo $car_data['kmOrMilesValue']; ?> km/day</p></div>
					<div class="width-30 float-left"><p><?php echo $car_data['kmOrMilesValue'] * 7; ?> km/week</p></div>
					<div class="width-30 float-left"><p><?php echo $car_data['kmOrMilesValue'] * 30; ?> km/month</p></div>

				</div>
				<div class="description">
					<h2 class="float-left line-height-15"><?php echo $this->lang->line('LOCATION'); ?></h2>
					<div class="clr"></div>
					<div class="clr"></div>
					<div id="google-map" class="google-map margin-top-10" style="height: 250px;"></div><!-- #google-map -->

				</div>

				<div class="description">
					<h2 class="float-left "><?php echo $this->lang->line('AVAILABLITY'); ?></h2>
					<div class="clr"></div>
					<style>

						.calender-element  td {
							font-size: 14px;
							height: 50px;
							text-align: center;
							width: 50px;
							color:#454545;

						}
						.calender-element th {
							font-size: 14px;
							height: 50px;
							color: #4a4a4a;
							border-bottom: 1px solid #454545;
						}
						.prev_sign a, .next_sign a {
							color: #ffffff;
							text-decoration: none;
						}
						.week_name td{
							color:#08ae9e;
						}

						.highlight {
							background-color: #08ae9e ;
							color: #ffffff;
							height: 27px;
							padding-bottom: 7px;
							padding-top: 13px;
						}

						.highlight1 {
							background-color: red ;
							color: #ffffff;
							height: 27px;
							padding-bottom: 7px;
							padding-top: 13px;
						}

						.calender-element {
							float: left;
							margin: 0 20px;

						}
						.hide ,.next_sign {

							display: none;

						}
					</style>

					<?php
					$cond = $car_data['availablity'];
					// echo $cond;
					$option = array(
						'is_json' => false,
						'url' => site_url() . '/service_get_car_unavail_day',
						'data' => json_encode(array('car_id' => $car_data['id']))
					);

					$result = get_data_with_curl($option);
					$Unavailiabledate = $result['Result'];

					/*					 * *********1 for everyday********************** */


					if ($cond == 1) {
						$a = 'list';
						$StartMonth = number_format(date('m'));
						$EndMonth = date('m') + 5; // show next 5 calender
						for ($num = $StartMonth; $num <= $EndMonth; $num++) {
							if ($num <= 12) {
								$month = $num;
								$listno = $num;
								$year = date('Y');
							} else {
								$listno = $num - 12;
								$month = $num - 12;
								$year = date('Y') + 1;
							}
							for ($d = 1; $d <= 31; $d++) {
								$time = mktime(12, 0, 0, $month, $d, $year);
								if (date('m', $time) == $month) {
									//fetch all day in month for unavailable date
									${$a . $listno}[number_format(date('d', $time))] = date('Y-m-d', $time);
									$result = array_intersect(${$a . $listno}, $Unavailiabledate);
									/*									 * ***End************ */
									//FOR available date
									${$a . $listno}[number_format(date('d', $time))] = 'highlight';
									/*									 * ***************End********** */
								}

								//for unavailable date
								foreach ($result as $key => $revalue) {
									${$a . $listno}[$key] = 'highlight1';
								}
								/*								 * ***End************ */
							}
						}
					}


					/*					 * *******************2 weekend******** */
					if ($cond == 2) {
						$a = 'list';
						$StartMonth = number_format(date('m'));
						$EndMonth = date('m') + 5; // show next 5 calender
						for ($num = $StartMonth; $num <= $EndMonth; $num++) {
							if ($num <= 12) {
								$month = $num;
								$listno = $num;
								$year = date('Y');
							} else {
								$listno = $num - 12;
								$month = $num - 12;
								$year = date('Y') + 1;
							}

							for ($d = 1; $d <= 31; $d++) {
								$time = mktime(12, 0, 0, $month, $d, $year);
								if (date('m', $time) == $month) {
									//fetch all day in month for unavailable date
									${$a . $listno}[number_format(date('d', $time))] = date('Y-m-d', $time);
									$result = array_intersect(${$a . $listno}, $Unavailiabledate);
									/*									 * ***End************ */
									if (date('D', $time) == 'Sat' || date('D', $time) == 'Sun') {
										${$a . $listno}[number_format(date('d', $time))] = 'highlight';
									}
									//for unavailable date
									foreach ($result as $key => $revalue) {
										${$a . $listno}[$key] = 'highlight1';
									}
									/*									 * ***End************ */
								}
							}
						}
					}

					/*					 * ****************************3 weekday ******************** */

					if ($cond == 3) {

						//pre($Unavailiabledate);
						$a = 'list';
						$StartMonth = number_format(date('m'));
						$EndMonth = date('m') + 5; // show next 5 calender
						for ($num = $StartMonth; $num <= $EndMonth; $num++) {
							if ($num <= 12) {
								$month = $num;
								$listno = $num;
								$year = date('Y');
							} else {
								$listno = $num - 12;
								$month = $num - 12;
								$year = date('Y') + 1;
							}

							for ($d = 1; $d <= 31; $d++) {
								$time = mktime(12, 0, 0, $month, $d, $year);

								if (date('m', $time) == $month && date('Y', $time) == $year) {
									//fetch all day in month for unavailable date
									${$a . $listno}[number_format(date('d', $time))] = date('Y-m-d', $time);
									$result = array_intersect(${$a . $listno}, $Unavailiabledate);
									/*									 * ***End************ */
									//for weekday show
									if (date('D', $time) != 'Sat' && date('D', $time) != 'Sun') {
										${$a . $listno}[number_format(date('d', $time))] = 'highlight';
									}
									/*									 * ***End************ */
									//for unavailable date
									foreach ($result as $key => $revalue) {
										${$a . $listno}[$key] = 'highlight1';
									}
									/*									 * ***End************ */
								}
							}
						}
					}
					/*					 * ****************************** 4 manually ******************* */
					if ($cond != 1 && $cond != 2 && $cond != 3) {

						$avl = trim($cond, ",");
						//print_r($availiabledate1);
						$availiabledate = explode(',', $avl);
						$a = 'list';
						$StartMonth = number_format(date('m'));
						$EndMonth = date('m') + 5; // show next 5 calender
						for ($num = $StartMonth; $num <= $EndMonth; $num++) {
							if ($num <= 12) {
								$month = $num;
								$listno = $num;
								$year = date('Y');
							} else {
								$listno = $num - 12;
								$month = $num - 12;
								$year = date('Y') + 1;
							}
							for ($d = 1; $d <= 31; $d++) {
								$time = mktime(12, 0, 0, $month, $d, $year);
								if (date('m', $time) == $month)
									${$a . $listno}[number_format(date('d', $time))] = date('Y-m-d', $time);
							}

							$result = array_intersect(${$a . $listno}, $availiabledate);
							$Unavailresult = array_intersect(${$a . $listno}, $Unavailiabledate);
							//for available date
							foreach ($result as $key => $revalue) {
								${$a . $listno}[$key] = 'highlight';
							}
							/*							 * ********************End********* */
							//for unavailable date
							foreach ($Unavailresult as $key => $revalue) {
								${$a . $listno}[$key] = 'highlight1';
							}
							/*							 * **********End********** */
						}
					}
					?>

					<div>
						<div class="avail">
							<div  class="margin-right" style="float:left;width:20px;height:20px;background:#08ae9e"></div>
							<div style="float:left;"><?php echo $this->lang->line('AVAILABLE'); ?></div>
						</div>
						<div class="unavail">
							<div  class="margin-right margin-left" style="float:left;width:20px;height:20px;background:red"></div>
							<div style="float:left;"><?php echo $this->lang->line('UNAVAILABLE'); ?></div>
						</div>
						<div class="avail-right-side" style="float: right;">
							<span><?php echo $this->lang->line('AVAILABLILTY_LAST_UPDATED'); ?> : <?php echo get_last_availability_time_interval($car_data['availablity_modified']) . " ago"; ?> </span>
						</div>
					</div>
					<div class="clr margin-top" style="float: right;">
						<button class="calender-nav calender-prevs fa fa-arrow-left theme-btn-basic text-white ralewaymedium no-border padding " data-nav-active="1" ></button>
						<button class="calender-nav calender-next fa fa-arrow-right theme-btn-basic text-white ralewaymedium no-border padding " data-nav-active="2"></button>
					</div>

					<div class="clr" >

						<?php
						$count = 1;
						for ($i = 1; $i <= 5; $i++) {// show next 5 calender
							if ($i == 1) {
								$curMonth = date('m');
								$curYear = date('Y');
							} else {
								$curMonth = $curMonth + 1;
								if ($curMonth > 12) {
									$curMonth = 01;
									$curYear = date('Y') + 1;
								}
							}
							?>

							<div class="calender-element <?php
							if ($count > 2) {
								echo " hide ";
							}
							?> calender_element<?php echo $count; ?>"  >

								<?php
								$ls_ref = "list" . intval($curMonth);
								echo $this->calendar->generate($curYear, $curMonth, $$ls_ref);
								?>

							</div>

							<?php
							$count++;
						}
						?>

					</div>
				</div>


				<div class="clr"></div>

				<?php
				$option = array(
					'is_json' => false,
					'url' => site_url() . '/service_get_reviews_car',
					'data' => $params = array('car_id' => $car_data['id'])
				);

				$result = get_data_with_curl($option);
				if (count($result['Result']) > 0) {
					?>
					<div class="review">
						<h2><?php echo $this->lang->line('REVIEWS');?></h2>
						<div class="clr"></div>
						<h4><?php echo round($car_data['car_rating'], 2); ?><span><?php echo $car_data['total_car_trips']; ?> <?php echo $this->lang->line('TRIPS');?></span></h4>
						<div class="clr"></div>
						<span class="">
							<?php genrate_star_html($car_data['car_rating'], "fa-fw fa-lg"); ?>
						</span>
						<div class="clr"></div>
						<?php
						foreach ($result['Result'] as $car_review) {
							?>
							<div class="review-box">
								<div class="box-left"><img src="<?php echo $car_review['givenby_user_image'] ?>" ><br> <p><?php echo $car_review['givenby_username'] ?></p></div>
								<div class="box-right">
									<p><?php echo $car_review['remarks'] ?></p>
								</div>
								<div class="clr"></div>
								<h6 class="date">- <?php echo date('d M Y', strtotime($car_review['date'])); ?></h6>
							</div>
							<div class="clr"></div>
							<?php
						}
						?>
					</div>

					<?php
				}
				?>


				<div class="clr"></div>
			</div>
			<div class="view-right">
				<form action="<?php echo site_url('user/user_identity_verification') ?>" method="get">
					<h2>&euro;<?php echo $car_data['price_daily'] ?> <?php echo $this->lang->line('PER_DAY'); ?></h2>
					<h3 class="center"><?php echo $this->lang->line('WEEKLY_DISCOUNT'); ?> <?php echo round($car_data['discount_weekly']); ?>%<br>
						<?php echo $this->lang->line('MONTHLY_DISCOUNT'); ?> <?php echo round($car_data['discount_monthly']); ?>%</h3>
					<div class="form">
						<input type="hidden" name='car_id' value="<?php echo $car_data['id'] ?>">
						<div class="form-box">
							<label><?php echo $this->lang->line('FROM'); ?></label>
							<input type="text" readonly name="car_from" value="<?php echo$this->input->get('car_from'); ?>">
						</div>
						<div class="clr"></div>
						<div class="form-box">
							<label><?php echo $this->lang->line('TO'); ?></label>
							<input type="text" readonly  name="car_to" value="<?php echo$this->input->get('car_to'); ?>">
						</div>
						<div class="clr"></div>
						<div class="form-box">
							<label><?php echo $this->lang->line('DROP_OFF_LOCATION'); ?></label>
							<input type="text" disabled value="<?php echo $car_data['carDropOffLocation']; ?>">
						</div>
						<div class="clr"></div>
						<div class="form-box">
							<label><?php echo $this->lang->line('PICK_UP_LOCATION'); ?></label>
							<input type="text" disabled  value="<?php echo $car_data['carPickUpLocation']; ?>">
						</div>
						<div class="clr"></div>
						<div class="form-box">
							<label><?php echo $this->lang->line('DELIVERY'); ?> </label>
							<input type="text" disabled  value="<?php echo $car_data['price']; ?>">
						</div>
						<div class="clr"></div>
						<?php
						$button = false;
						if ($this->session->userdata('userId') == "") {
							//echo current_full_url();
							?>
							<div class="link margin-bottom-15">
								<a href="<?php echo site_url('user/pass_login') . "?url=" . urlencode(current_full_url()); ?>"><input  class="theme-btn-basic" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></a>

							</div>
							<?php
						} elseif ($this->session->userdata('userId') != "") {

							if (count($user_account_info) == 0 || $user_account_info['card_id'] == "") {
								$button = true;
								?>
								<a data-toggle="modal" data-target="#wait_process" href="#">
									<div class="link margin-bottom-15"><input  class="theme-btn-basic" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></div>
								</a>
								<?php
							}
							$option = array(
								'is_json' => false,
								'url' => site_url() . '/service_get_user_document_info',
								'data' => $params = array('user_id' => $this->session->userdata('userId'))
							);

							$result = get_data_with_curl($option);
							$data['user_document'] = $result['Result'];

							if (count($data['user_document'] > 0) && array_key_exists('state', $data['user_document']) && $data['user_document']['state'] == 0) {
								$button = true;
								?>
								<a data-toggle="modal" data-target="#verification_pending" href="#">
									<div class="link margin-bottom-15"><input  class="theme-btn-basic" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></div>
								</a>
								<?php
							}


							/* check car user transmission state */
							$option = array(
								'is_json' => false,
								'url' => site_url() . '/service_fetch_user_primary_record',
								'data' => json_encode(array('user_id' => $this->session->userdata('userId')))
							);

							$result = get_data_with_curl($option);
							$user_transmission_state = $result['Result']['transmission_state'];

							if ($car_data['Transmission'] != $user_transmission_state && $button == false && $user_transmission_state != 1) {
								if ($user_transmission_state == 3 && $car_data['Transmission'] == 1) {
									$button = true;
									?>
									<a data-toggle="modal" data-target="#transmission_process" href="#">
										<div class="link margin-bottom-15"><input  class="theme-btn-basic" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></div>
									</a>
									<?php
								} elseif ($user_transmission_state == 2 && $car_data['Transmission'] != 2) {
									$button = true;
									?>
									<a data-toggle="modal" data-target="#transmission_process" href="#">
										<div class="link margin-bottom-15"><input  class="theme-btn-basic" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></div>
									</a>
									<?php
								}
							}
						}
						if ($button == false && $this->session->userdata('userId') != "") {
							?>
							<div class="link margin-bottom-15"><input  class="theme-btn-basic" type='submit' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>"></div>
							<?php
						}
						?>
						<div class="clr"></div>
					</div>
				</form>
				<div class="clr"></div>
				<div class="bg-white width-100 center">
					<?php
					if ($this->session->userdata('userId') != "") {
						?>
						<?php if (!$is_user_fav_car) { ?>
							<a href="<?php echo site_url('user/user_favourite') ?>?car_id=<?php echo $car_data['id']; ?>&status=1" class="width-100 margin-top-15 padding-10-0 theme-btn-basic text-white ralewaymedium">Add to favourite <i class="fa fa-fw fa-lg fa-heart-o"></i> </a>
						<?php } else { ?>
							<a href="<?php echo site_url('user/user_favourite') ?>?car_id=<?php echo $car_data['id']; ?>&status=0" class="width-100 margin-top-15 padding-10-0 theme-btn-basic text-white ralewaymedium">Remove from  favourite <i class="fa fa-fw fa-lg fa-heart-o"></i> </a>
						<?php } ?>

						<a class="width-100 margin-top-15 padding-10-0 theme-btn-basic text-white ralewaymedium" target="_blank"
						   href="<?php echo site_url('user/report_car/' . $car_data['id']); ?>"
						   >Report this listing <i class="fa fa-fw fa-lg fa-list"></i></a>
						   <?php
					   }
					   ?>


				</div>
			</div>
		</div>

	</div>
	<!--footers-->
	<?php $this->load->view('include/footer_block'); ?>
	<!--/footer-->


	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	<?php /* to open header drop down */ ?>
	<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/skdslider.min.js"></script>

	<!-- Modal popup script starts -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Modal popyp script ends -->

	<script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#demo1').skdslider({'delay': 3500, 'animationSpeed': 3500, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading'});


            jQuery('#responsive').change(function () {
                $('#responsive_wrapper').width(jQuery(this).val());
            });

        });
	</script>

	<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&callback=initMap&language=en">
	</script>
	<script>

        function initMap() {
            var myLatLng = {lat: <?php echo $car_data['carPickUpLat']; ?>, lng:<?php echo $car_data['carPickUpLon']; ?>};
            var is_touch_device = 'ontouchstart' in document.documentElement;
            var map = new google.maps.Map(document.getElementById('google-map'), {
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
        }
	</script>

	<script>
        $(document).ready(function () {
            $(".calender-next").click(function () {
                last_active = $(this).data('nav-active');
                if (last_active != 5) {
                    $('.calender-element').hide();
                    $('.calender_element' + last_active).show();
                    $('.calender_element' + (last_active + 1)).show('slow');

                    $(this).data('nav-active', (last_active + 1));
                    $('.calender-prevs').data('nav-active', (last_active));
                }
            });

            $(".calender-prevs").click(function () {
                last_active = $(this).data('nav-active');
                if (last_active != 1) {

                    $('.calender-element').hide();
                    $('.calender_element' + last_active).show();
                    $('.calender_element' + (last_active - 1)).show('slow');

                    $('.calender-next').data('nav-active', (last_active));
                    $(this).data('nav-active', (last_active - 1));
                }

            });
        });
	</script>

	<div class="modal fade"  id="wait_process" role="dialog">
		<div class="modal-dialog modal-dialog-new">

			<!-- Modal content-->
			<div class="modal-content modal-content-new">

				<div class="modal-body text-center">
					<i class="fa fa-warning fa-4x"></i>
					<p class="waiting-message"><?php echo $this->lang->line('CARD_INFO_REQUIRED'); ?></p>
				</div>
				<div class="modal-body text-center green-body">

					<p class="waiting-message1"><a href="<?php echo site_url('user/secure_redirector'); ?>?url=<?php echo site_url('account_information/add_card'); ?>&redirect_identifier=add_card&redirect_url=<?php echo current_full_url(); ?>">Click here to add card detail(s).</a></p>
				</div>

			</div>
		</div>
	</div>


	<div class="modal fade"  id="transmission_process" role="dialog">
		<div class="modal-dialog modal-dialog-new">

			<!-- Modal content-->
			<div class="modal-content modal-content-new">

				<div class="modal-body text-center">
					<i class="fa fa-warning fa-4x"></i>
					<p class="waiting-message"><?php echo $this->lang->line('TRANSMISSION_IS_NOT_SUITABLE'); ?></p>
				</div>

			</div>
		</div>
	</div>		

	<div class="modal fade"  id="verification_pending" role="dialog">
		<div class="modal-dialog modal-dialog-new">

			<!-- Modal content-->
			<div class="modal-content modal-content-new">

				<div class="modal-body text-center">
					<i class="fa fa-warning fa-4x"></i>
					<p class="waiting-message"><?php echo $this->lang->line('DOCUMENT_PENDING_FOR_APPROVAL'); ?></p>
				</div>

			</div>
		</div>
	</div>
</body>
</html>
