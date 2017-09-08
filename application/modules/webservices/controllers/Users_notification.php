<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_notification extends MX_Controller {


	function __construct() {
		parent::__construct();
		/* from main model folder in ci -setup */
		$this->load->model('user_notification_model');
	}

	public function get_user_notification(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$request_para['user_id']          =  $this->input->post('user_id');

			if($request_para['user_id'] != ""){

				$isSuccess = True;
				$message   = $this->lang->line('data_fetched_successfully');
				$data      = $this->user_notification_model->get_notification_with_id($request_para['user_id'] );
			}else{
				$isSuccess = False;
				$message   = $this->lang->line('no_record_found');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));

	}
}