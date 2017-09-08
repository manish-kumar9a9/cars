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

<aside class="profile-info col-lg-9">
	<section class="panel">
		<?php if ($user_data['about_user'] != "") { ?>
			<div class="bio-graph-heading">
				<?php echo $user_data['about_user']; ?>
			</div>
		<?php } ?>

		<div class="panel-body bio-graph-info">
			<h1>Bio Graph
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>First Name </span>: <?php echo $user_data['firstName']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Last Name </span>: <?php echo $user_data['lastName']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Country </span>: <?php echo $user_data['country']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Email </span>: <?php echo $user_data['email']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Mobile </span>: (<?php echo $user_data['countryCode']; ?>) <?php echo $user_data['mobile']; ?></span></p>
				</div>
				<div class="bio-row">
					<p><span>Created Date</span>: <?php echo $user_data['createdAt']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>DOB</span>: <?php echo $user_data['dob']; ?></p>
				</div>

			</div>
		</div>
	</section>

	<?php
	$option = array(
		'is_json' => false,
		'url' => site_url() . '/service_account_info_with_user_id',
		'data' => array('user_id' => $user_id)
	);

	$result = get_data_with_curl($option);
	$account_data = $result['Result'];
	?>

	<section class="panel">
		<div class="panel-body">

			<?php
			if (count($account_data) > 0 && array_key_exists('card_id', $account_data) && $account_data['card_id'] != "") {
				?>
				<div class="alert alert-success alert-block fade in">
					<button type="button" class="close close-sm">
						<i class="fa fa-check"></i>
					</button>
					<h4>
						<i class="fa fa-check"></i>
						Credit Card !
					</h4>
					<p>User Credit Card information is available.</p>
				</div>				
			<?php }else{ ?>
				<div class="alert alert-danger alert-block fade in">
					<button type="button" class="close close-sm">
						<i class="fa fa-warning"></i>
					</button>
					<h4>
						<i class="fa fa-warning"></i>
						Credit Card !
					</h4>
					<p>User Credit Card information is not available.</p>
				</div>				
			<?php } ?>

			<?php
			if (count($account_data) > 0 && array_key_exists('banking_account_id' , $account_data) && $account_data['banking_account_id'] != "") {
				?>
				<div class="alert alert-success alert-block fade in">
					<button type="button" class="close close-sm">
						<i class="fa fa-check"></i>
					</button>
					<h4>
						<i class="fa fa-check"></i>
						Bank Account !
					</h4>
					<p>User Bank Account  information is available.</p>
				</div>				
			<?php }else{ ?>
				<div class="alert alert-danger alert-block fade in">
					<button type="button" class="close close-sm">
						<i class="fa fa-warning"></i>
					</button>
					<h4>
						<i class="fa fa-warning"></i>
						Bank Account !
					</h4>
					<p>User Bank Account  information is not available.</p>
				</div>				
			<?php } ?>

		</div>
	</section>
</aside>
