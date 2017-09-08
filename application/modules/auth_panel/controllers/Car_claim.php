<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Car_claim extends MX_Controller {

	function __construct() {
		parent::__construct();
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->library('form_validation', 'uploads');
		$this->load->model("car_claim_model");
	}

	public function index() {
		$data['page_title'] = "Car Claim List";
		$data['page_data'] = $this->load->view('car_claim/car_claim_list', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function ajax_car_claim_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;
		$columns = array(
			// datatable column index  => database column name
			0 => 'book_id',
			1 => 'car_owner',
			2 => 'car_renter',
			3 => 'claim_state'
		);

		$query = "SELECT count(id) as total  FROM urend_car_claim ";
		$query = $this->db->query($query);
		$query = $query->row_array();
		
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;
		$sql = "SELECT 	ucc.id as id ,
					case ucc.claim_state
					when '0' then 'Open'
					when '1' then 'Close'
					when '2' then 'Under Process'
					end as claim_state,
					ucc.booking_id as book_id,
					CONCAT( uuo.firstName ,' ', uuo.lastName ) AS car_owner,
					uuo.userId as car_owner_id,
					CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
					uur.userId as car_renter_id
					from urend_car_claim as ucc 
					join urend_car_booking_master as ucbm on ucbm.id = ucc.booking_id
					join urend_users as uuo on ucbm.car_user_id = uuo.userId
					join urend_users as uur on ucbm.car_renter_id = uur.userId
					join urend_car_details as ucd on ucbm.car_id = ucd.id where 1=1";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND ucc.booking_id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {
			$sql.=" AND CONCAT( uuo.firstName ,' ', uuo.lastName ) LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {
			$sql.=" AND CONCAT( uur.firstName ,' ', uur.lastName ) LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		if ($requestData['columns'][3]['search']['value'] >= 0 && $requestData['columns'][3]['search']['value'] != "") {
			$sql.=" AND ucc.claim_state = '" . $requestData['columns'][3]['search']['value'] . "' ";
		}
		$query = $this->db->query($sql)->result();
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		//echo $this->db->last_query();

		$data = array();
		foreach ($result as $r) {  // preparing an array
			$nestedData = array();
			$nestedData[] = $r->book_id;
			$nestedData[] = "<a href='" . AUTH_PANEL_URL . "web_user/user_profile/" . $r->car_owner_id . "' target='_blank'>$r->car_owner</a>";
			$nestedData[] = "<a href='" . AUTH_PANEL_URL . "web_user/user_profile/" . $r->car_renter_id . "' target='_blank'>$r->car_renter</a>";
			$nestedData[] = $r->claim_state;
			$action = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "car_claim/open_car_claim/" . $r->id . "'>View</a> ";
			$nestedData[] = $action;
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

	public function open_car_claim($id) {
		$view_data['open_car_claim'] = $this->car_claim_model->open_car_claim($id);
		$view_data['car_claim_images'] = $this->car_claim_model->car_claim_images($view_data['open_car_claim']['id']);
		$data['page_data'] = $this->load->view('car_claim/open_car_claim', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function close_car_claim($id) {
		$update_data = $this->car_claim_model->close_car_claim($id);
		if ($update_data) {
			$this->session->set_flashdata('message', 'Claim has been closed.');
		} else {
			$this->session->set_flashdata('message', 'Claim not closed.');
		}
		redirect(AUTH_PANEL_URL . 'car_claim/index');
	}

	public function under_porcess_car_claim($id) {
		$update_data = $this->car_claim_model->under_porcess_car_claim($id);
		if ($update_data) {
			$this->session->set_flashdata('message', 'Claim has been under process.');
		} else {
			$this->session->set_flashdata('message', 'Claim not under processed.');
		}
		redirect(AUTH_PANEL_URL . 'car_claim/index');
	}

}
