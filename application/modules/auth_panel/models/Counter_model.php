<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Counter_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function counter_total_users() {
		$this->db->select('*');
		$query = $this->db->get('urend_users');
		return $query->num_rows();
	}

	public function counter_total_listed_cars() {
		$this->db->select('*');
		$query = $this->db->get('urend_car_details');
		return $query->num_rows();
	}

	public function counter_total_rental_requests() {
		$this->db->select('*');
		$query = $this->db->get('car_booking_master');
		return $query->num_rows();
	}

	public function counter_total_booking() {
		$this->db->select('*');
		$this->db->where('accepted_car_owner =', 1);
		$this->db->where('rejected_by_car_owner !=', 1);
		$this->db->where('rejected_by_car_owner !=', 1);
		$query = $this->db->get('car_booking_master');

		return $query->num_rows();
	}

	public function counter_total_users_today() {
		$this->db->select('*');
		$this->db->where('date(createdAt) =', date("Y-m-d"));
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function counter_total_listed_cars_today() {
		$this->db->select('*');
		$this->db->where('date(createdDate) =', date("Y-m-d"));
		$query = $this->db->get('car_details');
		return $query->num_rows();
	}

	public function counter_total_rental_requests_today() {
		$this->db->select('*');
		$this->db->where('date(creation_time) =', date("Y-m-d"));
		$query = $this->db->get('car_booking_master');
		return $query->num_rows();
	}

	public function counter_total_booking_today() {
		$this->db->select('*');
		$this->db->where('accepted_car_owner =', 1);
		$this->db->where('rejected_by_car_owner !=', 1);
		$this->db->where('rejected_by_car_owner !=', 1);
		$this->db->where('date(creation_time) =', date("Y-m-d"));
		$query = $this->db->get('car_booking_master');
		return $query->num_rows();
	}

}
