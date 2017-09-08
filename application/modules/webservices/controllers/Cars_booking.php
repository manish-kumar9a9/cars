<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cars_booking extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_cars_model');
		$this->load->model('user_cars_booking_model');
		$this->load->model('user_model');
		$this->load->model('rating_model');
		$this->load->library('email');
	}

	public function uploadfile($key, $folder_on_root) {
		$folder_on_root = $folder_on_root . "/";
		$files = $_FILES[$key];
		$file_name = "";
		if ($files['error'] == 0) {
			$file_name = rand(1, 10) . time() . basename($_FILES[$key]["name"]);
			$target_file = $folder_on_root . $file_name;

			if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
				$imgs = array('url' => '/' . $folder_on_root, 'name' => $files['name']);
			}
		}
		return $file_name;
	}

	/* *********************************************************************************** */
	/*
	 * this will work for car owner to accept the car request
	 * request can ! be acceptable if renter denied the request
	 * car owner can not perform any action if request is already denied by user
	 */

	public function request_acceptable_by_car_owner() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['id'] = $this->input->post('id');

			/* first deduct the amount here than proceed */
			$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
			if($booking_data['accepted_car_owner'] ==1 ){
				$isSuccess = False;
				$message = $this->lang->line('already_accepted_please_reopen_refresh_this_page');
				$data = array();
			}elseif ($this->user_cars_booking_model->accept_request_by_car_owner($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_accepted_successfully');
				$data = array();
				/* send email tio renter */
				$this->send_rental_request_accepted($booking_data);
				/* send push */
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20006,
						'message' =>$this->lang->line('request_accepted_by_car_owner'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				/* reset the language*/
				$this->lang->load('master', $this->language);
				
			} else {
				$isSuccess = False;
				$message = $this->lang->line('request_can_not_be_accepted');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}
	
	public function send_rental_request_accepted($booking_data) {
		
		$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'urend.com',
					'smtp_port' => 25,
					'smtp_user' => 'booking@urend.com',
					'smtp_pass' => 'Urend2016$',
				);
		/* fetch complete booking data */
		
		$booking_data = $this->get_single_request_data($booking_data['id']);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($booking_data['car_renter_data']['email']);
		$this->email->subject('Rental Request Accepted By Owner');
		$this->email->message($this->load->view('email_templates/to_renter_request_accepted', $booking_data ,True));
		$this->email->set_mailtype("html");
		$this->email->send();
	}
	
	/************************************************************************************ */
	/*
	 * this will work for car owner to cancel the car request
	 */

	public function reject_request_by_car_owner() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->reject_request_by_car_owner($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_rejected_successfully');
				$data = array();
				/* send push */				
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10002,
						'message' => $this->lang->line('request_rejected_by_car_owner'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', $this->language);
			} else {
				$isSuccess = False;
				$message = $this->lang->line('request_can_not_be_rejected');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/************************************************************************************* */
	/*
	 * this will work for car renter to cancel the car request
	 */

	public function reject_request_by_car_renter() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->reject_request_by_car_renter($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_rejected_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);

				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20002,
						'message' => $this->lang->line('request_rejected_by_car_renter'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = False;
				$message = $this->lang->line('request_can_not_be_rejected');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * This function is used to get all request to perticular car id and to car owner
	 */

	public function get_incoming_requests_to_car_owner() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_user_id'] = $this->input->post('car_user_id');

			if ($record_found = $this->user_cars_booking_model->get_car_incoming_request_for_car_owner($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				$data = array();

				foreach ($record_found as $rf) {
					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * we are using this function to get all incoming requests to a user for any car
	 */

	public function get_all_incoming_requests_to_car_owner() {

			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();
			$request_para['car_user_id'] = $this->input->post('car_user_id');

			if ($record_found = $this->user_cars_booking_model->get_all_car_incoming_request($request_para)) {

				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				$data = array();

				foreach ($record_found as $rf) {
					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * we are using this function to get list of complete payment of a user
	 * just like a complete booking history
	 */

	public function get_all_complete_booking_history() {

		if ($this->input->post()) {
			$request_para = array();
			$request_para['car_user_id'] = $this->input->post('car_user_id');

			if ($record_found = $this->user_cars_booking_model->get_all_car_incoming_request($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = "Request found.";
				$data = array();

				foreach ($record_found as $rf) {
					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = "No request found.";
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = "Request parameters are not valid.";
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * Get all request sent by a user
	 */

	public function get_all_request_sent_by_user() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			if ($record_found = $this->user_cars_booking_model->get_all_request_sent_by_user($request_para)) {

				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				$data = array();

				foreach ($record_found as $rf) {
					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message =$this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used if car renter is not showing at the time of handshake between car renter and car owner
	 */

	public function car_renter_is_not_showing() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');


			if ($this->user_cars_booking_model->set_car_renter_is_not_showing($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10003,
						'message' => $this->lang->line('car_owner_is_notifying_about_renter_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is uesd if car owner is not showing at the time of handshake between car renter and car owner
	 */

	public function car_owner_is_not_showing() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');
			if ($this->user_cars_booking_model->set_car_owner_is_not_showing($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20003,
						'message' => $this->lang->line('car_renter_is_notifying_about_owner_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message =  $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * car renter reached at location
	 */

	public function car_renter_reached_at_location() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->set_car_renter_reached_at_location($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20000,
						'message' => $this->lang->line('car_renter_reached_at_location'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * car owner reached at location
	 */

	public function car_owner_reached_at_location() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->set_car_owner_reached_at_location($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10000,
						'message' => $this->lang->line('car_owner_reached_at_location'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to set flag if car owner is not able to be on time before reaching at meeting location
	 */

	public function car_owner_is_delay() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->car_owner_requesting_delay($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10001,
						'message' => $this->lang->line('car_owner_is_notifying_about_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to set flag if car renter is not able to be on time before reaching at meeting location
	 */

	public function car_renter_is_delay() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->car_renter_requesting_delay($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20001,
						'message' =>$this->lang->line('car_renter_is_notifying_about_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to mark that opposite person is not  at it is mark_renter_delayed
	 */

	public function set_mark_renter_delayed_by_owner() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->mark_renter_delayed($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10004,
						'message' => $this->lang->line('car_owner_set_you_as_non_show_renter'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to mark that opposite person is not  at it is mark_owner_delayed
	 */

	public function set_mark_owner_delayed_by_renter() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->mark_owner_delayed($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				$push_data = json_encode(
					array(
						'notification_code' => 20004,
						'message' => $this->lang->line('renter_set_you_as_non_show_owner'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to get all active booking records of user
	 * can be a car renter or owner
	 */

	public function get_user_active_booking_records() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */

			$request_para['user_id'] = $this->input->post('user_id');

			if ($record_found = $this->user_cars_booking_model->get_user_active_booking($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				foreach ($record_found as $rf) {
					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_booking_available');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to get all active booking records of user
	 * can be a car renter or owner
	 */

	public function get_user_pending_payment_booking() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		$isSuccess = false;
		$data = array();
		$message = $this->lang->line('no_pending_payments');
		
		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */

			$request_para['user_id'] = $this->input->post('user_id');

			if ($record_found = $this->user_cars_booking_model->get_user_active_booking($request_para)) {
				/* status will be true only if transaction is successfull */
				foreach ($record_found as $rf) {
					$data_booking = $this->get_single_request_data($rf['id']);
					if(count( $data_booking['booking_renter_transaction']) < 1 and  $data_booking['car_user_id']  != $request_para['user_id'] ){
						$data[] = $data_booking;	
						$isSuccess = true;
						$message = $this->lang->line('request_found');
					}
				}
			} 
		} else {
			$message = $this->lang->line('request_parameters_not_valid');
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}
	
	
	
	public function get_user_booking_history_records() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		

		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */

			$request_para['user_id'] = $this->input->post('user_id');

			if ($record_found = $this->user_cars_booking_model->get_user_booking_history($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				foreach ($record_found as $rf) {

					$data[] = $this->get_single_request_data($rf['id']);
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_booking_history_available');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is uesd to get all booking history which are
	 * complete , expire , rejected
	 */

	public function get_successfull_booking_history_records() {

			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */

			$request_para['user_id'] = $this->input->post('user_id');

			if ($record_found = $this->user_cars_booking_model->get_successfull_booking_history_records($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('request_found');
				foreach ($record_found as $rf) {

					$rf = $this->get_single_request_data($rf['id']);
					/* check if this user can rate or not */
					$rf['active_user_can_rate'] = false;
					/* for renter */
					if($request_para['user_id'] == $rf['car_renter_id'] &&  $this->rating_model->check_user_car_booking_status($rf['id'], $rf['car_renter_id']) == false  ){
						
						$rf['active_user_can_rate'] = true;
					}
					/* for owner */
					if($request_para['user_id'] == $rf['car_user_id'] &&  $this->rating_model->check_booking_user_rating_status($rf['id'], $rf['car_user_id']) == false  ){
						$rf['active_user_can_rate'] = true;
					}						
					$data[] = $rf;
				}
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_booking_history_available');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used when car owner is ready to give his car
	 * so he will fill the info and send to car renter
	 */

	public function initialize_car_info_by_owner() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($this->input->post()) {

			$request_para = array();
			/* we will get all info from user id  */
			$request_para['request_id'] = $this->input->post('request_id');
			$request_para['car_owner_id'] = $this->input->post('car_owner_id');
			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_condition'] = ($this->input->post('car_condition')) ? $this->input->post('car_condition') : '';
			$request_para['car_meter_reading'] = $this->input->post('car_meter_reading');
			$request_para['car_remarks'] = $this->input->post('car_remarks');
			$request_para['verify_renter_dl'] = $this->input->post('verify_renter_dl');

			if ($record_id = $this->user_cars_booking_model->save_initialize_car_info_by_owner($request_para)) {

				/* it will work for android/ios if images are in key sequence car_image1 , car_image2 so on to 10 */
				if ($_FILES) {
					for ($i = 1; $i <= 10; $i++) {
						if (array_key_exists('car_image' . $i, $_FILES)) {

							$car_image_name = $this->uploadfile('car_image' . $i, 'uploads/car_booking_images');
							if ($car_image_name != "") {
								$this->user_cars_booking_model->save_car_booking_images($record_id, $car_image_name);
							}
						}
					}
				}

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 10009,
						'message' => $this->lang->line('form_filled_by_car_owner'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");

				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('information_filled_successfully');
				$data = array();
			} else {
				$isSuccess = false;
				$message = $this->lang->line('error');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used when car renter is ready to take his requested  car
	 * so he will fill car  info and send to car renter
	 */

	public function initialize_car_info_by_renter() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */
			$request_para['request_id'] = $this->input->post('request_id');
			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_condition'] = ""; //;$this->input->post('car_condition');
			$request_para['car_meter_reading'] = $this->input->post('car_meter_reading');
			$request_para['car_remarks'] = $this->input->post('car_remarks');
			$request_para['renter_registration_id'] = ''; //$this->input->post('renter_registration_id');
			$request_para['renter_insurence_id'] = ''; //$this->input->post('renter_insurence_id');
			$request_para['verify_renter_dl'] = $this->input->post('verify_renter_dl');
			/* first we validate this information with owner filled form */
			/* get owner filled information */
			$owner_filled_information = $this->user_cars_booking_model->get_owner_form_filled_whlie_giving_car($request_para['request_id']);
			if (count($owner_filled_information) < 1) {
				$msg = $this->lang->line('please_wait_owner_to_fill_the_form');
				echo json_encode(array("isSuccess" => false, "message" => $msg, "Result" => array()));
				/* stop the working here */
				die;
			}
			if ($owner_filled_information['meter_reading'] !== $request_para['car_meter_reading']) {
				$msg = $this->lang->line('car_meter_reading_does_not_match');
				echo json_encode(array("isSuccess" => false, "message" => $msg, "Result" => array()));
				/* stop the working here */
				die;
			}

			if ($record_id = $this->user_cars_booking_model->save_initialize_car_info_by_renter($request_para)) {

				/* it will work for android/ios if images are in key sequence car_image1 , car_image2 so on to 10 */
				if ($_FILES) {
					for ($i = 1; $i <= 10; $i++) {
						if (array_key_exists('car_image' . $i, $_FILES)) {

							$car_image_name = $this->uploadfile('car_image' . $i, 'uploads/car_booking_images');

							$this->user_cars_booking_model->save_car_booking_images($record_id, $car_image_name);
						}
					}
				}

				/* status will be true only if transaction is successfull */
				// old $car_request = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				$car_request = $this->get_single_request_data($request_para['request_id']);
				$data = $car_request;
				$isSuccess = True;
				$message = $this->lang->line('information_filled_successfully');
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 20009,
						'message' => $this->lang->line('form_filled_by_renter'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
				
				// create car contract 
				$this->create_contract_with_api($request_para['request_id']);
			} else {
				$isSuccess = false;
				$message = $this->lang->line('car_pick_up_is_not_confirmed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function create_contract_with_api($booking_primary_id) {
		//get car data with car id 
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_primary_id)
		);
		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];
		$car_saved_info = $this->user_cars_model->get_basic_contract_info($booking_data['car_id']);
		if ($car_saved_info) {
			$data['general']['date_start'] = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
			$data['general']['date_end'] =date("Y-m-d H:i:s" , strtotime($booking_data['car_to']));
			$data['client']['lastname'] = $car_saved_info['lastname'];
			$data['client']['firstname'] = $car_saved_info['firstname'];
			$data['client']['fathername'] = $car_saved_info['fathername'];
			$data['client']['birthdate'] = $car_saved_info['birthdate'];
			$data['client']['sex'] = $car_saved_info['sex'];
			$data['client']['afm'] = $car_saved_info['afm'];
			$data['client']['street'] = $car_saved_info['street'];
			$data['client']['street_no'] = $car_saved_info['street_no'];
			$data['client']['zip_code'] = $car_saved_info['zip_code'];
			$data['client']['telephone_number'] = $car_saved_info['telephone_number'];
			$data['client']['fax'] = $car_saved_info['fax'];
			$data['client']['email'] = $car_saved_info['email'];
			$data['vehicle']['licence_plate'] = $car_saved_info['licence_plate'];
			$data['vehicle']['vehicle_model'] = $car_saved_info['vehicle_model'];
			$data['vehicle']['vehicle_color'] = $car_saved_info['vehicle_color'];
			$data['vehicle']['first_licence_date'] = $car_saved_info['first_licence_date'];
			$data['vehicle']['insured_value'] = $car_saved_info['insured_value'];
			$data['vehicle']['frame_number'] = $car_saved_info['frame_number'];

			$json_data = trim(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

			$ch = curl_init("http://194.127.7.101/UnderwritingRulesWS/urend/postoffer?md5=" . md5($json_data . "10.126.32.86"));

			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen(json_encode($data)))
			);
			
			log_message('error', "contract api ".curl_exec($ch).$json_data);	
			
			$result = json_decode(curl_exec($ch));
			curl_close($ch);

			$result = $result[1];
			//pre($result);
			//die;
			if (array_key_exists('contract_number', $result)) {
				$this->db->where("id", $booking_primary_id);
				$this->db->update("car_booking_master", array("contract_id" => $result->contract_number));
			} else {
				// failed
			}
		}
	}	
	
	
	/*	 * ************************************ returning-process-starts-from-here **************************************** */



	/*
	 * car renter reached at location
	 */

	public function return_car_renter_reached_at_location() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_set_car_renter_reached_at_location($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 40000,
						'message' => $this->lang->line('car_renter_reached_at_location'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * car owner reached at location
	 */

	public function return_car_owner_reached_at_location() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_set_car_owner_reached_at_location($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 30000,
						'message' => $this->lang->line('car_owner_reached_at_location'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to set flag if car owner is not able to be on time before reaching at meeting location
	 */

	public function return_car_owner_is_delay() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_car_owner_requesting_delay($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 30001,
						'message' => $this->lang->line('car_owner_is_notifying_about_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to set flag if car renter is not able to be on time before reaching at meeting location
	 */

	public function return_car_renter_is_delay() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_car_renter_requesting_delay($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 40001,
						'message' => $this->lang->line('car_renter_is_notifying_about_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used if car renter is not showing at the time of handshake between car renter and car owner
	 */

	public function return_car_renter_is_not_showing() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');


			if ($this->user_cars_booking_model->return_set_car_renter_is_not_showing($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 30002,
						'message' => $this->lang->line('car_owner_is_notifying_about_renter_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is uesd if car owner is not showing at the time of handshake between car renter and car owner
	 */

	public function return_car_owner_is_not_showing() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');
			if ($this->user_cars_booking_model->return_set_car_owner_is_not_showing($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 40002,
						'message' => $this->lang->line('car_renter_is_notifying_about_owner_delay'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to mark that opposite person is not  at it is mark_renter_delayed
	 */

	public function return_set_mark_renter_delayed_by_owner() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_user_id'] = $this->input->post('car_user_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_mark_renter_delayed($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				
				$push_data = json_encode(
					array(
						'notification_code' => 30003,
						'message' => $this->lang->line('car_owner_set_you_as_non_show_renter'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
				
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to mark that opposite person is not  at it is mark_owner_delayed
	 */

	public function return_set_mark_owner_delayed_by_renter() {
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			/* it is the request primary id db */
			$request_para['id'] = $this->input->post('id');

			if ($this->user_cars_booking_model->return_mark_owner_delayed($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
				/* send push */

				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				$push_data = json_encode(
					array(
						'notification_code' => 40003,
						'message' => $this->lang->line('renter_set_you_as_non_show_owner'),
						'data' => array('request_id' => $booking_data['id'])
					)
				);
				$this->send_push_to_user($booking_data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('action_can_not_performed');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used when car owner is ready to give his car
	 * so he will fill the info and send to car renter
	 */

	public function return_initialize_car_info_by_owner() {
				/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($this->input->post()) {

			$request_para = array();
			/* we will get all info from user id  */
			$request_para['request_id'] = $this->input->post('request_id');
			$request_para['car_owner_id'] = $this->input->post('car_owner_id');
			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_condition'] = ''; //$this->input->post('car_condition');
			$request_para['car_meter_reading'] = $this->input->post('car_meter_reading');
			$request_para['damage_type'] = $this->input->post('damage_type');
			/* first we validate this information with owner filled form */
			/* get owner filled information */
			$renter_filled_information = $this->user_cars_booking_model->get_renter_form_filled_whlie_giving_car($request_para['request_id']);
			if ($renter_filled_information['meter_reading'] !== $request_para['car_meter_reading']) {
				$msg = $this->lang->line('car_meter_reading_not_match_with_renter_filled_meter_reading');
				echo json_encode(array("isSuccess" => false, "message" => $msg, "Result" => array()));
				/* stop the working here */
				die;
			}

			if ($record_id = $this->user_cars_booking_model->return_save_initialize_car_info_by_owner($request_para)) {

				/* it will work for android/ios if images are in key sequence car_image1 , car_image2 so on to 10 */
				if ($_FILES) {
					for ($i = 1; $i <= 10; $i++) {
						if (array_key_exists('car_image' . $i, $_FILES)) {

							$car_image_name = $this->uploadfile('car_image' . $i, 'uploads/car_booking_images');

							$this->user_cars_booking_model->save_car_booking_images($record_id, $car_image_name);
						}
					}
				}
				$req_data = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);

				$rating_para['user_id'] = $req_data['car_renter_id'];
				$rating_para['given_by'] = $request_para['car_owner_id'];
				$rating_para['request_id'] = $request_para['request_id'];
				$rating_para['rating'] = $this->input->post('rating');
				$rating_para['remarks'] = $this->input->post('remarks');
				$rating_para['date'] = date('Y-m-d H:i:s');
				/* add user rating */
				if($rating_para['rating']  > 0 ){
					$this->user_cars_booking_model->rate_user($rating_para);
				}
				
				$data = $this->get_single_request_data($request_para['request_id']);
				
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
				$this->lang->load('master', $pusher_data['language']);
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('information_filled_successfully');

				$push_data = json_encode(
					array(
						'notification_code' => 30004,
						'message' => $this->lang->line('form_filled_by_owner'),
						'data' => array('request_id' => $data['id'])
					)
				);
				$this->send_push_to_user($data['car_renter_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('error');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used when car renter is ready to take his requested  car
	 * so he will fill car  info and send to car owner
	 */

	public function return_initialize_car_info_by_renter() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
			
		if ($this->input->post()) {
			$request_para = array();
			/* we will get all info from user id  */
			$request_para['request_id'] = $this->input->post('request_id');
			$request_para['car_renter_id'] = $this->input->post('car_renter_id');
			$request_para['car_id'] = $this->input->post('car_id');
			$request_para['car_condition'] = ''; //$this->input->post('car_condition');
			$request_para['car_meter_reading'] = $this->input->post('car_meter_reading');
			$request_para['damage_type'] = $this->input->post('damage_type');
			$request_para['remarks'] = $this->input->post('report');


			if ($record_id = $this->user_cars_booking_model->return_save_initialize_car_info_by_renter($request_para)) {

				/* it will work for android/ios if images are in key sequence car_image1 , car_image2 so on to 10 */
				if ($_FILES) {
					for ($i = 1; $i <= 10; $i++) {
						if (array_key_exists('car_image' . $i, $_FILES)) {

							$car_image_name = $this->uploadfile('car_image' . $i, 'uploads/car_booking_images');

							$this->user_cars_booking_model->save_car_booking_images($record_id, $car_image_name);
						}
					}
				}

				/* add car rating */
				$rating_para['rating'] = $this->input->post('rating');
				$rating_para['remarks'] = $this->input->post('remarks');
				$rating_para['given_by'] = $this->input->post('car_renter_id');
				$rating_para['car_id'] = $this->input->post('car_id');
				$rating_para['booking_request_id'] = $this->input->post('request_id');
				$rating_para['date'] = date('Y-m-d H:i:s');
				if($rating_para['rating'] > 0){
					$this->user_cars_booking_model->rate_car($rating_para);	
				}
				
				/* status will be true only if transaction is successfull */
				// old $car_request = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				$data = $this->get_single_request_data($request_para['request_id']);
				
				$booking_data = $this->user_cars_booking_model->get_request_raw_data($request_para['request_id']);
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
				$this->lang->load('master', $pusher_data['language']);				
				
				$isSuccess = True;
				$message = $this->lang->line('information_filled_successfully');

				$push_data = json_encode(
					array(
						'notification_code' => 40004,
						'message' => $this->lang->line('form_filled_by_renter'),
						'data' => array('request_id' => $data['id'])
					)
				);
				$this->send_push_to_user($data['car_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
			} else {
				$isSuccess = false;
				$message = $this->lang->line('error');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function claim_for_car() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {

			$request_para = array();
			/* we will get all info from user id  */
			$request_para['booking_id'] = $this->input->post('booking_id');
			$request_para['claim'] = $this->input->post('claim');


			if ($record_id = $this->user_cars_booking_model->return_save_claim($request_para)) {

				/* it will work for android/ios if images are in key sequence car_image1 , car_image2 so on to 10 */
				if ($_FILES) {
					for ($i = 1; $i <= 10; $i++) {
						if (array_key_exists('car_image' . $i, $_FILES)) {

							$car_image_name = $this->uploadfile('car_image' . $i, 'uploads/car_booking_images');

							$this->user_cars_booking_model->save_car_claim_images($record_id, $car_image_name);
						}
					}
				}

				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('action_performed_successfully');
				$data = array();
			} else {
				$isSuccess = false;
				$message = $this->lang->line('error');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this send_push_to_user function is used to send  push notification to ios and android
	 */

	public function send_push_to_user($user_id = "", $data = array()) {

		/* get user id and make condition here */
		$user_data = $this->user_model->userProfile(array('userId' => $user_id));
		$token = $device = "";

		if ($user_data['deviceType'] == 1) {
			$token = $user_data['deviceToken'];
			$device = "ios";
			generatePush($device, $token, $data);
		}
		if ($user_data['deviceType'] == 0) {
			$token = $user_data['deviceToken'];
			$device = "android";
			generatePush($device, $token, $data);
		}
	}

	private function get_single_request_data($id) {

		$booking_data = $this->user_cars_booking_model->get_request_raw_data($id);
		$data = $booking_data;
		if (count($data) > 0) {
			$data['car_details'] = $this->user_cars_model->get_single_car_data($booking_data['car_id']);
			$data['car_owner_data'] = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
			$data['car_renter_data'] = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));

			$forms_towards_renter_owner = $this->user_cars_booking_model->get_owner_form_filled_whlie_giving_car($id);
			$forms_towards_renter_renter = $this->user_cars_booking_model->get_renter_form_filled_whlie_getting_car($id);

			$forms_towards_owner_owner = $this->user_cars_booking_model->get_owner_form_filled_whlie_getting_car($id);
			$forms_towards_owner_renter = $this->user_cars_booking_model->get_renter_form_filled_whlie_giving_car($id);

			// get owner form submiision time with respect to current time

			$data['forms_towards_renter'] = array(
				"owner" => (count($forms_towards_renter_owner) > 0 ) ? $forms_towards_renter_owner['submission_time'] : '',
				"renter" => (count($forms_towards_renter_renter) > 0) ? $forms_towards_renter_renter['submission_time'] : ''
			);
			
			if(  (time() - strtotime($forms_towards_owner_renter['submission_time']))  > 300  ){
				$forms_towards_owner_renter['submission_time']  = "";
			}
			
			$data['forms_towards_owner'] = array(
				"owner" => (count($forms_towards_owner_owner) > 0 ) ? $forms_towards_owner_owner['submission_time'] : '',
				"renter" => (count($forms_towards_owner_renter) > 0 ) ? $forms_towards_owner_renter['submission_time'] : ''
			);
			/* ALL THESE ACTIONS ARE ADDED TO GET SOME STATE ACCRORDING
			 *  TO THEM BUTTONS AND ACTIONS ARE PERFORMED
			 */

			$diff = strtotime($data['car_from']) - strtotime(date("Y-m-d H:i:s"));
			$diff_towards_renter = $diff_towards_owner = 0;
			if (($diff / 60) <= 60) { /* get time difference in minutes */
				$diff_towards_renter = 1;
			}

			$diff = strtotime($data['car_to']) - strtotime(date("Y-m-d H:i:s"));
			if (($diff / 60) <= 60) { /* get time difference in minutes */
				$diff_towards_owner = 1;
			}

			$data['setting_show_reached_at_location_button'] = array(
				"towards_renter" => $diff_towards_renter,
				"towards_owner" => $diff_towards_owner
			);
			$data['setting_show_non_show_user_for_termination'] = array(
				"towards_renter" => array(
					"to_renter" => 0,
					"to_owner" => 0,
				),
				"towards_owner" => array(
					"to_renter" => 0,
					"to_owner" => 0,
				),
			);

			/*
			  set some varable using booking actions its being complicated
			  !!! Please handle with care !!!!
			 */
			$towards_renter_action = $data['towards_renter_action'];
			if (array_key_exists('non_show_renter', $towards_renter_action)) {
				$diff = strtotime(date("Y-m-d H:i:s")) - strtotime($towards_renter_action['non_show_renter']);
				if (($diff / 60) > 20) { /* get time difference in minutes */
					// show buuton to owner
					$data['setting_show_non_show_user_for_termination']['towards_renter']['to_owner'] = 1;
				}
			}
			if (array_key_exists('non_show_owner', $towards_renter_action)) {
				$diff = strtotime(date("Y-m-d H:i:s")) - strtotime($towards_renter_action['non_show_owner']);
				if (($diff / 60) > 20) { /* get time difference in minutes */
					// show buuton to owner
					$data['setting_show_non_show_user_for_termination']['towards_renter']['to_renter'] = 1;
				}
			}

			$towards_renter_action = $data['towards_owner_action'];
			if (array_key_exists('non_show_renter', $towards_renter_action)) {
				$diff = strtotime(date("Y-m-d H:i:s")) - strtotime($towards_renter_action['non_show_renter']);
				if (($diff / 60) > 20) { /* get time difference in minutes */
					// show buuton to owner
					$data['setting_show_non_show_user_for_termination']['towards_owner']['to_owner'] = 1;
				}
			}
			if (array_key_exists('non_show_owner', $towards_renter_action)) {
				$diff = strtotime(date("Y-m-d H:i:s")) - strtotime($towards_renter_action['non_show_owner']);
				if (($diff / 60) > 20) { /* get time difference in minutes */
					// show buuton to owner
					$data['setting_show_non_show_user_for_termination']['towards_owner']['to_renter'] = 1;
				}
			}

			$time_span = get_time_span_diffrence($data['car_from'], $data['car_to']);

			$price = $days = 0;
			if ($time_span['months'] > 0) {
				$price += $data['discount_monthly'] * $time_span['months'];
				$days += $days + ($time_span['months'] * 30);
			}

			if ($time_span['weeks'] > 0) {
				$price += $data['discount_weekly'] * $time_span['weeks'];
				$days += $days + ($time_span['months'] * 7);
			}

			/* code comment by lakshay juneja as it is throwing exception on line number 1631 (undefined variable car_data) */
			if ($time_span['days'] > 0) {
				$price += $data['car_daily_price'] * $time_span['days'];
				$days += $days + ($time_span['days']);
			}

			if ($time_span['hours'] > 0) {
				$price += $data['car_daily_price'];
				$days += $days + 1;
			}

			$data['trip_days'] = $days;
			$data['total_trip_price'] = $price;
			$transaction = $this->user_cars_booking_model->get_booking_transaction($id);
			$data['booking_renter_transaction'] = (is_array($transaction))?$transaction:array();
		}

		return $data;
	}

	public function fetch_single_request_data() {

			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['id'] = $this->input->post('id');

			if ($request_para['id'] != "") {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('data_fetched_successfully');
				$data = $this->get_single_request_data($request_para['id']);
			} else {
				$isSuccess = False;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*	 * ******************************************** Testing area starts from here ***************************************** */

	public function ios_push($tokken) {

		generatePush('ios', $tokken, 'push is working ');
		//$this->send_push_to_user('5' , $data =array());
	}

	public function android_push($tokken) {

		generatePush('android', $tokken, 'push is working ');
		//$this->send_push_to_user('5' , $data =array());
	}

        /* create a dummy payment to owner wallet */
	public function adeduct_money_from_mango_pay() {
		$this->load->library('mango_pay');

		$user_account_info = $this->user_model->get_user_payment_account(2);
		
		$card_exist = $this->mango_pay->view_a_card($user_account_info['card_id']);

		$data = array(
			'CreditedWalletId' => 18568528,
			'AuthorId' => $user_account_info['author_id'],
			'DebitedFunds_amount' => 86.7* 100,
			'DebitedFunds_currency' => 'EUR',
			'Fees_amount' =>86.7* 100 ,
			'Fees_Currency' => 'EUR',
			'CardType' => $card_exist->CardType,
			'CardId' => $card_exist->Id
		);

		$transaction = $this->mango_pay->direct_payin_from_card($data);
		pre($transaction);
	}	
	
	
}
