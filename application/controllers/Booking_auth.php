<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_auth extends CI_Controller {

	public $active_user_id = "";

	function __construct() {
		parent::__construct();
		/*
		 * logout if seesion out
		 */
		if ($this->session->userdata('userId') == "") {
			redirect('user/logout');
		} else {
			$this->active_user_id = $this->session->userdata('userId');
		}
		$this->load->model('user_cars_booking_model');
		$this->load->model('rating_model');
				/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function booking($id = null) {
		$data['booking_data'] = $this->get_booking_data_with_user($id, $active_user = $this->active_user_id);

		if ($data['booking_data']['pickup_confirmed']) {
			if ($this->input->get('rating_state') == 1) {

				if ($this->session->userdata('userId') == $data['booking_data']['car_renter_id'] && $this->rating_model->check_user_car_booking_status($data['booking_data']['id'], $data['booking_data']['car_renter_id']) == true) {

					redirect('Booking_auth/booking/' . $id);
				}
				/* for owner */
				if ($this->session->userdata('userId') == $data['booking_data']['car_user_id'] && $this->rating_model->check_booking_user_rating_status($data['booking_data']['id'], $data['booking_data']['car_user_id']) == true) {
					redirect('Booking_auth/booking/' . $id);
				}
			}
			$this->load->view('booking_live_blocks/land_page_dropoff', $data);
		} else {
			$this->load->library('mango_pay');
			$data['transaction_id_data'] = array();
			if ($this->input->get('transactionId') != "") {
				$data['transaction_id_data'] = $this->mango_pay->get_payin_view($this->input->get('transactionId'));
			}
			
			$this->load->view('booking_live_blocks/land_page', $data);
		}
	}

	private function get_booking_data_with_user($id, $active_user) {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $id)
		);
		$result = get_data_with_curl($option);
		$data = $result['Result'];

		if ($data['car_user_id'] == $this->active_user_id) {
			$data['booking_user_type'] = 'owner';
		}

		if ($data['car_renter_id'] == $this->active_user_id) {
			$data['booking_user_type'] = 'renter';
		}
		return $data;
	}

	public function sync_page() {

		if ($this->input->is_ajax_request()) {
			$booking_id = $this->input->post('id');
			$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
			/* if request is expired */
			if ($data['rejected_by_car_owner'] == 1 || $data['rejected_by_car_renter'] == 1 || $data['auto_cancel_state'] == 1) {
				echo json_encode(array("html" => "<span class='btn-danger theme-btn float-right'>". $this->lang->line('REQUEST_IS_EXPIRED')."</span>"));
				die;
			}
			$data['booking_renter_transaction'] = $this->user_cars_booking_model->get_booking_transaction($booking_id);
			$html = $this->load->view('booking_live_blocks/booking_button_actions/accept_reject_button', $data, true);
			echo json_encode(array("html" => "$html"));
			die;
		}
	}

	public function owner_waiting_for_pickup() {

		if ($this->input->is_ajax_request()) {
			$booking_id = $this->input->post('id');
			$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
			/* if request is expired */
			if ($data['pickup_confirmed'] == 1 || $data['forms_towards_renter']['owner'] == "") {
				echo json_encode(array("status" => true));
				die;
			}
			echo json_encode(array("status" => false));
			die;
		}
	}

	public function reject_request() {
		/*
		 * owner and renter can both reject the request
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_reject_request_by_car_owner',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_reject_request_by_car_renter',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function accept_request_by_owner() {
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_accept_request_by_car_owner',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	/* car pickup flow  start here */

	public function reached_at_location_pickup() {
		/*
		 * owner and renter can both reach at location
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_set_car_owner_reached_at_location',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_set_car_renter_reached_at_location',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function notify_about_delay() {
		/*
		 * owner and renter can both notify about delay
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_request_car_owner_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_request_car_renter_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function user_has_delay() {
		/*
		 * owner and renter can both use this function to each other
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_set_car_renter_is_not_showing',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_set_car_owner_is_not_showing',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function non_show_user() {
		/*
		 * owner and renter can both use this function to each other
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_mark_car_renter_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_mark_car_owner_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	/* car pickup flow end here */

	/*	 * ********************************  car DROPOFF flow start here ******************************************* */

	public function sync_page_dropoff() {

		if ($this->input->is_ajax_request()) {
			$booking_id = $this->input->post('id');
			$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
			/* if request is expired */
			if ($data['rejected_by_car_owner'] == 1 || $data['rejected_by_car_renter'] == 1) {
				echo json_encode(array("html" => "<span class='btn-danger theme-btn float-right'>REQUEST IS EXPIRED.</span>"));
				die;
			}

			$html = $this->load->view('booking_live_blocks/booking_button_actions/accept_reject_dropoff_button', $data, true);
			echo json_encode(array("html" => "$html"));
			die;
		}
	}

	public function notify_about_delay_dropoff() {
		/*
		 * owner and renter can both notify about delay
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_request_car_owner_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_request_car_renter_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function reached_at_location_dropoff() {
		/*
		 * owner and renter can both reach at location
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_car_owner_reached_at_location',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_car_renter_reached_at_location',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function user_has_delay_dropoff() {
		/*
		 * owner and renter can both use this function to each other
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_set_car_renter_is_not_showing',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_set_car_owner_is_not_showing',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function non_show_user_dropoff() {
		/*
		 * owner and renter can both use this function to each other
		 */
		$booking_id = $this->input->get('booking_id');
		$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
		// get user type
		if ($data['booking_user_type'] == "owner") {
			//call owner reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_mark_car_renter_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_user_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}

		if ($data['booking_user_type'] == "renter") {
			// call renter reject request
			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_return_mark_car_owner_is_delay',
				'data' => array('id' => $data['id'], 'car_id' => $data['car_id'], 'car_renter_id' => $this->active_user_id)
			);
			$result = get_data_with_curl($option);
		}
		redirect(__CLASS__ . '/booking/' . $booking_id);
	}

	public function renter_waiting_for_dropoff() {

		if ($this->input->is_ajax_request()) {
			$booking_id = $this->input->post('id');
			$data = $this->get_booking_data_with_user($booking_id, $active_user = $this->active_user_id);
			/* if request is expired */
			if ($data['transaction_complete'] == 1 || $data['forms_towards_owner']['renter'] == "") {
				echo json_encode(array("status" => true));
				die;
			}
			echo json_encode(array("status" => false));
			die;
		}
	}

}
