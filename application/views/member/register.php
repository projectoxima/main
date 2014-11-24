<!--<h3>Register Page</h3>
<hr>
-->
<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>member/register" method="POST">
	<h3>Informasi Akun</h3>
	<hr>
	<div class="form-group">
		<label class="col-sm-2 control-label">Username</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Password</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="password" name="password" placeholder="Password">
		</div>
	</div>
	<!--
	<div class="form-group">
		<label class="col-sm-2 control-label">No. ID</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no-id" name="no-id" placeholder="Nomor ID">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">No. Sponsor</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no-sponsor" name="no-sponsor" placeholder="Nomor Sponsor">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Tanggal Pengajuan</label>
		<div class="col-sm-4">
			<input type="date" class="form-control" id="tanggal-pengajuan" name="tanggal-pengajuan" placeholder="Tanggal Pengajuan">
		</div>
	</div>
	-->
	<h3>Data Pribadi</h3>
	<hr>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Lengkap</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" placeholder="Nama Lengkap">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Alamat</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kota</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Propinsi</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="propinsi" name="propinsi" placeholder="Propinsi">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kode Post</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="kode-post" name="kode-post" placeholder="Kode Post">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Tempat/Tanggal Lahir</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="tempat-lahir" name="tempat-lahir" placeholder="Tempat Lahir">
		</div>
		<div class="col-sm-2">
			<input type="date" class="form-control" id="tgl-lahir" name="tgl-lahir" placeholder="Tanggal Lahir">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Agama</label>
		<div class="col-sm-4">
			<div class="radio">
			  <label>
			    <input type="radio" name="agama" id="agama-1" value="Islam">
			    Islam
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="agama" id="agama-2" value="Kristen">
			    Kristen
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="agama" id="agama-3" value="Katolik">
			    Katolik
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="agama" id="agama-4" value="Hindu">
			    Hindu
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="agama" id="agama-5" value="Budha">
			    Budha
			  </label>
			</div>
			<div class="col-sm-10">
				<label class="col-sm-4 control-label">Lain-lain</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="agama-lain">
				</div>			
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Jenis Kelamin</label>
		<div class="col-sm-4">
			<div class="radio">
			  <label>
			    <input type="radio" name="jenis-kelamin" id="jenis-kelamin-1" value="Laki-Laki">
			    Laki-Laki
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="jenis-kelamin" id="jenis-kelamin-2" value="Perempuan">
			    Perempuan
			  </label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Telp/HP</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Telp/HP">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">No KTP</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no-ktp" name="no-ktp" placeholder="Nomer KTP">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="email" name="email" placeholder="Email">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">No Rekening</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no-rekening" name="no-rekening" placeholder="Nomer Rekening">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Bank</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="bank" name="bank" placeholder="Bank">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Rekening</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama-rekening" name="nama-rekening" placeholder="Nama Rekening">
		</div>
	</div>
	<h3>Kuasa Ahli Waris</h3>
	<hr>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Lengkap</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama-ahli-waris" name="nama-ahli-waris" placeholder="Nama Lengkap Ahli Waris">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Hubungan Keluarga</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="hubungan-keluarga" name="hubungan-keluarga" placeholder="Hubungan Keluarga">
		</div>
	</div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
  </div>
</form>