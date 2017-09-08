<?php
/* * **************************************  car dropoff  transaction  action start here  ************************************************* */
if ($setting_show_reached_at_location_button['towards_owner'] == 1 && $accepted_car_owner == 1 && $pickup_confirmed == 1) {
	if ($booking_user_type == "owner") {
		if (array_key_exists('car_owner_reached_at_location', $towards_owner_action) != True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a href="<?php echo site_url('booking_auth/reached_at_location_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('REACHED_AT_LOCATION');?>
					</div>
				</a>
			</div>
			<?php if (array_key_exists('owner_requesting_time_delay', $towards_owner_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/notify_about_delay_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NOTIFY_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		if (array_key_exists('car_owner_reached_at_location', $towards_owner_action) == True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<button class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green fill_form_element" ><?php echo $this->lang->line('FILL_DETAILS');?></button>
			</div>
			<?php if (array_key_exists('non_show_renter', $towards_owner_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/user_has_delay_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('RENTER_HAS_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php if ($setting_show_non_show_user_for_termination['towards_owner']['to_owner'] == 1) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/non_show_user_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
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
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
				<a  target="_blank" href="<?php echo site_url('chat/online/' . $car_renter_id); ?>">
					<?php echo $this->lang->line('CHAT');?>
				</a>
			</div>
		</div>
		<?php if (array_key_exists('owner_claim_for_car', $towards_owner_action) == false || $towards_owner_action['owner_claim_for_car'] == "") {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<button class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green claim_form_element" >Claim</button>
			</div>
		<?php }
		?>


		<?php
	}
	if ($booking_user_type == "renter") {
		if (array_key_exists('car_renter_reached_at_location', $towards_owner_action) != True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<a href="<?php echo site_url('booking_auth/reached_at_location_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
					<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
						<?php echo $this->lang->line('REACHED_AT_LOCATION');?>
					</div>
				</a>
			</div>
			<?php if (array_key_exists('renter_requesting_time_delay', $towards_owner_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/notify_about_delay_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('NOTIFY_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>
			<?php
		}
		if (array_key_exists('car_renter_reached_at_location', $towards_owner_action) == True) {
			?>
			<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
				<button class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green fill_form_element" ><?php echo $this->lang->line('FILL_DETAILS');?></button>
			</div>
			<?php if (array_key_exists('non_show_owner', $towards_owner_action) != True) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/user_has_delay_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
							<?php echo $this->lang->line('OWNER_HAS_DELAY');?>
						</div>
					</a>
				</div>
			<?php }
			?>

			<?php if ($setting_show_non_show_user_for_termination['towards_owner']['to_renter'] == 1) {
				?>
				<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
					<a href="<?php echo site_url('booking_auth/non_show_user_dropoff'); ?>?booking_id=<?php echo $id; ?>&id_tokken=<?php echo id_hasher($id); ?>">
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
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
				<a  target="_blank" href="<?php echo site_url('chat/online/' . $car_user_id); ?>">
					<?php echo $this->lang->line('CHAT');?>
				</a>
			</div>
		</div>		
		<?php
	}
}elseif ($setting_show_reached_at_location_button['towards_owner'] != 1 && $accepted_car_owner == 1 && $pickup_confirmed == 1) {
	if ($booking_user_type == "owner") {
		?>

		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
				<a  target="_blank" href="<?php echo site_url('chat/online/' . $car_renter_id); ?>">
					<?php echo $this->lang->line('CHAT');?>
				</a>
			</div>
		</div>
		<?php		
	}
	if ($booking_user_type == "renter") {
		?>
		<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 text-center">
			<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 text-center theme-btn theme-btn-green">
				<a  target="_blank" href="<?php echo site_url('chat/online/' . $car_user_id); ?>">
					<?php echo $this->lang->line('CHAT');?>
				</a>
			</div>
		</div>		
		<?php		
	}
}
/* * **************************************  car dropoff transaction  action end  here  ************************************************* */
?>
