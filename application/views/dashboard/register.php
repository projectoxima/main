<h3>Aktivasi Member</h3>

<div class="panel panel-default">
	<div class="panel-body">
		<center>
			<h4>Silakan masukan PIN dan ID barang yang Anda dapatkan dari Stokis</h4>
			<br/>
			<br/>
		
		<form class="form-inline" role="form" autocomplete="off" method="post" action="<?php echo route_url('auth', 'check_pin') ?>">
			<div class="form-group">
				<label class="sr-only" for="user_pin">PIN</label>
				<input required type="text" class="form-control" id="user_pin" name="user_pin" placeholder="Masukan PIN" value="<?php echo isset($pin) ? $pin->pin:'' ?>"/>
			</div>
			<div class="form-group">
				<label class="sr-only" for="idbarang">ID Barang</label>
				<input required type="text" class="form-control" style="min-width:350px" id="idbarang" name="idbarang" placeholder="ID Barang (pisah dengan koma jika banyak)" value="<?php echo isset($idbarang) ? implode(',', $idbarang):'' ?>" />
			</div>
			<button type="submit" class="btn btn-default btn-info">Aktivasi</button>
		</form>

		</center>
	</div>
</div>

<?php if(isset($reserved) && count($reserved)>0): ?>
<div class="panel panel-default detail-wrapper">
	<div class="panel-body">
		<h4>PIN Anda : <?php echo $pin->pin ?></h4>
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

<?php if(isset($user)): ?>
<div class="panel panel-default detail-wrapper">
	<div class="panel-body">
		<?php if(!empty($user) && $user->status==ACTIVE): ?>
			<?php echo print_warna('Akun sudah aktif, Anda tidak dapat mengaktivasi PIN dan ID Barang', 'red'); ?>
		<?php else: ?>
			<h3>Silakan lengkapi informasi akun anda</h3>
			<div class="col-md-12">
				<form method="post" role="form" class="form-horizontal" action="<?php echo route_url('auth', 'register') ?>">
					<input type="hidden" name="user_id" value="<?php echo isset($user->id) ? $user->id:'' ?>" />
					<div class="form-group">
						<label class="col-md-3" for="pins">Nama</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="nama_lengkap" value="<?php echo isset($user->nama_lengkap) ? $user->nama_lengkap:'' ?>" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Nomor KTP</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="ktp" value="<?php echo isset($user->ktp) ? $user->ktp:'' ?>" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Nama Bank</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="bank" value="<?php echo isset($user->bank) ? $user->bank:'' ?>" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Nomor rekening</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="norek" value="<?php echo isset($user->no_rekening) ? $user->no_rekening:'' ?>" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Atas nama</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="namarek" value="<?php echo isset($user->nama_rekening) ? $user->nama_rekening:'' ?>" required/>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-md-3" for="pins">Username</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="username" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Password</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="password" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3" for="pins">Konfirmasi Password</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="konfirmasi" required/>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-lg" type="submit">Aktifkan</button>
					</div>
				</form> 
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<script type="text/javascript">
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/register.member.js"></script>
