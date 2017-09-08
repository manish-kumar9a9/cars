<?php
if ($car_from > date('Y-m-d H:i:s') && $rejected_by_car_owner != 1 && $rejected_by_car_renter != 1 && $setting_show_reached_at_location_button['towards_renter'] != 1) {
	if ($booking_user_type == "owner") {
		?>
		<?php if ($accepted_car_owner == 0) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a href="<?php echo site_url('booking_auth/accept_request_by_owner'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('ACCEPT_REQUEST');?>
					</div>
				</a>
			</div>
		<?php }
		?>

		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<a data-toggle="modal" data-target="#cancel_request" href="#">
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
					<?php echo $this->lang->line('REJECT_REQUEST');?>
				</div>
			</a>
		</div>
		<?php
		if ($accepted_car_owner == 1) {
			?>
			<div class = "col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a target = "_blank" href = "<?php echo site_url('chat/online/' . $car_renter_id); ?>">
					<div class = "col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('CHAT');?>
					</div>
				</a>
			</div>
			<?php
		}
	}
	?>

	<?php
	if ($booking_user_type == "renter") {
		?>
		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<a data-toggle="modal" data-target="#cancel_request" href="#">
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
					<?php echo $this->lang->line('REJECT_REQUEST');?>
				</div>
			</a>
		</div>
		<?php
		if ($accepted_car_owner == 1) {
			$transaction_text = "";
			if (count($booking_renter_transaction) > 0 && array_key_exists('transaction_id', $booking_renter_transaction) && $booking_renter_transaction['transaction_id'] != "") {
				$transaction_text = "* Payment done for this booking . ( Transaction id " . $booking_renter_transaction['transaction_id'] . " )";
			} else {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a data-toggle="modal" data-target="#proceed_to_pay" href="#">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('PAY_BOOKING_AMOUNT');?>
						</div>
					</a>
				</div>
				<?php
			}
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a target="_blank" href="<?php echo site_url('chat/online/' . $car_user_id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('CHAT');?>
					</div>
				</a>
			</div>
			<?php
			echo '<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12">' . $transaction_text . '</div>';
		}
	}
}

/* * **************************************  car pickup transaction  action start here  ************************************************* */
if ($setting_show_reached_at_location_button['towards_renter'] == 1 && $accepted_car_owner == 1 && $pickup_confirmed != 1) {
	if ($booking_user_type == "owner") {
		if (array_key_exists('car_owner_reached_at_location', $towards_renter_action) != True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a href="<?php echo site_url('booking_auth/reached_at_location_pickup'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('REACHED_AT_LOCATION');?>
					</div>
				</a>
			</div>
			<?php if (array_key_exists('owner_requesting_time_delay', $towards_renter_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/notify_about_delay'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NOTIFY_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		if (array_key_exists('car_owner_reached_at_location', $towards_renter_action) == True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<button class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green fill_form_element" ><?php echo $this->lang->line('FILL_DETAILS');?></button>
			</div>
			<?php if (array_key_exists('non_show_renter', $towards_renter_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/user_has_delay'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('RENTER_HAS_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php if ($setting_show_non_show_user_for_termination['towards_renter']['to_owner'] == 1) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/non_show_user'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NON_SHOW_RENTER');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		?>


		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<a  target="_blank" href="<?php echo site_url('chat/online/' . $car_renter_id); ?>">
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
					<?php echo $this->lang->line('CHAT');?>
				</div>
			</a>
		</div>

		<?php
	}
	if ($booking_user_type == "renter") {
		if (array_key_exists('car_renter_reached_at_location', $towards_renter_action) != True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a href="<?php echo site_url('booking_auth/reached_at_location_pickup'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('REACHED_AT_LOCATION');?>
					</div>
				</a>
			</div>
			<?php if (array_key_exists('renter_requesting_time_delay', $towards_renter_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/notify_about_delay'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NOTIFY_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		if (array_key_exists('car_renter_reached_at_location', $towards_renter_action) == True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<button class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green fill_form_element" ><?php echo $this->lang->line('FILL_DETAILS');?></button>
			</div>
			<?php if (array_key_exists('non_show_owner', $towards_renter_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/user_has_delay'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('OWNER_HAS_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>

			<?php if ($setting_show_non_show_user_for_termination['towards_renter']['to_renter'] == 1) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/non_show_user'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NON_SHOW_OWNER');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		?>


		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<a target="_blank" href="<?php echo site_url('chat/online/' . $car_user_id); ?>">
				<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
					<?php echo $this->lang->line('CHAT');?>
				</div>
			</a>
		</div>

		<?php
	}
	?>

	<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
		<a data-toggle="modal" data-target="#cancel_request" href="#">
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
				<?php echo $this->lang->line('REJECT_REQUEST');?>
			</div>
		</a>
	</div>

	<?php
}
/* * **************************************  car pickup transaction  action end  here  ************************************************* */
?>
