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

    body {
      background-image: url('../../assets/img/login/2.jpg');
    }
    </style>
  </head>
  <body>
    <section id="login_bg" class="visible">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="login-box">
              <h4 style="font-size: 24px;"><center><strong>Form Reset Password</strong></center></h4>
              <div class="divide-40"></div>
              <form id="form_reset_password" role="form" class="form-horizontal">
                <div class="form-group">
                  <label for="password">Password</label>
                  <i class="fa fa-lock"></i>
                  <input type="text" class="form-control" id="password" name="password">
                  <span for="password" class="error-span"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
                <!--
                <div class="form-group"> 
                  <label for="confirm_password">Confirm Password</label>
                  <i class="fa fa-lock"></i>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                -->
                <br>
                <div class="form-group"> 
                  <button id="btn_reset" class="btn btn-danger" type="button">Submit</button>
                </div>
                <input type="hidden" id="id_user" name="id_user" value="<?php echo $data_user['user_id'] ;?>">
              </form>
              <div class="login-helpers">
                <a href="<?php echo base_url() ;?>">Back to Homepage</a> <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- RESET PASSWORD SUCCESS -->
    <div class="modal fade" id="modal-reset-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Password Reset</h4>
          </div>
          <div class="modal-body">
            Reset Password Success.
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">OK</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /RESET PASSWORD SUCCESS -->

    <!-- JQUERY -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-2.0.3.min.js"></script>

    <!-- BOOTSTRAP -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- GROWL -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.growl.js"></script>

    <script type="text/javascript">
      // Reset Password
      $('#btn_reset').click(function(){
        $.ajax({
          url: '<?php echo base_url();?>auth/change_password',
          type: 'POST',
          data: $('#form_reset_password').serialize(),
          dataType: 'json'
        })
        .done(function(response, textStatus, jqhr){
          $.growl.notice({ message: "Reset password success." });
          /**
          $('#password').val('');
          $('#confirm_password').val('');
          $('#modal-reset-success').modal('show');
          */
        })
        .fail(function(){
          $.growl.error({ message: "Reset password failed. Please try again." });
        });
      });
    </script>
  </body>
</html>