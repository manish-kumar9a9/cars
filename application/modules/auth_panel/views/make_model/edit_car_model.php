<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Car Maker</label>
    <select class="form-control m-bot15" name="maker">
    <?php foreach($car_makers_name as $maker_name){ ?>
        <option value="<?php echo $maker_name['id']; ?>"><?php echo $maker_name['name'];?></option>
    <?php } ?>
    </select>
     <span class="text-danger"><?php echo form_error('name');?></span>
  </div>
 <div class="form-group">
   <input type="hidden" name="id" value="<?php echo $edit_car_model['id']; ?>">
   <label for="exampleInputEmail1">Car Make</label>
   <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter name" value="<?php echo $edit_car_model['name']; ?>">
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
$maker = $edit_car_model['make_id'];
$custum_js = <<<EOD
               <script type="text/javascript" language="javascript" >
                  jQuery('select[name=maker]').val('$maker');
               </script>

EOD;

	echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>
