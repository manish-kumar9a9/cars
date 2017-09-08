<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zip.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>

		<?php $this->load->view('include/head_block'); ?>
        <!--/header-->
        <div class="clr"></div>
        <div class="home-banner1">
            <div class="banner1-txt">
                <div class="txt-box1"> 
					<?php if ($this->session->userdata('userId') == "") {
						?>
						<a  href="<?php echo site_url('user/pass_login'); ?>?url=<?php echo site_url('user/car_list'); ?>"><p><?php echo $this->lang->line('HOMEPAGE_SLIDER_LEFT_TEXT');?></p></a>
						<?php
					} else {
						?>
						<a href="<?php echo base_url() ?>index.php/user/car_list" class=""><p><?php echo $this->lang->line('HOMEPAGE_SLIDER_LEFT_TEXT');?></p></a>
						<?php
					}
					?>
                </div>
                <div class="txt-box2"><a href="<?php echo base_url() ?>index.php/user/find_car">
                        <p><?php echo $this->lang->line('HOMEPAGE_SLIDER_RIGHT_TEXT');?></p>
                    </a></div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="content-slider">
            <section id="some-id" class="hand zenith_slider">
                <div class="row">
                    <div class="highlights">
                        <ul class="block" data-move-x="-150px">
                            <li class="highlight lhgh" data-index="0">
                                <div class="highlight-title">
                                    <h3><?php echo $this->lang->line('EASILY_CUSTOMIZED');?></h3>
                                    <span class="fa fa-1 fa-2x" ><img src="<?php echo base_url(); ?>assets/image/num-1.png" ></span> </div>
                                <!-- .highlight-title -->
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
                            </li>
                            <!-- .highlight .left-row -->
                            <li class="highlight lhgh" data-index="1">
                                <div class="highlight-title">
                                    <h3><?php echo $this->lang->line('CRAFTED_WITH_LOVE');?></h3>
                                    <span class="fa fa-2 fa-2x" ><img src="<?php echo base_url(); ?>assets/image/num-2.png" ></span> </div>
                                <!-- .highlight-title -->
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
                            </li>
                            <!-- .highlight .left-row -->
                            <li class="highlight lhgh" data-index="2">
                                <div class="highlight-title">
                                    <h3><?php echo $this->lang->line('USER_FRIENDLY');?></h3>
                                    <span class="fa fa-3 fa-2x" ><img src="<?php echo base_url(); ?>assets/image/num-3.png" ></span> </div>
                                <!-- .highlight-title -->
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
                            </li>
                            <!-- .highlight .left-row -->
                            <li class="highlight lhgh" data-index="3">
                                <div class="highlight-title">
                                    <h3><?php echo $this->lang->line('FULLY_RESPONSIVE');?></h3>
                                    <span class="fa fa-4 fa-2x" ><img src="<?php echo base_url(); ?>assets/image/num-4.png" ></span> </div>
                                <!-- .highlight-title -->
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
                            </li>
                            <!-- .highlight .left-row -->
                        </ul>
                    </div>
                    <div class="phone-hand">
                        <div id="inner-screen">
                            <div class="hgi" data-index="0"> <img width="190" height="320" src="<?php echo base_url(); ?>assets/image/screen.png" class="attachment-highlight wp-post-image" alt="screen" /> </div>
                            <div class="hgi" data-index="1"> <img width="234" height="398" src="<?php echo base_url(); ?>assets/image/screensdst-234x398.jpg" class="attachment-highlight wp-post-image" alt="screensdst" /> </div>
                            <div class="hgi" data-index="2"> <img width="234" height="398" src="<?php echo base_url(); ?>assets/image/screen_09-234x398.jpg" class="attachment-highlight wp-post-image" alt="screen_09" /> </div>
                            <div class="hgi" data-index="3"> <img width="234" height="398" src="<?php echo base_url(); ?>assets/image/screen_07-234x398.jpg" class="attachment-highlight wp-post-image" alt="screen_07" /> </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="clr"></div>
        <div class="dwnld-sec">
            <h2><?php echo $this->lang->line('DOWNLOAD_UREND_ANDROID_IOS');?></h2>
            <div class="dwnld-part">
                <div class="part1"><span><?php echo $this->lang->line('SCAN_QR_CODE');?></span><br><img src="<?php echo base_url(); ?>assets/image/Qr-code.png" ></div>
                <div class="part1"><img src="<?php echo base_url(); ?>assets/image/OR-IMG.png"></div>
                <div class="part1"><a href="#"><img src="<?php echo base_url(); ?>assets/image/playstore.png"></a><br><a href="#"><img src="<?php echo base_url(); ?>assets/image/googleplay.png"></a></div>
            </div>
        </div>

        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->
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
            <div class="mob-verify-light"><a href="javascript:void(0)" class="mob-verify-close"><img src="<?php echo base_url() ?>assets/image/menu-close.png"></a>
                <h2><?php echo $this->lang->line('mobile_verification');?></h2>
                <div class="clr"></div>
                <div class="mob-verify-input">
                    <div id="verify_mobile_msg" style="color:red;font-size: 18px; font-family: 'Gotham';" ></div><a href="javascript:void(0)" onClick="$('#mobile-verify').attr('style', 'display:none');" id="verify_login_link" style="display:none;" class=" login-popup">Log in</a>
                    <input type="hidden"  id="verify-email" class="verify-mob">
                    <input type="text" maxlength="4"  id="verify-mob" class="verify-mob"  value=""  placeholder="Type OTP">
                    <div class="clr"></div>
                </div>
                <div class="mob-verify-submit">
                    <input type="button" class="mob-verify1" id="mob-verify-resend" value="<?php echo $this->lang->line('resend');?>">
                    <input type="button" class="mob-verify2" id="mob-verify-continue" value="<?php echo $this->lang->line('continue');?>">
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <!----------------------------------/mobile-verification------------------------------------------------------->

        <!----------------------------------forgot-password------------------------------------------------------->
        <div id="forgot-pswd" style="display:none">
            <div class="forgot-pswd-overlay"></div>
            <div class="forgot-pswd-light"><a href="javascript:void(0)" class="forgot-pswd-close"><img src="<?php echo base_url() ?>assets/image/menu-close.png"></a>
                <h2><?php echo $this->lang->line('forget_password');?></h2>
                <div class="clr"></div>
                <div  class="forgot-pswd-input">
                    <div id="forget_msg" style="color:red;font-size: 18px; font-family: 'Gotham';"></div>
                    <input type="text" name="fgt-email" id="fgt-email" class="fgt-email" placeholder= "E-mail" value="" >
                    <div class="clr"></div>
                </div>
                <div class="forgot-pswd-submit">
                    <input type="button" name="fgt-pswd" id="fgt-pswd" class="fgt-pswd" value="<?php echo $this->lang->line('submit');?>">

                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <!----------------------------------/forgot-password------------------------------------------------------->
        <!----------------------------------login------------------------------------------------------->
        <div id="login-form" style="display:none">
            <div class="login-overlay"></div>
            <div class="login-light"><a href="javascript:void(0)" class="login-close"><img src="<?php echo base_url() ?>assets/image/menu-close.png"></a>
                <form id="user_login_form" action="<?php echo base_url(); ?>index.php/user/signIn" method="post">
                    <h2><?php echo $this->lang->line('LOGIN_TO_UREND');?> </h2>
                    <div class="clr"></div>
                    <div class="social-login">
                        <a  onclick="FBLogin();" href="#"><img src="<?php echo base_url(); ?>assets/image/login-fb.png"> </a>
                        <div class="clr"></div>
                        <a onclick="location.href = '<?php echo base_url() . 'index.php/user/google_auth'; ?>'" href="#"><img src="<?php echo base_url(); ?>assets/image/login-g+.png"> </a>
                    </div>
                    <div class="clr"></div>

                    <div class="or-login"><img src="<?php echo base_url(); ?>assets/image/OR-EMAIL.png"> </div>
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
                        	<button type="submit" class="submit1" id="user_login_bt"  > <?php echo $this->lang->line('LOGIN');?> </button>			
                        <div class="clr"></div>
                        <p><?php echo $this->lang->line('DONT_HAVE_ACCOUONT');?><a href="javascript:void(0)"  id='urend_mobile' class="signup-popup"> <?php echo $this->lang->line('SIGN_UP');?> </a>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------------------/login------------------------------------------------------->


        <!----------------------------------signup------------------------------------------------------->
        <div id="signup-form" style="display:none">
            <div class="signup-overlay"></div>
            <div class="signup-light"><a href="javascript:void(0)" class="signup-close"><img src="<?php echo base_url() ?>assets/image/menu-close.png"></a>
                <form id="user_sign_form" action="#" method="" autocomplete="off"  >
                    <h2><?php echo $this->lang->line('SIGN_UP_FOR_UREND');?></h2>
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
						<div class="or-login"><img src="<?php echo base_url(); ?>assets/image/OR-EMAIL.png"> </div>

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

                        <input autocomplete="off" type="text" maxlength="15" name="mobile" id="signup_mobile" style="width:79.5%;float:left;margin-left:1%;" class="mobile" placeholder= "Mobile" value=""/>
						<div class="clr"></div>
						<input type="text" value="" placeholder="Date of birth" class="" id="date_timepicker_dob" name="dob"/>			
                        <div class="clr"></div>
                        <input  <?php echo ($social_email != "" ) ? "readonly" : ""; ?> autocomplete="off" type="text" name="email" id="signup_email" class="email" placeholder= "E-mail" value="<?php echo ($social_email != "" ) ? $social_email : ""; ?>"/>
                        <div class="clr"></div>
                        <input maxlength="16" autocomplete="off"   type="<?php echo (count($login_temp) > 0) ? 'hidden' : 'password'; ?>" name="password" id="signup_password" class="password" placeholder= "Password" value="" />
                        <div class="clr"></div>
                    </div>
                    <div class="login-submit">
                        <input type="submit" class="submit2" id="user_signup1" value="Sign up">
                        <div class="clr"></div>
                        <p><?php echo $this->lang->line('ALREADY_HAVE_ACCOUNT');?> <a href="javascript:void(0)" class="login-popup"><?php echo $this->lang->line('LOGIN');?> </a>
                        <p><input type="checkbox" value="" id="terms_condition" > I accept the <a href="#"> Terms of Service </a> </p>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------------------/signup------------------------------------------------------->

        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/zenith.js"></script>


        <script type="text/javascript">
                                $('#some-id').zenith({
                                    layout: 'hand',
                                    slideSpeed: 400
                                });

                                jQuery('#signup_mobile').keyup(function () {
                                    this.value = this.value.replace(/[^0-9\.]/g, '');
                                });


                                jQuery(document).ready(function () {
                                    $('#urend_forgot').click(function () {
                                        $('#login-form').attr('style', "display:none");
                                        $('#signup-form').attr('style', "display:none");
                                        $('#forgot-pswd').attr('style', "display:block");
                                    });

                                    $("#user_login_form").submit(function (e) {
										
				   if ($("#user_login_form").hasClass('element_clear')) {
						
                                        } else {
                                            e.preventDefault();
                                        }		
										
                                        $(".border-danger").removeClass("border-danger");

                                        if ($('#user_email').val() == "") {
                                            $('#user_email').focus().addClass("border-danger");
                                            return false;
                                        }

                                        if ($('#user_password').val() == "") {
                                            $('#user_password').focus().addClass("border-danger");
                                            return false;
                                        }

//                                        if ($("#user_login_form").hasClass('element_clear')) {
//						
//                                        } else {
//                                            e.preventDefault();
//                                        }
										
                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/login_receiver',
                                            method: 'POST',
                                            dataType: 'json',
                                            data: {
                                                email: jQuery("#user_email").val(),
                                                password: jQuery("#user_password").val(),
                                                action: 'normal_login'
                                            },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    $("#user_login_form").addClass('element_clear');
						$('#user_login_form').unbind().submit(); 				
                                                } else {

                                                    $("#user_login_form").removeClass('element_clear');
                                                    jQuery("#login_msg").show().html("<div class='error-alert '>" + data.message + "</div>");
                                                    if (data.message == "Account is not verified.") {
                                                        login_account_verification(data.Result.email);
                                                    }
                                                }
                                            }
                                        });

                                    });

                                    $("#user_sign_form").submit(function (e) {
                                        $(".border-danger").removeClass("border-danger");

                                        if ($('#signup_firstName').val() == "") {
                                            $('#signup_firstName').focus().addClass("border-danger");
                                            return false;
                                        }
                                        if ($('#signup_lastName').val() == "") {
                                            $('#signup_lastName').focus().addClass("border-danger");
                                            return false;
                                        }

                                        if ($('#signup_mobile').val() == "") {
                                            $('#signup_mobile').focus().addClass("border-danger");
                                            return false;
                                        }

                                        if ($('#date_timepicker_dob').val() == "") {
                                            $('#date_timepicker_dob').focus().addClass("border-danger");
                                            return false;
                                        }

                                        if ($('#signup_email').val() == "") {
                                            $('#signup_email').focus().addClass("border-danger");
                                            return false;
                                        }

                                        if ($('#signup_password').val() == "" && jQuery("#signup_social_type").val() == "") {
                                            $('#signup_password').focus().addClass("border-danger");
                                            return false;
                                        }

                                        e.preventDefault();
                                        terms_condition = "";
                                        if ($('#terms_condition').is(":checked")) {
                                            terms_condition = "set";
                                        }

                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/signup_receiver',
                                            method: 'POST',
                                            dataType: 'json',
                                            data: {
                                                firstName: jQuery("#signup_firstName").val(),
                                                lastName: jQuery("#signup_lastName").val(),
                                                email: jQuery("#signup_email").val(),
                                                mobile: jQuery("#signup_mobile").val(),
                                                password: jQuery("#signup_password").val(),
                                                fbId: jQuery("#signup_social_fbid").val(),
                                                gId: jQuery("#signup_social_gid").val(),
                                                loginType: jQuery("#signup_social_type").val(),
                                                /* countryCode: jQuery("#signup_countryCode").val(),*/
                                                countryCode: $('#element_phone_number a span').html(),
                                                profileImage: $('#signup_social_image').val(),
                                                dob: $('#date_timepicker_dob').val(),
                                                terms_condition: terms_condition
                                            },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    $('#signup-form').attr('style', "display:none");
                                                    $('#mobile-verify').attr('style', "display:block");
                                                    $('#verify-email').val(data.Result.email);
                                                    $('#signup-form input').val('');
                                                }
                                                jQuery("#signup_msg").show().html("<div class='error-alert '>" + data.message + "</div>");

                                            }
                                        });
                                    });


                                    jQuery("#fgt-pswd").click(function (key) {
                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/forgot_password',
                                            method: 'POST',
                                            dataType: 'json',
                                            data:
                                                    {
                                                        email: jQuery("#fgt-email").val(),
                                                    },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    jQuery("#forget_msg").show('slow').html("<div class='success-alert'>" + data.message + "</div>");
                                                } else {
                                                    jQuery("#forget_msg").show('slow').html("<div class='error-alert'>" + data.message + "</div>");
                                                }
                                                jQuery("#fgt-email").val('');

                                            }
                                        });
                                    });

                                    jQuery("#mob-verify-continue").click(function (key) {

                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/verify_otp',
                                            method: 'POST',
                                            dataType: 'json',
                                            data:
                                                    {
                                                        email: jQuery("#verify-email").val(),
                                                        otp: jQuery("#verify-mob").val(),
                                                    },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    jQuery("#verify-mob").removeClass("border-danger");
                                                    //$('#login-form').attr('style',"display:block");
                                                    $('#signup-form').attr('style', "display:none");
                                                    $('#verify_login_link').attr('style', "display:block");
                                                    jQuery("#verify-mob").val('');
                                                    jQuery("#verify_mobile_msg").css('color', 'green');
                                                    jQuery("#verify_mobile_msg").show().html("<div class='success-alert'>Phone verified successfully .</div>");
                                                    window.location.href = encodeURI(data.message);
                                                } else {
                                                    jQuery("#verify-mob").focus().addClass("border-danger");
                                                    jQuery("#verify_mobile_msg").show().html("<div class='error-alert'>" + data.message + "</div>");
                                                }
                                            }
                                        });
                                    });

                                    jQuery("#mob-verify-resend").click(function (key) {
                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/resend_otp',
                                            method: 'POST',
                                            dataType: 'json',
                                            data:
                                                    {
                                                        email: jQuery("#verify-email").val(),
                                                    },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    $('#signup-form').attr('style', "display:none");
                                                    jQuery("#verify_mobile_msg").show().html("<div class='success-alert'>" + data.message + "</div>");
                                                } else {
                                                    jQuery("#verify_mobile_msg").show().html(data.message);

                                                }

                                            }
                                        });
                                    });

                                    function login_account_verification(email) {
                                        $('#login-form').attr('style', "display:none");
                                        jQuery.ajax({
                                            url: '<?php echo base_url(); ?>index.php/user/resend_otp',
                                            method: 'POST',
                                            dataType: 'json',
                                            data:
                                                    {
                                                        email: email,
                                                    },
                                            success: function (data) {

                                                if (data.isSuccess) {
                                                    $('#verify-email').val(email);
                                                    $('#mobile-verify').attr('style', "display:block");
                                                }
                                                jQuery("#verify_mobile_msg").show().text(data.message);

                                            }
                                        });
                                    }


                                });
                                $('#user_email').val("");
                                $('#user_password').val("");
<?php
/*
 * show sign up form if coming fromm social site login
 */
if (count($login_temp) > 0) {
	?>
	                                $('#signup-form').attr('style', "display:block");
	<?php
} else {
	?>
	                                $('#signup_email').val("");
	                                $('#signup_password').val("");
	<?php
}
?>
        </script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>-->
        <script>
                                jQuery(function ($) {
                                    $("#verify-mob").mask("9-9-9-9");
                                });
        </script>
        <script src="<?php echo base_url(); ?>assets/js/zip.js"></script>
        <script>
<?php
if ($this->input->get('auth') == "login") {
	?>
	                                $('#login-form').show();
	<?php
}
?>
        </script>


		<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>
		<script>

                                jQuery(function () {
                                    jQuery('#date_timepicker_dob').datetimepicker({
                                        dayOfWeekStart: 1,
                                        lang: 'en',
                                        format: 'Y-m-d',
                                        formatDate: 'Y-m-d',
                                        timepicker: false
                                    });
                                });
		</script>

    </body>
</html>
