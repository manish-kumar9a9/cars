<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Faq_help extends MX_Controller {

	function __construct() {
		parent::__construct();
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('faq_help_model');
	}

	public function index() {

		if ($this->input->post()) {
			$result =$this->faq_help_model->create_faq_help($this->input->post());
			if($result){
				$data['page_toast'] = 'FAQ created successfully.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			}else{
				$data['page_toast'] = 'FAQ not created.';
				$data['page_toast_type'] = 'error';
				$data['page_toast_title'] = 'Action performed.';
			}
		}
		
		$data['page_title'] = "Create FAQ";
		$data['page_data'] = $this->load->view('help/create_faq_help', '', TRUE);
		echo modules::run('auth_panel/template/call_default_template', $data);
	}


	public function faq_help_list() {

		$data['page_title'] = "Backend User List";
		$data['page_data'] = $this->load->view('help/faq_help_list', '', TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_faq_help_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'faq_for',
			1 => 'faq_type',
			2 => 'faq_question',
		);

		$query = "SELECT count(faq_id) as total
								FROM urend_faq
								";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM urend_faq   where 1=1 ";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND faq_for LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND faq_type LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND faq_question LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();

		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		$data = array();
		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->faq_for;
			$nestedData[] = $r->faq_type;
			$nestedData[] = $r->faq_question;
			$action = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "faq_help/edit_faq_help/" . $r->faq_id . "'>Edit</a>&nbsp;"
				. "<a class='btn-sm btn btn-danger' href='" . AUTH_PANEL_URL . "faq_help/delete_faq_help/" . $r->faq_id . "'>Delete</a>&nbsp;";
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

	public function edit_faq_help($id = null) {
		if($this->input->post()){
			$result = $this->faq_help_model->update_faq_help($this->input->post());
			if($result){
				$data['page_toast'] = 'FAQ updated successfully.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			}else{
				$data['page_toast'] = 'FAQ not updated.';
				$data['page_toast_type'] = 'error';
				$data['page_toast_title'] = 'Action performed.';
			}
		}

		$view_data['user_data'] = $this->faq_help_model->edit_faq_help($id);
		$data['page_title'] = "Backend User List";
		$data['page_data'] = $this->load->view('help/edit_faq_help', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function delete_faq_help($id = null){
		$result = $this->faq_help_model->delete_faq_help($id);
		if($result){
				$data['page_toast'] = 'FAQ deleted successfully.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			}else{
				$data['page_toast'] = 'FAQ not deleted.';
				$data['page_toast_type'] = 'error';
				$data['page_toast_title'] = 'Action performed.';
			}
		redirect(AUTH_PANEL_URL . 'faq_help/faq_help_list');
	}

}
