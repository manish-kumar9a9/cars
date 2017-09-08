<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Web_car_report_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function web_car_report_data(){
      $this->db->select('model,car_brought_year,mileage,cubicCapacity,doors,seat,carPlateNumber,createdDate');
      $result = $this->db->get('urend_car_details')->result_array();
      return $result;
    }


    public function listed_car_data($data){
      $this->db->select('model,car_brought_year,mileage,cubicCapacity,doors,
                        seat,carPlateNumber,createdDate,price_daily,price_weekly,price_monthly,carPickUpLocation,carDropOffLocation');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdDate)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdDate) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdDate) >=",$from);
        $this->db->where("date(createdDate) <=",$to);
      }
      $result = $this->db->get('urend_car_details')->result_array();
      return $result;
    }


    public function approved_car_data($data){
      $this->db->select('model,car_brought_year,mileage,cubicCapacity,doors,
                        seat,carPlateNumber,createdDate,price_daily,price_weekly,price_monthly,carPickUpLocation,carDropOffLocation');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdDate)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdDate) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdDate) >=",$from);
        $this->db->where("date(createdDate) <=",$to);
      }
      $this->db->where('is_verified',1);
      $result = $this->db->get('urend_car_details')->result_array();
      return $result;
    }


    public function pending_approved_car_data($data){
      $this->db->select('model,car_brought_year,mileage,cubicCapacity,doors,
                        seat,carPlateNumber,createdDate,price_daily,price_weekly,price_monthly,carPickUpLocation,carDropOffLocation');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdDate)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdDate) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdDate) >=",$from);
        $this->db->where("date(createdDate) <=",$to);
      }
      $this->db->where('is_verified',0);
      $result = $this->db->get('urend_car_details')->result_array();
      return $result;
    }


    public function unlisted_deleted_car_data($data){
      $this->db->select('urend_car_details.model,urend_car_details.car_brought_year,urend_car_details.mileage,urend_car_details.cubicCapacity,urend_car_details.doors,
                        urend_car_details.seat,urend_car_details.carPlateNumber,urend_car_details.createdDate,urend_car_details.price_daily,urend_car_details.price_weekly,
                        urend_car_details.price_monthly,urend_car_details.carPickUpLocation,urend_car_details.carDropOffLocation,urend_car_deleted_reason.reason_id');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdDate)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdDate) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdDate) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdDate) >=",$from);
        $this->db->where("date(createdDate) <=",$to);
      }
      $this->db->from('urend_car_details');
      $this->db->join('urend_car_deleted_reason','urend_car_deleted_reason.car_id = urend_car_details.id');
      $result = $this->db->get()->result_array();
      /* this for each is use for reason text */
      if(!empty($result)){
        foreach($result as $reason_data){
          $reason_id_array = explode(',',$reason_data['reason_id']);
          foreach($reason_id_array as $reason_id){
              $sql = "select text from urend_car_delete_type where id = $reason_id";
              $reason_text = $this->db->query("$sql")->row_array();
              $reason_text_array[] = $reason_text['text'];
          }
                $reason_data['reason_id'] = implode(',',$reason_text_array);
                $deleted_car_data[] = $reason_data;
        }
              return $deleted_car_data;
              die;
      }
      return $result;

    }

}

?>
