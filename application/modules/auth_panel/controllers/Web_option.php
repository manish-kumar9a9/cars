<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Web_option extends MX_Controller {

	function __construct() {
		parent::__construct();
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('car_detail_model');
	}

	public function index() {

		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
		}
		$data['page_title'] = "Web footer settings";
		$data['page_data'] = $this->load->view('web_option/footer_settings', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function google_analytics() {
		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
		}
		$data['page_title'] = "Google Analytics";
		$data['page_data'] = $this->load->view('web_option/google_analytics', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function social_login_settings() {
		if ($this->input->post()) {
			if(!$this->input->post('enable_social')){
				web_meta_data(strtoupper('enable_social'), 0);
			}

			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
		}
		$data['page_title'] = "Google Analytics";
		$data['page_data'] = $this->load->view('web_option/social_login_settings', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function mango_pay_credentials() {
		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
			
			$data['page_toast'] = 'Saved successfully.';
			$data['page_toast_type'] = 'success';
			$data['page_toast_title'] = 'Action performed.';
		}
		$data['page_title'] = "Mango Pay Credentials";
		$data['page_data'] = $this->load->view('web_option/mango_pay_credentials', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	function database_backup() {
		$this->load->dbutil();
		$prefs = array('format' => 'zip', // gzip, zip, txt 
			'filename' => 'backup_' . date('d_m_Y_H_i_s') . '.sql',
			// File name - NEEDED ONLY WITH ZIP FILES 
			'add_drop' => TRUE,
			// Whether to add DROP TABLE statements to backup file
			'add_insert' => TRUE,
			// Whether to add INSERT data to backup file 
			'newline' => "\n"
			// Newline character used in backup file 
		);
		// Backup your entire database and assign it to a variable 
		$backup = & $this->dbutil->backup($prefs);
		// Load the file helper and write the file to your server 
		$this->load->helper('file');
		write_file('/path/to/' . 'dbbackup_' . date('d_m_Y_H_i_s') . '.zip', $backup);
		// Load the download helper and send the file to your desktop 
		$this->load->helper('download');
		force_download('dbbackup_' . date('d_m_Y_H_i_s') . '.zip', $backup);
	}

	public function google_map() {
		$data['page_title'] = "Google Analytics";
		$view_data["car_lat_long"] = $this->car_detail_model->car_detail_for_map();
		$data['page_data'] = $this->load->view('web_option/google_map', $view_data , TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}
	
	public function you_earn_value(){
		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
			
			$data['page_toast'] = 'Saved successfully.';
			$data['page_toast_type'] = 'success';
			$data['page_toast_title'] = 'Action performed.';
		}
		$data['page_title'] = "You Earn Value";
		$data['page_data'] = $this->load->view('web_option/you_earn_value', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function security_deposit(){
		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
			
			$data['page_toast'] = 'Saved successfully.';
			$data['page_toast_type'] = 'success';
			$data['page_toast_title'] = 'Action performed.';
		}
		$data['page_title'] = "Security_deposit";
		$data['page_data'] = $this->load->view('web_option/security_deposit', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}	
	
	public function terms_and_policy(){
		
		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
			
			$data['page_toast'] = 'Saved successfully.';
			$data['page_toast_type'] = 'success';
			$data['page_toast_title'] = 'Action performed.';
		}
		$data['page_title'] = "Terms And Policy";
		$data['page_data'] = $this->load->view('web_option/terms_and_policy', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);	
		
	}

	public function car_details_settings() {

		if ($this->input->post()) {
			foreach ($_POST as $key => $value) {
				if (!empty($key)) {
					web_meta_data(strtoupper($key), $value);
				}
			}
			$data['page_toast'] = 'Saved successfully.';
			$data['page_toast_type'] = 'success';
			$data['page_toast_title'] = 'Action performed.';
		}
		$data['page_title'] = "Car details settings";
		$data['page_data'] = $this->load->view('web_option/car_details_settings', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

}
