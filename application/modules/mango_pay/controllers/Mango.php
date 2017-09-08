<?php

class Mango extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function add_card() {
		/*
		  key pair requeired
		 * CardRegistrationURL
		 * data
		 * accessKeyRef
		 * cardRegisterId
		 * user_id
		 */
		if (count($_GET) == 0 || $_GET['CardRegistrationURL'] == "" || $_GET['data'] == "" || $_GET['accessKeyRef'] == "" || $_GET['cardRegisterId'] == "" || $_GET['user_id'] == ""
		) {
			echo json_encode(
				array('status' => 102,
					'message' => "Bad request !  parameter missing."
			));
			die;
		}
		/* language changer */
		$lang = $this->input->get('lang');
		$this->lang->load('master', $lang);
		
		$CardRegistrationURL = $this->input->get('CardRegistrationURL');
		$returnUrl = site_url() . '/mango_pay/mango/get_card';
		$data = $this->input->get('data');
		$accessKeyRef = $this->input->get('accessKeyRef');

		/* card registration id very imp . */
		$this->session->set_userdata("cardRegisterId", $this->input->get('cardRegisterId'));
		$this->session->set_userdata("dbuser_id", $this->input->get('user_id'));
		?>

		<html>
			<head>
				<meta name="apple-mobile-web-app-capable" content="yes" />
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="user-scalable=no, initial-scale=1.0, width=device-width" />
				<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
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
					.edit-submit{border-radius: 0px;
								 box-shadow: none;width: 30%;background-color: #00968a;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
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
					input[type=submit] , input[type=text] ,  input[type=number]  {
						-webkit-border-radius:0px;
						-webkit-appearance: none;
					}
				</style>
			</head>	

			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
				<h2><?php echo $this->lang->line('UPDATE_PAYMENT_METHOD');?></h2>
				<p><?php echo $this->lang->line('ADD_CARD_INFO');?></p>
			</div>

			<form action="<?php echo $CardRegistrationURL; ?> " name="card_element" method="post">
				<input type="hidden" name="data" value="<?php echo $data; ?>" />
				<input type="hidden" name="accessKeyRef" value="<?php echo $accessKeyRef; ?>" />

				<input type="hidden" name="returnURL" value="<?php echo $returnUrl; ?>" />

				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
					<label class="payment-label"><?php echo $this->lang->line('CREDIT_CARD_NUMBER');?></label>
					<input type="number" autocomplete="off"  name="cardNumber" class="payment-form-input">
				</div>

				<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
					<label class="payment-label"><?php echo $this->lang->line('EXPIRATION_DATE');?></label>
					<input type="number" autocomplete="off"  name="cardExpirationDate" placeholder="mmyy"  class="payment-form-input" />
				</div>

				<div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
					<label class="payment-label">CVV</label>
					<input type="number"  autocomplete="off" name="cardCvx" class="payment-form-input" />
				</div>

				<div class="submission col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
					<input type="submit" name=""  class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('UPDATE_CARD');?>" />
				</div>

			</form>
			<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
			<script>
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
							cardCvx: {required: true, digits: true, minlength: 3, maxlength: 3},
							cardNumber: {required: true, digits: true},
							cardExpirationDate: {required: true, digits: true, minlength: 4, maxlength: 4, checkcardexpiry: true}
						},
						// Specify validation error messages
						messages: {
							cardCvx: {required: "CVV number is required.", digits: "Please provide 3 digit CVV number.", minlength: "Please provide 3 digit CVV number.", maxlength: "Please provide 3 digit CVV number."},
							cardNumber: {required: "Please enter your card number.", digits: "Plese provide digit card number."},
							cardExpirationDate: {required: "Please enter a card expiration date", minlength: "Plese provide 4 digit card expiration date.", maxlength: "Plese provide 4 digit card expiration date."}
						},
						submitHandler: function (form) {

							form.submit();
							$("input[type='submit']").hide();
							$('.submission').html('<div class="text-center " >&nbsp;&nbsp;&nbsp<span class="fa fa-spinner fa-4x  fa-spin padding-10-0 "></span>&nbsp;&nbsp;&nbsp;</div>');
						}
					});
				});
			</script>			   
		</html>	

		<?php
	}

	public function get_card() {

		$this->load->model('user_model');
		$this->load->library('mango_pay');

		if ($this->session->userdata("cardRegisterId") == "") {
			/* echo json_encode(
			  array('status' => 101,
			  'message' => "session expired."
			  )
			  ); */
			redirect(site_url('mango_pay/mango/get_state?message=session expired=&status=') . $out_state);
			die;
		}
		$out_state = "";
		$cardRegisterId = $this->session->userdata("cardRegisterId");
		$card = $this->mango_pay->add_card_to_user($cardRegisterId, $_GET);

		if ($card && $card->Id != "") {
			$user = array(
				'card_id' => $card->Id,
				'user_id' => $this->session->userdata("dbuser_id")
			);
			$this->user_model->add_card_to_user($user);
			$out_state = "SUCCESS";
		}

		$this->session->set_userdata("cardRegisterId", '');
		$this->session->set_userdata("dbuser_id", '');

		if (count($card) == 0) {
			$out_state = "FAILED";
		}
		/*
		  echo "<html>";
		  echo "<body>";
		  echo "<input type='button' value='closeActivity' onclick='closeActivity()'>";
		  echo "</body>";
		  echo "<script type='text/javascript'>";
		  echo "function closeActivity(){Android.closeActivity('SUCCESS');}";
		  echo "</script>";
		  echo "</html>";
		 */
		redirect(site_url('mango_pay/mango/get_state?status=') . $out_state);
	}

	function get_state() {

		/* echo site_url('mango_pay/mango/get_state?status=success'); */
		/* call back for device */
	}

}
