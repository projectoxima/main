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

		<style type="text/css">
		body {
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.navbar {
			margin-bottom: 20px;
		}
		ul.nav li.dropdown:hover > ul.dropdown-menu {
			display: block;		
		}
		</style>
	</head>

	<body>

		<div class="container">

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
								echo generate_menu('topleft');
							?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<?php
								/* tampilkan menu topleft */
								echo generate_menu('topright');
							?>
						</ul>
					</div>
				</div>
			</nav>

		
			<?php echo $content_for_layout ?>

		</div> 
		
		<script src="assets/js/jquery/jquery-1.11.1.min.js"></script>
		<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>
