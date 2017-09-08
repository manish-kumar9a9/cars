<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_information extends CI_Controller {

	function __construct() {
		parent::__construct();
		/*
		 * logout if session out
		 */
		if ($this->session->userdata('userId') == "") {
			redirect('user/logout');
		}
		$this->load->helper('array');
		$this->load->model('user_model');
		$this->load->library('mango_pay');
		$this->load->helper('array');
		/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function index() {
		/* view existing card */
		$data['card_exist'] = array();
		$data['user_account_info'] = $this->user_model->get_user_payment_account($this->session->userdata('userId'));
		if (count($data['user_account_info']) != 0 && $data['user_account_info']['card_id'] != "") {

			$data['card_exist'] = $this->mango_pay->view_a_card($data['user_account_info']['card_id']);
		}
		$this->load->view('account_information/edit_account_information', $data);
	}

	public function update_first_name() {
		$first_name = $this->input->post('first_name');
		if ($first_name == '') {
			$this->session->set_flashdata('page_error', 'Please enter name');
			redirect('account_information/index/?edit=first_name');
			die;
		} else
		if (strlen($first_name) > 20) {
			$this->session->set_flashdata('page_error', 'Please enter name max 20 digits');
			redirect('account_information/index/?edit=first_name');
			die;
		}


		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_user_first_name',
			'data' => array('user_id' => $this->session->userdata('userId'), 'firstName' => $first_name)
		);

		$result = get_data_with_curl($option);

		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', '');
			redirect('account_information/index/?edit=first_name');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	public function update_last_name() {
		$last_name = $this->input->post('last_name');
		if ($last_name == '') {
			$this->session->set_flashdata('page_error', 'Please enter last name');
			redirect('account_information/index/?edit=last_name');
			die;
		} else
		if (strlen($last_name) > 20) {
			$this->session->set_flashdata('page_error', 'Please enter last name max 20 digits');
			redirect('account_information/index/?edit=last_name');
			die;
		}
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_user_last_name',
			'data' => array('user_id' => $this->session->userdata('userId'), 'lastName' => $last_name)
		);

		$result = get_data_with_curl($option);

		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', '');
			redirect('account_information/index/?edit=last_name');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	public function update_email() {
		$email = $this->input->post('email');
		if ($email == '') {
			$this->session->set_flashdata('page_error', 'Please enter email');
			redirect('account_information/index/?edit=email');
			die;
		} else
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->session->set_flashdata('page_error', 'Please enter valid email');
			redirect('account_information/index/?edit=email');
			die;
		}
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_user_email',
			'data' => array('user_id' => $this->session->userdata('userId'), 'email' => $email)
		);

		$result = get_data_with_curl($option);

		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', $result['message']);
			redirect('account_information/index/?edit=email');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	public function update_password() {
		$password = $this->input->post('password');
		if ($password == '') {
			$this->session->set_flashdata('page_error', 'Please enter password');
			redirect('account_information/index/?edit=password');
			die;
		}
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_user_password',
			'data' => array('user_id' => $this->session->userdata('userId'), 'new_password' => $password, 'loginType' => 0)
		);

		$result = get_data_with_curl($option);

		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', $result['message']);
			redirect('account_information/index/?edit=password');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	public function edit_phone_no() {
		$this->load->view('account_information/edit_phone_number');
	}

	public function update_phone_no() {
		$country_code = $this->input->post('country_code');
		$phone_no = $this->input->post('phone_no');
		if ($phone_no == '') {
			$this->session->set_flashdata('page_error', 'Please enter phone no.');
			redirect('account_information/edit_phone_no');
			die;
		} else if ($country_code == '') {
			$this->session->set_flashdata('page_error', 'Please enter country code.');
			redirect('account_information/edit_phone_no');
			die;
		} else if ($phone_no != '' && $country_code != '') {
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_send_otp_to_mobile',
				'data' => array('countryCode' => $country_code, 'mobile' => $phone_no)
			);

			$result = get_data_with_curl($option);
			if (element('isSuccess', $result, '') != 1) {
				$this->session->set_flashdata('page_error', 'Please enter valid mobile no.');
				redirect('account_information/edit_phone_no');
			}
			$this->session->set_userdata('country_code', $country_code);
			$this->session->set_userdata('phone_no', $phone_no);
			$this->session->set_userdata('send_otp', $result['Result']['otp']);
			$this->session->set_flashdata('page_error', '');
			redirect('account_information/edit_phone_no/?edit=send_otp');
			die;
		}
	}

	public function confirm_otp() {
		$country_code = $this->input->post('country_code');
		$phone_no = $this->input->post('phone_no');
		$send_otp = $this->input->post('send_otp');
		if ($this->session->userdata('send_otp') == $send_otp) {
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_update_mobile',
				'data' => array('user_id' => $this->session->userdata('userId'), 'countryCode' => $country_code, 'mobile' => $phone_no)
			);
			$result = get_data_with_curl($option);
			if (element('isSuccess', $result, '') != 1) {
				$this->session->set_flashdata('page_error', $result['message']);
				redirect('account_information/edit_phone_no');
			}
			$this->session->unset_userdata('send_otp');
			$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
			redirect('account_information/index');
			die;
		} else if ($send_otp == '') {
			$this->session->set_flashdata('page_error', 'Please enter otp');
			redirect('account_information/edit_phone_no/?edit=send_otp');
			die;
		} else {
			$this->session->unset_userdata('send_otp');
			$this->session->set_flashdata('page_error', 'Otp expired.');
			redirect('account_information/edit_phone_no');
			die;
		}
	}

	public function edit_transmission() {
		$state['state'] = $this->input->get('state');
		$this->load->view('account_information/edit_transmission', $state);
	}

	public function update_transmission() {
		$transmission = $this->input->post('transmission');

		if ($transmission == '') {
			$this->session->set_flashdata('page_error', 'Please Select transmission');
			redirect('account_information/edit_transmission');
			die;
		}
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_transmission_state',
			'data' => array('user_id' => $this->session->userdata('userId'), 'transmission_state' => $transmission)
		);

		$result = get_data_with_curl($option);
		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', $result['message']);
			redirect('account_information/edit_transmission');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	public function update_notification() {
		$push_other = $this->input->post('push_other');
		$email_other = $this->input->post('email_other');
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_update_user_settings',
			'data' => array('user_id' => $this->session->userdata('userId'),
				'push_other' => $push_other,
				'email_other' => $email_other)
		);

		$result = get_data_with_curl($option);
		if (element('isSuccess', $result, '') != 1) {
			$this->session->set_flashdata('page_error', $result['message']);
			redirect('account_information/index/?edit=transmission');
		}
		$this->session->set_flashdata('page_success', '* Information Updated Successfully.');
		redirect('account_information/index/');
	}

	/* add card to account */

	public function add_card() {

		if ($this->input->get('action') == "remove_card" && $this->input->get('card_id') != "") {
			// call remove card function 
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_delete_user_card_info',
				'data' => array(
					'user_id' => $this->session->userdata('userId'),
					'card_id' => $this->input->get('card_id')
				)
			);

			$result = get_data_with_curl($option);
			if (element('isSuccess', $result, '') == 1) {
				$this->session->set_flashdata('card_msg', $result['message']);
			}
		}

		$data['user_account_info'] = $this->user_model->get_user_payment_account($this->session->userdata('userId'));

		/* view existing card */
		$data['card_exist'] = array();
		if (count($data['user_account_info']) != 0 && $data['user_account_info']['card_id'] != "") {

			$data['card_exist'] = $this->mango_pay->view_a_card($data['user_account_info']['card_id']);
		}

		/* create card registration tokken */

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


		/* create card registration tokken */
		$card_info = $data['user_address'] = array();
		if (count($data['user_account_info']) > 0) {
			$user = $data['user_account_info'];
			$data['user_address'] = $this->mango_pay->mango_view_user_detail($user['author_id']);
			if ($this->input->get('card_type') != "") {
				$access = array(
					"Tag" => $user['user_id'],
					"UserId" => $user['author_id'],
					"Currency" => "EUR",
					"CardType" => $this->input->get('card_type')
				);
				$card_info = $data['card_access_tokken'] = $this->mango_pay->mango_create_registration($access);
			}
		}

		if (count($card_info)) {
			$this->session->set_userdata("cardRegisterId", $card_info->Id);
		}
		$this->load->view('account_information/add_card', $data);
	}

	public function recieve_new_card() {
		if ($this->session->userdata("cardRegisterId") == "") {
			redirect('account_information/add_card');
		}

		$cardRegisterId = $this->session->userdata("cardRegisterId");
		$card = $this->mango_pay->add_card_to_user($cardRegisterId, $_GET);

		if ($card && $card->Id != "") {
			$user = array(
				'card_id' => $card->Id,
				'user_id' => $this->session->userdata('userId')
			);
			$this->user_model->add_card_to_user($user);
			$this->session->set_userdata("cardRegisterId", '');
			/* redirect if redirect identifire exist */
			if ($this->session->userdata('redirect_identifier') == "add_card" && $this->session->userdata('redirect_url') != "") {
				$this->session->set_userdata('redirect_identifier', '');
				$url = $this->session->userdata('redirect_url');
				$this->session->set_userdata('redirect_url', '');
				redirect($url);
			}
			$this->session->set_flashdata('card_success', 'Card information updated successfully.');
		} else {
			$this->session->set_flashdata('card_error', 'Not able to update card information.');
		}
		redirect('account_information/add_card');
	}

	public function deduct_money_from_mango_pay() {

		$user_account_info = $this->user_model->get_user_payment_account($this->session->userdata('userId'));
		$card_exist = $this->mango_pay->view_a_card($user_account_info['card_id']);

		$data = $info = array(
			'CreditedWalletId' => 17837168,
			'AuthorId' => $user_account_info['author_id'],
			'DebitedFunds_amount' => '1200',
			'DebitedFunds_currency' => 'EUR',
			'Fees_amount' => '0',
			'Fees_Currency' => 'EUR',
			'CardType' => $card_exist->CardType,
			'CardId' => $card_exist->Id
		);
		$transaction = $this->mango_pay->direct_payin_from_card($info);

		$this->load->model('user_cars_booking_model');
		$info = array(
			"booking_id" => rand(9999, 99999),
			"booking_amount" => ($transaction->DebitedFunds->Amount) / 100,
			"transaction_id" => $transaction->Id
		);

		$this->user_cars_booking_model->save_booking_transaction($info);
	}

	public function update_user_address() {
		$data = $_POST;

		$user = $this->user_model->get_user_payment_account($this->session->userdata('userId'));

		$data['Tag'] = $user['id'];
		$data['Id'] = $user['author_id'];
		/* update user address */
		$result = $this->mango_pay->mango_update_address($data);
		if ($result) {

			$this->session->set_flashdata('success', 'Billing address updated successfully');
			redirect('account_information/add_card');
		} else {

			$this->session->set_flashdata('error', 'Billing address not updated');
			redirect('account_information/add_card');
		}
	}

}
