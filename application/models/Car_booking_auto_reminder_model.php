<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Car_booking_auto_reminder_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function active_booking_before_hour() {

		$fromtimestamp = date('Y-m-d H:i:s');

		$totime = strtotime($fromtimestamp . ' + 60 minute');
		$totime = date('Y-m-d H:i:s', $totime);

		$query = $this->db->query("SELECT id , car_from   from urend_car_booking_master "
			. "where  car_from > '" . $fromtimestamp . "'"
			. "and car_from <= '" . $totime . "'"
			. "and id NOT IN ( SELECT booking_id FROM urend_car_booking_auto_reminder where  remind_for ='pickup') "
			. "and id  IN ( SELECT booking_id FROM urend_booking_transaction ) "
			. "and accepted_car_owner = 1 "
			. "and rejected_by_car_owner != 1 "
			. "and rejected_by_car_renter != 1 "
		);
		return $query->result_array();
	}

	public function dropoff_booking_before_hour() {

		$fromtimestamp = date('Y-m-d H:i:s');

		$totime = strtotime($fromtimestamp . ' + 60 minute');
		$totime = date('Y-m-d H:i:s', $totime);

		$query = $this->db->query("SELECT id , car_to   from urend_car_booking_master "
			. "where  car_to > '" . $fromtimestamp . "'"
			. "and car_to <= '" . $totime . "'"
			. "and pickup_confirmed =1 "
			. "and id NOT IN ( SELECT booking_id FROM urend_car_booking_auto_reminder where  remind_for ='dropoff')");
		return $query->result_array();
	}

	public function set_booking_reminder($data) {
		$this->db->insert_batch('car_booking_auto_reminder', $data);
	}

	public function rejectable_request() {
		$fromtimestamp = strtotime(date("Y-m-d H:i:00") . ' + 120 minute');
		$fromtimestamp = date('Y-m-d H:i:s', $fromtimestamp);

		$query = $this->db->query("SELECT id , car_from   from urend_car_booking_master "
			. "where  car_from <= '" . $fromtimestamp . "'"
			. "and auto_cancel_state = 0 "
			. "and id NOT IN ( SELECT booking_id FROM urend_booking_transaction )");
		return $query->result_array();
	}

	public function set_reject_status($id) {
		$array = array(
			"state" => "0",
			"auto_cancel_state" => "1"
		);
		if ($this->db->where("id", $id)->update("car_booking_master", $array)) {
			return true;
		}
		return False;
	}

	public function get_booking_reminder() {

		$query = $this->db->query("select * from urend_car_booking_auto_reminder where send_remind_at <= '" . date("Y-m-d H:i:s") . "'  and state = 0");
		return $query->result_array();
	}

	public function set_reminder_sent($id) {
		$array = array(
			"state" => "1",
		);
		if ($this->db->where("id", $id)->update("car_booking_auto_reminder", $array)) {
			return true;
		}
		return False;
	}

	
	public function request_if_pickup_not_confirmed(){
		$totime = strtotime(date("Y-m-d H:i:s") . ' - 120 minute');
		$totime = date('Y-m-d H:i:s', $totime);
		$query = $this->db->query("select id from urend_car_booking_master where car_from <= '" . $totime . "'  and pickup_confirmed = 0 and auto_cancel_state != 1 ");
		return $query->result_array();		
		
	}
}
