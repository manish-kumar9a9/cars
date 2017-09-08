
<aside class="profile-nav col-lg-3">
  <section class="panel">
	  <div class="user-heading round">
		  <a href="#">
			  <img src="<?php echo base_url();?>admin_assets/img/profile-avatar.jpg" alt="">
		  </a>
		  <h1>Jonathan Smith</h1>
		  <p>jsmith@flatlab.com</p>
		  <div class="">
			  <span class="">
				  <span class="fa-star fa"></span>
				  <span class="fa-star fa"></span>
				  <span class="fa-star fa"></span>
				  <span class="fa-star fa"></span>
				  <span class="fa-star-half-o fa"></span>
			  </span>
		  </div>
	  </div>

	  <ul class="nav nav-pills nav-stacked nav-collapse">
		  <li class="active"><a href="<?php echo AUTH_PANEL_URL.'web_user/user_profile';?>"> <i class="fa fa-user"></i> Profile</a></li>
		  <li><a href="<?php echo AUTH_PANEL_URL.'web_user/edit_profile';?>"> <i class="fa fa-edit"></i> Edit profile</a></li>
		  <li><a href="<?php echo AUTH_PANEL_URL.'web_user/user_listed_cars';?>"> <i class="fa  fa-truck"></i> Listed car(s)</a></li>

	  </ul>
  </section>
</aside>

<aside class="profile-info col-lg-9">

	<div class="col-lg-12">
	  <!--breadcrumbs start -->
	  <ul class="breadcrumb  ">
		  <li><a href="<?php echo AUTH_PANEL_URL.'web_user/user_listed_cars';?>"><i class="fa fa-truck"></i> listed cars</a></li>
		  <li><a href="#">lamborghini</a></li>
	  </ul>
	  <!--breadcrumbs end -->
	</div>

	  <section class="panel">
<div class="col-lg-12">

	  <!--features carousel start-->
	  <section class="panel">
		  <div class="flat-carousal">
			  <div style="opacity: 1; display: block;" id="car-img-demo" class="owl-carousel owl-theme">
				  <div class="owl-wrapper-outer"><div style="width: 1980px; left: 0px; display: block; transition: all 1000ms ease 0s; transform: translate3d(0px, 0px, 0px);" class="owl-wrapper"><div style="width: 330px;" class="owl-item"><div class="item">
					  <h1>Flatlab is new model of admin dashboard for happy use</h1>
					  <div class="text-center">
						  <a href="javascript:;" class="view-all">View All</a>
					  </div>
				  </div></div><div style="width: 330px;" class="owl-item"><div class="item">
					  <h1>Fully responsive and build with Bootstrap 3.0</h1>
					  <div class="text-center">
						  <a href="javascript:;" class="view-all">View All</a>
					  </div>
				  </div></div><div style="width: 330px;" class="owl-item"><div class="item">
					  <h1>Responsive Frontend is free if you get this.</h1>
					  <div class="text-center">
						  <a href="javascript:;" class="view-all">View All</a>
					  </div>
				  </div></div></div></div>
				  
				  
			  <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div><div class="owl-buttons"><div class="owl-prev">prev</div><div class="owl-next">next</div></div></div></div>
		  </div>
	  </section>
	  <!--features carousel end-->
  </div>
		  <div class="panel-body bio-graph-info">
			  <h1>Bio Graph</h1>
			  <div class="row">
				  <div class="bio-row">
					  <p><span>First Name </span>: Jonathan</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Last Name </span>: Smith</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Country </span>: Australia</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Birthday</span>: 13 July 1983</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Occupation </span>: UI Designer</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Email </span>: jsmith@flatlab.com</p>
				  </div>
				  <div class="bio-row">
					  <p><span>Mobile </span>: <span class="skype_c2c_print_container notranslate">(12) 03 4567890</span><span id="skype_c2c_container" class="skype_c2c_container notranslate" dir="ltr" tabindex="-1" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" data-numbertocall="+12034567890" data-numbertype="paid" data-isfreecall="false" data-isrtl="false" data-ismobile="false"><span class="skype_c2c_highlighting_inactive_common" dir="ltr" skypeaction="skype_dropdown"><span class="skype_c2c_textarea_span" id="non_free_num_ui"><img class="skype_c2c_logo_img" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" height="0" width="0"><span class="skype_c2c_text_span">(12) 03 4567890</span><span class="skype_c2c_free_text_span"></span></span></span></span></p>
				  </div>
				  <div class="bio-row">
					  <p><span>Phone </span>: 88 (02) 123456</p>
				  </div>
			  </div>
		  </div>
	  </section>
 </aside>
 
 <link rel="stylesheet" href="<?php echo base_url();?>admin_assets/css/owl.carousel.css" type="text/css">

<?php

	$custum_js = '<script src="'.base_url().'admin_assets/js/owl.carousel.js" ></script>
    <script>

	 $(document).ready(function() {
          $("#car-img-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

</script>
	';
	echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>