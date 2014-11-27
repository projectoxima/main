$.ajaxSetup({
	timeout: 120000,
	
	beforeSend: function(xhr){
		window.ajax_start_time = (new Date()).getTime();
	},
	
	complete: function(xhr, status){
		var diff = (new Date()).getTime()-window.ajax_start_time;
		console.log(diff + ' ms');
	},
	
	statusCode: {
		401: function(){
			$.growl.error({message:'Server error, kontak developer'});
			return false;
		},
		403: function() {
			$.growl.error({message:'Server error, kontak developer'});
			return false;
		},
		404: function(){
			$.growl.error({message:'Server error, kontak developer'});
			return false;
		}
	},
	
	error: function(jqXHR, textStatus, errorThrown) {
		$.growl.error({message:'Connection time out, koneksi ada lambat'});
	}
});

$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings){
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          oSettings._iDisplayLength === -1 ?
			0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    oSettings._iDisplayLength === -1 ?
			0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
};
