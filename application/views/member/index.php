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

		<div class="hide"><?php echo $tree; ?></div>
		<div id="orgchart-container"></div>
  </div>
</div>


<div class="modal" id="modal-view-profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" rel="tooltip" data-toggle="tooltip" title="Close Form">&times;</button>
        <h4 class="modal-title">Member Detail</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-view-profile">
					<div class="form-group">
						<label class="col-sm-4 control-label">Nama Lengkap</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="view-name" name="view-name" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Alamat</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="view-alamat" name="view-alamat" disabled>
						</div>
					</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" rel="tooltip" data-toggle="tooltip" title="Canceled">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?php echo site_url(); ?>/assets/js/orgchart/jquery.orgchart.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#org-chart').orgChart({
		  container: $('#orgchart-container'),
		  nodeClicked: function($node){
		    var id = $node.data('id');
		    $.ajax({
		      url: '<?php echo base_url();?>member/get_profile/' + id,
		      dataType: 'json'
		    })
		    .done(function(response, textStatus, jqhr){
		      if(response.status == "ok"){
		        $('#view-name').val(response.data.nama_lengkap);
		        $('#view-alamat').val(response.data.alamat);
		      }
		    })
		    .fail(function(){
		    	alert('fail');
		    });

		    $('#modal-view-profile').modal('show')
		  }
		});
	});
</script>