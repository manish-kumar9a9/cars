<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('email');
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

	function sendOTP($document) {
		//pre($document); die();
		if (isset($document['countryCode'])) {
			if ($document['countryCode'] == "+30") {
				$from = "Urend";
			} else {
				$from = "+18553380179";
			}
		} else {
			$from = "+18553380179";
		}
		require APPPATH . 'third_party/twilio-php/Services/Twilio.php';
		$account_sid = 'ACe5d1b236cd5e99647ec620d895f3d0fb';
		//$account_sid   = 'ACd2f16e331001ea0c434de5babe78cc89';
		$auth_token = '48bf6a49e204b66aaf79077654a96d38';
		$client = new Services_Twilio($account_sid, $auth_token);

		$message = array();
		try {
			$message = $client->account->messages->create(array(
				'To' => $document['mobile'],
				'From' => $from,
				//'From' => "Urend",
				'Body' => "Thanks for using Urend. Your code is " . $document['otp'],
			));
		} catch (Services_Twilio_RestException $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
			return "3"; //Invalid Number Invalid Number otp sent otp could not send
		}
		if ($message->sid != '') {
			return "1"; //otp sent
		} else {
			return "2"; //otp could not send
		}
	}

	public function userSignUp() {
		$json = file_get_contents('php://input');
		/*
		 * get request parameter
		 */
		if (is_json($json)) {
			$send = array();
			$json = json_decode($json, true);
			$document = array();
			$document['loginType'] = $json['loginType'];
			$loginType = $json['loginType'];
			$document['firstName'] = $json['firstName'];
			$document['lastName'] = $json['lastName'];
			$document['email'] = $json['email'];
			$document['countryCode'] = $json['countryCode'];
			$document['mobile'] = $json['mobile'];
			$document['deviceToken'] = $json['deviceToken'];
			$document['deviceType'] = $json['deviceType'];

			$document['profileImage'] = $json['profileImage'];
			$document['dob'] = (ISSET($json['dob'])) ? $json['dob'] : "0000-00-00";
			$document['createdAt'] = date('Y-m-d h:i:s');

			$isSuccess = false;
			$obj = new user_model;
			$isUserPhoneExist = $obj->isUserPhoneExist($document);

			if ($loginType == 0) {
				$document['password'] = md5($json['password']);
				$isUserEmailExist = $obj->isUserEmailExist($document);
				if ($isUserEmailExist) {
					$message = "This email id is already registered";
				} else if ($isUserPhoneExist) {
					$message = "This phone number is  already registered";
				}
				if (empty($isUserEmailExist) and empty($isUserPhoneExist)) {
					$send['otp'] = rand(1000, 9999);
					$send['countryCode'] = $document['countryCode'];
					$send['mobile'] = $document['countryCode'] . $document['mobile'];
					$sendOTP = $this->sendOTP($send);

					if ($sendOTP == "1") {
						/* if ($document['profileImage'] != "") {
						  $document['profileImage'] = $obj->makeBase64Img($document['profileImage']);
						  } */
						/*
						 * upload dp with url @vipul start
						 */
						if ($document['profileImage'] != "") {
							$url = $document['profileImage'];
							$document['profileImage'] = $fileName = "social" . date('YmdHis') . '.jpg';
							$data = file_get_contents($url);
							$file = fopen(SERVER_PROFILE_IMAGE_PATH . $fileName, 'w+');
							fputs($file, $data);
							fclose($file);
						}

						/*
						 * upload dp with url @vipul end here
						 */
						$userSignUp = $obj->userSignUp($document);
						if ($userSignUp) {
							/* if ($document['profileImage'] == "") {
							  $document['profileImage'] = base_url("profileImages/" . $document['profileImage']);
							  } */

							$updateOTP = $obj->updateOTP($send);
							$userSignUp['otp'] = $send['otp'];
							$isSuccess = true;
							$message = "Successful sign up";
							$userSignUp['otpStatus'] = $sendOTP;
							$data = $userSignUp;
						} else {
							$message = "User could not register";
							$isSuccess = false;
							$data = array();
						}
					} else if ($sendOTP == '2') {
						$message = "Code couldnt send please try again";
						$isSuccess = false;
						$data = array();
					} else {
						$message = "Please enter a valid number";
						$isSuccess = false;
						$data = array();
					}
				} else {
					$isSuccess = false;
					$data = array();

					if ($isUserEmailExist['loginType'] == 1) {
						$message = "You are already registered with Facebook. Please Login with facebook.";
					} else if ($isUserEmailExist['loginType'] == 2) {
						$message = "You are already registered with Google. Please Login with google.";
					}
				}
			} else {
				$imageType = $json['imageType'];
				$document['socialId'] = $json['socialId'];
				if ($loginType == 1) {
					$document['fbId'] = $json['socialId'];
				} else if ($loginType == 2) {
					$document['gId'] = $json['socialId'];
				}

				$isUserSocialExist = $obj->isUserSocialExist($document);
				$isUserEmailExist = $obj->isUserEmailExist($document);

				if ($isUserEmailExist) {
					$message = "This email id is already registered";
				} else if ($isUserPhoneExist) {
					$message = "This phone number is already registered";
				}
				if (empty($isUserSocialExist) and empty($isUserPhoneExist)) {
					//if(!$isUserSocialExist)

					$send['otp'] = rand(1000, 9999);
					$send['countryCode'] = $document['countryCode'];
					$send['mobile'] = $document['countryCode'] . $document['mobile'];
					$sendOTP = $this->sendOTP($send);

					if ($sendOTP == "1") {
						/* if ($imageType == "image") {
						  $document['profileImage'] = $obj->makeBase64Img($document['profileImage']);
						  $document['profileImage'] = base_url("profileImages/" . $document['profileImage']);
						  } */
						if ($document['profileImage'] != "") {
							$url = $document['profileImage'];
							$document['profileImage'] = $fileName = "social" . date('YmdHis') . '.jpg';
							$data = file_get_contents($url);
							$file = fopen(SERVER_PROFILE_IMAGE_PATH . $fileName, 'w+');
							fputs($file, $data);
							fclose($file);
						}
						unset($document['socialId']);

						$userSignUp = $obj->userSignUp($document);
						if ($userSignUp) {

							$updateOTP = $obj->updateOTP($send);
							$userSignUp['otp'] = $send['otp'];

							$message = "Successful sign up";
							$isSuccess = true;
							$userSignUp['otpStatus'] = $sendOTP;
							//$data = $userSignUp;
							$data = $this->user_model->userProfile($userSignUp);
							$data['otp'] = $send['otp'];
						} else {
							$message = "User could not register";
							$isSuccess = false;
							$data = array();
						}
					} else if ($sendOTP == '2') {
						$message = "Code couldnt send please try again";
						$isSuccess = false;
						$data = array();
					} else {
						$message = "Please enter a valid number";
						$isSuccess = false;
						$data = array();
					}
				} else {
					$isSuccess = false;
					//$message        = "User already registered";
					$data = array();
				}
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function userLogin() {
		$json = file_get_contents('php://input');
		
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
			
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();

			$isSuccess = false;
			$message = "";
			$obj = new user_model;

			$document['loginType'] = $json['loginType'];
			$loginType = $json['loginType'];

			if ($loginType != 0) {
				$document['socialId'] = $json['socialId'];

				$isUserSocialExist = $obj->isUserSocialExist($document);

				if ($isUserSocialExist) {
					if ($isUserSocialExist['profileImage'] != "") {
						$isUserSocialExist['profileImage'] = base_url("profileImages/" . $isUserSocialExist['profileImage']);
					}
					if ($isUserSocialExist['isVerified'] == 1) {

						/* update tokken and device type here */
						if (array_key_exists("deviceType", $json) && array_key_exists("deviceToken", $json)) {

							$document1['deviceType'] = $json['deviceType'];
							$document1['deviceToken'] = $json['deviceToken'];
							if ($document1['deviceType'] != '' && $document1['deviceToken'] != '') {
								$document1['userId'] = $isUserSocialExist['userId'];
								$UpdatedeviceToken = $obj->isUserUpdatedeviceToken($document1);
							}
						}
						/* send reactivation mail if required */

						$this->send_reactivation($isUserSocialExist);
						$isSuccess = true;
						$message = $this->lang->line('login_successful_login');
						$messageCode = "1";
						//$data = $isUserSocialExist;
						$data = $this->user_model->userProfile($isUserSocialExist);
					} else {
						$isSuccess = false;
						$message = $this->lang->line('login_Inactive_user');
						$messageCode = "4";
						$data = $isUserSocialExist;
					}
				} else {
					$isSuccess = false;
					$message = $this->lang->line('login_user_not_exist');
					$messageCode = "3";
					$data = array();
				}
			} else {
				$document['email'] = $json['email'];
				$document['password'] = $json['password'];

				$isUserEmailExist = $obj->isUserEmailExist($document);

				if ($isUserEmailExist) {
					if ($isUserEmailExist['loginType'] == 0) {
						if ($isUserEmailExist['isVerified'] == 1) {
							if ($isUserEmailExist['password'] == md5($document['password'])) {
								/* send reactivation mail if required */

								$this->send_reactivation($isUserEmailExist);
								$isSuccess = true;
								$message = $this->lang->line('login_successful_login');
								$messageCode = "1";

								/* update tokken and device type here */
								if (array_key_exists("deviceType", $json) && array_key_exists("deviceToken", $json)) {

									$document1['deviceType'] = $json['deviceType'];
									$document1['deviceToken'] = $json['deviceToken'];
									if ($document1['deviceType'] != '' && $document1['deviceToken'] != '') {
										$document1['userId'] = $isUserEmailExist['userId'];
										$UpdatedeviceToken = $obj->isUserUpdatedeviceToken($document1);
									}
								}
								$data = $this->user_model->userProfile($isUserEmailExist);
							} else {
								$isSuccess = false;
								$message = $this->lang->line('login_wrong_password');
								$messageCode = "2";
								$data = array();
							}
						} else {
							$isSuccess = false;
							$message = $this->lang->line('login_user_not_exist');
							$messageCode = "4";
							$data = $isUserEmailExist;
						}
					} else if ($isUserEmailExist['loginType'] == 1) {
						$isSuccess = false;
						$message = $this->lang->line('login_you_are_registered_with_facebook');
						$messageCode = "5";
						$data = $isUserEmailExist;
					} else {
						$isSuccess = false;
						$message = $this->lang->line('login_you_are_registered_with_google');
						$messageCode = "6";
						$data = $isUserEmailExist;
					}
				} else {
					$isSuccess = false;
					$message = $this->lang->line('login_this_email_id_is_not_registered_with_urend');
					$messageCode = "3";
					$data = array();
				}
			}
		} else {
			$isSuccess = false;
			$message = $this->lang->line('invalid_json_input');
			$messageCode = "";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "messageCode" => $messageCode, "Result" => $data));
	}

	/*
	 * this is used to reactave account if it already dectivate after login  
	 * if he is trying to login means want to access his account 
	 */

	public function send_reactivation($user_data) {

		if ($user_data['activation'] != 1) {
			//*it wasnt activate now activate it *//
			if ($this->user_model->user_account_activeness_state($user_data['userId'], 1)) {
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
				$this->email->message($this->load->view('email_templates/app_account_reactivation', array('user_data' => $user_data), True));
				$this->email->set_mailtype("html");
				$this->email->send();
			}
		}
	}

	public function resendOTP() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();
			$document['email'] = $json['email'];
			$document['countryCode'] = $json['countryCode'];
			$document['mobile'] = $json['mobile'];

			$isSuccess = false;
			$obj = new user_model;
			$isUserEmailExist = $obj->isUserEmailExist($document);
			if ($isUserEmailExist) {
				$send['otp'] = rand(1000, 9999);
				$send['mobile'] = $document['countryCode'] . $document['mobile'];
				$sendOTP = $this->sendOTP($send);

				$updateOTP = $obj->updateOTP($send);
				$userSignUp['otp'] = $send['otp'];
				$message = "Code sent successfully";
				$isSuccess = true;
				$data = $userSignUp;
			} else {
				$isSuccess = false;
				$message = "User not registered";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function verifyOTP() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();
			$document['email'] = $json['email'];
			$document['isVerified'] = $json['isVerified'];

			$isSuccess = false;
			$message = "";
			$obj = new user_model;
			$results = $obj->editUser($document);
			if ($results) {
				$isSuccess = true;
				$message = "Verified successfully";
				$data = $results;
			} else {
				$isSuccess = false;
				$message = "user not exist";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function forgetPassword() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();

			$document['email'] = $json['email'];

			$isSuccess = false;
			$obj = new user_model;
			$isUserExist = $obj->isUserEmailExist($document);
			if ($isUserExist) {
				if ($isUserExist['loginType'] == 0) {
					$to = $document['email'];
					$msg = "Your Password is " . $isUserExist['password'];
					$sub = "Your Password from Urend";
					$headers = 'From: Urend <urend@appsquadz.com>' . "\r\n";

					@$sentmail = mail($to, $sub, $msg, $headers);
					if (!empty($sentmail)) {
						$isSuccess = true;
						$message = "Password sent to your mail successfully";
						$data = array();
					} else {
						$isSuccess = false;
						$message = "sorry, Password could not sent";
						$data = array();
					}
				} else if ($isUserExist['loginType'] == 1) {
					$isSuccess = false;
					$message = "You are registered with Facebook. Please Login with facebook.";
					$data = array();
				} else if ($isUserExist['loginType'] == 2) {
					$isSuccess = false;
					$message = "You are registered with Google. Please Login with google.";
					$data = array();
				}
			} else {
				$isSuccess = false;
				$message = "User not exist";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function userProfile() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();
			$document['userId'] = $json['userId'];
			$isSuccess = false;
			$obj = new User_model;

			$userProfile = $obj->userProfile($document);
			if (!empty($userProfile)) {
				$isSuccess = true;
				$message = "User details display";
				$data = $userProfile;
			} else {
				$isSuccess = false;
				$message = "User could not found";
				$data = $document;
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function changePassword() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();
			$document['email'] = $json['email'];
			$document['password'] = md5($json['newPassword']);

			$isSuccess = false;
			$obj = new user_model;


			$isUserExist = $obj->isUserExist($document);

			if ($isUserExist) {
				$results = $obj->changePassword($document);
				if (!empty($results)) {
					$isSuccess = true;
					$message = "Password changed successfully";
					$data = array();
				} else {
					$isSuccess = false;
					$message = "password could not change";
					$data = array();
				}
			} else {
				$isSuccess = false;
				$message = "User not exist";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invaid Json Input";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * created @vipul
	 */

	public function edit_user_profile() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($_REQUEST) {
			$user_data['userId'] = $_REQUEST['userId'];
			$user_data['firstName'] = $_REQUEST['firstName'];
			$user_data['lastName'] = $_REQUEST['lastName'];
			$user_data['about_user'] = $_REQUEST['about_user'];
			$user_data['country'] = $_REQUEST['country'];

			if ($_FILES && array_key_exists("profileImage", $_FILES) && $_FILES['profileImage']['name'] != "") {
				$user_data['profileImage'] = $this->uploadfile('profileImage', 'profileImages');
			}
			$this->user_model->editProfile($user_data);

			$isSuccess = true;
			$message = $this->lang->line('data_saved_successfully');
			$data = $this->user_model->userProfile(array('userId' => $user_data['userId']));
		} else {

			$isSuccess = false;
			$message = $this->lang->line('invalid_input_data');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

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

	public function upload_user_verification_files() {

		if ($_REQUEST) {

			$user_data['userId'] = $_REQUEST['userId'];

			if ($_FILES && array_key_exists("verification_file", $_FILES) && $_FILES['verification_file']['name'] != "") {
				$user_data['verification_file'] = $this->uploadfile('verification_file', 'profileImages');
			}
			if ($_FILES && array_key_exists("verification_image", $_FILES) && $_FILES['verification_image']['name'] != "") {
				$user_data['verification_image'] = $this->uploadfile('verification_image', 'profileImages');
			}

			$this->user_model->editProfile($user_data);

			$isSuccess = true;
			$message = "Data uploaded successfully.";
			$data = $this->user_model->userProfile(array('userId' => $_REQUEST['userId']));
		} else {
			$isSuccess = false;
			$message = "Invalid Input data.";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * get user with its primary key id it will just send all the record from database
	 * it will not check user is active or not and other filter
	 * be care carefull while using this service !!!!
	 */

	public function get_user_with_primary_key() {
		$json = file_get_contents('php://input');
		if (is_json($json)) {
			$json = json_decode($json, true);
			$document = array();
			$document['userId'] = $json['user_id'];
			/* cal model function */
			$data = $this->user_model->userProfile(array('userId' => $document['userId']));

			if (count($data) > 0) {
				$isSuccess = True;
				$message = "User record fetched.";
				$data = $data;
			} else {
				$isSuccess = false;
				$message = "No record found.";
				$data = array();
			}
		} else {
			$isSuccess = false;
			$message = "Invalid Json Input.";
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function upload_user_verification_information() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['user_id'] = $this->input->post('user_id');
			$request_para['name'] = $this->input->post('name');
			$request_para['gender'] = $this->input->post('gender');
			$request_para['dl_number'] = $this->input->post('dl_number');
			$request_para['dl_issue_date'] = $this->input->post('dl_issue_date');
			$request_para['expiry_date'] = $this->input->post('expiry_date');
			$request_para['id_type'] = $this->input->post('id_type');
			$request_para['id_number'] = $this->input->post('id_number');
			$request_para['encrpt_key'] = $this->input->post('encrpt_key');


			$request_para['license_front'] = $this->uploadfile('license_front', 'uploads/user_verification_images');
			$request_para['license_back'] = $this->uploadfile('license_back', 'uploads/user_verification_images');
			$request_para['id_front'] = $this->uploadfile('id_front', 'uploads/user_verification_images');
			$request_para['id_back'] = $this->uploadfile('id_back', 'uploads/user_verification_images');

			if ($this->user_model->upload_user_verification_information($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('document_uploaded_successfully');
				$data = array();
			} else {
				$isSuccess = False;
				$message = $this->lang->line('not_updated');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function get_user_document_info() {
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['user_id'] = $this->input->post('user_id');

			if ($data = $this->user_model->get_user_document_info($request_para['user_id'])) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('document_data_fetched_successfully');
			} else {
				$isSuccess = False;
				$message = $this->lang->line('data_not_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function edit_user_document_info() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$request_para = array();

			$request_para['user_id'] = $this->input->post('user_id');
			$request_para['name'] = $this->input->post('name');
			$request_para['gender'] = $this->input->post('gender');
			$request_para['dl_number'] = $this->input->post('dl_number');
			$request_para['dl_issue_date'] = $this->input->post('dl_issue_date');
			$request_para['expiry_date'] = $this->input->post('expiry_date');
			$request_para['id_type'] = $this->input->post('id_type');
			$request_para['id_number'] = $this->input->post('id_number');
			$request_para['user_id'] = $this->input->post('user_id');
			$request_para['encrpt_key'] = $this->input->post('encrpt_key');

			if ($_FILES && $_FILES['license_front'] != "") {
				$request_para['license_front'] = $this->uploadfile('license_front', 'uploads/user_verification_images');
			}
			if ($_FILES && $_FILES['license_back'] != "") {
				$request_para['license_back'] = $this->uploadfile('license_back', 'uploads/user_verification_images');
			}
			if ($_FILES && $_FILES['id_front'] != "") {
				$request_para['id_front'] = $this->uploadfile('id_front', 'uploads/user_verification_images');
			}
			if ($_FILES && $_FILES['id_back'] != "") {
				$request_para['id_back'] = $this->uploadfile('id_back', 'uploads/user_verification_images');
			}

			if ($this->user_model->update_user_document_info($request_para)) {
				/* status will be true only if transaction is successfull */
				$isSuccess = True;
				$message = $this->lang->line('document_updated_successfully');
				$data = array();
			} else {
				$isSuccess = False;
				$message = $this->lang->line('data_not_found');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}

		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * user account /wallet/balance services 
	 */

	public function wallet_info_with_user_id() {
		$this->load->library('mango_pay');
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$result = $this->user_model->get_user_payment_account($user_id);
			if (count($result) > 0) {
				$WalletId = $result['wallet_id'];
				$return = $this->mango_pay->mango_view_wallet($WalletId);
				$isSuccess = true;
				$message = $this->lang->line('record_fetched_successfully');
				$data = $return;
			} else {
				$isSuccess = False;
				$message = $this->lang->line('payment_account_is_not_exist');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function account_info_with_user_id() {
		$this->load->library('mango_pay');
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$result = $this->user_model->get_user_payment_account($user_id);
			if (count($result) > 0) {

				$isSuccess = true;
				$message = $this->lang->line('record_fetched_successfully');
				$data = $result;
			} else {
				$isSuccess = False;
				$message = $this->lang->line('payment_account_is_not_exist');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function create_user_wallet() {
		$this->load->library('mango_pay');
		
		/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$result = $this->user_model->get_user_payment_account($user_id);
			if (count($result) > 0) {
				$isSuccess = false;
				$message = $this->lang->line('payment_account_already_exist');
				$data = array();
				echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
				die;
			}

			$user_data = $this->user_model->userProfile(array('userId' => $user_id));

			$data = array(
				"Tag" => $user_data['userId'],
				"FirstName" => $user_data['firstName'],
				"LastName" => $user_data['lastName'],
				"Birthday" => 1463496101,
				"Nationality" => 'IN',
				"CountryOfResidence" => 'IN',
				"Email" => $user_data['email']
			);

			$return = $this->mango_pay->mango_create_natural_user($data);
			$payment_user_id = $return->Id;
			$data = array(
				"Tag" => $user_id,
				"Owners" => array($payment_user_id),
				"Description" => "Wallet was created for user id :  " . $user_id,
				"Currency" => "EUR",
			);

			$wallet_return = $this->mango_pay->mango_create_wallet($data);

			/* save data to databse table for after work  */
			$account_info = array(
				"user_id" => $user_id,
				"wallet_id" => $wallet_return->Id,
				"author_id" => $payment_user_id,
			);
			if ($this->user_model->save_user_wallet_ini($account_info)) {
				$isSuccess = true;
				$message = $this->lang->line('payment_account_created_successfully');
				$data = array();
			}
		} else {
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 * This funcyion is used toi delete card id and its information from third party 
	 */

	public function delete_user_card_with_card_id() {
		$isSuccess = False;
		$data = array();
		// strongly required 
		$this->load->library('mango_pay');

			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$card_id = $this->input->post("card_id");
			$result = $this->user_model->get_user_payment_account($user_id);
			if (count($result) > 0 && $result['user_id'] == $user_id && $result['card_id'] == $card_id) {
				// we are checking card with relative userid 
				// everything is ok delete card now 
				$info_return = $this->mango_pay->delete_card($card_id);
				if ($info_return) {
					// remove from database 
					$account_info = array(
						"user_id" => $user_id,
						"card_id" => "",
					);
					$this->user_model->add_card_to_user($account_info);
					$isSuccess = true;
					$message = $this->lang->line('card_removed_successfully');
				}
			} else {
				$message = $this->lang->line('invalid_request');
			}
		} else {
			$message = $this->lang->line('request_parameters_not_valid');
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	/*
	 *  this function is used to add mango pay user bank id to urend database
	 */

	public function update_user_bank_id() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		$isSuccess = False;
		$data = array();

		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$banking_account_id = $this->input->post("banking_account_id");
			$result = $this->user_model->get_user_payment_account($user_id);
			if (count($result) > 0 ) {
				// remove from database 
				$account_info = array(
					"user_id" => $user_id,
					"banking_account_id" => $banking_account_id,
				);

				$this->user_model->update_user_bank_account($account_info);
				$isSuccess = true;


				if ($banking_account_id == "") {
					$message = $this->lang->line('account_deleted_successfully');
				}else{
					$message =$this->lang->line('account_added_successfully');
				}
			} else {
				$message = $this->lang->line('invalid_request');
			}
		}else{
			$message = $this->lang->line('request_parameters_not_valid');
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}

	public function user_account_activeness_state() {
		
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
			
		if ($this->input->post()) {
			$user_id = $this->input->post("user_id");
			$status = $this->input->post("status");
			$result = $this->user_model->user_account_activeness_state($user_id, $status);
			if ($result) {
				$isSuccess = true;
				$message = $this->lang->line('user_account_activeness_record_updated_successfully');
				$data = array();
			}else{
				$isSuccess = False;
				$message = $this->lang->line('user_account_activeness_not_update_record');
				$data = array();
			}
		}else{
			$isSuccess = False;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}
	
	
	public function user_logout() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		if ($this->input->post()) {
			$user_data['userId'] = $this->input->post('userId');
			$result = $this->user_model->user_logout($user_data);
			if ($result) {
				$isSuccess = true;
				$message = $this->lang->line('user_successfully_logged_out');
				$data = array();
			} else {
				$isSuccess = False;
				$message = $this->lang->line('user_not_logged_out');
				$data = array();
			}
		}else{

			$isSuccess = false;
			$message = $this->lang->line('request_parameters_not_valid');
			$data = array();
		}
		echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
	}
	
	
}
