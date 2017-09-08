<section class="panel">
	<header class="panel-heading">
		Commission Rate
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post" autocomplete="off">
			<div class="form-group">
				<label for="address">Rate</label>
				<input class="form-control" id="commission_rate"  value="<?php echo get_web_meta_data('commission_rate'); ?>" placeholder="Enter value" name="commission_rate" type="text">
			</div>
			<button type="submit" class="btn btn-info">Submit</button>
		</form>

	</div>
</section>