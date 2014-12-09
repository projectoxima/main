<link href="<?php echo site_url(); ?>/assets/js/orgchart/jquery.orgchart.css" rel="stylesheet">
<link href="<?php echo site_url(); ?>/assets/js/orgchart/custom.css" rel="stylesheet">

<a class="btn btn-primary" href="<?php echo base_url() ;?>member/add_member">Add Member</a>
<br><br>
<span for="username" class="error-span"><?php echo $this->session->flashdata('success'); ?></span>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Member Dashboard</h3>
  </div>
  <div class="panel-body">
  	<form class="form-horizontal" role="form">
  		<h3>Biodata</h3>
  		<hr>
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
  		<h3>Member Data</h3>
  		<hr>
  		<?php
  			// Get PIN
  			$pin = $this->members->find_pin($this->session->userdata('pin_id'));
  		?>
			<div class="form-group">
				<label class="col-sm-2 control-label">PIN</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="<?php echo $pin['pin'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Tanggal Masuk/Daftar</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="tgl-masuk" name="tgl-masuk" value="<?php echo $profile['tgl_pengajuan'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Member</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="1250" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Bonus</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="Rp. 2.757.000" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah PO</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="120" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Point</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="310" disabled>
				</div>
			</div>
  	</form>
  	<h3>Member Tree</h3>
  	<hr>

  	<div class="hide">
			<ul id='chart-source'>
                <li>Asep
                    <ul>
                        <li>Budi<br/>
                            <ul>
                                <li>Jaka</li>
                                <li>Cecep</li>
                                <li>Kamaluddin</li>
                            </ul>
                        </li>
                        <li>Dede<br/>
                            <ul>
                                <li>Eep</li>
                                <li>Fariz</li>
                                <li>Luna</li>
                            </ul>
                        </li>
                        <li>Gunawan<br/>
                            <ul>
                                <li>Hismi</li>
                                <li>Ijang</li>
                                <li>Maya</li>
                            </ul>
                        </li>
                    </ul>
                </li>
			</ul>
		</div>

		<div id='chart-container'>
		</div>
  </div>
</div>
<script src="<?php echo site_url(); ?>/assets/js/orgchart/jquery.orgchart.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#chart-source').orgChart({container: $('#chart-container')});
	});
</script>