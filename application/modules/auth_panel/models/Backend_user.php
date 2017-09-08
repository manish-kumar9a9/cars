<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Backend_user extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function create_backend_user($data){
      $result = $this->db->insert("backend_user",$data);
      return $result;
    }
    public function get_user_data($id){
      $this->db->where('id',$id);
      $result = $this->db->get("backend_user")->row_array();
      return $result;
    }
    public function update_backend_user($data,$id){
      $this->db->where('id',$id);
      $result = $this->db->update("backend_user",$data);
      return $result;
    }
    public function delete_backend_user($id){
      $data = array('status' =>2);
      $this->db->where('id',$id);
      $result = $this->db->update("backend_user",$data);
    }
    public function block_backend_user($id,$status){
      $data = array('status' =>$status);
      $this->db->where('id',$id);
      $result = $this->db->update("backend_user",$data);
    }

     public function change_password_backend_user($data){
      $data_array = array('password'=> md5($data['new_password']));
      $result = $this->db->where('id',$data['id'])->update("backend_user",$data_array);
    }
}
