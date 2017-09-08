<?php
$this->load->view('header');
$this->load->view('include/account_header');


?>

<div id="account_wrapper">
	<div class="container">
		<div class="row margin-top-20">
			<div class="col-sm-3 col-md-3 margin-top-20">
				<ul class="nav nav-tabs nav-stacked">
					<li><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
					<li><a href='<?php echo site_url('notification') ?>'>Notifications (2)</a></li>
					<li><a href='#'>My Rentals (120)</a></li>
					<li><a href='<?php echo site_url('request/received') ?>'>Rental Requests (4)</a></li>
					<li><a href='<?php echo site_url('request/current_booking') ?>'>Bookings (1)</a></li>
					<li><a href='<?php echo site_url('user/reviews') ?>'>Reviews (48)</a></li>
					<li class="active gradient_filter"><a href='<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>'><?php echo $this->lang->line('PROFILE');?></a></li>
					<li><a href='<?php echo site_url('account_information/index') ?>'>Account Settings</a></li>
					<li><a href='<?php echo base_url() ?>index.php/user/logout'>Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-9 col-md-9">
				<?php
				// Get Flash data on view
				if ($this->session->flashdata('page_error') != "") {
					echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
				}
				?>
				<form id="profileForm" class="col-xs-12 margin-top no-padding">

					<div class="col-xs-12 no-padding">
						<div class="col-xs-4 no-padding">
							<h3>About Me</h3>
						</div>
						<div class="col-xs-8 no-padding margin-top-20 text-right">
							<div id="edit_profile" class="edit ">edit</div>
						</div>
					</div>

					<div class="clr"></div>


					<div class="col-xs-12 no-padding" id="txtabout">
						<textarea class="form-control" placeholder="Add your about me information. Maximum 500 characters"
									  style="border:0" rows="4"><?php echo $user_data['about_user']; ?></textarea>
					</div>
					<div class="col-xs-4 no-padding text-right pull-right " id="upload_profile">
						<label class="btn btn-default btn-file text-right" style="background: none; border: 0; display: none;">
							<input id="imgInp" type="file" >
							<img id="img-upload-placeholder" src="<?php echo base_url(); ?>assets/image/editphoto.png"/>
							<img id="img-upload" class="profile-pic" style="display: none;height: 90px;width: 90px;"/>
						</label>
					</div>

					<div class="clr"></div>
					<div class="col-xs-12 no-padding">
						<div class="col-xs-4 no-padding ">
							<h3>My Cars</h3>
						</div>
					</div>

					<div class="clr"></div>
					<?php foreach ($car_list as $cd) { ?>
						<a href="<?php echo site_url('user/edit_car/' . $cd['id']) ?>">
							<div class="carpanel col-sm-6 margin-top-20">
								<div>
									<img src="<?php echo (isset($cd['car_images'][0]['CarImage_path'])) ? $cd['car_images'][0]['CarImage_path'] : ''; ?>"/>
									<div class="info">
										<div class="col-xs-9">
											<div class="title"><?php echo $cd['get_make_name'] . ' ' . $cd['get_model_name']; ?></div>
											<div><?php echo $cd['cubicCapacity'] . ', ' . $cd['doors'] . ', ' . $cd['get_fuel_type_name'] ?></div>
										</div>
										<div class="col-xs-3 text-right">
											<div
												class="col-md-12 price no-padding">&euro;<?php echo $cd['price_daily']; ?></div>
											<div
												class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY'); ?></div>
										</div>
									</div>
								</div>
							</div>
						</a>
					<?php } ?>
					<a href="<?php echo site_url('user/add_car/') ?>">
						<div class="carpanel col-sm-6 margin-top-20">
							<img src="<?php echo base_url(); ?>assets/image/addCar.png"/>
						</div>
					</a>

					<div class="clr"></div>
					<div class="col-md-12">
						<div class="row">
							<input class="col-xs-12 col-sm-3 button margin-top-20 cancel" type='button' value="<?php echo $this->lang->line('CANCEL'); ?>"  style="margin-right: 10px">
							<a href='<?php echo site_url('user/profile_preview') ?>'>
								<input class="col-xs-12 col-sm-4 col-sm-offset-1 button margin-top-20 cancel" type='button' value="<?php echo $this->lang->line('PREVIEW'); ?>"  style="margin-right: 10px; background: #dcdcdc; color:#126fe4">
							</a>
							<input class="col-xs-12 col-sm-4 col-sm-offset-1 button gradient_filter margin-top-20" type='submit' value="<?php echo $this->lang->line('SAVE'); ?>">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->