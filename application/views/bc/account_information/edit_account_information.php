
<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $this->session->userdata('userId')))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
//pre($user_data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">

        <style type="text/css">
            /* Custom container */

            .container-narrow {
                margin: 150px auto 50px auto;
                max-width: 728px;
            }
        </style>

        <style>
            .profile-setting-center{margin: auto;}
            .profile-setting-input{width:100%;height:45px;border:none;}
            tr.profile-setting-table{border:1px solid #000}
            .border-none{border:none}
            .edit-input{width: 100%;float:left; margin-bottom: 20px;}
            .edit-input-text{width: 100%;height: 41px;padding-left: 18px;margin-bottom: 20px;
                             -webkit-box-sizing: border-box;
                             -moz-box-sizing: border-box;
                             box-sizing: border-box;
            }
            .edit-input-countryCode{width: 10%;height: 41px;
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
            }
            .edit-submit{width: 30%;background-color: #00968a;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .cancel-submit{width: 30%;background-color: #171717;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .border-bottom{border-bottom: 1px solid #ccc !important;}

            .profile-sub-heading{
                padding-bottom: 15px;
                border-bottom: 2px solid #333;
                margin-bottom: 5px;
            }

            .profile-sub-section{
                margin-bottom: 40px;
            }

            .edit-feild{
                width: 30%;
                float:left;
            }

            .edit-feild h4{

                margin-top: 5px;
                font-size: 18px;
            }

            .edit-form-feild{
                width: 70%;
                float: left;
            }

            .full-width-new{
                width: 100% ;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding-bottom: 10px;
            }
        </style>


		<?php $this->load->view('include/head_block'); ?>

	<div class="container">

		<div class="profile-setting-center">
			<?php if ($this->input->get('edit') == 'first_name') { ?>
				<div class="edit-input">
					<h1><?php echo $this->lang->line('EDIT');?></h1>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}
					?>
					<form method="post" name="edit_first_name" action="<?php echo site_url('account_information/update_first_name'); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 no-padding">
							<label class="payment-label"><?php echo $this->lang->line('FIRST_NAME');?></label>
							<input type="text" name="first_name" value="<?php echo $user_data['firstName']; ?>" class="payment-form-input">
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding margin-right-10">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SAVE');?>">
							</div>

							<div class="col-new-lg-3  col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
							</div>
						</div>
					</form>
					<!--<div class="edit-feild">
						<h4><strong>Firstname</strong></h4>
					</div>

					<div class="edit-form-feild">
						<form method="post" action="<?php echo site_url('account_information/update_first_name'); ?>">
							<input type="text" name="first_name" value="<?php echo $user_data['firstName']; ?>" class="edit-input-text">

							<input type="submit" class="edit-submit" value="Save" name="submit">

							<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" class="cancel-submit" value="Cancel" name=""></a>
						</form>
					</div>-->
				</div>
			<?php } ?>
			<?php if ($this->input->get('edit') == 'last_name') { ?>
				<div class="edit-input">
					<h1><?php echo $this->lang->line('EDIT');?></h1>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}
					?>
					<form method="post" name="edit_last_name"  action="<?php echo site_url('account_information/update_last_name'); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 no-padding">
							<label class="payment-label"><?php echo $this->lang->line('LAST_NAME');?></label>
							<input type="text" name="last_name" value="<?php echo $user_data['lastName']; ?>" class="payment-form-input">
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding margin-right-10">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SAVE');?>">
							</div>

							<div class="col-new-lg-3  col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
							</div>
						</div>
					</form>
					<!--<div class="edit-feild">
						<h4><strong>Lastname</strong></h4>
					</div>

					<div class="edit-form-feild">
						<form method="post" action="<?php echo site_url('account_information/update_last_name'); ?>">
							<input type="text" name="last_name" value="<?php echo $user_data['lastName']; ?>" class="edit-input-text">

							<input type="submit" class="edit-submit" value="Save" name="submit">

							<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" class="cancel-submit" value="Cancel" name=""></a>
						</form>
					</div>-->
				</div>
			<?php } ?>

			<?php if ($this->input->get('edit') == 'email') { ?>
				<div class="edit-input">
					<h1><?php echo $this->lang->line('EDIT');?></h1>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}
					?>
					<form method="post" name="edit_email" action="<?php echo site_url('account_information/update_email'); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 no-padding">
							<label class="payment-label">Email</label>
							<input type="text" name="email" value="<?php echo $user_data['email']; ?>" class="payment-form-input">
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding margin-right-10">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SAVE');?>">
							</div>

							<div class="col-new-lg-3  col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
							</div>
						</div>
					</form>
					<!--<div class="edit-feild">
						<h4><strong>Email</strong></h4>
					</div>

					<div class="edit-form-feild">
						<form method="post" action="<?php echo site_url('account_information/update_email'); ?>">
							<input type="text" name="email" value="<?php echo $user_data['email']; ?>" class="edit-input-text">

							<input type="submit" class="edit-submit" value="Save" name="submit">

							<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" class="cancel-submit" value="Cancel" name=""></a>
						</form>
					</div>-->
				</div>
			<?php } ?>
			<?php if ($this->input->get('edit') == 'password') { ?>
				<div class="edit-input">
					<h1><?php echo $this->lang->line('EDIT');?></h1>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}
					?>
					<form method="post" name="edit_password" action="<?php echo site_url('account_information/update_password'); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 no-padding">
							<label class="payment-label">Password</label>
							<input type="text" name="password" class="payment-form-input">
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding margin-right-10">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="Save">
							</div>

							<div class="col-new-lg-3  col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="Cancel"></a>
							</div>
						</div>
					</form>
					<!--<div class="edit-feild">
						<h4><strong>Password</strong></h4>
					</div>

					<div class="edit-form-feild">
						<form method="post" action="<?php echo site_url('account_information/update_password'); ?>">
							<input type="text" name="password" value="" class="edit-input-text">

							<input type="submit" class="edit-submit" value="Save" name="submit">

							<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" class="cancel-submit" value="Cancel" name=""></a>
						</form>
					</div>-->
				</div>
			<?php } ?>
			<?php if ($this->input->get('edit') == 'notification') { ?>
				<div class="edit-input">
					<h1><?php echo $this->lang->line('EDIT');?></h1>
					<?php
					// Get Flash data on view 
					if ($this->session->flashdata('page_error') != "") {
						echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
					}
					?>
					<form method="post" name="edit_account" action="<?php echo site_url('account_information/update_notification'); ?>">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15 no-padding">

							<?php
							echo "<h3>Push  Notification</h3>";
							echo '<input disabled="disabled" type = "checkbox"  class = "edit-input-text" checked><lable class="radio-text">Push Request</lable></br>';
							echo '<input disabled="disabled" type = "checkbox"  class = "edit-input-text" checked><lable class="radio-text">Push Message</lable></br>';

							foreach ($user_data['user_settings'] as $notificaton_array) {

								if ($notificaton_array['setting_type'] == 'push_other') {
									?>
									<input  type = "checkbox" name = "push_other" value = "1" class = "edit-input-text"<?php
									if ($notificaton_array['state'] == "1") {
										echo "checked";
									}
									?>>
									<lable class="radio-text"> Other</lable></br>

									<?php
								}
							}
							echo "<h3>Email  Notification</h3>";
							echo '<input disabled="disabled" type = "checkbox"  class = "edit-input-text" checked><lable class="radio-text">Email Request</lable></br>';
							echo '<input disabled="disabled" type = "checkbox"  class = "edit-input-text" checked><lable class="radio-text">Email Message</lable></br>';
							foreach ($user_data['user_settings'] as $notificaton_array) {

								if ($notificaton_array['setting_type'] == 'email_other') {
									?>
									<input  type = "checkbox" name = "email_other" value = "1" class = "edit-input-text"<?php
									if ($notificaton_array['state'] == "1") {
										echo "checked";
									}
									?>>
									<lable class="radio-text"> Other</lable></br>

									<?php
								}
							}
							?>
						</div>
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
							<div class="col-new-lg-3 col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding margin-right-10">
								<input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="Save">
							</div>

							<div class="col-new-lg-3  col-new-md-3 col-new-sm-12 col-new-xs-12 no-padding">
								<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="Cancel"></a>
							</div>
						</div>
					</form>
					<!--<div class="edit-feild">
						<h4><strong>Notification </strong></h4>
					</div>

					<div class="edit-form-feild">
						<form method="post" id="Notification" action="<?php echo site_url('account_information/update_notification'); ?>">
					<?php
					foreach ($user_data['user_settings'] as $notificaton_array) {
						if ($notificaton_array['setting_type'] == 'chat_notification') {
							?>
																																					<h3>Mobile Notification</h3>
																																					<lable>Chat message</lable>
																																					<input type = "checkbox" name = "chat_notification" value = "1" class = "edit-input-text"<?php
							if ($notificaton_array['state'] == "1") {
								echo "checked";
							}
							?>></br>

																																					<h3>Email Notification</h3>
							<?php
						}

						if ($notificaton_array['setting_type'] == 'favourite_my_car') {
							?>
																																					<lable>When someone favourites my car</lable>
																																					<input type = "checkbox" name = "favourite_my_car" value = "1" class = "edit-input-text"<?php
							if ($notificaton_array['state'] == "1") {
								echo "checked";
							}
							?>></br>
							<?php
						}

						if ($notificaton_array['setting_type'] == 'remind_to_rate_trip') {
							?>
																																					<lable>Remind me to rate each trip</lable>
																																					<input type = "checkbox" name = "remind_to_rate_trip" value = "1" class = "edit-input-text"<?php
							if ($notificaton_array['state'] == "1") {
								echo "checked";
							}
							?>></br>
							<?php
						}

						if ($notificaton_array['setting_type'] == 'promotions_announcements') {
							?>
																																					<lable>Promotions and announcements</lable>
																																					<input type = "checkbox" name = "promotions_announcements" value = "1" class = "edit-input-text"<?php
							if ($notificaton_array['state'] == "1") {
								echo "checked";
							}
							?>></br>
							<?php
						}
					}
					?>
							<input type="submit" class="edit-submit" value="Save" name="submit">

							<a href="<?php echo site_url('account_information/index'); ?>"><input type="button" class="cancel-submit" value="Cancel" name=""></a>
						</form>
					</div>-->
				</div>
			<?php } ?>
			<h1><?php echo $this->lang->line('ACCOUNT_SETTINGS');?></h1>
			<?php
// Get Flash data on view 
			if ($this->session->flashdata('page_success') != "") {
				echo '<div><span class="success-alert clr">' . $this->session->flashdata('page_success') . '</span> </div>';
			}
			?>
			<div class="profile-sub-section">
				<h3 class="profile-sub-heading"><?php echo $this->lang->line('MAIN_SETTING');?></h3>
				<table width="100%" border="1" class="border-none" cellpadding="0" cellspacing="0">

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('FIRST_NAME');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><?php echo $user_data['firstName']; ?></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/index') ?>?edit=first_name"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

					<tr class="profile-setting-table">
						<td width="30%"  class="border-bottom border-none"><strong><?php echo $this->lang->line('LAST_NAME');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><?php echo $user_data['lastName']; ?></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/index') ?>?edit=last_name"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

					<tr class="profile-setting-table">
						<td width="30%"  class="border-bottom border-none"><strong><?php echo $this->lang->line('EMAIL');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><?php echo $user_data['email']; ?></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/index') ?>?edit=email"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>
					<?php if ($user_data['loginType'] == 0) { ?>
						<tr class="profile-setting-table">
							<td width="30%"  class="border-bottom border-none"><strong><?php echo $this->lang->line('PASSWORD');?> :</strong></td>
							<td width="60%" class="border-none border-bottom"><p>******</p></td>
							<td width="10%" class="border-none border-bottom" align="center">
								<a href="<?php echo site_url('account_information/index') ?>?edit=password"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							</td>
						</tr>
					<?php } ?>
					<tr class="profile-setting-table">
						<td width="30%" class="border-bottom border-none"><strong><?php echo $this->lang->line('PHONE');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><?php echo $user_data['countryCode'] . ' ' . $user_data['mobile']; ?></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/edit_phone_no') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>
				</table>
			</div>

			<div class="profile-sub-section">
				<h3 class="profile-sub-heading"><?php echo $this->lang->line('PAYMENT_SETTINGS');?></h3>
				<table width="100%" border="1" class="border-none" cellpadding="0" cellspacing="0">

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('PAYMENT_METHOD');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p>
								<span >	
									<?php if (count($card_exist) > 0) { ?>

										<?php echo $card_exist->Alias ?>
										<?php
									} else {
										echo '<p><span style="visibility:hidden">a</span></p>';
									}
									?>
								</span></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/add_card'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

				</table>

				<table width="100%" border="1" class="border-none" cellpadding="0" cellspacing="0">

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('BANK_ACCOUNT');?> :</strong></td>
						<td width="60%" class="border-none border-bottom">
							<p>&nbsp;</p>
						</td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('banking/iban'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

				</table>
			</div>

			<div class="profile-sub-section">
				<h3 class="profile-sub-heading"><?php echo $this->lang->line('LICENSE');?></h3>
				<table width="100%" border="1" class="border-none" cellpadding="0" cellspacing="0">

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('ID_VERIFICATION');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><span style="visibility:hidden">a</span></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('user/user_identity_verification');?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

				</table>
			</div>

			<div class="profile-sub-section">
				<h3 class="profile-sub-heading"><?php echo $this->lang->line('OTHER');?></h3>
				<table width="100%" border="1" class="border-none" cellpadding="0" cellspacing="0">

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('TRANSMISSION');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p>
								<?php
								if ($user_data['transmission_state'] == "1") {
									echo "Manual Transmission";
								} else if ($user_data['transmission_state'] == "2") {
									echo "Automatic Transmission";
								} else if ($user_data['transmission_state'] == "3") {
									echo "Semi automatic Transmission";
								}
								?></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/edit_transmission'); ?>?state=<?php echo $user_data['transmission_state']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

					<tr class="profile-setting-table">
						<td width="30%"  class="border-none border-bottom"><strong><?php echo $this->lang->line('NOTIFICATION_SETTING');?> :</strong></td>
						<td width="60%" class="border-none border-bottom"><p><span style="visibility:hidden">a</span></p></td>
						<td width="10%" class="border-none border-bottom" align="center">
							<a href="<?php echo site_url('account_information/index'); ?>?edit=notification"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

				</table>
			</div>

		</div>
	</div>



	<!--footers-->
	<?php $this->load->view('include/footer_block'); ?>
	<!--/footer-->


	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script>
        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /[a-z]+$/i.test(value);
        }, "Please enter only letter.");

        jQuery.validator.addMethod("email_validation", function (value, element) {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (value.match(mailformat))
            {
                return true;
            }
        }, "Please enter valid email.");
        // Wait for the DOM to be ready
        $(function () {
            $("form[name='edit_first_name']").validate({
                // Specify validation rules
                rules: {
                    first_name: {required: true, lettersonly: true}
                },
                // Specify validation error messages
                messages: {
                    first_name: {required: "Please enter your first name."}
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
        $(function () {
            $("form[name='edit_last_name']").validate({
                // Specify validation rules
                rules: {
                    last_name: {required: true, lettersonly: true}
                },
                // Specify validation error messages
                messages: {
                    last_name: {required: "Please enter your last name."}
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
        $(function () {
            $("form[name='edit_email']").validate({
                // Specify validation rules
                rules: {
                    email: {required: true, email_validation: true}
                },
                // Specify validation error messages
                messages: {
                    email: {required: "Please enter your email."}
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
        $(function () {
            $("form[name='edit_password']").validate({
                // Specify validation rules
                rules: {
                    password: "required"
                },
                // Specify validation error messages
                messages: {
                    password: "Please enter your password."
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
	</script>
</body>
</html>
