<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public $user_type            = "";
    public $active_user_id       = "";
    public $current_booking_id   = "";
    public $current_booking_data = "";

    public $transaction_mode     = "";

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        /* this model handle all transactions */
        $this->load->model('user_cars_booking_model');
        $this->load->model('user_model');
        $this->load->model('user_cars_model');

        $login_user  =  $this->session->userdata();  // pre($login_user );
        if ($this->session->userdata('userId') == "") {
            redirect('');
        }
        $this->active_user_id  = $login_user['userId'];

        // if get booking id to index function as query string save it in session and remove from url 
        if($this->input->get('booking_id')){
            $this->session->set_userdata(array('current_booking_id'=>$this->input->get('booking_id')));
        }

        $this->current_booking_id =  $this->session->userdata('current_booking_id');
        if(!isset($this->current_booking_id)){
            echo "you are at wrong place";
            die;           
        }
        /* check the user is car owner or renter */
        $this->current_booking_data = $booking_data = $this->get_single_request_data($this->current_booking_id); 
        
        if($booking_data['car_user_id'] == $this->active_user_id){
            $this->user_type = "car_owner";
        }elseif($booking_data['car_renter_id'] == $this->active_user_id){
            $this->user_type = "car_renter";
        }else{

            echo "you are at wrong place";
            die;
        }

        if($booking_data['pickup_confirmed'] == "1"){
            $this->transaction_mode = "towards_owner";
        }else{
            $this->transaction_mode = "towards_renter";
        }
    }
    

    public function index(){

        if($this->input->get('booking_id')){
            redirect('booking');
        }

        $data['current_booking_data'] = $this->current_booking_data;
        $data['request_watcher']      = $this->user_type;
        
        $this->load->view('booking_live_blocks/landing_page',$data);

    }

    /* 
    * status -: 101  // refresh the page 
    */



    public function sync_page(){
        if ($this->input->is_ajax_request()) {

            $booking_data = $this->get_single_request_data($this->session->userdata('current_booking_id'));
            $button_html  = "";
            
            if($this->transaction_mode == "towards_renter"){

                if($booking_data['accepted_car_owner'] != 1 && $this->user_type == "car_owner"){

                    $button_html .= "<button class='theme-btn-green theme-btn margin-left' type='submit' name='reached_at_location'> Accept Request </button>";
                }

                $booking_time = $booking_data['car_from'];
                $current_time  = date('Y-m-d H:i:s');
                $hour_diff     = round((strtotime($booking_time) - strtotime($current_time))/3600, 1);

                if($hour_diff < 1 && $current_time < $booking_time && $booking_data['accepted_car_owner'] == 1   ){

                    $button_html .= "<button class='theme-btn-green theme-btn margin-left' type='submit' name='reached_at_location'> Reached at location </button>";
                }



                $button_html .= "<a href='".site_url('booking/cancel_request')."'><button class='theme-btn-green theme-btn margin-left'  type='submit' name='cancel_request'> Cancel request </button></a>";
            }

            if($booking_data['rejected_by_car_owner'] == 1 || $booking_data['rejected_by_car_renter'] == 1 ){

                $button_html = "<div class='error-alert center'> REQUEST IS CANCELLED .</div>";

            }elseif($booking_data['accepted_car_owner'] == 0 && $booking_data['rejected_by_car_renter'] != 1 && $booking_data['rejected_by_car_owner'] != 1  && $booking_time < $current_time){

                $button_html = "<div class='error-alert center'> REQUEST IS EXPIRED .</div>";

            }

            echo json_encode(array("status"=>true,"html"=>$button_html));
            die;          
        }

        echo json_encode(array("status"=>101));
        die;          

    }

    private function get_single_request_data($id){

        $booking_data = $this->user_cars_booking_model->get_request_raw_data($id);
        $data = $booking_data;
        $data['car_details']     =  $this->user_cars_model->get_single_car_data($booking_data['car_id']);
        $data['car_owner_data']  =  $this->user_model->userProfile(array('userId' => $booking_data['car_user_id']));
        $data['car_renter_data'] =  $this->user_model->userProfile(array('userId' => $booking_data['car_renter_id']));

        return $data ; 
    }

    public function  cancel_request(){
        pre($this->current_booking_data['car_id']);
        if($this->user_type == "car_owner"){
            // owner cancel the request
            $request_para['car_id']      = $this->input->post('car_id');
            $request_para['car_user_id'] = $this->input->post('car_user_id');
            $request_para['id']          = $this->input->post('id');
            $this->user_cars_booking_model->reject_request_by_car_owner($request_para);
        }
        if($this->user_type == "car_renter"){
            // renter cancel the request

        }        

        redirect('booking');
    }

    public function accept_request(){

    }   

    public function reject_request(){

    } 


    /*
    * this send_push_to_user function is used to send  push notification to ios and android 
    */

    public function send_push_to_user($user_id ="" , $data =array()){

        /* get user id and make condition here */
        $user_data = $this->user_model->userProfile(array('userId' => $user_id ));
        $token = $device = "";

        if($user_data['deviceType'] == 1){
            $token = $user_data['deviceToken'];
            $device = "ios";
            generatePush($device , $token, $data);
        }
        if($user_data['deviceType'] == 0){
            $token = $user_data['deviceToken'];
            $device = "android";
            generatePush($device , $token, $data);
        }
    }

}