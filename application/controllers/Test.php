<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller
{

    public function  index(){
         $option = array(
           'is_json'=> true ,
           'url'=> site_url() . '/service_get_single_car_data' ,
           'data'=> $params = array('id' => 1)
         );
         $data = get_data_with_curl($option);
         pre($data);
    }


}
