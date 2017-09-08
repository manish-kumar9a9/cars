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

		<?php $this->load->view('include/head_block'); ?>

		<div class="findcar-no-bg">
			<div class="findcar-inner">
				<div class="findstep3">

					<h2 style="text-align:center;">ARE YOU SURE YOU WANT TO DELETE THIS LISTING?</h2>
					<div class="clr"></div>
					<div class="box">
						<img width="100%" src="<?php echo $car_data['car_images'][0]['CarImage_path']; ?>">
						<div class="box-overlay">
							<?php
							$user_image = base_url() . "assets/image/Icon-user-1.png";
							if ($car_data['get_user_image'] != "") {
								$user_image = $car_data['get_user_image'];
							}
							?>
							<div class="box-fav1"><img src="<?php echo $user_image; ?>"><div class="clr"></div><p><?php echo $car_data['get_username']; ?></p></div>
							<div class="box-fav2"><h2><?php echo $car_data['get_make_name'] . ' ' . $car_data['get_model_name'] ?> <span></span></h2></div>
							<div class="box-fav3"><div>€<?php echo $car_data['price_daily']; ?> / DAY</div></div>
						</div>
					</div>
                                        <form id="myform" action="<?php echo site_url('user/delete_car/'.$car_data['id']);?>" method="post">
						<div class="clr"><?php echo $this->session->flashdata('message'); ?></div>
						<?php
						foreach ($car_delete_text as $crt) {
							?>
							<div class="clr"></div>
                                                        <div class="radio"><input id="reason_id"  name="reason_id[]" value="<?php echo $crt['id']; ?>" type="checkbox"  > <?php echo $crt['text']; ?> </div>
							<?php
						}
						?>
							<div class="clr"></div>
                                                        <div class="radio"><input class="other_delete_element"  id="other_delete_element"  value="other" type="checkbox" >Other </div>

							<div class="radio"><textarea class="hide" placeholder="Enter text here..." id="other_reson" rows="8" cols="70" name="other_text" ></textarea> </div>
						<div class="clr"></div>
                                                <div class="radio"><a href="<?php echo site_url('user/car_data/'.$car_data['id']);?>"><input type="button" value="Cancel" class="a theme-btn"></a><input type="submit" name="delete_car" id="delete_car" value="Delete" class="theme-btn theme-btn-basic"></div>
					</form>
				</div>
			</div>
		</div>


		<!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>

        <script>
		    $(document).ready(function(){
		        $('input[type="checkbox"]').click(function(){                    
                         if($(this).val() == "other" ){
			            if($(this).prop("checked") == true){
			            	 $('textarea[name="other_text"]').show();                                       
			            
			            }
			            else if($(this).prop("checked") == false){

			               $('textarea[name="other_text"]').hide();
			            }

		        	}


		        });

		    });
        </script>
        
         <script>
		   $(document).ready(function(){
		        $('#delete_car').click(function(){
                                 if ((($("input[name*='reason_id']:checked").length)<=0) && ($('#other_delete_element').prop("checked") == false)) {
                                       alert("You must select at least one reason!!");
                                       return false;
                                      }
			            if($('#other_delete_element').prop("checked") == true){
                                          var other_text=$('#other_reson').val();
                                          if(other_text==''){
                                              $("#other_reson").addClass("border-danger");                                             
                                              return false;
                                          }
			            
			            }
			        

		        });

		    });
    

        </script>
    </body>
</html>
