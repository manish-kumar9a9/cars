<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS auth_panel_assets -->
    <link href="<?php echo base_url();?>auth_panel_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>auth_panel_assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>auth_panel_assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>auth_panel_assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>auth_panel_assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>auth_panel_assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>auth_panel_assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
          background: url(http://ec2-52-206-239-196.compute-1.amazonaws.com/urend-pro/assets/image/list-car-banner.jpg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
    </style>
</head>

  <body class="login-body">

    <div class="container">
      <form class="form-signin" method="POST" action="<?php echo site_url('auth_panel/login/index');?>">
        <h2 class="form-signin-heading">sign in to UREND</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="username" placeholder="User ID" >
            <input type="password" class="form-control" name="password" placeholder="Password">
            <label class="checkbox hide">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
        </div>

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>auth_panel_assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>auth_panel_assets/js/bootstrap.min.js"></script>


  </body>
</html>
