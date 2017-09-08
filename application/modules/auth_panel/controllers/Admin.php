<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		 *  admin panel initialization
		 *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		 */
		$this->load->helper('aul');
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->library('form_validation', 'uploads');
		$this->load->model("backend_user");
		$this->load->model("counter_model");
	}

	public function index() {
		$user_data = $this->session->userdata('active_user_data');
		$view_data['roles'] = $user_data->roles;
		$view_data['total_user'] = $this->counter_model->counter_total_users();
		$view_data['total_user_today'] = $this->counter_model->counter_total_users_today();

		$view_data['total_listed_cars'] = $this->counter_model->counter_total_listed_cars();
		$view_data['total_listed_cars_today'] = $this->counter_model->counter_total_listed_cars_today();

		$view_data['total_rental_request'] = $this->counter_model->counter_total_rental_requests();
		$view_data['total_rental_requests_today'] = $this->counter_model->counter_total_rental_requests_today();

		$view_data['total_booking'] = $this->counter_model->counter_total_booking();
		$view_data['total_booking_today'] = $this->counter_model->counter_total_booking_today();

		$data['page_data'] = $this->load->view('admin/WELCOME_PAGE_' . $user_data->roles, $view_data, TRUE);
		$data['page_title'] = "welcome page";
		echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function user_list() {
		$data['page_title'] = "user list";
		$data['page_data'] = $this->load->view('admin/user_list/user_list', '', TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function create_backend_user() {


		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'User Name', 'required|trim|is_unique[backend_user.username]');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[backend_user.email]');
			$this->form_validation->set_rules('role', 'Role', 'required|trim');
			if ($this->form_validation->run() == False) {
				
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$role = $this->input->post('role');
				$insert_array = array(
					'username' => $username,
					'email' => $email,
					'password' => md5($password),
					'roles' => $role,
					'creation_time' => time()
				);
				$insetData = $this->backend_user->create_backend_user($insert_array);
				if ($insetData == true) {
					$this->session->set_flashdata('success_message', 'User has been created succssfully');
				} else {
					$this->session->set_flashdata('error_message', 'User not created');
				}
			}
		}
		$view_data = array();
		$data['page_data'] = $this->load->view('admin/backend_user/create_new_backend_user', $view_data, TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function backend_user_list() {

		$data['page_title'] = "Backend User List";
		$data['page_data'] = $this->load->view('admin/backend_user/backend_user_list', '', TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_backend_user_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'username',
			1 => 'email',
			2 => 'roles',
			3 => 'user_state'
		);

		$query = "SELECT count(id) as total
								FROM urend_backend_user where status != 2
								";
		$query = $this->db->query($query);
		$query = $query->row_array();
		$totalData = (count($query) > 0) ? $query['total'] : 0;
		$totalFiltered = $totalData;

		$sql = "SELECT * ,
											case status
											when '0' then 'Active'
											when '1' then 'Blocked'
											end as user_state
								FROM urend_backend_user   where status != 2 ";

		// getting records as per search parameters
		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND username LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND email LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND roles LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][3]['search']['value'])) {  //salary
			$sql.=" having user_state LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
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
			$nestedData[] = $r->roles;
			$nestedData[] = $r->user_state;
			$action = "<a class='btn-sm btn btn-info' href='" . AUTH_PANEL_URL . "admin/edit_backend_user/" . $r->id . "'>Edit</a>&nbsp;"
				. "<a class='btn-sm btn btn-danger' onclick=\"return confirm('Are you sure you want to delete?')\" href='" . AUTH_PANEL_URL . "admin/delete_backend_user/" . $r->id . "'>Delete</a>&nbsp;";
			if ($r->user_state == 'Active') {
				$action .= "<a class='btn-sm btn btn-warning' href='" . AUTH_PANEL_URL . "admin/block_backend_user/" . $r->id . "/1'>Block</a>";
			} else {
				$action .= "<a class='btn-sm btn btn-success' href='" . AUTH_PANEL_URL . "admin/block_backend_user/" . $r->id . "/0'>Unblock</a>";
			}
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

	public function edit_backend_user($id = null) {
		if (!$this->input->post()) {
			if($this->input->get('password_change')){

				$data['page_toast'] = 'Password changed successfully.';
				$data['page_toast_type'] = 'success';
				$data['page_toast_title'] = 'Action performed.';
			}
			$view_data['user_data'] = $this->backend_user->get_user_data($id);
			$data['page_data'] = $this->load->view('admin/backend_user/edit_backend_user', $view_data, TRUE);
			echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
		} else {
			if ($this->input->post()) {
				$this->form_validation->set_rules('username', 'User Name', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'required|trim');
				$this->form_validation->set_rules('role', 'Role', 'required|trim');
				if ($this->form_validation->run() == False) {
					
				} else {
					$id = $this->input->post('id');
					$username = $this->input->post('username');
					$email = $this->input->post('email');
					$role = $this->input->post('role');
					$update_array = array(
						'username' => $username,
						'email' => $email,
						'roles' => $role,
						'updated_time' => time()
					);
					$update_data = $this->backend_user->update_backend_user($update_array, $id);
					if ($update_data == true) {
						$this->session->set_flashdata('success_message', 'User has been Updated succssfully');
					} else {
						$this->session->set_flashdata('error_message', 'User not Updated');
					}
					redirect(AUTH_PANEL_URL . 'admin/backend_user_list');
				}
			}
		}
	}

	public function delete_backend_user($id) {
		$delete_user = $this->backend_user->delete_backend_user($id);
		if ($update_data == true) {
			$this->session->set_flashdata('success_message', 'User has been Deleted succssfully');
		} else {
			$this->session->set_flashdata('error_message', 'User not Deleted');
		}
		redirect(AUTH_PANEL_URL . 'admin/backend_user_list');
	}

	public function block_backend_user($id, $status) {
		$delete_user = $this->backend_user->block_backend_user($id, $status);
		if ($update_data == true) {
			$this->session->set_flashdata('success_message', 'User has been Deleted succssfully');
		} else {
			$this->session->set_flashdata('error_message', 'User not Deleted');
		}
		redirect(AUTH_PANEL_URL . 'admin/backend_user_list');
	}


	public function change_password_backend_user(){
		$id= $this->input->post('id');
		if($this->input->post('new_password') != ''){
			$update_data = $this->backend_user->change_password_backend_user($this->input->post());
		}
		redirect(AUTH_PANEL_URL . "admin/edit_backend_user/$id?password_change=true");
	}

}
