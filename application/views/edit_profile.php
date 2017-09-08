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
    </head>
    <body class="wrapper">
        <!--header-->

		<?php $this->load->view('include/head_block'); ?>

		<?php  /* header end here */ ?>
		<div class="findcar-no-bg">
			<div class="findcar-inner">
				<div class="findstep4">
					<h2><?php echo $this->lang->line('EDIT_PROFILE');?></h2>
					<div class="clr"></div>
					<form class="" novalidate="novalidate"  id="user_profile_updation" >
					<div class="edit-profile">
						<?php
						$user_image = base_url() . "assets/image/Icon-user-1.png";
						if ($user_data['profileImage'] != "") {
							$user_image = base_url() . 'profileImages/' . $user_data['profileImage'];
						}
						?>
						<input type="file" id="user_profile_element" name="profileImage" class="hide" />
						<input type="hidden"  name="userId" value="<?php echo $user_data['userId']; ?>" class="hide" />
						
						<div class="img-edit">
							<img  id = "user_profile_element_block" src="<?php echo $user_image; ?>"><a href="#" title="edit profile pic" onclick="$('input[name=profileImage]').trigger('click');" class="edit-btn"></a>
						</div>
						<div class="clr"></div>
						<div class="edit-box">
							<label class="edit-box-label" ><?php echo $this->lang->line('FIRST_NAME');?> </label>
							<input <?php if($user_data['isVerified']=='1'){?>  readonly<?php }?> type="text" name="firstName" value="<?php echo $user_data['firstName'] ?>" placeholder="First name">
						</div>
						<div class="clr"></div>
						<div class="edit-box">
							<label class="edit-box-label"  ><?php echo $this->lang->line('LAST_NAME');?> </label>
							<input <?php if($user_data['isVerified']=='1'){?>  readonly<?php }?> type="text" name="lastName"  value="<?php echo $user_data['lastName'] ?>"  placeholder="Last  name">
						</div>
						<div class="clr"></div>
						<div class="edit-box">
							<label class="edit-box-label"  ><?php echo $this->lang->line('JOINING_DATE');?> </label>
							<input type="text" disabled=""  value="<?php echo date('M Y ', strtotime($user_data['createdAt'])); ?>" readonly >
						</div>
						<div class="clr"></div>
						<div class="edit-box">
							<label class="edit-box-label"  ><?php echo $this->lang->line('LIVES');?></label>
							<input type="text" name="country"  value="<?php echo $user_data['country'] ?>"  placeholder="Lives">
						</div>
						<div class="clr"></div>
						<div class="edit-box">
							<label class="edit-box-label"  ><?php echo $this->lang->line('ABOUT_ME');?></label>
							<div class="clr"></div>
							<textarea  name="about_user"  placeholder ="Enter text here......" ><?php echo $user_data['about_user'] ?></textarea>
						</div>
						<div class="edit-box">
							<input type="submit" class="theme-btn theme-btn-basic" value="<?php echo $this->lang->line('SAVE');?>"><img  id="profile_loading_element" class="hide" src="http://ec2-52-91-61-98.compute-1.amazonaws.com/urend/assets/image/loading.gif">
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		
        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


         <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/web.validation.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
		<script type="text/javascript">
                                $(function () {
                                    $("#user_profile_element").on("change", function ()
                                    {
                                        var files = !!this.files ? this.files : [];
                                        if (!files.length || !window.FileReader)
                                            return; // no file selected, or no FileReader support

                                        if (/^image/.test(files[0].type)) { // only image file
                                            var reader = new FileReader(); // instance of the FileReader
                                            reader.readAsDataURL(files[0]); // read the local file

                                            reader.onloadend = function () { // set image data as background of div
                                                $("#user_profile_element_block").attr("src", this.result);
                                            }
                                        }
                                    });
                                });
		</script>
		<script>

			$(document).ready(function (e) {
				$('#user_profile_updation').on('submit', (function (e) {
				
					e.preventDefault();
					check = true;
					if($.trim($('#user_profile_updation input[name=firstName]').val()) ===""){
						//$('#user_profile_updation input[name=firstName]').css('border','1px solid red');
						check = false;
					}
					
					if($.trim($('#user_profile_updation input[name=lastName]').val()) ==="" ){
						//$('#user_profile_updation input[name=lastName]').css('border','1px solid red');
						check = false;
					}		
					
					if($.trim($('#user_profile_updation input[name=country]').val()) ==="" ){
						//$('#user_profile_updation input[name=country]').css('border','1px solid red');
						check = false;
					}
					
					if($.trim($('#user_profile_updation textarea[name=about_user]').val()) ==="" ){
						//$('#user_profile_updation textarea[name=about_user]').css('border','1px solid red');
						check = false;
					}
				
					if(check){ 
						$('#profile_loading_element').show();
						$.ajax({
							url: '<?php echo site_url('service_edit_user_data'); ?>',
							type: 'POST',
							data: new FormData(this),
							contentType: false,
							cache: false,
							processData: false,
							dataType: "JSON",
							success: function (data)
							{
								if (data.isSuccess == 1) {
									location.href = '<?php echo site_url('user/user_profile/'.$user_data['userId']); ?>';
								}
							}
						});
					}
				}));
				/*
				$( "#user_profile_updation input " ).keyup(function() {
					$( "#user_profile_updation input " ).css('border','1px solid #00ae9e');
				  });
				  
				$( "#user_profile_updation textarea " ).keyup(function() {
					$( "#user_profile_updation textarea " ).css('border','1px solid #00ae9e');
				  });
				  */
			});

		</script>   

    </body>
</html>
