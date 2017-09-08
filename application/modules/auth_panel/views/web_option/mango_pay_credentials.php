<section class="panel">
	<header class="panel-heading">
		Mango Pay Settings
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post">
			<div class="form-group">
				<label for="mango_pay_Client_id">Mango pay Client id</label>
				<input class="form-control" id="mango_pay_Client_id" value="<?php echo get_web_meta_data('mango_pay_Client_id');?>"  placeholder="Enter mango pay Client id" name="mango_pay_Client_id" type="text">
			</div>
			<div class="form-group">
				<label for="mango_pay_passphrase">Mango pay Passphrase</label>
				<input class="form-control" id="mango_pay_passphrase" value="<?php echo get_web_meta_data('mango_pay_passphrase');?>"  placeholder="Enter mango pay Passphrase" name="mango_pay_passphrase" type="text">
			</div>
			<div class="form-group">
				<label for="mango_pay_password">Mango pay password</label>
				<input class="form-control" id="mango_pay_password" value="<?php echo get_web_meta_data('mango_pay_password');?>"  placeholder="Enter mango pay password" name="mango_pay_password" type="text">
			</div>
			<div class="form-group">
				<label for="mango_pay_email">Mango pay email</label>
				<input class="form-control" id="mango_pay_email" value="<?php echo get_web_meta_data('mango_pay_email');?>"  placeholder="Enter mango pay email" name="mango_pay_email" type="text">
			</div>
			<button type="submit" class="btn btn-info">Submit</button>
		</form>

	</div>
</section>

