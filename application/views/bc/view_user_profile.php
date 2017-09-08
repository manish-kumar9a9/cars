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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/gallery.css" />
		 <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  


		<?php $this->load->view('include/head_block'); ?>

		<div class="owner-profile">
			<div class="banner">
				<img src="<?php echo base_url(); ?>assets/image/owner-banner.png">
			</div>
			<div class="clr"></div>
			<div class="owner-inner">
				<div class="abt-owner">
					<?php
					$user_image = base_url() . "assets/image/Icon-user-1.png";
					if ($user_data['profileImage'] != "") {
						$user_image = base_url() . 'profileImages/' . $user_data['profileImage'];
					}
					?>
					<div class="abt-left"><img src="<?php echo $user_image; ?>" ></div>
					<div class="abt-right">
						<h2><?php echo $user_data['firstName']; ?><span><?php echo $this->lang->line('MEMBER_SINCE'); ?> <?php echo date('M Y ', strtotime($user_data['createdAt'])); ?></span></h2>
						<?php if ($this->session->userdata('userId')) { ?>
							<div class="pro-edit-btn"><a class="theme-btn theme-btn-basic" href="<?php echo site_url('user/edit_profile'); ?>"><?php echo $this->lang->line('EDIT_PROFILE'); ?> </a></div>
						<?php } ?>
						<div class="clr"></div>
						<?php if ($user_data['country'] != "") {
							?>	
							<div class="abt-part">
								<h4><?php echo $this->lang->line('LIVES'); ?></h4>
								<div class="break"></div>
								<p><?php echo $user_data['country']; ?></p>
							</div>					

						<?php }
						?>

					</div>
				</div>
				<div class="clr"></div>
				<?php if ($user_data['about_user'] != "") { ?>
					<div class="abt-txt">
						<p><?php echo $user_data['about_user']; ?></p>
					</div>
				<?php } ?>
				<div class="clr"></div>
				<?php
				if (count($car_list) > 0) {
					?>
					<div class="owner-cars">
						<h2><?php echo $this->lang->line('MY_CARS'); ?></h2>
						<div class="clr"></div>
						<div class="devide"></div>
						<div class="clr"></div>
						<section id="dg-container" class="dg-container">
							<div class="dg-wrapper">
								<?php
								$i = "1";
								foreach ($car_list as $cl) {
									?>

									<div data-optional_div="extra_data<?php echo $i; ?>" class="a <?php echo ($i == 1 ) ? "  dg-center " : ""; ?>"><a href="<?php echo site_url('user/car_data/' . $cl['id']) ?>"><img src="<?php echo $cl['car_images'][0]['CarImage_path'] ?>" alt="image01"></a>
										<div>
											<div class="txtleft"><p><?php echo $cl['get_type_name']; ?></p><h2><?php echo $cl['get_make_name']; ?>  </br><?php echo $cl['get_model_name']; ?><span><?php echo $cl['car_brought_year']; ?></span></h2><sub>0 <?php echo $this->lang->line('TRIPS');?></sub></div>
											<div class="txtright"><p>€<?php echo $cl['price_daily']; ?> <br><span><?php echo $this->lang->line('PER_DAY');?></span></p></div>
										</div>
									</div>

									<?php
									$i++;
								}
								?>
							</div>
							<nav>	
								<span class="dg-prev"></span>
								<span class="dg-next"></span>                </nav>
						</section>
					</div>
					<?php
				}
				?>
				<?php
				if (count($user_favourite_car) > 0) {
					//echo "<pre>";
					//print_r($user_favourite_car);die;
					?>				
					<div class="clr"></div>
					<div class="ownerfavcar">
						<h2><?php echo $this->lang->line('MY_FAVOURITES_CARS'); ?></h2>
						<div class="clr"></div>
						<div class="devide"></div>
						<div class="clr"></div>
						<!------------------------slide------------------------>

						<div class="gamepart">
							<div class="crsl-items" data-navigation="navbtns">
								<div class="crsl-wrap">

									<?php
									foreach ($user_favourite_car as $ufc) {
										$user_image = base_url() . "assets/image/Icon-user-1.png";
										if ($ufc['get_user_image'] != "") {
											$user_image = $ufc['get_user_image'];
										}
										?>

										<div class="crsl-item">
											<div class="thumbnail">
												<a href="<?php echo site_url('user/car_data/' . $ufc['id']) ?>"><img src="<?php echo $ufc['car_images'][0]['CarImage_path']; ?>" alt="nyc subway"></a>	
												<div class="fav-car-dtl">
													<div class="fav1"><img src="<?php echo $user_image; ?>"><div class="clr"></div><p><?php echo $ufc['get_username'] ?></p></div>
													<div class="fav2"><h2><?php echo $ufc['get_type_name']; ?> <?php echo $ufc['get_make_name']; ?>  <span></span></h2></div>
													<div class="fav3"><div>€ <?php echo $ufc['price_daily']; ?> <?php echo $this->lang->line('PER_DAY');?></div></div>
												</div>
											</div>
										</div><!-- post #1 -->

									<?php } ?>

								</div><!-- @end .crsl-wrap -->
							</div><!-- @end .crsl-items -->
							<nav class="slidernav">
								<div id="navbtns" class="clearfix">
									<a href="#" class="previous"></a>
									<a href="#" class="next"></a>      </div>
							</nav>
						</div>



						<!------------------------slide------------------------>
					</div>

					<?php
				}
				?>
				<div class="clr"></div>
				<div class="review">
					<h2><?php echo $this->lang->line('REVIEWS_FROM_TRAVELERS'); ?></h2>
					<div class="clr"></div>
					<div class="devide"></div>

					<?php
					/* call the api to get reviews */

					$option = array(
						'is_json' => false,
						'url' => site_url() . '/service_get_reviews_user',
						'data' => array('user_id' => $user_data['userId'])
					);

					$result = get_data_with_curl($option);
					$reviews = ($result['Result']) ? $result['Result'] : array();
					foreach ($reviews as $r) {
						?>
						<div class="clr"></div>
						<div class="review-box">
							<div class="box-left"><img src="<?php echo $r['givenby_user_image']; ?>" ><br> <p><?php echo $r['givenby_username']; ?></p></div>
							<div class="box-right">
								<p><?php echo $r['remarks']; ?></p>
							</div>
							<div class="clr"></div>
							<h6 class="date">- <?php echo date('d M Y', strtotime($r['date'])); ?></h6>
						</div>					

						<?php
					}
					?>
				</div>
				<div class="clr"></div>
				<div class="listcar-details">
					<div class="step2btn">
						<a href="#"><input type="button" value="View More"></a>            
					</div>
				</div>
				<div class="clr"></div>
			</div>

		</div>  

        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.53451.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>	
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/responsiveCarousel.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gallery.js"></script>
		<script type="text/javascript">
            $(function () {
                $('#dg-container').gallery({
                    autoplay: false
                });
            });
		</script>

		<script type="text/javascript">
            $(function () {
                $('.crsl-items').carousel({
                    visible: 2,
                    itemMinWidth: 180,
                    itemEqualHeight: 370,
                    itemMargin: 9,
                });

                $("a[href=#]").on('click', function (e) {
                    e.preventDefault();
                });
            });
		</script>		
    </body>
</html>
