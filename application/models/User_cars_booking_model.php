<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_cars_booking_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function accept_request_by_car_owner($data) {
		$record = array(
			'accepted_car_owner_time' => date('Y-m-d H:i:s'),
			'accepted_car_owner' => 1,
			'state' => 1
		);

		$request_data = $this->get_request_raw_data($data['id']);
		if ($request_data['owner_response_time'] == "") {
			$record['owner_response_time'] = strtotime($record['accepted_car_owner_time']) - strtotime($request_data['creation_time']);
		}


		$this->db->where('id', $data['id']);
		$this->db->where('car_id', $data['car_id']);
		$this->db->where('car_user_id', $data['car_user_id']);
		$this->db->where('accepted_car_owner', 0);
		/* other condition check */
		$this->db->where('rejected_by_car_renter', 0);

		$this->db->update('urend_car_booking_master', $record);

		if ($this->db->affected_rows() == 1) {
			return true;
		}

		return false;
	}

	public function reject_request_by_car_owner($data) {
		$record = array(
			'rejected_by_car_owner_time' => date('Y-m-d H:i:s'),
			'rejected_by_car_owner' => 1,
			'state' => 0
		);
		$request_data = $this->get_request_raw_data($data['id']);

		if ($request_data['owner_response_time'] == "") {
			$record['owner_response_time'] = strtotime($record['rejected_by_car_owner_time']) - strtotime($request_data['creation_time']);
		}
		$this->db->where('id', $data['id']);
		$this->db->where('car_id', $data['car_id']);
		$this->db->where('car_user_id', $data['car_user_id']);
		$this->db->where('pickup_confirmed', 0);
		
		/* other condition check */
		$this->db->where('rejected_by_car_renter', 0);

		$this->db->update('urend_car_booking_master', $record);
		if ($this->db->affected_rows() == 1) {
			/* set owner response time to calculate response time of owner */

			return true;
		}
		return false;
	}

	public function reject_request_by_car_renter($data) {
		$record = array(
			'rejected_by_car_renter_time' => date('Y-m-d H:i:s'),
			'rejected_by_car_renter' => 1,
			'state' => 0
		);
		$this->db->where('id', $data['id']);
		$this->db->where('car_id', $data['car_id']);
		$this->db->where('car_renter_id', $data['car_renter_id']);

		/* other condition check */
		$this->db->where('rejected_by_car_renter', 0);
		$this->db->where('pickup_confirmed', 0);

		$this->db->update('urend_car_booking_master', $record);

		if ($this->db->affected_rows() == 1) {
			return true;
		}
		return false;
	}

	/*
	 * this function is used to get all incoming requests to perticuler car of a car owner
	 */

	public function get_car_incoming_request_for_car_owner($data) {

		$this->db->where('car_user_id', $data['car_user_id']);
		$this->db->where('car_id', $data['car_id']);
		$this->db->where('rejected_by_car_renter', 0);
		$this->db->where('rejected_by_car_owner', 0);
		$this->db->where('auto_cancel_state', 0);
		$this->db->where("car_from > '" . date("Y-m-d H:i:s") . "'");
		return $this->db->get('urend_car_booking_master')->result_array();
	}

	public function get_all_car_incoming_request($data) {

		$this->db->where('car_user_id', $data['car_user_id']);
		$this->db->where('accepted_car_owner', 0);
		$this->db->where('rejected_by_car_renter', 0);
		$this->db->where('rejected_by_car_owner', 0);
		$this->db->where('auto_cancel_state', 0);
		$this->db->where("car_from > '" . date("Y-m-d H:i:s") . "'");
		return $this->db->get('urend_car_booking_master')->result_array();
	}

	/*
	 *
	 */

	public function get_all_request_sent_by_user($data) {

		$this->db->where('car_renter_id', $data['car_renter_id']);
		$this->db->where('accepted_car_owner', 0);
		$this->db->where('rejected_by_car_renter', 0);
		$this->db->where('rejected_by_car_owner', 0);
		$this->db->where('auto_cancel_state', 0);
		$this->db->where("car_from > '" . date("Y-m-d H:i:s") . "'");
		return $this->db->get('urend_car_booking_master')->result_array();
	}

	public function set_car_renter_is_not_showing($data) {


		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'non_show_renter',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */

		//if($this->db->update('urend_car_booking_master',$record)){
		return true;
		//}
		return false;
	}

	public function set_car_owner_is_not_showing($data) {

		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'non_show_owner',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function set_car_renter_reached_at_location($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'car_renter_reached_at_location',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function set_car_owner_reached_at_location($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'car_owner_reached_at_location',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function car_owner_requesting_delay($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'owner_requesting_time_delay',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function car_renter_requesting_delay($data) {


		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'renter_requesting_time_delay',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function get_user_active_booking($data) {

		$where = '(car_renter_id="' . $data['user_id'] . '" or car_user_id = "' . $data['user_id'] . '")';
		$this->db->where($where);
		$this->db->where('rejected_by_car_renter', 0);
		$this->db->where('rejected_by_car_owner', 0);
		$this->db->where('accepted_car_owner', 1);
		$this->db->where('transaction_complete', 0);
		$this->db->where('auto_cancel_state', 0);
		$this->db->order_by("id", "DESC");
		return $this->db->get('urend_car_booking_master')->result_array();
	}

	public function get_user_booking_history($data) {

		$where = '(car_renter_id="' . $data['user_id'] . '" or car_user_id = "' . $data['user_id'] . '" )';
		$this->db->where($where);
		$date = date("Y-m-d H:i:s");

		$this->db->where('(  rejected_by_car_owner = "1" or rejected_by_car_renter = "1" or auto_cancel_state = 1  )');
		return $this->db->get('urend_car_booking_master')->result_array();
	}

	public function get_successfull_booking_history_records($data) {

		$where = '(car_renter_id="' . $data['user_id'] . '" or car_user_id = "' . $data['user_id'] . '" )';
		$this->db->where($where);
		$this->db->where('(  pickup_confirmed = "1" and transaction_complete = "1" )');

		return $this->db->get('urend_car_booking_master')->result_array();
	}

	public function mark_renter_delayed($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'mark_renter_delayed',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		if ($this->db->insert('urend_booking_meta', $booking_data)) {
			$this->db->where('id', $req_data['id']);
			$data = array(
				'auto_cancel_state' => 1);
			$this->db->update('urend_car_booking_master', $data);
			return true;
		}
		return false;
	}

	public function mark_owner_delayed($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'mark_owner_delayed',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_renter'
		);

		if ($this->db->insert('urend_booking_meta', $booking_data)) {
			$this->db->where('id', $req_data['id']);
			$data = array(
				'auto_cancel_state' => 1);
			$this->db->update('urend_car_booking_master', $data);
			return true;
		}
		return false;
	}

	public function save_initialize_car_info_by_owner($data) {
		$record = array(
			"user_id" => $data['car_owner_id'],
			"car_id" => $data['car_id'],
			"request_id" => $data['request_id'],
			"car_condition" => $data['car_condition'],
			"meter_reading" => $data['car_meter_reading'],
			"verify_car_dl" => $data['verify_renter_dl'],
			"remarks" => $data['car_remarks'],
			"info_by" => 'owner',
			"submission_time" => date('Y-m-d H:i:s')
		);

		if ($this->db->insert('urend_car_booking_information', $record)) {
			return $this->db->insert_id();
		}
		return false;
	}

	public function save_initialize_car_info_by_renter($data) {
		$record = array(
			"user_id" => $data['car_renter_id'],
			"car_id" => $data['car_id'],
			"request_id" => $data['request_id'],
			"meter_reading" => $data['car_meter_reading'],
			"remarks" => $data['car_remarks'],
			"info_by" => 'requester',
			"submission_time" => date('Y-m-d H:i:s')
		);
		/*
		  "renter_insurence_id"=> $data['renter_insurence_id'],
		  "renter_registration_id"=> $data['renter_registration_id'],
		  "car_condition"=> $data['car_condition'],
		 */
		if ($this->db->insert('urend_car_booking_information', $record)) {
			/* set pickup confirmed here */
			$insert_id = $this->db->insert_id();
			/* get owner last form filling time */
			$last_owner_fill_data = $this->get_owner_form_filled_whlie_giving_car($data['request_id']);

			if (count($last_owner_fill_data) > 0) {

				$diff = strtotime($record['submission_time']) - strtotime($last_owner_fill_data['submission_time']);
				$diff_minutes = $diff / 60; /* get time difference in minutes */
				if ($diff_minutes < 5) {
					$this->confirm_pickup($data['request_id']);
					return $insert_id;
				}
			}
		}
		return false;
	}

	/* this is very important function and pickup will be confirmed after hitting this */

	private function confirm_pickup($request_id) {
		$record = array(
			"pickup_confirmed" => "1"
		);
		$this->db->where('id', $request_id);
		$this->db->update('urend_car_booking_master', $record);
	}

	/* this is very important function and pickup will be confirmed after hitting this */

	private function transaction_complete($request_id) {
		$record = array(
			"transaction_complete" => "1"
		);
		$this->db->where('id', $request_id);
		$this->db->update('urend_car_booking_master', $record);
	}

	/*
	 * this function is used to to get booking transaction record w.r.t. primary booking id
	 */

	public function get_request_raw_data($request_id) {
		$sel = "(100 - (discount_weekly*100)/(car_daily_price*7)) as percent_discount_weekly ,
                                    (100 - (discount_monthly*100)/(car_daily_price*30)) as percent_discount_monthly ";
		$this->db->select("* , $sel");
		$this->db->where('id', $request_id);
		$return = ( $return = $this->db->get('urend_car_booking_master')->row_array()) ? $return : array();
		if (count($return) > 0) {
			$action = $this->get_request_action_array($request_id);

			return array_merge($return, $action);
		} else {
			return array();
		}
	}

	public function get_request_action_array($request_id) {

		$query = $this->db->query("select  * from urend_booking_meta  where request_id_fk = '$request_id'  group by transaction_action , transaction_type ");

		$result = $query->result_array();
		$return['towards_renter_action'] = $return['towards_owner_action'] = array();
		if (count($result)) {
			foreach ($result as $val) {

				if ($val['transaction_type'] == "to_renter") {
					$action = $val['transaction_action'];
					$return['towards_renter_action'][$action] = $val['action_time'];
				}
				if ($val['transaction_type'] == "to_owner") {
					$action = $val['transaction_action'];
					$return['towards_owner_action'][$action] = $val['action_time'];
				}
			}
		}
		return $return;
	}

	public function core_get_request_action($request_id) {

		$query = $this->db->query("select  * from urend_booking_meta  where request_id_fk = '$request_id'  group by transaction_action , transaction_type ");
		return $query->result_array();
	}

	/*	 * ************************************ returning-process-starts-from-here **************************************** */

	public function return_set_car_renter_reached_at_location($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'car_renter_reached_at_location',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function return_set_car_owner_reached_at_location($data) {


		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'car_owner_reached_at_location',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */

		return true;
	}

	public function return_car_owner_requesting_delay($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'owner_requesting_time_delay',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function return_car_renter_requesting_delay($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'renter_requesting_time_delay',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function return_set_car_renter_is_not_showing($data) {


		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'non_show_renter',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */
		return true;
	}

	public function return_set_car_owner_is_not_showing($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'non_show_owner',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */

		return true;
	}

	public function return_mark_renter_delayed($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'mark_renter_delayed',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */

		return true;
	}

	public function return_mark_owner_delayed($data) {

		/*		 * *************************************** */
		$req_data = $this->get_request_raw_data($data['id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'mark_owner_delayed',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);
		/*		 * ****************************************** */

		return true;
	}

	public function return_save_initialize_car_info_by_owner($data) {
		$record = array(
			"user_id" => $data['car_owner_id'],
			"car_id" => $data['car_id'],
			"request_id" => $data['request_id'],
			"car_condition" => $data['car_condition'],
			"meter_reading" => $data['car_meter_reading'],
			"info_by" => 'owner',
			"transaction_type" => 'to_owner',
			"damage_type" => $data['damage_type'],
			"submission_time" => date('Y-m-d H:i:s')
		);

		if ($this->db->insert('urend_car_booking_information', $record)) {

			$insert_id = $this->db->insert_id();
			//$this->transaction_complete($data['request_id']);
			//return $insert_id;

			$last_renter_fill_data = $this->get_renter_form_filled_whlie_giving_car($data['request_id']);

			if (count($last_renter_fill_data) > 0) {

				$diff = strtotime($record['submission_time']) - strtotime($last_renter_fill_data['submission_time']);
				$diff_minutes = $diff / 60;
				if ($diff_minutes < 5) {
					$this->transaction_complete($data['request_id']);
					return $insert_id;
				}
			}
		}
		return false;
	}

	public function return_save_initialize_car_info_by_renter($data) {
		$record = array(
			"user_id" => $data['car_renter_id'],
			"car_id" => $data['car_id'],
			"request_id" => $data['request_id'],
			"car_condition" => $data['car_condition'],
			"meter_reading" => $data['car_meter_reading'],
			"info_by" => 'requester',
			"damage_type" => $data['damage_type'],
			"transaction_type" => 'to_owner',
			"remarks" => $data['remarks'],
			"submission_time" => date('Y-m-d H:i:s')
		);

		if ($this->db->insert('urend_car_booking_information', $record)) {
			$insert_id = $this->db->insert_id();

			return $insert_id;
		}
		return false;
	}

	public function save_car_booking_images($booking_info_id, $image) {
		$data['booking_info_id'] = $booking_info_id;
		$data['image_name'] = $image;
		$this->db->insert('urend_car_booking_info_image', $data);
	}

	public function rate_car($data) {
		$this->db->where('booking_request_id',$data['booking_request_id']);
		$this->db->where('car_id',$data['car_id']);
		$this->db->where('given_by',$data['given_by']);
		$record = $this->db->get('urend_car_rating')->row_array();
		if($record){
			$this->db->where('id', $record['id']);
			$this->db->delete('urend_car_rating'); 
		}
		
		$this->db->insert('urend_car_rating', $data);
	}

	public function rate_user($data) {
		$this->db->insert('urend_user_rating', $data);
	}

	public function return_save_claim($data) {

		$this->db->insert('urend_car_claim', $data);
		$return = $this->db->insert_id();
		$req_data = $this->get_request_raw_data($data['booking_id']);

		$booking_data = array(
			'request_id_fk' => $req_data['id'],
			'car_owner_id' => $req_data['car_user_id'],
			'car_requester_id' => $req_data['car_renter_id'],
			'transaction_action' => 'owner_claim_for_car',
			'action_time' => date('Y-m-d H:i:s'),
			'transaction_type' => 'to_owner'
		);

		$this->db->insert('urend_booking_meta', $booking_data);

		return $return;
	}

	public function save_car_claim_images($booking_id, $image) {

		$data['booking_id'] = $booking_id;
		$data['image_name'] = $image;
		$this->db->insert('urend_car_claim_images', $data);
	}

	/* while sending */

	public function get_owner_form_filled_whlie_giving_car($booking_id) {

		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $booking_id and
									 transaction_type = 'to_renter' and
									 info_by = 'owner'
									 order by id desc limit 0,1 ");

		$result = $query->row_array();
		if (count($result) > 0) {
			$diff = strtotime(date('Y-m-d H:i:s')) - strtotime($result['submission_time']);
			$diff_minutes = $diff / 60; /* get time difference in minutes */
			if ($diff_minutes > 5) {
				return array();
			}
		}
		return $result;
	}

	/* while sending */

	public function get_renter_form_filled_whlie_getting_car($booking_id) {

		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $booking_id and
									 transaction_type = 'to_renter' and
									 info_by = 'requester' order by id desc limit 0,1 ");
		return $result = $query->row_array();
	}

	/* while getting */

	public function get_owner_form_filled_whlie_getting_car($booking_id) {

		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $booking_id and
									 transaction_type = 'to_owner' and
									 info_by = 'owner' order by id desc limit 0,1 ");
		return $result = $query->row_array();
	}

	/* while sending */

	public function get_renter_form_filled_whlie_giving_car($booking_id) {

		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $booking_id and
									 transaction_type = 'to_owner' and
									 info_by = 'requester' order by id desc limit 0,1 ");
		return $result = $query->row_array();
	}

	/*
	 * this function to used to get information about a user last  booking to perticuler car
	 */

	public function get_last_booking_user_data_with_car($data) {

		$this->db->where('car_renter_id', $data['car_renter_id']);
		$this->db->where('car_id', $data['car_id']);
		$this->db->order_by("id", "desc");
		$this->db->limit(1, 0);
		return $this->db->get('urend_car_booking_master')->row_array();
	}
	
	public function save_booking_transaction($data){
		$info =  array(
			"booking_id" => $data['booking_id'],
			"booking_amount"=>$data['booking_amount'],
			"transaction_id" =>$data['transaction_id'] ,
			"creation_time"=> time()
		);
		$this->db->insert('urend_booking_transaction',$info);
	}
	
	public function get_booking_transaction($booking_id){
		$this->db->where('booking_id', $booking_id);
		$this->db->limit(1, 0);
		return $this->db->get('urend_booking_transaction')->row_array();
	}
	
	public function info_pickup_booking($id){
		
		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $id and
									 transaction_type = 'to_renter' and
									 info_by = 'requester' order by id desc limit 0,1 ");
		$result['pickup_renter'] = $query->row_array();
		if(count($result['pickup_renter']) > 0 ){
			$query = $this->db->query("SELECT * ,
									IF (image_name!='', concat('" . base_url('uploads/car_booking_images') . "/', image_name),'') as image_name
									FROM urend_car_booking_info_image
									 WHERE booking_info_id = ".$result['pickup_renter']['id'] ."" );
			$result['pickup_renter']['images'] = $query->result_array();
		}
		
		
		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $id and
									 transaction_type = 'to_renter' and
									 info_by = 'owner' order by id desc limit 0,1 ");
		$result['pickup_owner'] = $query->row_array();
		if(count($result['pickup_owner']) > 0 ){
			$query = $this->db->query("SELECT * ,
										IF (image_name!='', concat('" . base_url('uploads/car_booking_images') . "/', image_name),'') as image_name
										FROM urend_car_booking_info_image
									 WHERE booking_info_id = ".$result['pickup_owner']['id'] ."" );
			$result['pickup_owner']['images'] = $query->result_array();
		}
		return $result;
	}
	
	public function info_dropoff_booking($id){
		
		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $id and
									 transaction_type = 'to_owner' and
									 info_by = 'requester' order by id desc limit 0,1 ");
		$result['dropoff_renter'] = $query->row_array();
		if(count($result['dropoff_renter']) > 0 ){
			$query = $this->db->query("SELECT * ,
									IF (image_name!='', concat('" . base_url('uploads/car_booking_images') . "/', image_name),'') as image_name
									FROM urend_car_booking_info_image
									 WHERE booking_info_id = ".$result['dropoff_renter']['id'] ."" );
			$result['dropoff_renter']['images'] = $query->result_array();
		}
		
		
		$query = $this->db->query("SELECT * FROM urend_car_booking_information
									 WHERE request_id = $id and
									 transaction_type = 'to_owner' and
									 info_by = 'owner' order by id desc limit 0,1 ");
		$result['dropoff_owner'] = $query->row_array();
		if(count($result['dropoff_owner']) > 0 ){
			$query = $this->db->query("SELECT * ,
										IF (image_name!='', concat('" . base_url('uploads/car_booking_images') . "/', image_name),'') as image_name
										FROM urend_car_booking_info_image
									 WHERE booking_info_id = ".$result['dropoff_owner']['id'] ."" );
			$result['dropoff_owner']['images'] = $query->result_array();
		}
		return $result;
	}	
	
	
	// save transaction 
	
	public function insert_transaction($data){
		$this->db->insert('booking_payout', $data);
	}
	
	public function update_transaction($data){
		$this->db->where('id',$data['id']);
		$this->db->update('booking_payout', $data);
	}
	
	public function get_payout_with_booking_id($booking_id){
		$this->db->where('booking_id',$booking_id);
		return $this->db->get('booking_payout')->result_array();
	}


	public function booking_complete_pay_back($booking_id){
		$data = array('status'=>1);
		$result = $this->db->where('booking_id',$booking_id)->update('urend_booking_transaction',$data);
		return $result;
	}
}
