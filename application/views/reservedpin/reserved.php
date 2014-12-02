<div class="col-md-12">
	
	<?php if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])): ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h3>Input Reserved PIN</h3>
			<br/>
			<br/>
			<form class="form-horizontal" role="form" method="post" action="<?php echo route_url('reservedpin', 'add') ?>">
				<div class="form-group">
					<label class="col-md-2" for="pin_id">PIN</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="pin_id" name="pin_id" placeholder="PIN" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="user_id">Pemilik PIN</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="user_id" name="user_id" placeholder="Pemilik PIN" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="parent_id">Parent</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="Parent PIN"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="idbarang_id">ID Barang</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="idbarang_id" name="idbarang_id" placeholder="ID Barang" required/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php endif; ?>
	
	<br/>
	<br/>
	
	<table class="table-reserved">
		<thead><tr>
			<th width="10px">No</th><th>PIN</th><th>ID Barang</th><th>Parent</th><th>Pemilik</th><th>Status</th><th>Create Time</th><th>Aksi</th>
		</tr></thead>
	</table>
	
	
</div>

<script type="text/javascript">
	window.reserved_pin_url = '<?php echo route_url('reservedpin', 'reserved_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/reserved.pin.js"></script>
