<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_pusher extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	/*
	* this send_push_to_user function is used to send  push notification to ios and android 
	*/

    private function send_push_to_user($user_id ="" , $data =array()){

    	/* get user id and make condition here */
    	$user_data = $this->user_model->userProfile(array('userId' => $user_id ));
    	$token = $device = "";

    	if($user_data['deviceType'] == 1){
    		$token = $user_data['deviceToken'];
    		$device = "ios";
    		generatePush($device , $token, $data);
    	}
    	if($user_data['deviceType'] == 0){
    		$token = $user_data['deviceToken'];
    		$device = "android";
    		generatePush($device , $token, $data);
    	}

    }


	public function push_message(){ 
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$request_para['user_id']      = $this->input->post('user_id');
			$request_para['data']         = $this->input->post('data');
				$this->send_push_to_user($request_para['user_id'],$request_para['data'] );
				$isSuccess = true;
				$message   = $this->lang->line('action_performed_successfully');
				$data      = array();  				
		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

}