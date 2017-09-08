<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page_meta_data extends MX_Controller {

	function __construct() {
		parent::__construct();
		modules::run('auth_panel/auth_panel_ini/auth_ini');
		$this->load->model('page_meta_data_model');
	}

	public function edit_page_meta_data() {
			if ($this->input->post()) {
				$result = $this->page_meta_data_model->update_page_meta_data($this->input->post());
				if($result){
					$data['page_toast'] = 'Updated successfully.';
					$data['page_toast_type'] = 'success';
					$data['page_toast_title'] = 'Action performed.';
				}else{
					$data['page_toast'] = 'Meta data not updated.';
					$data['page_toast_type'] = 'error';
					$data['page_toast_title'] = 'Action performed.';
				}
			
			}
			$view_data['page_name'] = $this->page_meta_data_model->get_page_name();
			$data['page_title'] = "Page meta data";
			$data['page_data'] = $this->load->view('page_meta_data/edit_page_meta_data', $view_data, TRUE);
			echo modules::run('auth_panel/template/call_default_template', $data);
	}

	public function get_page_meta_data(){
		$result = $this->page_meta_data_model->get_page_meta_data($this->input->post());
		if(!empty($result)){
			$array = array('isSuccess'=>true, 'result' =>$result['page_meta_data']);
    		echo json_encode($array);die;
		}
		$array = array('isSuccess'=>false, 'result' =>'');
    		echo json_encode($array);die;
	}
}