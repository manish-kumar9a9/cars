<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Car Maker</label>
    <select class="form-control m-bot15" name="maker">
    <?php foreach($car_makers_name as $maker_name){ ?>
        <option value="<?php echo $maker_name['id']; ?>"><?php echo $maker_name['name'];?></option>
    <?php } ?>
    </select>
  </div>
 <div class="form-group">
   <label for="exampleInputEmail1">Car Model</label>
   <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Model">
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
