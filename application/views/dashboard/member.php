<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Member Dashboard</h3>
  </div>
  <div class="panel-body">
  	<form class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-sm-2 control-label">Nama Lengkap</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" value="<?php echo $profile['nama_lengkap'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Alamat</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $profile['alamat'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Kota</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="kota" name="kota" value="<?php echo $profile['kota'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Propinsi</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="propinsi" name="propinsi" value="<?php echo $profile['propinsi'] ;?>" disabled>
				</div>
			</div>
  	</form>
  </div>
</div>
<a href="<?php echo base_url() ;?>register">Add Member</a><br>
<span for="username" class="error-span"><?php echo $this->session->flashdata('success'); ?></span>