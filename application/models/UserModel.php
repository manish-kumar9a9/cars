<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function signIn($data) {
        $this->db->where('email', $data['email']);
        $result = $this->db->get('users')->row_array();
        return $result;
    }

    public function get_user_with_userId($userId) {
        $this->db->where('userId', $userId);
        $result = $this->db->get('users')->row_array();
        return $result;
    }

    function get_country_code() {
        $this->db->order_by("country", "asc");
        $result = $this->db->get('urend_country_code')->result_array();
        return $result;
    }

    function verifyOTP($data) {
        $this->db->where('email', $data['email']);
        $this->db->where('otp', $data['otp']);
        $result = $this->db->get('users')->row_array();
        if ($result) {
            $this->db->where('email', $data['email']);
            $this->db->where('otp', $data['otp']);
            $query = $this->db->update('users', $data);
        }

        return $result;
    }

    function resend_otp($data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        }
        return false;
    }

    function getFb($fbId) {
        $this->db->where('fbId', $fbId);
        $result = $this->db->get('users')->row_array();
        return $result;
    }

    function getGmail($gId) {
        $this->db->where('gId', $gId);
        $result = $this->db->get('users')->row_array();
        return $result;
    }

    function signUpFb($data) {
        $result = $this->getFb($data['fbId']);
        if (empty(result)) {
            $this->db->insert('users', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    function signUp($data) {

        unset($data['submit']);
        $data['createdAt'] = date("Y-m-d H:i:s");
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function isUserEmailExist($data) {
        $this->db->where('email', $data['email']);
        $result = $this->db->get('users')->row_array();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    function isUserExistFB($data) {
        $this->db->where('fbId', $data['fbId']);
        $result = $this->db->get('users')->row_array();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    function isUserExistGmail($data) {
        $this->db->where('gId', $data['gId']);
        $result = $this->db->get('users')->row_array();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    function editProfile($data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /*
     *
     */

    function carTables($document) {
        $table = $document['table'];

        if ($table == "caryear") {
            $this->db->where('make_id', $document['make_id']);
            $this->db->order_by('year', 'desc');
        }

        if ($table == "carmodel") {
            $this->db->where('makeyear_id', $document['makeyear_id']);
        }

        $result = $this->db->get($table)->result_array();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    /*
     * get all car types 
     */

    public function get_all_car_type() {
        $this->db->order_by('name', 'asc');
        $result = $this->db->get('urend_car_types')->result_array();
        if (!empty($result)) {
            return $result;
        }

        return array();
    }

    /*
     * get all car makers
     */

    public function get_all_car_maker() {
        $this->db->order_by('name', 'asc');
        $result = $this->db->get('urend_car_makes')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    /*
     * get  car maker years w.r.t. car makers
     */

    public function get_car_maker_year($car_maker = "") {
        $this->db->where('make_id', $car_maker);
        $this->db->order_by('year', 'asc');
        $result = $this->db->get('urend_car_make_years')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    /*
     * get  models w.r.t. car years_id
     */

    public function get_car_year_model($make_id = "") {
        $query = $this->db->query("SELECT ucm.id, concat(ucm.name, ' ', ucmy.year ) AS name
                                           FROM urend_car_models AS ucm, urend_car_make_years AS ucmy
                                           WHERE makeyear_id
                                               IN (
                                                   SELECT id
                                                   FROM urend_car_make_years
                                                   WHERE make_id ='$make_id'
                                               )
                                           AND ucmy.id = ucm.makeyear_id
                                           Order by name
                                           ");
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_car_city_list($id = "") {
        $this->db->where('fk_country', $id);
        $this->db->order_by('city_name', 'asc');
        $result = $this->db->get('urend_car_city_list')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_fuel_types() {
        
        $result = $this->db->get('urend_car_fuel_types')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_transmission_types() {
        $this->db->order_by('transmission', 'asc');
        $result = $this->db->get('urend_car_transmission_master')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_colour_types() {

        $result = $this->db->get('urend_car_colour_master')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_airbag_types() {
        $this->db->order_by('name', 'asc');
        $result = $this->db->get('urend_car_airbag_master')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_feature_types() {
        $this->db->order_by('features', 'asc');
        $result = $this->db->get('urend_car_features_master')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    public function get_all_country() {
        $this->db->order_by('country', 'asc');
        $result = $this->db->get('urend_car_country_list`')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }

    function getAllUsers() {
        $result = $this->db->get('users')->result_array();
        return $result;
    }

    function get_user($userId) {
        $data = $this->db->get_where('users', array('userId' => $userId));
        return $data->row_array();
    }

    function isUserExist($document) {

        $this->db->where('userName', $document['userName']);
        $this->db->where('password', $document['password']);
        $result = $this->db->get('admin')->row_array();


        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_list_of_car_models($make_id =""){
        $this->db->where('make_id', $make_id);
        $this->db->order_by('name', 'asc');
        $result = $this->db->get('urend_car_models')->result_array();
        if (!empty($result)) {
            return $result;
        }
        return array();
    }
}
