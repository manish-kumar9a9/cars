<?php $adminurl = AUTH_PANEL_URL;?>
<form action="" method="post">
 <div class="form-group">
    <div class="pull-right">
   <?php if($open_car_claim['claim_state'] == '0'){ ?>
     <a class='btn-sm btn btn-success ' href='<?php echo $adminurl; ?>car_claim/close_car_claim/<?php echo $open_car_claim['id']; ?>'>Close</a>&nbsp;
     <a class='btn-sm btn btn-danger' href='<?php echo $adminurl; ?>car_claim/under_porcess_car_claim/<?php echo $open_car_claim['id']; ?>'>Under process </a>
    <?php }else if($open_car_claim['claim_state'] =='2'){ ?>
     <a class='btn-sm btn btn-success ' href='<?php echo $adminurl; ?>car_claim/close_car_claim/<?php echo $open_car_claim['id']; ?>'>Close</a>

     <?php } ?>
    </div>
       <br/>
   <input type="hidden" name="id" value="<?php echo $open_car_claim['id']; ?>">
   <label for="exampleInputEmail1">Car Claim</label>
   <textarea rows="4" cols="50" class="form-control"><?php echo $open_car_claim['claim']; ?></textarea>
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>
 <?php if(!empty($car_claim_images)){ ?>
   <div class="form-group">
     <?php foreach ($car_claim_images as $value) { ?>
	   <img class="col-md-4 img-rounded" src ="<?php echo base_url('uploads/car_booking_images/').$value['image_name'];  ?>"   />
     <?php } ?>
    </div>
  <?php } ?>
 <div class="form-group">
  <a href ="<?php echo $adminurl;?>car_claim/index"> <button type="button" class="btn btn-primary">Cancel</button> </a>
</div>
</form>
