
<?php $this->load->view('header'); ?>

<div class="view-car" xmlns="http://www.w3.org/1999/html">

		<div class="banner">
			<ul id="demo1">
				<?php foreach ($car_data['car_images'] as $ci) { ?>
					
					<li> <img src="<?php echo $ci['CarImage_path']; ?>" /></li>
				<?php }
				?>

			</ul>
		</div>

		<div class="clr"></div>
		<div class="carmenu">
			<div class="inner">
				<div class="carmenuitems">
					<div class="active"><a href="#overview"><?php echo $this->lang->line('OVERVIEW');?></a></div>
					<div class=""><a href="#availability"><?php echo $this->lang->line('AVAILABLITY');?></a></div>
					<div class=" "><a href="#owner"><?php echo $this->lang->line('OWNER');?></a></div>
					<div class=""><a href="#reviews"><?php echo $this->lang->line('REVIEWS');?></a></div>
					<div class="" data-toggle="modal" data-target="#carphotosmodal"><?php echo $this->lang->line('PHOTOS')."(".count($car_data['car_images']).")";?></div>
				</div>
			</div>
		</div>

		<div class="clr"></div>
		<div id="overview-panel">
			<div class="inner">
				<div class="container">
				<div class="row">

				<div class="col-md-8 margin-bottom-50">
					<div id="overview" class="about-owner">
						<?php
						//var_dump($car_data);
						$user_image = base_url() . "assets/image/Icon-user-1.png";
						if ($car_data['get_user_image'] != "") {
							$user_image = $car_data['get_user_image'];
						}
						?>
						<div class="row">
							<div class="col-sm-9">
								<h1><?php echo $car_data['get_make_name'] . ' ' . $car_data['get_model_name']; ?></h1>
								<span class="">
									<?php genrate_star_html($car_data['car_rating'], "fa-fw fa-lg"); ?>
									<?php echo '<span style="color: initial">'.round($car_data['car_rating'], 2).'</span>'; ?>(<?php echo $car_data['total_car_trips'] ?>)
								</span>

								<div class="col-md-12 no-padding">
									<img src="<?php echo base_url(); ?>assets/image/Mapicon.png"/>
									<?php echo $car_data['carPickUpLocation']; ?>
								</div>

							</div>
							<div class="col-sm-3 pull-right text-right no-padding">
								<div class="col-sm-6 col-md-7 pull-right ">
									<img class="profile-pic" src="<?php echo $user_image; ?>" >
								</div>
								<div class="col-sm-3 col-md-4 pull-right margin-top-20">
									<span style="color: initial"><?php echo $this->lang->line('OWNER');?> </span><br/>
									<?php echo current(explode(' ', $car_data['get_username'])); ?>
								</div>
							</div>
						</div>
					</div>

					<div class="about-features">
						<div class="row">
							<div class="feature col-xs-4 col-md-2 center no-padding">
								<img src="<?php echo base_url(); ?>assets/image/dooricon.png"/>
								<div class="col-xs-12 margin-top-10">
									<div class="col-xs-12">
										<?php echo $this->lang->line('DOORS');?>
									</div>
									<div class="col-xs-12 margin-top">
										<strong><?php echo current(explode(' ', $car_data['doors'])); ?></strong>
									</div>
								</div>
							</div>
							<div class="feature col-xs-4 col-md-2 center no-padding">
								<img src="<?php echo base_url(); ?>assets/image/seatsicon.png"/>
								<div class="col-xs-12 margin-top-10">
										<div class="col-xs-12">
											<?php echo $this->lang->line('SEATS');?>
										</div>
									<div class="col-xs-12 margin-top">
										<strong><?php echo current(explode(' ', $car_data['seat'])); ?></strong>
									</div>
								</div>
							</div>
							<div class="feature col-xs-4 col-md-2 center no-padding">
								<img src="<?php echo base_url(); ?>assets/image/transmissionicon.png"/>
								<div class="col-xs-12 margin-top-10">
									<div class="col-xs-12 no-padding">
										<?php echo $this->lang->line('TRANSMISSION');?>
									</div>
									<div class="col-xs-12 no-padding margin-top">
										<strong><?php echo $car_data['get_transmission_name']; ?></strong>
									</div>
								</div>
							</div>
							<div class="feature col-xs-4 col-md-2 center no-padding">
								<img src="<?php echo base_url(); ?>assets/image/distanceicon.png"/>
								<div class="col-xs-12 margin-top-10">
									<div class="col-xs-12 no-padding">
										<?php echo $this->lang->line('DISTANCE_PER_DAY');?>
									</div>
									<div class="col-xs-12 no-padding margin-top">
										<strong><?php echo current(explode(' ', $car_data['kmOrMilesValue'])); ?></strong>
									</div>
								</div>
							</div>
							<div class="feature col-xs-4 col-md-2 center no-padding display-none">
								<img src="<?php echo base_url(); ?>assets/image/drivetrainicon.png"/>
								<div class="col-xs-12 margin-top-10">
									<div class="col-xs-12 no-padding">
										<?php echo $this->lang->line('DRIVETRAIN');?>
									</div>
									<div class="col-xs-12 no-padding margin-top">
										<strong><?php echo "N/A" ?></strong>
									</div>
								</div>
							</div>
							<div class="feature col-xs-4 col-md-2 center no-padding">
								<img src="<?php echo base_url(); ?>assets/image/fuelicon.png"/>
								<div class="col-xs-12 margin-top-10">
									<div class="col-xs-12 no-padding">
										<?php echo $this->lang->line('FUEL');?>
									</div>
									<div class="col-xs-12 no-padding margin-top">
										<strong><?php echo current(explode(' ', $car_data['get_fuel_type_name'])); ?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="clr"></div>
					<div class="row margin-top-50">
						<div class="col-xs-12">
							<h3><?php echo $this->lang->line('DESCRIPTION'); ?></h3>
							<div class="clr"></div>
							<div class="txt"><?php echo $car_data['description']; ?></div>
						</div>
					</div>

					<div class="clr"></div>
					<div class="row margin-top-50">
						<div class="col-md-12">
							<h3><?php echo $this->lang->line('SPECIFICATIONS'); ?></h3>
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
					<div class="row margin-top-50">
						<div class="col-md-12">
							<h3><?php echo $this->lang->line('EXTRAS'); ?></h3>
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

					<div class="clr"></div>
					<div id="availability" class="row margin-bottom-50" style="padding-top: 130px;margin-top: -40px;">
						<div class="col-md-12">
							<div class="col-xs-8 col-sm-10">
								<h3><?php echo $this->lang->line('AVAILABILITY'); ?></h3>
							</div>
							<div class="col-xs-4 col-sm-2 margin-top-20 text-right no-padding">
								<div class="col-xs-1 col-sm-3 no-padding " style="width:20px;height:20px;background:#9f9f9f"></div>
								<div class="col-xs-9 col-sm-9 margin-top"><?php echo $this->lang->line('UNAVAILABLE'); ?></div>
							</div>

							<?php
							$cond = $car_data['availablity'];
							//var_dump($cond);
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
							<div class="clr"></div>
							<div class="calendar_wrapper col-xs-12" >
								<button style="left: 15px;" class="calender-nav calender-prevs fa fa-arrow-left no-border padding " data-nav-active="1" ></button>
								<button style="right: 15px;" class="calender-nav calender-next fa fa-arrow-right no-border padding " data-nav-active="2"></button>

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

									<div class="col-sm-6 calender-element <?php
									if ($count > 2) {
										echo " collapse ";
									}
									?> calender_element<?php echo $count; ?>" >

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
					</div>

					<div class="clr"></div>
					<div id="owner" class="row" style="padding-top: 70px;margin-top: -60px;">
						<div class="col-xs-12">
							<h3><?php echo $this->lang->line('VEHICLE_OWNER'); ?></h3>
							<div class="col-xs-12 ownerdata">
								<div class="row">
									<div class="col-xs-12 col-sm-10">
										<h3><?php echo current(explode(' ', $car_data['get_username'])); ?></h3>
										<span class="joined"><?php echo $this->lang->line('JOINED_IN'); ?> <?php echo date('M Y ', strtotime($user_data['createdAt'])); ?></span>
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

					<div class="clr"></div>
					<div class="row" style="padding-top: 90px;margin-top: -40px;">
						<div class="col-md-12">
							<h3><?php echo $this->lang->line('LOCATION'); ?></h3>
							<div class="clr"></div>
							<div id="google-map" class="google-map margin-top-10" style="height: 250px;"></div><!-- #google-map -->
						</div>
					</div>

					<?php
					$option = array(
						'is_json' => false,
						'url' => site_url() . '/service_get_reviews_car',
						'data' => $params = array('car_id' => $car_data['id'])
					);
					$result = get_data_with_curl($option);
					if (count($result['Result']) > 0) { ?>
						<div class="clr"></div>
						<div id="reviews" class="row margin-bottom-50" style="padding-top: 90px;margin-top: -40px;">
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-3">
										<h3 class="no-margin"><?php echo $this->lang->line('REVIEWS'); ?></h3>
									</div>
									<div class="col-sm-9 text-right">
										<h4 class="no-margin">
											<?php echo $car_data['total_car_trips']; ?> <?php echo $this->lang->line('RATINGS');?>
											<span style="font-size: 13px;"><?php genrate_star_html($car_data['car_rating'], "fa-fw fa-lg"); ?></span>
											<span style="color: initial"><?php echo round($car_data['car_rating'], 2); ?></span>
										</h4>
									</div>
								</div>

								<div class="reviews margin-top-10">
									<div class="row">
										<div class="col-xs-12">
											<?php foreach ($result['Result'] as $review) {
												include(__DIR__.'/../include/ui_blocks/reviews.php');
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					</div>

					<div class="col-md-3 gradient_filter summary sidebar">

						<h4 style="color:#fff" class="center"><?php echo $this->lang->line('RENTAL_SUMMARY'); ?></h4>
						<h5 class="center">To adjust rental period, click on date/time to change</h5>

						<form action="<?php echo site_url('user/user_identity_verification') ?>" method="get">

							<div class="searchbox no-margin">
								<input type="hidden" name='car_id' value="<?php echo $car_data['id'] ?>">
								<input type="hidden" name="car_from" value="<?php echo $this->input->get('car_from'); ?>">
								<input type="hidden"  name="car_to" value="<?php echo $this->input->get('car_to'); ?>">

								<div class="col-xs-12" style="background: #fff;padding: 15px 5px;">
									<div class="col-xs-6 no-gutter ">
										<div class="row ">
											<div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
												<img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
											</div>
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
												<div class="col-md-12 title">
													<?php echo $this->lang->line('START_DATE');?>
												</div>
												<div class="col-md-12 subtitle">
													<input type="text" name="from" class="datepicker" id="date_picker_start" value="" >
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 no-gutter">
										<div class="row ">
											<div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
												<img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
											</div>
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
												<div class="col-md-12 title">
													<?php echo $this->lang->line('START_TIME');?>
												</div>
												<div class="col-md-12 subtitle">
													<input type="text" class="timepicker" id="time_picker_start" value="11:00 AM"/>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 margin-top-10" style="background: #fff;padding: 15px 5px;">
									<div class="col-xs-6 no-gutter ">
										<div class="row ">
											<div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
												<img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
											</div>
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
												<div class="col-md-12 title">
													<?php echo $this->lang->line('END_DATE');?>
												</div>
												<div class="col-md-12 subtitle">
													<input type="text" name="to" class="datepicker" id="date_picker_end" value="" >
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6 no-gutter">
										<div class="row ">
											<div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
												<img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
											</div>
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
												<div class="col-md-12 title">
													<?php echo $this->lang->line('RETURN_TIME');?>
												</div>
												<div class="col-md-12 subtitle">
													<input type="text" class="timepicker" id="time_picker_end" value="11:00 AM"/>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 margin-top-10 margin-bottom-10 center" style="color:initial;background: #fff;padding: 15px 5px;">
									<div class="col-xs-12">
										Total price for 3 day rental
									</div>
									<div class="col-xs-12 price margin-top-10 margin-bottom-10">
										&euro;1400,00
									</div>
									<?php
									$button = false;
									if ($this->session->userdata('userId') == "") {
										//echo current_full_url();
										?>
										<div class="col-xs-12 margin-bottom-15">
											<a href="<?php echo site_url('user/pass_login') . "?url=" . urlencode(current_full_url()); ?>">
												<input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
											</a>
										</div>
										<?php
									} elseif ($this->session->userdata('userId') != "") {

										if (count($user_account_info) == 0 || $user_account_info['card_id'] == "") {
											$button = true;
											?>
											<a data-toggle="modal" data-target="#wait_process" href="#">
												<input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
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
												<input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
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
													<input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
												</a>
												<?php
											} elseif ($user_transmission_state == 2 && $car_data['Transmission'] != 2) {
												$button = true;
												?>
												<a data-toggle="modal" data-target="#transmission_process" href="#">
													<input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
												</a>
												<?php
											}
										}
									}
									if ($button == false && $this->session->userdata('userId') != "") {
										?>
										<div class="col-xs-12 margin-bottom-15">
											<input  class="button gradient_filter" type='submit' value="<?php echo $this->lang->line('RENT_THIS_CAR'); ?>">
										</div>
										<?php
									}
									?>
									<div class="col-xs-12 margin-top-10">
										You won't be charged until owner accepts request
									</div>
								</div>

							</div>
						</form>
						<div class="clr"></div>
						<div class="center">
							<?php
							if ($this->session->userdata('userId') != "") {
								?>
								<?php if (!$is_user_fav_car) { ?>
									<a href="<?php echo site_url('user/user_favourite') ?>?car_id=<?php echo $car_data['id']; ?>&status=1"
									   class="text-underline margin-top-15" target="_blank">Add to favourite</a>
								<?php } else { ?>
									<a href="<?php echo site_url('user/user_favourite') ?>?car_id=<?php echo $car_data['id']; ?>&status=0"
									   class="text-underline margin-top-15" target="_blank">Remove from favourite</a>
								<?php } ?>
								<?php
							}
							?>
							<div class="clr"></div>
							<a class="text-underline margin-top-15" target="_blank"
							   href="<?php echo site_url('user/report_car/' . $car_data['id']); ?>">Report this listing</a>
						</div>

					</div>

					<div class="col-xs-3 sidebar rental-includes margin-bottom-20">
						<h4 class="center"><?php echo $this->lang->line('THIS_RENTAL_INCLUDES'); ?></h4>

						<div class="margin-top">
							<div class="col-xs-12">
								<div class="col-xs-12 inc">
									<div class="col-xs-1 no-padding ">
										<img src="<?php echo base_url(); ?>assets/image/checkcircle.png"/>
									</div>
									<div class="col-xs-11 ">
										3rd party liability insurance<br/>
										<span>Insurance in case of accident or damage</span>
									</div>
								</div>
								<div class="col-xs-12 inc">
									<div class="col-xs-1 no-padding ">
										<img src="<?php echo base_url(); ?>assets/image/checkcircle.png"/>
									</div>
									<div class="col-xs-11 ">
										&euro;250 contents coverage<br/>
										<span>Insurance for content theft <a href="#">more details</a></span>
									</div>
								</div>
								<div class="col-xs-12 inc">
									<div class="col-xs-1 no-padding ">
										<img src="<?php echo base_url(); ?>assets/image/checkcircle.png"/>
									</div>
									<div class="col-xs-11 ">
										200km per day allowance<br/>
										<span>Additional kilometers charged at &euro;2 per km</span>
									</div>
								</div>
								<div class="col-xs-12 inc">
									<div class="col-xs-1 no-padding ">
										<img src="<?php echo base_url(); ?>assets/image/checkcircle.png"/>
									</div>
									<div class="col-xs-11 ">
										Roadside assistance<br/>
										<span>If your vehicle needs recovery <a href="#">more details</a></span>
									</div>
								</div>
								<div class="col-xs-12 inc">
									<div class="col-xs-1 no-padding ">
										<img src="<?php echo base_url(); ?>assets/image/checkcircle.png"/>
									</div>
									<div class="col-xs-11 ">
										Vehivle picjup service<br/>
										<span>Vehicle delivery available <a href="#">more details</a></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 center margin-top-20">
							<span>All rentals are insured by </span><img style="max-width: 110px;" src="<?php echo base_url(); ?>assets/image/Allianzblue.png" />
						</div>
					</div>

					<div class="col-xs-3 sidebar" style="margin-top: 20px;margin-bottom: 20px">
						<h4 class="center"><?php echo $this->lang->line('SHARE_WITH_FRIENDS'); ?></h4>

						<div class="margin-top">
							<div class="col-xs-12">
							<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
								<button class="col-xs-12 margin-top-10  padding-10 facebook-button text-white cursor"><i class="fa fa-facebook"></i> Share on facebook
								</button></a>
							</div>
							<div class="col-xs-12">
								<a href="https://twitter.com/share?url=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
									<button class="col-xs-12 margin-top-10  padding-10 twitter-button text-white cursor" >	<i class="fa fa-twitter"></i> Share on twitter</button>
								</a>
							</div>
							<div class="col-xs-12">
								<a href="https://plus.google.com/share?url=<?php echo site_url('user/car_data/' . $car_data['id']); ?>" target="_blank">
									<button class="col-xs-12 margin-top-10 padding-10 google-button text-white cursor " >	<i class="fa fa-google"></i> Share on Google
									</button></a>
							</div>
						</div>
					</div>

				</div>
			</div>
			</div>
		</div>

		<div class="clr"></div>
		<div id="similar-cars" class="gradient_filter">
			<div class="inner">
				<div class="container">
					<div class="row margin-top-20 margin-bottom-20">
						<h3 style="color:#fff"><?php echo $this->lang->line('SIMILAR_CARS');?></h3>
						<div class="carholder">

							<div class="carpanel col-sm-6 col-md-4 margin-top-20  family sport automatic">
								<div>
									<div class="new gradient_filter"><?php echo $this->lang->line('NEW');?></div>
									<img src="<?php echo base_url(); ?>assets/image/porsche.png"/>
									<div class="info">
										<div class="col-xs-9">
											<div class="title">Porsche Macan</div>
											<div>3600cc, 4 Door, Petrol</div>
										</div>
										<div class="col-xs-3 text-right">
											<div class="col-md-12 price no-padding">&euro;350</div>
											<div class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY');?></div>
										</div>
									</div>
									<div class="col-xs-12 divider"></div>
									<div class="info profile">
										<div class="col-xs-9">
											<div class="col-xs-2 col-md-2 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/ProfileIcon.png"/>
											</div>
											<div class="col-md-10 no-padding name">
												Giorgos
											</div>
										</div>
										<div class="col-xs-3 text-right distance">
											<div class="col-xs-7 col-md-7 no-padding">6.5Km</div>
											<div class="col-md-5 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/Mapicon.png"/>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="carpanel col-sm-6 col-md-4 margin-top-20  family sport automatic">
								<div>
									<div class="new gradient_filter"><?php echo $this->lang->line('NEW');?></div>
									<img src="<?php echo base_url(); ?>assets/image/porsche.png"/>
									<div class="info">
										<div class="col-xs-9">
											<div class="title">Porsche Macan</div>
											<div>3600cc, 4 Door, Petrol</div>
										</div>
										<div class="col-xs-3 text-right">
											<div class="col-md-12 price no-padding">&euro;350</div>
											<div class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY');?></div>
										</div>
									</div>
									<div class="col-xs-12 divider"></div>
									<div class="info profile">
										<div class="col-xs-9">
											<div class="col-xs-2 col-md-2 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/ProfileIcon.png"/>
											</div>
											<div class="col-md-10 no-padding name">
												Giorgos
											</div>
										</div>
										<div class="col-xs-3 text-right distance">
											<div class="col-xs-7 col-md-7 no-padding">6.5Km</div>
											<div class="col-md-5 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/Mapicon.png"/>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="carpanel col-sm-6 col-md-4 margin-top-20  family sport automatic">
								<div>
									<div class="new gradient_filter"><?php echo $this->lang->line('NEW');?></div>
									<img src="<?php echo base_url(); ?>assets/image/porsche.png"/>
									<div class="info">
										<div class="col-xs-9">
											<div class="title">Porsche Macan</div>
											<div>3600cc, 4 Door, Petrol</div>
										</div>
										<div class="col-xs-3 text-right">
											<div class="col-md-12 price no-padding">&euro;350</div>
											<div class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY');?></div>
										</div>
									</div>
									<div class="col-xs-12 divider"></div>
									<div class="info profile">
										<div class="col-xs-9">
											<div class="col-xs-2 col-md-2 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/ProfileIcon.png"/>
											</div>
											<div class="col-md-10 no-padding name">
												Giorgos
											</div>
										</div>
										<div class="col-xs-3 text-right distance">
											<div class="col-xs-7 col-md-7 no-padding">6.5Km</div>
											<div class="col-md-5 no-padding">
												<img src="<?php echo base_url(); ?>assets/image/Mapicon.png"/>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
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

	<div class="modal fade modal-lg"  id="carphotosmodal" role="dialog">
		<div class="modal-dialog modal-dialog-new">
			<!-- Modal content-->
			<div class="modal-content modal-content-new" style=" background: #000;border-radius: 0;">

				<div class="modal-body text-center no-padding">
					<div class="fotorama" data-nav="thumbs"
						 data-width="100%"
						 data-minwidth="400"
						 data-maxwidth="1180"
						 data-minheight="300"
						 data-maxheight="100%">

						<?php foreach ($car_data['car_images'] as $ci) { ?>
						<a href="<?php echo $ci['CarImage_path']; ?>">
							<img src="<?php echo $ci['CarImage_path']; ?>" width="144" height="96">
						</a>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>

<link href="<?php echo base_url(); ?>assets/css/skdslider.css" rel="stylesheet">
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">

<!--footer-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->
