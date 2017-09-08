<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('array');
				/* language changer */
		$this->language = ($this->input->cookie('lang') == "")?"english":$this->input->cookie('lang');
		$this->lang->load('master', $this->language );
	}

	public function index() {
		$data['renter_help'] = $this->db
			->select('*')
			->where('faq_for', "RENTER")
			->where('faq_language', $this->language)
			->order_by('faq_type', "asc")
			->get('faq')
			->result_array();

		$data['owner_help'] = $this->db
			->select('*')
			->where('faq_for', "OWNER")
			->where('faq_language', $this->language)
			->order_by('faq_type', "asc")
			->get('faq')
			->result_array();

		$this->load->view('help', $data);
	}

}
