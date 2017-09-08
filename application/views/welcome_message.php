<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>UREND</title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/zenither-slider.css" />
</head>
<body class="wrapper">
<!--header-->
<header class="header">
  <div class="top-menu">
    <div class="top-left">
      <div class="hide-menu">
        <div class="menu">
          <!-- Menu icon -->
          <div class="icon-close"> <img src="http://s3.amazonaws.com/codecademy-content/courses/ltp2/img/uber/close.png"> </div>
          <!-- Menu -->
          <ul>
            <li><a href="#">Find a Car</a></li>
            <li><a href="#">List a Car</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="javascript:void(0)" class="login-popup">Login</a></li>
          </ul>
        </div>
        <div class="jumbotron">
          <div class="icon-menu"> <img src="<?php echo base_url();?>assets/image/mobmenu-icon.png"> </div>
        </div>
      </div>
      <div class="top-logo"> <a href="#" id="logo"><img src="<?php echo base_url();?>assets/image/LOGO.png" ></a> </div>
      <div class="select">
        <!--<select>
                      <option value="audi" selected>Audi</option>
                      <option value="volvo">Volvo</option>
                      <option value="saab">Saab</option>
                      <option value="vw">VW</option>
                      
                    </select>-->
        <ul>
          <li class="dropdown"> <a href="javascript:void(0)" class="dropbtn" onClick="myFunction()">Mexico</a>
            <div class="dropdown-content" id="myDropdown"> <a href="#">Link 1</a> <a href="#">Link 2</a> <a href="#">Link 3</a> </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="top-right">
      <ul>
        <li><a href="#">Find a Car</a></li>
        <li><a href="#">List a Car</a></li>
        <li><a href="#">Help</a></li>
        <li><a href="javascript:void(0)" class="login-popup">Login</a></li>
      </ul>
    </div>
  </div>
  <div class="clr"></div>
</header>
<!--/header-->
<div class="clr"></div>
<div class="home-banner1">
  <div class="banner1-txt">
    <div class="txt-box1"><a href="#">
      <p>List your car & get some extra income</p>
      </a></div>
    <div class="txt-box2"><a href="#">
      <p>Find the perfect car & enjoy your travel</p>
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
              <h3>Easily Customized</h3>
              <span class="fa fa-1 fa-2x" ><img src="<?php echo base_url();?>assets/image/num-1.png" ></span> </div>
            <!-- .highlight-title -->
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
          </li>
          <!-- .highlight .left-row -->
          <li class="highlight lhgh" data-index="1">
            <div class="highlight-title">
              <h3>Crafted with love</h3>
              <span class="fa fa-2 fa-2x" ><img src="<?php echo base_url();?>assets/image/num-2.png" ></span> </div>
            <!-- .highlight-title -->
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
          </li>
          <!-- .highlight .left-row -->
          <li class="highlight lhgh" data-index="2">
            <div class="highlight-title">
              <h3>User Friendly</h3>
              <span class="fa fa-3 fa-2x" ><img src="<?php echo base_url();?>assets/image/num-3.png" ></span> </div>
            <!-- .highlight-title -->
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
          </li>
          <!-- .highlight .left-row -->
          <li class="highlight lhgh" data-index="3">
            <div class="highlight-title">
              <h3>Fully Responsive</h3>
              <span class="fa fa-4 fa-2x" ><img src="<?php echo base_url();?>assets/image/num-4.png" ></span> </div>
            <!-- .highlight-title -->
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula ege t dolor. Aenean massa.</p>
          </li>
          <!-- .highlight .left-row -->
        </ul>
      </div>
      <div class="phone-hand">
        <div id="inner-screen">
          <div class="hgi" data-index="0"> <img width="190" height="320" src="<?php echo base_url();?>assets/image/screen.png" class="attachment-highlight wp-post-image" alt="screen" /> </div>
          <div class="hgi" data-index="1"> <img width="234" height="398" src="<?php echo base_url();?>assets/image/screensdst-234x398.jpg" class="attachment-highlight wp-post-image" alt="screensdst" /> </div>
          <div class="hgi" data-index="2"> <img width="234" height="398" src="<?php echo base_url();?>assets/image/screen_09-234x398.jpg" class="attachment-highlight wp-post-image" alt="screen_09" /> </div>
          <div class="hgi" data-index="3"> <img width="234" height="398" src="<?php echo base_url();?>assets/image/screen_07-234x398.jpg" class="attachment-highlight wp-post-image" alt="screen_07" /> </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="clr"></div>
<div class="dwnld-sec">
	<h2>Download UREND In ANDROID and IOS</h2>
    <div class="dwnld-part">
    	<div class="part1"><span>Scan QR Code</span><br><img src="<?php echo base_url();?>assets/image/Qr-code.png" ></div>
        <div class="part1"><img src="<?php echo base_url();?>assets/image/OR-IMG.png"></div>
        <div class="part1"><a href="#"><img src="<?php echo base_url();?>assets/image/playstore.png"></a><br><a href="#"><img src="<?php echo base_url();?>assets/image/googleplay.png"></a></div>
    </div>
</div>

<div class="clr"></div>
<div class="shadow-sec"><img src="<?php echo base_url();?>assets/image/shadowback.png"></div>
<div class="clr"></div>
<footer>
	<div class="footer">
    	<div class="ftr-part">
        	<div class="ftr-part1">
            	<a href="#"><img src="<?php echo base_url();?>assets/image/LOGO.png"></a>            </div>
            <div class="ftr-part1">
            	<ul><li><a href="#">LIST YOUR CAR</a></li></ul>
            </div>
            <div class="ftr-part1">
            	<ul><li><a href="#">FIND A CAR</a></li></ul>
            </div>
        </div>
        <div class="clr"></div>
        <div class="ftr-part">
        	<div class="ftr-part2">
            	<div class="select">
                	<select data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2"><option value="az-AZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$0">Azərbaycan</option><option value="id-ID" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$1">Bahasa Indonesia</option><option value="ms-MY" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$2">Bahasa Melayu</option><option value="da-DA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$3">Dansk</option><option value="de-DE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$4">Deutsch</option><option value="de-AT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$5">Deutsch (Austria)</option><option value="el-GR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">ελληνικά</option><option value="en-US" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$7">English</option><option value="en-GB" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$8">English (British)</option><option selected="" value="es-MX" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$9">Español</option><option value="es-ES" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$10">Español (España)</option><option value="et" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$11">Eesti Keel</option><option value="fr-FR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$12">Français</option><option value="it-IT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$13">Italiano</option><option value="hi" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$14">हिन्दी</option><option value="hr" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$15">Hrvatski</option><option value="hu-HU" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$16">Magyar</option><option value="lt-LT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$17">Lietuvių</option><option value="nl-NL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$18">Nederlands</option><option value="nb-NO" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$19">Norsk Bokmål</option><option value="pl-PL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$20">Polski</option><option value="pt-BR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$21">Português (Brasil)</option><option value="pt-PT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$22">Português (Portugal)</option><option value="ro-RO" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$23">Română</option><option value="fi-FI" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$24">Suomi</option><option value="sk-SK" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$25">Slovenčina</option><option value="sv-SE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$26">Svenska</option><option value="tl-PH" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$27">Tagalog</option><option value="vi-VN" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$28">Tiếng Việt</option><option value="tr-TR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$29">Türkçe</option><option value="cs-CZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$30">Čeština</option><option value="ru-RU" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$31">Pусский</option><option value="bg-BG" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$32">български език</option><option value="he-IL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$33">עברית</option><option value="ar-SA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$34">العربية</option><option value="th-TH" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$35">ภาษาไทย</option><option value="zh-CN" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$36">简体中文</option><option value="zh-TW" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$37">繁體中文</option><option value="zh-HK" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$38">香港中文版</option><option value="ja-JP" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$39">日本語</option><option value="ko-KR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$40">한국어</option><option value="uk-UA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$41">українська мова</option></select>
                </div>
                
                <div class="clr"></div>
                <div class="select">
                	<select data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2"><option value="az-AZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$0">Euro</option><option value="id-ID" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$1">Bahasa Indonesia</option><option value="ms-MY" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$2">Bahasa Melayu</option><option value="da-DA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$3">Dansk</option><option value="de-DE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$4">Deutsch</option><option value="de-AT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$5">Deutsch (Austria)</option><option value="el-GR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">ελληνικά</option><option value="en-US" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$7">English</option><option value="en-GB" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$8">English (British)</option><option selected="" value="es-MX" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$9">Euro</option><option value="es-ES" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$10">Español (España)</option></select>
                </div>
                <div class="clr"></div>
                <div class="social">
                	<div class="social-img"><a href="#"><img src="<?php echo base_url();?>assets/image/fb.png"></a></div>
                    <div class="social-img"><a href="#"><img src="<?php echo base_url();?>assets/image/tweetr.png"></a></div>
                    <div class="social-img"><a href="#"><img src="<?php echo base_url();?>assets/image/IN.png"></a></div>
                    <div class="social-img"><a href="#"><img src="<?php echo base_url();?>assets/image/instagram.png"></a></div>
                </div>
            </div>
            <div class="ftr-part2">
            	<ul>
                  <li><a href="#">Ride</a></li>
                  <li><a href="#">Drive</a></li>
                  <li><a href="#">Business Travel</a></li>
                  <li><a href="#">Safety</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Term of service</a></li>
                </ul>
            </div>
            <div class="ftr-part2">
            	<ul>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Team</a></li>
                  <li><a href="#">Media</a></li>
                  <li><a href="#">Help</a></li>
                  <li><a href="#">Find a city</a></li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>
        <div class="ftr-part">
            <div class="ftr-part3">
            	<div class="ftr-img">
                	<img src="<?php echo base_url();?>assets/image/playstore.png"><img src="<?php echo base_url();?>assets/image/googleplay.png">                </div>
            </div>
        </div>
        <div class="clr"></div>
        <div class="ftr-part">
            <div class="ftr-part3">
            	<p>&copy; UREND Technologies inc. </p>
            </div>
        </div>
    </div>
</footer>

   			<script type="text/javascript">
				window.fbAsyncInit = function() {
					FB.init({
						appId: '1701793353416439', // replace your app id here
						channelUrl: '//WWW.YOUR_DOMAIN.COM/channel.html',
						status: true,
						cookie: true,
						xfbml: true
					});
				};
				(function(d) {
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
					FB.login(function(response) {
						if (response.authResponse) {
							window.location.href = "<?php echo base_url('index.php/user/facebook_auth');?>?action=fblogin";
						}
					}, {
						scope: 'email,user_likes'
					});
				}
			</script>

<!----------------------------------mobile-verification------------------------------------------------------->
<div id="mobile-verify" style="display:none">
 <div class="mob-verify-overlay"></div>
 <div class="mob-verify-light"><a href="javascript:void(0)" class="mob-verify-close">close</a>
   <h2>MOBILE VERIFICATION</h2>
   <div class="clr"></div>
   <div class="mob-verify-input">
   <div id="verify_mobile_msg" style="color:red;font-size: 22px;"  ></div><a href="javascript:void(0)" onClick="$('#mobile-verify').attr('style','display:none');" id="verify_login_link" style="display:none;" class=" login-popup">Log in</a>
	<input type="hidden"  id="verify-email" class="verify-mob">
    <input type="text" maxlength="4"  id="verify-mob" class="verify-mob"  value=""  placeholder="Type OTP">
    <div class="clr"></div>
  </div>
  <div class="mob-verify-submit">
  	<input type="button" class="mob-verify1" id="mob-verify-resend" value="Resend">
    <input type="button" class="mob-verify2" id="mob-verify-continue" value="Continue">
    <div class="clr"></div>
  </div>
</div>
</div>
<!----------------------------------/mobile-verification------------------------------------------------------->

<!----------------------------------forgot-password------------------------------------------------------->
<div id="forgot-pswd" style="display:none">
 <div class="forgot-pswd-overlay"></div>
 <div class="forgot-pswd-light"><a href="javascript:void(0)" class="forgot-pswd-close">close</a>
   <h2>FORGOT PASSWORD</h2>
   <div class="clr"></div>
   <div  class="forgot-pswd-input">
	<div id="forget_msg" style="color:red;font-size: 22px;"></div>
    <input type="text" name="fgt-email" id="fgt-email" class="fgt-email" placeholder= "E-mail Address" value="" >
    <div class="clr"></div>
  </div>
  <div class="forgot-pswd-submit">
  	<input type="button" name="fgt-pswd" id="fgt-pswd" class="fgt-pswd" value="Send Password">
    
    <div class="clr"></div>
  </div>
</div>
</div>
<!----------------------------------/forgot-password------------------------------------------------------->
<!----------------------------------login------------------------------------------------------->
<div id="login-form" style="display:none">
 <div class="login-overlay"></div>
 <div class="login-light"><a href="javascript:void(0)" class="login-close">close</a>
   <form id="user_login_form" action="<?php echo base_url();?>index.php/user/signIn" method="post">
   <h2>LOG IN</h2>
   <div class="clr"></div>
   <div class="social-login">
					<a  onclick="FBLogin();" href="#"><img src="<?php echo base_url();?>assets/image/login-fb.png"> </a>
					<div class="clr"></div>
					<a onclick="location.href='<?php echo base_url().'index.php/user/google_auth';?>'" href="#"><img src="<?php echo base_url();?>assets/image/login-g+.png"> </a>
   </div>
   <div class="clr"></div>
   
   <div class="or-login"><img src="<?php echo base_url();?>assets/image/OR-EMAIL.png"> </div>
   <div class="clr"></div>
   <div class="login-input">
	<div id="login_msg" style="color:red;font-size: 22px;"  ></div>
    <input type="text" name="email" id="user_email" class="email" placeholder="E-mail Address" value="" >
    <div class="clr"></div>
    <input type="password" name="password" id="user_password" class="password" placeholder="Password"  value="" >
    <div class="clr"></div>
    <a href="javascript:void(0)" id='urend_forgot'>Forgot your password?</a>
  </div>
  <div class="login-submit">
  	<input type="button" class="submit1" id="user_login_bt" value="">
    <div class="clr"></div>
    <p>Don't have any account? <a href="javascript:void(0)"  id='urend_mobile' class="signup-popup">Sign up</a>
  </div>
  </form>
</div>
</div>
<!----------------------------------/login------------------------------------------------------->


<!----------------------------------signup------------------------------------------------------->
<div id="signup-form" style="display:none">
 <div class="signup-overlay"></div>
 <div class="signup-light"><a href="javascript:void(0)" class="signup-close">close</a>

   <h2>SIGN UP</h2>
   <div class="clr"></div>
	   <?php

		$login_temp = $this->session->flashdata('sign_up_data');
		$social_gid = $social_fbid =  $social_type = $social_fname = $social_lname  = $social_email = "" ;
		if(count($login_temp) > 0){
			
			$social_gid = (isset($login_temp['gId']))?$login_temp['gId']:"";
			$social_fbid = (isset($login_temp['fbId']))?$login_temp['fbId']:"";

			$s = explode(" ", $login_temp['firstName']);
			$social_fname =  $s[0];
			$s[0] = "";
			$social_lname = implode(" ",$s);

			$social_type = $login_temp['loginType'];
			$social_email = $login_temp['email'];
		}else{
			?>
			   <div class="social-login">
					<a  onclick="FBLogin();" href="#"><img src="<?php echo base_url();?>assets/image/login-fb.png"> </a>
					<div class="clr"></div>
					<a onclick="location.href='<?php echo base_url().'index.php/user/google_auth';?>'" href="#"><img src="<?php echo base_url();?>assets/image/login-g+.png"> </a>
			   </div>
			   <div class="clr"></div>
			   <div class="or-login"><img src="<?php echo base_url();?>assets/image/OR-EMAIL.png"> </div>

			<?php
		}

	?>
   <div class="clr"></div>
   <div class="login-input">
   <div id="signup_msg" style="color:red;font-size: 22px;"  ></div>

    <input type="hidden" id="signup_social_gid" value="<?php echo ($social_gid != "" )?$social_gid:"";?>">
    <input type="hidden" id="signup_social_fbid" value="<?php echo ($social_fbid != "" )?$social_fbid:"";?>">
    <input type="hidden" id="signup_social_type" value="<?php echo ($social_type != "" )?$social_type:"";?>">
	
    <input maxlength="20" <?php echo ($social_fname != "" )?"readonly":"";?>  type="text" name="firstname" id="signup_firstName" class="firstname" placeholder= "First Name" value="<?php echo ($social_fname != "" )?$social_fname:"";?>"/>
    <div class="clr"></div>
    <input  maxlength="20" <?php echo ($social_lname != "" )?"readonly":"";?>  type="text" name="lastname" id="signup_lastName" class="lastname" placeholder= "Last Name" value="<?php echo ($social_lname != "" )?$social_lname:"";?>"/>
    <div class="clr"></div>
	<select name=""  id="signup_countryCode">
		<?php 
		foreach($country as $c){
		?>
		<option <?php echo ($c['country_mobile_code'] == "91")?"selected='selected'":""; ?>value="<?php echo '+'.$c['country_mobile_code'] ;?>"><?php echo "+".$c['country_mobile_code'];?></option>
		<?php

		}	
		?>	
	</select>
    <input type="text" maxlength="15" name="mobile" id="signup_mobile" style="width:80%;float:left;margin-left:5px;" class="mobile" placeholder= "Mobile" value=""/>
    <div class="clr"></div>
    <input  <?php echo ($social_email != "" )?"readonly":"";?> autocomplete="off" type="text" name="email" id="signup_email" class="email" placeholder= "E-mail Address" value="<?php echo ($social_email != "" )?$social_email:"";?>"/>
    <div class="clr"></div>
    	<input maxlength="16" autocomplete="off"   type="<?php echo (count($login_temp) > 0)?'hidden':'password';?>" name="password" id="signup_password" class="password" placeholder= "Password" value="" />
    <div class="clr"></div>
  </div>
  <div class="login-submit">
  	<input type="button" class="submit2" id="user_signup1" value="">
    <div class="clr"></div>
    <p>Already have a account? <a href="javascript:void(0)" class="login-popup">Log in</a>
    <p><input type="checkbox" value="" id="terms_condition" > By Signing up, you agree to our <a href="#">Term of service</a> </p>
  </div>
</div>
</div>
<!----------------------------------/signup------------------------------------------------------->

<script src="<?php echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/app.js"></script>
<script src="<?php echo base_url();?>assets/js/popup.js"></script>
<script src="<?php echo base_url();?>assets/js/custem.js"></script>
<script src="<?php echo base_url();?>assets/js/zenith.js"></script>
<script type="text/javascript">
      $('#some-id').zenith({
          layout: 'hand', 
          slideSpeed : 400
      });
	
	  jQuery('#signup_mobile').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
      });
	  
	  jQuery('#verify-mob').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
      });		
	  
	jQuery(document).ready(function(){
		$('#urend_forgot').click(function() {	
				$('#login-form').attr('style',"display:none");
				$('#signup-form').attr('style',"display:none");
       		 	$('#forgot-pswd').attr('style',"display:block");
    		  });
			  
			  $('#user_signup1').click(function() {	
				//$('#login-form').attr('style',"display:none");
				//$('#signup-form').attr('style',"display:none");
				//$('#forgot-pswd').attr('style',"display:none");
       		 	//$('#mobile-verify').attr('style',"display:block");
    		  });
			  
		/*	  $('#mobile-verify').click(function() {	
				$('#login-form').attr('style',"display:none");
				$('#signup-form').attr('style',"display:none");
			  	$('#urend_forgot').attr('style',"display:none"); 
       		 	$('#mobile-verify').attr('style',"display:block");
    		  }); */
			  
		jQuery("#user_login_bt").click(function(key){
			jQuery.ajax({
				url:'<?php echo base_url();?>index.php/user/login_receiver',
				method:'POST',
				dataType: 'json',
				data:{
				  email:jQuery("#user_email").val(),
				  password:jQuery("#user_password").val(),
				  action:'normal_login'
				},
				success:function(data){
				  
				  if(data.isSuccess){
					  $('#user_login_form').submit();
				  }else{
					jQuery("#login_msg").show().text(data.message);  
				  }
				}
			  });
		});
		
		jQuery("#user_signup1").click(function(key){
			terms_condition = "";
			if($('#terms_condition').is(":checked")){
				terms_condition = "set";
			}
			
			jQuery.ajax({
				url:'<?php echo base_url();?>index.php/user/signup_receiver',
				method:'POST',
				dataType: 'json',
				data:{
				  firstName:jQuery("#signup_firstName").val(),
				  lastName:jQuery("#signup_lastName").val(),
				  email:jQuery("#signup_email").val(),
				  mobile:jQuery("#signup_mobile").val(),
				  password:jQuery("#signup_password").val(),
				  fbId:jQuery("#signup_social_fbid").val(),
				  gId:jQuery("#signup_social_gid").val(),
				  loginType:jQuery("#signup_social_type").val(),
				  countryCode:jQuery("#signup_countryCode").val(),
				  terms_condition:terms_condition,
				},	
				success:function(data){

				  if(data.isSuccess){
					$('#signup-form').attr('style',"display:none");
					$('#mobile-verify').attr('style',"display:block");
					$('#verify-email').val(data.Result.email);
					$('#signup-form input').val('');
				  }
				   jQuery("#signup_msg").show().text(data.message);  

				}
			  });
		});
		
		
			jQuery("#fgt-pswd").click(function(key){
			jQuery.ajax({
				url:'<?php echo base_url();?>index.php/user/forgot_password',
				method:'POST',
				dataType: 'json',
				data:
				{ 
				  email:jQuery("#fgt-email").val(),		 
				},
				success:function(data){
					jQuery("#forget_msg").show('slow').text(data.message);  
					jQuery("#fgt-email").val('');
				
				}
			  });
		});
		
		jQuery("#mob-verify-continue").click(function(key){
			jQuery.ajax({
				url:'<?php echo base_url();?>index.php/user/verify_otp',
				method:'POST',
				dataType: 'json',
				data:
				{ 
				  email:jQuery("#verify-email").val(),	
				  otp:jQuery("#verify-mob").val(),				  
				},
				success:function(data){
				  
				  if(data.isSuccess){
					//$('#login-form').attr('style',"display:block");
					$('#signup-form').attr('style',"display:none");
					$('#verify_login_link').attr('style',"display:block");
					 jQuery("#verify-mob").val('');
					  jQuery("#verify_mobile_msg").show().html("Phone verified successfully .");  
					  window.location.href = encodeURI(data.message);
				  }else{
					jQuery("#verify_mobile_msg").show().html(data.message);  
				  }
				}
			  });
		});
		
		jQuery("#mob-verify-resend").click(function(key){
			jQuery.ajax({
				url:'<?php echo base_url();?>index.php/user/resend_otp',
				method:'POST',
				dataType: 'json',
				data:
				{ 
				  email:jQuery("#verify-email").val(),				  
				},
				success:function(data){
				  
				  if(data.isSuccess){
					//$('#login-form').attr('style',"display:block");
					$('#signup-form').attr('style',"display:none");
				  }
					jQuery("#verify_mobile_msg").show().text(data.message);  
				
				}
			  });
		});		
		
		
	});
	$('#user_email').val("");
    $('#user_password').val("");
	<?php 
		/*
		* show sign up form if coming fromm social site login 
		*/
		if(count($login_temp) > 0){
		?>
			$('#signup-form').attr('style',"display:block");
		<?php
		}else{
		?>
		    $('#signup_email').val("");
  			 $('#signup_password').val("");
		<?php
		}
	?>
</script>
<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
<script>
	jQuery(function($){
	   $("#date").mask("9-9-9-9");
	});
</script>

<input type="text" id="date" />
	
	
</body>
</html>
