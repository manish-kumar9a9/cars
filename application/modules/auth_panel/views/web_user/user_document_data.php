<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */
$this->load->view('web_user/user_side_bar' ,array("user_data"=>$user_data) ); 

?>


<?php
/*
 * GET USER DOCUMENT INFORMATION
 */
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_get_user_document_info',
	'data' => array('user_id' => $user_id)
);

$result = get_data_with_curl($option);
$document_data = $result['Result'];
$this->load->helper('decrypt_image_helper');
?>
<?php if (count($document_data) > 0) { ?>
	<aside class="profile-info col-lg-9">
		<section class="panel">
			<div class="panel-body bio-graph-info">
				<h1> DOCUMENT Info</h1>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-lg-2 control-label">Name</label>
						<div class="col-lg-6">
							<input class="form-control" id="f-name" placeholder=" " value = "<?php echo $document_data['name']; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Gender</label>
						<div class="col-lg-6">
							<input class="form-control" id="gender" placeholder=" " value = "<?php echo ($document_data['gender'] == 0 ? 'Male' : 'Female'); ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">DL number</label>
						<div class="col-lg-6">
							<input class="form-control" id="dl_number" placeholder=" " value = "<?php echo $document_data['dl_number']; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">DL issue date</label>
						<div class="col-lg-6">
							<input class="form-control" id="dl_issue_date" placeholder=" " value = "<?php echo $document_data['dl_issue_date']; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">DL expiry date</label>
						<div class="col-lg-6">
							<input class="form-control" id="expiry_date" placeholder=" " value = "<?php echo $document_data['expiry_date']; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Submission time</label>
						<div class="col-lg-6">
							<input class="form-control" id="submission_time" placeholder=" " value = "<?php echo $document_data['submission_time']; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Id front</label>
						<div class="col-lg-6">
							<img width="304" height="236" src ="<?php echo encrypt_to_decrypt_img($document_data['id_front'], $document_data['encrpt_key']); ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Id back</label>
						<div class="col-lg-6">
							<img width="304" height="236" src ="<?php echo encrypt_to_decrypt_img($document_data['id_back'], $document_data['encrpt_key']); ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">License front</label>
						<div class="col-lg-6">
							<img width="304" height="236" src ="<?php echo encrypt_to_decrypt_img($document_data['license_front'], $document_data['encrpt_key']); ?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">License back</label>
						<div class="col-lg-6">
							<img width="304" height="236" src ="<?php echo encrypt_to_decrypt_img($document_data['license_back'], $document_data['encrpt_key']); ?>"/>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<?php if ($document_data['state'] == 0) { ?>
								<a href="<?php echo AUTH_PANEL_URL . 'web_user/approved/' . $user_id; ?>"><button type="button" class="btn btn-success">Approve</button></a>
								<a href="<?php echo AUTH_PANEL_URL . 'web_user/unapproved/' . $user_id; ?>"><button type="button" class="btn btn-danger">Disapprove</button></a>
							<?php } ?>

							<?php if ($document_data['state'] == 1) { ?>
								<a href="<?php echo AUTH_PANEL_URL . 'web_user/approvedboth/' . $user_id; ?>"><button type="button" class="btn btn-danger">Disapprove</button></a>
							<?php } ?>

							<?php if ($document_data['state'] == 2) { ?>
								<a href="<?php echo AUTH_PANEL_URL . 'web_user/approvedboth/' . $user_id; ?>"><button type="button" class="btn btn-success">Approve</button></a>
							<?php } ?>

						</div>
					</div>
				</form>
			</div>
		</section>
	</aside>
<?php
} else {
	echo "<h1>Document not uploaded by user.</h1>";
}
?>
