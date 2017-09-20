<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>

        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/gallery.css" />
		 <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">  

		<?php $this->load->view('include/head_block'); ?>
		
        <div class="clr"></div>
        <div class="list-car">


    <div class="listcar-home">
      <div class="no-car"><a href="<?php echo base_url()?>index.php/user/add_car"><input  class="theme-btn-basic" type="button" value="Add your Car"></a><div class="clr"><input style="background:transparent;border:solid 2px #fff;" type="button" value="Help"></div></div>
    </div>

        <!--footers-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modernizr.custom.53451.js"></script>
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
