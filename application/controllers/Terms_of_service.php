<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_of_service extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('array');
				/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function index() {
            $this->load->view('terms_of_service_view');
        }
        
        
}