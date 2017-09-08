<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		 *  admin panel initialization
		 *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		 */
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('user_cars_booking_model');
	}

	public function booking_pickup_data($id) {

		$view_data['pickup_data'] = $this->user_cars_booking_model->info_pickup_booking($id);
		$view_data['dropoff_data'] = $this->user_cars_booking_model->info_dropoff_booking($id);
		//pre($view_data);
		$data['page_data'] = $this->load->view('booking_data/booking_user_information', $view_data, TRUE);

		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	/*
	 * get single car complete profile
	 */

	public function booking($id = null) {
		
		if ($this->input->post('renter_payout')) {

			$this->load->library('mango_pay');
			$data['AuthorId'] = $this->input->post('AuthorId');
			$data['DebitedWalletId'] = $this->input->post('DebitedWalletId');
			$data['DebitedFunds']['Amount'] = $this->input->post('DebitedFunds') * 100;
			$data['Fees']['Amount'] = $this->input->post('Fees') * 100;
			$data['MeanOfPaymentDetails']['BankAccountId'] = $this->input->post('BankAccountId');
			$return = $this->mango_pay->payout_to_bank($data);
			if (count($return) > 0) {
				$return = $this->mango_pay->get_payout_view($return->Id);
				$insert = array(
					"booking_id" => $this->input->post('booking_id'),
					"user_id" => $this->input->post('user_id'),
					"user_type" => $this->input->post('user_type'),
					"transaction_id" => $return->Id,
					"status" => $return->Status
				);
				
				$this->user_cars_booking_model->insert_transaction($insert);
			}
		}
		
		if($this->input->post('payment_transaction_submit') ){
			
			//payback_renter payback_owner
			if($this->input->post('payback_renter') != "" ){
				$insert = array(
					"booking_id" => $id,
					"user_id" => $this->input->post('renter_user_id'),
					"user_type" => "RENTER",
					"transaction_id" => $this->input->post('payback_renter'),
					"status" =>  "CREATED"
				);
				
				$this->user_cars_booking_model->insert_transaction($insert);
				
			}
			if($this->input->post('payback_owner') != "" ){
				$insert = array(
					"booking_id" => $id,
					"user_id" => $this->input->post('owner_user_id'),
					"user_type" => "OWNER",
					"transaction_id" => $this->input->post('payback_owner'),
					"status" => "CREATED"
				);
				
				$this->user_cars_booking_model->insert_transaction($insert);
				
			}
			
		}
		
		$view_data['booking_id'] = $id;
		$view_data['booking_renter_transaction'] = $this->user_cars_booking_model->get_booking_transaction($id);
		$view_data['booking_actions'] = $this->user_cars_booking_model->core_get_request_action($view_data['booking_id']);
		
		$view_data['booking_payout'] = $this->user_cars_booking_model->get_payout_with_booking_id($view_data['booking_id']);
		
		$data['page_data'] = $this->load->view('booking_data/booking', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function get_current_booking() {
		$data['page_data'] = $this->load->view('booking_data/get_current_booking', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_get_current_booking() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master	where  pickup_confirmed = 1 and transaction_complete != 1 ";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
								CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
						    CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
								ucd.carPlateNumber as car_plate_number,
								ucbm.car_from,
								ucbm.car_to,
								ucbm.creation_time
						FROM urend_car_booking_master as ucbm
						join urend_users as uuo on ucbm.car_user_id = uuo.userId
						join urend_users as uur on ucbm.car_renter_id = uur.userId
						join urend_car_details as ucd on ucbm.car_id = ucd.id
						where ucbm.pickup_confirmed = 1 and ucbm.transaction_complete != 1
						";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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

	public function get_complete_booking() {
		$data['page_data'] = $this->load->view('booking_data/get_complete_booking', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_get_complete_booking() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master	where transaction_complete = 1 ";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
								CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
								CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
								ucd.carPlateNumber as car_plate_number,
								ucbm.car_from,
								ucbm.car_to,
								ucbm.creation_time
						FROM urend_car_booking_master as ucbm
						join urend_users as uuo on ucbm.car_user_id = uuo.userId
						join urend_users as uur on ucbm.car_renter_id = uur.userId
						join urend_car_details as ucd on ucbm.car_id = ucd.id
						where ucbm.transaction_complete = 1
						";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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

	public function get_new_booking_request() {
		$data['page_data'] = $this->load->view('booking_data/get_new_booking_request', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_get_new_booking_request() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master	where state = 0 and car_from > '" . date('Y-m-d H:i:s') . "'";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							ucbm.car_from,
							ucbm.car_to,
							ucbm.creation_time
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					where ucbm.state = 0
					And ucbm.rejected_by_car_owner = 0
					And ucbm.rejected_by_car_renter = 0 
					And   ucbm.car_from > '" . date('Y-m-d H:i:s') . "'";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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

	public function get_rejected_booking_request(){
		
		$data['page_data'] = $this->load->view('booking_data/get_rejected_booking_request', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);		
	}
	
	public function ajax_get_rejected_booking_request() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							ucbm.car_from,
							ucbm.car_to,
							ucbm.creation_time
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					where  (ucbm.rejected_by_car_owner = 1 
					OR  ucbm.rejected_by_car_renter = 1 
					or ucbm.auto_cancel_state = 1 ) 
					";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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
	
	public function get_pending_payments_booking() {
		
		$data['page_data'] = $this->load->view('booking_data/get_pending_payments_booking', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);		
		
	}
	
	public function ajax_get_pending_payments_booking(){
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master	where  car_from > '" . date('Y-m-d H:i:s') . "'";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							ucbm.car_from,
							ucbm.car_to,
							ucbm.creation_time
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					left join urend_booking_transaction as ubt on  ucbm.id =  ubt.booking_id
					where
					ubt.booking_id IS NULL
					And ucbm.accepted_car_owner = 1
					And ucbm.auto_cancel_state = 0 
					And ucbm.rejected_by_car_owner = 0
					And ucbm.rejected_by_car_renter = 0 
					And   ucbm.car_from > '" . date('Y-m-d H:i:s') . "'";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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
	public function get_pending_pickup_booking(){
		$data['page_data'] = $this->load->view('booking_data/get_pending_pickup_booking', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}
	
	public function ajax_get_pending_pickup_booking(){
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master	where  car_from > '" . date('Y-m-d H:i:s') . "'";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							ucbm.car_from,
							ucbm.car_to,
							ucbm.creation_time
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					 join urend_booking_transaction as ubt on  ucbm.id =  ubt.booking_id
					where
					ucbm.pickup_confirmed = 0 
					And ucbm.accepted_car_owner = 1
					And ucbm.auto_cancel_state = 0 
					And ucbm.rejected_by_car_owner = 0
					And ucbm.rejected_by_car_renter = 0 
					";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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
	
	public function get_all_booking() {
		$data['page_data'] = $this->load->view('booking_data/get_all_booking', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_get_all_booking() {
		$requestData = $_REQUEST;
		$columns = array(
			0 => 'car_plate_number',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'car_from',
			4 => 'car_to',
			5 => 'creation_time'
		);

		$query = "SELECT count(id) as total	FROM urend_car_booking_master";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT ucbm.id as id ,
							CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
							CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
							ucd.carPlateNumber as car_plate_number,
							ucbm.car_from,
							ucbm.car_to,
							ucbm.creation_time
					FROM urend_car_booking_master as ucbm
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id
					where 1=1
					";

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
		if (!empty($requestData['columns'][3]['search']['value'])) {
			$sql.=" AND car_from LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][4]['search']['value'])) {
			$sql.=" AND car_to LIKE '" . $requestData['columns'][4]['search']['value'] . "%' ";
		}
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
			$nestedData[] = $r->car_from;
			$nestedData[] = $r->car_to;
			$nestedData[] = $r->creation_time;
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

	public function booking_complete_pay_back($booking_id=null){
		$result = $this->user_cars_booking_model->booking_complete_pay_back($booking_id);
		redirect('auth_panel/booking/booking/'.$booking_id);
	}
}
