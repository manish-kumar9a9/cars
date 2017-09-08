<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Rating_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/* INSERTION OF RATING AND REVIEWS */

	public function rate_car($data) {
		$this->db->insert('urend_car_rating', $data);
		return true;
	}

	public function rate_user($data) {
		$this->db->insert('urend_user_rating', $data);
		return true;
	}

	/* user reviews */

	public function get_all_user_reviews($user_id) {

		$query = $this->db->query(" select IF (ur.profileImage !='',  concat('" . base_url('profileImages') . "/', ur.profileImage),'') as givenby_user_image , 
                                                concat(ur.firstName,' ',ur.lastName) as givenby_username , 
                                                uur.*
                                    FROM urend_user_rating as uur left join urend_users as ur on ur.userId = uur.given_by
                                    WHERE uur.user_id ='$user_id'
                                 ");
		return $query->result_array();
	}

	/* car reviews */

	public function get_all_car_reviews($car_id) {

		$query = $this->db->query("select IF (ur.profileImage !='', concat('" . base_url('profileImages') . "/', ur.profileImage),'') as givenby_user_image , 
                                                concat(ur.firstName,' ',ur.lastName) as givenby_username , 
                                                ucr.*
                                    FROM urend_car_rating as  ucr left join urend_users as ur on ur.userId = ucr.given_by
                                    WHERE ucr.car_id ='$car_id'
                                 ");
		return $query->result_array();
	}

	public function get_all_user_reviews_for_all_cars($user_id) {

		$query = $this->db->query("select IF (ur.profileImage !='', concat('" . base_url('profileImages') . "/', ur.profileImage),'') as givenby_user_image , 
                                    concat(ur.firstName,' ',ur.lastName) as givenby_username , 
                                    ucr.*
                                    FROM urend_car_rating as  ucr left join urend_users as ur on ur.userId = ucr.given_by
                                    Left join urend_car_details as ucd on ucd.id = ucr.car_id
                                    where ucd.fk_user_id = '$user_id'
                                 ");
		return $query->result_array();
	}

	/* This function is used to check  rating given by a user to perticular booking id */

	public function check_user_car_booking_status($booking_id, $user_id) {

		$this->db->where('booking_request_id', $booking_id);
		$this->db->where('given_by', $user_id);
		if ($result = $this->db->get('urend_car_rating')->row_array()) {
			return true;
		}
		return false;
	}

	public function check_booking_user_rating_status($booking_id, $user_id) {

		$this->db->where('request_id', $booking_id);
		$this->db->where('given_by', $user_id);
		if ($result = $this->db->get('urend_user_rating')->row_array()) {
			return true;
		}
		return false;
	}

}
