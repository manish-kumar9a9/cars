<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Web_user_report_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function registered_users_data($data){
      $this->db->select('firstName,lastName,email,mobile,transmission_state,createdAt');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdAt)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdAt) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdAt) >=" ,$from);
        $this->db->where("date(createdAt) <=",$to);
      }
      $result = $this->db->get('urend_users')->result_array();
      return $result;
    }


    public function verified_users_data($data){
      $this->db->select('urend_users.firstName,urend_users.lastName,urend_users.email,urend_users.mobile,urend_users.transmission_state,urend_users.createdAt');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdAt)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdAt) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdAt) >=" ,$from);
        $this->db->where("date(createdAt) <=",$to);
      }
      $this->db->where('urend_user_license_data.state',1);
      $this->db->from('urend_users');
      $this->db->join('urend_user_license_data','urend_user_license_data.user_id = urend_users.userId');
      $result = $this->db->get()->result_array();
      return $result;
    }


    public function pending_verification_users_data($data){
      $this->db->select('urend_users.firstName,urend_users.lastName,urend_users.email,urend_users.mobile,urend_users.transmission_state,urend_users.createdAt');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdAt)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdAt) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdAt) >=" ,$from);
        $this->db->where("date(createdAt) <=",$to);
      }
      $this->db->where('urend_user_license_data.state',0);
      $this->db->from('urend_users');
      $this->db->join('urend_user_license_data','urend_user_license_data.user_id = urend_users.userId');
      $result = $this->db->get()->result_array();
      return $result;
    }


    public function not_verified_users_data($data){

      $this->db->select('urend_users.firstName,urend_users.lastName,urend_users.email,urend_users.mobile,urend_users.transmission_state,urend_users.createdAt,ifnull(urend_user_license_data.state,4) as state');
      if($data['time_period'] == 'DAILY'){
        $date = date('Y-m-d');
        $this->db->where("date(createdAt)",$date);
      }else if($data['time_period'] == 'WEEKLY'){
        $date = date('Y-m-d',strtotime("-7day"));
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'MONTHLY'){
        $date = date('Y-m-01');
        $this->db->where("date(createdAt) >=",$date);
      }else if($data['time_period'] == 'YEARLY'){
         $date = date('Y-01-01');
        $this->db->where("date(createdAt) >=",$date);
      }else{
        $from = $data['from'];
        $to = $data['to'];
        $this->db->where("date(createdAt) >=" ,$from);
        $this->db->where("date(createdAt) <=",$to);
      }
      $this->db->from('urend_users');
      $this->db->having('state',4);
      $this->db->or_having('state',2);
      $this->db->join('urend_user_license_data','urend_user_license_data.user_id = urend_users.userId','left');
      $result = $this->db->get()->result_array();
      return $result;
    }

}
?>
