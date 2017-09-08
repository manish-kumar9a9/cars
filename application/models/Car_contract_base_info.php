<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Car_contract_base_info extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function save_basic_info($data){
		$this->db->insert("car_contract_base_info",$data);
		
	}
	
	public function update_basic_info($data){
		//$this->
	}
}	