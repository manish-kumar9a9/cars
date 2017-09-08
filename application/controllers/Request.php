<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public $active_user_id = "";

	function __construct() {

		parent::__construct();
		$this->load->helper('form');
		/* this model handle all transactions */
		$this->load->model('user_cars_booking_model');
		$this->load->model('user_model');
		$this->load->model('user_cars_model');
		$login_user = $this->session->userdata();  // pre($login_user );
		if ($this->session->userdata('userId') == "") {
			redirect('');
		}
		$this->active_user_id = $login_user['userId'];
				/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function received() {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_all_incoming_requests_to_car_owner',
			'data' => array('car_user_id' => $this->active_user_id)
		);
		$result = get_data_with_curl($option);
		$data['request_data'] = ($result['Result'])?$result['Result']:array();
		$this->load->view('request_blocks/incoming_requests', $data);
	}

	public function sent() {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_all_sent_request',
			'data' => array('car_renter_id' => $this->active_user_id)
		);
		$result = get_data_with_curl($option);
		$data['request_data'] = ($result['Result'])?$result['Result']:array();
		$this->load->view('request_blocks/sent_requests', $data);
	}

	public function current_booking() {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_current_booking_records',
			'data' => array('user_id' => $this->active_user_id)
		);
		$result = get_data_with_curl($option);
		$data['request_data'] = ($result['Result'])?$result['Result']:array();
		
		$this->load->view('request_blocks/current_bookings', $data);
	}

	public function complete_booking() {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_success_booking_records',
			'data' => array('user_id' => $this->active_user_id)
		);

		$result = get_data_with_curl($option);
		$data['request_data'] = ($result['Result'])?$result['Result']:array();
		$this->load->view('request_blocks/complete_bookings', $data);
	}

	public function expired_booking() {

		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_history_booking_records',
			'data' => array('user_id' => $this->active_user_id)
		);

		$result = get_data_with_curl($option);
		$data['request_data'] = ($result['Result'])?$result['Result']:array();
		$this->load->view('request_blocks/expired_bookings', $data);
	}

}
