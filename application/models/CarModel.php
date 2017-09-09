<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CarModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function fetch_user_car_data($data)
    {
        $fk_user_id = $data['fk_user_id'];
        $query = $this->db->query("select  ucd.*,
                                    IF (ucd.insurance_file_front!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_front),'') as insurance_file_front_path ,
				IF (ucd.insurance_file_back!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_back),'') as insurance_file_back_path ,
                                    concat(uu.firstName,' ',uu.lastName) as get_username ,
                                    uct.name as get_type_name,
                                    ucm.name as get_make_name,
                                    ucms.name as get_model_name,
                                    ucft.fuel_type as get_fuel_type_name,
                                    uctm.transmission as get_transmission_name,
                                    uccm.name as get_car_color,
                                    uccl.country as get_country,
                                    ucctl.city_name as get_city_name
                    from  	urend_car_details as ucd,
                                    urend_users as uu,
                                    urend_car_types as uct,
                                    urend_car_makes as ucm ,
                                    urend_car_models as ucms,
                                    urend_car_fuel_types as ucft,
                                    urend_car_transmission_master as uctm,
                                    urend_car_colour_master as uccm,
                                    urend_car_country_list as uccl,
                                    urend_car_city_list as ucctl
                         Where 	ucd.fk_user_id = uu.userId and 
                                    ucd.type  = uct.id and 
                                    ucd.make =ucm.id and 
                                    ucd.model = ucms.id and 
                                    ucd.fuelType = ucft.id and 
                                    ucd.Transmission = uctm.id and 
                                    ucd.color = uccm.id and
                                    ucd.country = uccl.id and 
                                    ucd.city = ucctl.id and 
                                    ucd.fk_user_id  = '$fk_user_id' and 
                                    ucd.isActive = 1        
                                    ");

        $result = $query->result_array();

        if (!empty($result)) {
            $return = [];
            foreach ($result as $r) {
                $r['car_features'] = $this->get_car_feature($r['id']);
                $r['car_images'] = $this->get_car_images($r['id']);
                $return[] = $r;
            }
            return $return;
        } else {
            return [];
        }
    }

    public function get_car_feature($car_id = "")
    {
        $query = $this->db->query("SELECT ucf . * , 
                                         ucfm.features AS feature_name
                                    FROM urend_car_features AS ucf,
                                         urend_car_features_master AS ucfm
                                    WHERE 
                                         ucfm.id = ucf.fkFeaturesId and
                                         ucf.fkCardId = '$car_id'
                                    ");
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        } else {
            return [];
        }
    }

    public function get_car_images($car_id = "")
    {
        $sel = "IF (urend_car_images.CarImage!='', concat('" . base_url('uploads') . "/', urend_car_images.CarImage),'') as CarImage_path";
        $this->db->select("* , $sel");
        $this->db->where('fkCarId', $car_id);
        $result = $this->db->get('urend_car_images')->result_array();
        if (!empty($result)) {
            return $result;
        } else {
            return [];
        }
    }

    public function get_single_car_data($car_id = "")
    {

        $query = $this->db->query("select  ucd.*,
					IF (ucd.insurance_file_front!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_front),'') as insurance_file_front_path ,
					IF (ucd.insurance_file_back!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_back),'') as insurance_file_back_path ,
                                            concat(uu.firstName,' ',uu.lastName) as get_username ,
                                            uct.name as get_type_name,
                                            ucm.name as get_make_name,
                                            ucms.name as get_model_name,
                                            ucft.fuel_type as get_fuel_type_name,
                                            uctm.transmission as get_transmission_name,
                                            uccm.name as get_car_color,
                                            uccl.country as get_country,
                                            ucctl.city_name as get_city_name
                                from  	urend_car_details as ucd,
                                            urend_users as uu,
                                            urend_car_types as uct,
                                            urend_car_makes as ucm ,
                                            urend_car_models as ucms,
                                            urend_car_fuel_types as ucft,
                                            urend_car_transmission_master as uctm,
                                            urend_car_colour_master as uccm,
                                            urend_car_airbag_master as ucam,
                                            urend_car_country_list as uccl,
                                            urend_car_city_list as ucctl
                                 Where 	ucd.fk_user_id = uu.userId and 
                                            ucd.type  = uct.id and 
                                            ucd.make =ucm.id and 
                                            ucd.model = ucms.id and 
                                            ucd.fuelType = ucft.id and 
                                            ucd.Transmission = uctm.id and 
                                            ucd.color = uccm.id and
                                            ucd.country = uccl.id and 
                                            ucd.city = ucctl.id and 
                                            ucd.id  = '$car_id'
                                            ");

        $result = $query->row_array();
        if (!empty($result)) {
            $result['car_features'] = $this->get_car_feature($car_id);
            $result['car_images'] = $this->get_car_images($car_id);
            return $result;
        } else {

            return [];
        }
    }

    public function get_featured_car(){
//        $this->db->select('*');
//        $this->db->from('urend_car_details');
//        $this->db->limit(0,10);
//        $result = $this->db->get()->result();

        $result = $this->db->query("SELECT cd.id, price_daily, doors, cubicCapacity, make, model, fuelType, type,cm
        .name AS 
         modelnmae, cc.name AS company, ft.fuel_type as fuel, ct.name as category, ci.CarImage FROM urend_car_details AS cd JOIN
urend_car_models AS cm ON cd.model = cm.id JOIN 
urend_car_makes AS cc ON cd.make = cc.id JOIN
urend_car_fuel_types AS ft ON cd.fuelType = ft.id JOIN
urend_car_types AS ct ON cd.type = ct.id JOIN
urend_car_images AS ci ON cd.id = ci.fkCarId
WHERE cd.featured = 1;")->result();
        //price_daily doors cubicCapacity fuelType
        //join urend_car_models urend_car_type urend_car_makes

        return $result;
    }
}
