<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Car_detail_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function car_detail_for_map() {
		return  $this->db->select('id,carPickUpLat,carPickUpLon')->get('urend_car_details')->result_array();
	}

	function update_car_market_value($id,$value) {
		$array = array('market_value'=>$value);
		$result = $this->db->where('id',$id)->update('urend_car_details',$array);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	function get_car_market_value($id) {
		$result = $this->db->select('market_value')->where('id',$id)->get('urend_car_details')->row_array();
		return $result['market_value'];
	}

}
