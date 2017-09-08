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
		 <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  
		<?php /* css for datetime picker  */ ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>

		<?php $this->load->view('include/head_block'); ?>



<?php
 /* header end here */
    $params = array('id' => $this->input->get('car_id'));
    $ch = curl_init(site_url() . '/service_get_single_car_data');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, True);
    $data['car_data'] = $result['Result'];
//echo "<pre>";print_r($data);
    ?>
		<div class="findcar-no-bg">

			<form name="" action="#" method="get" id="form_id">
				<div class="findcar-inner">
					<div class="findstep3">
                              <input type="hidden" name="car_delivery_status" value="<?php echo $this->input->get('car_delivery_status');?>">
						<input type="hidden" name='car_id' value="<?php echo $this->input->get('car_id'); ?>">
						<div class="step3-lft">
							<?php
							if ($this->input->get('car_from') == "" and $this->input->get('car_to') == "") {
								$from = date('Y-m-d H:i');
								$to = date('Y-m-d H:i', strtotime("+7 days"));
							} else {
								$from = $this->input->get('car_from');
								$to = $this->input->get('car_to');
							}
							?>
							<h2>CHECK AVAILABILITY</h2>

							<div class="clr"></div>
							<ul><li>Proposed trip start Date & Time</li></ul>
							<div class="clr"></div>
							<div class="slct">

								<input  autocomplete="off" type="text" id="datetimepicker_from"  name="car_from" value="<?php echo $from; ?>" class=" theme-input-box datetimepicker"  >
							</div>
							<div class="clr"></div>
							<ul><li>Proposed trip end Date & Time</li></ul>
							<div class="clr"></div>
							<div class="slct">
								<input autocomplete="off"  type="text" id="datetimepicker_to"  name="car_to" value="<?php echo $to; ?>" class=" theme-input-box datetimepicker"   >
							</div>
                                                        <?php if($data['car_data']['deliveryOption']=='1'){?> 
                                                       <div class="clr"></div>
							<ul><li>Delivery Option</li></ul>
							<div class="clr"></div>
							<div class="slct">
                                                            <input <?php if($this->input->get('car_delivery_status')=='1'){?>checked=""<?php }?>   type="radio" id="delivery_option_id"  name="delivery_option" value="1"   >Yes
                                                                <input <?php if($this->input->get('car_delivery_status')=='0'){?>checked=""<?php }?>    type="radio" id="delivery_option_id"  name="delivery_option" value="0" >NO
							</div>
                                                      <?php }?>
                                                        
                <?php if($this->input->get('car_delivery_status')==1){?>
              <div class="clr"></div>
                <ul><li>Pickup Place</li></ul>
                  <div class="clr"></div>
              <div class="slct">

                          <input name="carPickUpLat" id="carPickUpLat"  type="hidden" placeholder="" <?php if(!empty($this->input->get('carPickUpLat'))){?> value="<?php echo $this->input->get('carPickUpLat');?>"<?php  } ?>>
                          <input name="carPickUpLon" id="carPickUpLon"  type="hidden" placeholder="" <?php if(!empty($this->input->get('carPickUpLon'))){?> value="<?php echo $this->input->get('carPickUpLon');?>"<?php  } ?>>
                          <input  name="carPickUpLocation" id="carPickUpLocation"   type="text" placeholder="" <?php if(!empty($this->input->get('carPickUpLocation'))){?> value="<?php echo $this->input->get('carPickUpLocation');?>"<?php  } ?> class="theme-input-box">


                     <div id="us2" style="width:580px; height: 200px;"></div>

          </div>
          <div class="clr"></div>
          <ul><li>Dropup Place</li></ul>
          <div class="clr"></div>
          <div class="slct">

                         <input name="carDropOffLat" id="carDropOffLat" type="hidden" placeholder="" <?php if(!empty($this->input->get('carDropOffLat'))){?> value="<?php echo $this->input->get('carDropOffLat');?>"<?php  } ?>>
                         <input name="carDropOffLon" id="carDropOffLon" type="hidden" placeholder="" <?php if(!empty($this->input->get('carDropOffLon'))){?> value="<?php echo $this->input->get('carDropOffLon');?>"<?php  } ?>>
                         <input name="carDropOffLocation" id="carDropOffLocation"  type="text" placeholder="" <?php if(!empty($this->input->get('carDropOffLocation'))){?> value="<?php echo $this->input->get('carDropOffLocation');?>"<?php  } ?> class="theme-input-box">

                      <div id="us1" style="width:580px; height:200px;"></div>

            </div>
            <?php }?>
</div>





          <?php if ($this->session->flashdata('error_message')) { ?>
          <div class="step3-rit">
            <div class="step3-price">
           <h4>  <?php echo $this->session->flashdata('error_message'); ?></h4>
            </div>
          </div>

          <?php
        }
						$book_car_button = "";
						if (count($car_availability) > 0) {
							?>
							<div class="step3-rit">
								<div class="step3-price">
									<?php
									echo $car_availability['message'];
									if ($car_availability['isSuccess'] == True) {
                    ?>
                      <p>Meeting Location</p>
                      <h4><?php echo $car_availability['Result']['meeting_location']; ?></h4>
                    <?php
										$book_car_button = '<input name="book_this_car" type="submit" value="Book this car" class="b">';
										?>
										<div class="devide"></div>
										<div class="clr"></div>
										<ul><li>Trip  price</li> <li>€ <?php echo $car_availability['Result']['total_price']-$car_availability['Result']['deliveryprice']; ?></li>
										</ul>
										<div class="clr"></div>
                                                                                <ul><li>Delivery charges</li> <li>€ <?php if($this->input->get('car_delivery_status')=='1'){ echo $car_availability['Result']['deliveryprice'];}else{ echo "0.00";} ?></li></ul>
										<div class="clr"></div>
										<?php
										$distance = "killometer";
										if ($car_availability['Result']['kmOrMiles'] == 2) {
											$distance = "mile";
										}
										?>
										<div class="clr"></div>
										<div class="devide"></div>
										<div class="clr"></div>
                                                                                <?php 
                                                                                if($this->input->get('car_delivery_status')=='1'){
                                                                                  $Total_price=$car_availability['Result']['total_price'];  
                                                                                }else{
                                                                                    $Total_price= $car_availability['Result']['total_price']-$car_availability['Result']['deliveryprice']; 
                                                                                }
                                                                                ?>
										<ul>
											<li>Total price</li> <li>€ <?php echo $Total_price; ?></li>
										</ul>
										<div class="clr"></div>
										<ul>
											
											<li>Security amount</li> <li>€ <?php echo $car_availability['Result']['security_deposit']; ?></li>
										</ul>
										<div class="clr"></div>
										
										<sub>* <?php echo $car_availability['Result']['carExtraKmOrMl']; ?> Charge for each additional <?php echo $distance; ?></sub>

										<?php
									}
									?>
								</div>
							</div>

							<?php
						}
						?>

						<div class="clr"></div>
						<div class="btn">
							<input  type="submit" name="check_availability" id="test" value="Check availability" class="a">

							<?php echo $book_car_button; ?>

						</div>
					</div>
				</div>
			</form>

		</div>


         <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
		<?php /* to open header drop down */ ?>
		<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
		<?php /* js for date time picker */ ?>
		<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
		<script>
            $('#datetimepicker_from').datetimepicker({
                dayOfWeekStart: 1,
                lang: 'en',
                format: 'Y-m-d H:i',
                formatTime: 'H:i',
                formatDate: 'Y-m-d',
                yearStart: '<?php echo date('Y'); ?>',
                minDate: '-1970/01/01', // yesterday is minimum date
                onShow: function (ct) {
                                     this.setOptions({                                         
                                         minTime:  true//select only current time and next time
                                     })
                                 },
                                  //for current date select  currnet time         
                                 onSelectDate:function(date){
                                 var seldate=$('#datetimepicker_from').val();
                                 var selectdate=seldate.split(" ");
                                 var curdate='<?php echo date('Y-m-d'); ?>';                               
                                 if(selectdate[0]!=curdate){
                                     var minTimeVal=false
                                 }else{
                                     var minTimeVal=true
                                 }                               
                                 this.setOptions({
                                                 minTime:minTimeVal 
                                        });
                                 },  
                                  //end       
                                 timepicker: true
            });

            $('#datetimepicker_to').datetimepicker({
                dayOfWeekStart: 1,
                lang: 'en',
                format: 'Y-m-d H:i',
                formatTime: 'H:i',
                formatDate: 'Y-m-d',
                yearStart: '<?php echo date('Y'); ?>',
                minDate: '-1970/01/01', // yesterday is minimum date
              /*  onShow: function (ct) {
                                     this.setOptions({                                         
                                         minTime:  true//select only current time and next time
                                     })
                                 },*/
                                  //for current date select  currnet time         
                                 onSelectDate:function(date){
                                 var seldate=$('#datetimepicker_to').val();
                                 var selectdate=seldate.split(" ");
                                 var curdate='<?php echo date('Y-m-d'); ?>';                               
                                 if(selectdate[0]!=curdate){
                                     var minTimeVal=false
                                 }else{
                                     var minTimeVal=true
                                 }                               
                                 this.setOptions({
                                                 minTime:minTimeVal 
                                        });
                                 },  
                                  //end       
                                 timepicker: true
            });

            //$('.datetimepicker').datetimepicker({value: '2015/04/15 05:03', step: 10});
		</script>


 

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY ; ?>&sensor=false&libraries=places"
      ></script>
    <script src="<?php echo base_url(); ?>assets/js/locationpicker.jquery.js"></script>
    <script>
        function load_map() {
            $('#us1').locationpicker({
                location: {latitude: <?php if(!empty($this->input->get('carDropOffLat'))){ echo $this->input->get('carDropOffLat');} else{ echo $data['car_data']['carDropOffLat'];}?>, longitude: <?php if(!empty($this->input->get('carDropOffLon'))){ echo $this->input->get('carDropOffLon');} else{ echo $data['car_data']['carDropOffLon'];}?>},
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
                location: {latitude: <?php if(!empty($this->input->get('carPickUpLat'))){ echo $this->input->get('carPickUpLat');} else{ echo $data['car_data']['carPickUpLat'];}?>, longitude: <?php if(!empty($this->input->get('carPickUpLon'))){ echo $this->input->get('carPickUpLon');}else{ echo $data['car_data']['carPickUpLon'];}?>},
                radius: 0.5,
                zoom: 6,
                inputBinding: {
                    latitudeInput: $('#carPickUpLat'),
                    longitudeInput: $('#carPickUpLon'),
                    locationNameInput: $('#carPickUpLocation')
                },
                addressFormat: "formatted_address",
                enableAutocomplete: true,
                 onchanged: function(currentLocation, radius, isMarkerDropped) {                         
                                var pick=$('#carPickUpLocation').val();   
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
load_map();
    </script>

    <script>

    $(document).ready(function(){
        
        $("#carPickUpLat").change(function(){
       $('#carDropOffLat').val($("#carPickUpLat").val());
          location_add();
        });
        $("#carPickUpLon").change(function(){
          $('#carDropOffLon').val($("#carPickUpLon").val());
          location_add();
        });

        function location_add(){
          lat = $("#carPickUpLat").val();
          lon = $("#carPickUpLon").val();
          url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ lat +','+ lon +'&key=<?php echo GOOGLE_MAP_API_KEY ; ?>';
          $.ajax({
            url: url,
            dataType: 'json',
            success: function (data){
              result = data.results;
              var lastItem = result.reverse();
              var lastItem = lastItem.reverse()[0];
              final = lastItem.formatted_address;
              final = final.split(',').reverse();
              //alert(final[0]);alert(final[1]);
              country = final[0].trim();
              city = final[1].trim();
              $("#country_type option") .each(function() { this.selected = (this.text == country); });
              $("#city_list").val(city);
            }
          });
        }


    });

    </script>

    <script>
$( document ).ready(function() { 
     $('input:radio').change(function() {
         if ($(this).val() == '0') {
              window.location.href = "<?php echo base_url(); ?>index.php/user/check_car_availability?car_id=<?php echo $this->input->get('car_id')?>&car_from=<?php echo $this->input->get('car_from')?>&car_to=<?php echo $this->input->get('car_to')?>&car_delivery_status=0";
      
    } else  {
        window.location.href = "<?php echo base_url(); ?>index.php/user/check_car_availability?car_id=<?php echo $this->input->get('car_id')?>&car_from=<?php echo $this->input->get('car_from')?>&car_to=<?php echo $this->input->get('car_to')?>&car_delivery_status=1";
 
    }
    
    });
});
</script>


    </body>
</html>
