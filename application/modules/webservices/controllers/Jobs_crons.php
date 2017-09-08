<?php

/*
 * this file is used for cron jobs 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs_crons extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('car_booking_auto_reminder_model');
		$this->load->model('user_model');
	}

	/* master function to be called by a cron job */
	public function booking_cron_job() {
		log_message('debug', 'Booking cron job start ', false);
		
		$this->get_active_booking_before_an_hour();
		$this->get_dropoff_booking_before_an_hour();

		$this->rejectable_bookings();
		$this->send_booking_reminder();

		/* if pickup not confirmed reject the request */
		$this->reject_if_pickup_not_confirmed();
		log_message('debug', 'Booking cron job end ', false);
	}

	/*
	 * this function is used to send car owner / renter to 
	 * send email  and push notification 1 hour before the booking  
	 */

	public function get_active_booking_before_an_hour() {

		$possible_bookings = $this->car_booking_auto_reminder_model->active_booking_before_hour();
		//echo $this->db->last_query();
		$data = array();
		foreach ($possible_bookings as $p_b) {

			$data[] = array(
				"booking_id" => $p_b['id'],
				"send_remind_at" => date('Y-m-d H:i:s', strtotime($p_b['car_from'] . ' - 60 minute')),
				"state" => 0,
				"remind_for" => "pickup"
			);
		}
		if ($data) {
			$this->car_booking_auto_reminder_model->set_booking_reminder($data);
		}
	}

	public function get_dropoff_booking_before_an_hour() {

		$possible_bookings = $this->car_booking_auto_reminder_model->dropoff_booking_before_hour();
		$data = array();
		foreach ($possible_bookings as $p_b) {

			$data[] = array(
				"booking_id" => $p_b['id'],
				"send_remind_at" => date('Y-m-d H:i:s', strtotime($p_b['car_to'] . ' - 60 minute')),
				"state" => 0,
				"remind_for" => "dropoff"
			);
		}
		if ($data) {
			$this->car_booking_auto_reminder_model->set_booking_reminder($data);
		}
	}

	public function send_booking_reminder() {
		$possible_bookings = $this->car_booking_auto_reminder_model->get_booking_reminder();
		if ($possible_bookings) {
			foreach ($possible_bookings as $p_b) {
				if ($p_b['remind_for'] == "pickup") {
					$this->send_user_booking_start($p_b['booking_id']);
					$this->car_booking_auto_reminder_model->set_reminder_sent($p_b['id']);
				} else {
					$this->send_user_booking_drop_start($p_b['booking_id']);
					$this->car_booking_auto_reminder_model->set_reminder_sent($p_b['id']);
				}
			}
		}
	}

	public function send_user_booking_start($booking_id) {

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);


		/* fetch complete booking data */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_id)
		);

		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		$this->email->subject('Car Pick Process is Going To Start ');
		//send email to owner 
		$this->email->to($booking_data['car_owner_data']['email']);
		$this->email->message($this->load->view('email_templates/booking_start_reminder_to_owner', $booking_data, True));
		$this->email->send();

		// push to owner 
		/* change language for push notification */
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 440001,
				'message' => $this->lang->line('pickup_going_to_start'),
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_user_id'], $push_data);
		
		
		//send email to renter 
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		$this->email->subject('Car Pick Process is Going To Start ');
		$this->email->to($booking_data['car_renter_data']['email']);
		$this->email->message($this->load->view('email_templates/booking_start_reminder_to_renter', $booking_data, True));
		$this->email->send();
		
		//push to renter 
		/* change language for push notification */
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 440002,
				'message' => $this->lang->line('pickup_going_to_start') ,
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
		
		
	}

	public function send_user_booking_drop_start($booking_id) {

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);


		/* fetch complete booking data */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_id)
		);

		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		$this->email->subject('Car Dropoff Process is Going To Start ');
		//send email to owner 
		$this->email->to($booking_data['car_owner_data']['email']);
		$this->email->message($this->load->view('email_templates/booking_drop_start_reminder_to_owner', $booking_data, True));
		$this->email->send();
		
		// push to owner 
		/* change language for push notification */
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 440003,
				'message' => $this->lang->line('dropoff_going_to_start') ,
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_user_id'], $push_data);
		
		//send email to renter 
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		$this->email->subject('Car Dropoff Process is Going To Start ');
		$this->email->to($booking_data['car_renter_data']['email']);
		$this->email->message($this->load->view('email_templates/booking_drop_start_reminder_to_renter', $booking_data, True));
		$this->email->send();
		//push to renter 
		/* change language for push notification */
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 440004,
				'message' => $this->lang->line('dropoff_going_to_start') ,
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
	}

	public function rejectable_bookings() {
		/*
		 * check request 2 hours before car booking time 
		 * if owner not accept reject the request 
		 * if owner accept and renter didnt pay reject the request 
		 */
		$possible_bookings = $this->car_booking_auto_reminder_model->rejectable_request();
		if ($possible_bookings) {
			//cancel the booking 
			foreach ($possible_bookings as $p_b) {

				if ($this->car_booking_auto_reminder_model->set_reject_status($p_b['id'])) {
					/* send email we have booking id */
					$this->send_booking_expire_mail($p_b['id']);
				}
			}
		}
	}

	public function send_booking_expire_mail($booking_id) {

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);
		/* fetch complete booking data */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_id)
		);

		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];
		// to renter
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($booking_data['car_renter_data']['email']);
		$this->email->subject('Rental Request Expire');
		$this->email->message($this->load->view('email_templates/booking_expired_notification_to_renter', $booking_data, True));
		$this->email->set_mailtype("html");
		$this->email->send();
		
		// push to owner 
		/* change language for push notification */
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 660001,
				'message' => $this->lang->line('rental_request_expire_msg_for_push') ,
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_renter_id'], $push_data);
		
		
		
		// to owner 
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($booking_data['car_owner_data']['email']);
		$this->email->subject('Rental Request Expire');
		$this->email->message($this->load->view('email_templates/booking_expired_notification_to_owner', $booking_data, True));
		$this->email->set_mailtype("html");
		$this->email->send();
		
		// push to owner 
		$pusher_data = $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
		$this->lang->load('master', $pusher_data['language']);
		
		$push_data = json_encode(
			array(
				'notification_code' => 660002,
				'message' => $this->lang->line('rental_request_expire_msg_for_push') ,
				'data' => array('request_id' => $booking_data['id'])
			)
		);
		$this->send_push_to_user($booking_data['car_user_id'], $push_data);
	}

	/* This function is used to reject the request if pickup is not confirmed 
	 * 2 hours lator from car from time */

	public function reject_if_pickup_not_confirmed() {

		$possible_bookings = $this->car_booking_auto_reminder_model->request_if_pickup_not_confirmed();
		if ($possible_bookings) {
			//cancel the booking 
			foreach ($possible_bookings as $p_b) {
				$this->car_booking_auto_reminder_model->set_reject_status($p_b['id']);
				$this->send_booking_expire_mail($p_b['id']);
			}
		}
	}

	
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
	
	public function test_email(){
		
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		$this->email->subject('Testing of emails ');
		$this->email->to("vipulkumar0014@gmail.com");
		$this->email->message("testing of emails");
		
		if($this->email->send()){
			echo "email sent";
		}else{
			echo "not able to send message";
		}
		
	}
	
}
