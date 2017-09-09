<script src="<?php echo base_url() ?>auth_panel_assets/js/alertfy.min.js" ></script>
<!-- include a theme, can be included into the core instead of 2 separate files -->
<link rel="stylesheet" href="<?php echo base_url() ?>auth_panel_assets/css/alert-themes/alertify.core.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>auth_panel_assets/css/alert-themes/alertify.default.css" />
<?php //print_r($ter); ?>

<div class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">
			FEATURED CAR(s) LIST
			<span class="tools pull-right">
				<a href="javascript:;" class="fa fa-chevron-down"></a>
				<a href="javascript:;" class="fa fa-times"></a>
			</span>
			<span class="pull-right"> <button onClick="makeBulkFeatures()" class="btn btn-info btn-xs">Make
					Feature</button></span>

		</header>
		<div class="panel-body">
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="approved-grid">
					<thead>
						<tr>
							<th><input id="chk-allselect" type="checkbox" ></th>
							<th>Owner Name</th>
							<th>Car Plate Number</th>
							<th>Make</th>
							<th>Model</th>
							<!--<th>Insured value</th>-->
							<th>Action </th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($ter as $row){ ?>
						<tr>
							<td style="padding: 10px !important;"><input value="<?php echo $row->id?>" id="car-<?php echo $row->id?>"
																		 class="car-chk"
							type="checkbox" ></td>
							<td style="padding: 10px !important;"><?php echo $row->user_name ?></td>
							<td style="padding: 10px !important;"><?php echo $row->carPlateNumber ?></td>
							<td style="padding: 10px !important;"><?php echo $row->maker ?></td>
							<td style="padding: 10px !important;"><?php echo $row->model ?></td>
							<td style="padding: 10px !important;">
								<span id="acn-col-<?php echo $row->id ?>">
									<?php if($row->featured == 1): ?>
										<button onClick="makeFeatures(<?php echo $row->id ?>, true)" class="btn
										btn-success
										btn-xs">Featured</button>
									<?php else: ?>
										<button onClick="makeFeatures(<?php echo $row->id ?>, false)" class="btn
										btn-danger
											btn-xs">Make Feature</button>
									<?php endif; ?>
								</span>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					<!--<thead>
						<tr>
							<th><input type="text" data-column="0"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="1"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="2"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="3"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="4"  class="form-control search-input-text"></th>
							<th><input type="text" data-column="5"  class="form-control search-input-text"></th>
							<th></th>
						</tr>
					</thead>-->
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
		   var table = 'approved-grid';
		   var dataTable = jQuery("#"+table).DataTable( {});
	   });
	  
	  function makeBulkFeatures(){
		  var featured = [];
		  $.each($("input[class='car-chk']:checked"), function(){            
				featured.push($(this).val());
		  });
		  //console.log(featured);
		  if(featured.length > 0 ){
		  	 $.ajax({
				url: "$adminurl"+"car/make_bulk_feature",
				type: 'POST',
				data: {
					key: featured
				},
				//dataType: 'json',
				success: function(data) {
					alertify.success("Success");
					console.log('daasasd');
					console.log(data);
				}
			});
			window.location.reload();

		  }else{
		   	alertify.error("Please select at least on record!");
		   	return false;
		  }
	  }
	  
	  function makeFeatures(id, status){
		 var fhtmldata  = '<button onClick="makeFeatures('+id+', true)" class="btn btn-success btn-xs">Featured</button>';
		 var mkhtmldata  = '<button onClick="makeFeatures('+id+', false)" class="btn btn-danger	btn-xs">Make Featured</button>';
		 $.ajax({
			url: "$adminurl"+"car/make_feature",
			type: 'POST',
			data: {
				key: id
			},
			//dataType: 'json',
			success: function(data) {
				
				var element = '#acn-col-'+ id;
				if(status){
					$(element).html(mkhtmldata);
				}else{
					$(element).html(fhtmldata);
				}
				alertify.success("Success");
				console.log('daasasd');
				console.log(data);
			}
		});
	  }
	</script>
EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
