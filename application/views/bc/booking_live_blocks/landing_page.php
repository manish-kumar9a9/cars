<?php //pre($current_booking_data); ?>
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
    </head>
    <body class="wrapper">
        <!--header-->

		<?php $this->load->view('include/head_block'); ?>
        <?php 

            /* some sample data */
        ?>

        <?php echo form_open('booking'); ?>
            <div id="action_elements">

            </div>
        <?php echo form_close(); ?>
        <div class="findcar-no-bg bg-333">
  <div class="findcar-inner">
   <h2 class="text-white no-margin hide padding-15-0 bg-333">Request Details</h2>
  </div>
    <div class="clr"></div>
  <div class="width-100 req-top-box">
      <div class="width-100 img">
         <img src="<?php echo $current_booking_data['car_details']['car_images'][0]['CarImage_path']; ?>">
         <div class="width-100 req-top-view hide" id="scroller">
           <div class="width-20 left">
             <div class="width-100">
               <h4><i class="fa fa-2x fa-dollar"></i><span>51</span></h4> 
               <div class="clr"></div>
               <h5>Per Day</h5>
             </div>
           </div>
           <div class="width-80 right">
             <div class="normal-div width-98 float-right">
               <p class="no-margin padding-5-0">SAN FRANSISCO</p>
               <h3 class="no-margin">Classic Porsche 911 Car <span class="theme-text-color">2015</span></h3>
            </div>
           </div>
         </div>
        
      </div>
    </div>
  <div class="clr"></div>
  <div class="findcar-inner">
   <div class="req-dtl">
    <h2 class="theme-text-color no-margin padding-15-0 bg-333">Trip Details</h2>
    <div class="clr"></div>
    <div class="width-100 trip-dtl">
      <div class="width-50 float-left input">
         <div class="width-96 padding-10-0 ">
           <input type="text" class="datetimepicker float-left" value="<?php echo $current_booking_data['car_from'] ;?>"><i class="fa fa-arrow-down theme-text-color float-right"></i>
         </div>
      </div>
      <div class="width-50 float-left input">
         <div class="width-96 padding-10-0 float-right">
           <input type="text" class="datetimepicker float-left" value="<?php echo $current_booking_data['car_to'] ;?>" ><i class="fa fa-arrow-down theme-text-color float-right"></i>
         </div>
      </div>
    </div>
    <div class="clr"></div>
    <div class="width-100 trip-dtl">
      <div class="width-50 float-left price">
        <div class="width-96 padding-10-0 ">
         <div class="normal-div float-left">
           <h4>Trip Price</h4>
         </div>
         <div class="normal-div float-right">
           <div class="price-box">$100</div>
         </div>
        </div>
      </div>
      <div class="width-50 float-left price">
        <div class="width-96 padding-10-0 float-right"> 
         <div class="normal-div float-left">
           <h4>Trip Price</h4>
         </div>
         <div class="normal-div float-right">
           <div class="price-box">$100</div>
         </div>
        </div>
      </div>
    </div>
    <div class="clr"></div>
    <div class="width-100 trip-dtl">
      <div class="width-50 float-left input">
         <div class="width-96 padding-10-0 ">
           <input type="text" placeholder="car pickup location"  value = "<?php echo $current_booking_data['car_details']['carPickUpLocation']  ;?>" class="float-left"><i class="fa fa-map-marker theme-text-color float-right"></i>
         </div>
      </div>
      <div class="width-50 float-left input">
         <div class="width-96 padding-10-0 float-right">
           <input type="text" placeholder="car dropoff location" value = "<?php echo $current_booking_data['car_details']['carDropOffLocation']  ;?>"  class="float-left"><i class="fa fa-map-marker theme-text-color float-right"></i>
         </div>
      </div>
    </div>
    <div class="clr"></div>
    <div class="width-100 trip-dtl">
      <div class="width-100 float-left price">
        <div class="width-100 padding-10-0 ">
         <div class="normal-div float-left">
           <h4>Delivery Charge</h4>
         </div>
         <div class="normal-div float-right">
           <div class="price-box">$100</div>
         </div>
        </div>
      </div>
    </div>
    <div class="clr"></div>
    <?php 
       if($request_watcher =="car_owner"){
            $request_text = "Request By";
            $user_name    =  $current_booking_data['car_renter_data']['firstName']." ".$current_booking_data['car_renter_data']['lastName'];
            $user_pic     =  $current_booking_data['car_renter_data']['user_image'];
       }else{
            $request_text = "Car Owner";
            $user_name    =  $current_booking_data['car_owner_data']['firstName']." ".$current_booking_data['car_owner_data']['lastName'];
            $user_pic     =  $current_booking_data['car_owner_data']['user_image'];

       }     

    ?>
    <div class="width-100 trip-dtl">
      <div class="width-100 float-left price">
        <div class="width-100 padding-10-0 ">
         <div class="normal-div float-left">
           <h3 class="theme-text-color"><?php echo $request_text ; ?></h3>
           <h5><?php echo $user_name ; ?></h5>
         </div>
         <div class="normal-div float-right">
           <div class="pic">
            <img src="<?php echo $user_pic ; ?>">
            <div class="clr"></div>
            <i class="fa fa-lg fa-star"></i>
            <i class="fa fa-lg fa-star"></i>
            <i class="fa fa-lg fa-star-half"></i>
            <i class="fa fa-lg fa-star-o"></i>
            <i class="fa fa-fw fa-lg fa-star-o"></i>
           </div>
         </div>
        </div>
      </div>
    </div>

    <div class="clr"></div>
    <div class="width-100 trip-dtl">
        <div id="action_button_element">

        </div>

    </div>
    <?php echo  "Check the transaction according to this time stamp as current time -: ".date('Y-m-d H:i:s'); ?>
   </div>
  </div>
</div>

<?php //pre($current_booking_data); ?>
		<!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script>
        $('#scroller').hide('fast');
	        function sync_page(){
				jQuery.ajax({
					url:'<?php echo site_url('booking/sync_page/'); ?>',
					method:'POST',
					dataType: 'json',
					success:function(data){
                        if(data.html){
                            $('#action_button_element').html(data.html).show('slow');
                        }    
					}
				});
			}

            sync_page();

			setInterval(function(){ sync_page(); }, 10000);
            $('html, body').delay(1000).animate({
                scrollTop: $("#scroller").offset().top - 140 
            },2000);
            $('#scroller').delay(2500).fadeIn('fast');
		</script>
    </body>
</html>
