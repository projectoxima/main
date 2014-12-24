<div id="choose-member" class="col-md-12" hidden>
	<div class="form-group">
		<table id="table-select-member">
			<thead>
				<tr>
					<th width="10px">No</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Provinsi</th>
					<th>KTP</th>
					<th>Phone</th>
					<th width="80px"></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		window.activateChooseMember = function(){
			$('#table-select-member').dataTable({
				"bPaginate": true,
				"bLengthChange": false,
				"bFilter": true,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": false,
				"iDisplayLength" : 20,
				'bRetrieve': true,
				"bServerSide": true,
				'sDom': 'ftip',
				"sAjaxSource": '<?php echo route_url('userutil', 'get_paging_member') ?>',
				"sServerMethod": "POST",
				"aoColumnDefs": [
					{'bSortable': false, 'aTargets': [0,6] },
					{'sClass': 'text-right', 'aTargets': [0] },
					{'sClass': 'text-center', 'aTargets': [1,4,5,6] }
				],
				"fnServerData" : function(sSource, aoData, fnCallback) {
					$.fancybox.showLoading();
					
					aoData.push({"name":"pagepos", "value":this.fnPagingInfo().iPage});
					aoData.push({"name":"mode", "value":window.modeuser});
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
				},
				"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					$(nRow).find('button').data('member', aData);
				}
			});
		}
	})
</script>
