<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_car_input_parameters',
	'data' => ""
);

$result = get_data_with_curl($option);
$car_input_data = $result['Result'];
?>
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.range.css">
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  
		<?php /* css for datetime picker  */ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>

		<!-- Css files-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cropper_sets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cropper_sets/css/style-example.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cropper_sets/css/jquery.Jcrop.css" />

		<?php $this->load->view('include/head_block'); ?>
		<?php /* header end here */ ?>
	<form method="post" id="input_car_data" enctype='multipart/form-data' action="" autocomplete="off">
		<input type="hidden" name="uploaded_with" value="WEBSITE">
		<input type="hidden" name="fk_user_id" value="<?php echo $this->session->userdata('userId'); ?>">
		<div style="visibility:hidden;" class="form_steps" id="form_level_1">
			<div class="clr"></div>
			<div class="list-car">
				<div class="listcar-inner">
					<div class="listcar-step">
						<ul>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2-2.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3-3.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4-4.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5-5.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6-6.png"></div><div class="img2"></div> </li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('CAR_DETAILS'); ?></h2>
						<div class="clr"></div>
						<ul class="vehicle-definition">
							<li class="drop-down-options">
								<label for="type"><?php echo $this->lang->line('TYPE'); ?></label>
								<span class="styled-select">
									<select  name="type" class="">
										<?php
										echo "<option value=''>--Select Type--</option>";
										foreach ($car_types as $ct) {
											echo "<option value='" . $ct['id'] . "'>" . $ct['name'] . "</option>";
										}
										?>
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="make"><?php echo $this->lang->line('YEAR'); ?></label>
								<span class="styled-select">
									<select  name="car_brought_year" class="">
										<option value="">--Select Year--</option>
										<?php
										foreach ($car_input_data['car_element_year'] as $car_year) {
											echo '<option value="' . $car_year . '">' . $car_year . '</option>';
										}
										?>						
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="make"><?php echo $this->lang->line('MAKE'); ?></label>
								<span class="styled-select">
									<select id="car_maker" onchange="get_car_model();" name="make" class="">
										<?php
										echo "<option value=''>--Select Make--</option>";
										foreach ($car_makers as $cm) {
											echo "<option value='" . $cm['id'] . "'>" . $cm['name'] . "</option>";
										}
										?>
									</select>
								</span>
							</li>

							<li class="drop-down-options">
								<label for="model"><?php echo $this->lang->line('MODEL'); ?></label>
								<span class="styled-select">
									<select id="car_model" name="model" class="">

									</select>
								</span>
							</li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('ENGINE_DETAILS'); ?></h2>
						<div class="clr"></div>
						<ul class="vehicle-definition">
							<li class="drop-down-options">
								<label for="mileage"><?php echo $this->lang->line('MILEAGE'); ?></label>
								<span class="styled-select">

									<select name="mileage" >
										<option value="">--Select Mileage--</option>
										<?php
										foreach (explode(",", $car_input_data['car_element_mileage']) as $cem) {
											echo '<option value="' . $cem . '">' . $cem . '</option>';
										}
										?>
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label ><?php echo $this->lang->line('CUBIC_CAPACITY'); ?></label>
								<span class="styled-select">
									<select   name="cubicCapacity" class="">
										<option value="">--Select Cubic Capacity--</option>
										<?php
										foreach (explode(",", $car_input_data['car_element_cubic_capacity'])as $cecc) {
											echo '<option value="' . $cecc . '">' . $cecc . '</option>';
										}
										?>
									</select>
								</span>
							</li>

							<li class="drop-down-options">
								<label for="fuel type"><?php echo $this->lang->line('FUEL_TYPE'); ?></label>
								<span class="styled-select">
									<select id="" name="fuelType" class="">
<?php
echo "<option value=''>--Select Fuel--</option>";
foreach ($fuel_types as $ft) {
	echo "<option value='" . $ft['id'] . "'>" . $ft['fuel_type'] . "</option>";
}
?>
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="transmission"><?php echo $this->lang->line('TRANSMISSION'); ?></label>
								<span class="styled-select">
									<select id="" name="Transmission" class="">
<?php
echo "<option value=''>--Select Transmission--</option>";
foreach ($transmission_types as $tt) {
	echo "<option value='" . $tt['id'] . "'>" . $tt['transmission'] . "</option>";
}
?>
									</select>
								</span>
							</li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('BODY_DETAILS'); ?></h2>
						<div class="clr"></div>
						<ul class="vehicle-definition">
							<li class="drop-down-options">
								<label for="Color"><?php echo $this->lang->line('COLOUR'); ?></label>
								<span class="styled-select">
									<select id="" name="color" class="">
<?php
echo "<option value=''>--Select colour--</option>";
$other = "";
foreach ($colour_types as $ct) {
	if ($ct['name'] == 'Other') {
		$other = "<option value='" . $ct['id'] . "'>" . $ct['name'] . "</option>";
	} else {
		echo "<option value='" . $ct['id'] . "'>" . $ct['name'] . "</option>";
	}
}
echo $other;
?>
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="doors"><?php echo $this->lang->line('DOORS'); ?></label>
								<span class="styled-select">
									<select id="" name="doors" class="">
<?php
echo "<option value=''>--Select Doors--</option>";
foreach (explode(",", $car_input_data['car_element_doors'])as $ced) {
	echo '<option value="' . $ced . '">' . $ced . '</option>';
}
?>
									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="Airbags"><?php echo $this->lang->line('AIRBAGS'); ?></label>
								<span class="styled-select">
									<select  name="airbags" class="">

<?php
echo "<option value=''>--Select Airbag--</option>";
foreach (explode(",", $car_input_data['car_element_airbags'])as $cea) {
	echo '<option value="' . $cea . '">' . $cea . '</option>';
}
?>

									</select>
								</span>
							</li>
							<li class="drop-down-options">
								<label for="Seats"><?php echo $this->lang->line('SEATS'); ?></label>
								<span class="styled-select">
									<select  name="seat" class="">
<?php
echo "<option value=''>--Select Seats--</option>";
foreach (explode(",", $car_input_data['car_element_seats'])as $ces) {
	echo '<option value="' . $ces . '">' . $ces . '</option>';
}
?>
									</select>
								</span>
							</li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<div class="error"> </div>
						<div class="step1btn">
							<a href="#" onclick="show_step('form_level_2');" ><input class="theme-btn-basic" type="button" value="<?php echo $this->lang->line('NEXT'); ?>"></a>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>

		<div style="visibility:hidden;" class="form_steps" id="form_level_2">
			<div class="clr"></div>
			<div class="list-car">
				<div class="listcar-inner">
					<div class="listcar-step">
						<ul>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3-3.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4-4.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5-5.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6-6.png"></div><div class="img2"></div> </li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('CAR_DESCRIPTION'); ?></h2>
						<div class="clr"></div>
						<div class="textbox">
							<textarea  class="padding" rows="8" placeholder="Tell people about the condition of your car. Mention any minor issues to take into account." cols="70" name="description"></textarea>
						</div>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('CAR_FEATURES'); ?></h2>
						<div class="clr"></div>
<?php
foreach ($feature_types as $ft) {
	if ($this->input->cookie('lang') == "greek") {
		$keyname = "greek_lang";
	} else {
		$keyname = "features";
	}
	?>
							<div class="chkbox">
								<input name="car_features[]" type="checkbox" value="<?php echo $ft['id']; ?>"><span><?php echo $ft[$keyname]; ?></span>
							</div>

	<?php
}
?>
					</div>
					<div class="clr"></div>

					<div class="clr"></div>
					<div class="listcar-details">
						<div class="error"> </div>
						<div class="step2btn">
							<a href="#" onclick="show_step('form_level_1');"><input type="button" value="<?php echo $this->lang->line('PREVIOUS'); ?>" class="stepbtn1"></a>
							<a  href="#" onclick="show_step('form_level_3');" ><input class="theme-btn-basic"  type="button" value="<?php echo $this->lang->line('NEXT'); ?>" class="stepbtn2"></a>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>

		<div  style="visibility:hidden;" class="form_steps" id="form_level_3">
			<div class="clr"></div>
			<div class="list-car">
				<div class="listcar-inner">
					<div class="listcar-step">
						<ul>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4-4.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5-5.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6-6.png"></div><div class="img2"></div> </li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('SET_YOUR_CAR_AVAILABILITY'); ?></h2>
						<div class="clr"></div>
						<div class="step3">
							<div class="radio">
								<span><?php echo $this->lang->line('EVERY_DAY'); ?></span><input checked name="availablity" type="radio" id="" value="1"><br><sub>(Users can request to rent your car anyday.)</sub>
							</div>
							<div class="radio">
								<span><?php echo $this->lang->line('WEEKEND_ONLY'); ?></span><input name="availablity" type="radio" id="" value="2"><br><sub>(Your car is available from friday 5pm to sunday.)</sub>
							</div>
							<div class="radio">
								<span><?php echo $this->lang->line('WEEKDAYS_ONLY'); ?></span><input name="availablity"  type="radio" id="" value="3"><br><sub>(Your car is available from monday to friday.)</sub>
							</div>
							<div class="radio">
								<span  ><?php echo $this->lang->line('SELECT_MANUAL_DAYS'); ?></span><input  id="datepicker_array"  name="availablity"  type="radio"   value=""><br><sub></sub>

							</div>
						</div>
						<div style="float:left;" class="manual_date"  onchange="set();" >
							<input name="" id="datepicker" class="" >
						</div>
						<div style="float:left;" id="manual_datebox" class="manual_date   margin-left step3-box"></div>
					</div>


					<div class="clr"></div>
					<div class="listcar-details">
						<div class="error"> </div>
						<div class="step2btn">
							<a href="#" onclick="show_step('form_level_2');" ><input type="button" value="<?php echo $this->lang->line('PREVIOUS'); ?>" class="stepbtn1"></a>
							<a href="#" onclick="show_step('form_level_4');" ><input class="theme-btn-basic"  type="button" value="<?php echo $this->lang->line('NEXT'); ?>" class="stepbtn2"></a>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>

		<div  style="visibility:hidden;" class="form_steps" id="form_level_4">
			<div class="clr"></div>
			<div class="list-car">
				<div class="listcar-inner">
					<div class="listcar-step">
						<ul>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5-5.png"></div><div class="img2"></div> </li>
							<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6-6.png"></div><div class="img2"></div> </li>
						</ul>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h2><?php echo $this->lang->line('SET_UP_PRICE'); ?></h2>
					</div>
					<div class="clr"></div>
					<div class="listcar-details">
						<h4><?php echo $this->lang->line('LISTING_PRICE'); ?></h4>
						<ul class="vehicle-definition">
							<li class="drop-down-options">
								<label for="type"><?php echo $this->lang->line('DAILY'); ?></label>

								<span class="styled-select">
									<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
									<div class="step4input"><input id="input_daily_price" name="price_daily" type="text" placeholder="">
										</span>
										</li>

										<li class="drop-down-options">
											<label for="make"><?php echo $this->lang->line('KILOMETER'); ?><input checked name="kmOrMiles" onclick="show_distance('KILOMETER');" type="radio" id="" value="1"><!-- &nbsp; &nbsp; &nbsp;MILES<input name="kmOrMiles" onclick="show_distance('MILES');" type="radio" id="" value="2">--></label>
											<span class="styled-select">
												<input id="input_distance" name="kmOrMilesValue" type="text" placeholder="">
											</span>
										</li>
										<li class="drop-down-options">
											<label for="model"><?php echo $this->lang->line('YOU_KEEP'); ?></label>
											<span class="styled-select">
												<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
												<div class="step4input"><input readonly name="youEarn" id="input_daily_earn" type="text" placeholder="">
													</span>
													</li>
													</ul>
												</div>
												<div class="clr"></div>
												<div class="listcar-details">
													<ul class="vehicle-definition">
														<li class="drop-down-options">
															<label for="type"><?php echo $this->lang->line('WEEKLY'); ?></label>

															<span class="styled-select">
																<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
																<div class="step4input"> <input id="input_w_price" type="text" name="price_weekly" placeholder="">
																	</span>
																	<span id="input_w_price_discount"></span>
																	</li>
																	<li class="drop-down-options">
																		<label for="make"><span class="distance_text"><?php echo $this->lang->line('KILOMETER'); ?></span></label>
																		<span class="styled-select">
																			<input readonly id="input_w_distance" type="text" placeholder="">
																		</span>
																	</li>
																	<li class="drop-down-options">
																		<label for="model"><?php echo $this->lang->line('YOU_KEEP'); ?></label>
																		<span class="styled-select">
																			<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
																			<div class="step4input"> <input readonly id="input_w_earn"  type="text" placeholder="">
																				</span>
																				</li>
																				</ul>
																			</div>
																			<div class="clr"></div>
																			<div class="listcar-details">
																				<ul class="vehicle-definition">
																					<li class="drop-down-options">
																						<label for="type"><?php echo $this->lang->line('MONTHLY'); ?></label>
																						<span class="styled-select">
																							<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
																							<div class="step4input">  <input  id="input_m_price" type="text" name="price_monthly" placeholder="">
																								</span>
																								<span id="input_m_price_discount"></span>
																								</li>
																								<li class="drop-down-options">
																									<label for="make"><span class="distance_text"><?php echo $this->lang->line('KILOMETER'); ?></span></label>
																									<span class="styled-select">
																										<input readonly id="input_m_distance"  type="text" placeholder="">
																									</span>
																								</li>
																								<li class="drop-down-options">
																									<label for="model"><?php echo $this->lang->line('YOU_KEEP'); ?></label>
																									<span class="styled-select">
																										<div class="step4inputimg"><img src="http://fourthscreenlabs.com/URENDwebsite/image/green_euro.png"></div>
																										<div class="step4input">  <input readonly id="input_m_earn"  type="text" placeholder="">
																											</span>
																											</li>
																											</ul>
																										</div>
																										<div class="clr"></div>

																										<div class="listcar-details step4border">
																											<div class="step4txt gray-ranger">
																												<span><?php echo $this->lang->line('COST_OF_EVERY_EXTRA_KILOMETER'); ?> </span><span class="distance_text">KILOMETER</span><div class="range-btn">&euro; <span class="distance_ranger_count"></span>/<span class="distance_text">KILOMETER</span></div>
																												<div class="gray-ranger"><input name="carExtraKmOrMl" class="range-slider"  onchange="$('.distance_ranger_count').html($(this).val())" type="hidden" value="0.1"/></div>
																											</div>


																											<div class="clr"></div>
																											<div class="error"> </div>
																											<div class="step2btn">
																												<a href="#" onclick="show_step('form_level_3');" ><input type="button" value="<?php echo $this->lang->line('PREVIOUS'); ?>"  class="stepbtn1"></a>
																												<a  href="#" onclick="show_step('form_level_5');" ><input class="theme-btn-basic"  type="button" value="<?php echo $this->lang->line('NEXT'); ?>" class="stepbtn2"></a>
																											</div>
																										</div>
																										<div class="clr"></div>
																							</div>
																							</div>
																							<div class="clr"></div>
																							</div>

																							<div  style="visibility:hidden;" class="form_steps" id="form_level_5">
																								<div class="list-car">
																									<div class="listcar-inner">
																										<div class="listcar-step">
																											<ul>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5.png"></div><div class="img2"></div></li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6-6.png"></div><div class="img2"></div> </li>
																											</ul>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h2><?php echo $this->lang->line('CAR_AVAILABILITY'); ?></h2>
																										</div>

																										<div class="step5left" >
																											<div class="listcar-details" style="display:none" >
																												<ul class="vehicle-definition">
																													<li class="drop-down-options">
																														<label for="type">Country</label>
																														<span class="styled-select">
																															<select class="" onchange="get_city_list();"  name="country" id="country_type">
<?php
echo "<option value=''>--Select Country--</option>";
foreach ($country as $ct) {
	echo "<option value='" . $ct['id'] . "'>" . $ct['country'] . "</option>";
}
?>
																															</select>
																														</span>
																													</li>
																													<li class="drop-down-options">
																														<label for="make">City</label>
																														<span class="styled-select">
																														  <!--  <select class="" name="city" id="city_list">
																														  </select>-->
																															<input type="text"  name="city" id="city_list" >
																														</span>
																													</li>
																													<li class="drop-down-options">
																														<label for="model">Zipcode</label>
																														<span class="styled-select">
																															<input style='text-transform:uppercase' value="hgfh"  type="text" name="zipCode" placeholder="zipcode">
																														</span>
																													</li>
																												</ul>
																											</div>

																											<div class="clr"></div>
																											<div class="listcar-details" >
																												<ul class="vehicle-definition">
																													<li class="drop-down-options step5loc">
																														<label for="type"><?php echo $this->lang->line('CAR_PICKUP_LOCATION'); ?></label>

																														<span class="styled-select">
																															<input name="carPickUpLat" id="carPickUpLat"  type="hidden" placeholder="">
																															<input name="carPickUpLon" id="carPickUpLon"  type="hidden" placeholder="">
																															<input  name="carPickUpLocation" id="carPickUpLocation"   type="text" placeholder="">

																														</span>
																														<div id="us2" style="width: 690px; height: 200px;"></div>
																													</li>
																												</ul>
																											</div>
																											<div class="clr"></div>

																											<div class="listcar-details">
																												<ul class="vehicle-definition">
																													<li class="drop-down-options step5loc">
																														<label for="type"><?php echo $this->lang->line('CAR_DROPOFF_LOCATION'); ?></label>

																														<span class="styled-select">
																															<input name="carDropOffLat" id="carDropOffLat" type="hidden" placeholder="">
																															<input name="carDropOffLon" id="carDropOffLon" type="hidden" placeholder="">
																															<input name="carDropOffLocation" id="carDropOffLocation"  type="text" placeholder="">
																														</span>
																														<div id="us1" style="width: 690px; height:200px;"></div>
																													</li>
																												</ul>
																											</div>

																										</div>

																										<div class="clr"></div>
																										<div class="listcar-details">
																											<ul class="vehicle-definition">
																												<li class="drop-down-options">
																													<label for="type"><?php echo $this->lang->line('DELIVERY_OPTIONS'); ?></label>
																													<span class="styled-select step5radio">
																														<sub><?php echo $this->lang->line('YES'); ?></sub><input onclick="$('#del_price_div').show('slow');" type="radio" name="deliveryOption" value="1" id=""> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<sub><?php echo $this->lang->line('NO'); ?></sub><input type="radio" onclick="$('#del_price_div').hide();"  checked name="deliveryOption" value="0" id="">
																													</span>
																												</li>
																											</ul>
																										</div>
																										<div id="del_price_div" style="display:none;" class="listcar-details">
																											<div class="step4txt gray-ranger">
																												<span><?php echo $this->lang->line('PRICE'); ?></span><div class="range-btn">&euro; <span class="delivery_ranger_count"></span> </div>
																												<div class="gray-ranger"><input name="price" class="range-slider"  onchange="$('.delivery_ranger_count').html($(this).val())" type="hidden" value="0"/></div>
																											</div>
																											<!--<ul class="vehicle-definition">
																												<li class="drop-down-options">
																													<label for="type">Price</label>
																													<span class="styled-select">
																														<input name="price" type="text" placeholder="price">
																													</span>
																												</li>
																											</ul>-->
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h2><?php echo $this->lang->line('UPLOAD_PHOTO_OF_YOUR_CAR'); ?></h2>
																											<div class="clr"></div>
																										</div>
																										<div class="clr"></div>
																										<div class="step5slider">
																											<!------------------------slide------------------------>
																											<div class="gamepart">
																												<nav class="slidernav">
																													<div id="navbtns" class="clearfix">
																														<a href="#" class="previous"></a>
																														<a href="#" class="next"></a>      </div>
																												</nav>

																												<div class="crsl-items" data-navigation="navbtns">
																													<div class="crsl-wrap">
																														<div class="crsl-item">
																															<div class="thumbnail">
																																<div class="imageBox1 cropme ">
																																	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>								
																																</div>
																																<a href="javascript:void(0);" style="display:none" class="cropper_delete" ><img src="<?php echo base_url(); ?>assets/image/delete-icon.png"> </a>
																																<input type="text"  style="display:none"  class="image_map" value="" />
																																<input type="hidden"   class="image_holder" name="car_image1"  value=""  />

																															</div><!-- post #1 -->
																														</div>
																														<div class="crsl-item">
																															<div class="thumbnail">
																																<div class="imageBox2 cropme ">
																																	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>								
																																</div>
																																<a href="javascript:void(0);" style="display:none" class="cropper_delete" ><img src="<?php echo base_url(); ?>assets/image/delete-icon.png"> </a>
																																<input type="hidden"    class="image_map" value=""  />
																																<input type="hidden"   class="image_holder" name="car_image2"  value=""  />
																															</div><!-- post #1 -->
																														</div><!-- post #2 -->

																														<div class="crsl-item">
																															<div class="thumbnail">
																																<div class="imageBox3 cropme ">
																																	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>								
																																</div>
																																<a href="javascript:void(0);" style="display:none" class="cropper_delete" ><img src="<?php echo base_url(); ?>assets/image/delete-icon.png"> </a>
																																<input type="text"  style="display:none"  class="image_map" value=" " />
																																<input type="hidden"   class="image_holder" name="car_image3"  value=""  />
																															</div><!-- post #1 -->
																														</div><!-- post #3 -->

																														<div class="crsl-item">
																															<div class="thumbnail">
																																<div class="imageBox4 cropme ">
																																	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>								
																																</div>
																																<a href="javascript:void(0);" style="display:none" class="cropper_delete" ><img src="<?php echo base_url(); ?>assets/image/delete-icon.png"> </a>
																																<input type="hidden"    class="image_map" value=" " />
																																<input type="hidden"   class="image_holder" name="car_image4"  value=""  />							
																															</div><!-- post #1 -->
																														</div><!-- post #4 -->

																														<div class="crsl-item">
																															<div class="thumbnail">
																																<div class="imageBox5 cropme ">
																																	<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>								
																																</div>
																																<a href="javascript:void(0);" style="display:none" class="cropper_delete" ><img src="<?php echo base_url(); ?>assets/image/delete-icon.png"> </a>
																																<input type="hidden"    class="image_map" value=" " />
																																<input type="hidden"   class="image_holder" name="car_image5"  value=""  />	
																															</div><!-- post #1 -->
																														</div><!-- post #5 -->

																													</div><!-- @end .crsl-wrap -->
																												</div><!-- @end .crsl-items -->

																											</div>
																											<!------------------------slide------------------------>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<div class="error"> </div>
																											<div class="step2btn">
																												<a href="#" onclick="show_step('form_level_4');" ><input type="button" class="stepbtn1" value="<?php echo $this->lang->line('PREVIOUS'); ?>"></a>
																												<a   href="#" onclick="show_step('form_level_6');" ><input class="theme-btn-basic" type="button" class="stepbtn2" value="<?php echo $this->lang->line('NEXT'); ?>"></a>
																											</div>
																										</div>
																										<div class="clr"></div>
																									</div>
																								</div>

																							</div>

																							<div  style="visibility:hidden;" class="form_steps" id="form_level_6" >
																								<div class="list-car">
																									<div class="listcar-inner">
																										<div class="listcar-step">
																											<ul>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step1.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step2.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step3.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step4.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step5.png"></div><div class="img2"><img src="<?php echo base_url(); ?>assets/image/line.png"></div> </li>
																												<li><div class="img1"><img src="<?php echo base_url(); ?>assets/image/step6.png"></div><div class="img2"></div></li>
																											</ul>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h2><?php echo $this->lang->line('REGISTRATION_AND_INSURANCE'); ?></h2>
																										</div>

																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h4><?php echo $this->lang->line('INSURANCE_TYPE'); ?></h4>
																											<div class="clr"></div>
																											<div class="step6">
																												<div class="radio">
																													<span><?php echo $this->lang->line('STANDARD'); ?></span><input checked name="insuranceType" type="radio" value="1">
																												</div>
																												<div class="radio">
																													<span><?php echo $this->lang->line('FULL_COVERAGE'); ?></span><input name="insuranceType" type="radio" value="2">
																												</div>
																											</div>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h4><?php echo $this->lang->line('INSURANCE_EXPIRY_DATE'); ?></h4>
																											<div class="clr"></div>
																											<div class="step6bg">
																												<ul class="vehicle-definition">
																													<li class="drop-down-options">
																														<span class="styled-select">
																															<input autocomplete ="off"  type="text" name="insuranceValidTill">
																															<input style="display:none"  id="insurance_file_front" type="file" name="insurance_file_front">
																															<input style="display:none"  id="insurance_file_back" type="file" name="insurance_file_back">
																														</span>
																													</li>
																												</ul>
																												<div class="bg-img">
																													<a onclick="$('#insurance_file_front').click();" href="#"><img src="<?php echo base_url(); ?>assets/image/picture.png"></a>
																													<a onclick="$('#insurance_file_back').click();" href="#"><img src="<?php echo base_url(); ?>assets/image/picture.png"></a>				
																													</div>
																											</div>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<h4><?php echo $this->lang->line('CAR_PLATE_NUMBER'); ?></h4>
																											<div class="clr"></div>
																											<div class="step6bg">
																												<ul class="vehicle-definition">
																													<li class="drop-down-options">
																														<span class="styled-select">
																															<input  type="text" name="carPlateNumber">
																														</span>
																													</li>
																												</ul>

																											</div>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<div class="step6chkbox">
																												<input type="checkbox" value="" id="terms_condition"><span><?php echo $this->lang->line('AGREE_BEFORE_SAVE_CAR'); ?></span>
																											</div>
																										</div>
																										<div class="clr"></div>
																										<div class="listcar-details">
																											<div class="error"> </div>
																											<div class="step2btn">
																												<a href="#" onclick="show_step('form_level_5');"><input type="button" class="stepbtn1" value="<?php echo $this->lang->line('PREVIOUS'); ?>"></a>
																												<a   onclick="show_step('final_step');" href="#"><input class="theme-btn-basic" type="submit" class="stepbtn2" value="<?php echo $this->lang->line('SAVE'); ?>"></a>
																											</div>

																										</div>
																									</div>
																								</div>
																							</div>
																							<style>
																								.error {
																									color: red;
																									font-family: "ralewayregular";
																									font-weight: bold;
																									text-align: center;
																								}
																							</style>
																							</form>
																							<div id="loading_wait" style="display:none;text-align: center;"><a href="#" ><img src="<?php echo base_url(); ?>assets/image/loading.gif"></a></div>
																							<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
																							<!--/footer-->


																							<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
																							<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
																							<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
																							<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
																							<script src="<?php echo base_url(); ?>assets/js/zenith.js"></script>
																							<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/responsiveCarousel.min.js"></script>
																							<script type="text/javascript">
																														$(function () {
																															$('.crsl-items').carousel({
																																visible: 2,
																																itemMinWidth: 180,
																																itemEqualHeight: 370,
																																itemMargin: 9,
																															});

																															$("a[href=#]").on('click', function (e) {
																																e.preventDefault();
																															});
																														});
																							</script>
																							<script type="text/javascript">
																								$('#some-id').zenith({
																									layout: 'hand',
																									slideSpeed: 400
																								});

																								function get_car_year() {
																									c_id = jQuery("#car_maker").val();
																									jQuery.ajax({
																										url: '<?php echo base_url('index.php/user/call_car_year'); ?>',
																										method: 'POST',
																										dataType: 'json',
																										data: {
																											id: c_id
																										},
																										success: function (data) {
																											if (data.status == 1) {
																												jQuery("#car_year").html(data.html);
																											}
																										}
																									});
																								}

																								function get_car_model() {
																									m_id = jQuery("#car_maker").val();
																									jQuery.ajax({
																										url: '<?php echo base_url('index.php/user/call_car_model'); ?>',
																										method: 'POST',
																										dataType: 'json',
																										data: {
																											id: m_id
																										},
																										success: function (data) {
																											if (data.status == 1) {
																												jQuery("#car_model").html(data.html);
																											}
																										}
																									});
																								}
																								function get_city_list() {
																									m_id = jQuery("#country_type").val();
																									jQuery.ajax({
																										url: '<?php echo base_url('index.php/user/call_city_list'); ?>',
																										method: 'POST',
																										dataType: 'json',
																										data: {
																											id: m_id
																										},
																										success: function (data) {
																											if (data.status == 1) {
																												jQuery("#city_list").html(data.html);
																											}
																										}
																									});

																								}
																								function show_step(step) {
																									$(".border-danger").removeClass("border-danger");

																									error = $('.error');
																									error.html('');

																									if (step == "form_level_2") {
																										if ($('select[name=type]').val() == "") {
																											show_error('* Please select car type.');

																											$('select[name=type]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=car_brought_year]').val() == "") {
																											show_error('* Please select car year.');
																											$('select[name=car_brought_year]').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('select[name=make]').val() == "") {
																											show_error('* Please select car maker.');
																											$('select[name=make]').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('select[name=model]').val() == "") {
																											show_error('* Please select car model.');
																											$('select[name=model]').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('select[name=mileage]').val() == "") {
																											show_error('* Please select car mileage.');
																											$('select[name=mileage]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=cubicCapacity]').val() == "") {
																											show_error('* Please select car Cubic capacity.');
																											$('select[name=cubicCapacity]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=fuelType]').val() == "") {
																											show_error('* Please select car Fuel type.');
																											$('select[name=fuelType]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=Transmission]').val() == "") {
																											show_error('* Please select car Transmission.');
																											$('select[name=Transmission]').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('select[name=color]').val() == "") {
																											show_error('* Please select car color.');
																											$('select[name=color]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=doors]').val() == "") {
																											show_error('* Please select car doors.');
																											$('select[name=doors]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=airbags]').val() == "") {
																											show_error('* Please select car airbags.');
																											$('select[name=airbags]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('select[name=seat]').val() == "") {
																											show_error('* Please select car seat.');
																											$('select[name=seat]').focus().addClass("border-danger");
																											return false;
																										}
																									}
																									if (step == "form_level_3") {
																										if ($('textarea[name=description]').val() == "") {
																											show_error('* Please enter description.');
																											$('textarea[name=description]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('input[name="car_features[]"]:checked').length == 0) {
																											show_error('* Please choose car features.');
																											$('input[name="car_features[]').focus();
																											return false;
																										}
																									}

																									if (step == "form_level_4") {
																										if ($('input[name=availablity]:checked').val() != 1 && $('input[name=availablity]:checked').val() != 2 && $('input[name=availablity]:checked').val() != 3 && $('#manual_datebox').html() == "") {

																											show_error('* Please choose date from calender.');
																											$('#manual_datebox').focus().addClass("border-danger");
																											document.getElementById('manual_datebox').scrollIntoView();

																											return false;
																										}

																									}
																									if (step == "form_level_5") {
																										if ($('input[name=price_daily]').val() == "") {
																											show_error('* Please enter daily price.');
																											$('input[name=price_daily]').focus().addClass("border-danger");
																											return false;
																										} else if ($('input[name=price_daily]').val() < 15) {
																											show_error('* Daily price should be equal or more than 15.');
																											$('input[name=price_daily]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('#input_w_price').val() < 70) {
																											show_error('* Weekly price should be equal or more than 70.');
																											$('#input_w_price').focus().addClass("border-danger");
																											return false;
																										} else if ($('#input_w_price').val() > $('input[name=price_daily]').val() * 7) {
																											show_error('* Weekly price can not be  more than ' + $('input[name=price_daily]').val() * 7);
																											$('#input_w_price').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('#input_m_price').val() < 200) {
																											show_error('* Monthly price should be equal or more than 200.');
																											$('#input_m_price').focus().addClass("border-danger");
																											return false;
																										} else if ($('#input_m_price').val() > $('input[name=price_daily]').val() * 30) {
																											show_error('* Monthly price can not be  more than ' + $('input[name=price_daily]').val() * 30);
																											$('#input_m_price').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('input[name=kmOrMilesValue]').val() == "" || $('input[name=kmOrMilesValue]').val() > 500 || $('input[name=kmOrMilesValue]').val() < 50) {
																											show_error('* Please enter distance from 50 to 500.');
																											$('input[name=kmOrMilesValue]').focus().addClass("border-danger");
																											return false;
																										}
																										//carExtraKmOrMl
																										if ($('input[name=carExtraKmOrMl]').val() == "" || $('input[name=carExtraKmOrMl]').val() > 0.20 || $('input[name=carExtraKmOrMl]').val() < 0.1) {
																											show_error('* Please set cost for extra  distance from 0.1 to 0.15');
																											$('input[name=carExtraKmOrMl]').focus().addClass("border-danger");
																											return false;
																										}

																										load_map();
																									}
																									if (step == "form_level_6") {
																										if ($('select[name=country]').val() == "") {
																											show_error('* This location is not available for listing the car.');
																											//$('select[name=country]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('input[name=city]').val() == "") {
																											show_error('* This location is not available for listing the car.');
																											//$('input[name=city]').focus().addClass("border-danger");
																											return false;
																										}
																										if ($('input[name=zipCode]').val() == "") {
																											show_error('* Please enter zipCode.');
																											$('input[name=zipCode]').focus().addClass("border-danger");
																											return false;
																										}

																										if ($('input[name=deliveryOption]:checked').val() == 1) {
																											if (jQuery('input[name=price]').val() > 100) {
																												show_error('* Price should be not more than 100.');
																												return false;
																											}
																										}

																										if ($('input[name=car_image1]').val() == "" && $('input[name=car_image2]').val() == "" && $('input[name=car_image3]').val() == "" && $('input[name=car_image4]').val() == "" && $('input[name=car_image5]').val() == "") {
																											show_error('* Please choose car images.');
																											return false;
																										}

																									}

																									if (step == "final_step") {

																										if ($('input[name=insuranceValidTill]').val() == "") {
																											show_error('* Please fill insurance expiry date.');
																											$('input[name=insuranceValidTill]').focus().addClass("border-danger");
																											return false;
																										}


																										if ($('#insurance_file_front').val() == "") {
																											show_error('* Please choose car insurance file front.');
																											return false;
																										}
																										
																										if ($('#insurance_file_back').val() == "") {
																											show_error('* Please choose car insurance file back.');
																											return false;
																										}
																										if ($('input[name=carPlateNumber]').val() == "") {
																											show_error('* Please enter car plate number.');
																											$('input[name=carPlateNumber]').focus().addClass("border-danger");
																											return false;
																										}

																										if (!$('#terms_condition').is(':checked')) {
																											show_error('* Please accept terms and condition.');
																											$('#terms_condition').focus().addClass("border-danger");
																											return false;
																										}

																										$('#input_car_data').submit();
																									}

																									$(".form_steps").hide();
																									$('html, body').animate({
																										'scrollTop': $("#input_car_data").position().top
																									}, 'slow');

																									$("#" + step).show().resize();

																								}

																								function show_distance(text) {
																									$(".distance_text").html(text);
																								}
																								jQuery('input[name=price]').keyup(function () {
																									this.value = this.value.replace(/[^0-9\.]/g, '');
																								});

																								jQuery('#input_daily_price').keyup(function () {
																									this.value = this.value.replace(/[^0-9\.]/g, '');
																									jQuery('#input_w_price').val('');
																									jQuery('#input_m_price').val('');
																									jQuery("#input_daily_earn").val('');
																									jQuery("#input_w_earn").val('');
																									jQuery("#input_m_earn").val('');
																									jQuery('#input_w_price_discount').html("");
																									jQuery('#input_m_price_discount').html("");
																									if (this.value > 0) {
																										earn = this.value - (this.value * <?php echo get_web_meta_data('commission_rate'); ?>) / 100;
																										jQuery("#input_daily_earn").val(earn);
																										earn = (this.value * 7) - (this.value * <?php echo get_web_meta_data('commission_rate'); ?> * 7) / 100;
																										jQuery("#input_w_earn").val(earn);

																										earn = (this.value * 30) - (this.value * <?php echo get_web_meta_data('commission_rate'); ?> * 30) / 100;
																										jQuery("#input_m_earn").val(earn);

																										jQuery('#input_w_price').val(this.value * 7);
																										jQuery('#input_m_price').val(this.value * 30);
																									}
																								});
																								//input_distance
																								jQuery('#input_distance').keyup(function () {
																									this.value = this.value.replace(/[^0-9\.]/g, '');
																									jQuery('#input_w_distance').val('');
																									jQuery('#input_m_distance').val('');
																									if (this.value > 0) {
																										jQuery('#input_w_distance').val(this.value * 7);
																										jQuery('#input_m_distance').val(this.value * 30);
																									}
																								});

																								jQuery('#input_w_price').keyup(function () {
																									this.value = this.value.replace(/[^0-9\.]/g, '');
																									jQuery('#input_w_price_discount').html('');
																									//discount = 100 - Math.round((this.value * 100) / (jQuery('#input_daily_price').val() * 7));
																									discount = (100 - (this.value * 100) / (jQuery('#input_daily_price').val() * 7)).toFixed(2);
																									earn = this.value - (this.value * <?php echo get_web_meta_data('commission_rate'); ?>) / 100;
																									jQuery("#input_w_earn").val(earn);

																									if (this.value > 0 && discount > 0) {
																										jQuery('#input_w_price_discount').html("Weekly Discount " + discount + "%");
																									}

																								});

																								jQuery('#input_m_price').keyup(function () {
																									this.value = this.value.replace(/[^0-9\.]/g, '');
																									jQuery('#input_m_price_discount').html('');
																									//discount = 100 - Math.round((this.value * 100) / (jQuery('#input_daily_price').val() * 30));
																									discount = (100 - Math.round((this.value * 100) / (jQuery('#input_daily_price').val() * 30))).toFixed(2);
																									earn = this.value - (this.value * <?php echo get_web_meta_data('commission_rate'); ?>) / 100;
																									jQuery("#input_m_earn").val(earn);

																									if (this.value > 0 && discount > 0) {
																										jQuery('#input_m_price_discount').html("Monthly Discount " + discount + "%");
																									}
																								});

																							</script>

        <!--<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>-->
																							<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&sensor=false&libraries=places"
																							></script>
																							<script src="<?php echo base_url(); ?>assets/js/locationpicker.jquery.js"></script>
																							<script>
																								function load_map() {
																									$('#us1').locationpicker({
																										location: {latitude: 39.457405025074074, longitude: 21.7810210351563},
																										radius: 0.5,
																										zoom: 6,
																										inputBinding: {
																											latitudeInput: $('#carDropOffLat'),
																											longitudeInput: $('#carDropOffLon'),
																											locationNameInput: $('#carDropOffLocation')
																										},
																										addressFormat: "formatted_address",
																										enableAutocomplete: true
																									});

																									$('#us2').locationpicker({
																										location: {latitude: 39.457405025074074, longitude: 21.7810210351563},
																										radius: 0.5,
																										zoom: 6,
																										inputBinding: {
																											latitudeInput: $('#carPickUpLat'),
																											longitudeInput: $('#carPickUpLon'),
																											locationNameInput: $('#carPickUpLocation')
																										},
																										addressFormat: "formatted_address",
																										enableAutocomplete: true,
																										onchanged: function (currentLocation, radius, isMarkerDropped) {
																											var pick = $('#carPickUpLocation').val();
																											$('#carDropOffLocation').val(pick);
																											$('#us1').locationpicker({
																												location: {latitude: currentLocation.latitude, longitude: currentLocation.longitude},
																												radius: 0.5,
																												zoom: 6,
																												inputBinding: {
																													latitudeInput: $('#carPickUpLat'),
																													longitudeInput: $('#carPickUpLon'),
																													locationNameInput: $('#carPickUpLocation')
																												},
																												addressFormat: "formatted_address",
																												enableAutocomplete: true,
																											});
																										}
																									});
																								}

																							</script>


																							<script>
																								$(document).ready(function () {
																									$(".img-dlt1").hide();
																									$(".img-dlt2").hide();
																									$(".img-dlt3").hide();
																									$(".img-dlt4").hide();
																									$(".img-dlt5").hide();
																								});
																							</script>

																							<script type="text/javascript">
																								$(function () {
																									$("#file1").on("change", function ()
																									{
																										var files = !!this.files ? this.files : [];
																										if (!files.length || !window.FileReader)
																											return; // no file selected, or no FileReader support

																										if (/^image/.test(files[0].type)) { // only image file
																											var reader = new FileReader(); // instance of the FileReader
																											reader.readAsDataURL(files[0]); // read the local file

																											reader.onloadend = function () { // set image data as background of div
																												$(".imageBox1").css("background-image", "url(" + this.result + ")");
																												$(".img-dlt1").show();
																												$(".file-show1").hide();
																											}
																										}
																									});
																								});

																								function reset_sl_image_1() {
																									$("#file1").val('');
																									$('.img-dlt1').hide();
																									$('.file-show1').show('slow');
																									$('.imageBox1').css('background', '');
																								}

																								$(function () {
																									$("#file2").on("change", function ()
																									{
																										var files = !!this.files ? this.files : [];
																										if (!files.length || !window.FileReader)
																											return; // no file selected, or no FileReader support

																										if (/^image/.test(files[0].type)) { // only image file
																											var reader = new FileReader(); // instance of the FileReader
																											reader.readAsDataURL(files[0]); // read the local file

																											reader.onloadend = function () { // set image data as background of div
																												$(".imageBox2").css("background-image", "url(" + this.result + ")");
																												$(".img-dlt2").show();
																												$(".file-show2").hide();
																											}
																										}
																									});
																								});
																								function reset_sl_image_2() {
																									$("#file2").val('');
																									$('.img-dlt2').hide();
																									$('.file-show2').show('slow');
																									$('.imageBox2').css('background', '');
																								}
																								$(function () {
																									$("#file3").on("change", function ()
																									{
																										var files = !!this.files ? this.files : [];
																										if (!files.length || !window.FileReader)
																											return; // no file selected, or no FileReader support

																										if (/^image/.test(files[0].type)) { // only image file
																											var reader = new FileReader(); // instance of the FileReader
																											reader.readAsDataURL(files[0]); // read the local file

																											reader.onloadend = function () { // set image data as background of div
																												$(".imageBox3").css("background-image", "url(" + this.result + ")");
																												$(".img-dlt3").show();
																												$(".file-show3").hide();
																											}
																										}
																									});
																								});
																								function reset_sl_image_3() {
																									$("#file3").val('');
																									$('.img-dlt3').hide();
																									$('.file-show3').show('slow');
																									$('.imageBox3').css('background', '');
																								}
																								$(function () {
																									$("#file4").on("change", function ()
																									{
																										var files = !!this.files ? this.files : [];
																										if (!files.length || !window.FileReader)
																											return; // no file selected, or no FileReader support

																										if (/^image/.test(files[0].type)) { // only image file
																											var reader = new FileReader(); // instance of the FileReader
																											reader.readAsDataURL(files[0]); // read the local file

																											reader.onloadend = function () { // set image data as background of div
																												$(".imageBox4").css("background-image", "url(" + this.result + ")");
																												$(".img-dlt4").show();
																												$(".file-show4").hide();
																											}
																										}
																									});
																								});
																								function reset_sl_image_4() {
																									$("#file4").val('');
																									$('.img-dlt4').hide();
																									$('.file-show4').show('slow');
																									$('.imageBox4').css('background', '');
																								}
																								$(function () {
																									$("#file5").on("change", function ()
																									{
																										var files = !!this.files ? this.files : [];
																										if (!files.length || !window.FileReader)
																											return; // no file selected, or no FileReader support

																										if (/^image/.test(files[0].type)) { // only image file
																											var reader = new FileReader(); // instance of the FileReader
																											reader.readAsDataURL(files[0]); // read the local file

																											reader.onloadend = function () { // set image data as background of div
																												$(".imageBox5").css("background-image", "url(" + this.result + ")");
																												$(".img-dlt5").show();
																												$(".file-show5").hide();
																											}
																										}
																									});
																								});
																								function reset_sl_image_5() {
																									$("#file5").val('');
																									$('.img-dlt5').hide();
																									$('.file-show5').show('slow');
																									$('.imageBox5').css('background', '');
																								}
																							</script>
																							<script>
																								$('.form_steps').css('visibility', '');
																								$('.form_steps').hide();
																								$('#form_level_1').show();
																							</script>

																							<script>

																								$(document).ready(function (e) {
																									$('#input_car_data').on('submit', (function (e) {
																										e.preventDefault();
																										$('#loading_wait').show();
																										//$('#message').empty();
																										//$('#loading').show();
																										$.ajax({
																											url: '<?php echo base_url(); ?>index.php/service_insert_car_data',
																											type: 'POST',
																											data: new FormData(this),
																											contentType: false,
																											cache: false,
																											processData: false,
																											dataType: 'json',
																											success: function (data)
																											{

																												if (data.isSuccess) {
																													show_success('car listed successfully.');
																													location.href = '<?php echo base_url() . 'index.php/user/car_list' ?>';
																												} else {
																													show_error(data.message);
																													$('#form_level_6').show();
																													$('#loading_wait').hide();
																												}

																											}
																										});
																									}));
																								});

																							</script>

       <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>-->

																							<script>
																								/* $(function () {
																								 $("#datepicker").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
																								 });*/

																								/*
																								 $(function () {
																								 $("input[name=insuranceValidTill]").datepicker({dateFormat: 'yy-mm-dd', minDate: 0,showAnim: 'slide',changeMonth: true, changeYear: true});
																								 });
																								 */
																								function set() {
																									newd = $("#datepicker_array").val() + ',' + $("#datepicker").val();
																									$("#datepicker_array").val(newd);

																									res = newd.split(",");
																									res = unique(res);
																									$('.step3-box').html('');

																									$.each(res, function (i) {
																										if (res[i] != "") {
																											$('.step3-box').append('<div class="add"><span>' + res[i] + '</span><img onclick="re(' + "'" + res[i] + "'" + ');" src="<?php echo base_url(); ?>/assets/image/cross.png"></div>');
																										}
																									});
																									$("#datepicker").val('');
																								}

																								function re(d) {
																									newd = $("#datepicker_array").val() + ',' + $("#datepicker").val();
																									res = newd.split(",");
																									refreshd = "";
																									$.each(res, function (i) {
																										if (res[i] != d) {
																											refreshd = refreshd + res[i] + ',';
																										}
																									});
																									$("#datepicker_array").val(refreshd);
																									set();
																								}
																								function unique(array) {
																									return $.grep(array, function (el, index) {
																										return index === $.inArray(el, array);
																									});
																								}

																								$(".manual_date").hide('fast');
																								$("input[name=availablity]").click(function () {
																									if (this.id == "datepicker_array") {
																										$(".manual_date").show('slow');
																									} else {
																										$(".manual_date").hide('fast');
																									}
																								});


																							</script>
																							<script src="<?php echo base_url(); ?>assets/js/jquery.range.js"></script>
																							<script>
																								$(document).ready(function () {
																									$("input[name=carExtraKmOrMl]").jRange({
																										from: 0.1,
																										to: 0.2,
																										step: 0.01,
																										scale: [0.1, 0.2],
																										format: '%s',
																										width: 300,
																										showLabels: true,
																										snap: true
																									});

																									$("input[name=price]").jRange({
																										from: 0,
																										to: 100,
																										step: 1,
																										format: '%s',
																										width: 300,
																										showLabels: true,
																										snap: true
																									});


																								});
																							</script>
<?php /* js for date time picker */ ?>
																							<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
																							<script>
																								$(document).ready(function () {
																									jQuery('input[name=insuranceValidTill]').datetimepicker({
																										dayOfWeekStart: 1,
																										lang: 'en',
																										format: 'Y-m-d',
																										formatDate: 'Y-m-d',
																										minDate: 0,
																										mask: true,
																										yearStart: '<?php echo date('Y'); ?>',
																										timepicker: false
																									});
																									jQuery('#datepicker').datetimepicker({
																										dayOfWeekStart: 1,
																										lang: 'en',
																										format: 'Y-m-d',
																										formatDate: 'Y-m-d',
																										minDate: 0,
																										inline: true,
																										mask: true,
																										timepicker: false
																									});
																								});
																								$(document).ready(function () {
																									$('.xdsoft_today_button').trigger("mousedown");
																									$('.xdsoft_today_button').trigger("mouseup");
																								});
																							</script>
																							<script type="text/javascript" src="<?php echo base_url(); ?>assets/pop_plug/jquery.toastee.0.1.js"></script>
																							<div id="testy" style="margin: 0 auto;position: fixed;top:7.5%;width: 100%;z-index: 100;"></div>
																							<script>
																								function show_error(text) {
																									$('#testy').toastee({
																										header: 'Error!',
																										type: 'error',
																										message: text
																									});
																								}
																								function show_success(text) {
																									$('#testy').toastee({
																										type: 'success',
																										message: text
																									});
																								}

																							</script>
																							<script>
																								$(document).ready(function () {
																									$("#carPickUpLat").change(function () {
																										$('#carDropOffLat').val($("#carPickUpLat").val());
																										location_add();
																									});
																									$("#carPickUpLon").change(function () {
																										$('#carDropOffLon').val($("#carPickUpLon").val());
																										location_add();
																									});

																									function location_add() {
																										lat = $("#carPickUpLat").val();
																										lon = $("#carPickUpLon").val();
																										url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lon + '&key=<?php echo GOOGLE_MAP_API_KEY; ?>';
																										$.ajax({
																											url: url,
																											dataType: 'json',
																											success: function (data) {
																												result = data.results;
																												var lastItem = result.reverse();
																												var lastItem = lastItem.reverse()[0];
																												final = lastItem.formatted_address;
																												final = final.split(',').reverse();
																												//alert(final[0]);alert(final[1]);
																												country = final[0].trim();
																												city = final[1].trim();
																												$("#country_type option").each(function () {
																													this.selected = (this.text == country);
																												});
																												$("#city_list").val(city);
																											}
																										});
																									}


																								});
																							</script>
																							<script>
																								$(document).ready(function () {
																									$('input[name=carPlateNumber]').blur(function () {
																										var car_plate = $(this).val().toUpperCase();
																										$(this).val(car_plate);
																										var greece = /^[A-Z]{3}[0-9]{4}$/;
																										var cyprus = /^[A-Z]{3}[0-9]{3}$/;
																										var country = $('#country_type :selected').text().toLowerCase().trim();
																										if (country == "greece" && !car_plate.match(greece)) {
																											show_error('car number plate is not valid for ' + country);
																										}
																										if (country == "cyprus" && !car_plate.match(cyprus)) {
																											show_error('car number plate is not valid for ' + country);
																										}

																									});
																								});
																							</script>


																							<!-- Js files-->
																							<script type="text/javascript" src="<?php echo base_url(); ?>assets/cropper_sets/scripts/jquery.Jcrop.js"></script>
																							<script type="text/javascript" src="<?php echo base_url(); ?>assets/cropper_sets/scripts/jquery.SimpleCropper.js"></script>

																							<script>
																									// Init Simple Cropper
																									$('.cropme').simpleCropper();

																									$(document).ready(function () {
																										$('.cropper_delete').click(function () {
																											$(this).siblings("div .cropme").html('<a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/image/plus.png"> </a>');
																											$(this).css('display', "none");
																											$(this).siblings(".image_map").val('');
																											$(this).siblings(".image_holder").val('');
																										});
																									});

																									$(document).ready(function () {
																										$(".image_map").change(function () {
																											data = $(this).val();
																											data = data.replace("data:image/png;base64,", "");
																											data = $.trim(data);
																											jQuery.ajax({
																												context: this,
																												url: '<?php echo site_url('webservices/picture_upload/insert_car_picture_base'); ?>',
																												method: 'POST',
																												dataType: 'json',
																												async: false,
																												data: {
																													file_base: data
																												},
																												success: function (result) {
																													if (result.isSuccess == 1) {
																														data = result.Result;
																														$(this).siblings(".image_holder").val(data.file_name);
																													}
																												}
																											});

																										});
																									});

																							</script>		

																							</body>
																							</html>
