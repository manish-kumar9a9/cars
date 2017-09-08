<section class="panel">
	<header class="panel-heading">
		Social Login Settings
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post">
			<div class="form-group">
				<label for="facebook_app_id">Facebook App id</label>
				<input class="form-control" id="facebook_app_id" value="<?php echo get_web_meta_data('facebook_app_id');?>"  placeholder="Enter facebook app id" name="facebook_app_id" type="text">
			</div>
			<div class="form-group">
				<label for="facebook_secret_key">Facebook Secret Key</label>
				<input class="form-control" id="facebook_secret_key" value="<?php echo get_web_meta_data('facebook_secret_key');?>"  placeholder="Enter facebook secret key" name="facebook_secret_key" type="text">
			</div>
			<div class="form-group">
				<label for="google_app_id">Google App id</label>
				<input class="form-control" id="google_app_id" value="<?php echo get_web_meta_data('google_app_id');?>"  placeholder="Enter google app id" name="google_app_id" type="text">
			</div>
			<div class="form-group">
				<label for="google_secret_key">Google Secret Key</label>
				<input class="form-control" id="google_secret_key" value="<?php echo get_web_meta_data('google_secret_key');?>"  placeholder="Enter google secret key" name="google_secret_key" type="text">
			</div>
			<div class="form-group">
				<label for="google_client_id">Google Client Key</label>
				<input class="form-control" id="google_client_id" value="<?php echo get_web_meta_data('google_client_id');?>"  placeholder="Enter google client id" name="google_client_id" type="text">
			</div>

			<button type="submit" class="btn btn-info">Submit</button>
		</form>

	</div>
</section>

