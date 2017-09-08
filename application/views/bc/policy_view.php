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

		<?php $this->load->view('include/head_block'); ?>
		<?php /* header end here */ ?>

	<div class="findcar-no-bg">
		<div id="container" class="findcar-inner notification">

			<?php echo $page_content; ?>

		</div>
	</div>



	<!--footers-->
	<?php $this->load->view('include/footer_block'); ?>
	<!--/footer-->

	<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
	<?php /* to open header drop down */ ?>
	<script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/skdslider.min.js"></script>

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
	</script>


</body>
</html>
