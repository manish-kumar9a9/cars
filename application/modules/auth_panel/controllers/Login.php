<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');

	}

	public function index(){
		if($this->session->userdata('active_backend_user_flag') && $this->session->userdata('active_backend_user_flag') ){
			redirect(site_url('auth_panel/admin/index'));
			die;
		}
		if ($this->input->post()) {
				print_r($this->input->post('username'));
				$this->db->Where("username", $this->input->post('username'));
				$this->db->Where("password", md5($this->input->post('password')));
				$this->db->Where("status", '0');
				$result = $this->db->get('urend_backend_user')->row();
				if (!empty($result)) {
						/*
						* setting session according to auth_panle_ini file in controller master file of panel
						*/

						$newdata = array(
						        'active_backend_user_flag'  => True,
						        'active_backend_user_id'     => $result->id,
										'active_user_data'						=>$result
						);

						$this->session->set_userdata($newdata);
						redirect(site_url('auth_panel/admin/index'));
						die;
				}
		}
		$this->load->view('login/login');

	}

	public function logout(){
			$this->session->sess_destroy();
			redirect(site_url('auth_panel/login/index'));
	}

}
