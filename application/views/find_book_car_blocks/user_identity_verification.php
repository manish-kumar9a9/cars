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
        <!--   Add date picker css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>
		<!--   end date picker css -->
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">
		<style>
            .profile-setting-center{width: 50%;margin: auto;}
            .profile-setting-input{width:100%;height:45px;border:none;}
            tr.profile-setting-table{border:1px solid #000}
            .border-none{border:none}
            .edit-input{width: 100%;float:left; margin-bottom: 20px;}
            .edit-input-text{width: 100%;height: 41px;padding-left: 18px;margin-bottom: 20px;
                             -webkit-box-sizing: border-box;
                             -moz-box-sizing: border-box;
                             box-sizing: border-box;
            }
            .edit-input-countryCode{width: 10%;height: 41px;
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
            }
            .edit-submit{width: 30%;background-color: #00968a;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .cancel-submit{width: 30%;background-color: #171717;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .border-bottom{border-bottom: 1px solid #ccc !important;}

            .profile-sub-heading{
                padding-bottom: 15px;
                border-bottom: 2px solid #333;
                margin-bottom: 5px;
            }

            .profile-sub-section{
                margin-bottom: 40px;
            }

            .edit-feild{
                width: 30%;
                float:left;
            }

            .edit-feild h4{

                margin-top: 5px;
                font-size: 18px;
            }

            .edit-form-feild{
                width: 70%;
                float: left;
            }

            .full-width-new{
                width: 100% ;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding-bottom: 10px;
            }
        </style>


		<?php $this->load->view('include/head_block'); ?>

		<?php /* header end here */ ?>
		<div class="findcar-no-bg">
			<div class="findcar-inner">
				<?php if (!empty($this->session->flashdata('success_message'))) { ?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $this->session->flashdata('success_message'); ?>
					</div>
					<?php
				}
				if (empty($user_document) && empty($user_document['state'])) {
				} elseif (!empty($user_document) && $user_document['state'] == 0) {
					?>
					<div class="findstep2">
						<h2>Your document are pending for admin approval . </h2>
					</div>
				<?php } elseif (!empty($user_document) && $user_document['state'] == 1) {
					?>
					<div class="findstep2">
						<h2>Your document are approved. </h2>
					</div>
					<?php
				} else {

				}
				?>
			</div>
		</div>

		<?php if (empty($user_document) && empty($user_document['state'])) { ?>
			<!-- main section starts -->
			<div class="container">
				<div class="payment-section">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
						<h2><?php echo $this->lang->line('DRIVING_LICENSE_VERIFICATION'); ?></h2>
						<p><?php echo $this->lang->line('DRIVING_LICENSE_VERIFICATION_INFO'); ?></p>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
						<h3><?php echo $this->lang->line('DRIVING_LICENSE'); ?></h3>
					</div>		
					<form method="POST" name="upload_licence" action="<?php echo site_url('user/upload_licence_document'); ?>" enctype="multipart/form-data" >

						<input type="hidden" value="<?php echo $user_record['userId']; ?>" name="userId">		
						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('DRIVING_LICENSE_NO'); ?></label>
							<input type="text" class="payment-form-input" placeholder="" name="dl_number" autocomplete="off">
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('FIRST_ISSUE_DATE'); ?> </label>
							<input type="text" class="payment-form-input datetimepicker" name="dl_issue_date" id="date_timepicker_end"  autocomplete="off">
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('SELECT_ID_TYPE'); ?>  </label>
							<select name="id_type" class="form-select">
								<option value="">Select ID Type</option>
								<option value="Driving License">Driving License</option>
								<option value="Government ID">Government ID</option>
								<option value="Military ID">Military ID</option>
								<option value="Passport">Passport</option>
							</select>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('ENTER_ID_NUMBER'); ?>   </label>
							<input type="text" class="payment-form-input" placeholder="" name="id_number" autocomplete="off">
						</div>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12  payment-heading">   
							<p> <?php echo $this->lang->line('DRIVING_LICENSE_PHOTO'); ?> </p>
						</div>	

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding ">
								<label class="payment-label"><?php echo $this->lang->line('FRONT_SIDE'); ?>  </label>
								<div class="upld lic-1">
									<input type="file" name="license_front" accept="image/*"  id="licence1" required>
									<a href="#" class="licence1" onClick="$('#licence1').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user2.png"> </a>
									<input type="button" id="licence-del1">
									<a href="#" class="licence-del1 hide " onClick="$('#licence-del1').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_license_front"></span>
							</div>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding">	
								<label class="payment-label"><?php echo $this->lang->line('BACK_SIDE'); ?>   </label>
								<div class="upld lic-2">
									<input type="file" name="license_back"   accept="image/*"  id="licence2" required>
									<a href="#" class="licence2" onClick="$('#licence2').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user-doc.png"> </a>
									<input type="button" id="licence-del2">
									<a href="#" class="licence-del2 hide" onClick="$('#licence-del2').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_license_back"></span>
							</div>
						</div>	


						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12  payment-heading">   
							<p> <?php echo $this->lang->line('ID_PHOTO'); ?></p>
						</div>	

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding ">
								<label class="payment-label"><?php echo $this->lang->line('FRONT_SIDE'); ?>  </label>
								<div class="upld lic-3">
									<input type="file" name="id_front" accept="image/*"  id="licence3" required>
									<a href="#" class="licence3" onClick="$('#licence3').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user2.png"> </a>
									<input type="button" id="licence-del3">
									<a href="#" class="licence-del3 hide " onClick="$('#licence-del3').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_id_front"></span>
							</div>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding">	
								<label class="payment-label"><?php echo $this->lang->line('BACK_SIDE'); ?>   </label>
								<div class="upld lic-4">
									<input type="file" name="id_back"   accept="image/*"  id="licence4" required>
									<a href="#" class="licence4" onClick="$('#licence4').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user-doc.png"> </a>
									<input type="button" id="licence-del4">
									<a href="#" class="licence-del4 hide" onClick="$('#licence-del4').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_id_back"></span>
							</div>
						</div>		

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="sec">
								<i><input type="checkbox" name="check_terms"></i><?php echo $this->lang->line('TERM_CONDITION'); ?> 
							</div>	
						</div>		
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('VERIFY_LICENSE'); ?> ">
							</div>

							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL'); ?>"></a>
							</div>
						</div>
					</form>

				</div>
			</div>
			<!-- main section ends -->		
		<?php } elseif (!empty($user_document) && $user_document['state'] == 2) { ?>		
			<!-- main section starts -->
			<div class="container">
				<div class="payment-section">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
						<h2><?php echo $this->lang->line('DRIVING_LICENSE_VERIFICATION'); ?></h2>
						<p><?php echo $this->lang->line('DRIVING_LICENSE_VERIFICATION_INFO'); ?></p>
					</div>
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
							<h3><?php echo $this->lang->line('DRIVING_LICENSE'); ?></h3>
					</div>		
					<form method="POST" name="edit_upload_licence" action="<?php echo site_url('user/edit_upload_licence_document'); ?>" enctype="multipart/form-data" >

						<input type="hidden" value="<?php echo $user_record['userId']; ?>" name="userId">		
						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('DRIVING_LICENSE_NO'); ?></label>
							<input type="text" class="payment-form-input" placeholder="" name="dl_number" autocomplete="off">
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('FIRST_ISSUE_DATE'); ?> </label>
							<input type="text" class="payment-form-input datetimepicker" name="dl_issue_date" id="date_timepicker_end"  autocomplete="off">
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('SELECT_ID_TYPE'); ?>  </label>
							<select name="id_type" class="form-select">
								<option value="">Select ID Type</option>
								<option value="Driving License">Driving License</option>
								<option value="Government ID">Government ID</option>
								<option value="Military ID">Military ID</option>
								<option value="Passport">Passport</option>
							</select>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
							<label class="payment-label"><?php echo $this->lang->line('ENTER_ID_NUMBER'); ?>   </label>
							<input type="text" class="payment-form-input" placeholder="" name="id_number" autocomplete="off">
						</div>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12  payment-heading">   
							<p> <?php echo $this->lang->line('DRIVING_LICENSE_PHOTO'); ?> </p>
							
						</div>	

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding ">
								<label class="payment-label"><?php echo $this->lang->line('FRONT_SIDE'); ?> </label>
								<div class="upld lic-1">
									<input type="file" name="license_front" accept="image/*"  id="licence1" required>
									<a href="#" class="licence1" onClick="$('#licence1').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user2.png"> </a>
									<input type="button" id="licence-del1">
									<a href="#" class="licence-del1 hide " onClick="$('#licence-del1').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_license_front"></span>
							</div>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding">	
								<label class="payment-label"><?php echo $this->lang->line('BACK_SIDE'); ?></label>
								<div class="upld lic-2">
									<input type="file" name="license_back"   accept="image/*"  id="licence2" required>
									<a href="#" class="licence2" onClick="$('#licence2').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user-doc.png"> </a>
									<input type="button" id="licence-del2">
									<a href="#" class="licence-del2 hide" onClick="$('#licence-del2').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_license_back"></span>
							</div>
						</div>	


						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12  payment-heading">   
							<p> <?php echo $this->lang->line('ID_PHOTO'); ?></p>
						</div>	

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding ">
								<label class="payment-label"><?php echo $this->lang->line('FRONT_SIDE'); ?></label>
								<div class="upld lic-3">
									<input type="file" name="id_front" accept="image/*"  id="licence3" required>
									<a href="#" class="licence3" onClick="$('#licence3').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user2.png"> </a>
									<input type="button" id="licence-del3">
									<a href="#" class="licence-del3 hide " onClick="$('#licence-del3').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_id_front"></span>
							</div>
						</div>

						<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="findstep2 no-padding">	
								<label class="payment-label"><?php echo $this->lang->line('BACK_SIDE'); ?></label>
								<div class="upld lic-4">
									<input type="file" name="id_back"   accept="image/*"  id="licence4" required>
									<a href="#" class="licence4" onClick="$('#licence4').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/user-doc.png"> </a>
									<input type="button" id="licence-del4">
									<a href="#" class="licence-del4 hide" onClick="$('#licence-del4').trigger('click'); return false;"><img src="<?php echo base_url(); ?>assets/image/delete-icon2.png"> </a>
								</div>
								<span class="element_error_id_back "></span>
							</div>
						</div>		
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 findcar-inner ">
							<div class="sec">
								<i><input type="checkbox" name="check_terms"></i> <?php echo $this->lang->line('TERM_CONDITION'); ?> 
							</div>	
						</div>
						
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('VERIFY_LICENSE'); ?>">
							</div>

							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL'); ?>"></a>
							</div>
						</div>
					</form>

				</div>
			</div>
			<!-- main section ends -->		
		<?php } ?>		


        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->

		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		<?php /* to open header drop down */ ?>
		<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>

		<script type="text/javascript">
                                    $(function () {
                                        $("#licence1").on("change", function ()
                                        {
                                            var files = !!this.files ? this.files : [];
                                            if (!files.length || !window.FileReader)
                                                return; // no file selected, or no FileReader support

                                            if (/^image/.test(files[0].type)) { // only image file
                                                var reader = new FileReader(); // instance of the FileReader
                                                reader.readAsDataURL(files[0]); // read the local file

                                                reader.onloadend = function () { // set image data as background of div
                                                    $(".lic-1").css("background-image", "url(" + this.result + ")");
                                                    $(".licence-del1").show();
                                                    $(".licence1").hide();
                                                }
                                            }
                                        });
                                    });
                                    $(function () {
                                        $(".licence-del1").on("click", function ()
                                        {
                                            $(".lic-1").css("background-image", "");
                                            $(".licence-del1").hide();
                                            $(".licence1").show();
                                            $("#licence1").val('');
                                        });
                                    });
                                    $(function () {
                                        $("#licence2").on("change", function ()
                                        {
                                            var files = !!this.files ? this.files : [];
                                            if (!files.length || !window.FileReader)
                                                return; // no file selected, or no FileReader support

                                            if (/^image/.test(files[0].type)) { // only image file
                                                var reader = new FileReader(); // instance of the FileReader
                                                reader.readAsDataURL(files[0]); // read the local file

                                                reader.onloadend = function () { // set image data as background of div
                                                    $(".lic-2").css("background-image", "url(" + this.result + ")");
                                                    $(".licence-del2").show();
                                                    $(".licence2").hide();
                                                }
                                            }
                                        });
                                    });
                                    $(function () {
                                        $(".licence-del2").on("click", function ()
                                        {
                                            $(".lic-2").css("background-image", "");
                                            $(".licence-del2").hide();
                                            $(".licence2").show();
                                            $("#licence2").val('');
                                        });
                                    });
                                    $(function () {
                                        $("#licence3").on("change", function ()
                                        {
                                            var files = !!this.files ? this.files : [];
                                            if (!files.length || !window.FileReader)
                                                return; // no file selected, or no FileReader support

                                            if (/^image/.test(files[0].type)) { // only image file
                                                var reader = new FileReader(); // instance of the FileReader
                                                reader.readAsDataURL(files[0]); // read the local file

                                                reader.onloadend = function () { // set image data as background of div
                                                    $(".lic-3").css("background-image", "url(" + this.result + ")");
                                                    $(".licence-del3").show();
                                                    $(".licence3").hide();
                                                }
                                            }
                                        });
                                    });
                                    $(function () {
                                        $(".licence-del3").on("click", function ()
                                        {
                                            $(".lic-3").css("background-image", "");
                                            $(".licence-del3").hide();
                                            $(".licence3").show();
                                            $("#licence3").val('');
                                        });
                                    });
                                    $(function () {
                                        $("#licence4").on("change", function ()
                                        {
                                            var files = !!this.files ? this.files : [];
                                            if (!files.length || !window.FileReader)
                                                return; // no file selected, or no FileReader support

                                            if (/^image/.test(files[0].type)) { // only image file
                                                var reader = new FileReader(); // instance of the FileReader
                                                reader.readAsDataURL(files[0]); // read the local file

                                                reader.onloadend = function () { // set image data as background of div
                                                    $(".lic-4").css("background-image", "url(" + this.result + ")");
                                                    $(".licence-del4").show();
                                                    $(".licence4").hide();
                                                }
                                            }
                                        });
                                    });
                                    $(function () {
                                        $(".licence-del4").on("click", function ()
                                        {
                                            $(".lic-4").css("background-image", "");
                                            $(".licence-del4").hide();
                                            $(".licence4").show();
                                            $("#licence4").val('');
                                        });
                                    });
		</script>

		<script>

            $(document).ready(function (e) {
                $('#user_identity_verification_form').on('submit', (function (e) {
                    e.preventDefault();
                    $('#loading_wait').show();
                    $.ajax({
                        url: '<?php echo site_url('service_upload_verification_files'); ?>',
                        type: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.isSuccess == 1) {
                                location.href = '<?php echo site_url('user/user_identity_verification'); ?>';
                            }
                        }
                    });
                }));
            });
        </script>

        <script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
        <script>

            jQuery(function () {
                jQuery('#date_timepicker_start').datetimepicker({
                    dayOfWeekStart: 1,
                    lang: 'en',
                    format: 'Y-m-d',
                    /* formatTime: 'H:i',*/
                    formatDate: 'Y-m-d',
                    minDate: '-1970/01/01',
                    defaultDate: new Date(),
                    yearStart: '<?php echo date('Y'); ?>',
                    onShow: function (ct) {
                        this.setOptions({
                            maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false
                        })
                    },
                    timepicker: false
                });
                jQuery('#date_timepicker_end').datetimepicker({
                    dayOfWeekStart: 1,
                    lang: 'en',
                    format: 'Y-m-d',
                    /* formatTime: 'H:i',*/
                    formatDate: 'Y-m-d',
                    maxDate: new Date(),
                    // yearStart: '<?php echo date('Y'); ?>',
                    onShow: function (ct) {
                        this.setOptions({
                            minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false

                        })
                    },
                    timepicker: false
                });
            });
        </script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script type="text/javascript">
            jQuery.validator.addMethod("uploadFile", function (val, element) {
                var size = element.files[0].size;
                console.log(size);
		// checks the file more than 3 MB
                if (size > 1048576 * 3){
                    return false;
                } else {
                    return true;
                }

            }, "File size should not be greater than 3 Mb.");

            $(function () {
                $("form[name='upload_licence']").validate({
                    ignore: [],
                    // Specify validation rules
                    rules: {
                        dl_number: {required: true},
                        dl_issue_date: "required",
                        id_type: "required",
                        id_number: {required: true},
                        check_terms: "required",
                        license_front: {required: true, uploadFile: true},
                        license_back: {required: true, uploadFile: true},
                        id_front: {required: true, uploadFile: true},
                        id_back: {required: true, uploadFile: true}
                    },
                    // Specify validation error messages
                    messages: {
                        dl_number: {required: "Please enter DL no."},
                        dl_issue_date: "Please enter DL issue date.",
                        id_type: "Please select ID type.",
                        id_number: {required: "Please enter ID no."},
                        check_terms: "Please accept Term and condition of Urend.</br> ",
                        license_front: {required: "Please choose image."},
                        license_back: {required: "Please choose image."},
                        id_front: {required: "Please choose image."},
                        id_back: {required: "Please choose image."}
                    },
                    errorPlacement: function (error, element) {
					
                        //Custom position: first name
                        if (element.attr("name") == "license_front") {
                            $(".element_error_license_front").html(error);
                        } else if (element.attr("name") == "license_back") {
                            $(".element_error_license_back").html(error);
                        } else if (element.attr("name") == "id_front") {
                            $(".element_error_id_front").html(error);
                        } else if (element.attr("name") == "id_back") {
                            $(".element_error_id_back").html(error);
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });


            $(function () {
                $("form[name='edit_upload_licence']").validate({
                    ignore: [],
                    // Specify validation rules
                    rules: {
                        dl_number: {required: true},
                        dl_issue_date: "required",
                        id_type: "required",
                        id_number: {required: true},
                        check_terms: "required",
                        license_front: {required: true, uploadFile: true},
                        license_back: {required: true, uploadFile: true},
                        id_front: {required: true, uploadFile: true},
                        id_back: {required: true, uploadFile: true}
                    },
                    // Specify validation error messages
                    messages: {
                        dl_number: {required: "Please enter DL no."},
                        dl_issue_date: "Please enter DL issue date.",
                        id_type: "Please select ID type.",
                        id_number: {required: "Please enter ID no."},
                        check_terms: "Please accept Term and condition of Urend.</br> ",
                        license_front: {required: "Please choose image."},
                        license_back: {required: "Please choose image."},
                        id_front: {required: "Please choose image."},
                        id_back: {required: "Please choose image."}
                    },
                    errorPlacement: function (error, element) {
                        //Custom position: first name
                        if (element.attr("name") == "license_front") {
                            $(".element_error_license_front").html(error);
                        } else if (element.attr("name") == "license_back") {
                            $(".element_error_license_back").html(error);
                        } else if (element.attr("name") == "id_front") {
                            $(".element_error_id_front").html(error);
                        } else if (element.attr("name") == "id_back") {
                            $(".element_error_id_back").html(error);
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
        </script>
    </body>
</html>
