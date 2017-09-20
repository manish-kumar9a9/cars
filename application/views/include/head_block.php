<?php 
	/* google analytics code */
	if(get_web_meta_data('google_analytics_active') == 1){ 
		echo get_web_meta_data('google_analytics_code');
	}
?>

</head>

<body class="wrapper" xmlns="http://www.w3.org/1999/html">

	<!--header-->
	<header class="header">
		<div class="inner">
			<div class="top-menu">
				<div class="top-left">

					<div class="top-logo"> <a href="<?php echo base_url(); ?>" id="logo"><img src="<?php echo base_url(); ?>assets/image/LOGO.png" ></a> </div>

					<div class="search-bar hide">
						<form>
							<input id="search-input" class="searchBar-input" title="Search" type="text" name="location" value="" placeholder="Where are you traveling?" autocomplete="off">
						</form>
					</div>
				</div>
				<div class="top-right">
					<div class="hide-menu" style="float: right">
						<div class="mobilemenu">
							<!-- Menu icon -->
							<div class="icon-close"> <img src="<?php echo base_url(); ?>assets/image/menu-close.png" class="close1"></div>
							<div class="icon-close2">
								<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/image/LOGO.png" class="close2"></a>
							</div>
							<?php
							$user_image = base_url() . "assets/image/profileicon.png";
							if ($this->session->userdata('profileImage') != "") {
								$user_image = base_url() . "profileImages/" . $this->session->userdata('profileImage');
							}
							?>
							<div class="sidemenu-login"><img src="<?php echo $user_image; ?>"></div>
							<div class="clr"></div>

							<!-- Menu -->
							<ul>
								<li><a class="text-uppercase"  href="<?php echo base_url() ?>index.php/user/find_car"><?php echo $this->lang->line('SEARCH_CARS');?></a></li>
								<?php
								if ($this->session->userdata('userId') == "") {
									?>
									<li> <a class="text-uppercase"  href="<?php echo site_url('user/pass_login'); ?>?url=<?php echo site_url('user/car_list'); ?>" ><?php echo $this->lang->line('LIST_A_CAR');?></a></li>
									<?php
								} else {
									?>
									<li> <a class="text-uppercase"  href="<?php echo base_url() ?>index.php/user/car_list" ><?php echo $this->lang->line('LIST_A_CAR');?></a></li>
									<?php
								}
								?>
								<li><a href="#">&nbsp;</a></li>
								<li><a class="text-uppercase"  href="#"><?php echo $this->lang->line('AVAILABLE_COUNTRIES');?></a></li>
								<li><a  class="text-uppercase" href="#"><?php echo $this->lang->line('ABOUT');?></a></li>
								<li><a href="">&nbsp;</a></li>
								<li><a href="<?php echo site_url(); ?>/help/index"><?php echo $this->lang->line('LEARN_MORE');?></a></li>
								<li><a href="<?php echo site_url(); ?>/terms_of_service/index"><?php echo $this->lang->line('TERMS_OF_SERVICE');?></a></li>
								<li><a href="<?php echo site_url(); ?>/policy/index"><?php echo $this->lang->line('POLICY');?></a></li>

								<li>
									<?php
									if ($this->session->userdata('userId') == "") {
										?>
										<a href="javascript:void(0)" class="login-popup"><?php echo $this->lang->line('LOGIN');?></a>
										<?php
									} else {
										?>
										<a href="<?php echo base_url() ?>index.php/user/logout" class=""><?php echo $this->lang->line('LOGOUT');?></a>
										<?php
									}
									?>


								</li>
							</ul>
						</div>
						<div class="jumbotronMobileMenu">
							<div class="icon-menu triggerMobileMenu"> <img src="<?php echo base_url(); ?>assets/image/mobmenu-icon.png"> </div>
						</div>
					</div>

					<ul>
						<li><a href="<?php echo base_url() ?>index.php/user/find_car"><?php echo $this->lang->line('SEARCH_CARS');?></a></li>
						<?php
						if ($this->session->userdata('userId') == "") {
							?>
							<li> <a  href="<?php echo site_url('user/pass_login'); ?>?url=<?php echo site_url('user/car_list'); ?>" ><?php echo $this->lang->line('LIST_A_CAR');?></a></li>
							<?php
						} else {
							?>
							<li> <a href="<?php echo base_url() ?>index.php/user/car_list" class=""><?php echo $this->lang->line('LIST_A_CAR');?></a></li>
							<?php
						}
						?>
						<li><a href="<?php echo site_url(); ?>/help/index"><?php echo $this->lang->line('LEARN_MORE');?></a></li>

						<?php
						if ($this->session->userdata('userId') == "" && $this->router->fetch_class() != "welcome") {
							?>
							<li><a href="<?php echo site_url('user/pass_login'); ?>" class="login-popup"><?php echo $this->lang->line('LOGIN');?></a></li>
							<?php
						} elseif ($this->session->userdata('userId') == "") {
							?>
							<li><a href="javascript:void(0)" class="login-popup"><?php echo $this->lang->line('LOGIN');?></a></li>
							<?php
						} else {
							?>
							<li>
								<div class="top-login">
									<a href="javascript:void(0)" class="dropbtn" onClick="toggleDropDown('myDropdown')">
										<img src="<?php echo $user_image; ?>">
									</a>
									<ul>
										<li class="dropdown">
											<div class="dropdown-content" id="myDropdown">
												<a href="<?php echo site_url('notification') ?>"><?php echo $this->lang->line('NOTIFICATIONS');?></a>
												<a href="<?php echo site_url('request/received') ?>"><?php echo $this->lang->line('RENTAL_REQUESTS');?></a>
												<a href="<?php echo site_url('request/current_booking') ?>"><?php echo $this->lang->line('BOOKINGS');?></a>
												<a href="<?php echo site_url('request/complete_booking') ?>"><?php echo $this->lang->line('BOOKING_HISTORY');?></a>
												<a href="<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>"><?php echo $this->lang->line('PROFILE');?></a>
												<a href="<?php echo site_url('account_information/index') ?>"><?php echo $this->lang->line('ACCOUNT');?></a>
												<a href="<?php echo site_url('user/logout') ?>"><?php echo $this->lang->line('LOGOUT');?></a>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<?php
						}
						?>
						<li>
														<div class="top-login subMenu">
								<a href="javascript:void(0)" class="dropbtn" onClick="toggleDropDown('myDropdownLang')">
										<?php  if( $this->input->cookie('lang') == "english" or  $this->input->cookie('lang') == "" ){ 
											echo "<span>EN</span>";
										 }else{ 
											echo "<span>GR</span>";	
										 } ?>
									
								</a>
								<ul>
									<li class="dropdown">
										<div class="dropdown-content" id="myDropdownLang">
											<a id="lang_selector" href="#" onclick="lang_changer('english');" 
											   <?php if( $this->input->cookie('lang') == "english" or  $this->input->cookie('lang') == "" ){ 
												echo "class='active'";  } ?>
											   >
												English <span>EN</span></a>
											<a href="#" onclick="lang_changer('greek');"
											   <?php if( $this->input->cookie('lang') == "greek" ){ 
												echo "class='active'";  } ?>
											   >Greek <span>GR</span></a>
											<!--<a href="#">Deutsch <span>DE</span></a>
											<a href="#">Francais <span>FR</span></a>-->
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li>
							<div class="top-login subMenu">
								<a href="javascript:void(0)" class="dropbtn" onClick="toggleDropDown('myDropdownMenu')">
									<img style="border: none;" src="<?php echo base_url(); ?>assets/image/mobmenu-icon.png">
								</a>
								<ul>
									<li class="dropdown">
										<div class="dropdown-content" id="myDropdownMenu">
											<a href="#">Menu Item 1</a>
											<a href="#">Menu Item 2</a>
											<a href="#" class="active">Menu Item 3</a>
											<a href="#">Menu Item 4</a>
										</div>
									</li>
								</ul>
							</div>
						</li>

					</ul>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</header>

	<style>
		.reminder_div{
			padding: 10px 2%;
			background: #08ae9e none repeat scroll 0 0;

		}
		.cookie_element_div{
			padding: 10px 2%;
			background: #000 none repeat scroll 0 0;	
		}
		.cookie_element{
			width:100%;
			text-align:center;
			color:white;
			font-size: 14px;
		}	
		.theme-hover:hover{
			color: #079284 ;
		}

		.reminder_div:hover {
			background: #079284 none repeat scroll 0 0;
		}
		.reminder_element{
			width:100%;
			text-align:center;
			color:white;
			font-size: 14px;
		}
		.text_underline{
			text-decoration: underline;
		}
	</style>
	<div class="cookie_element  " id="cookie_element_id">
		<div class="cookie_element_div"> <?php echo $this->lang->line('COOKIE_MESSAGE');?> 
			<a href="<?php echo site_url('policy/index'); ?>"> <span class="text_underline ralewaysemibold "><?php echo $this->lang->line('COOKIES');?></span></a> <a href="#" onclick="setCookie_reader();"><span class="pull-right theme-hover "><?php echo $this->lang->line('OK_GOT_IT');?></span></a> </div> 
	</div>	
	<?php
	if ($this->session->userdata('userId') !== "") {
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_get_user_pending_payment_records',
			'data' => array('user_id' => $this->session->userdata('userId'))
		);

		$result = get_data_with_curl($option);
		$pending_booking_data = $result['Result'];

		if (count($pending_booking_data) > 0) {
			?>	
			<div class="reminder_element  ">
				<div class="reminder_div"> <?php echo $this->lang->line('YOU_HAVE_PENDING_BOOKING');?> <a href="<?php echo site_url('booking_auth/booking/' . $pending_booking_data[0]['id']); ?>"><span class="text_underline ralewaysemibold "><?php echo $this->lang->line('CLICK_HERE_TO_PAY');?>.</span></a> </div> 
			</div>
		<?php } ?>

	<?php } ?>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=<?php//echo GOOGLE_MAP_API_KEY ; ?>&sensor=false&libraries=places"
    ></script> -->
	<script>
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function setCookie_reader() {
            var cname = "read_cookie_check";
            var cvalue = 1;
            var exdays = 30;
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            if (getCookie('read_cookie_check') == 1) {
                document.getElementById("cookie_element_id").style.display = 'none';
            }
        }
        if (getCookie('read_cookie_check') == 1) {
            document.getElementById("cookie_element_id").style.display = 'none';
        }
	</script>
