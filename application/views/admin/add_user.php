<?php
	$isreg = isset($is_register) ? $is_register:false;
?>
<form class="form-horizontal" role="form" action="<?php echo isset($post_url) ? $post_url:route_url('manageuser', 'add_user') ?>" method="POST">
	
	<input type="hidden" name="id" value="<?php echo isset($user) ? encode_id($user->id):'' ?>" />
	
	<?php if($isreg):	//jika mode register ?>
		<input type="hidden" name="pin_id" value="<?php echo encode_id($reserved[0]->pin_id) ?>" />
		<?php foreach($reserved as $idx=>$item): ?>
			<input type="hidden" name="idbarang_id[]" value="<?php echo encode_id($item->idbarang_id) ?>" />
		<?php endforeach; ?>
	<?php endif; ?>
	
	<div class="col-md-12">
		<h4>Informasi Akun</h4>
		<hr>
		
		<?php if(!$isreg): //tampil ketika insert dan update member ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Akses</label>
			<div class="col-sm-7">
				<div class="radio">
					<label>
						<input type="radio" name="akses" id="akses-1" value="<?php echo USER_MEMBER ?>" checked> Member
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="akses" id="akses-2" value="<?php echo USER_OPERATOR ?>"> Operator
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="akses" id="akses-3" value="<?php echo USER_ADMIN ?>"> Admin
					</label>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Username</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="username" name="username" placeholder="Username" required value="<?php echo isset($user) ? $user->username:'' ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Password</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="password" name="password" placeholder="Password" required/>
			</div>
		</div>
		
		<?php if($isreg):	// tampil ketika mode register member ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Password konfirmasi</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="password2" name="password2" placeholder="Password konfirmasi" required min="5">
			</div>
		</div>
		<?php endif; ?>
	</div>
	
	<div class="col-md-12">
		<h4>Data Pribadi</h4>
		<hr>
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-4 control-label">Nama Lengkap</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" placeholder="Nama Lengkap" required value="<?php echo isset($user) ? $user->nama_lengkap:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Alamat</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required value="<?php echo isset($user) ? $user->alamat:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Kota</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="kota" name="kota" placeholder="Kota" required value="<?php echo isset($user) ? $user->kota:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Propinsi</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="propinsi" name="propinsi" placeholder="Propinsi" required value="<?php echo isset($user) ? $user->propinsi:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Kode Post</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="kode-post" name="kode-post" placeholder="Kode Post" value="<?php echo isset($user) ? $user->kodepos:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Tempat/Tanggal Lahir</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="tempat-lahir" name="tempat-lahir" placeholder="Tempat Lahir" value="<?php echo isset($user) ? $user->tempat_lahir:'' ?>">
				</div>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="tgl-lahir" name="tgl-lahir" placeholder="Tanggal Lahir" value="<?php echo isset($user) ? $user->tgl_lahir:'' ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Agama</label>
				<div class="col-sm-7">
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-1" value="Islam" <?php echo (isset($user) && $user->agama=='Islam') ? 'checked':'' ?> >
						Islam
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-2" value="Kristen" <?php echo (isset($user) && $user->agama=='Kristen') ? 'checked':'' ?> >
						Kristen
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-3" value="Katolik" <?php echo (isset($user) && $user->agama=='Katolik') ? 'checked':'' ?> >
						Katolik
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-4" value="Hindu" <?php echo (isset($user) && $user->agama=='Hindu') ? 'checked':'' ?> >
						Hindu
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-5" value="Budha" <?php echo (isset($user) && $user->agama=='Budha') ? 'checked':'' ?> >
						Budha
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="agama" id="agama-6" value="Lainnya" <?php echo (isset($user) && $user->agama=='Lainnya') ? 'checked':'' ?> >
						Lainnya
					  </label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-4 control-label">Jenis Kelamin</label>
				<div class="col-sm-7">
					<div class="radio">
					  <label>
						<input type="radio" name="jenis-kelamin" id="jenis-kelamin-1" value="Laki-Laki" <?php echo (isset($user) && $user->jenis_kelamin=='Laki-laki') ? 'checked':'' ?> >
						Laki-Laki
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="jenis-kelamin" id="jenis-kelamin-2" value="Perempuan" <?php echo (isset($user) && $user->jenis_kelamin=='Perempuan') ? 'checked':'' ?>>
						Perempuan
					  </label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Telp/HP</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="phone" name="phone" placeholder="Telp/HP" value="<?php echo isset($user) ? $user->phone:'' ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">No KTP</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="no-ktp" name="no-ktp" placeholder="Nomer KTP" required value="<?php echo isset($user) ? $user->ktp:'' ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Email</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($user) ? $user->email:'' ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">No Rekening</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="no-rekening" name="no-rekening" placeholder="Nomer Rekening" required value="<?php echo isset($user) ? $user->no_rekening:'' ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Bank</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="bank" name="bank" placeholder="Bank" required value="<?php echo isset($user) ? $user->bank:'' ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Nama Rekening</label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="nama-rekening" name="nama-rekening" placeholder="Nama Rekening" required value="<?php echo isset($user) ? $user->nama_rekening:'' ?>" />
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<h4>Kuasa Ahli Waris</h4>
		<hr>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nama Lengkap</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="nama-ahli-waris" name="nama-ahli-waris" placeholder="Nama Lengkap Ahli Waris" required value="<?php echo isset($user) ? $user->nama_ahli_waris:'' ?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Hubungan Keluarga</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="hubungan-keluarga" name="hubungan-keluarga" placeholder="Hubungan Keluarga" required value="<?php echo isset($user) ? $user->hubungan_keluarga:'' ?>" />
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary btn-lg pull-right"><?php echo isset($label_button) ? $label_button:'Simpan' ?></button>
		</div>
	</div>
</form>
