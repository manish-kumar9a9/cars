<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Web_request_report_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function all_requests_data($data){
      $this->db->select("
                        CONCAT( uu.firstName ,' ', uu.lastName ) AS car_owner,
                        CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
                        ucbm.car_renter_text,
                        ucbm.car_from,
                        ucbm.car_to,
                        ucbm.car_daily_price,
                        ucbm.pickup_location,
                        ucbm.drop_off_location,
                        ucbm.creation_time
                        ");
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(ucbm.creation_time)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(ucbm.creation_time) >=",$from);
        $this->db->where("date(ucbm.creation_time) <=",$to);
      }
      $this->db->from('urend_car_booking_master as ucbm');
      $this->db->join('urend_users as uu','uu.userId = ucbm.car_user_id');
      $this->db->join('urend_users as uur','uur.userId = ucbm.car_renter_id');
      $result = $this->db->get()->result_array();
      return $result;
    }


    public function all_requests_by_user_data($data){
      $this->db->select("
                        CONCAT( uu.firstName ,' ', uu.lastName ) AS car_owner,
                        CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
                        ucbm.car_renter_text,
                        ucbm.car_from,
                        ucbm.car_to,
                        ucbm.car_daily_price,
                        ucbm.pickup_location,
                        ucbm.drop_off_location,
                        ucbm.creation_time
                        ");
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(ucbm.creation_time)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(ucbm.creation_time) >=",$from);
        $this->db->where("date(ucbm.creation_time) <=",$to);
      }
      $this->db->from('urend_car_booking_master as ucbm');
      $this->db->join('urend_users as uu','uu.userId = ucbm.car_user_id');
      $this->db->join('urend_users as uur','uur.userId = ucbm.car_renter_id');
      $result = $this->db->get()->result_array();
      return $result;
    }


    public function accepted_requests_data($data){
      $this->db->select("
                        CONCAT( uu.firstName ,' ', uu.lastName ) AS car_owner,
                        CONCAT( uur.firstName ,' ', uur.lastName ) AS car_renter,
                        ucbm.car_renter_text,
                        ucbm.car_from,
                        ucbm.car_to,
                        ucbm.car_daily_price,
                        ucbm.pickup_location,
                        ucbm.drop_off_location,
                        ucbm.creation_time
                        ");
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(ucbm.creation_time)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(ucbm.creation_time) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(ucbm.creation_time) >=",$from);
        $this->db->where("date(ucbm.creation_time) <=",$to);
      }
      $this->db->where("accepted_car_owner",1);
      $this->db->from('urend_car_booking_master as ucbm');
      $this->db->join('urend_users as uu','uu.userId = ucbm.car_user_id');
      $this->db->join('urend_users as uur','uur.userId = ucbm.car_renter_id');
      $result = $this->db->get()->result_array();
      return $result;
    }

}
?>
