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
					<table width="100%" class="table table-bordered" id="tabel-idbarangs">
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
			
			<div class="form-group">
				<label class="col-md-3" for="biaya">Pembayaran member</label>
				<div class="col-md-4">
					<p><i><?php echo print_warna('Nilai pembelian per-barang') ?></i></p>
					<input type="text" id="biaya" class="form-control" name="biaya" placeholder="Minimal Rp. 30.000" style="text-align:right" required />
				</div>
			</div>
			
			<?php if(get_user()->group_id!=USER_MEMBER): ?>
			<div class="form-group">
				<label class="col-md-3" for="stokis_pin">PIN Stokis</label>
				<div class="col-md-4">
					<input type="text" id="stokis_pin" class="form-control" name="stokis_pin" placeholder="PIN Stokis" required />
				</div>
			</div>
			<?php endif; ?>
			
			<div class="form-group">
				<label class="col-md-3">Metode</label>
				<div class="col-md-9">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#gabung">Beli dan gabung ke network</a></li>
						<li><a data-toggle="tab" href="#beli">Hanya membeli</a></li>
					</ul>
					<div class="tab-content">
						<div id="gabung" class="tab-pane fade in active">
						<br/>
						<div class="form-group">
							<label class="col-md-3" for="pins">Pilih PIN untuk member</label>
							<div class="col-md-9">
								<table width="100%" class="table table-bordered" id="tabel-pins">
									<thead><tr>
										<th width="10px">No</th><th>PIN</th><th>Status</th><th>Pilih</th>
									</tr></thead>
									<tbody>
									<?php foreach($daftar_pin as $idp=>$dpin): ?>
									<tr>
										<td><?php echo $idp+1 ?></td>
										<td><?php echo $dpin->pin ?></td>
										<td><?php echo $dpin->status ?></td>
										<td align="center"><input type="radio" name="pin[]" value="<?php echo encode_id($dpin->id) ?>" /></td>
									</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						</div>
						
						<div id="beli" class="tab-pane fade in active"></div>
					</div>
				</div>
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
