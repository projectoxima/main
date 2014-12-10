<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?php echo site_url(); ?>/assets/img/favicon.jpg">

		<title>Oxima</title>

		<link href="<?php echo site_url(); ?>/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/css/custom.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/css/jquery.growl.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/css/jquery.dataTables.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/js/fancy-box/jquery.fancybox.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/js/choosen/chosen.min.css" rel="stylesheet">
		<link href="<?php echo site_url(); ?>/assets/css/joint.min.css" rel="stylesheet">

		<script src="<?php echo site_url(); ?>/assets/js/joint.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/joint.shapes.org.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/jquery/jquery-1.11.1.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/fancy-box/jquery.fancybox.pack.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/jquery/jquery-ui.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/choosen/chosen.jquery.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/custom.js"></script>

		<style type="text/css">
		.navbar {
			margin-bottom: 20px;
		}
		ul.nav li.dropdown:hover > ul.dropdown-menu{
			display: block;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}
		ul.dropdown-menu li a{
			color: #000 !important;
		}
		ul.navbar-nav li.aktif{
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			background: #2d213c;
		}
		.box {
		    margin-right: 0px;
		    margin-left: 0px;
		    background-color: #FFF;
		    border-color: #DDD;
		    border-width: 1px;
		    border-radius: 4px 4px 0px 0px;
		    box-shadow: none;
		}
		</style>
	</head>

	<body>

		<div class="container header">
			<div class="col-md-12">
				<nav class="navbar navbar-default" role="navigation" style="margin:0; padding:0;">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo route_url('welcome','index') ?>"><?php 
								if(get_user()){
									switch(get_user()->group_id){
										case USER_ADMIN: echo 'Dashboard Administrator'; break;
										case USER_OPERATOR: echo 'Dashboard Operator'; break;
										case USER_MEMBER: echo 'Dashboard Member'; break;
									}
								}
							?></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<?php
									/* tampilkan menu top */
									echo generate_menu('top', $this->router->fetch_class(), $this->router->fetch_method());
								?>
							</ul>
						</div>
					</div>
				</nav>
				<?php if(get_user()==false): ?>
				<div class="row">&nbsp;</div>
				<div class="col-md-8 putih">
					<div class="header-title"><?php echo APPTITLE; ?></div>
					<p class="header-desc"><?php echo web_content('HOME_TEXT_HEADER') ?></p>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs pad-bottom">
					<center><img src="<?php echo site_url(); ?>assets/img/Maqui Berry.jpg" class="radius" /></center>
				</div>
				<?php endif; ?>
			</div>
		</div> 
		
		<div class="container" style="min-height:400px;">
			<div class="row">&nbsp;</div>
			<?php echo $content_for_layout ?>
		</div>
		
		<script src="<?php echo site_url(); ?>/assets/js/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/bootstrap/bootstrap-confirmation.js"></script>
		<script src="<?php echo site_url(); ?>/assets/js/jquery.growl.js"></script>
		<script type="text/javascript">
			$(function(){
				<?php if(isset($alert_success) && !empty($alert_success)): ?>
				$.growl.notice({message:'<?php echo addslashes($alert_success); ?>'});
				<?php endif; ?>
				<?php if(isset($alert_error) && !empty($alert_error)): ?>
				$.growl.error({message:'<?php echo addslashes($alert_error); ?>'});
				<?php endif; ?>
				<?php if(isset($alert_warning) && !empty($alert_warning)): ?>
				$.growl.error({message:'<?php echo addslashes($alert_warning); ?>'});
				<?php endif; ?>
			})
		</script>
	</body>
</html>