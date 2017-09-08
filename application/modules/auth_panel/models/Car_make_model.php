<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Car_make_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function edit_car_makes($id){
      $this->db->where('id',$id);
      $result = $this->db->get('urend_car_makes')->row_array();
      return $result;
    }
    public function update_car_makes($data,$id){
      $this->db->where('id',$id);
      $result = $this->db->update('urend_car_makes',$data);
      return $result;
    }

    public function add_car_maker($data){
      $result = $this->db->insert('urend_car_makes',$data);
      return $result;
    }

    public function edit_car_make_model($id){
      $this->db->select('urend_car_models.*,urend_car_makes.name as makes');
      $this->db->where('urend_car_models.id',$id);
      $this->db->from('urend_car_models');
      $this->db->join("urend_car_makes",'urend_car_makes.id = urend_car_models.make_id');
      $result = $this->db->get()->row_array();
      return $result;
    }
    public function update_car_model($data,$id){
      $this->db->where('id',$id);
      $result = $this->db->update('urend_car_models',$data);
      return $result;
    }

    public function car_makers_name(){
      $this->db->select('*');
      $result = $this->db->get('urend_car_makes')->result_array();
      return $result;
    }

    public function add_car_maker_model($data){
      $result = $this->db->insert('urend_car_models',$data);
      return $result;
    }

    public function validation_for_car_model($id,$maker,$model){
      $array = array('make_id'=>$maker,'name' => $model);
      $this->db->where($array);
      $this->db->where('id!=',$id);
      $result = $this->db->get('urend_car_models')->num_rows();
      if($result > 0){
        return true;
      }else{
        return false;
      }
    }
    public function validation_for_car_maker($id,$model){
      $array = array('name' => $model);
      $this->db->where($array);
      $this->db->where('id!=',$id);
      $result = $this->db->get('urend_car_makes')->num_rows();
      if($result > 0){
        return true;
      }else{
        return false;
      }
    }

}

?>
