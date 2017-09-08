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
		<?php /* css for datetime picker  */ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>	
    </head>
    <body class="wrapper">
        <!--header-->

		<?php $this->load->view('include/head_block'); ?>

		<?php /* header end here */ ?>
		<form name="" id="filter_form_element" class="" method="" action="<?php echo site_url('user/find_car'); ?>">
			<input class="hide" value="<?php echo $this->input->get('city_string'); ?>" name="city_string" id="locality" disabled="true"/>
			<input class="hide" value="<?php echo $this->input->get('country_string'); ?>" name="country_string" id="country" disabled="true"/>
			<div class="clr"></div>
			<div class="find-car">
				<div class="findcar-top">
					<div class="top-view">
						<div class="sec">
							<i>At</i><input type="text" id="autocomplete" value="<?php echo ($this->input->get('autocomplete'))?$this->input->get('autocomplete'):""; ?>" name="autocomplete"   onFocus="geolocate()"  placeholder="Current Location">
							<img class="input-location-element"  src="<?php echo base_url();?>assets/image/loc-icon1.png">
						</div>
						<?php
						if ($this->input->get('car_from') == "" and $this->input->get('car_to') == "") {
							$from = date('Y-m-d H:00');
							$to = date('Y-m-d H:00', strtotime("+7 days"));
						} else {
							$from = $this->input->get('car_from');
							$to = $this->input->get('car_to');
						}
						$date_segment = array(
								'from_time'  => $from,
								'to_time'     => $to
								);

						$this->session->set_userdata($date_segment);
						?>
						<div class="sec">
							<i>From</i> <input type="text" name="car_from" value="<?php echo $this->session->userdata('from_time'); ?>"  id="date_timepicker_start" class="datetimepicker">
						</div>
						<div class="sec">
							<i>To</i> <input type="text" name="car_to"   value="<?php echo$this->session->userdata('to_time'); ?>"  id="date_timepicker_end" class="datetimepicker">
						</div>
						<div class="search">
							<a href="#"  ><img onclick="$('#filter_form_element').submit();"  src="<?php echo base_url(); ?>assets/image/search-icon1.png"></a>
						</div>

					</div>
				</div>
				<div class="clr"></div>



				<input type="hidden" id="filter_active_element" name="filter_active_element" value="<?php echo $this->input->get('filter_active_element') ?>" >
				<div class="find-car">
					<div class="clr"></div>
					<div class="findcar1-mid" id="">
						<div class="mid-left">
							<div class="filter-title">
								<ul>
									<li><a onclick=" $('#div_category_filter').hide(); $('#div_slider_filter').show();$('#filter_active_element').val('0');" href="#" class="filter-btn">Filter</a></li>
									<li><a onclick=" $('#div_slider_filter').hide(); $('#div_category_filter').show();$('#filter_active_element').val('1');"  href="#" class="category-btn">Categories</a></li>
								</ul>
							</div>
							<div class="clr"></div>

							<div class="filter-view <?php echo ($this->input->get('filter_active_element') == 1) ? 'hide' : 'show'; ?>" id="div_slider_filter">
								<div class="filter-sec">
									<label>Sort by</label>
									<div class="clr"></div>
									<select onchange="$(this.form).submit();" id="" name="daily_price_order" class="">
										<option value="">-- Select  Price --</option>
										<option  value="0">High to low</option>
										<option value="1">Low to high</option>
									</select>
								</div>
								<div class="clr"></div>
								<div class="filter-sec1">
									<label>Price</label>
									<div class="clr"></div>
									<input name="price_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('price_ranger') != "") ? $this->input->get('price_ranger') : '500'; ?>"/>
									<sup class="price_ranger_span text-white  width-100 center"></sup>
									<div class="clr"></div>
								</div>  
								<div class="clr hide"></div>
								<div class="filter-sec hide">
									<label>Vehicle type</label>
									<div class="clr"></div>
									<select id="" onchange="$(this.form).submit();"  name="type" class="">
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
									<label>Vehicle make</label>
									<div class="clr"></div>
									<select id="" onchange="$(this.form).submit();"  name="make" class="">
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
									<label>Vehicle model</label>
									<div class="clr"></div>
									<select id="" onchange="$(this.form).submit();"  name="model" class="">

									</select>
								</div>	

								<div class="clr"></div>
								<div class="filter-sec">
									<label>Transmission</label>
									<div class="clr"></div>
									<select id="" onchange="$(this.form).submit();"  name="Transmission" class="">
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
									<label>Kilometer</label>
									<div class="clr"></div>
									<div class="theme-bar-inverse">
										<input name="distance_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('distance_ranger') != "") ? $this->input->get('distance_ranger') : '50'; ?>"/>
									</div>
									<sup class="text-white  distance_ranger_span width-100 center"></sup>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>
								<div class="filter-sec1">
									<label>Car Year</label>
									<div class="clr"></div>
									<div class="theme-bar-inverse">
									<input name="year_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('year_ranger') != "") ? $this->input->get('year_ranger') : '1996'; ?>"/>
                                    </div> 
                                    <sup class="text-white year_ranger_span width-100 center"></sup>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>
								<div class="filter-sec1">
									<label>Delivery Options</label>
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
										<sup>Yes</sup><input <?php echo $ranger_yes; ?> value="1" onclick="$('#delivery_option_element').show();$(this.form).submit();" type="radio" name="deliveryOption" > &nbsp;&nbsp;&nbsp;&nbsp; <sup>No</sup><input value="0" onclick="$('#delivery_option_element').hide();$(this.form).submit();" name="deliveryOption" <?php echo $ranger_no; ?>  type="radio">  
									</div>
								</div>
								<div class="clr"></div>
								<div id="delivery_option_element" style="display:<?php echo ($this->input->get('deliveryOption') == 1) ? "" : "none"; ?>;" class="filter-sec1">
									<label>Delivery Charges </label>
									<div class="clr"></div>

									<input name="delievery_ranger" class="range-slider" type="hidden" value="<?php echo ($this->input->get('delievery_ranger') != "") ? $this->input->get('delievery_ranger') : '100'; ?>"/>
									<sup class="text-white delievery_ranger_span width-100 center"></sup>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>

							</div>

							<div class="filter-cat <?php echo ($this->input->get('filter_active_element') == 1) ? 'show' : 'hide'; ?>" id="div_category_filter">
								<div class="filter-cat-sec">
									<div class="cat-box cursor <?php echo ($this->input->get('type') == "" )?" box-active":'';?> " onclick="$('select[name=type]').val(''); $('#filter_form_element').submit();">
											<img src="<?php echo base_url() . 'assets/image/all-category.png' ?>" >
											<div class="image-overlay-element"></div>
									</div>
								</div><div class="clr"></div>	
								<?php
								foreach ($car_types as $ct) {
									?>
									<div class="filter-cat-sec">
										<div class="cat-box cursor <?php echo ($ct['id'] == $this->input->get('type') )?" box-active":'';?>" onclick="$('select[name=type]').val('<?php echo $ct['id']; ?>'); $('#filter_form_element').submit();">
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
								<?php
								if (count($car_data) < 1) {

									echo "<div class='filter-img center '><img src='".base_url()."assets/image/no_car_found.png'></div>";
								}else{
									
									foreach ($car_data as $cd) { ?>
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
												   <div class="txt1"><img src="<?php echo $user_image; ?>"><br><h4><?php echo current(explode(' ',$cd['get_username'])) ; ?></h4></div>
												   <div class="txt2"><h2 class="no-margin"><?php echo $cd['get_make_name'] . ' ' . $cd['get_model_name']; ?> <!--<span>10 miles away</span>--></h2><p class="text-white no-margin "><?php echo $cd['get_city_name']; ?></p></div>
												   <div class="txt1 "><div class="margin-right" >&euro;<?php echo $cd['price_daily']; ?> per day</div></div>
											   </div>
										   </div>
									   </a>	
								   <?php } 										
								   }
								?>

							</div>
						</div>
					</div>
				</div>
			</div>	
		</form>		

		<?php  /* testing for google map start here */ ?>

			<div class="entry-content">

								<div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map">
					<div id="google-map" class="google-map">
					</div><!-- #google-map -->
				</div>

		<?php  /* testing for google map end here */ ?>



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
                                                    from: 1996,
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
					       minDate:'-1970/01/01',
					       defaultDate:new Date(),
                                                    yearStart: '<?php echo date('Y'); ?>',
                                                    onShow: function (ct) {
                                                        this.setOptions({
                                                            maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false							
                                                        })
                                                    },
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
                                                               minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false
										
                                                        })
                                                    },
                                                    timepicker: true
                                                });
                                            });
		</script>

		<script>


            var placeSearch, autocomplete;
            var componentForm = {
                locality: 'long_name',
                country: 'long_name'
            };

            function initAutocomplete() {
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
		</script>
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4k_yaHxFSshhJWRobfVwcnEMZ3nIzx9c&libraries=places&callback=initAutocomplete"
        async defer></script>-->
        <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/gmaps.js"></script>

		<script>

            $(document).ready(function () {
                $(".pointer").mousedown(function () {

                    $(this).after(function () {
                        $(document).mouseup(function () {
                            $('#filter_form_element').submit();
                        });
                    });
                });


                $("input[name=price_ranger]").change(function(){
                	if($(this).val() == 500){
                		$('.price_ranger_span').html('Any price');   
                	}else{
				    	$('.price_ranger_span').html('€ '+$(this).val()+' /day or less');                	
					}
				}).change();


                $("input[name=year_ranger]").change(function(){
				    $('.year_ranger_span').html( $(this).val()+' to now');
				}).change();

                $("input[name=distance_ranger]").change(function(){
				    $('.distance_ranger_span').html( $(this).val()+' km/day to more');
				}).change();

                $("input[name=delievery_ranger]").change(function(){
  					if($(this).val() == 100){
  						$('.delievery_ranger_span').html(' Any delivery fee');
  					}else if($(this).val() == 0){
  						$('.delievery_ranger_span').html(' Free delivery');
  					}else{
  						$('.delievery_ranger_span').html('€ '+$(this).val()+' delivery fee or less');
  					}  					
				    
				
				}).change();

            });




		</script>

		<?php  /* testing for google map start here */ ?>

		<script>
			jQuery( document ).ready( function($) {

					var is_touch_device = 'ontouchstart' in document.documentElement;

					var map = new GMaps({
						el: '#google-map',
						lat: <?php echo $car_data[0]['carPickUpLat']; ?>,
						lng: <?php echo $car_data[0]['carPickUpLon']; ?>,
						//scrollwheel: false,
						draggable: ! is_touch_device
					});


					var bounds = [];
						<?php foreach ($car_data as $cd) { ?> 

							/* Set Bound Marker */
							var latlng = new google.maps.LatLng(<?php echo $cd['carPickUpLat']; ?>, <?php echo $cd['carPickUpLon']; ?>);
							bounds.push(latlng);
							/* Add Marker */
							map.addMarker({
								lat: <?php echo $cd['carPickUpLat']; ?>,
								lng:  <?php echo $cd['carPickUpLon']; ?>,
								//title: '',
								infoWindow: {
									content: "<?php echo $cd['carPickUpLocation']; ?>"
								},
								icon:"<?php echo base_url(); ?>assets/image/cars_on_map.png"
							});

						<?php } ?>
		
					
					map.fitLatLngBounds(bounds);
					var $window = $(window);
					function mapWidth() {
						var size = $('.google-map-wrap').width();
						$('.google-map').css({width: size + 'px', height: (size/2) + 'px'});
					}
					mapWidth();
					$(window).resize(mapWidth);

				});
			
				</script>		

		<?php  /* testing for google map end here */ ?>


	</body>
</html>
