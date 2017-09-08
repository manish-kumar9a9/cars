<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.range.css">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/booking_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components/imgareaselect/css/imgareaselect-default.css">


		<?php /* css for datetime picker  */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>

		<?php $this->load->view('include/head_block'); ?>
		<?php /* header end here */ ?>
		<!-- slider starts -->
		<div class="slider " style="display:none;">
			<div class="slide_viewer help">
				<div class="slide_group" style="background-image: url(<?php echo base_url(); ?>assets/image/support_header.jpg) !important;
					 background-repeat: no-repeat;
					 background-size: cover;">
					<div class="help-center-text">
						<div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 help-center-detail">
							<h1>HELP CENTER</h1>
							<form>
								<input type="text" name="search" placeholder="Search..">
							</form>

						</div>
					</div>
				</div>


			</div>


		</div>
		<!-- slider ends -->
		<!-- main section starts -->
		<div class="container">

			<!----start tab-content--->

			<div class="tab-content-container">
				<ul class="tabs" data-persist="true">
					<li><a href="#view1" class="right-border">Renter</a></li>
					<li><a href="#view2">Owner</a></li>

				</ul>
				<div class="tabcontents">
					<div id="view1">
						<main class="main-wrapper">
							<div id="renter_id_element">

								<?php
								$head = "";
								foreach ($renter_help as $rh) {
									if ($head != $rh['faq_type']) {
										$type = str_replace("_"," ",$rh['faq_type'] );
										echo "<h2 class='faq_head_element' >" . $type . "</h2>";
										$head = $rh['faq_type'];
									}
									?>
									<h3><?php echo $rh['faq_question'] ?></h3>
									<div><?php echo $rh['faq_answer'] ?></div>
									<?php
								}
								?>

							</div><!-- end of second -->



						</main><!-- end of main-wrapper -->

					</div>
					<div id="view2">
						<main class="main-wrapper">


							<div id="owner_id_element">
								<?php
								$head = "";
								foreach ($owner_help as $rh) {
									if ($head != $rh['faq_type']) {
										$type  = str_replace("_"," ",$rh['faq_type'] );
										echo "<h2 class='faq_head_element' >" . $type . "</h2>";
										$head = $rh['faq_type'];
									}
									?>
									<h3><?php echo $rh['faq_question'] ?></h3>
									<div><?php echo $rh['faq_answer'] ?></div>
									<?php
									
								}
								?>
							</div><!-- end of thirth -->

						</main><!-- end of main-wrapper -->

					</div>

				</div>

				<div class="col-new-lg-12 col-new-md-12 col-new-xs-12 center padding-15-0 help-center-button">
					<strong class="">Need Something else?</strong><br/>
					<button class="btn btn-support">Contact Support</button>

				</div>
			</div>
			<!--- end tab-content--->

		</div>
		<!-- main section ends -->




        <!--footers-->
<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->

        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
		<?php /* to open header drop down */ ?>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/skdslider.min.js"></script>

<?php /* js for help */ ?>
        <script src="<?php echo base_url(); ?>assets/js/tabcontent.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/rlaccordion.js"></script>

        <!-- Modal popup script starts -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Modal popyp script ends -->

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#demo1').skdslider({'delay': 3500, 'animationSpeed': 3500, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading'});


                jQuery('#responsive').change(function () {
                    $('#responsive_wrapper').width(jQuery(this).val());
                });

            });

            $(function () {

                $("#first").rlAccordion();

                $("#renter_id_element").rlAccordion('single', {
                    childNumOptions: false
                });

                $("#owner_id_element").rlAccordion('single', {
                    childNumOptions: false
                });

            });


        </script>



    </body>
</html>
