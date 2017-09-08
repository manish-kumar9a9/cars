<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banking extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('array');
		$this->load->model('user_model');
		$this->load->model('user_cars_booking_model');
		$this->load->model('user_cars_model');
		$this->load->library('mango_pay');
		/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function index() {
		/*
		 * logout if session out
		 */
		if ($this->session->userdata('userId') == "") {
			redirect('user/logout');
		}

		if ($this->input->post()) {
			$data['user_account_info'] = $this->user_model->get_user_payment_account($this->session->userdata('userId'));
			if (count($data['user_account_info']) > 0) {
				$result = $this->mango_pay->create_other_bank_account($data['user_account_info']['author_id'], $this->input->post());

				if (count($result) > 0 && array_key_exists('Id', $result)) {
					$user = array(
						'banking_account_id' => $result->Id,
						'user_id' => $this->session->userdata('userId')
					);
					$this->user_model->update_user_bank_account($user);
				}
			}
		}
		$this->load->view('banking/add_account', array());
	}

	public function iban() {
		/*
		 * logout if session out
		 */
		if ($this->session->userdata('userId') == "") {
			redirect('user/logout');
		}
		if ($this->input->get('action') == "remove_bank_account" && $this->input->get('bank_id') != "") {
			// call remove card function 
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_update_user_bank_id',
				'data' => array(
					'user_id' => $this->session->userdata('userId'),
					'banking_account_id' => ""
				)
			);

			$result = get_data_with_curl($option);
			if (element('isSuccess', $result, '') == 1) {
				$this->session->set_flashdata('bank_msg', $result['message']);
			}
		}

		$data['user_account_info'] = $this->user_model->get_user_payment_account($this->session->userdata('userId'));

		if (count($data['user_account_info']) == 0) {

			/* create payment account of user  */
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_create_user_wallet',
				'data' => array('user_id' => $this->session->userdata('userId'))
			);

			$result = get_data_with_curl($option);
			$data['user_account_info'] = $this->user_model->get_user_payment_account($this->session->userdata('userId'));
		}


		$data['bank_account_details'] = array();

		if ($data['user_account_info']['author_id'] != "" && $data['user_account_info']['banking_account_id'] != "") {
			$data['bank_account_details'] = $this->mango_pay->get_user_bank_details($data['user_account_info']['author_id'], $data['user_account_info']['banking_account_id']);
		}

		if ($this->input->post()) {
			if (count($data['user_account_info']) > 0) {
				$result = $this->mango_pay->create_iban_bank_account($data['user_account_info']['author_id'], $this->input->post());

				if (count($result) > 0 && array_key_exists('Id', $result)) {
					$user = array(
						'banking_account_id' => $result->Id,
						'user_id' => $this->session->userdata('userId')
					);
					$this->user_model->update_user_bank_account($user);
				}
			}
		}
		$this->load->view('banking/add_account_iban', $data);
	}

	public function payment($booking_id) {

		$this->load->library('mango_pay');
		/* first deduct the amount here than proceed */
		$booking_data = $this->user_cars_booking_model->get_request_raw_data($booking_id);
		$user_account_info = $this->user_model->get_user_payment_account($booking_data['car_renter_id']);
		$card_exist = $this->mango_pay->view_a_card($user_account_info['card_id']);

		$info = array(
			"booking_id" => $booking_data['id'],
			"user_id" => $booking_data['car_renter_id'],
			"amount" => $booking_data['price_for_time'] + $booking_data['delivery_price'] + $booking_data['security_amount']
		);

		$data = array(
			'CreditedWalletId' => $user_account_info['wallet_id'],
			'AuthorId' => $user_account_info['author_id'],
			'DebitedFunds_amount' => $info['amount'] * 100,
			'DebitedFunds_currency' => 'EUR',
			'Fees_amount' => '0',
			'Fees_Currency' => 'EUR',
			'CardType' => $card_exist->CardType,
			'CardId' => $card_exist->Id,
			'ReturnURL' => site_url('banking/pay_re?booking_id=' . $booking_data['id']),
		);

		if ($this->input->get('pay_from') == "mobile") {
			$data['ReturnURL'] = site_url('banking/pay_re?pay_from=mobile&booking_id=' . $booking_data['id']);
		}

		$transaction = $this->mango_pay->direct_payin_from_card($data);

		if ($transaction->Status == "FAILED") {
			if ($this->input->get('pay_from') == "mobile") {
				redirect(site_url('banking/mobile_payment?transactionId=' . $transaction->Id));
				die;
			} else {
				redirect("booking_auth/booking/" . $booking_id . "?payment_process_state=failed&transactionId=" . $transaction->Id);
				die;
			}
		}
		$exact = $transaction->ExecutionDetails;
		redirect($exact->SecureModeRedirectURL);
	}

	public function pay_re() {
		$this->load->library('mango_pay');

		$transaction_id = $this->input->get('transactionId');
		$booking_id = $this->input->get('booking_id');

		$transaction = $this->mango_pay->get_payin_view($transaction_id);

		if ($transaction->ResultCode == 000000) {
			$record = array(
				"booking_id" => $booking_id,
				"booking_amount" => ($transaction->DebitedFunds->Amount) / 100,
				"transaction_id" => $transaction->Id
			);
			$this->user_cars_booking_model->save_booking_transaction($record);
			/* send renter email */
			$this->send_renter_successful_email($booking_id);
			
			//$this->create_contract_with_api($booking_primary_id);
			

			if ($this->input->get('pay_from') == "mobile") {
				redirect(site_url('banking/mobile_payment?transactionId=' . $transaction_id));
				die;
			}
			redirect("booking_auth/booking/" . $booking_id . "?payment_process_state=success");
		} else {
			if ($this->input->get('pay_from') == "mobile") {
				redirect(site_url('banking/mobile_payment?transactionId=' . $transaction_id));
				die;
			}
			redirect("booking_auth/booking/" . $booking_id . "?payment_process_state=failed&&transactionId=" . $transaction_id);
		}
	}

	public function mobile_payment() {

		/*
		 * WARNING -: do not delete this function it is working for mobile device 
		 * to get the status via query string 
		 */
	}

	public function send_renter_successful_email($booking_primary_id) {

		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_primary_id)
		);
		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($booking_data['car_renter_data']['email']);
		$this->email->subject('Payment Done For Car Booking');
		$this->email->message($this->load->view('email_templates/payment_received_from_renter', $booking_data, True));
		$this->email->set_mailtype("html");
		$this->email->send();

		/* send push notification */

		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
		$this->lang->load('master', $pusher_data['language']);

		$push_data = json_encode(
			array(
				'notification_code' => 330001,
				'message' => $this->lang->line('PAYMENT_DONE_FOR_CAR_BOOKING'),
				'data' => array("request_id" => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
	}

	public function send_push_to_user($user_id = "", $data = array()) {

		/* get user id and make condition here */
		$user_data = $this->user_model->userProfile(array('userId' => $user_id));
		$token = $device = "";

		if ($user_data['deviceType'] == 1) {
			$token = $user_data['deviceToken'];
			$device = "ios";
			generatePush($device, $token, $data);
		}
		if ($user_data['deviceType'] == 0) {
			$token = $user_data['deviceToken'];
			$device = "android";
			generatePush($device, $token, $data);
		}
	}

	public function create_contract_with_api($booking_primary_id) {
		//get car data with car id 
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_primary_id)
		);
		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];
		$car_saved_info = $this->user_cars_model->get_basic_contract_info($booking_data['car_id']);
		if ($car_saved_info) {
			$data['general']['date_start'] = date("Y-m-d h:i:s" , strtotime($booking_data['car_from']));
			$data['general']['date_end'] =date("Y-m-d h:i:s" , strtotime($booking_data['car_from']));
			$data['client']['lastname'] = $car_saved_info['lastname'];
			$data['client']['firstname'] = $car_saved_info['firstname'];
			$data['client']['fathername'] = $car_saved_info['fathername'];
			$data['client']['birthdate'] = $car_saved_info['birthdate'];
			$data['client']['sex'] = $car_saved_info['sex'];
			$data['client']['afm'] = $car_saved_info['afm'];
			$data['client']['street'] = $car_saved_info['street'];
			$data['client']['street_no'] = $car_saved_info['street_no'];
			$data['client']['zip_code'] = $car_saved_info['zip_code'];
			$data['client']['telephone_number'] = $car_saved_info['telephone_number'];
			$data['client']['fax'] = $car_saved_info['fax'];
			$data['client']['email'] = $car_saved_info['email'];
			$data['vehicle']['licence_plate'] = $car_saved_info['licence_plate'];
			$data['vehicle']['vehicle_model'] = $car_saved_info['vehicle_model'];
			$data['vehicle']['vehicle_color'] = $car_saved_info['vehicle_color'];
			$data['vehicle']['first_licence_date'] = $car_saved_info['first_licence_date'];
			$data['vehicle']['insured_value'] = $car_saved_info['insured_value'];
			$data['vehicle']['frame_number'] = $car_saved_info['frame_number'];

			$json_data = trim(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

			$ch = curl_init("https://pilot.allianz.gr/UnderwritingRulesWS/urend/postoffer?md5=" . md5($json_data . "10.126.32.86"));

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen(json_encode($data)))
			);

			$result = json_decode(curl_exec($ch));
			curl_close($ch);

			$result = $result[1];
			//pre($result);
			//die;
			if (array_key_exists('contract_number', $result)) {
				$this->db->where("id", $booking_primary_id);
				$this->db->update("car_booking_master", array("contract_id" => $result->contract_number));
			} else {
				// failed
			}
		}
	}

}
