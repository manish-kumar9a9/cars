<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Web_cars_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function set_car_varified($id){
        $data = array("is_verified"=>1);
        $this->db->where('id', $id);
        $this->db->update('urend_car_details',$data);
    }

   	public function get_car_data($id){

   		$this->db->select(" * ");
        $this->db->where('id', $id);
        return $result = $this->db->get('urend_car_details')->row_array();
   	}
    
    public function backend_car_action_log($car_id){
      $array = array('car_id'=>$car_id,
                     'backend_user_id'=>$this->session->userdata('active_backend_user_id'),
                     'creation_time' =>time(),
                     'action' =>'approve'
                     );
      $result = $this->db->insert('urend_backend_car_action_log',$array);
      return $result;

    }
}
