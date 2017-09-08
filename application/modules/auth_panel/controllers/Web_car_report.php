<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Web_car_report extends MX_Controller {

  function __construct(){
    parent::__construct();
    modules::run( 'auth_panel/auth_panel_ini/auth_ini');

    $this->load->library('form_validation','uploads');
		$this->load->model("Web_car_report_model");
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
    $data['page_title'] = "Web car report";
    $data['page_data']  = $this->load->view('web_car_report/web_car_report','',TRUE);
    echo modules::run('auth_panel/template/call_default_template',$data );
  }

  public function web_car_report_data(){
    $header = array('Car model','Car brought year','Mileage','Cubic Capacity','Doors','Seat',
                    'Car plate number','Created date','Daily price','Weekly price','Monthly price','Pickup location','DropOff location');
    /*
    * Get user record for csv download
    */
      if($this->input->post('user_report') == "LISTED_CAR"){
        $data =  $this->create_l_c_d($this->input->post());

      } else if($this->input->post('user_report') == "APPROVED_CAR"){
        $data = $this->create_a_c_d($this->input->post());

      } else if($this->input->post('user_report') == "PENDING_APPROVAL_CAR"){
        $data = $this->create_p_a_c_d($this->input->post());

      }else if($this->input->post('user_report') == "UNLISTED/DELETED_CAR"){
        $header = array('Car model','Car brought year','Mileage','Cubic Capacity','Doors','Seat',
                        'Car plate number','Created date','Daily price','Weekly price','Monthly price','Pickup location','DropOff location','Reason');
        $data = $this->create_u_d_c_d($this->input->post());
      }
    $file_name = 'car_report_csv.csv';
    $this->csv_download($file_name,$header,$data);
  }

  private function create_l_c_d($record){
      return $this->Web_car_report_model->listed_car_data($record);
  }
  private function create_a_c_d($record){
    return $this->Web_car_report_model->approved_car_data($record);
  }
  private function create_p_a_c_d($record){
    return $this->Web_car_report_model->pending_approved_car_data($record);
  }
  private function create_u_d_c_d($record){
    return $this->Web_car_report_model->unlisted_deleted_car_data($record);
  }

}
?>
