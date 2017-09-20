<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_cars_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function fetch_cars_data($record) {
		if ($record['order_by']) {
			$this->db->order_by($record['order_by'], "asc");
		}

		if ($record['table_name'] == "urend_car_types") {
			$sel = "IF (category_image !='', concat('" . base_url('uploads') . "/', category_image),'') as category_image";
			$this->db->select("id , name  , $sel");
		}

		if ($record['table_name'] == "urend_car_country_list") {
			$sel = "IF (country_car_image !='', concat('" . base_url('uploads') . "/', country_car_image),'') as country_car_image";
			$this->db->select("id , country  , $sel");
		}
		$result = $this->db->get($record['table_name'])->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function fetch_city_list($record) {
		$this->db->order_by('city_name', "asc");
		$this->db->where('fk_country', $record['fk_country']);
		$result = $this->db->get('urend_car_city_list')->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function fetch_make_year_list($record) {
		$this->db->order_by('year', "asc");
		$this->db->where('make_id', $record['make_id']);
		$result = $this->db->get('urend_car_make_years')->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function fetch_car_model_list($record) {
		$make_id = $record['make_id'];

		$this->db->where('make_id', $make_id);
		$this->db->order_by('name', 'asc');
		$result = $this->db->get('urend_car_models')->result_array();
		if (!empty($result)) {
			return $result;
		}
	}

	public function get_all_country_city_list($user_id) {
		$query = $this->db->query("SELECT uccl.* , ucl.country as country_name ,
			IF (uccl.city_image!='', concat('" . base_url('uploads') . "/', uccl.city_image),'') as city_image
								FROM urend_car_city_list as uccl , urend_car_country_list as ucl
								WHERE ucl.id = uccl.fk_country
								             and uccl.id in (select city from urend_car_details where isActive = 1 and is_verified = 1 and fk_user_id != '$user_id')
								order by country_name , city_name");
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function get_all_report_text() {

		$query = $this->db->query("SELECT * FROM urend_car_report_type");
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function get_all_delete_text() {

		$query = $this->db->query("SELECT * FROM urend_car_delete_type");
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function save_car_data($data) {
		$data['availablity_modified'] = date('Y-m-d H:i:s');
		$this->db->insert('urend_car_details', $data);
		return $this->db->insert_id();
	}

	public function save_car_feature($car_id, $featur_id) {
		$data['fkCardId'] = $car_id;
		$data['fkFeaturesId'] = $featur_id;
		$data['createdDate'] = date("Y-m-d H:i:s");
		$this->db->insert('urend_car_features', $data);
	}

	public function save_car_images($car_id, $image) {
		$data['fkCarId'] = $car_id;
		$data['CarImage'] = $image;
		$data['createdDate'] = date("Y-m-d H:i:s");
		$this->db->insert('urend_car_images', $data);
	}

	public function get_car_feature($car_id = "") {
		$query = $this->db->query("SELECT ucf . * ,
                                         ucfm.features AS feature_name ,
					ucfm.greek_lang AS 	feature_name_greek				 
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
			return array();
		}
	}

	public function get_car_images($car_id = "") {
		$sel = "IF (urend_car_images.CarImage!='', concat('" . base_url('uploads') . "/', urend_car_images.CarImage),'') as CarImage_path";
		$this->db->select("* , $sel");
		$this->db->where('fkCarId', $car_id);
		$result = $this->db->get('urend_car_images')->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return array();
		}
	}

	public function get_single_car_data($car_id = "") {

		$query = $this->db->query("select  ucd.*,
				IF (ucd.insurance_file_front!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_front),'') as insurance_file_front_path ,
				IF (ucd.insurance_file_back!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_back),'') as insurance_file_back_path ,
                                    concat(uu.firstName,' ',uu.lastName) as get_username ,
				IF (uu.profileImage !='', concat('" . base_url('profileImages') . "/', uu.profileImage),'') as get_user_image ,
                                    (100 - (ucd.price_weekly*100)/(ucd.price_daily*7)) as discount_weekly ,
                                    (100 - (ucd.price_monthly*100)/(ucd.price_daily*30)) as discount_monthly,
                                     IFNULL( (SELECT avg( rating ) AS car_rating FROM urend_car_rating WHERE car_id = ucd.id ) , 0) AS car_rating,
                                     IFNULL( (SELECT count(id)  FROM urend_car_booking_master WHERE  car_id = ucd.id and pickup_confirmed = 1) , 0) AS total_car_trips,
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
                                    ucd.id  = '$car_id'
                                            ");

		$result = $query->row_array();

		if (!empty($result)) {
			$result['website_shareable_link'] = site_url('user/car_data/' . $result['id']);
			$result['get_model_name'] = $result['get_model_name']; //. " " . $this->get_car_year_with_car_model($result['model']);
			$result['car_features'] = $this->get_car_feature($result['id']);
			$result['car_images'] = $this->get_car_images($result['id']);
			$result['last_avail_string'] = get_last_availability_time_interval($result['availablity_modified']);
			return $result;
		} else {
			return array();
		}
	}

	public function fetch_user_car_data($data) {
		$fk_user_id = $data['fk_user_id'];
		$query = $this->db->query("select  ucd.*,
				IF (ucd.insurance_file_front!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_front),'') as insurance_file_front_path ,
				IF (ucd.insurance_file_back!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_back),'') as insurance_file_back_path ,
                                    concat(uu.firstName,' ',uu.lastName) as get_username ,
				IF (uu.profileImage !='', concat('" . base_url('profileImages') . "/', uu.profileImage),'') as get_user_image ,
                                    (100 - (ucd.price_weekly*100)/(ucd.price_daily*7)) as discount_weekly ,
                                    (100 - (ucd.price_monthly*100)/(ucd.price_daily*30)) as discount_monthly,
                                     IFNULL( (SELECT avg( rating ) AS car_rating FROM urend_car_rating WHERE car_id = ucd.id ) , 0.0) AS car_rating,
	                                IFNULL( (SELECT count(id)  FROM urend_car_booking_master WHERE  car_id = ucd.id and pickup_confirmed = 1) , 0) AS total_car_trips,
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
		//print_r($this->db->last_query());

		if (!empty($result)) {
			$return = array();
			foreach ($result as $r) {
				$r['website_shareable_link'] = site_url('user/car_data/' . $r['id']);
				$r['car_features'] = $this->get_car_feature($r['id']);
				$r['car_images'] = $this->get_car_images($r['id']);
				$r['get_model_name'] = $r['get_model_name']; //$r['get_model_name'] . " " . $this->get_car_year_with_car_model($r['model']);
				$r['last_avail_string'] = get_last_availability_time_interval($r['availablity_modified']);
				$return[] = $r;
			}
			return $return;
		} else {
			return array();
		}
	}

	public function delete_user_car($record) {
		$data = array('isActive' => '0');
		$this->db->where('id', $record['id']);
		$this->db->where('fk_user_id', $record['fk_user_id']);
		$this->db->update('urend_car_details', $data);
	}

	public function delete_user_car_image($record) {
		$this->db->where('id', $record['id']);
		$this->db->delete('urend_car_images');
	}

	public function update_basic_car_data($data) {
		/* get old data of this car */
		$old_data = $this->get_single_car_data($data['id']);
		/* check if availability is updated or not */

		if ($old_data['availablity'] != $data['availablity']) {
			$data['availablity_modified'] = date('Y-m-d H:i:s');
		}

		$this->db->where('id', $data['id']);
		$this->db->update('urend_car_details', $data);
	}

	public function get_car_year_with_car_model($car_model_id) {
		$query = $this->db->query("SELECT year FROM urend_car_make_years WHERE id = (select makeyear_id from urend_car_models where id = '$car_model_id')");
		$result = $query->row();

		return $result->year;
	}

	public function filter_car_data($filter_data) {
		$select = $where = $orderby = "";

		/* car brought year filter */
		if ($filter_data['min_car_brought_year'] < $filter_data['max_car_brought_year']) {
			$where .= " and ( ucd.car_brought_year >= '" . $filter_data['min_car_brought_year'] . "' AND ucd.car_brought_year <= '" . $filter_data['max_car_brought_year'] . "' )";
		}

		/* car daily price  filter */
		if ($filter_data['min_daily_price'] < $filter_data['max_daily_price']) {
			$where .= " and ( ucd.price_daily >= '" . $filter_data['min_daily_price'] . "' AND ucd.price_daily <= '" . $filter_data['max_daily_price'] . "' )";
		} elseif ($filter_data['min_daily_price'] == $filter_data['max_daily_price'] and $filter_data['max_daily_price'] == 15) {
			$where .= " and ( ucd.price_daily = '" . $filter_data['min_daily_price'] . "' )";
		}

		/* car  kmOrMilesValue  filter */
		if ($filter_data['min_kmOrMilesValue'] < $filter_data['max_kmOrMilesValue']) {
			$where .= " and ( ucd.kmOrMilesValue >= '" . $filter_data['min_kmOrMilesValue'] . "' AND ucd.kmOrMilesValue <= '" . $filter_data['max_kmOrMilesValue'] . "' )";
		}

		/* car deleivery charges  filter */
		if ($filter_data['deliveryOption'] == 1 && $filter_data['min_delivery_price'] < $filter_data['max_delivery_price']) {
			$where .= " and ( ucd.price >= '" . $filter_data['min_delivery_price'] . "' AND ucd.price <= '" . $filter_data['max_delivery_price'] . "' )";
			$where .= " and (ucd.deliveryOption = 1  )";
		}

		if ($filter_data['deliveryOption'] != "" && $filter_data['deliveryOption'] == 0) {
			$where .= " and (ucd.deliveryOption = 0  or ucd.deliveryOption =  1  )";
		}

		/* car  user id  filter */
		$where .= ($filter_data['user_id'] != "") ? "and (ucd.fk_user_id != '" . $filter_data['user_id'] . "') " : '';

		/* car  type filter */
		$where .= ($filter_data['type'] != "") ? "and (ucd.type = '" . $filter_data['type'] . "') " : '';

		/* car  country filter */
		$where .= ($filter_data['country'] != "") ? "and (ucd.country = '" . $filter_data['country'] . "') " : '';

		/* car city filter */

		$where .= ($filter_data['city'] != "") ? "and (ucd.city = '" . $filter_data['city'] . "') " : '';

		/* if($filter_data['find_lat']  !="" && $filter_data['find_lon'] !="" ){
		  $select = " , floor(((acos(sin((".$filter_data['find_lat']." *pi()/180)) * sin((ucd.carPickUpLat*pi()/180))+cos((".$filter_data['find_lat']." *pi()/180)) * cos((ucd.carPickUpLat*pi()/180)) * cos(((".$filter_data['find_lon']."- ucd.carPickUpLon)*pi()/180))))*180/pi())*60*1.1515*1.609344) as radius_distance ";
		  } */
		$city_string = trim(implode("','", explode(',', $filter_data['city_string'])));
		$city_string = ($city_string == "") ? "" : "'" . $city_string . "'";

		if ($city_string != "" && $filter_data['country_string'] != "" && $filter_data['find_lat'] != "" && $filter_data['find_lon'] != "") {

			$where .= " and (floor(((acos(sin((" . $filter_data['find_lat'] . " *pi()/180)) * sin((ucd.carPickUpLat*pi()/180))+cos((" . $filter_data['find_lat'] . " *pi()/180)) * cos((ucd.carPickUpLat*pi()/180)) * cos(((" . $filter_data['find_lon'] . "- ucd.carPickUpLon)*pi()/180))))*180/pi())*60*1.1515*1.609344) <=20  or (ucctl.city_name in  (" . $city_string . ") and (uccl.country = '" . $filter_data['country_string'] . "')  ) )  ";
		} elseif ($city_string == "" && $filter_data['country_string'] == "" && $filter_data['find_lat'] != "" && $filter_data['find_lon'] != "") {

			$where .= " and (floor(((acos(sin((" . $filter_data['find_lat'] . " *pi()/180)) * sin((ucd.carPickUpLat*pi()/180))+cos((" . $filter_data['find_lat'] . " *pi()/180)) * cos((ucd.carPickUpLat*pi()/180)) * cos(((" . $filter_data['find_lon'] . "- ucd.carPickUpLon)*pi()/180))))*180/pi())*60*1.1515*1.609344) <=20 )  ";
		} elseif ($city_string != "" && ($filter_data['find_lat'] == "" or $filter_data['find_lon'] == "")) {
			$where .= "and (ucctl.city_name in  (" . $city_string . "))";
		} else {
			
		}



		/* car  Transmission  filter */
		$where .= ($filter_data['Transmission'] != "") ? "and (ucd.Transmission = '" . $filter_data['Transmission'] . "') " : '';


		/* car  maker  filter */
		$where .= ($filter_data['make'] != "") ? "and (ucd.make = '" . $filter_data['make'] . "') " : '';


		/* car  model  filter */
		$where .= ($filter_data['model'] != "") ? "and (ucd.model = '" . $filter_data['model'] . "') " : '';

		/* country string */
		//$where .= ($filter_data['country_string'] != "") ? "and (uccl.country = '" . $filter_data['country_string'] . "') " : '';

		/* city string */
		//$city_string = "'".implode("','", explode(',',$filter_data['city_string']))."'";
		//$where .= ($filter_data['city_string'] != "") ? "and (ucctl.city_name in  (" . $city_string . ")) " : '';

		if ($filter_data['from_time'] != "" && $filter_data['to_time'] != "") {
			$avail_where = "";
			$date_range = get_date_range($filter_data['from_time'], $filter_data['to_time']);
			if (count($date_range) <= 2) {
				$checker = 1;
				foreach ($date_range as $d) {
					if (is_week_day($d)) {
						$checker = 0;
					}
				}
				if ($checker == 1) {
					$avail_where .= " or (ucd.availablity = 2 )";
				}
			}


			if (count($date_range) <= 5) {
				$checker = 1;
				foreach ($date_range as $d) {
					if (!is_week_day($d)) {
						$checker = 0;
					}
				}
				if ($checker == 1) {
					$avail_where .= " or (ucd.availablity = 3 )";
				}
			}
			if (count($date_range) > 0) {
				$segment = implode(',', $date_range);
				$avail_where .= " or (ucd.availablity like '%$segment%'  )";
			}

			$where .="and (ucd.availablity =1 $avail_where )";
		}

		if ($filter_data['daily_price_order'] == 1) {
			$orderby = " order by  ucd.price_daily asc ";
		} elseif ($filter_data['daily_price_order'] == 0) {
			$orderby = " order by  ucd.price_daily desc ";
		}


		$query = $this->db->query("select  ucd.*,
				IF (ucd.insurance_file_front!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_front),'') as insurance_file_front_path ,
				IF (ucd.insurance_file_back!='', concat('" . base_url('uploads') . "/', ucd.insurance_file_back),'') as insurance_file_back_path ,
				                    				IF (uu.profileImage !='', concat('" . base_url('profileImages') . "/', uu.profileImage),'') as get_user_image ,
                                    concat(uu.firstName,' ',uu.lastName) as get_username ,
                                    IFNULL( (SELECT avg( rating ) AS car_rating FROM urend_car_rating WHERE car_id = ucd.id ) , 0) AS car_rating,
                                    IFNULL( (SELECT count(id)  FROM urend_car_booking_master WHERE  car_id = ucd.id and pickup_confirmed = 1) , 0) AS total_car_trips,
                                    uct.name as get_type_name,
                                    ucm.name as get_make_name,
                                    ucms.name as get_model_name,
                                    ucft.fuel_type as get_fuel_type_name,
                                    uctm.transmission as get_transmission_name,
                                    uccm.name as get_car_color,
                                    uccl.country as get_country,
                                    ucctl.city_name as get_city_name
                                    $select
                         	from      urend_car_details as ucd,
                                    urend_users as uu,
                                    urend_car_types as uct,
                                    urend_car_makes as ucm ,
                                    urend_car_models as ucms,
                                    urend_car_fuel_types as ucft,
                                    urend_car_transmission_master as uctm,
                                    urend_car_colour_master as uccm,
                                    urend_car_country_list as uccl,
                                    urend_car_city_list as ucctl 

                         Where      ucd.fk_user_id = uu.userId and
                                    ucd.type  = uct.id and
                                    ucd.make =ucm.id and
                                    ucd.model = ucms.id and
                                    ucd.fuelType = ucft.id and
                                    ucd.Transmission = uctm.id and
                                    ucd.color = uccm.id and
                                    ucd.country = uccl.id and
                                    ucd.city = ucctl.id and
                                    ucd.isActive = 1   and
				ucd.is_verified = 1 and 
				ucd.insuranceValidTill  > '" . $filter_data['from_time'] . "'  and 
				ucd.insuranceValidTill  > '" . $filter_data['to_time'] . "'      and
				ucd.id NOT IN ( SELECT distinct(car_id) as car_id
								FROM (

									SELECT car_id ,
					  CASE  WHEN ( unix_timestamp(STR_TO_DATE( car_from, '%Y-%m-%d %H:%i:%s' ))  > unix_timestamp(STR_TO_DATE( '" . $filter_data['to_time'] . "', '%Y-%m-%d %H:%i:%s' ))
								  || unix_timestamp(STR_TO_DATE( '" . $filter_data['from_time'] . "', '%Y-%m-%d %H:%i:%s' )) > unix_timestamp(STR_TO_DATE(  car_to , '%Y-%m-%d %H:%i:%s' ))
								  || unix_timestamp(STR_TO_DATE( '" . $filter_data['to_time'] . "', '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE( '" . $filter_data['from_time'] . "', '%Y-%m-%d %H:%i:%s' ))
								  || unix_timestamp(STR_TO_DATE(  car_to, '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE(  car_from, '%Y-%m-%d %H:%i:%s' ))
								)  THEN 0
					  ELSE 1 END as intersect_time
					FROM urend_car_booking_master
					WHERE state = '1'
					HAVING intersect_time =  1
								) AS v )	
			         $where group by ucd.id $orderby
                                    ");
		$result = $query->result_array();
		$return = array();
		/*
		 *  for testing purposes
		 */
		//echo $this->db->last_query();
		//die;
		//$return['executable_query'] = $this->db->last_query();
		if (!empty($result)) {

			foreach ($result as $r) {
				$r['website_shareable_link'] = site_url('user/car_data/' . $r['id']);
				$r['car_features'] = $this->get_car_feature($r['id']);
				$r['car_images'] = $this->get_car_images($r['id']);
				$r['get_model_name'] = $r['get_model_name']; //. " " . $this->get_car_year_with_car_model($r['model']);
				$r['last_avail_string'] = get_last_availability_time_interval($r['availablity_modified']);
				$return[] = $r;
			}
			return $return;
		} else {
			return $return;
		}
	}

	public function book_car($data) {
		$data['creation_time'] = date("Y-m-d H:i:s");
		$this->db->insert('urend_car_booking_master', $data);

		return $this->db->insert_id();
	}

	/*
	 * this function is doing all work to add and to delete user favourite car
	 */

	public function make_user_favorite_car($user_id, $car_id, $status) {
		$this->db->where('user_id', $user_id);
		$this->db->where('car_id', $car_id);
		$result = $this->db->get('urend_car_user_favourite')->row_array();
		if (count($result) > 0) {
			$data = array(
				'user_id' => $user_id,
				'car_id' => $car_id,
				'status' => $status,
			);
			$this->db->where('user_id', $user_id);
			$this->db->where('car_id', $car_id);
			$this->db->update('urend_car_user_favourite', $data);
		} else {
			$data = array(
				'user_id' => $user_id,
				'car_id' => $car_id,
				'status' => $status,
			);
			$this->db->insert('urend_car_user_favourite', $data);
		}
	}

	public function get_user_favourite_car($user_id) {

		$this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
		$result = $this->db->get('urend_car_user_favourite')->result_array();
		$return = array();
		foreach ($result as $rs) {
			$return[] = $this->get_single_car_data($rs['car_id']);
		}
		return $return;
	}

	public function save_car_report($data) {
		$data['creation_time'] = time();
		$this->db->insert('urend_car_reports', $data);
	}

	public function insert_delete_reason($data) {
		$data['creation_time'] = time();
		$this->db->insert('urend_car_deleted_reason', $data);
	}

	/*
	 * this function is used to check car number plate duplicasy in database so that
	 * case 1 : no one can add duplicate car number plate
	 * case 2 : while editing user can change the number plate
	 */

	public function check_car_number_plate_duplicate($car_plate, $car_id = "") {
		if ($car_id != "") {
			$this->db->where('id !=', $car_id);
		}
		$this->db->where('carPlateNumber', $car_plate);
		$result = $this->db->get('urend_car_details')->result_array();
		return (count($result) > 0 ) ? True : False;
	}

	public function get_car_booking_state($data) {

		return false;
	}

	/*
	 * MOST IMPORTANT FUNCTION OF CAR BOOKING
	 * EDIT CAREFULLY
	 */

	public function check_car_booking_time_intersection($record) {
		$var_from = $record['car_from'];
		$var_to = $record['car_to'];
		$car_id = $record['car_id'];

		$query = $this->db->query("SELECT * ,
												        CASE  WHEN ( unix_timestamp(STR_TO_DATE( car_from, '%Y-%m-%d %H:%i:%s' ))  > unix_timestamp(STR_TO_DATE( '$var_to', '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE( '$var_from', '%Y-%m-%d %H:%i:%s' )) > unix_timestamp(STR_TO_DATE(  car_to , '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE( '$var_to', '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE( '$var_from', '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE(  car_to, '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE(  car_from, '%Y-%m-%d %H:%i:%s' ))
												                    )  THEN 0
												         ELSE 1 END as intersect_time
		 			 									 		 FROM urend_car_booking_master
																 WHERE car_id = '$car_id'
                                 AND state = '1'
																 HAVING intersect_time =  1
																			 ");
		return $query->num_rows();
		//echo $this->db->last_query();
		//die;
	}

	public function get_booking_dates($record) {
		$var_from = $record['car_from'];
		$var_to = $record['car_to'];
		$car_id = $record['car_id'];

		$query = $this->db->query("SELECT car_from  , car_to ,
												        CASE  WHEN ( unix_timestamp(STR_TO_DATE( car_from, '%Y-%m-%d %H:%i:%s' ))  > unix_timestamp(STR_TO_DATE( '$var_to', '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE( '$var_from', '%Y-%m-%d %H:%i:%s' )) > unix_timestamp(STR_TO_DATE(  car_to , '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE( '$var_to', '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE( '$var_from', '%Y-%m-%d %H:%i:%s' ))
												                      || unix_timestamp(STR_TO_DATE(  car_to, '%Y-%m-%d %H:%i:%s' )) < unix_timestamp(STR_TO_DATE(  car_from, '%Y-%m-%d %H:%i:%s' ))
												                    )  THEN 0
												         ELSE 1 END as intersect_time
		 			 									 		 FROM urend_car_booking_master
																 WHERE car_id = '$car_id'
                                       AND state = '1'
																 HAVING intersect_time =  1
																			 ");
		return $query->result_array();
	}
	/*
	* Save car basic data 
	*/

	public function insert_basic_contract_info($data){
		$this->db->insert('car_contract_base_info', $data);
	}
	
	public function get_basic_contract_info($car_id){
		$this->db->where('car_id',$car_id);
		return $this->db->get('car_contract_base_info')->row_array();
	}
	
	public function update_basic_contract_info($data){
		$this->db->where('car_id',$data['car_id']);
		$this->db->update('car_contract_base_info', $data);
	}
}
