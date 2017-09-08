<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
	<pre>
<?php

$user_data = $this->session->userdata();
	?>
</pre>	
	Welcome <b><?php echo $user_data['firstName']." ".$user_data['lastName']?></b>,</br></br>
	
	You login successfully.</br></br>
	
	Thanks

<a href="<?php echo base_url().'index.php/user/logout'; ?>"> Click here to logout.</a>
</body>
</html>