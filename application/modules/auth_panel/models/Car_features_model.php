<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class car_features_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function edit_car_feature($id){
      $this->db->where('id',$id);
      $result = $this->db->get('urend_car_features_master')->row_array();
      return $result;
    }

    public function validation_for_car_features($id,$features){
      $array = array('features' => $features);
      $this->db->where($array);
      $this->db->where('id!=',$id);
      $result = $this->db->get('urend_car_features_master')->num_rows();
      if($result > 0){
        return true;
      }else{
        return false;
      }
    }

    public function update_car_feature($update_array,$id){
      $this->db->where('id',$id);
      $result = $this->db->update('urend_car_features_master',$update_array);
      if($result){
        return true;
      }else{
        return false;
      }
    }

    public function add_car_features($data){
      $result = $this->db->insert(urend_car_features_master,$data);
      if($result){
        return true;
      }else{
        return false;
      }
    }
}
?>
