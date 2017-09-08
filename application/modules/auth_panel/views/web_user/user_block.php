<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
?>

<aside class="profile-nav col-lg-3">
	<section class="panel">
		<div class="user-heading round">
			<a href="#">
				<img src="<?php echo $user_data['user_image']; ?>" alt="">
			</a>
			<h1><?php echo $user_data['firstName'] . ' ' . $user_data['lastName']; ?></h1>
			<p><?php echo $user_data['email']; ?></p>
			<div class="">
				<span class="">
					<?php genrate_star_html($user_data['user_rating'], "fa-lg  "); ?>
				</span>
			</div>
		</div>

		<ul class="nav nav-pills nav-stacked nav-collapse">
			<li class="active"><a href="<?php echo AUTH_PANEL_URL . 'web_user/user_profile/' . $user_id; ?>"> <i class="fa fa-user"></i> Profile</a></li>
			<li><a href="<?php echo AUTH_PANEL_URL . 'web_user/edit_profile/' . $user_id; ?>"> <i class="fa fa-edit"></i> Edit profile</a></li>
			<li><a href="<?php echo AUTH_PANEL_URL . 'web_user/user_listed_cars/' . $user_id; ?>"> <i class="fa  fa-truck"></i> Listed car(s)</a></li>
			<li><a href="<?php echo AUTH_PANEL_URL . 'web_user/user_document_data/' . $user_id; ?>"> <i class="fa  fa-file"></i> Document info</a></li>
			<li><a href="<?php echo AUTH_PANEL_URL . 'web_user/user_block/' . $user_id; ?>"> <i class="fa  fa-file"></i> User Blocking</a></li>
		</ul>
	</section>
</aside>

<aside class="profile-info col-lg-9">
	<section class="panel">
		<div class="panel-body bio-graph-info">
			<h1>Are you sure to perform this action ?</h1>
			<form class="form-horizontal" method="post" action="" role="form">
				<div class="form-group">
					<input class="form-control btn btn-danger" id="f-name" name="id"  value = "<?php echo$user_id; ?>" type="hidden">
					<input class="form-control btn btn-danger" id="f-name" name="userStatus"  value = "<?php echo $user_data['userStatus']; ?>" type="hidden">
					<label class="col-lg-2 control-label"></label>
					<div class="col-lg-4">
						<input class="btn btn-danger" id="f-name" <?php
					if ($user_data['userStatus'] == 0) {
						echo 'value = "Block  User"';
					} else {
						echo 'value = "Unblock User"';
					}
					?> type="submit">
					</div>
				</div>
			</form>
		</div>
	</section>
</aside>
