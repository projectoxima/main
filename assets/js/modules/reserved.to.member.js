$(function(){
	$('#tabel-idbarangs').dataTable({
			"sPaginationType": "two_button",
			"iDisplayLength" : 10,
			'bRetrieve': true,
			"bFilter": true,
			'sDom': 'lftp',
			"bLengthChange": false,
			"bInfo": false,
			"bJQueryUI": true,
			"aoColumnDefs": [
				  { 'bSortable': false, 'aTargets': [0,3] }
			]
		});
	$('#tabel-pins').dataTable({
			"sPaginationType": "two_button",
			"iDisplayLength" : 10,
			'bRetrieve': true,
			"bFilter": true,
			'sDom': 'lftp',
			"bLengthChange": false,
			"bInfo": false,
			"bJQueryUI": true,
			"aoColumnDefs": [
				  { 'bSortable': false, 'aTargets': [0,3] }
			]
		});
	
	window.mode = 'gabung';
	$('a[data-toggle="tab"]').on('click', function(e){
		pos = $('a[data-toggle="tab"]').index(this);
		if(pos==0)
			window.mode = 'gabung';
		else
			window.mode = 'beli';
		$('input[name=mode]').val(window.mode);
	});
	
	$('button').click(function(){
		idbs = $('input[type=checkbox]:checked');
		if(idbs.length==0){
			$.growl.error({message: 'ID Barang wajib dipilih satu atau lebih'});
			return;
		}
		
		byr = parseInt($('input[name=biaya]').val());
		if(isNaN(byr)){
			$.growl.error({message: 'Isi pembayaran awal dengan angka'});
			return;
		}
		if(byr<30000){
			$.growl.error({message: 'Pembayaran awal minimal Rp. 30.000'});
			return;
		}
		
		console.log(window.mode);
		
		if(window.mode=='gabung'){
			if($('input[name=name]:eq(0)').val().trim().length==0){
				$.growl.error({message: 'Nama harus diisi'});
				return;
			}
			if($('input[name=ktp]').val().trim().length==0){
				$.growl.error({message: 'Nomor KTP harus diisi'});
				return;
			}
			if($('input[name=bank]').val().trim().length==0){
				$.growl.error({message: 'Nama bank harus diisi'});
				return;
			}
			if($('input[name=norek]').val().trim().length==0){
				$.growl.error({message: 'Nomor rekening harus diisi'});
				return;
			}
			if($('input[name=namarek]').val().trim().length==0){
				$.growl.error({message: 'Nama rekening harus diisi'});
				return;
			}
			rdbs = $('input[type=radio]:checked');
			if(rdbs.length==0){
				$.growl.error({message: 'PIN wajib dipilih satu'});
				return;
			}
		}
		if(window.mode=='beli'){
			if($('input[name=name]:eq(1)').val().trim().length==0){
				$.growl.error({message: 'Nama harus diisi'});
				return;
			}
			if($('textarea[name=alamat]').val().trim().length==0){
				$.growl.error({message: 'Alamat harus diisi'});
				return;
			}
		}
		
		//~ $('form').submit();
		console.log($('form').serialize());
	});
});
