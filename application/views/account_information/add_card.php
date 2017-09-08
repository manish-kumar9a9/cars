
<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $this->session->userdata('userId')))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
//pre($user_data);
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
                width: 100% ;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding-bottom: 10px;
            }
        </style>

	<?php $this->load->view('include/head_block'); ?>

        <!-- main section starts -->
        <div class="container">

            <div class="payment-section">
				<?php
				if ($this->session->flashdata('card_msg') != "") {
					echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="success-alert col-new-md-12  margin-bottom-15 ">' . $this->session->flashdata('card_msg') . '</span> </div>';
				} 
				?>
				<?php if (count($card_exist) > 0) { ?>

					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
						<h2><?php echo $this->lang->line('EXISTING_CARD_DETAILS');?></h2>
						<p>
							<?php echo $card_exist->Alias; ?>
							<a data-toggle="modal" data-target="#remove_card_warn"  href="javascript:void(0)" title="Remove">
								<i class=" pull-right fa fa-times"></i>
							</a>
						</p>
					</div>		

					<div class="modal fade"  id="remove_card_warn" role="dialog">
						<div class="modal-dialog modal-dialog-new">

							<!-- Modal content-->
							<div class="modal-content modal-content-new">

								<div class="modal-body text-center">
									<i class="fa fa-warning fa-4x"></i>
									<p class="waiting-message"><?php echo $this->lang->line('ARE_YOU_SURE');?></p>
								</div>
								<div class="modal-body text-center green-body">

									<i class="fa fa-hand-o-right fa-lg "></i> <?php echo $this->lang->line('CARD_INFO_IS_REQUIRED_TO_REQUEST');?>
								</div>
								<div class="modal-body text-center ">

									<div class="row">
										<div class="col-new-lg-6 col-new-md-6">
											<a href="<?php echo site_url('account_information/add_card?action=remove_card&card_id='.$card_exist->Id); ?>">
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
                    <h2><?php echo $this->lang->line('UPDATE_PAYMENT_METHOD');?></h2>
                    <p><?php echo $this->lang->line('ADD_CARD_INFO');?></p>
                </div>
				<?php
				if ($this->session->flashdata('card_error') != "") {
					echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="error-alert col-new-md-12  margin-bottom-15 ">' . $this->session->flashdata('card_error') . '</span> </div>';
				} elseif ($this->session->flashdata('card_success') != "") {

					echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="success-alert col-new-md-12  margin-bottom-15">' . $this->session->flashdata('card_success') . '</span> </div> ';
				}
				?>
                <div>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}

					$returnUrl = 'http' . ( isset($_SERVER['HTTPS']) ? 's' : '' ) . '://' . $_SERVER['HTTP_HOST'];
					$returnUrl .= substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], '/') + 1);
					$returnUrl = site_url() . '/account_information/recieve_new_card';

					$data = (isset($card_access_tokken->PreregistrationData)) ? $card_access_tokken->PreregistrationData : '';

					$accessKeyRef = (isset($card_access_tokken->AccessKey)) ? $card_access_tokken->AccessKey : '';
					?>

                </div>


                <form name="card_element" autocomplete="off"  action="<?php echo (isset($card_access_tokken->CardRegistrationURL)) ? $card_access_tokken->CardRegistrationURL : ""; ?>" method="post">
                    <input type="hidden" name="data" value="<?php echo $data; ?>" />
                    <input type="hidden" name="accessKeyRef" value="<?php echo $accessKeyRef; ?>" />

                    <input type="hidden" name="returnURL" value="<?php echo $returnUrl; ?>" />
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
                        <h3><?php echo $this->lang->line('CREDIT_CARD');?></h3>
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('CARD_TYPE');?> </label>
						<select name="card_type" class="form-select">
							<option value="">-- Select Card Type -- </option>
							<option value="CB_VISA_MASTERCARD">CB VISA MASTERCARD</option>
							<option value="DINERS">DINERS</option>
							<option value="MAESTRO">MAESTRO</option>
							<option value="BCMC">BCMC</option>
						</select>
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('CREDIT_CARD_NUMBER');?></label>
                        <input type="text"   name="cardNumber" class="payment-form-input">
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('EXPIRATION_DATE');?></label>
                        <input type="text" maxlength="4"  name="cardExpirationDate" placeholder="mmyy"  class="payment-form-input">
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label">CVV</label>
                        <input type="text" maxlength="3"  name="cardCvv" class="payment-form-input">
                    </div>
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('UPDATE_CARD');?>">
                        </div>

                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <a href="<?php echo site_url('account_information/index'); ?>"><button type="button" value="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" name=""><?php echo $this->lang->line('CANCEL');?></button></a>
                        </div>
                    </div>
                </form>

                <form name="address_element" action="<?php echo site_url('account_information/update_user_address'); ?>" method="post">
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
                        <h3><?php echo $this->lang->line('BILLING_ADDRESS');?></h3>
                    </div>
					<?php
					if ($this->session->flashdata('error') != "") {
						echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="text-danger col-new-md-12  margin-bottom-15 ">' . $this->session->flashdata('error') . '</span> </div>';
					} elseif ($this->session->flashdata('success') != "") {

						echo '<div class="col-new-lg-12 col-new-md-12 " ><span class="success-alert col-new-md-12  margin-bottom-15">' . $this->session->flashdata('success') . '</span> </div> ';
					} else {
						$user_address_array = get_object_vars($user_address);
						$address_array = get_object_vars($user_address_array['Address']);
					}
					?>
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('STREET_ADDRESS');?></label>
                        <input type="text" name="AddressLine1" value="<?php echo element('AddressLine1', $address_array, ''); ?>" class="payment-form-input">
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('CITY');?></label>
                        <input type="text" name="City" value="<?php echo element('City', $address_array, ''); ?>" class="payment-form-input">
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('POSTAL_CODE');?></label>
                        <input type="text" name="PostalCode" value="<?php echo element('PostalCode', $address_array, ''); ?>" class="payment-form-input">
                    </div>

                    <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                        <label class="payment-label"><?php echo $this->lang->line('COUNTRY');?></label>
                        <select name="Country" class="form-select">
                            <option value="GR">Greece</option>
                        </select>
                    </div>

                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('UPDATE_ADDRESS');?>">
                        </div>

                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <a href="<?php echo site_url('account_information/index'); ?>">
								<button type="button" value="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" name=""><?php echo $this->lang->line('CANCEL');?></button> 
							</a>
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
        <script>
            jQuery('select[id=country_code]').val('<?php echo $this->session->userdata('country_code'); ?>');</script>
        <script>
            $('select[name=Country]').val('<?php echo $address_array['Country']; ?>');
        </script>

		<!-- Modal popup script starts -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- Modal popyp script ends -->

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>


            $(function () {
                $("form[name='address_element']").validate({
                    // Specify validation rules
                    rules: {
                        AddressLine1: "required",
                        City: "required",
                        PostalCode: {required: true},
                        Country: "required"
                    },
                    // Specify validation error messages
                    messages: {
                        AddressLine1: "Please enter your complete address..",
                        City: "Please enter your city.",
                        PostalCode: {required: "Please enter Postal code."},
                        Country: "Please select country."
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });

            jQuery.validator.addMethod("checkcardexpiry", function (val, element) {
                var val = element.value;

                var digits = val.toString().split('');
                month = (digits[0] + digits[1]);
                year = (digits[2] + digits[3]);

                current_year = new Date().getFullYear().toString().substr(2, 2);
                current_month = new Date().getMonth() + 1;

                if (parseInt(month) < 1 || parseInt(month) > 12) {
                    return false;
                }

                if (parseInt(year) < parseInt(current_year)) {
                    return false;
                }
                if (parseInt(year) == parseInt(current_year)) {

                    if (parseInt(month) < parseInt(current_month)) {
                        return false;
                    }
                }

                return true;

            }, "Card expiry date is not valid.");
            // Wait for the DOM to be ready

            $(function () {
                $("form[name='card_element']").validate({
                    // Specify validation rules
                    rules: {
                        cardCvv: {required: true, digits: true, minlength: 3, maxlength: 3},
                        cardNumber: {required: true, digits: true},
                        cardExpirationDate: {required: true, digits: true, minlength: 4, maxlength: 4, checkcardexpiry: true}
                    },
                    // Specify validation error messages
                    messages: {
                        cardCvv: {required: "CVV number is required.", digits: "Please provide 3 digit CVV number.", minlength: "Please provide 3 digit CVV number.", maxlength: "Please provide 3 digit CVV number."},
                        cardNumber: {required: "Please enter your card number.", digits: "Plese provide digit card number."},
                        cardExpirationDate: {required: "Please enter a card expiration date", minlength: "Plese provide 4 digit card expiration date.", maxlength: "Plese provide 4 digit card expiration date."}
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });

            $(function () {
                $("select[name=card_type]").val('<?php echo $this->input->get('card_type'); ?>');
                $("select[name=card_type]").change(function () {
                    val = $(this).val();
                    if (val == "") {
                        $('form[name=card_element] input').prop("disabled", true);
                        $('form[name=card_element] input[type=text]').val('');
                        var validator = $("form[name=card_element]").validate();
                        validator.resetForm();
                    } else if (val != '<?php echo $this->input->get('card_type'); ?>') {
                        $('form[name=card_element] input').prop("disabled", false);
                        $(location).attr('href', '<?php echo site_url('account_information/add_card') ?>?card_type=' + val);
                    }

                }).change();
            });
        </script>

    </body>
</html>
