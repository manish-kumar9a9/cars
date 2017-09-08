<div class="clr"></div>
<footer>
	<div class="inner footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-3">
					<h4><?php echo $this->lang->line('COMPANY');?></h4>
					<ul>
						<li><a href="#"><?php echo $this->lang->line('ABOUT US');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('PRESS');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('JOBS');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('CONTACT');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('NEWS');?></a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-sm-3">
					<h4><?php echo $this->lang->line('RENTERS');?></h4>
					<ul>
						<li><a href="#"><?php echo $this->lang->line('SEARCH VEHICLES');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('HOW IT WORKS');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('SAFETY AND SECURITY');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('PRICES');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('FAQ');?></a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-sm-3">
					<h4><?php echo $this->lang->line('OWNERS');?></h4>
					<ul>
						<li><a href="#"><?php echo $this->lang->line('WHY_RENT');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('SIGN_UP');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('ADD_VEHICLE');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('INSURANCE');?></a></li>
						<li><a href="#"><?php echo $this->lang->line('FAQ');?></a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-sm-3">
					<h4><?php echo $this->lang->line('DOWNLOAD_APP');?></h4>
					<div class="row margin-top-20">
						<div class="col-xs-12 margin-bottom-20">
							<a href="#"><img src="<?php echo base_url(); ?>assets/image/AppleAppLogo.png"/></a>
						</div>
						<div class="col-xs-12">
							<a href="#"> <img src="<?php echo base_url(); ?>assets/image/GooglePlayLogo.png"/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="basefooter" >
	<div class="inner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-5">
					Urend 2017. <?php echo $this->lang->line('ALL_RIGHTS_RESERVED');?>
				</div>
				<div class="col-xs-12 col-sm-7 pull-right">
					<div class="col-xs-12 col-sm-3"><a href="#"><?php echo $this->lang->line('TERMS_OF_SERVICE');?></a></div>
					<div class="col-xs-12 col-sm-2"><a href="#"><?php echo $this->lang->line('PRIVACY');?></a></div>
					<div class="col-xs-12 col-sm-1"><a href="#"><?php echo $this->lang->line('COOKIES');?></a></div>
					<div class="col-xs-12 col-sm-6 pull-right text-right social-links ">
						<a  target="_blank" href="<?php echo get_web_meta_data('facebook_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/fb.png"></a>
						<a  target="_blank" href="<?php echo get_web_meta_data('twitter_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/Twitter.png"></a>
						<a  target="_blank" href="#"><img src="<?php echo base_url(); ?>assets/image/GooglePlus.png"></a>
						<a  target="_blank"  href="<?php echo get_web_meta_data('instagram_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/instagram.png"></a>
						<a  target="_blank" href="#"><img src="<?php echo base_url(); ?>assets/image/YouTube.png"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="//connect.facebook.net/en_US/all.js&appId=<?php echo get_web_meta_data('facebook_app_id'); ?>"></script>
<script type="text/javascript">
	window.fbAsyncInit = function () {
		FB.init({
			appId: <?php echo get_web_meta_data('facebook_app_id');  ?>, // replace your app id here
			channelUrl: '//WWW.YOUR_DOMAIN.COM/channel.html',
			status: true,
			cookie: true,
			xfbml: true,
			version: 'v2.2'
		});
	};
	(function (d) {
		var js, id = 'facebook-jssdk',
			ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement('script');
		js.id = id;
		js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));

	function FBLogin() {
		FB.login(function (response) {
			if (response.authResponse) {
				window.location.href = "<?php echo base_url('index.php/user/facebook_auth'); ?>?action=fblogin";
			}
		}, {
			scope: 'email,user_likes'
		});
	}
</script>

<!----------------------------------mobile-verification------------------------------------------------------->
<div id="mobile-verify" style="display:none">
	<div class="mob-verify-overlay"></div>
	<div class="mob-verify-light"><a href="javascript:void(0)" class="mob-verify-close">x</a>
		<h2><?php echo $this->lang->line('mobile_verification');?></h2>
		<div class="clr"></div>
		<div class="mob-verify-input">
			<div id="verify_mobile_msg" style="color:red;font-size: 18px; font-family: 'Gotham';" ></div><a href="javascript:void(0)" onClick="$('#mobile-verify').attr('style', 'display:none');" id="verify_login_link" style="display:none;" class=" login-popup">Log in</a>
			<input type="hidden"  id="verify-email" class="verify-mob">
			<input type="text" maxlength="4"  id="verify-mob" class="verify-mob"  value=""  placeholder="Type OTP">
			<div class="clr"></div>
		</div>
		<div class="mob-verify-submit">
			<input type="button" class="mob-verify1 gradient_filter" id="mob-verify-resend" value="<?php echo $this->lang->line('resend');?>">
			<input type="button" class="mob-verify2 gradient_filter" id="mob-verify-continue" value="<?php echo $this->lang->line('continue');?>">
			<div class="clr"></div>
		</div>
	</div>
</div>
<!----------------------------------/mobile-verification------------------------------------------------------->

<!----------------------------------forgot-password------------------------------------------------------->
<div id="forgot-pswd" style="display:none">
	<div class="forgot-pswd-overlay"></div>
	<div class="forgot-pswd-light"><a href="javascript:void(0)" class="forgot-pswd-close">x</a>
		<h2><?php echo $this->lang->line('forget_password');?></h2>
		<div class="clr"></div>
		<div  class="forgot-pswd-input">
			<div id="forget_msg" style="color:red;font-size: 18px; font-family: 'Gotham';"></div>
			<input type="text" name="fgt-email" id="fgt-email" class="fgt-email" placeholder= "E-mail" value="" >
			<div class="clr"></div>
		</div>
		<div class="forgot-pswd-submit">
			<input type="button" name="fgt-pswd" id="fgt-pswd" class="fgt-pswd gradient_filter" value="<?php echo $this->lang->line('submit');?>">

			<div class="clr"></div>
		</div>
	</div>
</div>
<!----------------------------------/forgot-password------------------------------------------------------->
<!----------------------------------login------------------------------------------------------->
<div id="login-form" style="display:none">
	<div class="login-overlay"></div>
	<div class="login-light"><a href="javascript:void(0)" class="login-close">x</a>
		<form id="user_login_form" action="<?php echo base_url(); ?>index.php/user/signIn" method="post">
			<h2><?php echo $this->lang->line('LOGIN');?> </h2>
			<div class="clr"></div>
			<p class="noaccount"><?php echo $this->lang->line('DONT_HAVE_ACCOUNT');?><a href="javascript:void(0)"  id='urend_mobile' class="signup-popup"> <?php echo $this->lang->line('SIGN_UP');?> </a>
			<div class="clr"></div>
			<div class="social-login">
				<a  onclick="FBLogin();" href="#"><img src="<?php echo base_url(); ?>assets/image/login-fb.png"> </a>
				<div class="clr"></div>
				<a onclick="location.href = '<?php echo base_url() . 'index.php/user/google_auth'; ?>'" href="#"><img src="<?php echo base_url(); ?>assets/image/login-g+.png"> </a>
			</div>
			<div class="clr"></div>

			<div class="or-login">
				<p><?php echo $this->lang->line('OR_USE_EMAIL');?></p>
			</div>
			<div class="clr"></div>
			<div class="login-input">
				<div id="login_msg" class="margin-bottom" ></div>
				<input type="text" name="email" id="user_email" class="email" placeholder="E-mail Address" value="" >
				<div class="clr"></div>
				<input type="password" name="password" id="user_password" class="password" placeholder="Password"  value="" >
				<div class="clr"></div>
				<a href="javascript:void(0)" id='urend_forgot'><?php echo $this->lang->line('FORGET_YOUR_PASSWORD');?> </a>
			</div>
			<div class="login-submit">
				<button type="submit" class="submit1 gradient_filter" id="user_login_bt"  > <?php echo $this->lang->line('LOGIN');?> </button>
			</div>
		</form>
	</div>
</div>
<!----------------------------------/login------------------------------------------------------->


<!----------------------------------signup------------------------------------------------------->
<div id="signup-form" style="display:none">
	<div class="signup-overlay"></div>
	<div class="signup-light"><a href="javascript:void(0)" class="signup-close">x</a>
		<form id="user_sign_form" action="#" method="" autocomplete="off"  >
			<h2><?php echo $this->lang->line('SIGN_UP');?></h2>
			<div class="clr"></div>
			<p><?php echo $this->lang->line('ALREADY_HAVE_ACCOUNT');?> <a href="javascript:void(0)" class="login-popup"><?php echo $this->lang->line('LOGIN');?> </a>
			<div class="clr"></div>
			<?php
			$login_temp = $this->session->flashdata('sign_up_data');
			$social_gid = $social_fbid = $social_type = $social_fname = $social_lname = $social_email = $social_profileImage = "";
			if (count($login_temp) > 0) {

				$social_gid = (isset($login_temp['gId'])) ? $login_temp['gId'] : "";
				$social_fbid = (isset($login_temp['fbId'])) ? $login_temp['fbId'] : "";

				$s = explode(" ", $login_temp['firstName']);
				$social_fname = $s[0];
				$s[0] = "";
				$social_lname = implode(" ", $s);

				$social_type = $login_temp['loginType'];
				$social_email = $login_temp['email'];
				$social_profileImage = $login_temp['profileImage'];
			} else {
				?>
				<div class="social-login">
					<a  onclick="FBLogin();" href="#"><img src="<?php echo base_url(); ?>assets/image/login-fb.png"> </a>
					<div class="clr"></div>
					<a onclick="location.href = '<?php echo base_url() . 'index.php/user/google_auth'; ?>'" href="#"><img src="<?php echo base_url(); ?>assets/image/login-g+.png"> </a>
				</div>
				<div class="clr"></div>
				<div class="or-login">
					<p><?php echo $this->lang->line('OR_REGISTER_MANUALLY');?></p>
				</div>

				<?php
			}
			?>
			<div class="clr"></div>
			<div class="login-input">
				<div id="signup_msg" class="margin-bottom"  ></div>

				<input type="hidden" id="signup_social_gid" value="<?php echo ($social_gid != "" ) ? $social_gid : ""; ?>">
				<input type="hidden" id="signup_social_fbid" value="<?php echo ($social_fbid != "" ) ? $social_fbid : ""; ?>">
				<input type="hidden" id="signup_social_type" value="<?php echo ($social_type != "" ) ? $social_type : ""; ?>">
				<input type="hidden" id="signup_social_image" value="<?php echo ($social_profileImage != "" ) ? $social_profileImage : ""; ?>">
				<input maxlength="20" <?php echo ($social_fname != "" ) ? "readonly" : ""; ?>  type="text" name="firstname" id="signup_firstName" class="firstname" placeholder= "First Name" value="<?php echo ($social_fname != "" ) ? $social_fname : ""; ?>"/>
				<div class="clr"></div>
				<input  maxlength="20" <?php echo ($social_lname != "" ) ? "readonly" : ""; ?>  type="text" name="lastname" id="signup_lastName" class="lastname" placeholder= "Last Name" value="<?php echo ($social_lname != "" ) ? $social_lname : ""; ?>"/>
				<div class="clr"></div>

				<dl id='countries' class="dropdown1">
					<dt id="element_phone_number">
						<a href="#"><span>+91</span></a>
					</dt>
					<dd>
						<ul>
							<?php
							foreach ($country as $c) {
								?>
								<li><a href="#"><?php echo $c['country']; ?> (<?php echo '+' . $c['country_mobile_code']; ?>)<span class=" hide value"><?php echo '+' . $c['country_mobile_code']; ?></span></a></li>
								<?php
							}
							?>
						</ul>
					</dd>
				</dl>

				<input autocomplete="off" type="text" maxlength="15" name="mobile" id="signup_mobile" style="width:80%;float:left;" class="mobile" placeholder= "Mobile" value=""/>
				<div class="clr"></div>
				<input type="text" value="" placeholder="Date of birth" class="" id="date_timepicker_dob" name="dob"/>
				<div id="dob_holder"></div>
				<div class="clr"></div>
				<input  <?php echo ($social_email != "" ) ? "readonly" : ""; ?> autocomplete="off" type="text" name="email" id="signup_email" class="email" placeholder= "E-mail" value="<?php echo ($social_email != "" ) ? $social_email : ""; ?>"/>
				<div class="clr"></div>
				<input maxlength="16" autocomplete="off"   type="<?php echo (count($login_temp) > 0) ? 'hidden' : 'password'; ?>" name="password" id="signup_password" class="password" placeholder= "Password" value="" />
				<div class="clr"></div>
			</div>
			<div class="login-submit">
				modal
				<input type="submit" class="submit2 gradient_filter" id="user_signup1" value="Sign up">
			</div>
		</form>
	</div>
</div>
<!----------------------------------/signup------------------------------------------------------->

<!--<script src="<?php echo base_url(); ?>assets/js/jquery.mobile-1.4.5.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/zip.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/skdslider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fotorama.js"></script>
<script src="<?php echo base_url(); ?>assets/js/formValidation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/framework/bootstrap.min.js"></script>

<script type="text/javascript">

	var base_url = '<?php echo base_url(); ?>';
	GOOGLE_MAP_API_KEY = '<?php echo GOOGLE_MAP_API_KEY; ?>';
	CAR_REQUEST_NOT_ACCEPTABLE_BEFORE = '<?php echo $this->lang->line('CAR_REQUEST_NOT_ACCEPTABLE_BEFORE'); ?>';
	CAR_REQUEST_MINIMUM_HOURS = '<?php echo $this->lang->line('CAR_REQUEST_MINIMUM_HOURS'); ?>';

	$('#user_email').val("");
	$('#user_password').val("");
	jQuery(function ($) {
		$("#verify-mob").mask("9-9-9-9");
	});
	<?php
    /*
     * show sign up form if coming fromm social site login
     */
    if (count($login_temp) > 0) { ?>
	$('#signup-form').attr('style', "display:block");
	<?php } else { ?>
	$('#signup_email').val("");
	$('#signup_password').val("");
	<?php } ?>
	<?php if ($this->input->get('auth') == "login") { ?>
	$('#login-form').show();
	<?php } ?>
	<?php if( $this->input->cookie('lang') == "english" or  $this->input->cookie('lang') == "" ){ ?>
	document.getElementById("lang_selector").value = 'english';
	<?php }else{ ?>
	document.getElementById("lang_selector").value = '<?php echo $this->input->cookie('lang'); ?>';
	<?php } ?>
</script>



<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4hyq0HbBDSn0q9lUrKLiOQKswjnXnmqI";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->

</body>
</html>