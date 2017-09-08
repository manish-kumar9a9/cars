<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reported_car_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* this function is used to get used verified or unverified details */

    public function reported_car($id) {
        $this->db->select("*");
        $this->db->where('id', $id);
        $result = $this->db->get('urend_car_reports')->row_array();
        if (!empty($result['reason_id'])) {
            $reason_id_array = explode(',', $result['reason_id']);
            foreach ($reason_id_array as $reason_id) {
                $sql = "select text from urend_car_report_type where id = $reason_id";
                $reason_text = $this->db->query("$sql")->row_array();
                $reason_text_array[] = $reason_text['text'];
            }
            $reason_text_array['other'] = $result['other_text'];
            $reason_text_array['id'] = $result['car_id'];
            return $reason_text_array;
            die;
        } else {
            $reason_text_array['other'] = $result['other_text'];
            $reason_text_array['id'] = $result['car_id'];
            return $reason_text_array;
            die;
        }
    }

}
