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
	
	$('button.button-submit').click(function(){
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
			if($('input[name=name1]').val().trim().length==0){
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
		}
		if(window.mode=='beli'){
			if($('input[name=name2]').val().trim().length==0){
				$.growl.error({message: 'Nama harus diisi'});
				return;
			}
			if($('textarea[name=alamat]').val().trim().length==0){
				$.growl.error({message: 'Alamat harus diisi'});
				return;
			}
		}
		
		if($('input[name=pembeli_id]').val().trim().length==0){
			if($('input[type=radio]:checked').length==0){
				$.growl.error({message: 'Untuk member baru, anda harus memilih PIN'});
				return;
			}
		}
		
		$.post(window.cek_ktp_url, {ktp: $('input[name=ktp]').val()}, function(res){
			if(res.result){
				$.post(window.cek_norek_url, {norek: $('input[name=norek]').val()}, function(res){
					if(res.result){
						$('form').submit();
					}else{
						$.growl.error({message: 'Nomor rekening sudah dipakai'});
					}
				}, 'json');
			}else{
				$.growl.error({message: 'Nomor KTP sudah dipakai'});
			}
		}, 'json');
	});
	
	window.pilihStokis = function(){
		window.modeuser = 'stokis';
		$.fancybox({href: '#choose-member'});
		window.activateChooseMember();
		return false;
	}
	
	window.pilihMember = function(){
		window.modeuser = 'member';
		$.fancybox({href: '#choose-member'});
		window.activateChooseMember();
		return false;
	}
	
	window.chooseMember = function(th, user_id){
		if(window.modeuser=='stokis'){
			$('input[name=stokis_id]').val(user_id);
			dt = $(th).data('member');
			$('input[name=stokis_name]').val(dt[1]);
		}else{
			window.getMember(user_id);
		}
		$.fancybox.close();
	}
	
	window.getMember = function(user_id){
		$.fancybox.showLoading();
		$.post(window.user_get_by_user_id, {user_id: user_id}, function(res){
			$.fancybox.hideLoading();
			if($.isEmptyObject(res))
				$.growl.error({message: 'Data member tidak ditemukan, cek kembali PIN yang anda masukan'});
			else{
				$('input[name=pembeli_id]').val(res.id);
				
				$('input[type=radio]:checked').removeAttr('checked');
				$('input[type=radio]').hide();
				
				if(window.mode=='gabung'){
					$('input[name=name1]').val(res.nama_lengkap);
					$('input[name=ktp]').val(res.ktp);
					$('input[name=bank]').val(res.bank);
					$('input[name=norek]').val(res.no_rekening);
					$('input[name=namarek]').val(res.nama_rekening);
					$('input[name=name1]').attr('disabled','disabled');
					$('input[name=ktp]').attr('disabled','disabled');
					$('input[name=bank]').attr('disabled','disabled');
					$('input[name=norek]').attr('disabled','disabled');
					$('input[name=namarek]').attr('disabled','disabled');
				}
				if(window.mode=='beli'){
					$('input[name=name2]').val(res.nama_lengkap);
					$('textarea[name=alamat]').val(res.alamat);
					$('input[name=kontak]').val(res.phone);
					$('input[name=name2]').attr('disabled','disabled');
					$('textarea[name=alamat]').attr('disabled','disabled');
					$('input[name=kontak]').attr('disabled','disabled');
				}
				
				$('input[name=member_pin]').val('');
				$.fancybox.close();
			}
		}, 'json');
	}
	
});
