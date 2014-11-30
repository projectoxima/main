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
	?>" class="col-md-12 img-rounded"/>
	<strong><center><p>
		<?php 
			if($user->group_id==USER_ADMIN)
				echo print_warna('Admin', '#00f');
			if($user->group_id==USER_OPERATOR)
				echo print_warna('Operator', '#00a');
			if($user->group_id==USER_MEMBER)
				echo print_warna('Member', '#005');
		?>
	</p><p>
		<?php
			if($user->status==ACTIVE)
				echo print_warna('Aktif');
			else
				echo print_warna('Belum Aktif', 'red');
		?>
	</p></center></strong>
</div>

<div class="col-md-10">
	<div class="col-md-6 form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama lengkap</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->nama_lengkap ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Alamat</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->alamat ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Kota</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->kota ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Provinsi</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->propinsi ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Kode pos</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->kodepos ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">TTL</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->tempat_lahir .'/'. $user->tgl_lahir ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Agama</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->agama ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Jenis kelamin</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->jenis_kelamin ?></label>
			</div>
		</div>
	</div>
	<div class="col-md-6 form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 control-label">Phone</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->phone ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">KTP</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->ktp ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Email</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->email ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">No. rekening</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->no_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Bank</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->bank ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama rekening</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->nama_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama ahli waris</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->nama_ahli_waris ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Hubungan keluarga</label>
			<div class="col-sm-6  bg-info">
				<label class="control-label"><?php echo $user->hubungan_keluarga ?></label>
			</div>
		</div>
	</div>
</div>

<!-- tampil jika detail member -->
<?php if($user->group_id==USER_MEMBER): ?>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Histori Bonus</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label>Total Bonus Rp. </label>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Histori Repeat Order</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label>Jumlah Repeat Order </label>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Daftar Sponsor</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label></label>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Daftar Withdraw</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label>Total Withdraw Rp. </label>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Histori Report</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label> </label>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				<label>Network Graph</label>
			</div>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
			<div class="panel-title">
				<label></label>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>
