 <?php if(!empty($this->session->flashdata('success_message'))){?>
	  <div class="alert alert-success">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $this->session->flashdata('error_message'); ?>
		</div>
	  <?php }?>
<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
     <span class="text-danger"><?php echo form_error('email');?></span>
  </div>
     <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter User Name">
    <span class="text-danger"><?php echo form_error('username');?></span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
    <span class="text-danger"><?php echo form_error('password');?></span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Role</label>
    <select class="form-control m-bot15" name="role">
        <option value="CLAIM_HANDLER">Claim Handler</option>
        <option value="CONTENT_MANAGER">Content Update / Editor</option>
        <option value="HELP_DESK">Help Desk</option>
        <option value="PAYMENT_OPERATOR">Payment Operator</option>
        <option value="CUSTOMER_MANAGER">Pending Customers Management</option>
        <option value="SUPER_USER">Super User</option>  
	<option value="INSURANCE_PROVIDER">Insurance Provider</option>  	
    </select>
    <span class="text-danger"><?php echo form_error('role');?></span>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
