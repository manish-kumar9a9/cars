
<section class="panel">
	<header class="panel-heading">
		Edit FAQ 
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post">
            <input class="form-control" id="faq_id" value="<?php echo $user_data['faq_id']; ?>" name="faq_id" type="hidden">
			<div class="form-group">
				<label for="address">FAQ For</label>
				<select class="form-control input-sm m-bot15" id="faq_for"  name="faq_for">
					<option value="RENTER">Renter</option>
					<option value="OWNER">Owner</option>
				</select>
			</div>

			<div class="form-group">
				<label for="address">FAQ Type</label>
				<select class="form-control input-sm m-bot15" name="faq_type"  id="faq_type">
					<option value="GENERAL">General</option>
					<option>Option 2</option>
					<option>Option 3</option>
				</select>
			</div>

			<div class="form-group">
				<label for="address">FAQ Question</label>
				<input class="form-control" id="faq_question" value="<?php echo $user_data['faq_question']; ?>" name="faq_question" type="text">
			</div>
			<!--wysihtml5 start-->
			<div class="form-group">
				<label class="address">FAQ Answer</label>
				<textarea id="edit_editor" class="wysihtml5 form-control" name="faq_answer" rows="10"><?php echo $user_data['faq_answer']; ?></textarea>
			</div>
			<!--wysihtml5 end-->
			<button type="submit" class="btn btn-info">Update</button>
		</form>

	</div>
</section>

<?php
$adminurl = AUTH_PANEL_URL;
$auth_assets = AUTH_ASSETS;
$faq_for = $user_data['faq_for'];
$faq_type = $user_data['faq_type'];
$custum_js = <<<EOD

        <script src ="{$auth_assets}assets/ckeditor/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'edit_editor');
    </script>
<script>
	       jQuery('select[name=faq_for]').val('$faq_for');

     $("#faq_for").change(function () {
        var end = this.value;
        if(end =="OWNER"){
            $("#faq_type").html("<option value=\"GENERAL\">General</option>"
                                +"<option value=\"RENTAL_CONDITIONS\">Rental conditions</option>"
                                +"<option value=\"VEHICLE_UPLOAD\">Vehicle upload</option>"
                                +"<option value=\"MANAGING_BOOKINGS\">Managing bookings</option>"
                                +"<option value=\"HANDOVER_PROCESS\">Handover process</option>"
                                +"<option value=\"HANDBACK_PROCESS\">Handback process</option>"
                                +"<option value=\"PAYMENT_AND_FEES\">Payment and fees</option>"
                                +"<option value=\"INSURANCE_AND_SAFETY\">Insurance and safety</option>"
                                );
			
        }else if(end =="RENTER"){
            $("#faq_type").html("<option value=\"GENERAL_INFORMATION\">General Information</option>"
                                +"<option value=\"RENTAL CONDITIONS\">Rental conditions</option>"
                                +"<option value=\"MANAGING BOOKINGS\">Managing Bookings</option>"
                                +"<option value=\"HANDOVER_PROCESS\">Handover process</option>"
                                +"<option value=\"ACTIVE_RENTAL\">Active rental</option>"
                                +"<option value=\"HANDBACK_PROCESS\">Handback process</option>"
                                +"<option value=\"PAYMENT_AND_FEES\">Payment and fees</option>"
                                +"<option value=\"INSURANCE_AND_SAFETY\">Insurance and safety</option>"
                                +"<option value=\"MISCELLANEOUS\">Miscellaneous</option>"
                                );
			 
        }else{
            $("#faq_type").html('');
        }
    }).change();
 jQuery('select[name=faq_type]').val('$faq_type');
</script>
EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
