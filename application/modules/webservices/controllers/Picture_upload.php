<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Picture_upload extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	public function insert_car_picture() {
			/* language changer */
		$this->language = ($this->input->get('language') == "")?"english":$this->input->get('language');
		$this->lang->load('master', "$this->language");
		
		$isSuccess = False;
		$message = $this->lang->line('not_able_to_upload_image');
		$data = array();

		if ($_FILES) {
			/* call uploader function with api  */
			$data['file_name'] = $this->uploadfile('car_image', 'uploads/temp_folder');
			$data['file_url'] = base_url("uploads/temp_folder") . "/" . $data['file_name'];
			if ($data['file_name'] == "") {
				echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => array()));
				die;
			}
			echo json_encode(array("isSuccess" => True, "message" => $this->lang->line('image_uploaded_successfully'), "Result" => $data));
			die;
		} else {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}
	}

	public function uploadfile($key, $folder_on_root) {
		$folder_on_root = $folder_on_root . "/";
		$files = $_FILES[$key];
		$file_name = "";
		if ($files['error'] == 0) {

			$file_name = rand(1, 10) . time() . basename($_FILES[$key]["name"]);
			$target_file = $folder_on_root . $file_name;

			if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
				$imgs = array('url' => '/' . $folder_on_root, 'name' => $files['name']);
			}
		}
		return $file_name;
	}

	/*
	  public function file_move(){
	  $file = "101475501674imgpsh_fullsize.png";
	  $source = $_SERVER['DOCUMENT_ROOT'].'/urend-pro/uploads/temp_folder/'.$file;
	  $desti = $_SERVER['DOCUMENT_ROOT'].'/urend-pro/uploads/temp_folder/fold/'.$file;
	  rename($source, $desti);
	  //shell_exec("mv $source $desti");

	  } */
	
	public function insert_car_picture_base() {
		$isSuccess = False;
		$message = "Not able to upload image.";
		$data = array();

		if ($this->input->post()) {
			/* call uploader function with file base  */
			$data['file_name'] = $this->makeBase64Img($this->input->post('file_base'),'uploads/temp_folder/');
			
			$data['file_url'] = base_url("uploads/temp_folder") . "/" . $data['file_name'];
			
			if ($data['file_name']  == false ) {
				echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => array()));
				die;
			}
			echo json_encode(array("isSuccess" => True, "message" => 'Image uploaded successfully', "Result" => $data));
			die;
		} else {
			echo json_encode(array("isSuccess" => $isSuccess, "message" => $message, "Result" => $data));
			die;
		}
	}
	
	private function makeBase64Img($image,$path) {
		$data = str_replace(" ", "+", $image);
		$data = base64_decode($data);
		$im = imagecreatefromstring($data);
		$fileName = rand(5, 115) . time() . ".png";
		$imageName = $path . $fileName;
		if ($im !== false) {
			imagepng($im, $imageName);
			imagedestroy($im);
		} else {
			return false; 
		}
		return $fileName;
	}
	
}
