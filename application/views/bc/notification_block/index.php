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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
         <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">    

    		<?php $this->load->view('include/head_block'); ?>

          <div class="findcar-no-bg">
            <div class="findcar-inner notification">
              <h2 class="no-margin padding-15-0 border-btm-grey1">Your Notification</h2>
              <div class="clr"></div>

              <?php 
                  $i = 1;
                  foreach($notification_data as $nd ){
                    if($i%2 == 0){
                       $classes = "width-100 margin-top-10 border-btm-grey2 bg-color1 padding-5-0";
                    }else{
                        $classes = "width-100 border-btm-grey2 padding-5-0";
                    }

                    ?>

                    <div class="<?php echo $classes;?>">
                     <div class="width-96">
                       <div class="img float-left hide">
                         <img src="">
                       </div>
                       <div class="normal-div float-left">
                          <h4 class="margin-2-0"><?php echo $nd['text'];?> </span></h4>
                          <h5 class="margin-2-0"><?php echo date("d-m-Y H:i", strtotime( $nd['notification_time'])); ?></h5>
                       </div>
                     </div>
                    </div>
                    <div class="clr"></div>

                    <?php  $i++; 
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

    </body>
</html>
