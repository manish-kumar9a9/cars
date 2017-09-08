<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_account extends CI_Controller {

	function __construct() {
		parent::__construct();
		/*
		 * logout if seesion out
		 */
		if ($this->session->userdata('userId') == "") {
			redirect('user/logout');
		}
		$this->load->helper('array');
		$this->load->model('user_model');
		$this->load->library('mango_pay');
	}

	public function index() {
		$this->load->view('bank_account/add_account',array());
	}

}
