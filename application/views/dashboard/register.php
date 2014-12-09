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
				<input required type="text" class="form-control" id="user_pin" name="user_pin" placeholder="Masukan PIN" value="<?php echo isset($pin) ? $pin:'' ?>"/>
			</div>
			<div class="form-group">
				<label class="sr-only" for="idbarang">ID Barang</label>
				<input required type="text" class="form-control" style="min-width:350px" id="idbarang" name="idbarang" placeholder="ID Barang (pisah dengan koma jika banyak)" value="<?php echo isset($idbarang) ? implode(',', $idbarang):'' ?>" />
			</div>
			<button type="submit" class="btn btn-default btn-info">Register</button>
		</form>

		</center>
	</div>
</div>

<?php if(isset($reserved) && count($reserved)>0): ?>
<div class="panel panel-default detail-wrapper">
	<div class="panel-body">
		<h4>PIN Anda : <?php echo $reserved[0]->pin ?></h4>
		<p>Daftar ID Barang Anda : </p>
		<table class="table table-bordered">
			<thead><tr>
				<th width="50px">No</th><th>ID Barang</th><th width="200px">Status</th>
			</tr></thead>
			<tbody>
				<?php foreach($reserved as $idx=>$item): ?>
				<tr>
					<td><?php echo $idx+1 ?></td>
					<td><?php echo $item->idbarang ?></td>
					<td><?php echo $item->status==INACTIVE ? print_warna('Belum Aktif', 'red'):print_warna('Aktif') ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif; ?>

<?php if(isset($reserved) && count($reserved)==0): ?>
<div class="panel panel-default detail-wrapper">
	<div class="panel-body">
		<?php echo print_warna('PIN atau ID Barang yang Anda masukan tidak valid', 'red'); ?>
	</div>
</div>
<?php endif; ?>

<?php if(isset($user) && count($user)>0): ?>
<div class="panel panel-default detail-wrapper">
	<div class="panel-body">
		<h3>Silakan lengkapi data diri Anda</h3>
		<?php echo $this->load->view('admin/add_user', array(
			'user'=>$user,
			'is_register'=>true,
			'label_button'=>'Register',
			'post_url'=>route_url('auth', 'register'),
			'reserved'=>$reserved
		), true); ?>
	</div>
</div>
<?php endif; ?>

<script type="text/javascript">
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/register.member.js"></script>
