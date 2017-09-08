<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('rating_model');
	}

	public function get_all_reviews_of_cars(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$request_para['car_id']      = $this->input->post('car_id');

			$reviews = $this->rating_model->get_all_car_reviews($request_para['car_id']);
			if(count($reviews) > 0 ){

				$isSuccess = True;
				$message   = $this->lang->line('reviews_list_found');
				$data      = $reviews;  

			}else{
				$isSuccess = False;
				$message   = $this->lang->line('no_reviews_found');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));	

	}


	public function get_all_reviews_of_users(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$request_para['user_id']      = $this->input->post('user_id');
			
			$reviews = $this->rating_model->get_all_user_reviews($request_para['user_id']);
			if(count($reviews) > 0 ){

				$isSuccess = True;
				$message   = $this->lang->line('reviews_list_found');
				$data      = $reviews;  

			}else{
				$isSuccess = False;
				$message   = $this->lang->line('no_reviews_found');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));	

	}	

	public function get_all_reviews_user_all_cars(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$request_para['user_id']      = $this->input->post('user_id');

			$reviews = $this->rating_model->get_all_user_reviews_for_all_cars($request_para['user_id']);
			if(count($reviews) > 0 ){

				$isSuccess = True;
				$message   = $this->lang->line('reviews_list_found');
				$data      = $reviews;  

			}else{
				$isSuccess = False;
				$message   = $this->lang->line('no_reviews_found');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));		
	}

	/*  rate car independet service*/
	public function give_rate_to_user(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$rating_para['user_id']             =   $this->input->post('car_renter_id');
			$rating_para['given_by']            =   $this->input->post('car_owner_id');
			$rating_para['request_id']          =   $this->input->post('booking_id');
			$rating_para['rating']              =   $this->input->post('rating');
			$rating_para['remarks']             =   $this->input->post('remarks');
			$rating_para['date']                =   date('Y-m-d H:i:s');

			if($this->rating_model->rate_user($rating_para)){

				$isSuccess = True;
				$message   = $this->lang->line('action_performed_successfully');
				$data      = array();

			}else{
				$isSuccess = False;
				$message   = $this->lang->line('not_able_to_perform_this_action');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   = $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));	

	}

	/*  rate car independet service*/
	public function give_rate_to_car(){
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if($this->input->post()){
			$request_para = array();

			$rating_para['rating']             =   $this->input->post('rating');
			$rating_para['remarks']            =   $this->input->post('remarks');
			$rating_para['given_by']           =   $this->input->post('car_renter_id');
			$rating_para['car_id']             =   $this->input->post('car_id');
			$rating_para['booking_request_id'] =   $this->input->post('booking_id');
			$rating_para['date']               =   date('Y-m-d H:i:s');

			if($this->rating_model->rate_car($rating_para)){

				$isSuccess = True;
				$message   = $this->lang->line('action_performed_successfully');
				$data      = array();  

			}else{
				$isSuccess = False;
				$message   = $this->lang->line('not_able_to_perform_this_action');
				$data      = array();  
			}

		}else{
			$isSuccess = False;
			$message   =  $this->lang->line('request_parameters_not_valid');
			$data      = array();  

		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));	

	}

}	