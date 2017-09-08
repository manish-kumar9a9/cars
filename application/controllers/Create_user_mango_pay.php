<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_user_mango_pay extends CI_Controller {

  public function index(){
    $this->load->view('create_user_mango_pay');
  }

  public function create_user(){
    $data = $_POST;
    $data['birthday'] = strtotime($data['birthday']);
    $this->load->library('mango_pay');
    $this->mango_pay->mango_create_natural_user($data);
  }

}
