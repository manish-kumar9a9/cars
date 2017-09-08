<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_notification_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_notification_with_id($user_id){

        $this->db->where('user_id', $user_id);
        $this->db->order_by("notification_time","desc");
        $result = $this->db->get('urend_notification_master')->result_array();
        return $result;
    }

    public function add_notification_to_user($data){

        $record = array(
                        "user_id"=>$data['user_id'], 
                        "text"=>$data['text'] , 
                        "notification_time"=> date("Y-m-d H:i:s")
            );
        $this->db->insert('urend_notification_master',$record);
    }
}