<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Web_user_report extends MX_Controller {

  function __construct(){
    parent::__construct();
    modules::run( 'auth_panel/auth_panel_ini/auth_ini');

    $this->load->library('form_validation','uploads');
		$this->load->model("Web_user_report_model");
  }

  private function csv_download($file_name,$header,$data){

    $filename = $file_name;
    $fp = fopen('php://output', 'w');

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    fputcsv($fp, $header);
    foreach($data as $row){
        fputcsv($fp, $row);
    }
    exit;
  }

  public function index(){
    $data['page_title'] = "Web user report";
		$data['page_data']  = $this->load->view('web_user_report/web_user_report','',TRUE);
		echo modules::run('auth_panel/template/call_default_template',$data );
  }

  public function web_user_report_data(){
    $header = array('First Name','Last Name','email','mobile','Transmission state','createdAt');
    /*
    * Get user record for csv download
    */
      if($this->input->post('user_report') == "REGISTERED_USERS"){
        $data =  $this->create_r_u_d($this->input->post());

      } else if($this->input->post('user_report') == "VERIFIED_USERS"){
        $data = $this->create_v_u_d($this->input->post());

      } else if($this->input->post('user_report') == "PENDING_VERIFICATION_USERS"){
        $data = $this->create_p_v_u_d($this->input->post());

      }else if($this->input->post('user_report') == "NOT_VERIFIED_USERS"){
        $data = $this->create_n_v_u_d($this->input->post());
      }
    $file_name = 'user_report_csv.csv';
    $this->csv_download($file_name,$header,$data);
    redirect(AUTH_PANEL_URL.'web_user_report/index');

  }

  private function create_r_u_d($record){
      return $this->Web_user_report_model->registered_users_data($record);
  }
  private function create_v_u_d($record){
    return $this->Web_user_report_model->verified_users_data($record);
  }
  private function create_p_v_u_d($record){
    return $this->Web_user_report_model->pending_verification_users_data($record);
  }
  private function create_n_v_u_d($record){
    return $this->Web_user_report_model->not_verified_users_data($record);
  }



}
?>
