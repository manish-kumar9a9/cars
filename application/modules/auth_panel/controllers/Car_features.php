<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Car_features extends MX_Controller {

	function __construct() {
		parent::__construct();
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->library('form_validation', 'uploads');
		$this->load->model("car_features_model");
	}

	public function index() {
		$data['page_title'] = "Car Features List";
		$data['page_data'] = $this->load->view('car_features/car_features.php', '', TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_car_features_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;
		$columns = array(
			// datatable column index  => database column name
			0 => 'features'
		);

		$query = "SELECT count(id) as total
              FROM urend_car_features_master
              ";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;
		$sql = "SELECT * from urend_car_features_master  where 1=1 ";
		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND features LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		$query = $this->db->query($sql)->result();
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		$data = array();
		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = $r->features;
			$nestedData[] = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "car_features/edit_car_feature/" . $r->id . "'>Edit</a>&nbsp;";

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

	public function edit_car_feature($id) {
		if (!$this->input->post()) {
			$view_data['edit_car_feature'] = $this->car_features_model->edit_car_feature($id);
			$data['page_data'] = $this->load->view('car_features/edit_car_feature', $view_data, TRUE);
			echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
		} else {
			if ($this->input->post()) {
				if (!empty($this->input->post('features'))) {
					$id = $this->input->post('id');
					$features = $this->input->post('features');
					$validation_result = $this->validation_for_car_features($id, $features);
					if ($validation_result) {
						$this->session->set_flashdata('error_message', 'Car feature already exist');
						redirect(AUTH_PANEL_URL . 'car_features/edit_car_feature/' . $id);
					} else {
						$update_array = array('features' => $features,'greek_lang' => $this->input->post('greek_lang'), 'modifiedDate' => date('y-m-d H:i:s'));
						$update_data = $this->car_features_model->update_car_feature($update_array, $id);
						if ($update_data == true) {
							$this->session->set_flashdata('success_message', 'Car feature has been Updated succssfully');
						} else {
							$this->session->set_flashdata('error_message', 'Car feature not Updated');
						}
					}
					redirect(AUTH_PANEL_URL . 'car_features/index');
				} else {
					$this->session->set_flashdata('error_message', 'Please enter the car feature');
					redirect(AUTH_PANEL_URL . 'car_features/edit_car_feature/' . $id);
				}
			}
		}
	}

	private function validation_for_car_features($id, $features) {
		$result = $this->car_features_model->validation_for_car_features($id, $features);
		return $result;
	}

	public function add_car_features() {
		if (!$this->input->post()) {
			$data['page_title'] = "Add car Feature";
			$data['page_data'] = $this->load->view('car_features/add_car_features', '', TRUE);
			echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
		} else {
			if ($this->input->post()) {
				if (!empty($this->input->post('features'))) {
					$features = $this->input->post('features');
					$id = '';
					$validation_result = $this->validation_for_car_features($id, $features);
					if ($validation_result) {
						$this->session->set_flashdata('error_message', 'Car feature already exist');
						redirect(AUTH_PANEL_URL . 'car_features/add_car_features');
					} else {
						$add_model_array = array('features' => $features,'greek_lang' => $this->input->post('greek_lang') , 'createdDate' => date('Y-m-d H:i:s'));
						$insert_data = $this->car_features_model->add_car_features($add_model_array);
						if ($insert_data == true) {
							$this->session->set_flashdata('success_message', 'Car feature has been create succssfully');
						} else {
							$this->session->set_flashdata('error_message', 'Car feature not create');
						}
					}
					redirect(AUTH_PANEL_URL . 'car_features/index');
				} else {
					$this->session->set_flashdata('error_message', 'Please enter the car feature');
					redirect(AUTH_PANEL_URL . 'car_features/add_car_features');
				}
			}
		}
	}

}
