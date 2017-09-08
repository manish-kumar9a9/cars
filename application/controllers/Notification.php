<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
    
    public $active_user_id       = "";

    function __construct() {

        parent::__construct();
        $this->load->helper('form');
        /* this model handle all transactions */
        $this->load->model('user_notification_model');
        $this->load->model('user_model');
        $this->load->model('user_cars_model');
		$login_user  =  $this->session->userdata();  // pre($login_user );
        if ($this->session->userdata('userId') == "") {
            redirect('');
        }
        $this->active_user_id  = $login_user['userId'];
		/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
    }   

    public function index(){

        $data['notification_data'] = $this->user_notification_model->get_notification_with_id($this->active_user_id);
        $this->load->view('notification_block/index',$data);

    }
}    