<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->model('UserModel');
		$this->load->model('User_model');
		$this->load->model('CarModel');
		$this->load->library('form_validation', 'uploads');
				/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function pass_login() {
		$this->session->sess_destroy();

		$this->load->helper(array('cookie', 'url'));
		$return_url = $this->input->get('url');

		if ($return_url != "") {
			set_cookie('redirect_url', $return_url, '3600');
		}
		redirect(base_url() . "?auth=login");
	}

	public function pass_logger() {
		$return_url = get_cookie('redirect_url');
		if ($return_url != "") {
			redirect(urldecode($return_url));
		} else {
			redirect('user/car_list');
		}
	}

	public function secure_redirector() {

		$return_url = $this->input->get('url');
		$identifier = $this->input->get('redirect_identifier');
		$redirect_url = $this->input->get('redirect_url');
		if ($redirect_url != "" && $identifier != "") {

			$this->session->set_userdata('redirect_url', $redirect_url);
			$this->session->set_userdata('redirect_identifier', $identifier);
			redirect($return_url);
		} else {
			redirect($return_url);
		}
	}

	function signIn() {
		$data = $_POST;
		$res = $this->UserModel->signIn($data);
		if ($res) {
			if ($res['password'] == md5($data['password'])) {
				$this->session->set_userdata($res);
				redirect('user/car_list');
			} else {
				redirect("");
			}
		}
	}

	function forgot_password() {
		if ($_POST['email'] == "") {
			$isSuccess = false;
			$message = "Please enter your email.";
			$data = array();
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}
		$res = $this->UserModel->signIn($_POST);
		
		if ($res && $res['loginType'] == 0 ) {
			$newps = rand(111111111,999999999);
			$this->db->where('email',$res['email']);
			$this->db->update('users',array('password'=>md5($newps)));
			$to = $res['email'];
			$msg = "Your password is " .$newps;
			$sub = "Your Password from UREND";
			$headers = 'From: UREND <no-reply@urend.com>' . "\r\n";

			@$sentmail = mail($to, $sub, $msg, $headers);
			if (!empty($sentmail)) {
				$isSuccess = true;
				$message = "Password Sent Successfully";
				$data = array();
			} else {
				$isSuccess = false;
				$message = "Password Not Sent";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Wrong email entered";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function login_receiver() {

		if ($_POST['email'] == "" || $_POST['password'] == "") {
			$isSuccess = false;
			$message = "Invalid email or password. Please try again.";
			$data = array();
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}

		$res = $this->UserModel->signIn($_POST);

		if ($res) {
			if ($res['password'] == md5($_POST['password'])) {
				/*
				 * check if user is vaerified or not
				 */
				if ($res['isVerified'] == 0) {
					$isSuccess = false;
					$message = "Account is not verified.";
					$data = array('email' => $_POST['email']);
				} else {

					$isSuccess = true;
					$message = "Login successful.";
					$data = array();
				}
			} else {
				$isSuccess = false;
				$message = "Wrong password entered.";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invalid email or password. Please try again.";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	function send_mobile_otp($mobile_number, $otp) {
		require APPPATH . 'third_party/twilio-php/Services/Twilio.php';
		$account_sid = 'ACe5d1b236cd5e99647ec620d895f3d0fb';
		$auth_token = '48bf6a49e204b66aaf79077654a96d38';
		$client = new Services_Twilio($account_sid, $auth_token);

		$message = array();
		try {
			$message = $client->account->messages->create(array(
				'To' => $mobile_number,
				'From' => "+18553380179",
				'Body' => "Thanks for using Urend! your OTP is $otp",
			));
		} catch (Services_Twilio_RestException $e) {
			return false;
		}

		if (count($message) > 0 && $message->sid != '') {
			return true;
		} else {
			return false;
		}
	}

	public function signup_receiver() {

		$isSuccess = false;
		$message = "Please fill all the fields.";
		$data = array();

		if ($_POST['email'] == "" || $_POST['firstName'] == "" || $_POST['lastName'] == "" || $_POST['mobile'] == "" || $_POST['dob'] == "") {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}

		if (mb_strlen($_POST['firstName'],'UTF-8') > 20 || mb_strlen($_POST['firstName'],'UTF-8') < 2 || str_replace(' ', '', $_POST['firstName']) =="") {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => 'Firstname should have 2-20 characters.', "Result" => $data));
			die;
		}

		if (mb_strlen($_POST['lastName'],'UTF-8') > 20 || mb_strlen($_POST['lastName'],'UTF-8') < 2 || str_replace(' ', '', $_POST['lastName']) =="" ) {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => 'Lastname should have 2-20 characters.', "Result" => $data));
			die;
		}

		if ($_POST['loginType'] == "" and ($_POST['password'] == "" ||  strlen($_POST['password']) > 16 || strlen($_POST['password']) < 8 )) {
			$_POST['password'] = md5($_POST['password']);
			$pass = "Password length should be 8-16 character.";
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $pass , "Result" => $data));
			die;
		}

		if (!is_numeric($_POST['mobile']) || strlen($_POST['mobile']) > 15 || strlen($_POST['mobile']) < 6) {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => 'Please enter valid mobile number.', "Result" => $data));
			die;
		}
		$_POST['dob'] =  str_replace("/","-",$_POST['dob']);

		$bday = new DateTime($_POST['dob']);
		$today = new DateTime(); 
		$diff = $today->diff($bday);
		if ($diff->y < 18) {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => 'Your age  should be above 18.', "Result" => $data));
			die;
		}

		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) != true) {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => 'Please enter a valid email.', "Result" => $data));
			die;
		}

		if ($_POST['terms_condition'] == "") {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => ' Please accept terms of service of Urend.', "Result" => $data));
			die;
		}
		/*
		 * we are passsing the post data to db and terms_and condition is not thr so we will unset it after validate
		 */
		unset($_POST['terms_condition']);

		$exist = $this->UserModel->isUserEmailExist($_POST);

		if (empty($exist)) {
			$_POST['otp'] = rand(1000, 9999);
			if ($this->send_mobile_otp($_POST['countryCode'] . $_POST['mobile'], $_POST['otp'])) {
				if ($_POST['profileImage'] != "") {
					$url = $_POST['profileImage'];
					//$content = file_get_contents($_POST['profileImage']);
					$_POST['profileImage'] = $fileName = "social" . date('YmdHis') . '.jpg';
					$data = file_get_contents($url);
					$file = fopen(SERVER_PROFILE_IMAGE_PATH . $fileName, 'w+');
					fputs($file, $data);
					fclose($file);
				}
				$res = $this->UserModel->signUp($_POST);
			} else {
				$isSuccess = false;
				$message = "Mobile number is not valid.";
				$data = array();
				echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
				die;
			}
			if ($res) {
				$isSuccess = true;
				$message = "Signup successful";
				$user_data = $this->UserModel->isUserEmailExist($_POST);
				$data = array('email' => $user_data['email']);
			} else {
				$isSuccess = false;
				$message = "Signup unsuccessful";
				$data = array();
			}
		} else {

			$isSuccess = false;
			$message = "User already exist";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function verify_otp() {
		$_POST['isVerified'] = 1;
		$_POST['otp'] = str_replace("-", "", str_replace("_", "", $_POST['otp']));
		if ($_POST['otp'] == "" || $_POST['email'] == "") {
			$isSuccess = false;
			$message = "Please enter the OTP.";
			$data = array();
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}

		$exist = $this->UserModel->verifyOTP($_POST);
		if ($exist) {
			$isSuccess = true;
			$message = base_url() . 'index.php/user/login_user_after_verification/' . $exist['userId'];
			$data = array();
		} else {
			$isSuccess = false;
			$message = "Please enter correct OTP";
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function resend_otp() {

		if ($_POST['email'] == "") {
			$isSuccess = false;
			$message = "Please enter email.";
			$data = array();
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}
		$_POST['otp'] = rand(1000, 9999);
		$exist = $this->UserModel->resend_otp($_POST);

		if ($exist) {

			$user_info = $this->UserModel->signIn(array('email' => $_POST['email']));
			$this->send_mobile_otp($user_info['countryCode'] . $user_info['mobile'], $_POST['otp']);

			$isSuccess = true;
			$message = "OTP sent successfully";
			$data = array();
		} else {
			$isSuccess = false;
			$message = "Wrong email";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/* login test with social site */

	public function facebook_auth() {
		$config = array(
			'appId' => '',
			'secret' => ''
		);
		$this->load->library('Facebook', $config);
		$action = $_REQUEST["action"];
		
		switch ($action) {
			case "fblogin":
				$appid = get_web_meta_data('facebook_app_id');
				$appsecret = get_web_meta_data('facebook_secret_key');

				$facebook = new Facebook(array(
					'appId' => $appid,
					'secret' => $appsecret,
					'cookie' => TRUE,
				));
				$fbuser = $facebook->getUser();
				
				if ($fbuser) {
					try {
						$user_profile = $facebook->api('/'.$fbuser);

						$email = $facebook->api('/'.$fbuser.'?fields=email');
					} catch (Exception $e) {
						echo $e->getMessage();
						exit();
					}

					$data['fbId'] = $fbuser;
					$data['email'] = "";
					if (isset($email["email"])) {
						$data['email'] = $email["email"];
					}
					$data['firstName'] = $user_profile["name"];
					$data['profileImage'] = "https://graph.facebook.com/" . $data['fbId'] . "/picture?type=large";
					//$data['mode'] = "facebook";
					$data['loginType'] = "1";
					/* send to login page from here  */
					if ($check = $this->UserModel->isUserExistFB($data)) {
						//check if accountis verified
						if ($check['isVerified'] == 1) {
							$this->session->set_userdata($check);
							// send reactivation email from api  
							$this->send_reactivation($check);
							$this->pass_logger();
							//redirect('user/car_list');
							die;
						} else {
							$this->db->where('userId', $check['userId']);
							$this->db->delete('urend_users');
						}
					}
					$this->session->set_flashdata('sign_up_data', $data);
					redirect('/');
				}
				break;
		}
		die;
	}

	/*
	 * authenticate with google
	 */

	public function google_auth() {
		$this->load->library('google_au');

		$google_client_id = get_web_meta_data('google_client_id');
		$google_client_secret = get_web_meta_data('google_secret_key');
		$google_redirect_url = base_url('index.php/user/google_auth'); //path to your script
		$google_developer_key = get_web_meta_data('google_app_id');
		$gClient = new Google_au();
		$gClient->setApplicationName('Login to Urend');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);
		$google_oauthV2 = new Google_Oauth2Service($gClient);

		if (isset($_GET['code'])) {
			$gClient->authenticate($_GET['code']);
			$user_token = $gClient->getAccessToken();
			if (isset($_SESSION['token'])) {

				$gClient->setAccessToken($user_token);
			}
			if ($gClient->getAccessToken()) {
				//For logged in user, get details from google using access token
				$user = $google_oauthV2->userinfo->get();
				$user_id = $user['id'];
				$user_name = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
				$email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
				//$profile_url 		= filter_var($user['link'], FILTER_VALIDATE_URL);
				$profile_image_url = filter_var($user['picture'], FILTER_VALIDATE_URL);
				$personMarkup = "$email<div><img src='$profile_image_url?sz=50'></div>";

				$data['gId'] = $user_id;
				$data['email'] = $email;
				$data['firstName'] = $user_name;
				$data['profileImage'] = $profile_image_url;
				$data['loginType'] = "2";
				/* send to login page from here  */
				if ($check = $this->UserModel->isUserExistGmail($data)) {
					//check if accountis verified
					if ($check['isVerified'] == 1) {
						$this->session->set_userdata($check);
						$this->send_reactivation($check);
						redirect('user/car_list');
						die;
					} else {
						$this->db->where('userId', $check['userId']);
						$this->db->delete('urend_users');
					}
				}
				//$this->save_user_data($data);
				$this->session->set_flashdata('sign_up_data', $data);
				redirect('/');
			}
		} else {
			redirect($authUrl = $gClient->createAuthUrl());
		}
		die;
	}

	public function login_user_after_verification($userId) {
		$user_data = $this->UserModel->get_user_with_userId($userId);
		$this->send_reactivation($user_data);
		$this->session->set_userdata($user_data);
		redirect('user/car_list');
	}

	/*
	 * this is used to reactave account if it already dectivate after login  
	 * if he is trying to login means want to access his account 
	 */

	public function send_reactivation($user_data) {

		if ($user_data['activation'] != 1) {
			//*it wasnt activate now activate it *//
			if ($this->User_model->user_account_activeness_state($user_data['userId'], 1)) {
				// it is activated now send email 

				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.urend.com',
					'smtp_port' => 25,
					'smtp_user' => 'no-reply@urend.com',
					'smtp_pass' => 'Urend2016$',
				);

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from($config['smtp_user'], 'UREND');
				$this->email->to($user_data['email']);
				$this->email->subject('Welcome Back To UREND');
				$this->email->message($this->load->view('email_templates/web_account_reactivation', array('user_data' => $user_data), True));
				$this->email->set_mailtype("html");
				$this->email->send();
			}
		}
	}

	public function add_car() {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}
		$data['car_types'] = $this->UserModel->get_all_car_type();
		$data['car_makers'] = $this->UserModel->get_all_car_maker();

		$data['fuel_types'] = $this->UserModel->get_all_fuel_types();
		$data['transmission_types'] = $this->UserModel->get_all_transmission_types();
		$data['colour_types'] = $this->UserModel->get_all_colour_types();
		$data['airbag_types'] = $this->UserModel->get_all_airbag_types();
		$data['feature_types'] = $this->UserModel->get_all_feature_types();
		$data['country'] = $this->UserModel->get_all_country();

		$this->load->view('add_car_form', $data);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}

	public function call_car_year() {
		$year_list = $this->UserModel->get_car_maker_year($this->input->post('id'));
		$html = "<option value=''>--Select Year -- </option>";
		foreach ($year_list as $yl) {
			$html .= "<option value='" . $yl['id'] . "'>" . $yl['year'] . "</option>";
		}
		echo json_encode(array('status' => 1, 'html' => "$html"));
		die;
	}

	// public function call_car_model() {
	// 	$model_list = $this->UserModel->get_list_of_car_models($this->input->post('id'));
	// 	$html = "<option value=''>--Select Model -- </option>";
	// 	foreach ($model_list as $ml) {
	// 		$html .= "<option value='" . $ml['id'] . "'>" . $ml['name'] . "</option>";
	// 	}
	// 	echo json_encode(array('status' => 1, 'html' => "$html"));
	// 	die;
	// }
	public function call_car_model() {
		$model_list = $this->UserModel->get_list_of_car_models($this->input->post('id'));
		//$html = "<option value=''>--Select Model -- </option>";
		$html = '<li class=""><a href="#">Select</a></li>';
		foreach ($model_list as $ml) {
			//$html .= "<option value='" . $ml['id'] . "'>" . $ml['name'] . "</option>";
			$html .= "<li data-id='".$ml['id']."'><a href='#'>".$ml['name']."</a></li>";

		}
		echo json_encode(array('status' => 1, 'html' => "$html"));
		die;
	}

	public function call_city_list() {
		$model_list = $this->UserModel->get_car_city_list($this->input->post('id'));
		$html = "<option value=''>--Select City -- </option>";
		foreach ($model_list as $ml) {
			$html .= "<option value='" . $ml['id'] . "'>" . $ml['city_name'] . "</option>";
		}
		echo json_encode(array('status' => 1, 'html' => "$html"));
		die;
	}

	public function car_list() {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		$data = array();
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_user_car_list',
			'data' => json_encode(array('fk_user_id' => $this->session->userdata('userId')))
		);

		$result = get_data_with_curl($option);
		$data['car_list'] = $result['Result'];

		/* get all car information of user */
		//$data ['car_list'] = $this->CarModel->fetch_user_car_data(array('fk_user_id' => $this->session->userdata('userId')));



		if (count($data ['car_list']) > 0) {
			$this->load->view('user_car_list', $data);
		} else {
			$this->load->view('no_car_upload_yet', $data);
		}
	}

	public function edit_car($id = '') {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		if (!$this->check_user_car_relation($this->session->userdata('userId'), $id)) {
			redirect('user/car_list');
		}

		$data['car_types'] = $this->UserModel->get_all_car_type();
		$data['car_makers'] = $this->UserModel->get_all_car_maker();

		$data['fuel_types'] = $this->UserModel->get_all_fuel_types();
		$data['transmission_types'] = $this->UserModel->get_all_transmission_types();
		$data['colour_types'] = $this->UserModel->get_all_colour_types();
		$data['feature_types'] = $this->UserModel->get_all_feature_types();
		$data['country'] = $this->UserModel->get_all_country();

		/*
		 *  fetch the car info
		 */
		$data['single_car_data'] = $this->CarModel->get_single_car_data($id);

		$this->load->view('edit_car_data', $data);
	}

	/*
	 * find a car function
	 */

	public function find_car() {
		$data['car_data'] = array();

		$params = array();

		if (count($this->input->get()) > 0) {

			$params = $this->input->get();

			$params['min_daily_price'] = 15;
			$params['max_daily_price'] = $this->input->get('price_ranger');

			$params['min_kmOrMilesValue'] = $this->input->get('distance_ranger');
			$params['max_kmOrMilesValue'] = 500;

			$params['min_car_brought_year'] = $this->input->get('year_ranger');
			$params['max_car_brought_year'] = date('Y');

			$params['min_delivery_price'] = 0;
			$params['max_delivery_price'] = $this->input->get('delievery_ranger');

			$params['from_time'] = $this->input->get('car_from');
			$params['to_time'] = $this->input->get('car_to');
			$date_segment = array(
				'from_time' => $this->input->get('car_from'),
				'to_time' => $this->input->get('car_to')
			);

			$this->session->set_userdata($date_segment);
		} else {
			$from = date('Y-m-d H:00', strtotime('+4 hours'));
			$to = date('Y-m-d H:00', strtotime("+7 days"));
			$params['from_time'] = $from;
			$params['to_time'] = $to;

			$params['deliveryOption'] = 0;
			$params['agent'] = 'website';
		}
		/*
		 * send user id so that user can not book his own car
		 */
		if ($this->session->userdata('userId') != "") {
			$params['user_id'] = $this->session->userdata('userId');
		} else {
			$params['user_id'] = "";
		}

		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_search_car_data',
			'data' => $params 
		);
		
		$result = get_data_with_curl($option);
		$data['car_data'] = $result['Result'];

		$data['car_types'] = $this->UserModel->get_all_car_type();
		$data['car_makers'] = $this->UserModel->get_all_car_maker();
		$data['transmission_types'] = $this->UserModel->get_all_transmission_types();

		$this->load->view('find_book_car_blocks/find_car_page', $data);
	}

	/*
	 *  single car data
	 */

	public function car_data($id) {
		$prefs['template'] = '
		{table_open}<table cellpadding="1" cellspacing="2">{/table_open}

		{heading_row_start}<tr>{/heading_row_start}

		{heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
		{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
		{heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

		{heading_row_end}</tr>{/heading_row_end}

		{week_row_start}<tr class="week_name" >{/week_row_start}
		{week_day_cell}<td >{week_day}</td>{/week_day_cell}
		{week_row_end}</tr>{/week_row_end}

		{cal_row_start}<tr>{/cal_row_start}
		{cal_cell_start}<td>{/cal_cell_start}

		{cal_cell_content}<div class="{content}">{day}</div>{/cal_cell_content}


		{cal_cell_no_content}{day}{/cal_cell_no_content}


		{cal_cell_blank}&nbsp;{/cal_cell_blank}

		{cal_cell_end}</td>{/cal_cell_end}
		{cal_row_end}</tr>{/cal_row_end}

		{table_close}</table>{/table_close}
		';

		$prefs['day_type'] = 'short';
		// Loading calendar library and configuring table design
		$this->load->library('calendar', $prefs);

		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_single_car_data',
			'data' => $params = array('id' => $id)
		);
		$result = get_data_with_curl($option);
		$data['car_data'] = $result['Result'];
		/* show 404 if not found */
		if(count($data['car_data']) < 1 ){ show_404();}
		
		$data['user_data'] = $this->UserModel->get_user_with_userId($data['car_data']['fk_user_id']);
		
		/*
		 * check if the visiter like this car if he login
		 */

		$data ['user_favourite_car'] = $this->get_user_favorite_car_list($this->session->userdata('userId'));
		$data ['is_user_fav_car'] = false;

		foreach ($data ['user_favourite_car'] as $ufv) {
			if ($ufv['id'] == $id) {
				$data ['is_user_fav_car'] = true;
			}
		}

		$data['user_account_info'] = $this->User_model->get_user_payment_account($this->session->userdata('userId'));
		/* view existing card */
		$this->load->view('find_book_car_blocks/single_car_data', $data);
	}

	/*
	 * user identity verfication
	 */

	public function user_identity_verification() {

		if ($this->session->userdata('userId') == "") {
			redirect(base_url() . "?auth=login");
		}
		/*  check if user is verified or not  */
		$user_record = $this->UserModel->get_user_with_userId($this->session->userdata('userId'));
		$data['user_record'] = $user_record;
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_document_info',
			'data' => $params = array('user_id' => $user_record['userId'])
		);

		$result = get_data_with_curl($option);
		$data['user_document'] = $result['Result'];

		if (array_key_exists('state', $data['user_document']) && $data['user_document']['state'] == 1) {

			/*  get car details 	 */
			$params = array('id' => $this->input->get('car_id'));
			$ch = curl_init(site_url() . '/service_get_single_car_data');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result, True);
			$data['car_data'] = $result['Result'];

			/* user documents are verified.  */
			if( $this->input->get('car_id') &&  $this->input->get('car_from')  ){
				redirect('user/check_car_availability?car_id=' . $this->input->get('car_id') . '&car_from=' . $this->input->get('car_from') . '&car_to=' . $this->input->get('car_to') . '&car_delivery_status=' . $data['car_data']['deliveryOption']);
			}
		}
		
		$this->load->view('find_book_car_blocks/user_identity_verification', $data);
	}

	/*
	 * Upload licence document form----------
	 */

	public function upload_licence_document() {
		$this->load->library('decrypt_img');
		$user_record = $this->UserModel->get_user_with_userId($this->session->userdata('userId'));
		/* get user document information */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_document_info',
			'data' => $params = array('user_id' => $user_record['userId'])
		);

		$result = get_data_with_curl($option);
		$data['user_document'] = $result['Result'];

		$this->form_validation->set_rules('dl_number', 'Driving License Number', 'trim|required');
		$this->form_validation->set_rules('dl_issue_date', 'First Issue Date', 'trim|required');
		$this->form_validation->set_rules('id_type', 'ID Type', 'trim|required');
		$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');
		if ($this->form_validation->run() == TRUE) {

			$request_para = array();
			$request_para['user_id'] = $this->input->post('userId');
			$request_para['name'] = $this->input->post('name');
			$request_para['gender'] = $this->input->post('gender');
			$request_para['dl_number'] = $this->input->post('dl_number');
			$request_para['dl_issue_date'] = $this->input->post('dl_issue_date');
			$request_para['expiry_date'] = $this->input->post('expiry_date');
			$request_para['id_type'] = $this->input->post('id_type');
			$request_para['id_number'] = $this->input->post('id_number');
			$password = $request_para['encrpt_key'] = md5(rand(99999999, 9999999999));

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['license_front'], $password);
			$request_para['license_front'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */


			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['license_back'], $password);
			$request_para['license_back'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['id_front'], $password);
			$request_para['id_front'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['id_back'], $password);
			$request_para['id_back'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */



			if ($this->User_model->upload_user_verification_information($request_para)) {
				/* status will be true only if transaction is successfull */
				//$this->session->set_flashdata('success_message','Your Document was successfully submitted');
				redirect('user/user_identity_verification');
			} else {
				$data['user_record'] = $user_record;
				$this->load->view('find_book_car_blocks/user_identity_verification', $data);
			}
		}
		$data['user_record'] = $user_record;
		$this->load->view('find_book_car_blocks/user_identity_verification', $data);
	}

	/*
	 * edit upload licence doucment form------------
	 */

	public function edit_upload_licence_document() {
		$this->load->library('decrypt_img');
		$user_record = $this->UserModel->get_user_with_userId($this->session->userdata('userId'));
		/* get user document information */
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_document_info',
			'data' => $params = array('user_id' => $user_record['userId'])
		);

		$result = get_data_with_curl($option);
		$data['user_document'] = $result['Result'];

		//$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		//$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dl_number', 'Driving License Number', 'trim|required');
		$this->form_validation->set_rules('dl_issue_date', 'First Issue Date', 'trim|required');
		//$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'trim|required');
		$this->form_validation->set_rules('id_type', 'ID Type', 'trim|required');
		$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$request_para = array();
			$request_para['user_id'] = $this->input->post('userId');
			$request_para['name'] = $this->input->post('name');
			$request_para['gender'] = $this->input->post('gender');
			$request_para['dl_number'] = $this->input->post('dl_number');
			$request_para['dl_issue_date'] = $this->input->post('dl_issue_date');
			$request_para['expiry_date'] = $this->input->post('expiry_date');
			$request_para['id_type'] = $this->input->post('id_type');
			$request_para['id_number'] = $this->input->post('id_number');

			$password = $request_para['encrpt_key'] = md5(rand(99999999, 9999999999));

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['license_front'], $password);
			$request_para['license_front'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */


			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['license_back'], $password);
			$request_para['license_back'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['id_front'], $password);
			$request_para['id_front'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */

			$base64Encrypted = $this->decrypt_img->encrypt_image($_FILES['id_back'], $password);
			$request_para['id_back'] = $fileName = rand(5, 555) . date('dmyhis') . ".png";   /* randomly image name */
			file_put_contents('uploads/user_verification_images/' . $fileName, $base64Encrypted);  /* this function save image in folder */

			if ($this->User_model->update_user_document_info($request_para)) {
				redirect('user/user_identity_verification');
			} else {
				$data['user_record'] = $user_record;
				$this->load->view('find_book_car_blocks/user_identity_verification', $data);
			}
		} else {
			$data['user_record'] = $user_record;
			$this->load->view('find_book_car_blocks/user_identity_verification', $data);
		}
	}

	/*
	 * Images upload function***************

	 */

	public function uploadfile($key, $folder_on_root) {
		$folder_on_root = $folder_on_root . "/";
		$files = $_FILES[$key];
		if ($files['error'] == 0) {
			$file_name = rand(1, 10) . date("YmdH_i_s") . basename($_FILES[$key]["name"]);
			$file_name = str_replace(' ', '', $file_name);
			$target_file = $folder_on_root . $file_name;
			if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
				$imgs = array('url' => '/' . $folder_on_root, 'name' => $files['name']);
			}
		}
		return $file_name;
	}

	function lat_long_distance($lat1, $lon1, $lat2, $lon2, $unit = "K") {

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

	/*
	 * check car availability
	 */

	public function check_car_availability() {
		//die("amit");
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		$data['car_availability'] = array();

		if ($this->input->get('check_availability')) {

			$params = array('id' => $this->input->get('car_id'));
			$ch = curl_init(site_url() . '/service_get_single_car_data');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result, True);
			$data['car_data'] = $result['Result'];
			$carpickuplat = $data['car_data']['carPickUpLat'];
			$carpickuplong = $data['car_data']['carPickUpLon'];
			//pre($data);die();
			if ($data['car_data']['deliveryOption'] == 0 or $this->input->get('car_delivery_status') == 0) {
				$carPickUpLocation1 = $data['car_data']['carPickUpLocation'];
				$carPickUpLat1 = $data['car_data']['carPickUpLat'];
				$carPickUpLon1 = $data['car_data']['carPickUpLon'];
				$carPickOffLocation2 = $data['car_data']['carDropOffLocation'];
				$carDropOffLat2 = $data['car_data']['carDropOffLat'];
				$carDropOffLon2 = $data['car_data']['carDropOffLon'];
			} else {
				$carPickUpLocation1 = $this->input->get('carPickUpLocation');
				$carPickUpLat1 = $this->input->get('carPickUpLat');
				$carPickUpLon1 = $this->input->get('carPickUpLon');
				$carPickOffLocation2 = $this->input->get('carDropOffLocation');
				$carDropOffLat2 = $this->input->get('carDropOffLat');
				$carDropOffLon2 = $this->input->get('carDropOffLon');
			}
			$dist1 = lat_long_distance($carpickuplat, $carpickuplong, $carPickUpLat1, $carPickUpLon1);
			$dist2 = lat_long_distance($carpickuplat, $carpickuplong, $carDropOffLat2, $carDropOffLon2);


			//pre($dist1);pre($dist2);die();

			if ($dist1 < 20 and $dist2 < 20) {
				$params = array(
					'car_id' => $this->input->get('car_id'),
					'car_from' => $this->input->get('car_from'),
					'car_to' => $this->input->get('car_to')
				);
				$ch = curl_init(site_url() . '/service_get_car_availability');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($ch);
				curl_close($ch);
				$result = json_decode($result, True);
				$data['car_availability'] = $result;
			} else {
				/* if delivery option No */
				if ($this->input->get('car_delivery_status') == 0) {
					$data['car_data']['deliveryOption'] = 0;
				}
				/*				 * **No******* */

				$this->session->set_flashdata('error_message', 'Sorry!! The delivery address should be in between 20 km of car pickup address.');
				redirect('user/check_car_availability?car_id=' . $this->input->get('car_id') . '&car_from=' . $this->input->get('car_from') . '&car_to=' . $this->input->get('car_to') . '&car_delivery_status=' . $data['car_data']['deliveryOption']);
			}
		}

		if ($this->input->get('book_this_car')) {

			$params = array('id' => $this->input->get('car_id'));
			$ch = curl_init(site_url() . '/service_get_single_car_data');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result, True);
			$data['car_data'] = $result['Result'];
			$carpickuplat = $data['car_data']['carPickUpLat'];
			$carpickuplong = $data['car_data']['carPickUpLon'];
			//pre($data);die();
			if ($data['car_data']['deliveryOption'] == 0 or $this->input->get('car_delivery_status') == 0) {
				$carPickUpLocation1 = $data['car_data']['carPickUpLocation'];
				$carPickUpLat1 = $data['car_data']['carPickUpLat'];
				$carPickUpLon1 = $data['car_data']['carPickUpLon'];
				$carPickOffLocation2 = $data['car_data']['carDropOffLocation'];
				$carDropOffLat2 = $data['car_data']['carDropOffLat'];
				$carDropOffLon2 = $data['car_data']['carDropOffLon'];
			} else {
				$carPickUpLocation1 = $this->input->get('carPickUpLocation');
				$carPickUpLat1 = $this->input->get('carPickUpLat');
				$carPickUpLon1 = $this->input->get('carPickUpLon');
				$carPickOffLocation2 = $this->input->get('carDropOffLocation');
				$carDropOffLat2 = $this->input->get('carDropOffLat');
				$carDropOffLon2 = $this->input->get('carDropOffLon');
			}


			$dist1 = lat_long_distance($carpickuplat, $carpickuplong, $carPickUpLat1, $carPickUpLon1);
			$dist2 = lat_long_distance($carpickuplat, $carpickuplong, $carDropOffLat2, $carDropOffLon2);


			if ($dist1 < 20 and $dist2 < 20) {
				redirect('user/booking_confirmation?car_id=' . $this->input->get('car_id') . '&car_from=' . $this->input->get('car_from') . '&car_to=' . $this->input->get('car_to') . '&car_delivery_status=' . $this->input->get('car_delivery_status') . '&car_pick_up_lat=' . $carPickUpLat1 . '&car_pick_up_lon=' . $carPickUpLon1 . '&car_pick_up_location=' . $carPickUpLocation1 . '&car_drop_Off_lat=' . $carDropOffLat2 . '&car_drop_Off_lon=' . $carDropOffLon2 . '&car_drop_Off_location=' . $carPickOffLocation2);
			} else {
				/* if delivery option No */
				if ($this->input->get('car_delivery_status') == 0) {
					$data['car_data']['deliveryOption'] = 0;
				}
				/*				 * **No******* */

				$this->session->set_flashdata('error_message', 'Sorry!! The delivery address should be in between 20 km of car pickup address.');
				redirect('user/check_car_availability?car_id=' . $this->input->get('car_id') . '&car_from=' . $this->input->get('car_from') . '&car_to=' . $this->input->get('car_to') . '&car_delivery_status=' . $data['car_data']['deliveryOption']);
			}
		}
		$this->load->view('find_book_car_blocks/check_car_availability', $data);
	}

	/*
	 * confirm booking
	 */

	public function booking_confirmation() {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		if ($this->input->post('book_this_car')) {

			$params = array(
				'car_id' => $this->input->post('car_id'),
				'car_renter_id' => $this->session->userdata('userId'),
				'car_from' => $this->input->post('car_from'),
				'car_to' => $this->input->post('car_to'),
				'car_renter_text' => $this->input->post('car_renter_text'),
			);
			$params['pickup_location'] = $this->input->post('car_pick_up_location');
			$params['pickup_location_lat'] = $this->input->post('car_pick_up_lat');
			$params['pickup_location_lon'] = $this->input->post('car_pick_up_lon');
			$params['drop_off_location'] = $this->input->post('car_drop_Off_location');
			$params['drop_off_location_lat'] = $this->input->post('car_drop_Off_lat');
			$params['drop_off_location_lon'] = $this->input->post('car_drop_Off_lon');
			$params['delivery_option'] = $this->input->post('car_delivery_status');


			$ch = curl_init(site_url() . '/service_book_car');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result, True);
			if ($result['isSuccess']) {
				$this->session->set_flashdata('page_message', $result['message']);
				redirect("request/sent");
			} else {
				$this->session->set_flashdata('page_message', $result['message']);
				redirect("request/sent");
			}
		}

		$this->load->view('find_book_car_blocks/confirm_booking');
	}

	public function user_profile($id = "") {

		$user_id = $id;
		$data['user_data'] = $this->UserModel->get_user_with_userId($user_id);
		/* get all car information of user */
		$data ['car_list'] = $this->CarModel->fetch_user_car_data(array('fk_user_id' => $user_id));
		/*
		 *  get user fav car list
		 */

		$data ['user_favourite_car'] = $this->get_user_favorite_car_list($user_id);

		$this->load->view('view_user_profile', $data);
	}

	private function get_user_favorite_car_list($user_id) {
		$params = array(
			'user_id' => $user_id
		);
		$ch = curl_init(site_url() . '/service_get_favourite_list');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, True);
		return $result['Result'];
	}

	public function edit_profile() {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		$data['user_data'] = $this->UserModel->get_user_with_userId($this->session->userdata('userId'));
		$this->session->set_userdata($data['user_data']);
		$this->load->view('edit_profile', $data);
	}

	/*
	 * we are using this function to add / delete user to his fav car
	 */

	public function user_favourite() {

		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		$params = array(
			'user_id' => $this->session->userdata('userId'),
			'car_id' => $this->input->get('car_id'),
			'status' => $this->input->get('status')
		);
		$ch = curl_init(site_url() . '/service_user_favourite_hit');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		redirect('user/car_data/' . $this->input->get('car_id'));
	}

	/*
	 *  delete a user car
	 */

	public function delete_user_car($car_id) {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		$user_id = $this->session->userdata('userId');
		if ($this->check_user_car_relation($user_id, $car_id)) {
			$params = array(
				'fk_user_id' => $user_id,
				'id' => $car_id,
			);
			$ch = curl_init(site_url() . '/service_delete_user_car');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		redirect('user/car_list');
	}

	/*
	 *  check if user belong to perticular car id
	 */

	private function check_user_car_relation($user_id, $car_id) {

		/* get all car information of user */
		$car_list = $this->CarModel->fetch_user_car_data(array('fk_user_id' => $user_id));

		foreach ($car_list as $cl) {
			if ($car_id == $cl['id'] && $user_id == $cl['fk_user_id']) {
				return true;
			}
		}
		return false;
	}

	public function report_car($car_id = "") {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}


		if ($this->input->post('report_car')) {
			if ($this->input->post('reason_id')) {
				$reason = implode(',', $this->input->post('reason_id'));

				$params = array(
					'user_id' => $this->session->userdata('userId'),
					'car_id' => $car_id,
					'reason_id' => $reason,
					'other_text' => $this->input->post('other_text'),
				);
				$ch = curl_init(site_url() . '/service_save_car_report');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($ch);
				curl_close($ch);

				$this->session->set_flashdata('message', '<div class="success-alert">Your report for car is saved.</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="error-alert">Please choose vaild reason to report car.</div>');
			}
		}
		$params = array('id' => $car_id);
		$ch = curl_init(site_url() . '/service_get_single_car_data');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, True);
		$data['car_data'] = $result['Result'];

		$ch = curl_init(site_url() . '/service_get_all_report_text');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, True);
		$data['car_report_text'] = $result['Result'];



		$this->load->view('report_car', $data);
	}

	public function delete_car($car_id = "") {
		if ($this->session->userdata('userId') == "") {
			$this->logout();
		}

		if ($this->input->post('delete_car')) {
			$reason = implode(',', $this->input->post('reason_id'));

			$params = array(
				'fk_user_id' => $this->session->userdata('userId'),
				'id' => $car_id,
				'reason_id' => $reason,
				'other_text' => $this->input->post('other_text'),
			);

			$ch = curl_init(site_url() . '/service_delete_user_car');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			curl_close($ch);
			redirect('user/car_list');
		}

		$params = array('id' => $car_id);
		$ch = curl_init(site_url() . '/service_get_single_car_data');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, True);
		$data['car_data'] = $result['Result'];

		$ch = curl_init(site_url() . '/service_get_all_deletecar_text');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, True);
		$data['car_delete_text'] = $result['Result'];

		$this->load->view('delete_car', $data);
	}

	/** ignore, it's demo */
	public function dashboard($id = "") {

		$this->load->view('dashboard', []);
	}
	/** ignore, it's demo */
	public function reviews($id = "") {

		$this->load->view('reviews', []);
	}

	/** ignore, it's demo */
	public function profile_preview($id = "") {

		$this->load->view('profile_preview', []);
	}
}
