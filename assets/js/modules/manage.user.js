$(function(){
	
	$('.table-user').dataTable({
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
				  { "sClass": "tengah", "aTargets": [7] }
			],
			"bServerSide": true,
			"sAjaxSource": window.user_list_url,
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
