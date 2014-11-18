<!-- <h2>Selamat</h2>
<h3>Datang</h3>
<h4>Oxima</h4>
<h4><?php // echo $text ?></h4>
 -->

<div class="row">
	<!-- Content -->
	<div id="content" class="col-md-8 box">
		<div class="container-fluid">
			<div class="col-md-3">
				<img src="<?php echo $product_image_1; ?>" class="img-circle img-responsive">
			</div>
			<div class="col-md-6">				
				<center>
					<h1><?php echo $product_title; ?></h1>
					<h4><?php echo $product_description_1; ?></h4>
					<h4><?php echo $product_description_2; ?></h4>
				</center>
			</div>
			<div class="col-md-3">
				<img src="<?php echo $product_image_1; ?>" class="img-circle img-responsive">
			</div>
		</div>
		<br>
		<div class="container-fluid">
			<?php echo $product_context; ?>
		</div>
	</div>

	<!-- Sidebar -->
	<div id="sidebar" class="col-md-4 box">
		<div class="panel panel-danger">
			<div class="panel-heading">
				Sidebar
			</div>
			<div class="panel-body">
				ini isi sidebar
				<br />
				<a href="<?php echo base_url() ;?>auth/login">Login</a>
				<br />
				<a href="<?php echo base_url() ;?>auth/logout">Logout</a>
			</div>
		</div>
	</div>
</div>