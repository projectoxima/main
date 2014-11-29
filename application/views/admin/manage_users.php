<div class="col-md-12">
	<h3>Manage User</h3>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-6">
				<p>Total akun member : <?php echo $member_resume->total ?></p>
				<p>Total member aktif : <?php echo $member_resume->aktif ?></p>
			</div>
			<div class="col-md-6">
				<button class="btn btn-primary pull-right" onclick="$.fancybox({href:'#form-create-user', helpers : { overlay : { closeClick: false}}});">Tambah User</button>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table-user">
				<thead><tr>
					<th width="10px">No</th><th>Group</th><th>Status</th>
					<th>Nama lengkap</th><th>Alamat</th><th>Kota</th><th>Provinsi</th><th width="50px">Aksi</th>
				</tr></thead>
			</table>
		</div>
	</div>
	
</div>


<div id="form-create-user" hidden>
	<div class="container">
		<div class="col-md-12">
			<?php echo $this->load->view('admin/add_user', '', true); ?>
		</div>
	</div>
</div>


<script type="text/javascript">
	window.user_list_url = '<?php echo route_url('manageuser', 'user_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/manage.user.js"></script>
