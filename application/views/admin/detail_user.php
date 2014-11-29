<h3>Detail User</h3>

<br/>

<div class="col-md-2">
	<img src="<?php 
		if(empty($user->photo)){
			if(!file_exists(url_photo($user->photo)))
				echo url_image('user.jpg');
			else
				echo url_photo($user->photo);
		}else
			echo url_image('user.jpg');
	?>" class="col-md-12"/>
</div>

<div class="col-md-10">
	<div class="col-md-6 form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama lengkap</label>
			<div class="col-sm-6">
				<label class="control-label"><?php echo $user->nama_lengkap ?></label>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
</div>
