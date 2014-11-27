<div class="col-md-6">
	<h4>Manage PIN</h4>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<p>Jumlah pin aktif : <?php echo $pin_resume->active ?></p>
			<p>Jumlah pin reserved : <?php echo $pin_resume->reserved ?></p>
			<p>Jumlah pin belum aktif : <?php echo $pin_resume->inactive ?></p>
			
			<button class="btn btn-primary pull-right" onclick="$.fancybox({href:'#form-create-pin'});">Buat PIN</button>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table-pin"><thead><tr>
				<th width="5px">No.</th><th>PIN</th><th>Status</th><th>Pemilik</th><th>Dibuat Tanggal</th>
			</tr></thead></table>
		</div>
	</div>
</div>


<div class="col-md-6">
	<h4>Manage ID Barang</h4>
	
	<div class="panel panel-default">
		<div class="panel-body">
		</div>
	</div>
</div>


<div id="form-create-pin" hidden>
	<div class="container">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" method="post" action="<?php echo route_url('admin', 'generate_pin') ?>">
				<div class="form-group">
					<label class="col-md-3 col-md-offset-2" for="num">Jumlah PIN yang akan dibuat</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="num" name="num" placeholder="Jumlah PIN" required/>
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-success">Buat PIN</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.pin_list_url = '<?php echo route_url('admin', 'pin_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/manage.pin.idbarang.js"></script>
