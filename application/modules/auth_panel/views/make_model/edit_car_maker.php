
<form action="" method="post">
 <div class="form-group">
   <input type="hidden" name="id" value="<?php echo $edit_car_makes['id']; ?>">
   <label for="exampleInputEmail1">Car Make</label>
   <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter name" value="<?php echo $edit_car_makes['name']; ?>">
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
