<a class="btn btn-primary" href="<?php echo base_url() ;?>member/add_member">Add Member</a>
<br><br>
<span for="username" class="error-span"><?php echo $this->session->flashdata('success'); ?></span>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Member Dashboard</h3>
  </div>
  <div class="panel-body">
  	<form class="form-horizontal" role="form">
  		<h3>Biodata</h3>
  		<hr>
			<div class="form-group">
				<label class="col-sm-2 control-label">Nama Lengkap</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap" value="<?php echo $profile['nama_lengkap'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Alamat</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $profile['alamat'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Kota</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="kota" name="kota" value="<?php echo $profile['kota'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Propinsi</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="propinsi" name="propinsi" value="<?php echo $profile['propinsi'] ;?>" disabled>
				</div>
			</div>
  		<h3>Member Data</h3>
  		<hr>
  		<?php
  			// Get PIN
  			$pin = $this->members->find_pin($this->session->userdata('pin_id'));
  		?>
			<div class="form-group">
				<label class="col-sm-2 control-label">PIN</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="<?php echo $pin['pin'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Tanggal Masuk/Daftar</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="tgl-masuk" name="tgl-masuk" value="<?php echo $profile['tgl_pengajuan'] ;?>" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Member</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="1250" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Bonus</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="Rp. 2.757.000" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah PO</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="120" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jumlah Point</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="pin" name="pin" value="310" disabled>
				</div>
			</div>
  	</form>
  	<h3>Member Tree</h3>
  	<hr>
  	<a class="btn btn-primary" href="<?php echo base_url() ;?>member/">Member Tree</a>
  	<br>

		<div id="paper"></div>

  </div>
</div>


<div class="modal" id="modal-view-profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" rel="tooltip" data-toggle="tooltip" title="Close Form">&times;</button>
        <h4 class="modal-title">Member Detail</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-view-profile">
					<div class="form-group">
						<label class="col-sm-4 control-label">Nama Lengkap</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="view-name" name="view-name" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Alamat</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="view-alamat" name="view-alamat" disabled>
						</div>
					</div>
					<input type="hidden" id="titik-id" name="titik-id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="upline-button" class="btn btn-default" data-dismiss="modal" rel="tooltip" data-toggle="tooltip" title="Upline">Upline</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" rel="tooltip" data-toggle="tooltip" title="Canceled">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	var graph = new joint.dia.Graph;

	var paper = new joint.dia.Paper({
	    el: $('#paper'),
	    width: 800,
	    height: 600,
	    gridSize: 1,
	    model: graph,
	    perpendicularLinks: true
	});

	var member = function(x, y, rank, name, image, background, border) {

	    var cell = new joint.shapes.org.Member({
	        position: { x: x, y: y },
	        attrs: {
	            '.card': { fill: background, stroke: border},
	              image: { 'xlink:href': '<?php echo site_url() ;?>assets/img/'+ image },
	            '.rank': { text: rank }, '.name': { text: name }
	        }
	    });
	    graph.addCell(cell);
	    return cell;
	};

	function link(source, target, breakpoints) {

	    var cell = new joint.shapes.org.Arrow({
	        source: { id: source.id },
	        target: { id: target.id },
	        vertices: breakpoints
	    });
	    graph.addCell(cell);
	    return cell;
	}

	var bart = member(300,70,'CEO', 'Bart Simpson', 'member1.png', '#F1C40F', 'gray');
	var homer = member(90,200,'VP Marketing', 'Homer Simpson', 'member2.png', '#2ECC71', '#008e09');
	var marge = member(300,200,'VP Sales', 'Marge Simpson', 'member3.png', '#2ECC71', '#008e09');
	var lisa = member(500,200,'VP Production' , 'Lisa Simpson', 'member4.png', '#2ECC71', '#008e09');
	var maggie = member(400,350,'Manager', 'Maggie Simpson', 'member5.png', '#3498DB', '#333');
	var lenny = member(190,350,'Manager', 'Lenny Leonard', 'member6.png', '#3498DB', '#333');
	var carl = member(190,500,'Manager', 'Carl Carlson', 'member7.png', '#3498DB', '#333');

	link(bart, marge, [{x: 385, y: 180}]);
	link(bart, homer, [{x: 385, y: 180}, {x: 175, y: 180}]);
	link(bart, lisa, [{x: 385, y: 180}, {x: 585, y: 180}]);
	link(homer, lenny, [{x:175 , y: 380}]);
	link(homer, carl, [{x:175 , y: 530}]);
	link(marge, maggie, [{x:385 , y: 380}]);
</script>