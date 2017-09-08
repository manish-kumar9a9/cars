<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MX_Controller {

	function __construct() {
		parent::__construct();
		/* !!!!!! Warning !!!!!!!11
		 *  admin panel initialization
		 *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
		 */
		$this->load->helper('aul');
		modules::run('auth_panel/auth_panel_ini/auth_ini');
	}

	public function index() {
		$data['page_data'] = $this->load->view('transaction/transaction_view', array(), TRUE);
		echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
	}

	public function ajax_transaction_list() {
		// storing  request (ie, get/post) global array to a variable
		$requestData = $_REQUEST;

		$columns = array(
			// datatable column index  => database column name
			0 => 'booking_id',
			1 => 'booking_amount',
			2 => 'transaction_id',
			3=> 'status'
		);
		// getting total number records without any search
		//$this->db->where('isActive','1');
		$this->db->from('urend_booking_transaction');
		$totalData = $this->db->count_all_results();

		$totalFiltered = $totalData;

		$sql = "SELECT *, case urend_booking_transaction.status
					when '0' then 'Pay back'
					when '1' then 'Completed'
					end as status from urend_booking_transaction where 1=1 ";

		if (!empty($requestData['columns'][0]['search']['value'])) {   //name
			$sql.=" AND booking_id LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][1]['search']['value'])) {  //salary
			$sql.=" AND booking_amount LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if (!empty($requestData['columns'][2]['search']['value'])) {  //salary
			$sql.=" AND transaction_id LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
		}
		if ($requestData['columns'][3]['search']['value'] >= 0 && $requestData['columns'][3]['search']['value'] != "") {
			$sql.=" AND status LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
		}

		$query = $this->db->query($sql)->result();
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

		$sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length

		$result = $this->db->query($sql)->result();
		$data = array();

		foreach ($result as $r) {  // preparing an array
			$nestedData = array();

			$nestedData[] = "<a href='" . AUTH_PANEL_URL . "booking/booking/" . $r->booking_id . "'>" . $r->booking_id . "</a>";
			$nestedData[] = $r->booking_amount;
			$nestedData[] = $r->transaction_id;
			$nestedData[] = $r->status;
			$nestedData[] = date('Y-m-d H:i:s' , $r->creation_time ) ;
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

}
