<h3>Register Member</h3>

<div class="panel panel-default">
	<div class="panel-body">
		<center>
			<h4>Silakan masukan PIN dan ID barang yang Anda dapatkan dari Stokis</h4>
			<br/>
			<br/>
		
		<form class="form-inline" role="form" autocomplete="off" method="post" action="<?php echo route_url('auth', 'check_pin') ?>">
			<div class="form-group">
				<label class="sr-only" for="user_pin">PIN</label>
				<input required type="text" class="form-control" id="user_pin" name="user_pin" placeholder="Masukan PIN" />
			</div>
			<div class="form-group">
				<label class="sr-only" for="idbarang">ID Barang</label>
				<input required type="text" class="form-control" style="min-width:350px" id="idbarang" name="idbarang" placeholder="ID Barang (pisah dengan koma jika banyak)" />
			</div>
			<button type="submit" class="btn btn-default btn-info">Register</button>
		</form>

		</center>
	</div>
</div>

<div class="panel panel-default detail-wrapper" hidden>
	<div class="panel-body">
	
	
	
	</div>
</div>



<script type="text/javascript">
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/register.member.js"></script>
