<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- base_url() = http://localhost/ventas_ci/-->

  <!-- Bootstrap 3.3.7 -->
    <link href="<?php echo base_url();?>assets/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/template/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/template/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    


   <!-- Bootstrap -->
   <link  href="<?php echo base_url();?>assets/template/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link  href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link  href="<?php echo base_url();?>assets/template/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link  href="<?php echo base_url();?>assets/template/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link  href="<?php echo base_url();?>assets/template/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link  href="<?php echo base_url();?>assets/template/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link  href="<?php echo base_url();?>assets/template/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
</head>


<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo base_url();?>auth/login" method="post">
              <h1>Ingreso al Sistema</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuario" name="username" required/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required />
              </div>
              <div>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               
                <br />

                <div>
                  <h1> COOPERATIVA CUZCACHAPA DE R.L</h1>
                  <p>©2023 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
           
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
