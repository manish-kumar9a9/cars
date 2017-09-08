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
        <link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/components/imgareaselect/css/imgareaselect-default.css" rel="stylesheet" media="screen">	
		

        <style type="text/css">
            /* Custom container */

            .container-narrow {
                margin: 150px auto 50px auto;
                max-width: 728px;
            }
        </style>

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
                width: 100% ; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;padding-bottom: 10px;
            }
        </style>

		<?php $this->load->view('include/head_block'); ?>

        <!-- main section starts -->
        <div class="container">

            <div class="payment-section">
				<?php
				if ($this->session->flashdata('bank_msg') != "") {
					echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="success-alert col-new-md-12  margin-bottom-15 ">' . $this->session->flashdata('bank_msg') . '</span> </div>';
				} 
				?>
			<?php if (count($bank_account_details) > 0) {  ?>
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
					<h2><?php echo $this->lang->line('EXISTING_BANK_ACCOUNT');?></h2>
					<p><?php echo $bank_account_details->Type ." ". $bank_account_details->Details->IBAN ; ?>
						<a data-toggle="modal" data-target="#remove_account_warn"  href="javascript:void(0)">
							<i class="fa fa-times pull-right"></i>
						</a>
					</p>
				</div>
					<div class="modal fade"  id="remove_account_warn" role="dialog">
						<div class="modal-dialog modal-dialog-new">

							<!-- Modal content-->
							<div class="modal-content modal-content-new">

								<div class="modal-body text-center">
									<i class="fa fa-warning fa-4x"></i>
									<p class="waiting-message"><?php echo $this->lang->line('ARE_YOU_SURE');?></p>
								</div>
								<div class="modal-body text-center green-body">

									<i class="fa fa-hand-o-right fa-lg "></i> <?php echo $this->lang->line('BANK_REQUIRED_FOR_RECEIVE_PAYMENT');?>
								</div>
								<div class="modal-body text-center ">

									<div class="row">
										<div class="col-new-lg-6 col-new-md-6">
											<a href="<?php echo   site_url('banking/iban?action=remove_bank_account&bank_id='.$bank_account_details->Id); ?>">
												<div class="col-new-lg-12 col-new-md-12 yes-button theme-btn ">
													<?php echo $this->lang->line('YES');?>
												</div>
											</a>
										</div>

										<div class="col-new-lg-6 col-new-md-6 ">
											<div data-dismiss="modal" class="col-new-lg-12 col-new-md-12 no-button theme-btn">
												<?php echo $this->lang->line('NO');?>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
			<?php } ?>		

	                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
	                    <h2><?php echo $this->lang->line('ADD_BANK_ACCOUNT');?> </h2>
	                    <p><?php echo $this->lang->line('PROVIDE_VALID_BANK_DETAILS');?> </p>
	                </div>
					<form autocomplete="off"  method="post" name ="add_bank_account" action="<?php echo site_url('banking/iban'); ?>">
						<?php
						// Get Flash data on view 
						if ($this->session->flashdata('page_error') != "") {
							echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
						}
						?>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('OWNER_NAME');?></label>
								<input type="text" name="OwnerName" class="payment-form-input">
							</div>
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('BIC');?></label>
								<input type="text" name="BIC" class="payment-form-input">
							</div>

						</div>	

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-12 col-new-md-12  col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('IBAN');?></label>
								<input type="text" name="IBAN" class="payment-form-input">
							</div>
						</div>	

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
							<h3><?php echo $this->lang->line('ADDRESS');?> </h3>
						</div>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('ADDRESSLINE1');?></label>
								<input type="text" name="AddressLine1" class="payment-form-input">
							</div>
						</div>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('ADDRESSLINE2');?></label>
								<input type="text" name="AddressLine2" class="payment-form-input">
							</div>
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('CITY');?></label>
								<input type="text" name="City" class="payment-form-input">
							</div>

							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('REGION');?></label>
								<input type="text" name="Region" class="payment-form-input">
							</div>			
						</div>

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('POSTAL_CODE');?></label>
								<input type="text" name="PostalCode" class="payment-form-input">
							</div>

							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
								<label class="payment-label"><?php echo $this->lang->line('COUNTRY');?></label>
								<select class="form-select" name="Country">
									<option value="GR">Greece</option>
								</select>
							</div>			
						</div>					

						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SAVE');?>">
							</div>

							<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
							</div>
						</div>
					</form>
	            </div>
	        </div>
	        <!-- main section ends -->

	        <!--footers-->
			<?php $this->load->view('include/footer_block'); ?>
	        <!--/footer-->


	        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>

		<!-- Modal popup script starts -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- Modal popyp script ends -->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>

            $.validator.addMethod('letters', function (value) {
                return value.match(/^[-A-Z]+$/);
            });

            // Wait for the DOM to be ready
            $(function () {
                $("form[name='add_bank_account']").validate({
                    // Specify validation rules
                    rules: {
                        OwnerName: {required: true},
                        Country: {required: true},
                        BIC: {required: true, letters: true},
                        AddressLine1: {required: true},
                        AddressLine2: {required: true},
                        City: {required: true},
                        Region: {required: true},
                        PostalCode: {required: true, maxlength: 10},
                        IBAN: {required: true}
                    },
                    // Specify validation error messages
                    messages: {
                        OwnerName: {required: "Please enter Owner name."},
                        Country: {required: "Please select Country."},
                        BIC: {required: "Please enter Business Identifier Code.", letters: "Please enter capital letters."},
                        AddressLine1: {required: "Please enter AddressLine1."},
                        AddressLine2: {required: "Please enter AddressLine2."},
                        City: {required: "Please enter City."},
                        Region: {required: "Please enter Region."},
                        PostalCode: {required: "Please enter PostalCode.", maxlength: "Please enter only 10 digits."},
                        IBAN: {required: "Please enter International Bank Account Number (IBAN)."}
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });

        </script>
    </body>
</html>
