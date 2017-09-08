<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web_user extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		 *  admin panel initialization
		 *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		 */
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('Web_users_verification_model');
		$this->load->model('user_model');
		$this->load->model('deleted_car_model');
		/* from main model folder @ global use */
		$this->load->model('user_notification_model');
		$this->load->library('form_validation');
		$this->load->model('reported_car_model');
		$this->load->model('Car_detail_model');
		$this->load->model('UserModel');
		$this->load->model('user_cars_model');
	}

	/*
	 * get single user complete profile
	 */

	public function user_profile($id = null) {
		$data['page_title'] = "User profile";
		$view_data['user_id'] = $id;
		$data['page_data'] = $this->load->view('web_user/user_profile', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function edit_profile($id = null) {
		//$data['page_title'] = "User profile";
		$view_data['user_id'] = $id;
		$data['page_data'] = "This page is currently not available"; //$this->load->view('web_user/edit_profile',$view_data,TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function user_document_data($id = null) {
		$view_data['user_id'] = $id;
		$data['page_data'] = $this->load->view('web_user/user_document_data', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function user_listed_cars($id = null) {
		//$data['page_title'] = "User profile";
		$view_data['user_id'] = $id;
		$data['page_data'] = $this->load->view('web_user/user_listed_cars', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function user_car_detail($id = null) {

		$data['page_toast'] = urldecode($this->input->get('page_toast'));
		$data['page_toast_type'] = urldecode($this->input->get('page_toast_type'));
		$data['page_toast_title'] = urldecode($this->input->get('page_toast_title'));

		$view_data['car_id'] = $id;
		$view_data['car_reason'] = $this->deleted_car_model->deleted_car_reason($id);
		
		$view_data["car_contract_info"] = $this->user_cars_model->get_basic_contract_info($id);
		$data['page_data'] = $this->load->view('web_user/user_car_detail', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function car_market_value($id = null) {
		if ($this->input->post()) {
			$id = $this->input->post('id');
			$value = $this->input->post('market_value');
			$result = $this->Car_detail_model->update_car_market_value($id, $value);
			if ($result) {
				$data['page_toast'] = 'Updated successfully.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			} else {
				$data['page_toast'] = 'Not updated.';
				$data['page_toast_type'] = 'error';
				$data['page_toast_title'] = 'Action performed.';
			}
		}
		$view_data['car_id'] = $id;
		$view_data['market_value'] = $this->Car_detail_model->get_car_market_value($id);
		$data['page_data'] = $this->load->view('web_user/car_market_value', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function user_car_report($id = null) {
		$view_data['car_reason'] = $this->reported_car_model->reported_car($id);
		$view_data['car_id'] = $view_data['car_reason']['id'];
		unset($view_data['car_reason']['id']);
		$data['page_data'] = $this->load->view('web_user/user_car_report', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function user_block($id = null) {
		if ($this->input->post()) {
			$status = $this->input->post('userStatus');
			if ($status == 1) {
				$status = 0;
				$data['page_toast'] = 'User unblocked.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			} else {
				$status = 1;
				$data['page_toast'] = 'User blocked.';
				$data['page_toast_type'] = 'error';
				$data['page_toast_title'] = 'Action performed.';
			}
			$this->user_model->user_block($id, $status);
		}

		$view_data['user_id'] = $id;
		$data['page_data'] = $this->load->view('web_user/user_block', $view_data, TRUE);
		$data['page_title'] = "User block";
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	/*
	 * GET VERIFIED WEB USER LIST
	 */

	public function verified_user_list() {
		$data['page_data'] = $this->load->view('web_user/verified_user', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_verified_user_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'username',
			1 => 'email',
			2 => 'creation_time'
		);

		//$query = "SELECT uu.userId as user_id , CONCAT( uu.firstName ,' ', uu.lastName ) AS username, uu.email
		$query = "SELECT count(uu.userId) as total
							FROM  urend_users AS uu
							JOIN urend_user_license_data ON urend_user_license_data.user_id = uu.userId
							WHERE urend_user_license_data.state =1
							";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT uu.userId as user_id , CONCAT( uu.firstName ,' ', uu.lastName ) AS username, uu.email as email , uu.createdAt as creation_time
							FROM  urend_users AS uu
							JOIN urend_user_license_data ON urend_user_license_data.user_id = uu.userId
							WHERE urend_user_license_data.state =1";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND CONCAT( uu.firstName ,' ', uu.lastName ) LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND email LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND creation_time LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->username;
			$nestedData[] = $r->email;
			$nestedData[] = $r->creation_time;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_profile/" . $r->user_id . "'>View</a>";
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal" => intval($totalData), // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	/*
	 * GET NON - VERIFIED WEB USER LIST
	 */

	public function non_verified_user_list() {
		$data['page_data'] = $this->load->view('web_user/non_verified_user', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_non_verified_user_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'username',
			1 => 'email',
			2 => 'creation_time'
		);

		$query = "SELECT count(uu.userId) as total
								FROM  urend_users AS uu
								LEFT JOIN urend_user_license_data ON urend_user_license_data.user_id = uu.userId
								WHERE urend_user_license_data.state = 0
								";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT uu.userId as user_id , CONCAT( uu.firstName ,' ', uu.lastName ) AS username, uu.email as email , uu.createdAt as creation_time
								FROM  urend_users AS uu
								LEFT JOIN urend_user_license_data ON urend_user_license_data.user_id = uu.userId
								WHERE urend_user_license_data.state = 0";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND CONCAT( uu.firstName ,' ', uu.lastName ) LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND email LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND creation_time LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->username;
			$nestedData[] = $r->email;
			$nestedData[] = $r->creation_time;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_document_data/" . $r->user_id . "'>View</a>";
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal" => intval($totalData), // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	/*
	 * GET ALL WEB USER LIST
	 */

	public function all_user_list() {
		$data['page_data'] = $this->load->view('web_user/all_user', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_all_user_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'username',
			1 => 'email',
			2 => 'creation_time'
		);

		$query = "SELECT count(userId) as total
									FROM  urend_users
									";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT uu.userId as user_id , CONCAT( uu.firstName ,' ', uu.lastName ) AS username, uu.email as email , uu.createdAt as creation_time
									FROM  urend_users AS uu where 1=1"
		;

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND CONCAT( uu.firstName ,' ', uu.lastName ) LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND email LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND creation_time LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->username;
			$nestedData[] = $r->email;
			$nestedData[] = $r->creation_time;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_document_data/" . $r->user_id . "'>View</a>";
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal" => intval($totalData), // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	/* document verification process */

	public function approvedboth($user_id = null) {
		$table = 'user_license_data';
		$where = array('user_id' => $user_id);

		$userInfo = $this->Web_users_verification_model->getDataById($table, $where);

		if ($userInfo->state == '2') {
			$updateState = array('state' => '1');
			$flag_message = 'User Data verification has been approved successfully.';
			/* send notification */
			$notification_data = array(
				"user_id" => $user_id,
				"text" => "Document verified by Administrator.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->user_notification_model->add_notification_to_user($notification_data);
			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 80001,
					'message' => 'Document verified by Administrator.',
					'data' => array()
				)
			);
			$this->send_push_to_user($user_id, $push_data);
			$this->document_action($user_id , True);
		}
		if ($userInfo->state == '1') {
			$updateState = array('state' => '2');
			$flag_message = 'User Data verification has been disapproved successfully.';
			/* send notification */
			$notification_data = array(
				"user_id" => $user_id,
				"text" => "Document approval cancel by Administrator.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->user_notification_model->add_notification_to_user($notification_data);
			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 80002,
					'message' => 'Document approval cancel by Administrator.',
					'data' => array()
				)
			);
			$this->send_push_to_user($user_id, $push_data);
			$this->document_action($user_id , False);
		}

		$this->Web_users_verification_model->updateRecordById($table, $updateState, $where);

		$this->session->set_flashdata("success_message", $flag_message);
		redirect(AUTH_PANEL_URL . 'web_user/user_document_data/' . $user_id);
	}

	function unapproved($user_id = null) {
		$table = 'user_license_data';
		$where = array('user_id' => $user_id);
		$userInfo = $this->Web_users_verification_model->getDataById($table, $where);
		if ($userInfo->state == '0') {
			$updateState = array('state' => '2');
			$flag_message = 'User Data verification has been disapproved successfully.';
			/* send notification */
			$notification_data = array(
				"user_id" => $user_id,
				"text" => "Document approval cancel by Administrator.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->user_notification_model->add_notification_to_user($notification_data);
			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 80002,
					'message' => 'Document approval cancel by Administrator.',
					'data' => array()
				)
			);
			$this->send_push_to_user($user_id, $push_data);
			$this->document_action($user_id , False);
		}
		$this->Web_users_verification_model->updateRecordById($table, $updateState, $where);
		$this->session->set_flashdata("success_message", $flag_message);
		redirect(AUTH_PANEL_URL . 'web_user/user_document_data/' . $user_id);
	}

	function approved($user_id = null) {
		$table = 'user_license_data';
		$where = array('user_id' => $user_id);

		$userInfo = $this->Web_users_verification_model->getDataById($table, $where);
		if ($userInfo->state == '0') {
			$updateState = array('state' => '1');
			$flag_message = 'User Data verification has been approved successfully.';
			/* send notification */
			$notification_data = array(
				"user_id" => $user_id,
				"text" => "Document verified by Administrator.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->user_notification_model->add_notification_to_user($notification_data);
			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 80001,
					'message' => 'Document verified by Administrator.',
					'data' => array()
				)
			);
			$this->send_push_to_user($user_id, $push_data);
			$this->document_action($user_id , True);
		}
		$this->Web_users_verification_model->updateRecordById($table, $updateState, $where);

		$this->session->set_flashdata("success_message", $flag_message);
		redirect(AUTH_PANEL_URL . 'web_user/user_document_data/' . $user_id);
	}

	/* send email for approve document */
	
	public function document_action($user_id , $state){
		
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);
		/* get user data with id */
		$data['user_data'] =  $user_data = $this->UserModel->get_user_with_userId($user_id);
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		if($state){
			$this->email->subject('Document Approved');
			$view_file = "email_template/document_approved";
		}else{
			$this->email->subject('Document Disapproved');
			$view_file = "email_template/document_disapproved";
		}
		
		//send email to owner 
		$this->email->to($user_data['email']);
		$this->email->message($this->load->view($view_file , $data, True));
		$this->email->send();
	}
 	
	
	
	public function user_bookings($id) {
		$view_data['user_id'] = $id;
		$data['page_data'] = $this->load->view('web_user/user_bookings', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_get_user_all_booking() {
		$id = $this->session->userdata('user_id');
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'transaction_type',
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master where car_user_id = $id or car_renter_id=$id";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							'All' as transaction	
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					where ucbm.car_user_id = $id or ucbm.car_renter_id=$id
					";
		if ($requestData['columns'][3]['search']['value'] == 0 && $requestData['columns'][3]['search']['value'] != '') {
			$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							'New' as transaction
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					where ucbm.state = 0
					And   ucbm.car_from > '" . date('Y-m-d H:i:s') . "'
					And ( ucbm.car_user_id = $id or ucbm.car_renter_id=$id ) ";
		} else if ($requestData['columns'][3]['search']['value'] == 1) {
			$sql = "SELECT ucbm.id as id ,
								CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
						    CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
								ucd.carPlateNumber as car_plate_number,
								'Current' as transaction
						FROM urend_car_booking_master as ucbm
						join urend_users as uuo on ucbm.car_user_id = uuo.userId
						join urend_users as uur on ucbm.car_renter_id = uur.userId
						join urend_car_details as ucd on ucbm.car_id = ucd.id
						where ucbm.pickup_confirmed = 1 and ucbm.transaction_complete != 1
						And (ucbm.car_user_id = $id or ucbm.car_renter_id=$id )";
		} else if ($requestData['columns'][3]['search']['value'] == 2) {
			$sql = "SELECT ucbm.id as id ,
									CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
									CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
									ucd.carPlateNumber as car_plate_number,
									'Complete' as transaction
							FROM urend_car_booking_master as ucbm
							join urend_users as uuo on ucbm.car_user_id = uuo.userId
							join urend_users as uur on ucbm.car_renter_id = uur.userId
							join urend_car_details as ucd on ucbm.car_id = ucd.id
							where ucbm.transaction_complete = 1
							And (ucbm.car_user_id = $id or ucbm.car_renter_id=$id )";
		}

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {
			$sql.=" AND ucd.carPlateNumber LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {
			$sql.=" AND CONCAT( uuo.firstName ,' ', uuo.lastName ) LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {
			$sql.=" AND CONCAT( uur.firstName ,' ', uur.lastName ) LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		/* if (!empty($requestData['columns'][3]['search']['value'])) {
		  $sql.=" AND transaction_type LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		  } */
		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->car_plate_number;
			$nestedData[] = $r->car_owner;
			$nestedData[] = $r->car_renter;
			//$nestedData[] = $r->car_from;
			//$nestedData[] = $r->car_to;
			//$nestedData[] = $r->creation_time;
			$nestedData[] = $r->transaction;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "booking/booking/" . $r->id . "'>View</a>";
			$data[] = $nestedData;
		}

		$json_data = array(
			"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal" => intval($totalData), // total number of records
			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	public function add_web_user() {
		$this->load->model('UserModel');

		if ($this->input->post()) {
			$_POST['isVerified'] = 1;
			$_POST['password'] = md5($_POST['password']);
			$id = $this->UserModel->signUp($this->input->post());
			redirect(AUTH_PANEL_URL . 'web_user/user_profile/' . $id);
			die;
		}


		$view_data['country_code'] = $this->UserModel->get_country_code();

		$data['page_data'] = $this->load->view('web_user/add_web_user', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function web_user_logger($user_id = null) {
		$this->load->model('UserModel');
		$user_data = $this->UserModel->get_user_with_userId($user_id);
		if ($user_data) {
			$this->session->set_userdata($user_data);
			redirect('account_information/index');
		}
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

	/*	 * *******************End User************************* */
}
