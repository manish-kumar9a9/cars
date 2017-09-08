<div class="notification col-xs-12 <?=($i%2 == 0)? 'danger':'new info'?>">
    <div class="col-sm-2 no-padding">
        <?php echo date("d-m-Y H:i", strtotime( $nd['notification_time'])); ?>
    </div>
    <div class="col-sm-9">
        <?php echo $nd['text'];?>
    </div>
    <div class="col-sm-1 no-padding text-right cursor">
        <img src="<?php echo base_url(); ?>assets/image/wastebasket.png"/>
    </div>
</div>
<div class="clr"></div>