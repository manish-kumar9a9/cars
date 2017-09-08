
<form action="" method="post">
 <div class="form-group">
   <label for="exampleInputEmail1">Car Maker</label>
   <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter name" >
    <span class="text-danger"><?php echo form_error('name');?></span>
 </div>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
