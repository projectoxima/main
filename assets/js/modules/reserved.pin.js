$(function(){
	
	var selector_pin = $("select[name=pin_id]");
	selector_pin.chosen();
	selector_pin.parent().find("div.chosen-search").find('input').keyup(function(){
		var that = $(this);
		var key = $(this).val();
		$.get(window.reserved_active_pin_url +'/'+ key.toUpperCase(), function(res){
			selector_pin.html('<option value=""></option>');
			for(item in res){
				selector_pin.append('<option value="' +res[item].id+ '">' +res[item].pin+ '</option>');
			}
			selector_pin.trigger("chosen:updated");
			that.val(key);
		}, 'json');
	});
	
	var selector_stokis = $("select[name=user_id]");
	selector_stokis.chosen();
	selector_stokis.parent().find("div.chosen-search").find('input').keyup(function(){
		var that = $(this);
		var key = $(this).val();
		if(key.length < 2)
			return;
		$.get(window.reserved_stokis_url +'/'+ key, function(res){
			selector_stokis.html('<option value=""></option>');
			for(item in res){
				selector_stokis.append('<option value="' +res[item].id+ '">' +res[item].nama_lengkap+ '</option>');
			}
			selector_stokis.trigger("chosen:updated");
			that.val(key);
		}, 'json');
	});
	
	var selector_parent = $("select[name=parent_id]");
	selector_parent.chosen();
	selector_parent.parent().find("div.chosen-search").find('input').keyup(function(){
		var that = $(this);
		var key = $(this).val();
		if(key.length < 2)
			return;
		$.get(window.reserved_parent_url +'/'+ key, function(res){
			selector_parent.html('<option value=""></option>');
			for(item in res){
				selector_parent.append('<option value="' +res[item].id+ '">' +res[item].nama_lengkap+ '</option>');
			}
			selector_parent.trigger("chosen:updated");
			that.val(key);
		}, 'json');
	});
	
	var selector_idbarang = $("select[name=idbarang_id]");
	var multiple_selected = [];
	selector_idbarang.chosen();
	selector_idbarang.chosen().change(function(){
		multiple_selected = $(this).val();
		$('input[name=idbarang]').val(multiple_selected);
		console.log('change');
		console.log(multiple_selected);
	});
	selector_idbarang.parent().find("ul.chosen-choices").find('input').keyup(function(){
		console.log('keyup');
		console.log(multiple_selected);
		var that = $(this);
		var key = $(this).val();
		$.post(window.reserved_active_idbarang_url +'/'+ key, {selected: multiple_selected}, function(res){
			selector_idbarang.find('option:not(:selected)').remove();
			for(item in res){
				selector_idbarang.append('<option value="' +res[item].id+ '">' +res[item].idbarang+ '</option>');
			}
			//~ that.val(key);
			selector_idbarang.trigger("chosen:updated");
			selector_idbarang.chosen().val(multiple_selected);
			console.log('post');
		}, 'json');
	});
	
	$('.table-reserved').dataTable({
			"sPaginationType": "two_button",
			"iDisplayLength" : 10,
			'bRetrieve': true,
			"bFilter": true,
			'sDom': 'lftp',
			"bLengthChange": true,
			"bInfo": true,
			"bJQueryUI": true,
			"aoColumnDefs": [
				  { 'bSortable': false, 'aTargets': [0] },
				  { "sClass": "tengah", "aTargets": [0] }
			],
			"bServerSide": true,
			"sAjaxSource": window.reserved_pin_url,
			"sServerMethod": "POST",
			"fnServerData" : function(sSource, aoData, fnCallback) {
				$.fancybox.showLoading();
				
				aoData.push({"name":"pagepos", "value":this.fnPagingInfo().iPage});
				request = $.ajax({
					"dataType" : "json",
					"type" : "POST",
					"url" : sSource,
					"data" : aoData,
					"success" : fnCallback
				});
			},
			"fnDrawCallback": function(oSettings) {
				$.fancybox.hideLoading();
				
				bstatus = $('.button-status');
				for(i=0; i<bstatus.length; i++){
					var that = bstatus.eq(i);
					var judul = that.text()=='enable' ? 'Yakin akan diaktifkan ?':'Yakin akan dinonaktifkan ?';
					bstatus.eq(i).confirmation({
						placement: 'left',
						trigger: 'click', 
						singleton: true,
						title: judul,
						href: that.attr('href'),
						btnCancelClass: 'btn-warning',
						onCancel: function(){
							$('.button-status').confirmation('hide');
						}
					});
				}
				
			}
	});

});
