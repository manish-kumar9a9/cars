<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public $active_user_id = "";

	function __construct() {

		parent::__construct();
		$login_user = $this->session->userdata();  // pre($login_user );

		if ($this->session->userdata('userId') == "") {
			redirect('');
		}
		$this->active_user_id = $login_user['userId'];
				/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function index() {
		$login_user = $this->session->userdata();
		$data['session_user'] = $login_user['userId'];
		$data['user_chat'] = 0;
		$this->load->view('chat_block/chat', $data);
	}

	public function online($id) {
		$login_user = $this->session->userdata();
		$data['session_user'] = $login_user['userId'];
		$data['user_chat'] = $id;
		$this->load->view('chat_block/chat', $data);
	}

}
