$(function(){
	
	$('.table-pin').dataTable({
			"sPaginationType": "two_button",
			"iDisplayLength" : 10,
			'bRetrieve': true,
			"bFilter": true,
			'sDom': 'ftp',
			"bLengthChange": false,
			"bInfo": true,
			"bJQueryUI": true,
			"aoColumnDefs": [
				  { 'bSortable': false, 'aTargets': [0] }
			],
			"bServerSide": true,
			"sAjaxSource": window.pin_list_url,
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
