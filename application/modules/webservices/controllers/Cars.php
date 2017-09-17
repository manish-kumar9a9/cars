<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_cars_model');
		$this->load->model('user_model');
		$this->load->model('UserModel');
		$this->load->model('user_notification_model');
		$this->load->model('user_cars_booking_model');
		$this->load->library('email');
	}

	public function get_car_data() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {

			$json = json_decode($json, true);
			$record = array();
			$record['table_name'] = $json['table_name'];
			$record['order_by'] = $json['order_by'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->fetch_cars_data($record);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function get_all_country_state_list() {

		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$user_id = $json['user_id'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->get_all_country_city_list($user_id);
			if (count($data) < 1) {
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * to get all text from db to show on car report page
	 */

	public function get_all_report_text() {
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		$isSuccess = true;
		$message = $this->lang->line('record_fetched');
		$data = $this->user_cars_model->get_all_report_text();
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * to get all text fron db to show on car delete page
	 */

	public function get_all_deletecar_text() {
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		$isSuccess = true;
		$message = $this->lang->line('record_fetched');
		$data = $this->user_cars_model->get_all_delete_text();
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function fetch_city() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {

			$json = json_decode($json, true);
			$record = array();
			$record['fk_country'] = $json['fk_country'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->fetch_city_list($record);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function fetch_car_make_year() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['make_id'] = $json['make_id'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->fetch_make_year_list($record);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function fetch_car_year_model() {

		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['make_id'] = $json['make_id'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->fetch_car_model_list($record);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function save_car_data() {

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		//print_r($_REQUEST);
		//print_r($_POST);
		log_message('info','RESULT');
		log_message('info',print_r($_REQUEST, true));
		//log_message('info',print_r($_POST, true));
		//log_message('info','-------------------------------------------');
		//log_message('info',print_r($this->input->post(), true));

		if ($_REQUEST) {

			$car_data['fk_user_id'] = $_REQUEST['fk_user_id'];
			$car_data['type'] = $_REQUEST['type'];
			$car_data['make'] = $_REQUEST['make'];
			$car_data['model'] = (isset($_REQUEST['model'])) ? $_REQUEST['model'] : '';
			$car_data['car_brought_year'] = (isset($_REQUEST['car_brought_year'])) ? $_REQUEST['car_brought_year'] : '';
			$car_data['mileage'] = $_REQUEST['mileage'];
			$car_data['cubicCapacity'] = $_REQUEST['cubicCapacity'];
			$car_data['fuelType'] = $_REQUEST['fuelType'];
			$car_data['Transmission'] = $_REQUEST['Transmission'];
			$car_data['color'] = $_REQUEST['color'];
			$car_data['doors'] = $_REQUEST['doors'];
			$car_data['airbags'] = $_REQUEST['airbags'];
			$car_data['seat'] = $_REQUEST['seat'];
			$car_data['description'] = $_REQUEST['description'];
			$availablity = (isset($_REQUEST['kmOrMiles'])) ? $_REQUEST['kmOrMiles'] : '';

			//if($availablity){
				$car_data['availablity'] = $this->car_availabilty_validator($availablity);
			//}

			$car_data['price_daily'] = $_REQUEST['price_daily'];
			$car_data['price_weekly'] = $this->input->post('price_weekly');
			$car_data['price_monthly'] = $this->input->post('price_monthly');

			$car_data['price'] = $_REQUEST['price'];
			$car_data['deliveryOption'] = $_REQUEST['deliveryOption'];
			if ($car_data['deliveryOption'] == 0 || $car_data['deliveryOption'] == "") {
				$car_data['price'] = 0;
			}
			$car_data['airbags'] = $_REQUEST['airbags'];
			//$car_data['kmOrMiles'] = $_REQUEST['kmOrMiles'];
			$car_data['kmOrMiles'] = (isset($_REQUEST['kmOrMiles'])) ? $_REQUEST['kmOrMiles'] : '';
			//$car_data['kmOrMilesValue'] = $_REQUEST['kmOrMilesValue'];
			$car_data['kmOrMilesValue'] = (isset($_REQUEST['kmOrMilesValue'])) ? $_REQUEST['kmOrMilesValue'] : '';
			//$car_data['youEarn'] = $_REQUEST['youEarn'];
			$car_data['youEarn'] = (isset($_REQUEST['youEarn'])) ? $_REQUEST['youEarn'] : '';
			$car_data['carExtraKmOrMl'] = $_REQUEST['carExtraKmOrMl'];
			// $car_data['country'] = $_REQUEST['country'];
			// $car_data['city'] = $_REQUEST['city'];
			$car_data['country'] = (isset($_REQUEST['country'])) ? $_REQUEST['country'] : '';
			$car_data['city'] = (isset($_REQUEST['city'])) ? $_REQUEST['city'] : '';

			// because i m getting string here so i will validate it with database
			if($car_data['city'] && $car_data['country']){
				$car_data['city'] = $this->validate_city_string($car_data['country'], $car_data['city']);
			}

			//$car_data['zipCode'] = strtoupper($_REQUEST['zipCode']);
			$zipcode = (isset($_REQUEST['zipCode'])) ? $_REQUEST['zipCode'] : '';
			$car_data['zipCode'] = strtoupper($zipcode);
			$car_data['carDropOffLocation'] = $_REQUEST['carDropOffLocation'];
			$car_data['carDropOffLat'] = $_REQUEST['carDropOffLat'];
			$car_data['carDropOffLon'] = $_REQUEST['carDropOffLon'];
			$car_data['carPickUpLocation'] = $_REQUEST['carPickUpLocation'];
			$car_data['carPickUpLat'] = $_REQUEST['carPickUpLat'];
			$car_data['carPickUpLon'] = $_REQUEST['carPickUpLon'];
			$car_data['carPlateNumber'] = strtoupper($_REQUEST['carPlateNumber']);
			//$car_data['insuranceType'] = $_REQUEST['insuranceType'];
			$car_data['insuranceType'] = (isset($_REQUEST['insuranceType'])) ? $_REQUEST['insuranceType'] : '';
			$car_data['insuranceValidTill'] = $_REQUEST['insuranceValidTill'];
			$uploaded_with = (isset($_REQUEST['uploaded_with'])) ? $_REQUEST['uploaded_with'] : '';

			/* validate input fields */
			$this->validate_car_data_before_insert($car_data);

			$car_data['createdDate'] = date("Y-m-d H:i:s");
			if ($_FILES && array_key_exists("insurance_file_front", $_FILES) && $_FILES['insurance_file_front']['name'] != "") {
				$car_data['insurance_file_front'] = $this->uploadfile('insurance_file_front', 'uploads');
			}
			
			if ($_FILES && array_key_exists("insurance_file_back", $_FILES) && $_FILES['insurance_file_back']['name'] != "") {
				$car_data['insurance_file_back'] = $this->uploadfile('insurance_file_back', 'uploads');
			}
			
			$car_id = $this->user_cars_model->save_car_data($car_data);
			// save car features
			if (array_key_exists('car_features', $_REQUEST)) {
				if (is_array($_REQUEST['car_features'])) {
					foreach ($_REQUEST['car_features'] as $cf) {
						$this->user_cars_model->save_car_feature($car_id, $cf);
					}
				} else {
					foreach (explode(",", $_REQUEST['car_features']) as $cf) {
						$this->user_cars_model->save_car_feature($car_id, $cf);
					}
				}
			}
			/* it will work for android if images are in key sequence car_image1 , car_image2 so on to 10 */
			/*
			  if ($_FILES && $uploaded_with != "mobile") {
			  for ($i = 1; $i <= 10; $i++) {
			  if (array_key_exists('car_image' . $i, $_FILES)) {

			  $car_name = $this->uploadfile('car_image' . $i, 'uploads');

			  $this->user_cars_model->save_car_images($car_id, $car_name);
			  }
			  }
			  } else */if ($uploaded_with == "mobile" || $uploaded_with == "WEBSITE") {
				for ($i = 1; $i <= 10; $i++) {
					if ($this->input->post('car_image' . $i) != "") {

						$source = $_SERVER['DOCUMENT_ROOT'] . '/uploads/temp_folder/' . $this->input->post('car_image' . $i);
						$desti = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $this->input->post('car_image' . $i);
						rename($source, $desti);
						$this->user_cars_model->save_car_images($car_id, $this->input->post('car_image' . $i));
					}
				}
			}


			$isSuccess = true;
			$message = $this->lang->line('insert_car_listed_successfully');
			$data = $this->user_cars_model->get_single_car_data($car_id);
		} else {

			$isSuccess = false;
			$message = $this->lang->line('invalid_input_data');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * car insert data validator START HERE
	 */

	private function validate_car_data_before_insert($data = array()) {


		if (empty($data['carPlateNumber'])) {
			echo json_encode(array("isSuccess" => false, "message" => "Car number plate is required.", "Result" => array()));
			die;
		}
		if ($data['carPlateNumber'] && $data['country'] == 1) {
			if (!preg_match('/^[A-Z]{3}[0-9]{3}$/', $data['carPlateNumber'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number is not valid for Cyprus.", "Result" => array()));
				die;
			}
		}

		if ($data['carPlateNumber'] && $data['country'] == 2) {
			if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $data['carPlateNumber'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number is not valid for Greece.", "Result" => array()));
				die;
			}
		}

		if ($data['carPlateNumber']) {
			if ($this->user_cars_model->check_car_number_plate_duplicate($data['carPlateNumber'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number already exist.", "Result" => array()));
				die;
			}
		}

	}

	/*
	 * car insert data validator End  HERE
	 */


	/*
	 * getting single car data
	 */

	public function get_single_car_data() {

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($_REQUEST) {
			$car_id = $this->input->post('id');
			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->get_single_car_data($car_id);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_input_data');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function get_user_car_list() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['fk_user_id'] = $json['fk_user_id'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->fetch_user_car_data($record);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function soft_delete_user_car() {

		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$reason_array = $record = array();
			$record['id'] = $json['id'];
			$record['fk_user_id'] = $json['fk_user_id'];

			$this->user_cars_model->delete_user_car($record);
			$reason_array['car_id'] = $json['id'];
			$reason_array['user_id'] = $json['fk_user_id'];
			$reason_array['reason_id'] = $json['reason_id'];
			$reason_array['other_text'] = $json['other_text'];

			$this->user_cars_model->insert_delete_reason($reason_array);
			$isSuccess = true;
			$message = $this->lang->line('user_car_record_deleted');
			$data = array();
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function soft_delete_user_car_image() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['id'] = $json['id'];

			$this->user_cars_model->delete_user_car_image($record);
			$isSuccess = true;
			$message = $this->lang->line('user_car_image_deleted');
			$data = array();
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function uploadfile($key, $folder_on_root) {
		$folder_on_root = $folder_on_root . "/";
		$files = $_FILES[$key];

		if ($files['error'] == 0) {

			$file_name = rand(1, 100) . time() . basename($_FILES[$key]["name"]);
			$target_file = $folder_on_root . $file_name;

			if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
				$imgs = array('url' => '/' . $folder_on_root, 'name' => $files['name']);
			}
		}
		return $file_name;
	}

	public function add_new_images_to_car() {


		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($_REQUEST) {
			$car_id = $_REQUEST['id'];

			if ($_FILES && array_key_exists("car_image", $_FILES) && count($_FILES['car_image']['name']) > 0) {
				for ($i = 0; $i < count($_FILES['car_image']['name']); $i++) {

					$folder_on_root = "uploads/";
					$files = $_FILES['car_image'];
					if ($files['error'][$i] == 0) {
						$file_name = rand(1, 10) . time() . basename($files["name"][$i]);
						$target_file = $folder_on_root . $file_name;

						if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
							//$imgs = array('url' => '/' . $folder_on_root, 'name' => $files['name']);
						}
						$this->user_cars_model->save_car_images($car_id, $file_name);
					}
				}
			}

			$isSuccess = true;
			$message = $this->lang->line('data_saved_successfully');
			$data = $this->user_cars_model->get_car_images($car_id);
		} else {

			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function edit_car_data() {

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($_REQUEST) {
			$car_data['id'] = $_REQUEST['id'];
			$car_data['fk_user_id'] = $_REQUEST['fk_user_id'];
			$car_data['type'] = $_REQUEST['type'];
			$car_data['make'] = $_REQUEST['make'];
			$car_data['model'] = $_REQUEST['model'];
			$car_data['car_brought_year'] = (isset($_REQUEST['car_brought_year'])) ? $_REQUEST['car_brought_year'] : '';
			$car_data['mileage'] = $_REQUEST['mileage'];
			$car_data['cubicCapacity'] = $_REQUEST['cubicCapacity'];
			$car_data['fuelType'] = $_REQUEST['fuelType'];
			$car_data['Transmission'] = $_REQUEST['Transmission'];
			$car_data['color'] = $_REQUEST['color'];
			$car_data['doors'] = $_REQUEST['doors'];
			$car_data['airbags'] = $_REQUEST['airbags'];
			$car_data['seat'] = $_REQUEST['seat'];
			$car_data['description'] = $_REQUEST['description'];
			$car_data['availablity'] = $this->car_availabilty_validator($_REQUEST['availablity']);

			$car_data['price_daily'] = $_REQUEST['price_daily'];
			$car_data['price_weekly'] = $this->input->post('price_weekly');
			$car_data['price_monthly'] = $this->input->post('price_monthly');

			$car_data['price'] = $_REQUEST['price'];
			$car_data['deliveryOption'] = $_REQUEST['deliveryOption'];
			if ($car_data['deliveryOption'] == 0 || $car_data['deliveryOption'] == "") {
				$car_data['price'] = 0;
			}
			$car_data['airbags'] = $_REQUEST['airbags'];
			//$car_data['kmOrMiles'] = $_REQUEST['kmOrMiles'];
			$car_data['kmOrMiles'] = (isset($_REQUEST['kmOrMiles'])) ? $_REQUEST['kmOrMiles'] : '';
			//$car_data['kmOrMilesValue'] = $_REQUEST['kmOrMilesValue'];
			$car_data['kmOrMilesValue'] = (isset($_REQUEST['kmOrMilesValue'])) ? $_REQUEST['kmOrMilesValue'] : '';
			$car_data['youEarn'] = $_REQUEST['youEarn'];
			$car_data['carExtraKmOrMl'] = $_REQUEST['carExtraKmOrMl'];
			// $car_data['country'] = $_REQUEST['country'];
			// $car_data['city'] = $_REQUEST['city'];
			$car_data['country'] = (isset($_REQUEST['country'])) ? $_REQUEST['country'] : '';
			$car_data['city'] = (isset($_REQUEST['city'])) ? $_REQUEST['city'] : '';

			// because i m getting string here so i will validate it with database
			if($car_data['city'] && $car_data['country']){
				$car_data['city'] = $this->validate_city_string($car_data['country'], $car_data['city']);
			}

			$car_data['zipCode'] = strtoupper($_REQUEST['zipCode']);
			$car_data['carDropOffLocation'] = $_REQUEST['carDropOffLocation'];
			$car_data['carDropOffLat'] = $_REQUEST['carDropOffLat'];
			$car_data['carDropOffLon'] = $_REQUEST['carDropOffLon'];
			$car_data['carPickUpLocation'] = $_REQUEST['carPickUpLocation'];
			$car_data['carPickUpLat'] = $_REQUEST['carPickUpLat'];
			$car_data['carPickUpLon'] = $_REQUEST['carPickUpLon'];
			$car_data['modifiedDate'] = date("Y-m-d H:i:s");
			$car_data['insuranceType'] = $_REQUEST['insuranceType'];
			$car_data['insuranceValidTill'] = $_REQUEST['insuranceValidTill'];
			$car_data['carPlateNumber'] = strtoupper($_REQUEST['carPlateNumber']);
			$uploaded_with = (isset($_REQUEST['uploaded_with'])) ? $_REQUEST['uploaded_with'] : '';

			/* validate input fields */
			$this->validate_car_data_before_update($car_data);

			if ($_FILES && array_key_exists("insurance_file_front", $_FILES) && $_FILES['insurance_file_front']['name'] != "") {
				$car_data['insurance_file_front'] = $this->uploadfile('insurance_file_front', 'uploads');
			}
			
			if ($_FILES && array_key_exists("insurance_file_back", $_FILES) && $_FILES['insurance_file_back']['name'] != "") {
				$car_data['insurance_file_back'] = $this->uploadfile('insurance_file_back', 'uploads');
			}

			/* use updation */
			$car_id = $this->user_cars_model->update_basic_car_data($car_data);

			if ($_FILES) {
				for ($i = 1; $i <= 10; $i++) {
					if (array_key_exists('car_image' . $i, $_FILES)) {
						$car_name = $this->uploadfile('car_image' . $i, 'uploads');
						$this->user_cars_model->save_car_images($car_data['id'], $car_name);
					}
				}
			}

			/* delete old car feature */
			$this->db->where('fkCardId', $car_data['id']);
			$this->db->delete('urend_car_features');

			// save car features
			if (array_key_exists('car_features', $_REQUEST)) {
				if (is_array($_REQUEST['car_features'])) {
					foreach ($_REQUEST['car_features'] as $cf) {
						$this->user_cars_model->save_car_feature($car_data['id'], $cf);
					}
				} else {
					foreach (explode(",", $_REQUEST['car_features']) as $cf) {
						$this->user_cars_model->save_car_feature($car_data['id'], $cf);
					}
				}
			}

			/* it will only work for website as all images are in car_image[] //array */
			/* if ($_FILES && array_key_exists("car_image", $_FILES) && count($_FILES['car_image']['name']) > 0) {
			  for ($i = 0; $i < count($_FILES['car_image']['name']); $i++) {

			  $folder_on_root = "uploads/";
			  $files = $_FILES['car_image'];
			  if ($files['error'][$i] == 0) {
			  $file_name = rand(1, 10) . time() . basename($files["name"][$i]);
			  $target_file = $folder_on_root . $file_name;

			  if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
			  $this->user_cars_model->save_car_images($car_data['id'], $file_name);
			  }
			  }
			  }
			  }
			 */

			if ($uploaded_with == "mobile" || $uploaded_with == "WEBSITE") {
				for ($i = 1; $i <= 10; $i++) {
					if ($this->input->post('car_image' . $i) != "") {

						$source = $_SERVER['DOCUMENT_ROOT'] . '/uploads/temp_folder/' . $this->input->post('car_image' . $i);
						$desti = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $this->input->post('car_image' . $i);
						rename($source, $desti);
						$this->user_cars_model->save_car_images($car_data['id'], $this->input->post('car_image' . $i));
					}
				}
			}

			/* get images array to delete */
			if (array_key_exists("delete_car_images", $_REQUEST)) {
				foreach (explode(",", $_REQUEST['delete_car_images']) as $dci) {
					$this->db->where('id', $dci);
					$this->db->delete('urend_car_images');
				}
			}

			$isSuccess = true;
			$message = $this->lang->line('data_saved_successfully');
			$data = $this->user_cars_model->get_single_car_data($car_data['id']);
			$data['car_features'] = $this->user_cars_model->get_car_feature($car_data['id']);
			$data['car_images'] = $this->user_cars_model->get_car_images($car_data['id']);
		} else {

			$isSuccess = false;
			$message = $this->lang->line('invalid_input_data');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * car update data validator
	 */

	private function validate_car_data_before_update($data = array()) {

		if (empty($data['carPlateNumber'])) {
			echo json_encode(array("isSuccess" => false, "message" => "Car number plate is required.", "Result" => array()));
			die;
		}
		if ($data['carPlateNumber'] && $data['country'] == 1) {
			if (!preg_match('/^[A-Z]{3}[0-9]{3}$/', $data['carPlateNumber'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number is not valid for Cyprus.", "Result" => array()));
				die;
			}
		}

		if ($data['carPlateNumber'] && $data['country'] == 2) {
			if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $data['carPlateNumber'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number is not valid for Greece.", "Result" => array()));
				die;
			}
		}
		if ($data['carPlateNumber']) {

			if ($this->user_cars_model->check_car_number_plate_duplicate($data['carPlateNumber'], $data['id'])) {
				echo json_encode(array("isSuccess" => false, "message" => "Car with this plate number already exist.", "Result" => array()));
				die;
			}
		}
	}

	public function car_availabilty_validator($availablity) {
		$result = "";
		if ($availablity != 1 && $availablity != 2 && $availablity != 3 && $availablity != "") {
			foreach (explode(",", $availablity) as $ab) {
				if ($date = date_create($ab)) {
					$date = date_format($date, "Y-m-d");
					$result = $result . $date . ',';
				}
			}
			$result = array_unique(explode(',', $result));
			sort($result);
			//print_r($result);die;
			$result = implode(',', $result);
		} else {
			$result = $availablity;
		}
		return $result;
	}

	/*
	 *  search car with filters
	 */

	public function search_car_with_filter() {
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if ($_REQUEST) {

			$car_data["from_time"] = $this->input->post('from_time');
			$car_data["to_time"] = $this->input->post('to_time');

			$car_data["min_daily_price"] = $this->input->post('min_daily_price');
			$car_data["max_daily_price"] = $this->input->post('max_daily_price');
			$car_data['daily_price_order'] = $this->input->post('daily_price_order');

			$car_data["min_kmOrMilesValue"] = $this->input->post('min_kmOrMilesValue');
			$car_data["max_kmOrMilesValue"] = $this->input->post('max_kmOrMilesValue');

			$car_data["deliveryOption"] = $this->input->post('deliveryOption');
			$car_data["min_delivery_price"] = $this->input->post('min_delivery_price');
			$car_data["max_delivery_price"] = $this->input->post('max_delivery_price');

			$car_data['min_car_brought_year'] = $this->input->post('min_car_brought_year');
			$car_data['max_car_brought_year'] = $this->input->post('max_car_brought_year');


			$car_data['type'] = $this->input->post('type');
			$car_data['make'] = $this->input->post('make');
			$car_data['model'] = $this->input->post('model');
			$car_data['country'] = $this->input->post('country');
			$car_data['city'] = $this->input->post('city');
			$car_data['Transmission'] = $this->input->post('Transmission');

			/* if user send country string and city string */
			$car_data['country_string'] = $this->input->post('country_string');
			$car_data['city_string'] = $this->input->post('city_string');

			$car_data['user_id'] = $this->input->post('user_id');

			$car_data['find_lat'] = $this->input->post('find_lat');
			$car_data['find_lon'] = $this->input->post('find_lon');

			/* use search function here */
			$cars = $this->user_cars_model->filter_car_data($car_data);
			if (count($cars) > 0) {
				$isSuccess = true;
				$message = $this->lang->line('data_saved_successfully');
				$data = $cars;
				$total = count($cars);
			} else {
				$total = 0;
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$total = 0;
			$isSuccess = false;
			$message = $this->lang->line('invalid_input_data');
			$data = array();
		}
		echo json_encode(array("total_result" => $total, "isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * * function to book a car by user
	 */

	public function book_car() {

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();

			$record['car_id'] = $json['car_id'];
			$record['car_renter_id'] = $json['car_renter_id'];
			$record['car_from'] = $json['car_from'];
			$record['car_to'] = $json['car_to'];


			/* at the time of booking recheck its availability */

			$option = array(
				'is_json' => false,
				'url' => site_url() . '/service_get_car_availability',
				'data' => json_encode(array('car_id' => $record['car_id'], 'car_from' => $record['car_from'], "car_to" => $record['car_to']))
			);

			$get_car_availability = get_data_with_curl($option);
			$car_price_for_time = "0";
			if ($get_car_availability['isSuccess']) {
				$car_price_for_time = $get_car_availability['Result']['price_for_time'];
			} else {
				echo json_encode(
					array(
						"isSuccess" => false,
						"message" => $this->lang->line('book_car_is_no_longer_available'),
						"Result" => array()
					)
				);
				die;
			}

			/* check if user have valid card information */
			$account_details = $this->user_model->get_user_payment_account($record['car_renter_id']);

			/* view existing card */
			if (count($account_details) == 0 || $account_details['card_id'] == "") {

				echo json_encode(
					array(
						"isSuccess" => false,
						"message" => $this->lang->line('provide_your_car_information'),
						"Result" => array()
					)
				);
				die;
			}

			/*
			 * renter cant rent a car if carfrom time and current time have time span less than one hour 
			 */

			$from_time_check = get_time_span_diffrence(date("Y-m-d H:i:s"), $record['car_from']);

			if ($from_time_check['hours'] < 1) {
				echo json_encode(array("isSuccess" => false, "message" => "Not able to accept your request. Car 'from time' should have 60 minutes time gap to the current time. ", "Result" => array()));
				die;
			}

			/*
			 * check here if renter sent request to this car before 1 hour
			 * if time is more than 1 hour only than he can proceed
			 */

			$last_booking_to_this_car = $this->user_cars_booking_model->get_last_booking_user_data_with_car($record);

			if (count($last_booking_to_this_car) > 0) {
				$span = get_time_span_diffrence($last_booking_to_this_car['creation_time'], date("Y-m-d H:i:s"));
				$msg = $this->lang->line('book_same_car_with_in_hour');

				if ($span['hours'] <= 0 && $span['days'] == 0 && $span['weeks'] == 0 && $span['months'] == 0) {
					echo json_encode(array("isSuccess" => false, "message" => $msg, "Result" => array()));
					die;
				}
			}


			$record['car_renter_text'] = $json['car_renter_text'];

			/* get car data */

			$car_data = $this->user_cars_model->get_single_car_data($record['car_id']);

			$record['car_user_id'] = $car_data['fk_user_id'];
			$record['car_daily_price'] = $car_data['price_daily'];
			$record['car_distance_per_day'] = $car_data['kmOrMilesValue'];
			$record['for_extra_distance'] = $car_data['carExtraKmOrMl'];
			$record['discount_weekly'] = $car_data['price_weekly'];
			$record['discount_monthly'] = $car_data['price_monthly'];

			/* add location data */

			$record['pickup_location'] = $json['pickup_location'];
			$record['pickup_location_lat'] = $json['pickup_location_lat'];
			$record['pickup_location_lon'] = $json['pickup_location_lon'];
			$record['drop_off_location'] = $json['drop_off_location'];
			$record['drop_off_location_lat'] = $json['drop_off_location_lat'];
			$record['drop_off_location_lon'] = $json['drop_off_location_lon'];
			$record['delivery_option'] = $json['delivery_option'];
			$record['delivery_price'] = 0;
			if ($record['delivery_option'] == 1) {
				$record['delivery_price'] = $car_data['price'];
			}


			$record['price_for_time'] = $car_price_for_time;
			$record['security_amount'] = get_web_meta_data('security_deposit');

			$booking_primary_id = $this->user_cars_model->book_car($record);
			
			/* change language for push notification */
			$pusher_data = $this->user_model->userProfile(array('userId' => $car_data['fk_user_id']));
			$this->lang->load('master', $pusher_data['language']);
				
			$push_data = json_encode(
				array(
					'notification_code' => 10006,
					'message' => $this->lang->line('booking_request_for_car_number') . $car_data['carPlateNumber'],
					'data' => array()
				)
			);

			$this->send_push_to_user($car_data['fk_user_id'], $push_data);
			$this->lang->load('master', $this->language);
			
			$notify = array(
				"user_id" => $car_data['fk_user_id'],
				"text" => $this->lang->line('booking_request_for_car_number') . $car_data['carPlateNumber']
			);

			$this->user_notification_model->add_notification_to_user($notify);

			/* send email to owner */
			$this->send_owner_email($booking_primary_id);

			$isSuccess = true;
			$message = $this->lang->line('booking_request_sent_successfully');
			$data = array();
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function send_owner_email($booking_primary_id) {

		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_fetch_single_request_data',
			'data' => array('id' => $booking_primary_id)
		);
		$result = get_data_with_curl($option);
		$booking_data = $result['Result'];

		$view['owner_data'] = $booking_data['car_owner_data'];
		$view['renter_data'] = $booking_data['car_renter_data'];
		$view['car_details'] = $booking_data['car_details'];

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($booking_data['car_owner_data']['email']);
		$this->email->subject('New car rental request');
		$this->email->message($this->load->view('email_templates/owner_new_request', $view, True));
		$this->email->set_mailtype("html");
		$this->email->send();
	}

	public function get_car_availability() {
		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['car_id'] = $json['car_id'];
			$record['car_from'] = $json['car_from'];
			$record['car_to'] = $json['car_to'];
			/* get car data */
			$car_data = $this->user_cars_model->get_single_car_data($record['car_id']);
			$date_range = get_date_range($record['car_from'], $record['car_to']);

			$isSuccess = False;
			$message = $this->lang->line('this_car_is_not_available');
			$data = array();

			/* we will check if this car is available for booking to perticuler date or not */
			if ($this->user_cars_model->check_car_booking_time_intersection($record) > 0) {

				echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
				die; /* terminate and exit */
			}


			/* check in booking table  if car is in active  booking  state
			  if($this->user_cars_model->get_car_booking_state($record) == false){
			  echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			  die;

			  } */

			if (count($date_range) > 0 && count($car_data) > 0) {
				$checker = 0;
				if ($car_data['availablity'] == 2) {
					/* if car is only rented for 2 days saturday sunday */
					if (count($date_range) <= 2) {
						$checker = 1;
						foreach ($date_range as $d) {
							if (is_week_day($d)) {
								$checker = 0;
							}
						}
					}
				} elseif ($car_data['availablity'] == 3) {
					/* if car is only rented for five days mon to friday */
					if (count($date_range) <= 5) {
						$checker = 1;
						foreach ($date_range as $d) {
							if (!is_week_day($d)) {
								$checker = 0;
							}
						}
					}
				} elseif ($car_data['availablity'] == 1) {
					/* if car is only rented for five days mon to friday */
					$checker = 1;
				} else {
					$checker = 1;
					$car_date_indb = explode(',', $car_data['availablity']);
					foreach ($date_range as $dr) {

						if (!in_array($dr, $car_date_indb)) {
							$checker = 0;
						}
					}
				}
				/* check if the car is not active mode of booking */

				if ($checker == 1) {
					$isSuccess = true;
					$message = $this->lang->line('this_car_is_available');
					$price = "";
					$days = count($date_range);
					/* check  m w d h */

					$time_span = get_time_span_diffrence($record['car_from'], $record['car_to']);

					if ($time_span['months'] > 0) {
						$price += $car_data['price_monthly'] * $time_span['months'];
					}

					if ($time_span['weeks'] > 0) {
						$price += $car_data['price_weekly'] * $time_span['weeks'];
					}

					if ($time_span['days'] > 0) {
						$price += $car_data['price_daily'] * $time_span['days'];
					}

					if ($time_span['hours'] > 0) {
						$price += $car_data['price_daily'];
					}

					/*
					  if($days >= 30){

					  $price += $car_data['price_monthly'] * intval($days/30);
					  $days = $days%30;
					  }

					  if($days >=7){

					  $price +=  $car_data['price_weekly'] * intval($days/7);
					  $days = $days%7;
					  }

					  if($days < 7){

					  $price +=  $car_data['price_daily'] * $days;
					  }
					 */

					$data = array(
						'total_price' => $price,
						'kmOrMilesValue' => $car_data['kmOrMilesValue'],
						'kmOrMiles' => $car_data['kmOrMiles'],
						'carExtraKmOrMl' => $car_data['carExtraKmOrMl'],
						'deliveryOption' => $car_data['deliveryOption'],
						'deliveryprice' => $car_data['price'],
						'meeting_location' => $car_data['carPickUpLocation'],
						'security_deposit' => get_web_meta_data('security_deposit')
					);

					$data['price_for_time'] = $price;

					if ($car_data['deliveryOption'] == 1) {
						$data['total_price'] = $data['total_price'] + $car_data['price'];
					}
				}
			}
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function get_car_unavail_day() {
		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['car_id'] = $json['car_id'];
			$record['car_from'] = date("Y-m-01 00:00:00");
			$record['car_to'] = date("Y-m-d 00:00:00", strtotime('+5 months'));
			$message = $this->lang->line('request_executed');
			$isSuccess = true;
			$dates = $this->user_cars_model->get_booking_dates($record);
			$data = array();
			if (count($dates) > 0) {
				$data = array();

				foreach ($dates as $dd) {
					$new = get_date_range($dd['car_from'], $dd['car_to']);
					foreach ($new as $val) {
						$data[] = $val;
					}
				}
			}
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this function is used to add a car to user favourite list we are getting user_id , car_id and status from the request
	 */

	public function manage_car_favourite_list() {

		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$car_id = $json['car_id'];
			$user_id = $json['user_id'];
			$status = $json['status'];

			$this->user_cars_model->make_user_favorite_car($user_id, $car_id, $status);

			$isSuccess = true;
			$car_data = $this->user_cars_model->get_single_car_data($car_id);
			$fav_user_data = $this->user_model->userProfile(array('userId' => $user_id));
			
			if ($status == 1) {
				$message = $this->lang->line('car_added_to_favourite');
				
				//push to renter 
				/* change language for push notification */
				$pusher_data = $this->user_model->userProfile(array('userId' => $car_data['fk_user_id']));
				$this->lang->load('master', $pusher_data['language']);
				$msg = sprintf($this->lang->line('car_added_to_fav'),$fav_user_data['firstName']." ".$fav_user_data['lastName']);//;
				
				$push_data = json_encode(
					array(
						'notification_code' => 550001,
						'message' => $msg,
						'data' => array('car_id' => $car_id)
					)
				);
				
				$this->send_push_to_user($car_data['fk_user_id'], $push_data);
				$this->lang->load('master', "$this->language");
				$this->send_fav_email_to_owner($fav_user_data,$car_data);
			} else {
				
				$message = $this->lang->line('car_removed_form_favourite');
			}

			$data = array();
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	// send email to owner 
	public function send_fav_email_to_owner($fav_user_data,$car_data){
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'urend.com',
			'smtp_port' => 25,
			'smtp_user' => 'booking@urend.com',
			'smtp_pass' => 'Urend2016$',
		);
                  $data['fav_user_data'] = $fav_user_data;
		$data['car_data'] = $car_data;		  
		$data['user_data'] = $this->user_model->userProfile(array('userId' => $car_data['fk_user_id']));
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], 'UREND');
		$this->email->to($data['user_data']['email']);
		$this->email->subject('Car Added To Favourite');
		$this->email->message($this->load->view('email_templates/owner_car_added_to_fav', $data, True));
		$this->email->set_mailtype("html");
		$this->email->send();
	}
	
	
	/*
	 *  FAVOURITE LIST -: this function is used to get all car list with full details of user car list
	 */

	public function user_favourite_car() {

		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['user_id'] = $json['user_id'];

			$isSuccess = true;
			$message = $this->lang->line('record_fetched');
			$data = $this->user_cars_model->get_user_favourite_car($record['user_id']);
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function active_user_car_relation() {

		$json = file_get_contents('php://input');

		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['user_id'] = $json['user_id'];
			$record['car_id'] = $json['car_id'];

			$data = $this->user_cars_model->get_single_car_data($record['car_id']);
			if (count($data) > 0) {
				$data['is_user_favourite'] = 0;
				$user_fav_data = $this->user_cars_model->get_user_favourite_car($record['user_id']);
				foreach ($user_fav_data as $ufd) {
					if ($ufd['id'] == $record['car_id']) {
						$data['is_user_favourite'] = 1;
					}
				}
				$data['car_owner_data'] = $this->user_model->userProfile(array('userId' => $data['fk_user_id']));
				$isSuccess = true;
				$message = $this->lang->line('record_fetched');
				$data = $data;
			} else {
				$isSuccess = false;
				$message = $this->lang->line('no_record_found');
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function save_car_report() {
		$json = file_get_contents('php://input');
		/* language changer */
		$this->language = ($this->input->get('language') == "") ? "english" : $this->input->get('language');
		$this->lang->load('master', "$this->language");

		if (is_json($json)) {
			$json = json_decode($json, true);
			$record = array();
			$record['user_id'] = $json['user_id'];
			$record['car_id'] = $json['car_id'];
			$record['reason_id'] = $json['reason_id'];
			$record['other_text'] = $json['other_text'];

			$this->user_cars_model->save_car_report($record);
			$isSuccess = true;
			$message = $this->lang->line('car_reported_successfully');
			$data = array();
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * this send_push_to_user function is used to send  push notification to ios and android
	 */

	public function send_push_to_user($user_id = "", $data = array()) {

		/* get user id and make condition here */
		$user_data = $this->user_model->userProfile(array('userId' => $user_id));
		$token = $device = "";

		if ($user_data['deviceType'] == 1) {
			$token = $user_data['deviceToken'];
			$device = "ios";
			generatePush($device, $token, $data);
		}
		if ($user_data['deviceType'] == 0) {
			$token = $user_data['deviceToken'];
			$device = "android";
			generatePush($device, $token, $data);
		}
	}

	private function validate_city_string($country_id, $city_string) {
		/* check in database if city available for this city
		 * if not avaialble than save and return city_id
		 * if available than return id
		 */
		$id = $this->user_model->city_check($country_id, $city_string);
		return $id;
	}

	/*
	 *  get key values for all input boxes in add car form 
	 */

	public function car_input_parameters() {
		$data = array();
		$data['commission_rate'] = get_web_meta_data('commission_rate');
		$data['car_element_mileage'] = get_web_meta_data('car_element_mileage');
		$data['car_element_cubic_capacity'] = get_web_meta_data('car_element_cubic_capacity');
		$data['car_element_doors'] = get_web_meta_data('car_element_doors');
		$data['car_element_airbags'] = get_web_meta_data('car_element_airbags');
		$data['car_element_seats'] = get_web_meta_data('car_element_seats');
		$data['car_element_feature_types'] = $this->UserModel->get_all_feature_types();
		
		$years =  get_web_meta_data('car_element_year');
		$years_temp = array();
		for($i=date('Y');$i>(date('Y')-$years);$i--){
			$years_temp[] =  intval($i);
		}
		$data['car_element_year'] = $years_temp;
		echo json_encode(array("isSuccess" => true, "message" => "Data Fetched", "Result" => $data));
		die;
	}

	/* testing area */
}
