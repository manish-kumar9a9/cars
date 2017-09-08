<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Web_users_verification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	/* this function is used to get used verified or unverified details */

	public function get_user_verification_document_info($user_id)
	{
		$this->db->select("*");
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('user_license_data')->row();
		return $result;
    }


	public function getDataById($table,$where)
	{
        $query = $this->db->get_where($table,$where);
        return $query->row();
    }

    public function updateRecordById($table, $data, $where)
	{
		return $this->db->update($table, $data, $where);
    }
	/*********************End User verification data **************************/
}
