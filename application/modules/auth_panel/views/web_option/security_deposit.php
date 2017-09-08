<section class="panel">
	<header class="panel-heading">
		Security Deposit
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post" autocomplete="off">
			<div class="form-group">
				<label for="address">Security Deposit amount </label>
				<input class="form-control" id="security_deposit"  value="<?php echo get_web_meta_data('security_deposit'); ?>" placeholder="Enter value" name="security_deposit" type="text" />
			</div>
			<button type="submit" class="btn btn-info">Submit</button>
		</form>

	</div>
</section>