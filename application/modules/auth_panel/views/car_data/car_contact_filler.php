<?php
/* Fetch car detail start */
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_get_single_car_data',
	'data' => array('id' => $this->input->get('car_id'))
);

$result = get_data_with_curl($option);
$car_data = $result['Result'];
$user_id = $car_data['fk_user_id'];

/*  Fetch car detail end */
?>

<?php
/* fetch user detail start */
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */

$vehicle_maker = "";
if (count($car_saved_info) > 0) {
	
	$car_id =  $car_saved_info['car_id'];
	$firstname=  $car_saved_info['firstname'];
	$lastname =  $car_saved_info['lastname'];
	$fathername =  $car_saved_info['fathername'];
	$birthdate =  $car_saved_info['birthdate'];
	$sex =  $car_saved_info['sex'];
	$afm =  $car_saved_info['afm'];
	$street =  $car_saved_info['street'];
	$zip_code =  $car_saved_info['zip_code'];
	$telephone_number =  $car_saved_info['telephone_number'];
	$fax =  $car_saved_info['fax'];
	$email =  $car_saved_info['email'];
	$licence_plate =  $car_saved_info['licence_plate'];
	$street_no =  $car_saved_info['street_no'];
	$vehicle_model =  $car_saved_info['vehicle_model'];
	$vehicle_color =  $car_saved_info['vehicle_color'];
	$first_licence_date =  $car_saved_info['first_licence_date'];
	$insured_value =  $car_saved_info['insured_value'];
	$frame_number =  $car_saved_info['frame_number'];
	$vehicle_maker = $car_saved_info['vehicle_maker'];
} else {

	$firstname = $user_data['firstName'];
	$lastname = $user_data['lastName'];
	$birthdate = $user_data['dob'];
	$email = $user_data['email'];
	$licence_plate = $car_data['carPlateNumber'];

	$fathername =  "";
	$sex =  "";
	$afm =  "";
	$street =  "";
	$zip_code =  "";
	$telephone_number =  "";
	$fax =  "";
	$street_no =  "";
	$vehicle_model =  "";
	$vehicle_color =  "";
	$first_licence_date =  "";
	$insured_value =  "";
	$frame_number =  "";
	
}
$car_brought_year = $car_data['car_brought_year'];
?>

<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Basic Car Contract information
		</header>
		<div class="panel-body">
			<form autocomplete="off" name="contract_maker_base" role="form" method="post" action="">

				<input type="hidden" name="car_id" value="<?php echo $this->input->get('car_id'); ?>" >
				<div class="form-group col-md-12">
					<div class="form-group col-md-4">
						<label for="exampleInputfirstname">First Name </label>
						<input type="text" name="firstname"  class="form-control" value="<?php echo $firstname; ?>">
					</div>

					<div class="form-group  col-md-4 ">
						<label for="exampleInputlastname">Last Name </label>
						<input value="<?php echo $lastname; ?>"  type="text" name="lastname"  class="form-control">
					</div>
					<div class="form-group  col-md-4 ">
						<label for="exampleInputfathername">Father Name</label>
						<input value="<?php echo $fathername; ?>"  type="text" name="fathername"  class="form-control">
					</div>
				</div>
				<div class="form-group col-md-12">

					<div class="form-group  col-md-4">
						<label >Birth Date</label>
						<input placeholder="yyyy-mm-dd"  value="<?php echo $birthdate; ?>"  type="text" name="birthdate"   class="form-control dpd2">
					</div>
					<div class="form-group  col-md-4 ">
						<label >sex</label>
						<select class="form-control" name="sex">
							<option value="">--select--</option>
							<?php
							$gender_array = json_decode($base_data->gender_array);
							foreach ($gender_array as $ga) {
								echo "<option value='{$ga->code}'>{$ga->name}</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group  col-md-4">
						<label >Afm</label>
						<input value="<?php echo $afm; ?>"  type="text" name="afm"  class="form-control">
					</div>
				</div>	
				<div class="form-group col-md-12">
					<div class="form-group  col-md-4">
						<label >Street</label>
						<input value="<?php echo $street; ?>"   type="text" name="street"  class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label >Street no</label>
						<input value="<?php echo $street_no; ?>"  type="text" name="street_no"  class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label >zip code</label>
						<input value="<?php echo $zip_code; ?>"  type="text" name="zip_code"  class="form-control">
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="form-group col-md-4">
						<label >Telephone number</label>
						<input value="<?php echo $telephone_number; ?>"  type="text" name="telephone_number"  class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label >fax</label>
						<input value="<?php echo $fax; ?>"   type="text" name="fax"  class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label >Email address</label>
						<input value="<?php echo $email; ?>" type="email" name="email"  class="form-control">
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="form-group col-md-4">
						<label >Licence plate</label>
						<input value="<?php echo $licence_plate; ?>" type="text" name="licence_plate"  class="form-control">

					</div>
					<?php
					$h = file_get_contents('http://194.127.7.101/UnderwritingRulesWS/v1/vehiclebrands?username=urend&usage=000&hash=8e5f8e0c22db8cf7eeb9b40fb503dcd7');
					$h = json_decode($h);
					$list = $h[1]->data;
					$option = "";
					foreach ($list as $l) {
						$option .="<option vlaue='{$l->name}'>{$l->name}</option>";
					}
					?>
					<div class="form-group  col-md-2 ">
						<label >Maker</label>
						<select onchange=" get_model();" class="form-control" name="vehicle_maker">
							<option value="">--select--</option>
							<?php echo $option; ?>
						</select>
					</div>

					<div class="form-group col-md-2">
						<label >vehicle model</label>
						<select  class="form-control" name="vehicle_model">

						</select>
					</div>
					<div class="form-group col-md-4">
						<label >vehicle_color</label>
						<select class="form-control" name="vehicle_color">
							<option value="">--select color--</option>
							<?php
							$color_array = json_decode($base_data->color_array);
							foreach ($color_array as $ga) {
								echo "<option value='{$ga->code}'>{$ga->name}</option>";
							}
							?>
						</select>
					</div>					
				</div>	


				<div class="form-group col-md-12">

					<div class="form-group col-md-4">
						<label >First licence date</label>
						<input  value="<?php echo $first_licence_date; ?>"  type="text" placeholder="yyyy-mm-dd" name="first_licence_date"  class="form-control dpd2">
					</div>
					<div class="form-group col-md-4">
						<label >Insured value</label>
						<input value="<?php echo $insured_value; ?>"  type="text" name="insured_value"  class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label >Frame number</label>
						<input value="<?php echo $frame_number; ?>"  type="text" name="frame_number"  class="form-control">
					</div>
				</div>	
				<div class="form-group col-md-12">
					<button class="btn btn-info" name="basic_contract_filler" type="submit">Submit</button>
				</div>
			</form>
			<div class="col-md-12 text-center">
				<img src="<?php echo $car_data['insurance_file_front_path'] ;?>" class="img-responsive img-thumbnail">
				<img src="<?php echo $car_data['insurance_file_back_path'] ;?>" class="img-responsive img-thumbnail">
			</div>
		</div>
		
	</section>
</div>

<?php
$auth_assets = AUTH_ASSETS;
$adminurl = AUTH_PANEL_URL;
$custum_js = <<<EOD

<script type="text/javascript" src="{$auth_assets}assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{$auth_assets}js/advanced-form-components.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>
	
		jQuery.validator.addMethod("check_value", function (val, element) {
			var back = false;
			var val = element.value;
			$.ajax({
				url: "{$adminurl}car/check_car_insured",
				method: 'GET',
				async: false,
				dataType: 'json',
                                            data:{capital:val,year:'{$car_brought_year}' , carcode:$('select[name=vehicle_model]').val()},
                                            success: function (data) {
										
					if( data.result != undefined &&  data.result.code == '200' ){						
						back =   true;
						
					}else{
						alert(data.error.message);	
					}

                                            }
			});
			return back;
		}, "Insured value is not valid.");
	
            $(function () {
                $("form[name='contract_maker_base']").validate({
                    // Specify validation rules
		rules: {
			firstname: {required: true},
			lastname: {required: true},
			fathername: {required: true},
			birthdate: {required: true},
			sex:{required: true},
			vehicle_model:{required: true},
			insured_value:{required: true,digits: true,check_value:true},
			afm:{required: true},
			street:{required: true},
			street_no:{required: true},
			zip_code:{required: true},
			telephone_number:{required: true},
			email:{required: true,email:true},
			licence_plate:{required: true},
			vehicle_maker:{required: true},
			vehicle_model:{required: true},
			vehicle_color:{required: true},
			first_licence_date:{required: true},
			frame_number:{required: true}	
                    },
                    // Specify validation error messages
                    messages: {
			firstname: {required: "firstname is required."},
			lastname: {required: "lastname is required."},
			fathername: {required: "fathername is required."},
			birthdate: {required:"Birthdate  is required."},
			vehicle_model:{required: "Vehicle model  is required."},
			insured_value:{required: "Insured  value is required.",digits: "Only number allowed."}
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
	
	function get_model() {
		var maker =  $('select[name=vehicle_maker]').val();
		$.ajax({
		  url: "{$adminurl}car/get_car_model?year={$car_brought_year}&maker="+maker,
		  method: 'GET',
		  async: false,
		  success: function (data) {
			$('select[name=vehicle_model]').html("<option value=''>--Select Model-- </option>"+data);
		  }
		});
	}
	
	$('select[name="sex"]').val('{$sex}');
	$('select[name="vehicle_maker"]').val('{$vehicle_maker}');
	$('select[name="vehicle_color"]').val('{$vehicle_color}');
	$.when(get_model()).done(function () {
		console.log('reached');
                    $("select[name=vehicle_model]").val("{$vehicle_model}");
	});
</script>
EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>

