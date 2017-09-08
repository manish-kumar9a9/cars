<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Car_claim_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function open_car_claim($id){
      $this->db->where('id',$id);
      $result = $this->db->get('urend_car_claim')->row_array();
      return $result;
    }

    public function car_claim_images($booking_id){
      $this->db->where('booking_id',$booking_id);
      $result = $this->db->get('urend_car_claim_images')->result_array();
      if(!empty($result)){
        return $result;
      }else{
        return false;
      }
    }

    public function close_car_claim($id){
      $update_array = array('claim_state' =>  1);
      $this->db->where('id',$id);
      $result = $this->db->update('urend_car_claim',$update_array);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    public function under_porcess_car_claim($id){
      $update_array = array('claim_state' =>  2);
      $this->db->where('id',$id);
      $result = $this->db->update('urend_car_claim',$update_array);
      if($result){
        return true;
      }else{
        return false;
      }
    }

}
