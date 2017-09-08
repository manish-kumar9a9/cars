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
        <link href="<?php echo base_url(); ?>assets/css/green.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/gallery.css" />
	<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  

		<?php $this->load->view('include/head_block'); ?>
        <div class="clr"></div>
        <div class="list-car">
            <div class="home2slide">
                <div class="owner-list-cars">
                    <h2><?php echo $this->lang->line('MY_CARS');?></h2>
                    <div class="clr"></div>
                    <div class="devide"></div>
                    <div class="clr"></div>
                    <section id="dg-container" class="dg-container">
                        <div class="dg-wrapper">
							<?php $i = "1";
							foreach ($car_list as $cl) {
								?>

								<div data-optional_div="extra_data<?php echo $i; ?>" class="a <?php echo ($i == 1 ) ? "  dg-center " : ""; ?>"><img src="<?php echo $cl['car_images'][0]['CarImage_path'] ?>" alt="image01">
									<div>
										<div class="txtleft"><p><?php echo $cl['get_type_name']; ?></p><h2><?php echo $cl['get_make_name']; ?>  </br><?php echo $cl['get_model_name']; ?></h2><sub>0 <?php echo $this->lang->line('TRIPS');?></sub></div>
										<div class="txtright"><p>€ <?php echo $cl['price_daily']; ?> <br><span><?php echo $this->lang->line('PER_DAY');?></span></p></div>
									</div>
								</div>
								<?php
								$i++;
							}
							?>
                        </div>
                        <nav>	
                            <span class="dg-prev"></span>
                            <span class="dg-next"></span>   
                        </nav>
                    </section>
                </div>
                <div class="clr"></div>
				<?php
				$i = "1";
				foreach ($car_list as $cl) {
					?>
					<div class="extra_data" style="<?php echo ($i == 1 ) ? "" : "display:none;"; ?>"  id="extra_data<?php echo $i; ?>" >
						<div class="dtl-edit-btn">
							<a class="theme-btn-green" style="float:left" href="<?php echo base_url() ?>index.php/user/add_car/"><?php echo $this->lang->line('ADD_NEW_CAR');?></a>
							
							<a class="theme-btn-green"  href="<?php echo base_url() ?>index.php/user/edit_car/<?php echo $cl['id'] ?>"><?php echo $this->lang->line('EDIT_THIS_CAR');?></a>
							<a  class="margin-right theme-btn-green"  href="<?php echo site_url('user/delete_car/'.$cl['id']); ?>"><?php echo $this->lang->line('DELETE_THIS_CAR');?></a>
						</div>
						<div class="clr"></div>
						<div class="slide-detail">
							<div class="dtl-box">
								<div class="dtl1">
									<?php if ($cl['is_verified'] == 0) { ?>					
										<sub style="color:red;font-weight:bold">* <?php echo $this->lang->line('PENDING_APPROVAL');?> </sub>	
									<?php } ?>				
									<h2> <?php echo $this->lang->line('CAR_DESCRIPTION');?> </h2>
									<p><?php echo $cl['description']; ?></p>
								</div>
								<div class="clr"></div>
								<div class="dtl1">
									<h2><?php echo $this->lang->line('CAR_DETAILS');?> </h2>
									<div class="left">
										<ul>
											<li> <?php echo $this->lang->line('TYPE');?></li>
											<li><?php echo $this->lang->line('MAKE');?></li>
											<li><?php echo $this->lang->line('MODEL');?></li>
										</ul>
									</div>
									<div class="right">
										<ul>
											<li><?php echo $cl['get_type_name']; ?></li>
											<li><?php echo $cl['get_make_name']; ?></li>
											<li><?php echo $cl['get_model_name']; ?></li>
										</ul>
									</div>
								</div>
								<div class="clr"></div>
								<div class="dtl1">
									<h2><?php echo $this->lang->line('REGISTRATION');?></h2>
									<div class="left">
										<ul>
											<li><?php echo $this->lang->line('YEAR');?></li>
										</ul>
									</div>
									<div class="right">
										<ul>
											<li><?php echo $cl['car_brought_year']; ?></li>
										</ul>
									</div>
								</div>
								<div class="clr"></div>
								<div class="dtl1">
									<h2><?php echo $this->lang->line('ENGINE_DETAILS');?></h2>
									<div class="left">
										<ul>
											<li><?php echo $this->lang->line('MILEAGE');?></li>
											<li><?php echo $this->lang->line('CUBIC_CAPACITY');?></li>
											<li><?php echo $this->lang->line('FUEL_TYPE');?></li>
											<li><?php echo $this->lang->line('TRANSMISSION');?></li>
										</ul>
									</div>
									<div class="right">
										<ul>

											<li><?php echo $cl['mileage']; ?></li>
											<li><?php echo $cl['cubicCapacity']; ?></li>
											<li><?php echo $cl['get_fuel_type_name']; ?></li>
											<li><?php echo $cl['get_transmission_name']; ?></li>                                       

										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
	<?php $i++;
}
?>               
            </div>
        </div>
		
        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->

        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/zenith.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modernizr.custom.53451.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/responsiveCarousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.gallery.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#dg-container').gallery({
                    autoplay: false
                });
            });
        </script>

    </body>
</html>
