<?php

$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */
$this->load->view('web_user/user_side_bar', array("user_data" => $user_data));
?>
<?php $this->session->set_userdata('user_id', $user_id);?>
<div class="col-sm-9">
	<section class="panel">
		<header class="panel-heading">
			USER  BOOKING LIST
			<span class="tools pull-right">
				<a href="javascript:;" class="fa fa-chevron-down"></a>
				<a href="javascript:;" class="fa fa-times"></a>
			</span>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="user-all-booking-grid">
					<thead>
						<tr>
							<th>Car Plate  </th>
							<th>Car Owner </th>
							<th>Car Renter</th>
							<th> Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<thead class="">
						<tr>
							<th><input type="text" data-column="0" style="max-width:100px"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="1" style="max-width:100px" class="form-control search-input-text"></th>
							<th><input type="text" data-column="2"  style="max-width:100px" class="form-control search-input-text"></th>
							<th> <select class="form-control search-input-select" data-column="3">
									<option value="">All</option>
									<option value="0">New</option>
									<option value="1">Current</option>
									<option value="2">Complete</option>
								</select>
							</th>	  
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</section>
</div>

<?php
$adminurl = AUTH_PANEL_URL;
$custum_js = <<<EOD
              <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
              <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
               <script type="text/javascript" language="javascript" >

                   jQuery(document).ready(function() {
                       var table = 'user-all-booking-grid';
                       var dataTable = jQuery("#"+table).DataTable( {
                           "processing": true,
                           "serverSide": true,
                           /*"order": [[ 3, "desc" ]],*/
                           "ajax":{
                               url :"$adminurl"+"web_user/ajax_get_user_all_booking", // json datasource
                               type: "post",  // method  , by default get
                               error: function(){  // error handling
                                   jQuery("."+table+"-error").html("");
                                   jQuery("#"+table+"_processing").css("display","none");
                               }
                           }
                       } );
                       jQuery("#"+table+"_filter").css("display","none");
                       $('.search-input-text').on( 'keyup click', function () {   // for text boxes
                           var i =$(this).attr('data-column');  // getting column index
                           var v =$(this).val();  // getting search input value
                           dataTable.columns(i).search(v).draw();
                       } );
	
			$('.search-input-select').on( 'change', function () {   // for select box
			   var i =$(this).attr('data-column');
			   var v =$(this).val();
			   dataTable.columns(i).search(v).draw();
		   } );
                   } );
               </script>

EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
