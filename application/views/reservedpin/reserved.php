<div class="col-md-12">
	
	<?php if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])): ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h3>Input Reserved PIN</h3>
			<br/>
			<br/>
			<form class="form-horizontal form-reserved" role="form" method="post" action="<?php echo route_url('reservedpin', 'add') ?>">
				<div class="form-group">
					<label class="col-md-2" for="pin_id">PIN</label>
					<div class="col-md-4">
						<select class="form-control" id="pin_id" name="pin_id" data-placeholder="Pilih PIN" required>
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="user_id">Pemilik PIN</label>
					<div class="col-md-4">
						<select class="form-control" id="user_id" name="user_id" data-placeholder="Pemilik PIN" required>
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="parent_id">Parent</label>
					<div class="col-md-4">
						<select class="form-control" id="parent_id" name="parent_id" data-placeholder="Parent PIN">
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2" for="idbarang_id">ID Barang</label>
					<div class="col-md-10">
						<select class="form-control" id="idbarang_id" name="idbarang_id" multiple data-placeholder="ID Barang" required>
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<input type="hidden" name="idbarang" />
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
			<th width="10px">No</th><th>Pemilik</th><th>Parent</th><th>PIN</th><th>ID Barang</th><th>Status</th><th>Create Time</th>
			<?php if(in_array(get_user()->group_id, [USER_ADMIN, USER_OPERATOR])): ?>
			<th>Aksi</th>
			<?php endif; ?>
		</tr></thead>
	</table>
	
	
</div>

<script type="text/javascript">
	window.reserved_pin_url = '<?php echo route_url('reservedpin', 'reserved_list') ?>';
	window.reserved_active_idbarang_url = '<?php echo route_url('reservedpin', 'idbarang_list') ?>';
	window.reserved_active_pin_url = '<?php echo route_url('reservedpin', 'pin_list') ?>';
	window.reserved_stokis_url = '<?php echo route_url('reservedpin', 'stokis_list') ?>';
	window.reserved_parent_url = '<?php echo route_url('reservedpin', 'parent_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/reserved.pin.js"></script>
