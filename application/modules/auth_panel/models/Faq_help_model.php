<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Faq_help_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    public function create_faq_help($data){
      $data_array = array('faq_for'=>$data['faq_for'],
                          'faq_type'=>$data['faq_type'],
                          'faq_question'=>$data['faq_question'],
                          'faq_answer'=>$data['faq_answer']
                          );
      $result = $this->db->insert('urend_faq',$data_array);
      if($result){
        return true;
      }
      return false;
    }

    public function edit_faq_help($id){
      $result = $this->db->where('faq_id',$id)->get('urend_faq')->row_array();
      if($result){
        return $result;
      }
      return $result ='';
    }

    public function update_faq_help($data){
      $data_array = array('faq_for'=>$data['faq_for'],
                          'faq_type'=>$data['faq_type'],
                          'faq_question'=>$data['faq_question'],
                          'faq_answer'=>$data['faq_answer']
                          );
      $result = $this->db->where('faq_id',$data['faq_id'])->update('urend_faq',$data_array);
      if($result){
        return true;
      }
        return false;

    }

    public function delete_faq_help($id){
      $result = $this->db->where('faq_id',$id)->delete('urend_faq');
      if($result){
        return true;
      }
        return false;
    }

}
