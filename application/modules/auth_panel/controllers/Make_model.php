	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Make_model extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		*  admin panel initialization
		*  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		*/
		modules::run( 'auth_panel/auth_panel_ini/auth_ini');
    $this->load->library('form_validation','uploads');
		$this->load->model("car_make_model");
	}

  public function index(){
		$data['page_title'] = "Car List";
		$data['page_data']  = $this->load->view('make_model/car_makes_model_list','',TRUE);
		echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );

	}

  public function ajax_car_make_model_list(){
      // storing  request (ie, get/post) global array to a variable
      $requestData = $_REQUEST;
      $columns = array(
          // datatable column index  => database column name
          0 => 'car_model',
          1 => 'car_make'
      );

      $query = "SELECT count(id) as total
                FROM urend_car_models
                ";
      $query = $this->db->query($query);
      $query = $query->row_array();
      $totalData = (count($query)>0)?$query['total']:0;
      $totalFiltered =  $totalData;
      $sql = "SELECT urend_car_models.id, urend_car_models.name as car_model, urend_car_makes.name as car_make FROM urend_car_makes inner join urend_car_models
              on urend_car_models.make_id = urend_car_makes.id where 1=1 ";
      // getting records as per search parameters
       if( !empty($requestData['columns'][0]['search']['value']) ){   //name
        $sql.=" AND urend_car_models.name LIKE '".$requestData['columns'][0]['search']['value']."%' ";
        }
        if( !empty($requestData['columns'][1]['search']['value']) ){  //salary
        $sql.=" AND urend_car_makes.name LIKE '".$requestData['columns'][1]['search']['value']."%' ";
        }

      $query = $this->db->query($sql)->result();
      $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

      $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

      $result = $this->db->query($sql)->result();
      $data = array();
      foreach ($result as $r) {  // preparing an array
          $nestedData = array();

          $nestedData[] = $r->car_model;
          $nestedData[] = $r->car_make;
          $nestedData[] = "<a class='btn-sm btn btn-info' href='".AUTH_PANEL_URL."make_model/edit_car_make_model/".$r->id."'>Edit</a>&nbsp;";

          $data[] = $nestedData;
      }

      $json_data = array(
          "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
          "recordsTotal" => intval($totalData), // total number of records
          "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
          "data" => $data   // total data array
      );

      echo json_encode($json_data);  // send data as json format

  	}

		public function edit_car_make_model($id){
			$view_data['car_makers_name'] = $this->car_make_model->car_makers_name();
			if(!$this->input->post()){
				$view_data['edit_car_model'] =	$this->car_make_model->edit_car_make_model($id);
				$data['page_data']  = $this->load->view('make_model/edit_car_model',$view_data,TRUE);
				echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );
			}else{
					if($this->input->post()){
						if(!empty($this->input->post('name'))){
							$id       	=  $this->input->post('id');
							$maker     =  $this->input->post('maker');
							$name      =  $this->input->post('name');
							$this->form_validation->set_rules('name','name','trim|required');
							$validation_result = $this->validation_for_car_model($id,$maker,$name);

							 if($validation_result){
								 $this->session->set_flashdata('error_message','Car Model already exist');
								 redirect(AUTH_PANEL_URL.'make_model/edit_car_make_model/'.$id);
							 }else{
									 $update_array = array('name'=>$name,'make_id'=>$maker);;
									 $update_data = $this->car_make_model->update_car_model($update_array,$id);
									 if( $update_data == true){
											 $this->session->set_flashdata('success_message','Car Model has been Updated succssfully');
									 }else{
										 $this->session->set_flashdata('error_message','Car model not Updated');
									 }
							 }
							 redirect(AUTH_PANEL_URL.'make_model/index');
					 }else{
	 					$this->session->set_flashdata('error_message','Please enter the car model');
	 					redirect(AUTH_PANEL_URL.'make_model/edit_car_make_model/'.$id);
	 				}
				}
			}
		}
		public function add_car_maker_model(){
			$car_maker['car_makers_name'] = $this->car_make_model->car_makers_name();
			if(!$this->input->post()){
				$data['page_title'] = "Add car make";
				$data['page_data']  = $this->load->view('make_model/add_car_maker_model',$car_maker,TRUE);
				echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );
			}else{
					if($this->input->post()){
					  if(!empty($this->input->post('name'))){
							$maker      	=  $this->input->post('maker');
							$name       	=  $this->input->post('name');
							$id           = '';
						  $this->form_validation->set_rules('name','name','trim|required');
							$validation_result = $this->validation_for_car_model($id,$maker,$name);

							if($validation_result){
								$this->session->set_flashdata('error_message','Car maker already exist');
								redirect(AUTH_PANEL_URL.'make_model/add_car_maker_model');
							 }else{
									 $add_model_array = array('name'=>$name,'make_id'=>$maker);
									 $insert_data = $this->car_make_model->add_car_maker_model($add_model_array);
									 if( $insert_data == true){
											 $this->session->set_flashdata('success_message','Car maker has been create succssfully');
									 }else{
										 $this->session->set_flashdata('error_message','Car maker not create');
									 }
							 }
							 redirect(AUTH_PANEL_URL.'make_model/index');
					 }else{
						 $this->session->set_flashdata('error_message','Please enter the car model');
						 redirect(AUTH_PANEL_URL.'make_model/add_car_maker_model');
					 }
				 }
			}
		}

		private function validation_for_car_model($id,$marker,$model){
				$result = $this->car_make_model->validation_for_car_model($id,$marker,$model);
				return $result;
		}


		public function car_makes(){
			$data['page_title'] = "Car List";
			$data['page_data']  = $this->load->view('make_model/car_makes_list','',TRUE);
			echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );

		}

		public function ajax_car_makes_list(){
				// storing  request (ie, get/post) global array to a variable
				$requestData = $_REQUEST;
				$columns = array(
						// datatable column index  => database column name
						0 => 'name'
				);

				$query = "SELECT count(id) as total
									FROM urend_car_makes
									";
				$query = $this->db->query($query);
				$query = $query->row_array();
				$totalData = (count($query)>0)?$query['total']:0;
				$totalFiltered =  $totalData;
				$sql = "SELECT * FROM urend_car_makes where 1=1 ";
				// getting records as per search parameters
				 if( !empty($requestData['columns'][0]['search']['value']) ){   //name
					$sql.=" AND name LIKE '".$requestData['columns'][0]['search']['value']."%' ";
					}

				$query = $this->db->query($sql)->result();
				$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

				$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

				$result = $this->db->query($sql)->result();
				$data = array();
				foreach ($result as $r) {  // preparing an array
						$nestedData = array();

						$nestedData[] = $r->name;
						$nestedData[] = "<a class='btn-sm btn btn-info' href='".AUTH_PANEL_URL."make_model/edit_car_makes/".$r->id."'>Edit</a>&nbsp;";;

						$data[] = $nestedData;
				}

				$json_data = array(
						"draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
						"recordsTotal" => intval($totalData), // total number of records
						"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
						"data" => $data   // total data array
				);

				echo json_encode($json_data);  // send data as json format

			}

			public function edit_car_makes($id){
				if(!$this->input->post()){
					$view_data['edit_car_makes'] =	$this->car_make_model->edit_car_makes($id);
					$data['page_data']  = $this->load->view('make_model/edit_car_maker',$view_data,TRUE);
					echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );
				}else{
						if($this->input->post()){
							if(!empty($this->input->post('name'))){
								$form_validation = $this->form_validation->set_rules('name','name','required|trim');
								if($form_validation==false){

								}else{
									$id       	=  $this->input->post('id');
									$name       =  $this->input->post('name');
									$validation_result = $this->validation_for_car_maker($id,$name);
									if($validation_result){
										$this->session->set_flashdata('error_message','Car maker already exist');
										redirect(AUTH_PANEL_URL.'make_model/edit_car_makes/'.$id);
									 }else{
										 $update_array = array('name'=>$name);
										 $update_data = $this->car_make_model->update_car_makes($update_array,$id);
										if( $update_data == true){
												$this->session->set_flashdata('success_message','Car maker has been Updated succssfully');
										}else{
											$this->session->set_flashdata('error_message','Car maker not Updated');
										}
									 }
									 redirect(AUTH_PANEL_URL.'make_model/car_makes');
								}
						 }else{
							 $this->session->set_flashdata('error_message','Please enter the car maker');
							 redirect(AUTH_PANEL_URL.'make_model/edit_car_makes/'.$id);
						 }
					}
				}
			}
			public function add_car_maker(){
				if(!$this->input->post()){
					$data['page_title'] = "Add car make";
					$data['page_data']  = $this->load->view('make_model/add_car_maker','',TRUE);
					echo modules::run( AUTH_DEFAULT_TEMPLATE ,$data );
				}else{
						if($this->input->post()){
							if(!empty($this->input->post('name'))){
								 $this->form_validation->set_rules('name','Name','trim|required|is_unique[car_makes.name]');
								 if($this->form_validation->run()==False){
									 $this->session->set_flashdata('error_message','Car maker already exist');
									/* redirect(AUTH_PANEL_URL.'make_model/edit_car_makes/'.$id);*/
								 }else{
										 $name       =  $this->input->post('name');
										 $car_maker_array = array('name'=>$name);
										 $insert_data = $this->car_make_model->add_car_maker($car_maker_array);
										 if( $insert_data == true){
												 $this->session->set_flashdata('success_message','Car maker has been create succssfully');
										 }else{
											 $this->session->set_flashdata('error_message','Car maker not create');
										 }
								 }
								 redirect(AUTH_PANEL_URL.'make_model/car_makes');
							 }else{
								 $this->session->set_flashdata('error_message','Please enter the car maker');
								 redirect(AUTH_PANEL_URL.'make_model/add_car_maker');
						 	}
					}
				}
			}

			private function validation_for_car_maker($id,$maker){
					$result = $this->car_make_model->validation_for_car_maker($id,$maker);
					return $result;
			}


	}


	?>
