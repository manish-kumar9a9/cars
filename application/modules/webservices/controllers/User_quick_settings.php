<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_quick_settings extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('email');
	}

	/*
	 * to use this service send a array
	 * which include
	 * array("countryCode"=>"+12","mobile"=>"+1234556985","otp"=>"some_random_hash")
	 * mobile number with country code
	 */

	private function otp_on_mobile($document) {

		if (isset($document['countryCode'])) {
			if ($document['countryCode'] == "+30") {
				$from = "Urend";
			} else {
				$from = "+18553380179";
			}
		} else {
			$from = "+18553380179";
		}
		require APPPATH . 'third_party/twilio-php/Services/Twilio.php';
		$account_sid = 'ACe5d1b236cd5e99647ec620d895f3d0fb';
		$auth_token = '48bf6a49e204b66aaf79077654a96d38';
		$client = new Services_Twilio($account_sid, $auth_token);

		$message = array();
		try {
			$message = $client->account->messages->create(array(
				'To' => $document['mobile'],
				'From' => $from,
				'Body' => "Thanks for using Urend. Your code is " . $document['otp'],
			));
		} catch (Services_Twilio_RestException $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
			return "3"; //Invalid Number Invalid Number otp sent otp could not send
		}
		if ($message->sid != '') {
			return "1"; //otp sent
		} else {
			return "2"; //otp could not send
		}
	}

	public function send_verification_otp() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['countryCode'] = $this->input->post('countryCode');
			$request_para['mobile'] = $request_para['countryCode'] . $this->input->post('mobile');
			$request_para['otp'] = rand(1000, 9999);

			if ($this->otp_on_mobile($request_para) == 1) {
				$isSuccess = true;
				$message = $this->lang->line('otp_sent_to_mobile_number');
				$data = array("otp" => $request_para['otp']);
			} else {

				$isSuccess = false;
				$message = $this->lang->line('otp_not_sent');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_mobile_number() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['mobile'] = $this->input->post('mobile');
			$request_para['countryCode'] = $this->input->post('countryCode');

			if ($this->user_model->update_mobile_number($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('mobile_number_update_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('mobile_number_not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/* change settings */

	public function change_notifications() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['fk_user_id'] = $this->input->post('user_id');
			$request_para['chat_notification'] = $this->input->post('chat_notification');
			$request_para['favourite_my_car'] = $this->input->post('favourite_my_car');
			$request_para['remind_to_rate_trip'] = $this->input->post('remind_to_rate_trip');
			$request_para['promotions_announcements'] = $this->input->post('promotions_announcements');

			if ($this->user_model->update_settings($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('settings_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	
	public function update_notification(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['setting_type'] = $this->input->post('setting_type');
			$request_para['state'] = $this->input->post('setting_type_value');
			$request_para['fk_user_id'] = $this->input->post('user_id');
			
			if ($this->user_model->update_notification_settings($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('settings_updated_successfully');
				$data = array();
			} else {
				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}

		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));		
		
	}
	
	public function update_frist_name() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['firstName'] = $this->input->post('firstName');

			if ($this->user_model->update_frist_name($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('first_name_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message =  $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_last_name() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['lastName'] = $this->input->post('lastName');

			if ($this->user_model->update_last_name($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('last_name_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message =  $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_user_email() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['email'] = $this->input->post('email');

			if ($this->user_model->update_user_email($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('email_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_user_password() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {

			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();

			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['new_password'] = md5($this->input->post('new_password'));
			$request_para['loginType'] = $this->input->post('loginType');


			if ($request_para['loginType'] == 0 && $this->user_model->update_user_password($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('password_updated_successfully');
			} else {
				$message = $this->lang->line('not_updated');
			}
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_transmission_state() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['transmission_state'] = $this->input->post('transmission_state');

			if ($this->user_model->update_transmission_state($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('transmission_state_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_device_tokken() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['deviceToken'] = $this->input->post('device_token');
			$request_para['deviceType'] = $this->input->post('device_type');

			if ($this->user_model->update_device_tokken($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('device_tokken_updated_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function update_user_language() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['userId'] = $this->input->post('user_id');
			$request_para['language'] =  strtolower($this->input->post('language'));

			if ($this->user_model->update_user_language($request_para)) {
				$isSuccess = true;
				$message = $this->lang->line('language_changed_successfully');
				$data = array();
			} else {

				$isSuccess = false;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	
	
}
