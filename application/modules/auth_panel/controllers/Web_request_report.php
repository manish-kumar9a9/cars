<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Web_request_report extends MX_Controller {

  function __construct(){
    parent::__construct();
    modules::run( 'auth_panel/auth_panel_ini/auth_ini');

    $this->load->library('form_validation','uploads');
		$this->load->model("Web_request_report_model");
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
    $data['page_title'] = "Web request report";
    $data['page_data']  = $this->load->view('web_request_report/web_request_report','',TRUE);
    echo modules::run('auth_panel/template/call_default_template',$data );
  }

  public function web_request_report_data(){
    $header = array('Car owner','Car renter','Car renter text','Car from','Car to','Car daily price',
                    'Pickup location','Drop off location','Creation time');
    /*
    * Get request record for csv download
    */
      if($this->input->post('user_report') == "ALL_REQUESTS"){
        $data =  $this->create_a_r_d($this->input->post());

      } else if($this->input->post('user_report') == "ALL_REQUESTS_BY_USER"){
        $data = $this->create_a_q_b_u_d($this->input->post());

      } else if($this->input->post('user_report') == "ACCEPTED_REQUESTS"){
        $data = $this->create_ac_r_d($this->input->post());

      }
    $file_name = 'request_report_csv.csv';
    $this->csv_download($file_name,$header,$data);
  }

  private function create_a_r_d($record){
      return $this->Web_request_report_model->all_requests_data($record);
  }
  private function create_a_q_b_u_d($record){
    return $this->Web_request_report_model->all_requests_by_user_data($record);
  }
  private function create_ac_r_d($record){
    return $this->Web_request_report_model->accepted_requests_data($record);
  }

}
?>
