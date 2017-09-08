<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class How_urend_works extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->helper('array');
	}

	public function index() {
            $this->load->view('how_urend_works_view');
        }
        
        
}