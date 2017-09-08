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
		 <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  

		<?php $this->load->view('include/head_block'); ?>

		<?php /* header end here */ ?>
		<div class="findcar-no-bg">
			<div class="findcar-inner">
				<form action="<?php echo site_url('user/booking_confirmation') ?>" method="Post">
				<div class="findstep4">
					<input type="hidden" name="car_from" value="<?php echo $this->input->get('car_from'); ?>" >
					<input type="hidden" name="car_to" value="<?php echo $this->input->get('car_to'); ?>" >
					<input type="hidden" name='car_id' value="<?php echo$this->input->get('car_id'); ?>">

          <input type="hidden" name='car_delivery_status' value="<?php echo$this->input->get('car_delivery_status'); ?>">
          <input type="hidden" name='car_pick_up_lat' value="<?php echo$this->input->get('car_pick_up_lat'); ?>">
          <input type="hidden" name='car_pick_up_lon' value="<?php echo$this->input->get('car_pick_up_lon'); ?>">
          <input type="hidden" name='car_pick_up_location' value="<?php echo$this->input->get('car_pick_up_location'); ?>">

          <input type="hidden" name='car_drop_Off_lat' value="<?php echo$this->input->get('car_drop_Off_lat'); ?>">
          <input type="hidden" name='car_drop_Off_lon' value="<?php echo$this->input->get('car_drop_Off_lon'); ?>">
          <input type="hidden" name='car_drop_Off_location' value="<?php echo$this->input->get('car_drop_Off_location'); ?>">

					<h2>CONTACT OWNER</h2>
					<div class="clr"></div>
					<ul><li>Type your message</li></ul>
					<div class="clr"></div>
                                        <textarea rows="8" cols="70" class="padding" name="car_renter_text"   placeholder="Enter text here..." required="required"></textarea>
					<div class="clr"></div>
					<div class="btn"><input type="submit" name="book_this_car" value="Confirm your request" class=""></div>
				</div>
				</form>
			</div>
		</div>
        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>

		<script type="text/javascript">
            $(function () {
                $("#licence1").on("change", function ()
                {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function () { // set image data as background of div
                            $(".lic-1").css("background-image", "url(" + this.result + ")");
                            $(".licence-del1").show();
                            $(".licence1").hide();
                        }
                    }
                });
            });
            $(function () {
                $("#licence2").on("change", function ()
                {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                    if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function () { // set image data as background of div
                            $(".lic-2").css("background-image", "url(" + this.result + ")");
                            $(".licence-del2").show();
                            $(".licence2").hide();
                        }
                    }
                });
            });

		</script>
    </body>
</html>
