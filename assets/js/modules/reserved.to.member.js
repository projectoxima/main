$(function(){
	
	$('input[type=radio]').change(function(){
		ids = $(this).val();
		if(ids=='aktif'){
			$('.member-aktif').fadeIn();
			$('.member-baru').hide();
		}else{
			$('.member-aktif').hide();
			$('.member-baru').fadeIn();
		}
	});
	
	$('button').click(function(){
		idbs = $('input[type=checkbox]:checked');
		if(idbs.length==0){
			$.growl.error({message: 'ID Barang wajib dipilih satu atau lebih'});
			return;
		}
		
		mbr = $('input[type=radio]:checked').val();
		if(mbr=='aktif'){
			mbr_pin = $('input[name=input_pin]').val();
			if(mbr_pin.length==0){
				$.growl.error({message: 'PIN member wajib diisi'});
				return;
			}
		}else{
			if($('input[name=input_nama]').val().length==0){
				$.growl.error({message: 'Nama member baru wajib diisi'});
				return;
			}
			if($('textarea[name=input_alamat]').val().length==0){
				$.growl.error({message: 'Alamat member baru wajib diisi'});
				return;
			}
			if($('input[name=input_ktp]').val().length==0){
				$.growl.error({message: 'KTP member baru wajib diisi'});
				return;
			}
			if($('input[name=input_norek]').val().length==0){
				$.growl.error({message: 'No rekening member baru wajib diisi'});
				return;
			}
			if($('input[name=input_namarek]').val().length==0){
				$.growl.error({message: 'Nama rekening member baru wajib diisi'});
				return;
			}
			if($('input[name=input_bank]').val().length==0){
				$.growl.error({message: 'Nama bank wajib diisi'});
				return;
			}
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
		
		$('form').submit();
	});
});
