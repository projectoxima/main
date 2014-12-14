<div class="col-md-12">
	<div class="bg-info" style="padding:10px">
		<p class="text-warning">Reserved to Member</p>
		<p class="">Menu ini digunakan ketika ada member lama atau member baru membeli produk</p>
	</div>
	<br/>
	
	<h3>Reserved to Member</h3>
	<div class="panel panel-default">
		<div class="panel-body">
			
		<form method="post" class="form-horizontal form-reserved-member" role="form" action="<?php echo route_url('reservedpin', 'reserved_member_save') ?>">
			<div class="form-group">
				<label class="col-md-3" for="idbarangs">Pilih ID Barang yang akan dijual</label>
				<div class="col-md-9">
					<table width="100%" class="table table-bordered" id="idbarangs">
						<thead><tr>
							<th width="10px">No</th><th>ID Barang</th><th>Status</th><th>Pilih</th>
						</tr></thead>
						<tbody>
						<?php foreach($daftar_barang as $idx=>$dbarang): ?>
						<tr>
							<td><?php echo $idx+1 ?></td>
							<td><?php echo $dbarang->idbarang ?></td>
							<td><?php echo $dbarang->status ?></td>
							<td align="center"><input type="checkbox" name="idbarang[]" value="<?php echo encode_id($dbarang->id) ?>" /></td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			
			
			
			
			
			<?php if(get_user()->group_id!=USER_MEMBER): ?>
			<div class="col-md-12 row">&nbsp;</div>
			
			<div class="col-md-3">
				<label>PIN Stokis</label>
			</div>
			<div class="col-md-9">
				<div class="col-md-4">
					<input type="text" class="form-control" name="stokis_pin" placeholder="PIN Stokis" required />
				</div>
			</div>
			<?php endif; ?>
			
			<div class="col-md-12 row">&nbsp;</div>
			
			<div class="col-md-3">
				<label>Pilih pembeli barang</label>
			</div>
			<div class="col-md-2">
				<div class="radio">
					<label>
					<input type="radio" name="member" id="member-aktif" value="aktif" checked>Member aktif
					</label>
				</div>
			</div>
			<div class="col-md-7">
				<div class="radio">
					<label>
					<input type="radio" name="member" id="member-baru" value="baru">Member baru
					</label>
				</div>
			</div>
			
			<div class="col-md-12 row">&nbsp;</div>
			
			<div class="col-md-9 col-md-offset-3 member-aktif">
				<p><i>Silakan masukan PIN Member yang membeli barang</i></p>
				<div class="col-md-4">
					<input type="text" class="form-control" name="input_pin" placeholder="Member PIN" />
				</div>
			</div>
			
			<div class="col-md-9 col-md-offset-3 member-baru" style="display:none;">
				<p><i>Silakan masukan data Member baru yang membeli barang</i></p>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input_nama" placeholder="Nama" />
				</div>
				<div class="col-md-8">
					<textarea class="form-control" name="input_alamat" placeholder="Alamat"></textarea>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input_ktp" placeholder="Nomor KTP" />
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input_norek" placeholder="Nomor Rekening" />
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input_namarek" placeholder="Nama Rekening" />
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="input_bank" placeholder="Nama Bank" />
				</div>
			</div>
			
			<div class="col-md-12 row">&nbsp;</div>
			
			<div class="col-md-3">
				<label>Biaya pembelian</label>
			</div>
			<div class="col-md-9">
				<p><i>Nilai pembelian per-barang</i></p>
				<input type="text" class="form-control" name="biaya" placeholder="Minimal Rp. 30.000" style="text-align:center" required />
			</div>
			
			<div class="col-md-12 row">&nbsp;</div>
			
			<div class="col-md-3">
				<button class="btn btn-primary btn-lg">Simpan</button>
			</div>
			
		</form>
		</div>
	</div>

<br/>

	<h3>Daftar Reserved</h3>
	<div class="panel panel-default">
		<div class="panel-body">
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if(count($daftar_barang)==0): ?>
	$(function(){
		$.growl.error({message: 'Anda belum memiliki ID Barang untuk dijual<br/>Silakan kontak admin'});
	});
	<?php endif; ?>
	window.reserved_pin_url = '<?php echo route_url('reservedpin', 'reserved_list') ?>';
</script>
<script src="<?php echo site_url(); ?>/assets/js/modules/reserved.to.member.js"></script>
