<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/* language changer */
		$lang = $this->input->cookie('lang');
		$this->lang->load('master', $lang);
	}

	public function index() {
		$this->load->model('UserModel');
		$this->load->model('CarModel');
		$data['country'] = $this->UserModel->get_country_code();
		$temp = [];
		$result= $this->CarModel->get_featured_car();
		foreach ($result as $row)
		{
			$temp[$row->id] = $row;
		}
		//$data['featured_cars'] = $temp;
		
		$ftot = ceil(count($temp)/6);
		$featuredTemp = [];
		for($i=0; $i < $ftot ; $i++)
        {
        	$j=0;
            foreach ($temp as $key=> $car)
            {
                if($j == 6){break;}
                $featuredTemp[$i][] = $car;
                unset($temp[$key]);
                $j++;

            }
        }
        $data['featured_cars'] = $featuredTemp;
        $data['total_featured_car'] = $ftot;
        //owners list
        $owners= $this->CarModel->get_owner_list();
        $ownertemp = [];
        foreach ($owners as $owner)
        {
            $ownertemp[$owner->fk_user_id] = $owner;
        }
        $beaktemp = [];
        $tot =  ceil(count($owners)/4);
        for($i=0; $i < $tot ; $i++)
        {
            $j=0;
            foreach ($owners as $key=> $owner)
            {
                if($j == 4){break;}
                $beaktemp[$i][] = $owner;
                unset($owners[$key]);
                $j++;

            }
        }
        //print_r($beaktemp); die();
        $data['owners'] = $ownertemp;
        $data['breaks'] = $beaktemp;

		//log_message('info', "7777777777777777777777777777777temp >> ".gettype($temp));

		$this->load->view('index', $data);
	}

	public function test() {

		$this->load->model('UserModel');
		$data['country'] = $this->UserModel->get_country_code();
		$this->load->view('welcome_message', $data);
	}

	public function testwa() {
		$this->load->library('mango_pay');
		$data['AuthorId'] =  "18189664";
		$data['DebitedWalletId'] = "18189671";
		$data['DebitedFunds']['Amount'] = 10*100;
		$data['Fees']['Amount'] = 2*100;
		$data['MeanOfPaymentDetails']['BankAccountId'] = "19064204";
		$return =  $this->mango_pay->payout_to_bank($data);
		// save to project  server 
		//pre($return->id);	
		$this->load->model('user_cars_booking_model');
		$return = $this->mango_pay->get_payout_view($return->Id );
		$insert = array(
			"booking_id"=>"1",
			"user_id"=>"2",
			"user_type"=>"renter",
			"transaction_id"=>$return->Id,
			"status" =>$return->Status
		);
		$this->user_cars_booking_model->insert_transaction($insert);
		
		pre($return);
	}

	

}
