<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
		$this->load->helper('array');
	}

	public function index() {
		$lang = $this->input->cookie('lang');
		if($lang == "") {$lang = "english";}
		$data['page_content'] =  get_web_meta_data ($lang.'_policy');
		$this->load->view('policy_view',$data);
	}

}
