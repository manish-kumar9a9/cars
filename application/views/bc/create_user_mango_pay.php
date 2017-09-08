
<body>
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="http://www.jqueryscript.net/demo/Nice-Scrollable-Date-Selector-Plugin-With-jQuery-DateSelect/css/jquery.dateselect.css" rel="stylesheet" type="text/css">


<form action ="<?php echo base_url();?>index.php/Create_user_mango_pay/create_user" method="post">
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="first_name" >
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="last_name">
  </div>
  <div class="form-group">
    <label>AddressLine1</label>
    <input type="text" class="form-control" name="addressLine1">
  </div>
  <div class="form-group">
    <label>AddressLine2</label>
    <input type="text" class="form-control" name="addressLine2">
  </div>
  <div class="form-group">
    <label>City</label>
    <input type="text" class="form-control" name="city">
  </div>

 <div class="form-group">
   <label for="email">Birthday</label>
   <input type="text" class="form-control" name="birthday"  id="birthday" data-select="date">
 </div>

 <div class="form-group">
   <label for="email">Email</label>
   <input type="email" class="form-control" name="email">
 </div>
 <button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="http://www.jqueryscript.net/demo/Nice-Scrollable-Date-Selector-Plugin-With-jQuery-DateSelect/js/jquery.dateselect.js"></script>
