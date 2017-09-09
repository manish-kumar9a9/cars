<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		 *  admin panel initialization
		 *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		 */
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('web_cars_model');
		$this->load->model('user_cars_model');
		$this->load->model('user_model');
		$this->load->model('UserModel');

		/* from main model folder @ global use */
		$this->load->model('user_notification_model');
		$this->load->library('form_validation');
	}

	/*
	 * get single car complete profile
	 */

	public function car_profile($id = null) {
		$data['page_title'] = "User profile";
		$data['page_data'] = $this->load->view('car_data/car', '', TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	/*
	 * GET LIST OF NON APPROVED CARS
	 */

	public function non_approved_car_list() {
		$data['page_data'] = $this->load->view('car_data/non_approved_car_list', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_non_approved_cars() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'carPlateNumber',
			1 => 'createdDate'
		);
		// getting total number records without any search
		$this->db->where('is_verified', '0');
		//$this->db->where('isActive','1');
		$this->db->from('urend_car_details');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT *  ";
		$sql.=" FROM urend_car_details WHERE is_verified =0";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND carPlateNumber LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND createdDate LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->carPlateNumber;
			$nestedData[] = $r->createdDate;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_car_detail/" . $r->id . "'>View</a>";
			/* $nestedData[] = ($r->verification_document == 1) ? "Approved" : "<a onclick='return confirm(\"Are you sure want to approve ? \");' href='" . base_url() . "index.php/admin/web_user/verify_user_document/" . $r->userId . "' >Approve it </a>"; */
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

	public function verify_car($id) {
		$page_toast = $page_toast_type = $page_toast_title = "";
		$this->web_cars_model->set_car_varified($id);
		$car_data = $this->web_cars_model->get_car_data($id);
		if ($car_data['is_verified'] == 1) {
			/* insert car action log */
			$this->web_cars_model->backend_car_action_log($id);
			/* send notification */
			$notification_data = array(
				"user_id" => $car_data['fk_user_id'],
				"text" => "Your car with No. Plate " . $car_data['carPlateNumber'] . " is listed successfully.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->verification_action($id, True);

			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 220001,
					'message' => "Your car with No. Plate " . $car_data['carPlateNumber'] . " is listed successfully.",
					'data' => array("car_id" => $id)
				)
			);
			$this->send_push_to_user($car_data['fk_user_id'], $push_data);


			$page_toast = 'Car approved successfully.';
			$page_toast_type = 'success';
			$page_toast_title = 'Action performed.';
		} else {
			/* send notification */
			$notification_data = array(
				"user_id" => $car_data['fk_user_id'],
				"text" => "Your car with No. Plate  " . $car_data['carPlateNumber'] . " is removed from listed cars.",
				"notification_time" => date("Y-m-d H:i:s")
			);
			$this->verification_action($id, False);
			/* send push notification */
			$push_data = json_encode(
				array(
					'notification_code' => 220002,
					'message' => "Your car with No. Plate  " . $car_data['carPlateNumber'] . " is removed from listed cars.",
					'data' => array("car_id" => $id)
				)
			);
			$this->send_push_to_user($car_data['fk_user_id'], $push_data);
		}
		$this->user_notification_model->add_notification_to_user($notification_data);

		redirect(AUTH_PANEL_URL . 'web_user/user_car_detail/' . $id . '?page_toast=' . $page_toast . '&page_toast_type=' . $page_toast_type . '&page_toast_title' . $page_toast_title);
	}

	// send email for car verification action
	public function verification_action($car_id, $state) {
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);

		/* fetch complete car data */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_single_car_data',
			'data' => array('id' => $car_id)
		);

		$result = get_data_with_curl($option);
		$data['car_data'] = $car_data = $result['Result'];

		/* get user data with id */
		$data['user_data'] = $user_data = $this->UserModel->get_user_with_userId($car_data['fk_user_id']);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->set_mailtype("html");
		if ($state) {
			$this->email->subject('Car Listed');
			$view_file = "email_template/car_listed";
		} else {
			$this->email->subject('Car Removed from list');
			$view_file = "email_template/car_unlisted";
		}

		//send email to owner 
		$this->email->to($user_data['email']);
		$this->email->message($this->load->view($view_file, $data, True));
		$this->email->send();
	}

	/*
	 * GET LIST OF APPROVED CARS
	 */

	public function approved_car_list() {
		$data['page_data'] = $this->load->view('car_data/approved_car_list', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}
	/*
         * GET LIST OF APPROVED CARS
         */

	public function featured_car_list() {

		////
		$sql = "SELECT ucd.id as id , ucd.carPlateNumber as carPlateNumber , ucd.featured, ucd.createdDate as 
		createdDate, "
			. "concat(uu.firstName,' ',uu.lastName) as user_name , "
			. "ucm.name as maker ,"
			. " ucmd.name as model , "
			. "uccb.insured_value as insured_value"
			. " FROM urend_car_details as ucd left join urend_users as uu on uu.userId = ucd.fk_user_id left join urend_car_makes as ucm on ucm.id = ucd.make left join urend_car_models as ucmd on ucmd.id = ucd.model left join urend_car_contract_base_info as uccb on uccb.car_id = ucd.id WHERE is_verified =1   ";

		/*if (!empty($requestData['columns'][0]['search']['value'])) {
			$sql.=" AND concat(uu.firstName,' ',uu.lastName)  LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {
			$sql.=" AND carPlateNumber LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {
			$sql.=" AND ucm.name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND ucmd.name LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND uccb.insured_value  LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][5]['search']['value'])) {
			$sql.=" AND createdDate LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
		}*/

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		//$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir']
			//. "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		/////
		//print_r($result); die();
		$temp['ter'] = $result;
		$data['page_title'] = "Featured Cars";
		$data['page_data'] = $this->load->view('car_data/featured_car_list', $temp, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);

	}

	public function ajax_featured_cars() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'user_name',
			1 => 'carPlateNumber',
			2 => 'maker',
			3 => 'model',
			4 => 'insured_value',
			5=> 'createdDate'
		);
		// getting total number records without any search
		$this->db->where('is_verified', '1');
		$this->db->from('urend_car_details');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT ucd.id as id , ucd.carPlateNumber as carPlateNumber , ucd.createdDate as createdDate, "
			. "concat(uu.firstName,' ',uu.lastName) as user_name , "
			. "ucm.name as maker ,"
			. " ucmd.name as model , "
			. "uccb.insured_value as insured_value"
			. " FROM urend_car_details as ucd left join urend_users as uu on uu.userId = ucd.fk_user_id left join urend_car_makes as ucm on ucm.id = ucd.make left join urend_car_models as ucmd on ucmd.id = ucd.model left join urend_car_contract_base_info as uccb on uccb.car_id = ucd.id WHERE is_verified =1   ";

		if (!empty($requestData['columns'][0]['search']['value'])) {
			$sql.=" AND concat(uu.firstName,' ',uu.lastName)  LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {
			$sql.=" AND carPlateNumber LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {
			$sql.=" AND ucm.name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND ucmd.name LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND uccb.insured_value  LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][5]['search']['value'])) {
			$sql.=" AND createdDate LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		return $result;
		//$data = array();

//		foreach ($result as $r) {  // preparing an array
//			$nestedData = array();
//			$nestedData[] = $r->user_name ;
//			$nestedData[] = $r->carPlateNumber;
//			$nestedData[] =$r->maker;
//			$nestedData[] = $r->model;
//			$nestedData[] = $r->insured_value;
//			$nestedData[] = $r->createdDate;
//
//			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_car_detail/" . $r->id . "'>View</a>";
//			/* $nestedData[] = ($r->verification_document == 1) ? "Approved" : "<a onclick='return confirm(\"Are you sure want to approve ? \");' href='" . base_url() . "index.php/admin/web_user/verify_user_document/" . $r->userId . "' >Approve it </a>"; */
//			$data[] = $nestedData;
//		}
//
//		$json_data = array(
//			"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
//			"recordsTotal" => intval($totalData), // total number of records
//			"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
//			"data" => $data   // total data array
//		);
//
//		echo json_encode($json_data);  // send data as json format
	}

	public function ajax_approved_cars() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'user_name',
			1 => 'carPlateNumber',
			2 => 'maker',
			3 => 'model',
			4 => 'insured_value',
			5=> 'createdDate'
		);
		// getting total number records without any search
		$this->db->where('is_verified', '1');
		$this->db->from('urend_car_details');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT ucd.id as id , ucd.carPlateNumber as carPlateNumber , ucd.createdDate as createdDate, "
			. "concat(uu.firstName,' ',uu.lastName) as user_name , "
			. "ucm.name as maker ,"
			. " ucmd.name as model , "
			. "uccb.insured_value as insured_value"
			. " FROM urend_car_details as ucd left join urend_users as uu on uu.userId = ucd.fk_user_id left join urend_car_makes as ucm on ucm.id = ucd.make left join urend_car_models as ucmd on ucmd.id = ucd.model left join urend_car_contract_base_info as uccb on uccb.car_id = ucd.id WHERE is_verified =1   ";

		if (!empty($requestData['columns'][0]['search']['value'])) {  
			$sql.=" AND concat(uu.firstName,' ',uu.lastName)  LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  
			$sql.=" AND carPlateNumber LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  
			$sql.=" AND ucm.name LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][3]['search']['value'])) { 
			$sql.=" AND ucmd.name LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {  
			$sql.=" AND uccb.insured_value  LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][5]['search']['value'])) {  
			$sql.=" AND createdDate LIKE '" . $requestData['columns'][5]['search']['value'] . "%' ";
		}	
		
		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();

		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();
			$nestedData[] = $r->user_name ;
			$nestedData[] = $r->carPlateNumber;
			$nestedData[] =$r->maker;
			$nestedData[] = $r->model;
			$nestedData[] = $r->insured_value;
			$nestedData[] = $r->createdDate;

			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_car_detail/" . $r->id . "'>View</a>";
			/* $nestedData[] = ($r->verification_document == 1) ? "Approved" : "<a onclick='return confirm(\"Are you sure want to approve ? \");' href='" . base_url() . "index.php/admin/web_user/verify_user_document/" . $r->userId . "' >Approve it </a>"; */
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

	public function deleted_car_list() {
		$data['page_data'] = $this->load->view('car_data/deleted_car_list', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_deleted_cars() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'carPlateNumber',
			1 => 'delete_time'
		);
		// getting total number records without any search
		//$this->db->where('isActive','1');
		$this->db->from('urend_car_deleted_reason');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT
										`ucd`.`id`,
							      `ucd`.`carPlateNumber`,
							      FROM_UNIXTIME(ucdr.`creation_time`,'%Y-%m-%d %H:%i:%s') as delete_time
							FROM
										`urend_car_details` as ucd
										JOIN `urend_car_deleted_reason` as ucdr ON `ucdr`.`car_id` = `ucd`.`id`	";

		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND ucd.carPlateNumber LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" having delete_time LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		$query = $this->db->query($sql)->result();
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->carPlateNumber;
			$nestedData[] = $r->delete_time;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_car_detail/" . $r->id . "'>View</a>";
			/* $nestedData[] = ($r->verification_document == 1) ? "Approved" : "<a onclick='return confirm(\"Are you sure want to approve ? \");' href='" . base_url() . "index.php/admin/web_user/verify_user_document/" . $r->userId . "' >Approve it </a>"; */
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

	public function reported_car_list() {
		$data['page_data'] = $this->load->view('car_data/reported_car_list', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_reported_cars() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'carPlateNumber',
			1 => 'report_time'
		);
		// getting total number records without any search
		//$this->db->where('isActive','1');
		$this->db->from('urend_car_reports');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT
										`ucd`.`id`, ucdr.id as report_id,
							      `ucd`.`carPlateNumber`,
							      FROM_UNIXTIME(ucdr.`creation_time`,'%Y-%m-%d %H:%i:%s') as report_time
							FROM
										`urend_car_details` as ucd
										JOIN `urend_car_reports` as ucdr ON `ucdr`.`car_id` = `ucd`.`id`	";

		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND ucd.carPlateNumber LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" having report_time LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		$query = $this->db->query($sql)->result();
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->carPlateNumber;
			$nestedData[] = $r->report_time;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "web_user/user_car_report/" . $r->report_id . "'>View</a>";
			/* $nestedData[] = ($r->verification_document == 1) ? "Approved" : "<a onclick='return confirm(\"Are you sure want to approve ? \");' href='" . base_url() . "index.php/admin/web_user/verify_user_document/" . $r->userId . "' >Approve it </a>"; */
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

	/*
	  fill car basic contract information
	 */

	public function fill_car_basic_info($car_id = NULL) {

		$view['base_data'] = $this->db->get('urend_contract_basic_data')->row();
		$view['car_saved_info'] = $this->user_cars_model->get_basic_contract_info($this->input->get('car_id'));

		if ($this->input->post()) {
			$record['car_id'] = $this->input->post('car_id');
			$record['firstname'] = $this->input->post('firstname');
			$record['lastname'] = $this->input->post('lastname');
			$record['fathername'] = $this->input->post('fathername');
			$record['birthdate'] = $this->input->post('birthdate');
			$record['sex'] = $this->input->post('sex');
			$record['afm'] = $this->input->post('afm');
			$record['street'] = $this->input->post('street');
			$record['street_no'] = $this->input->post('street_no');
			$record['zip_code'] = $this->input->post('zip_code');
			$record['telephone_number'] = $this->input->post('telephone_number');
			$record['fax'] = $this->input->post('fax');
			$record['email'] = $this->input->post('email');
			$record['licence_plate'] = $this->input->post('licence_plate');
			$record['street_no'] = $this->input->post('street_no');
			$record['vehicle_maker'] = $this->input->post('vehicle_maker');
			$record['vehicle_model'] = $this->input->post('vehicle_model');
			$record['vehicle_color'] = $this->input->post('vehicle_color');
			$record['first_licence_date'] = $this->input->post('first_licence_date');
			$record['insured_value'] = $this->input->post('insured_value');
			$record['frame_number'] = $this->input->post('frame_number');
			if (count($view['car_saved_info']) > 0) {
				$this->user_cars_model->update_basic_contract_info($record);
				$view['car_saved_info'] = $this->user_cars_model->get_basic_contract_info($this->input->post('car_id'));
			} else {
				$this->user_cars_model->insert_basic_contract_info($record);
			}
		}

		$view['car_saved_info'] = $this->user_cars_model->get_basic_contract_info($this->input->get('car_id'));
		$data['page_data'] = $this->load->view('car_data/car_contact_filler', $view, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function get_car_model() {

		$homepage = file_get_contents('http://194.127.7.101/UnderwritingRulesWS/v1/vehiclemodels?usage=000&brand=' . $_GET['maker'] . '&year=' . $_GET['year'] . '&username=urend&hash=8e5f8e0c22db8cf7eeb9b40fb503dcd7');
		$h = json_decode($homepage);
		$list = $h[1]->data;
		$option = "";
		foreach ($list as $l) {
			$option .="<option value='{$l->code}'>{$l->name}</option>";
		}
		echo $option;
	}

	public function check_car_insured() {
		$data = file_get_contents('http://194.127.7.101/UnderwritingRulesWS/urend/checkcapital?username=urend&hash=8e5f8e0c22db8cf7eeb9b40fb503dcd7&carcode=' . $_GET['carcode'] . '&year=' . $_GET['year'] . '&capital=' . $_GET['capital']);
		$data = json_decode($data);
		echo (json_encode($data[0]));

		die;
	}

	public function make_feature(){
		$id = $_POST['key'];
		log_message('info','USER_INFO '.$id);

		$result = $this->db->select('featured')->get_where('urend_car_details', array('id'=> $id))->row();

		if($result && $result != ''){
			$cur = $result->featured;
			$newstaus = 0;
			if($cur == 1){
				$newstaus = 0;
			}else{
				$newstaus = 1;
			}
			//update
			$this->db->where('id', $id);
			$res = $this->db->update('urend_car_details', array('featured'=> $newstaus));
			echo $this->db->last_query();

			log_message('info','ID: '.$id.' CURRENT: '.$cur." New :".$newstaus);
			log_message('info','USER_INFO >>>>>>22 '.$this->db->last_query());
		}else{
			log_message('error','USER_INFO >>>>>>22 '.print_r($result, true));
		}

		//log_message('info','USER_INFO >>>>>> '.$this->db->last_query());
		//log_message('info','USER_INFO >>>>>>22 '.print_r($result, true));
		$param = array('featured', 1);
		print_r($result);
	}

	public function make_bulk_feature(){
		$ids = $_POST['key'];
		log_message('info',print_r($ids, true));
		log_message('info', 'length'.count($ids));

		if(count($ids) > 0){
			//update
			$this->db->where_in('id', $ids);
			$res = $this->db->update('urend_car_details', array('featured'=> 1));
			//echo $this->db->last_query();

			log_message('info','Query: '.$this->db->last_query());
		}else{
			//log_message('error','USER_INFO >>>>>>22 '.print_r($result, true));
		}
	}
}
