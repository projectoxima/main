<div class="col-md-12">
	<h3>Manage User</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<button class="btn btn-primary pull-right">Tambah User</button>
			<br/>
			<br/>
			<br/>
			
			<table class="table-user">
				<thead><tr>
					<th width="10px">No</th><th>Status</th><th>Nama lengkap</th><th>Alamat</th><th>Kota</th><th>Provinsi</th><th width="50px">Aksi</th>
				</tr></thead>
			</table>
		</div>
	</div>
	
</div>


<script type="text/javascript">
	window.user_list_url = '<?php echo route_url('manageuser', 'user_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/manage.user.js"></script>
