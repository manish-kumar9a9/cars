<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
		<link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/components/imgareaselect/css/imgareaselect-default.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.range.css">
		<?php /* css for datetime picker  */ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>

		<?php $this->load->view('include/head_block'); ?>

		<?php /* header end here */ ?>
	<form autocomplete="off"  id="filter_form_element"  action="<?php echo site_url('user/find_car'); ?>">
		<input class="hide" value="<?php echo $this->input->get('city_string'); ?>" name="city_string" id="locality" />
		<input class="hide" value="<?php echo $this->input->get('country_string'); ?>" name="country_string" id="country" />

		<input class="hide" value="<?php echo $this->input->get('find_lon'); ?>" name="find_lon" id="lon_string" />
		<input class="hide" value="<?php echo $this->input->get('find_lat'); ?>" name="find_lat" id="lat_string" />

		<div class="clr"></div>

		<div class="find-car">
			<div class="findcar-top">
				<div class="top-view">
					<div class="sec">
						<i><?php echo $this->lang->line('AT'); ?></i><input type="text" id="autocomplete" value="<?php echo ($this->input->get('autocomplete')) ? $this->input->get('autocomplete') : ""; ?>" name="autocomplete"   onFocus="geolocate()"  placeholder="<?php echo $this->lang->line('CURRENT_LOCATION'); ?>">
						<img class="input-location-element"  src="<?php echo base_url(); ?>assets/image/loc-icon1.png">
					</div>
					<?php
					if ($this->input->get('car_from') == "" and $this->input->get('car_to') == "") {
						$from = date('Y-m-d H:00', strtotime('+4 hours'));
						$to = date('Y-m-d H:00', strtotime("+7 days"));
					} else {
						$from = $this->input->get('car_from');
						$to = $this->input->get('car_to');
					}
					$date_segment = array(
						'from_time' => $from,
						'to_time' => $to
					);

					$this->session->set_userdata($date_segment);
					?>
					<div class="sec">
						<i><?php echo $this->lang->line('FROM'); ?></i> <input type="text" name="car_from" value="<?php echo $this->session->userdata('from_time'); ?>"  id="date_timepicker_start" class="datetimepicker">
					</div>
					<div class="sec">
						<i><?php echo $this->lang->line('TO'); ?></i> <input type="text" name="car_to"   value="<?php echo$this->session->userdata('to_time'); ?>"  id="date_timepicker_end" class="datetimepicker">
					</div>
					<div class="search">
						<a href="#"  ><img onclick="search_records();"  src="<?php echo base_url(); ?>assets/image/search-icon1.png"></a>
					</div>

				</div>
			</div>
		</div>
		<div class="clr"></div>



		<input type="hidden" id="filter_active_element" name="filter_active_element" value="<?php echo $this->input->get('filter_active_element') ?>" >
		<div class="find-car">
			<div class="clr"></div>
			<div class="findcar1-mid" >
				<div class="mid-left">
					<div class="filter-title">
						<ul>
							<li><a onclick=" $('#div_category_filter').hide(); $('#div_slider_filter').show();$('#filter_active_element').val('0');" href="#" class="filter-btn"><?php echo $this->lang->line('FILTER'); ?></a></li>
							<li><a onclick=" $('#div_slider_filter').hide(); $('#div_category_filter').show();$('#filter_active_element').val('1');"  href="#" class="category-btn"><?php echo $this->lang->line('CATEGORIES'); ?></a></li>
						</ul>
					</div>
					<div class="clr"></div>

					<div class="filter-view <?php echo ($this->input->get('filter_active_element') == 1) ? 'hide' : 'show'; ?>" id="div_slider_filter">
						<div class="filter-sec">
							<label><?php echo $this->lang->line('SORT_BY'); ?></label>
							<div class="clr"></div>
							<select onchange="search_records();"  name="daily_price_order" class="">
								<option value="">-- Select  Price --</option>
								<option  value="0">High to low</option>
								<option value="1">Low to high</option>
							</select>
						</div>
						<div class="clr"></div>
						<div class="filter-sec1">
							<label><?php echo $this->lang->line('PRICE'); ?></label>
							<div class="clr"></div>
							<input name="price_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('price_ranger') != "") ? $this->input->get('price_ranger') : '500'; ?>"/>
							<sup class="price_ranger_span text-white  width-100 center"></sup>
							<div class="clr"></div>
						</div>
						<div class="clr hide"></div>
						<div class="filter-sec hide">
							<label>Vehicle type</label>
							<div class="clr"></div>
							<select onchange="search_records();"  name="type" class="">
								<?php
								echo "<option value=''>--Select Type--</option>";
								foreach ($car_types as $ct) {
									echo "<option value='" . $ct['id'] . "'>" . $ct['name'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="clr"></div>
						<div class="filter-sec">
							<label><?php echo $this->lang->line('VEHICLE_MAKE'); ?></label>
							<div class="clr"></div>
							<select  onchange="search_records();"  name="make" class="">
								<?php
								echo "<option value=''>--Select Make--</option>";
								foreach ($car_makers as $cm) {
									echo "<option value='" . $cm['id'] . "'>" . $cm['name'] . "</option>";
								}
								?>
							</select>
						</div>

						<div class="clr"></div>
						<div class="filter-sec">
							<label><?php echo $this->lang->line('VEHICLE_MODEL'); ?></label>
							<div class="clr"></div>
							<select  onchange="search_records();"  name="model" class="">

							</select>
						</div>

						<div class="clr"></div>
						<div class="filter-sec">
							<label><?php echo $this->lang->line('TRANSMISSION'); ?></label>
							<div class="clr"></div>
							<select  onchange="search_records();"  name="Transmission" class="">
								<?php
								echo "<option value=''>--Select Transmission--</option>";
								foreach ($transmission_types as $tt) {
									echo "<option value='" . $tt['id'] . "'>" . $tt['transmission'] . "</option>";
								}
								?>
							</select>
						</div>
						<div class="clr"></div>
						<div class="filter-sec1">
							<label><?php echo $this->lang->line('KILOMETER'); ?></label>
							<div class="clr"></div>
							<div class="theme-bar-inverse">
								<input name="distance_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('distance_ranger') != "") ? $this->input->get('distance_ranger') : '50'; ?>"/>
							</div>
							<sup class="text-white  distance_ranger_span width-100 center"></sup>
							<div class="clr"></div>
						</div>
						<div class="clr"></div>
						<div class="filter-sec1">
							<label><?php echo $this->lang->line('CAR_YEAR'); ?></label>
							<div class="clr"></div>
							<div class="theme-bar-inverse">
								<input name="year_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('year_ranger') != "") ? $this->input->get('year_ranger') : date("Y") - get_web_meta_data('car_element_year'); ?>"/>
							</div>
							<sup class="text-white year_ranger_span width-100 center"></sup>
							<div class="clr"></div>
						</div>
						<div class="clr"></div>
						<div class="filter-sec1">
							<label><?php echo $this->lang->line('DELIVERY_OPTIONS'); ?></label>
							<div class="clr"></div>
							<div class="radio">
								<?php
								$ranger_yes = $ranger_no = "";
								if ($this->input->get('deliveryOption') == 1) {
									$ranger_yes = "checked";
								} else {
									$ranger_no = "checked";
								}
								?>
								<sup><?php echo $this->lang->line('YES'); ?></sup><input <?php echo $ranger_yes; ?> value="1" onclick="$('#delivery_option_element').show();search_records();" type="radio" name="deliveryOption" > &nbsp;&nbsp;&nbsp;&nbsp; <sup><?php echo $this->lang->line('NO'); ?></sup><input value="0" onclick="$('#delivery_option_element').hide();search_records();" name="deliveryOption" <?php echo $ranger_no; ?>  type="radio">
							</div>
						</div>
						<div class="clr"></div>
						<div id="delivery_option_element" style="display:<?php echo ($this->input->get('deliveryOption') == 1) ? "" : "none"; ?>;" class="filter-sec1">
							<label><?php echo $this->lang->line('DELIVERY_CHARGES'); ?> </label>
							<div class="clr"></div>

							<input name="delievery_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('delievery_ranger') != "") ? $this->input->get('delievery_ranger') : '100'; ?>"/>
							<sup class="text-white delievery_ranger_span width-100 center"></sup>
							<div class="clr"></div>
						</div>
						<div class="clr"></div>

					</div>

					<div class="filter-cat <?php echo ($this->input->get('filter_active_element') == 1) ? 'show' : 'hide'; ?>" id="div_category_filter">
						<div class="filter-cat-sec">
							<div class="cat-box cursor <?php echo ($this->input->get('type') == "" ) ? " box-active" : ''; ?> " onclick="$('select[name=type]').val(''); search_records();">
								<img src="<?php echo base_url() . 'assets/image/all-category.png' ?>" >
								<div class="image-overlay-element"></div>
							</div>
						</div><div class="clr"></div>
						<?php
						foreach ($car_types as $ct) {
							?>
							<div class="filter-cat-sec">
								<div class="cat-box cursor <?php echo ($ct['id'] == $this->input->get('type') ) ? " box-active" : ''; ?>" onclick="$('select[name=type]').val('<?php echo $ct['id']; ?>'); search_records();">
									<img src="<?php echo base_url() . 'uploads/' . $ct['category_image'] ?>" >
									<div class="image-overlay-element"><?php echo $ct['name']; ?></div>
								</div>
							</div>
							<div class="clr"></div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="mid-right">
					<div class="filter-rit">
						<div class="view-section" style="width: 100%;margin-bottom: 46px;text-align: center;">
							<div class="tab-box margin-bottom" style="float: right;width: 25%;border: 1px solid #00ae9e;">
								<style>
									.result_record_active{
										background-color: #00ae9e;color: #fff;
									}
								</style>
								<a href="#" onClick="$('input:radio[id=result_page_view_map]').prop('checked', true);search_records();" >
									<div class=" <?php echo ($this->input->get('result_page_view') == "map") ? 'result_record_active' : ''; ?> " style="float: left;width: 50%;padding-top: 6px;padding-bottom: 6px;">
										<?php echo $this->lang->line('MAP'); ?>
										<input type="radio" id="result_page_view_map" name="result_page_view" value="map" style="display:none" <?php echo ($this->input->get('result_page_view') == "map") ? 'checked' : ''; ?> />
									</div></a>
								<a href="#" onClick="$('input:radio[id=result_page_view_list]').prop('checked', true);$('#filter_form_element').submit();" >
									<div class=" <?php echo ($this->input->get('result_page_view') !== "map") ? 'result_record_active' : ''; ?> " style="float: left;width: 50%;padding-top: 6px;padding-bottom: 6px;">
										<input type="radio"  id="result_page_view_list" name="result_page_view" value="list" style="display:none" <?php echo ($this->input->get('result_page_view') !== "map") ? 'checked' : ''; ?>>
										<?php echo $this->lang->line('LIST'); ?>
									</div>
								</a>
							</div>

							<?php
							if (count($car_data) < 1) {

								echo "<div class='filter-img center '><img src='" . base_url() . "assets/image/no_car_found.png'></div>";
							} else {
								if ($this->input->get('result_page_view') == "map") {
									?>
									<div id="map_wrapper">
										<div id="map_canvas" class="mapping"></div>
									</div>
									<?php
								} else {
									foreach ($car_data as $cd) {
										?>
										<a href="<?php echo site_url('user/car_data/' . $cd['id']) ?>?car_from=<?php echo $from; ?>&car_to=<?php echo $to; ?>">
											<div class="filter-img">
												<img src="<?php echo (isset($cd['car_images'][0]['CarImage_path'])) ? $cd['car_images'][0]['CarImage_path'] : ''; ?>" />
												<div class="img-txt">
													<?php
													$user_image = base_url() . "assets/image/Icon-user-1.png";
													if ($cd['get_user_image'] != "") {
														$user_image = $cd['get_user_image'];
													}
													?>
													<div class="txt1"><img src="<?php echo $user_image; ?>"><br><h4><?php echo current(explode(' ', $cd['get_username'])); ?></h4></div>
													<div class="txt2"><h2 class="no-margin"><?php echo $cd['get_make_name'] . ' ' . $cd['get_model_name']; ?> <!--<span>10 miles away</span>--></h2><p class="text-white no-margin "><?php echo $cd['get_city_name']; ?></p></div>
													<div class="txt1 "><div class="margin-right" >&euro;<?php echo $cd['price_daily']; ?> <?php echo $this->lang->line('PER_DAY'); ?></div></div>
												</div>
											</div>
										</a>
										<?php
									}
								}
							}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>

	</form>

	<!--footers-->
	<?php $this->load->view('include/footer_block'); ?>
	<!--/footer-->


	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	<?php /* to open header drop down */ ?>
	<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.range.js"></script>
	<script type="text/javascript">
                                    function get_car_model() {
                                        m_id = jQuery("select[name=make]").val();
                                        jQuery.ajax({
                                            url: '<?php echo base_url('index.php/user/call_car_model'); ?>',
                                            method: 'POST',
                                            dataType: 'json',
                                            async: false,
                                            data: {
                                                id: m_id
                                            },
                                            success: function (data) {
                                                if (data.status == 1) {
                                                    jQuery("select[name=model]").html(data.html);
                                                }
                                            }
                                        });
                                    }
                                    $(document).ready(function () {

                                        $("select[name=daily_price_order]").val("<?php echo $this->input->get('daily_price_order') ?>");
                                        $("select[name=make]").val("<?php echo $this->input->get('make') ?>");
                                        $("select[name=type]").val("<?php echo $this->input->get('type') ?>");
                                        $("select[name=Transmission]").val("<?php echo $this->input->get('Transmission') ?>");
                                        $.when(get_car_model()).done(function () {
                                            $("select[name=model]").val("<?php echo $this->input->get('model') ?>");
                                        });

//                                            $(".pointer").click(function() {
//                                                $('#filter_form_element').submit();
//                                            });

                                    });


                                    $(document).ready(function () {

                                        $("input[name=price_ranger]").jRange({
                                            from: 15,
                                            to: 500,
                                            step: 1,
                                            /*scale: [0, 25, 50, 75, 100],*/
                                            format: '%s',
                                            width: 330,
                                            showLabels: true,
                                            snap: true
                                        });


                                        $("input[name=distance_ranger]").jRange({
                                            from: 50,
                                            to: 500,
                                            step: 1,
                                            /* scale: [0, 25, 50, 75, 100],*/
                                            format: '%s',
                                            width: 330,
                                            showLabels: true,
                                            snap: true
                                        });

                                        $("input[name=delievery_ranger]").jRange({
                                            from: 0,
                                            to: 100,
                                            step: 1,
                                            /* scale: [0, 25, 50, 75, 100],*/
                                            format: '%s',
                                            width: 330,
                                            showLabels: true,
                                            snap: true
                                        });

                                        $("input[name=year_ranger]").jRange({
                                            from: <?php echo date('Y') - get_web_meta_data('car_element_year'); ?>,
                                            to: <?php echo date('Y') ?>,
                                            step: 1,
                                            /*scale: [0, 25, 50, 75, 100],*/
                                            format: '%s',
                                            width: 330,
                                            showLabels: true,
                                            snap: true
                                        });
                                    });


	</script>
	<?php /* js for date time picker */ ?>
	<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
	<script>

                                    jQuery(function () {
                                        jQuery('#date_timepicker_start').datetimepicker({
                                            dayOfWeekStart: 1,
                                            lang: 'en',
                                            format: 'Y-m-d H:i',
                                            formatTime: 'H:i',
                                            formatDate: 'Y-m-d',
                                            minDate: '-1970/01/01',
                                            defaultDate: new Date(),
                                            yearStart: '<?php echo date('Y'); ?>',
                                            onShow: function (ct) {
                                                this.setOptions({
                                                    maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false,
                                                    minTime: false//select only current time and next time
                                                })
                                            },
                                            //for current date select  currnet time         
//                                            onSelectDate: function (date) {
//                                                var seldate = $('#date_timepicker_start').val();
//                                                var selectdate = seldate.split(" ");
//                                                var curdate = '<?php echo date('Y-m-d'); ?>';
//                                                if (selectdate[0] != curdate) {
//                                                    var minTimeVal = false
//                                                } else {
//                                                    var minTimeVal = true
//                                                }
//                                                this.setOptions({
//                                                    //minTime: minTimeVal
//                                                });
//                                            },
                                            //end       
                                            timepicker: true
                                        });
                                        jQuery('#date_timepicker_end').datetimepicker({
                                            dayOfWeekStart: 1,
                                            lang: 'en',
                                            format: 'Y-m-d H:i',
                                            formatTime: 'H:i',
                                            formatDate: 'Y-m-d',
                                            yearStart: '<?php echo date('Y'); ?>',
                                            onShow: function (ct) {
                                                this.setOptions({
                                                    minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false,
                                                    // minTime:  true//select only current time and next time


                                                })
                                            },
                                            //for current date select  currnet time         
                                            onSelectDate: function (date) {
                                                var seldate = $('#date_timepicker_end').val();
                                                var selectdate = seldate.split(" ");
                                                var curdate = '<?php echo date('Y-m-d'); ?>';
                                                if (selectdate[0] != curdate) {
                                                    var minTimeVal = false;
                                                } else {
                                                    var minTimeVal = true
                                                }
                                                this.setOptions({
                                                    minTime: minTimeVal
                                                });
                                            },
                                            //end           
                                            timepicker: true
                                        });
                                    });
	</script>

	<?php /* Css for car box code start now */ ?>

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<style type="text/css">
		.car-box-image{ width: 250px;	border:2px solid #00ae9e;padding: 10px;		border-radius: 8px;		float: left;	}

		.car-image img{		width: 100%;	}

		.car-name-section h3{		font-size: 16px;		margin-top: 5px;		margin-bottom: 2px;		white-space: nowrap;    	overflow: hidden;    	text-overflow: ellipsis;	}

		.car-name-section{		float: left;		width: 70%;	}

		.car-price-section{		float: left;		width: 30%;	}
		.car-price-section h5{		margin-top: 0px;		margin-bottom: 5px;		/*font-family: "roboto condensed";*/		color: #6e6d6d;		font-size:20px;		text-align: right;		position: relative;		top: 10px;	}

		.car-name-price{ width: 100%; height: auto }

		.per-day{		font-size: 14px;		position: relative;		top: -8px;	}

		@media screen and (max-width: 980px){
			.car-box-image{		width: 80%;			margin: auto;			border:2px solid #00ae9e;			padding: 10px;		}
		}
	</style>

	<?php /* Css for car box code end now */ ?>


	<script>

        $(document).ready(function () {
            $(".pointer").mousedown(function () {

                $(this).after(function () {
                    $(document).mouseup(function () {
                        search_records();
                    });
                });
            });


            $("input[name=price_ranger]").change(function () {
                if ($(this).val() == 500) {
                    $('.price_ranger_span').html('<?php echo $this->lang->line('ANY_PRICE'); ?>');
                } else {
                    $('.price_ranger_span').html('€ ' + $(this).val() + ' <?php echo $this->lang->line('DAY_OR_LESS'); ?>');
                }
            }).change();


            $("input[name=year_ranger]").change(function () {
                $('.year_ranger_span').html($(this).val() + ' <?php echo $this->lang->line('TO_NOW'); ?>');
            }).change();

            $("input[name=distance_ranger]").change(function () {
                $('.distance_ranger_span').html($(this).val() + ' <?php echo $this->lang->line('KM_PER_DAY_TO_MORE'); ?>');
            }).change();

            $("input[name=delievery_ranger]").change(function () {
                if ($(this).val() == 100) {
                    $('.delievery_ranger_span').html(' <?php echo $this->lang->line('any_delivery_fee'); ?>');
                } else if ($(this).val() == 0) {
                    $('.delievery_ranger_span').html(' <?php echo $this->lang->line('free_delivery'); ?>');
                } else {
                    $('.delievery_ranger_span').html('€ ' + $(this).val() + ' <?php echo $this->lang->line('delivery_fee_or_less'); ?>');
                }


            }).change();

        });
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&libraries=places&callback=initAutocomplete"
	async defer></script>
	<?php
	if (count($car_data) > 0 && $this->input->get('result_page_view') == "map") {
		?>
		<script>
		function initialize() {


			var map;
			var bounds = new google.maps.LatLngBounds();
			var mapOptions = {
				mapTypeId: 'roadmap'
			};

			// Display a map on the page
			map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			map.setTilt(45);


	<?php
	$i = 1;
	$max = count($car_data);
	$markers = $info_window = "";
	foreach ($car_data as $cd) {

		$pickuplat = $cd['carPickUpLat'];
		$pickuplon = $cd['carPickUpLon'];
		$markers .= "['',$pickuplat,$pickuplon]";

		$car_image = (isset($cd["car_images"][0]["CarImage_path"])) ? $cd["car_images"][0]["CarImage_path"] : "";
		$make_model = $cd['get_make_name'] . ' ' . $cd['get_model_name'];
		$price = $cd['price_daily'];

		$info_window .= '["' . "<div class='car-box-image'><div class='car-image'><img src='$car_image'/></div><div class='car-name-price'><div class='car-name-section'><h3> $make_model </h3></div><div class='car-price-section'><h5>&euro; $price <br><span class='per-day'>Per Day</span></h5></div></div></div>" . '"]';
		if ($i != $max) {
			$markers = $markers . ",";
			$info_window = $info_window . ",";
		}
		$i++;
	}
	?>

			// Multiple Markers
			var markers = [<?php echo $markers; ?>
			];

			// Info Window Content
			var infoWindowContent = [<?php echo $info_window; ?>
			];

			// Display multiple markers on a map
			var infoWindow = new google.maps.InfoWindow(), marker, i;

			// Loop through our array of markers & place each one on the map
			for (i = 0; i < markers.length; i++) {
				var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map,
					//title: markers[i][0]
					icon: "<?php echo base_url(); ?>assets/image/cars_on_map.png"
				});

				// Allow each marker to have an info window
				google.maps.event.addListener(marker, 'click', (function (marker, i) {
					return function () {
						infoWindow.setContent(infoWindowContent[i][0]);
						infoWindow.open(map, marker);
					}
				})(marker, i));

				// Automatically center the map fitting all markers on the screen
				map.fitBounds(bounds);
			}

			// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
			var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
				this.setZoom(5);
				google.maps.event.removeListener(boundsListener);
			});

		}
		</script>
		<style>
			#map_wrapper {
				height: 400px;
			}

			#map_canvas {
				width: 100%;
				height: 100%;
			}
		</style>
		<?php
	}
	?>

	<script>
        var placeSearch, autocomplete;
        var componentForm = {
            /*locality: 'long_name',
             country: 'long_name'*/
        };

        function initAutocomplete() {
<?php if (count($car_data) > 0 && $this->input->get('result_page_view') == "map") { ?>
	            initialize();
<?php } ?>
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                    {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.

            var place = autocomplete.getPlace();

            document.getElementById('lat_string').value = place.geometry.location.lat();
            document.getElementById('lon_string').value = place.geometry.location.lng();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        $(document).ready(function () {
            $("#autocomplete").keyup(function () {
                str = $.trim($("#autocomplete").val());
                if (str == "") {
                    $('#lon_string').val('');
                    $('#lat_string').val('');

                }
            });
        });

        $(document).ready(function () {
            var preUrl = document.referrer;
            var res = preUrl.split('?');
            var currentUrl = location.href.split('?') [0];
            if (navigator.geolocation && res[0] != currentUrl) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });

                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + geolocation['lat'] + ',' + geolocation['lng'] + '&key=<?php echo GOOGLE_MAP_API_KEY; ?>',
                        success: function (data) {
                            $('#autocomplete').val(data.results[0].formatted_address);
                            $('#lon_string').val(geolocation['lat']);
                            $('#lat_string').val(geolocation['lng']);
                            $('#filter_form_element').submit();
                        }
                    });
                    autocomplete.setBounds(circle.getBounds());
                }
                );
            }
        });



	</script>
	<!-- Modal popup script starts -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Modal popyp script ends -->

	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script>

        function search_records() {

            if (validate_date() == false) {
                $('#filter_form_element').submit();
            } else {
                $('#page_pop_error_element').modal();
            }
        }

        function validate_date() {
            var from_date = $('#date_timepicker_start').val();
            dateTimeParts = from_date.split(' '),
                    timeParts = dateTimeParts[1].split(':'),
                    dateParts = dateTimeParts[0].split('-'),
                    date;
            var from_date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);

            var to_date = $('#date_timepicker_end').val();
            dateTimeParts = to_date.split(' '),
                    timeParts = dateTimeParts[1].split(':'),
                    dateParts = dateTimeParts[0].split('-'),
                    date;
            var to_date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);

            from_date = Number(from_date);
            to_date = Number(to_date);
            diff = to_date - from_date;
            diff = diff / (1000 * 60 * 60);
	   minimum_hours =  4 ; 		
		

            var from_date = $('#date_timepicker_start').val();
            dateTimeParts = from_date.split(' '),
                    timeParts = dateTimeParts[1].split(':'),
                    dateParts = dateTimeParts[0].split('-'),
                    date;
            var date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);
            var current_date = new Date();
            console.log(date);
            var increment_date_time = new Date();
            increment_date_time.setHours(current_date.getHours() + 2);
            increment_date_time.setMinutes(current_date.getMinutes() + 30);
            increment_date_time.setSeconds(00);
            increment_date_time.setMilliseconds(000);
            /* time after 2:30 lator*/
            if (increment_date_time.getMinutes() > 0 && increment_date_time.getMinutes() <= 29) {
                increment_date_time.setMinutes(increment_date_time.getMinutes() + (30 - increment_date_time.getMinutes()));
            } else if (increment_date_time.getMinutes() >= 31 && increment_date_time.getMinutes() <= 59) {
                increment_date_time.setMinutes(increment_date_time.getMinutes() + (60 - increment_date_time.getMinutes()));
            }
            console.log(Number(date));
            console.log(Number(increment_date_time));

            if (new Date(date) < new Date(increment_date_time)) {
                var text = "<?php echo $this->lang->line('CAR_REQUEST_NOT_ACCEPTABLE_BEFORE'); ?> " + increment_date_time;
                document.getElementById("page_pop_error_element-message").innerHTML = text;
            } else if(diff < minimum_hours ){
		   
	       var text = "<?php echo $this->lang->line('CAR_REQUEST_MINIMUM_HOURS'); ?>";
                document.getElementById("page_pop_error_element-message").innerHTML = text;      
	   }else {
                return false;
            }

        }
	</script>

	<div class="modal fade"  id="page_pop_error_element" style="z-index:9999999;" role="dialog">
		<div class="modal-dialog modal-dialog-new">

			<!-- Modal content-->
			<div class="modal-content modal-content-new">

				<div class="modal-body text-center">
					<i class="fa  fa-clock-o fa-4x"></i>
					<p id="page_pop_error_element-message"></p>
				</div>

			</div>
		</div>
	</div>		
</body>

</html>
