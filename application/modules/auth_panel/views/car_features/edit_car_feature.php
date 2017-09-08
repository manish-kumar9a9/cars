
<form action="" method="post">
 <div class="form-group">
   <input type="hidden" name="id" value="<?php echo $edit_car_feature['id']; ?>">
   <label for="exampleInputEmail1">Car Feature</label>
   <input type="text" class="form-control" id="exampleInputName" name="features" placeholder="Enter name" value="<?php echo $edit_car_feature['features']; ?>">
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>

 <div class="form-group">
   <label for="exampleInputEmail1">Car Feature (in Greek )</label>
   <input type="text" class="form-control"  name="greek_lang" placeholder="Enter name" value="<?php echo $edit_car_feature['greek_lang']; ?>">
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>	
	
 <button type="submit" class="btn btn-primary">Submit</button>
</form>
