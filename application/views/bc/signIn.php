
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
            <li><a href="login">Login</a></li>
          </ul>
        </div>
        <div class="jumbotron">
          <div class="icon-menu"> <img src="<?php echo base_url();?>assets/image/mobmenu-icon.png"> </div>
        </div>
      </div>
      <div class="top-logo"> <a href="#" id="logo"><img src=<?php echo base_url(); ?> "assets/image/LOGO.png" ></a> </div>
      <div class="select">
        <!--<select>
                      <option value="audi" selected>Audi</option>
                      <option value="volvo">Volvo</option>
                      <option value="saab">Saab</option>
                      <option value="vw">VW</option>
                      
                    </select>-->
        <ul>
          <li class="dropdown"> <a href="javascript:void(0)" class="dropbtn" onClick="myFunction()">Maxico</a>
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
        <li><a href="login">Login</a></li>
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
      <p>List your car & get some extera income</p>
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
	<h2>Downlaod UREND In ANDROID and IOS</h2>
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
                	<select data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2"><option value="az-AZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$0">Azərbaycan</option><option value="id-ID" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$1">Bahasa Indonesia</option><option value="ms-MY" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$2">Bahasa Melayu</option><option value="da-DA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$3">Dansk</option><option value="de-DE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$4">Deutsch</option><option value="de-AT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$5">Deutsch (Austria)</option><option value="el-GR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">ελληνικά</option><option value="en-US" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$7">English</option><option value="en-GB" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$8">English (British)</option><option selected="" value="es-MX" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$9">Español</option><option value="es-ES" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$10">Español (España)</option><option value="et" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$11">Eesti Keel</option><option value="fr-FR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$12">Français</option><option value="it-IT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$13">Italiano</option><option value="hi" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$14">हिन�?दी</option><option value="hr" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$15">Hrvatski</option><option value="hu-HU" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$16">Magyar</option><option value="lt-LT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$17">Lietuvių</option><option value="nl-NL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$18">Nederlands</option><option value="nb-NO" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$19">Norsk Bokmål</option><option value="pl-PL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$20">Polski</option><option value="pt-BR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$21">Português (Brasil)</option><option value="pt-PT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$22">Português (Portugal)</option><option value="ro-RO" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$23">Română</option><option value="fi-FI" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$24">Suomi</option><option value="sk-SK" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$25">Sloven�?ina</option><option value="sv-SE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$26">Svenska</option><option value="tl-PH" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$27">Tagalog</option><option value="vi-VN" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$28">Tiếng Việt</option><option value="tr-TR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$29">Türkçe</option><option value="cs-CZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$30">Čeština</option><option value="ru-RU" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$31">Pу�?�?кий</option><option value="bg-BG" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$32">българ�?ки език</option><option value="he-IL" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$33">עברית</option><option value="ar-SA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$34">العربية</option><option value="th-TH" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$35">ภาษาไทย</option><option value="zh-CN" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$36">简体中文</option><option value="zh-TW" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$37">�?體中文</option><option value="zh-HK" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$38">香港中文版</option><option value="ja-JP" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$39">日本語</option><option value="ko-KR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$40">한국어</option><option value="uk-UA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$41">україн�?ька мова</option></select>
                </div>
                
                <div class="clr"></div>
                <div class="select">
                	<select data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2"><option value="az-AZ" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$0">Euro</option><option value="id-ID" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$1">Bahasa Indonesia</option><option value="ms-MY" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$2">Bahasa Melayu</option><option value="da-DA" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$3">Dansk</option><option value="de-DE" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$4">Deutsch</option><option value="de-AT" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$5">Deutsch (Austria)</option><option value="el-GR" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">ελληνικά</option><option value="en-US" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$7">English</option><option value="en-GB" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$8">English (British)</option><option selected="" value="es-MX" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$9">Euro</option><option value="es-ES" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$10">Español (España)</option></select>
                </div>
                <div class="clr"></div>
                <div class="social">
                	<div class="social-img"><a href="#"><img src="image/fb.png"></a></div>
                    <div class="social-img"><a href="#"><img src="image/tweetr.png"></a></div>
                    <div class="social-img"><a href="#"><img src="image/IN.png"></a></div>
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
<script src="<?php echo base_url();?>js/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url();?>js/app.js"></script>
<script src="<?php echo base_url();?>js/custem.js"></script>
<script src="<?php echo base_url();?>js/zenith.js"></script>
<script type="text/javascript">
      $('#some-id').zenith({
          layout: 'hand', 
          slideSpeed : 400
      });
</script>
</body>
</html>
