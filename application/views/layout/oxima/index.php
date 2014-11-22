<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">

		<title>Oxima</title>

		<link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/custom.css" rel="stylesheet">

		<style type="text/css">
		.navbar {
			margin-bottom: 20px;
		}
		ul.nav li.dropdown:hover > ul.dropdown-menu {
			display: block;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}
		ul.dropdown-menu li a{
			color: #000 !important;
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
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href=""></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
								<?php
									/* tampilkan menu topleft */
									echo generate_menu('top');
								?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php
									/* tampilkan menu topleft */
									//echo generate_menu('topright');
								?>
							</ul>
						</div>
					</div>
				</nav>
				<div class="col-md-7 putih">
					<div class="header-title"><?php echo APPTITLE; ?></div>
					<p class="header-desc"><?php echo web_content('HOME_TEXT_HEADER') ?></p>
				</div>
				<div class="col-md-5 hidden-sm hidden-xs pad-bottom">
					<center><img src="assets/img/Maqui Berry.jpg" class="radius" /></center>
				</div>
			</div>
		</div> 
		
		<div class="container">
			<div class="row">&nbsp;</div>
			<?php echo $content_for_layout ?>
		</div>
		
		<script src="assets/js/jquery/jquery-1.11.1.min.js"></script>
		<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>
