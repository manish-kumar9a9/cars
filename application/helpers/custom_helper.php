<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!function_exists('pre')) {

	function pre($array) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

}

if (!function_exists('current_full_url')) {

	function current_full_url() {
		$CI = & get_instance();

		$url = $CI->config->site_url($CI->uri->uri_string());
		return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
	}

}

if (!function_exists('id_hasher')) {

	function id_hasher($id) {
		return md5(substr(md5($id), 20));
	}

}

if (!function_exists('is_json')) {

	function is_json($string, $return_data = false) {
		$data = json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
	}

}

if (!function_exists('get_date_range')) {

	function get_date_range($from, $to, $range = array()) {
		if (count($range) == 0) {
			$from = date('Y-m-d', strtotime($from));
			$to = date('Y-m-d', strtotime($to));
			$range[] = $from;
		}

		if ($from != $to) {
			$from = date('Y-m-d', strtotime($from . "+1 days"));
			$range[] = $from;
			return get_date_range($from, $to, $range);
		}
		return $range;
	}

}
if (!function_exists('get_days')) {

	function get_days($range) {
		$days = array();
		foreach ($range as $r) {
			$days[] = date('D', strtotime($r));
		}
		return $days;
	}

}

if (!function_exists('is_week_day')) {

	function is_week_day($date) {
		$day = date('D', strtotime($date));
		if ($day == "Sat" || $day == "Sun") {
			return false;
		}
		return true;
	}

}

if (!function_exists('get_last_availability_time_interval')) {

	function get_last_availability_time_interval($timestamp) {
		$start_date = new DateTime($timestamp);

		$date = date("Y-m-d H:i:s");
		$since_start = $start_date->diff(new DateTime($date));

		if ($since_start->y > 0) {
			$text = ($since_start->y == 1) ? ' year' : ' years';
			return $since_start->y . $text;
		} elseif ($since_start->m > 0) {
			$text = ($since_start->m == 1) ? ' month' : ' months';
			return $since_start->m . $text;
		} elseif ($since_start->d > 0) {
			$text = ($since_start->d == 1) ? ' day' : ' days';
			return $since_start->d . $text;
		} elseif ($since_start->h > 0) {
			$text = ($since_start->h == 1) ? ' hour' : ' hours';
			return $since_start->h . $text;
		} elseif ($since_start->i > 0) {
			$text = ($since_start->i == 1) ? ' minute' : ' minutes';
			return $since_start->i . $text;
		} else {
			$text = ($since_start->s == 1) ? ' second' : ' seconds';
			return $since_start->s . $text;
		}
	}

}


if (!function_exists('get_time_span_diffrence')) {

	function get_time_span_diffrence($from, $to) {
		$output_array = array("months" => 0, "weeks" => 0, "days" => 0, "hours" => 0);

		$diff = strtotime($to) - strtotime($from);

		$diff_in_months = (int) ($diff / 3600 / 24 / 30);

		if ($diff_in_months >= 1) {
			$output_array['months'] = $diff_in_months;
			$diff = $diff - (3600 * 24 * 30 * $diff_in_months);
		}

		$diff_in_weeks = (int) ($diff / 3600 / 24 / 7);

		if ($diff_in_weeks >= 1) {
			$output_array['weeks'] = $diff_in_weeks;
			$diff = $diff - (3600 * 24 * 7 * $diff_in_weeks);
		}

		$diff_in_days = (int) ($diff / 3600 / 24);

		if ($diff_in_days >= 1) {
			$output_array['days'] = $diff_in_days;
			$diff = $diff - (3600 * 24 * $diff_in_days);
		}

		$diff_in_hrs = (int) ($diff / 3600);

		if ($diff_in_hrs >= 1) {
			$output_array['hours'] = $diff_in_hrs;
		}
		return $output_array;
	}

}

if (!function_exists('response_time')) {

	function response_time($unix_timestamp) {

		$diff_in_days = (int) ($unix_timestamp / 3600 / 24);

		if ($diff_in_days >= 1) {
			return $diff_in_days . " day(s)";
		}

		$diff_in_hrs = (int) ($unix_timestamp / 3600);

		if ($diff_in_hrs >= 1) {
			return $diff_in_hrs . " hour(s)";
		}

		$diff_in_minute = (int) ($unix_timestamp / 60);

		if ($diff_in_minute >= 1) {
			return $diff_in_minute . " min(s)";
		}

		return round($unix_timestamp) . " sec(s)";
	}

}

/* for admin work use these function support with bootstrap */
/* admin panel specific function starts from here */
if (!function_exists('alert')) {

	function alert($task, $message) {
		if ($task == 'error') {
			$alert = '<div class="alert alert-danger msg"><i class="fa fa-exclamation-circle"></i> ' . $message . ' </div>';
		} elseif ($task == 'success') {
			$alert = '<div class="alert alert-success msg"><i class="fa fa-check-circle"></i> ' . $message . ' </div>';
		} elseif ($task == 'warning') {
			$alert = '<div class="alert alert-warning msg"><i class="fa fa-exclamation-triangle"></i> ' . $message . ' </div>';
		} else {
			$alert = '<div class="alert alert-info msg"><i class="fa fa-info"></i> ' . $message . ' </div>';
		}
		return $alert;
	}

}

/*
 * to genrate * html for web and admin panel
 */
if (!function_exists('genrate_star_html')) {

	function genrate_star_html($star, $class = "", $tag_type = 'i') {

		if ($star > 5) {
			$star = 5;
			for ($i = 0; $i < $star; $i++) {
				echo '<' . $tag_type . ' class="fa fa-star ' . $class . '"></' . $tag_type . '>';
			}
		} else {
			$r = explode('.', $star);
			$length = sizeof($r);
			$blank_star = 5 - $r[0];
			for ($j = 0; $j < $r[0]; $j++) {
				echo '<' . $tag_type . ' class="fa fa-star ' . $class . ' "></' . $tag_type . '>';
			}
			if ($length == 2) {
				$first_digit = substr($r[1], 0, 1);
				if (!empty($r[1])) {
					if ($first_digit >= 5) {
						echo '<' . $tag_type . ' class="fa fa-star-half-o ' . $class . ' "></' . $tag_type . '>';
						$blank_star = $blank_star - 1;
					}
				}
			}
			if ($blank_star != '') {
				for ($k = 0; $k < $blank_star; $k++) {
					echo '<' . $tag_type . ' class="fa fa-star-o ' . $class . ' "></' . $tag_type . '>';
				}
			}
		}
	}

}

/*
  !!!!!!!!!!!!!!!!!!! WARNING !!!!!!!!!!!!!!!!
  this function is used to get global functionality with curl
 */

if (!function_exists('get_data_with_curl')) {

	function get_data_with_curl($array) {

		$option = array(
			'is_json' => $array['is_json'],
			'url' => $array['url'],
			'data' => $array['data']
		);

		$ch = curl_init($option['url']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $option['data']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		if ($option['is_json'] == true) {
			return $result;
		} else {
			return json_decode($result, True);
		}
	}

}

/*
 * Get distance between two lat long
 * pass K for Killometer
 * pass M for Miles
 * pass N for Nautical Miles
 */

if (!function_exists('lat_long_distance')) {

	function lat_long_distance($lat1, $lon1, $lat2, $lon2, $unit = "M") {

		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}

}
