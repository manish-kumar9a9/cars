
<section class="panel">
	<header class="panel-heading">
		Terms and policy
	</header>
	<div class="panel-body">
		<?php 
		$lang= $this->input->get('lang');
		if($this->input->get('lang') == ""){
			$lang= "ENGLISH";
		}
		?>
		<form role="form" action="<?php echo AUTH_PANEL_URL ."web_option/terms_and_policy?lang=". $lang;?>" method="post">
			<!--wysihtml5 start-->
			<select class="" onChange="window.location.replace('<?php echo AUTH_PANEL_URL ."web_option/terms_and_policy?lang=";?>'+this.value);"  >
				<option value="ENGLISH" <?php if($lang == "ENGLISH"){ echo "selected='selected'";}?> >ENGLISH</option>
			<option value="GREEK" <?php if($lang == "GREEK"){ echo "selected='selected'";}?> >GREEK</option> 
			</select>
			<div class="form-group">
				<label class="address">Terms of service </label>
				<textarea id="element_terms" class="summernote form-control" name="<?php echo ($lang.'_terms_of_service');?>" rows="10"><?php echo get_web_meta_data ($lang.'_terms_of_service');?></textarea>
			</div>

			<!--wysihtml5 start-->
			<div class="form-group">
				<label class="address">Policy </label>
				<textarea id="element_policy" class="summernote form-control" name="<?php echo ($lang.'_policy');?>" rows="10"><?php echo get_web_meta_data ($lang.'_policy');?></textarea>
			</div>
			<button type="submit" class="btn btn-info">Save</button>
		</form>

	</div>
</section>
<?php

$adminurl = AUTH_PANEL_URL;
$auth_assets = AUTH_ASSETS;
$custum_js = <<<EOD
    <script src ="{$auth_assets}assets/ckeditor/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'element_terms');
	CKEDITOR.replace( 'element_policy');
    </script>
EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
