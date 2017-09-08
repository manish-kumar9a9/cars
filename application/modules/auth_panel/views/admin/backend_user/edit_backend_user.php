
<form action="" method="post">
 <div class="form-group">
   <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
   <label for="exampleInputEmail1">Email address</label>
   <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" value="<?php echo $user_data['email']; ?>">
    <span class="text-danger"><?php echo form_error('email');?></span>
 </div>
    <div class="form-group">
   <label for="exampleInputEmail1">User Name</label>
   <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter User Name" value="<?php echo $user_data['username']; ?>" >
   <span class="text-danger"><?php echo form_error('username');?></span>
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
   </select>
   <span class="text-danger"><?php echo form_error('role');?></span>
 </div>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
<p class="panel-heading">
      Change Password
</p>
<form action="<?php echo base_url('index.php/auth_panel/admin/change_password_backend_user');?>" name="change_password" method="post" autocomplete="off">
 <div class="form-group">
   <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
   <label for="exampleInputEmail1">New Password</label>
   <input type="text" class="form-control" name="new_password" id="new_password" placeholder="Enter new password" value="">
 </div>
    <div class="form-group">
   <label for="exampleInputEmail1">Conform Password</label>
   <input type="text" class="form-control"  name="conform_password" id="conform_password" placeholder="Enter conform password" value="">
 </div>
 <button type="submit" id="change_password" class="btn btn-primary">Submit</button>
</form>

<?php
$role = $user_data['roles'];
$custum_js = <<<EOD
               <script type="text/javascript" language="javascript" >
                  jQuery('select[name=role]').val('$role');
               </script>

               <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

                <script>
                $(function () {
                    $("form[name='change_password']").validate({
                        // Specify validation rules
                        rules: {
                            new_password: "required",
                            conform_password:{required: true, equalTo: "#new_password"}
                        },
                        // Specify validation error messages
                        messages: {
                            new_password: "Please enter new password.",
                            conform_password: {required: "Please enter conform password.", equalTo:"Password not match."}
                        },
                        submitHandler: function (form) {
                            form.submit();
                        }
                    });
                });

               
              $(function() {
                $('#new_password,#conform_password').on('keypress', function(e) {
                  if (e.which == 32)
                      return false;
                  });
              });
              </script>

EOD;

	echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>
