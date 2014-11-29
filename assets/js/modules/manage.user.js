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
				  { "sClass": "tengah", "aTargets": [6] }
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
			}
	});

});
