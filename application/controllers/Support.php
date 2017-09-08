<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->helper('array');
	}

	public function index() {
            $this->load->view('support_view');
        }
}