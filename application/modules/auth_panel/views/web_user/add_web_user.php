<section class="panel">
<header class="panel-heading">
<?php echo $this->session->flashdata('success'); ?>
     ADD USER
</header>
        <div class="panel-body">
            <form role="form" name="signup" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="address">First Name</label>
                    <input class="form-control" id="first_name" placeholder="Enter First Name" name="firstName" type="text">
                </div>
                <div class="form-group">
                    <label for="address">Last Name</label>
                    <input class="form-control" id="last_name" placeholder="Enter Last Name" name="lastName" type="text">
                </div>
                <div class="form-group col-md-13">
                    <label for="address">Mobile</label>
                    <div class="form-group col-md-13">
                        <select name="countryCode" class="form-control m-bot15">
				<?php foreach($country_code as $cc){
					echo "<option value='+". $cc['country_mobile_code']."'>". $cc['country']."</option>";
				} ?>			
                        </select>
                    </div>
                    <div class="form-group col-md-13">
                        <input class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" type="text">
                    </div>
                </div>
                <div class="form-group  custom_date_ranger">
                    <label class="control-label">Date of birth</label>
                        <input class="form-control dpd2" name="dob" placeholder="Date of birth" readonly="" type="text">
                </div>
                <div class="form-group">
                    <label for="address">E-mail</label>
                    <input class="form-control" id="email" placeholder="Enter E-mail" name="email" type="text">
                </div>
                <div class="form-group">
                    <label for="address">Password</label>
                    <input class="form-control" id="password" placeholder="Enter Password" name="password" type="text">
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        </section>
 <?php
$auth_assets = AUTH_ASSETS;
$custum_js = <<<EOD
<script type="text/javascript" src="{$auth_assets}assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{$auth_assets}assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{$auth_assets}js/advanced-form-components.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>


            $(function () {
                $("form[name='signup']").validate({
                    // Specify validation rules
                    rules: {
                        firstName: "required",
                        lastName: "required",
                        password: {required: true, minlength: 8},
                        email: {required: true, email: true}
                    },
                    // Specify validation error messages
                    messages: {
                        firstName: "Please enter your first name",
                        lastName: "Please enter your last name.",
                        password: {required: "Please enter Password", minlength: "Please enter min 8 digits",},
                        email: {required: "Please enter email", email: "Please enter valid email"}
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
</script>
EOD;

    echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>