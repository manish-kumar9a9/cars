<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function isUserEmailExist($document) {
		$this->db->where('email', $document['email']);
		$result = $this->db->get('users')->row_array();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	function isUserPhoneExist($document) {
		$this->db->where('mobile', $document['mobile']);
		$result = $this->db->get('users')->row_array();
		if (!empty($result)) {
			return $result['userId'];
		} else {
			return false;
		}
	}

	function isUserSocialExist($document) {
		$loginType = $document['loginType'];
		if ($loginType == 1) {
			$this->db->where('fbId', $document['socialId']);
		} else if ($loginType == 2) {
			$this->db->where('gId', $document['socialId']);
		}
		$result = $this->db->get('users')->row_array();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	function userSignUp($document) {

		$this->db->insert('users', $document);
		$userId = $this->db->insert_id();

		$this->db->where('userId', $userId);
		$res = $this->db->get('users', $document)->row_array();

		if ($res) {
			return $res;
		} else {
			return false;
		}
	}

	function editUser($document) {
		$this->db->where('email', $document['email']);
		$query = $this->db->update('users', $document);

		$this->db->where('email', $document['email']);
		$query1 = $this->db->get('users')->row_array();
		if ($query1) {
			return $query1;
		} else {
			return false;
		}
	}

	function updateOTP($document) {
		$this->db->where('mobile', $document['mobile']);
		$query = $this->db->update('users', $document);

		$this->db->where('mobile', $document['mobile']);
		$query1 = $this->db->get('users')->row_array();
		if ($query1) {
			return $query1;
		} else {
			return false;
		}
	}

	function verifyOTP($document) {
		$this->db->where('email', $document['email']);
		$result = $this->db->get('users')->row_array();

		if (!empty($result)) {
			if ($result['otp'] == $document['otp']) {
				$document['isVerified'] = 1;
				$this->db->where('email', $document['email']);
				$query = $this->db->update('users', $document);
				return 1;
			} else {
				return 2;
			}
		} else {
			return 3;
		}
	}

	function isUserIdExist($document) {
		$this->db->where('userId', $document['userId']);
		$result = $this->db->get('users')->row_array();
		if (!empty($result)) {
			return $result['userId'];
		} else {
			return false;
		}
	}

	function editProfile($document) {
		$this->db->where('userId', $document['userId']);
		$query = $this->db->update('users', $document);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	function userProfile($document) {
		$sel = "IF (profileImage !='', concat('" . base_url('profileImages') . "/', profileImage),'') as user_image";
		$sel .= " , IF (verification_file !='', concat('" . base_url('profileImages') . "/', verification_file),'') as verification_file";
		$sel .= " , IF (verification_image !='', concat('" . base_url('profileImages') . "/', verification_image),'') as verification_image";
		$sel .= " , TRUNCATE( IFNULL( (SELECT avg( rating ) AS user_rating FROM urend_user_rating WHERE user_id = userId ) , 0.0) ,1 ) AS user_rating";
		$sel .= " , IFNULL( (SELECT count(id) FROM urend_car_booking_master WHERE  car_user_id = userId and pickup_confirmed = 1 ) , 0) AS user_total_cars_trips";
		$sel .= " , IFNULL( (SELECT count(id) FROM urend_car_booking_master WHERE  car_renter_id = userId and pickup_confirmed = 1 ) , 0) AS user_total_rent_trips";
		$sel .= " , IFNULL( (SELECT avg( owner_response_time ) AS owner_response_time FROM urend_car_booking_master WHERE car_user_id = userId and owner_response_time != '' ) , 0) AS response_time";
		$sel .= " , IFNULL( IFNULL((SELECT count(*) FROM urend_car_booking_master WHERE car_user_id = userId and (accepted_car_owner = 1 or rejected_by_car_owner = 1 ) and owner_response_time != '' ) , 0)
                             /
                             IFNULL((SELECT count(*) FROM urend_car_booking_master WHERE car_user_id = userId ) , 0)
                             * 100
                             ,0
                            ) as  response_rate ";
		$this->db->select("* , $sel");
		$this->db->where('userId', $document['userId']);
		$result = $this->db->get('users')->row_array();
		if (!empty($result)) {
			$this->db->select("*");
			$this->db->where('fk_user_id', $document['userId']);
			$result['user_settings'] = $this->db->get('users_settings')->result_array();
			return $result;
		} else {
			return false;
		}
	}

	function makeBase64Img($image) {
		$data = str_replace(" ", "+", $image);
		$data = base64_decode($data);
		$im = imagecreatefromstring($data);
		$fileName = rand(5, 115) . time() . ".png";
		$imageName = "profileImages/" . $fileName;
		if ($im !== false) {
			imagepng($im, $imageName);
			imagedestroy($im);
		} else {
			echo 'An error occurred.';
		}
		return $fileName;
	}

	/*
	 * update device token and device type while login
	 */

	public function isUserUpdatedeviceToken($document) {
		$this->db->where('userId', $document['userId']);
		$query = $this->db->update('users', $document);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/* quick settings starts from here */

	public function update_mobile_number($record) {

		$this->db->where('userId', $record['userId']);
		$data = array(
			"mobile" => $record['mobile'],
			"countryCode" => $record['countryCode']
		);

		$query = $this->db->update('users', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_frist_name($record) {

		$this->db->where('userId', $record['userId']);
		$data = array(
			"firstName" => $record['firstName']
		);

		$query = $this->db->update('users', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_last_name($record) {

		$this->db->where('userId', $record['userId']);
		$data = array(
			"lastName" => $record['lastName']
		);

		$query = $this->db->update('users', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_user_email($record) {

		$this->db->where('userId', $record['userId']);
		$data = array(
			"email" => $record['email']
		);

		$query = $this->db->update('users', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_user_password($record) {

		$this->db->where('userId', $record['userId']);
		$this->db->where('loginType', $record['loginType']);
		$data = array(
			"password" => $record['new_password']
		);

		$query = $this->db->update('users', $data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_transmission_state($record) {

		$this->db->where('userId', $record['userId']);
		$data = array(
			"transmission_state" => $record['transmission_state']
		);

		$query = $this->db->update('users', $data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_settings($record) {
		if ($record['chat_notification'] >= 0) {

			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'chat_notification');
			$data = array(
				"state" => $record['chat_notification'],
			);
			$query = $this->db->update('users_settings', $data);
		}

		if ($record['favourite_my_car'] >= 0) {
			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'favourite_my_car');
			$data = array(
				"state" => $record['favourite_my_car'],
			);
			$query = $this->db->update('users_settings', $data);
		}

		if ($record['remind_to_rate_trip'] >= 0) {
			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'remind_to_rate_trip');
			$data = array(
				"state" => $record['remind_to_rate_trip'],
			);
			$query = $this->db->update('users_settings', $data);
		}

		if ($record['promotions_announcements'] >= 0) {
			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'promotions_announcements');
			$data = array(
				"state" => $record['promotions_announcements'],
			);
			$query = $this->db->update('users_settings', $data);
		}
		if ($record['push_other'] >= 0) {
			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'push_other');
			$data = array(
				"state" => $record['push_other'],
			);
			$query = $this->db->update('users_settings', $data);
		}
		if ($record['email_other'] >= 0) {
			$this->db->where('fk_user_id', $record['fk_user_id']);
			$this->db->where('setting_type', 'email_other');
			$data = array(
				"state" => $record['email_other'],
			);
			$query = $this->db->update('users_settings', $data);
		}
		return true;
	}

	public function update_notification_settings($data) {

		$this->db->where('fk_user_id', $data['fk_user_id']);
		$this->db->where('setting_type', $data['setting_type']);
		$query = $this->db->update('users_settings', array('state' => $data['state']));
		return true;
	}

	public function upload_user_verification_information($record) {
		$record['submission_time'] = date('Y-m-d H:i:s');
		if (!$this->get_user_document_info($record['user_id'])) {
			if ($this->db->insert('user_license_data', $record)) {
				return true;
			}
		}
		return false;
	}

	public function get_user_document_info($user_id) {
		$sel = "IF (license_front !='', concat('" . base_url('uploads/user_verification_images') . "/', license_front),'') as license_front";
		$sel .= " , IF (license_back !='', concat('" . base_url('uploads/user_verification_images') . "/', license_back),'') as license_back";
		$sel .= " , IF (id_front !='', concat('" . base_url('uploads/user_verification_images') . "/', id_front),'') as id_front";
		$sel .= " , IF (id_back !='', concat('" . base_url('uploads/user_verification_images') . "/', id_back),'') as id_back";
		$this->db->select("* , $sel");
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('user_license_data')->row_array();
		return $result;
	}

	public function update_user_document_info($record) {
		$record['state'] = 0;
		$record['updated_time'] = date("Y-m-d H:i:s");
		$this->db->where('user_id', $record['user_id']);
		if ($this->db->update('user_license_data', $record)) {
			return true;
		}
		return false;
	}

	public function update_device_token($record) {

		$this->db->where('userId', $record['userId']);
		if ($this->db->update('users', $record)) {
			return true;
		}
		return false;
	}

	public function city_check($country_id, $city_string) {
		$this->db->where('fk_country', $country_id);
		$this->db->where('city_name', $city_string);
		$result = $this->db->get('urend_car_city_list')->row_array();
		if (count($result) > 0) {
			return $result['id'];
		} else {
			$insert = array(
				'city_name' => $city_string,
				'fk_country' => $country_id
			);
			$this->db->insert('urend_car_city_list', $insert);
			return $this->db->insert_id();
		}
	}

	/* save account_information */

	public function save_user_wallet_ini($data) {

		if ($this->db->insert("user_wallet_id", $data)) {
			return true;
		}
		return false;
	}

	/* add card to user to user */

	public function add_card_to_user($data) {
		$info = array(
			"card_id" => $data['card_id']
		);
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user_wallet_id', $info);
	}

	public function get_user_payment_account($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get("user_wallet_id")->row_array();
	}

	public function update_user_bank_account($data) {
		$info = array(
			"banking_account_id" => $data['banking_account_id']
		);
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('user_wallet_id', $info);
	}

	function user_block($id, $status) {
		$array = array('userStatus' => $status);
		$this->db->where('userId', $id);
		$query = $this->db->update('users', $array);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	function user_account_activeness_state($id, $status) {
		$array = array('activation' => $status);
		$this->db->where('userId', $id);
		$query = $this->db->update('users', $array);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	function user_logout($document) {
		$data_array = array('deviceType'=>'','deviceToken'=>'');
		$this->db->where('userId', $document['userId']);
		$query = $this->db->update('users', $document);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	function update_user_language($record){
		
		$this->db->where('userId', $record['userId']);
		if ($this->db->update('users', $record)) {
			return true;
		}
		return false;
		
	}
}
