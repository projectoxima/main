<div class="col-md-6">
	<h3><?php echo $title ?></h3>
	
	<br/>
	
	<form class="form-horizontal" role="form" method="post"  autocomplete="off">
		<div class="form-group">
			<label class="col-md-3" for="email">Username</label>
			<div class="col-md-5">
				<input type="text" class="form-control" id="email" name="username" placeholder="Username" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3" for="pwd">Password</label>
			<div class="col-md-5">
				<input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?php echo empty($captcha) ? '':$captcha; ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8">
				<p>Masukan captcha diatas</p>
				<input type="text" class="form-control" name="captcha" placeholder="Captcha" required />
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Masuk</button>
	</form>
</div>
