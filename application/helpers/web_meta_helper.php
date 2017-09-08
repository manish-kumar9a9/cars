<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('web_meta_data')) {

	function web_meta_data($option_name = null, $option_value = null) {
		$CI = & get_instance();
		if (!empty($option_name) && empty($option_value)) {
			$option_name = strtoupper($option_name);
			$result = $CI->db->where('option_name', $option_name)->get('urend_web_options')->row_array();
			if (!empty($result)) {
				return $result['option_value'];
			} else {
				return false;
			}
		} else {
			$result = $CI->db->where('option_name', $option_name)->get('urend_web_options')->num_rows();
			if ($result > 0) {
				$array = array('option_value' => $option_value);
				$result_data = $CI->db->where('option_name', $option_name)->update('urend_web_options', $array);
				if ($result_data) {
					return true;
				} else {
					return false;
				}
			} else {
				$array = array('option_name' => $option_name, 'option_value' => $option_value);
				$result_data = $CI->db->insert('urend_web_options', $array);
				if ($result_data) {
					return true;
				} else {
					return false;
				}
			}
		}
	}

}


if (!function_exists('get_web_meta_data')) {
	function get_web_meta_data($option_name = null) {
		$CI = & get_instance();
		if (!empty($option_name)) {
			$option_name = strtoupper($option_name);
			$result = $CI->db->where('option_name', $option_name)->get('urend_web_options')->row_array();
			if (!empty($result)) {
				return $result['option_value'];
			}
		}
		return "";
	}
}	
