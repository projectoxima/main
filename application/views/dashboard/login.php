<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Oxima Project">
    <meta name="author" content="Oxima">

    <title>Oxima Project</title>

    <!--<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.ico.png">-->

    <!-- STYLESHEETS -->
    <!--
      [if lt IE 9]>
        <script src="js/flot/excanvas.min.js"></script>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
      <![endif]
    -->

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" type="text/css"  href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" />

    <!-- CLOUD ADMIN -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/cloud-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

    <!-- ANIMATE -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animatecss/animate.min.css" />

    <!-- GROWL -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.growl.css" />

    <!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

    <style type="text/css">
    .login-box {
      width: 400px !important;
    }
    </style>
  </head>
  <body class="login">  
    <!-- PAGE -->
    <section id="page">
        <!-- HEADER -->
        <header>
          <!-- NAV-BAR -->
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div id="logo">
                </div>
              </div>
            </div>
          </div>
          <!--/NAV-BAR -->
        </header>
        <!--/HEADER -->
        <!-- LOGIN -->
        <section id="login_bg" class="visible">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="login-box">
                  <h4 style="font-size: 24px;"><center><strong>Oxima</strong></center></h4>
                  <div class="divide-40"></div>

                  <h4 style="font-size: 24px;"><center><strong>Login Form</strong></center></h4>
                  <div class="divide-40"></div>

                  <form role="form" action="<?php echo base_url(); ?>auth/do_login" method="POST">
                    <div class="form-group">
                      <label>Username</label>
                      <i class="fa fa-user"></i>
                      <input type="text" class="form-control" name="username">
                      <span for="username" class="error-span"><?php echo $this->session->flashdata('message'); ?></span>
                    </div>
                    <div class="form-group"> 
                      <label>Password</label>
                      <i class="fa fa-lock"></i>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group"> 
                      <label>PIN</label>
                      <i class="fa fa-keyboard-o"></i>
                      <input type="text" class="form-control" name="pin">
                    </div>
                    <div class="form-group"> 
                      <label>ID</label>
                      <i class="fa fa-keyboard-o"></i>
                      <input type="text" class="form-control" name="id">
                    </div>
                    <div>
                      <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </form>
                  <div class="login-helpers">
                    <a href="#" onclick="swapScreen('forgot_bg');return false;">Forgot Password?</a> <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/LOGIN -->
        <!-- FORGOT PASSWORD -->
        <section id="forgot_bg">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="login-box">
                  <h2 class="bigintro">Reset Password</h2>
                  <div class="divide-40"></div>
                  <form id="form_forgot_password" role="form" class="form-horizontal">
                    <div class="form-group">
                      <label for="email">Enter your Email address</label>
                      <i class="fa fa-envelope"></i>
                      <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <br>
                    <div class="form-group">
                      <button id="btn_forgot_password" class="btn btn-info" type="button">Reset Password</button>
                    </div>
                  </form>
                  <div class="login-helpers">
                    <a href="#" onclick="swapScreen('login_bg');return false;">Back to Login</a> <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- FORGOT PASSWORD -->
    </section>

    <!-- EMAIL TIDAK TERDAFTAR -->
    <div class="modal fade" id="modal-error-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Password Reset</h4>
          </div>
          <div class="modal-body">
            User dengan alamat email "<span id="alamat_email"></span>" tidak dikenal, silakan coba lagi masukkan alamat email anda.
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /EMAIL TIDAK TERDAFTAR -->

    <!-- CEK EMAIL -->
    <div class="modal fade" id="modal-cek-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Password Reset</h4>
          </div>
          <div class="modal-body">
            Link untuk melakukan reset password sudah dikirim melalui email. Mohon periksa email anda.
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /CEK EMAIL -->

    <!--/PAGE -->

    <!-- JAVASCRIPTS -->    
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- JQUERY -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-2.0.3.min.js"></script>

    <!-- BOOTSTRAP -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- GROWL -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.growl.js"></script>

    <!-- CUSTOM SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
    <script type="text/javascript">
      // Forgot Password
      $('#btn_forgot_password').click(function(){
        $.ajax({
          url: '<?php echo base_url();?>auth/forgot_password',
          type: 'POST',
          data: $('#form_forgot_password').serialize(),
          dataType: 'json'
        })
        .done(function(response, textStatus, jqhr) {
          if(response.status == 'error') {
            $.growl.warning({ message: "Alamat email tidak dikenali." });
            /**
            var email = $('#email').val();
            $('#alamat_email').html(email);
            $('#email').val('');
            $('#modal-error-email').modal('show');
            */
          } else {
            $.growl.notice({ message: "Link untuk melakukan reset password sudah dikirim melalui email. Mohon periksa email anda." });
            /**
            $('#email').val('');
            $('#modal-cek-email').modal('show');
            */
          }
        })
        .fail(function(){
          $.growl.error({ message: "Reset password error, silahkan coba lagi." });
            /**
            var email = $('#email').val();
            $('#alamat_email').html(email);
            $('#email').val('');
            $('#modal-error-email').modal('show');
            */
        });
      });

      function swapScreen(id) {
        $('.visible').removeClass('visible animated fadeInUp');
        $('#'+id).addClass('visible animated fadeInUp');
      }
    </script>
    <!-- /JAVASCRIPTS -->
  </body>
</html>