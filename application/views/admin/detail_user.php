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
			<div class="col-sm-6	bg-info">
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
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->phone ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">KTP</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->ktp ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Email</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->email ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">No. rekening</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->no_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Bank</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->bank ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama rekening</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->nama_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama ahli waris</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->nama_ahli_waris ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Hubungan keluarga</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->hubungan_keluarga ?></label>
			</div>
		</div>
	</div>
</div>

<!-- tampil jika detail member -->
<?php if($user->group_id==USER_MEMBER): ?>

<div class="col-md-12">

	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#pageBonus">Daftar Bonus</a></li>
		<li><a data-toggle="tab" href="#pageRepeatOrder">Daftar Repeat Order</a></li>
		<li><a data-toggle="tab" href="#pageParent">Daftar Parent Sponsor</a></li>
		<li><a data-toggle="tab" href="#pageWithdraw">Daftar Withdraw</a></li>
		<li><a data-toggle="tab" href="#pageReport">Daftar Report</a></li>
		<li class="dropdown" style="display:none;">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a data-toggle="tab" href="#dropdown1">Dropdown1</a></li>
				<li><a data-toggle="tab" href="#dropdown2">Dropdown2</a></li>
			</ul>
		</li>
	</ul>
	
	<div class="tab-content">
		<div id="pageBonus" class="tab-pane fade in active">
			<h3>Daftar Bonus</h3>
			<?php echo $this->load->view('admin/detail_bonus', '', true); ?>
		</div>
		<div id="pageRepeatOrder" class="tab-pane fade">
			<h3>Daftar Repeat Order</h3>
			<?php echo $this->load->view('admin/detail_repeat_order', '', true); ?>
		</div>
		<div id="pageParent" class="tab-pane fade">
			<h3>Daftar Parent Sponsor</h3>
			<?php echo $this->load->view('admin/detail_sponsor', '', true); ?>
		</div>
		<div id="pageWithdraw" class="tab-pane fade">
			<h3>Daftar Withdraw</h3>
			<?php echo $this->load->view('admin/detail_withdraw', '', true); ?>
		</div>
		<div id="pageReport" class="tab-pane fade">
			<h3>Daftar Report</h3>
			<?php echo $this->load->view('admin/detail_report', '', true); ?>
		</div>
	</div>

</div>

<?php endif; ?>
