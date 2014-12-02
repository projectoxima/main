<h3>Detail User</h3>

<br/>

<div class="col-md-2">
	<img src="<?php 
		if(empty($user->photo)){
			if(!file_exists(url_photo($user->photo)))
				echo url_image('user.jpg');
			else
				echo url_photo($user->photo);
		}else
			echo url_image('user.jpg');
	?>" class="col-md-12 img-rounded"/>
	<strong><center><p>
		<?php 
			if($user->group_id==USER_ADMIN)
				echo print_warna('Admin', '#00f');
			if($user->group_id==USER_OPERATOR)
				echo print_warna('Operator', '#00a');
			if($user->group_id==USER_MEMBER)
				echo print_warna('Member', '#005');
		?>
	</p><p>
		<?php
			if($user->status==ACTIVE)
				echo print_warna('Aktif');
			else
				echo print_warna('Belum Aktif', 'red');
		?>
	</p></center></strong>
</div>

<div class="col-md-10">
	<div class="col-md-6 form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama lengkap</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->nama_lengkap ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Alamat</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->alamat ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Kota</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->kota ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Provinsi</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->propinsi ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Kode pos</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->kodepos ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">TTL</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->tempat_lahir .'/'. $user->tgl_lahir ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Agama</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->agama ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Jenis kelamin</label>
			<div class="col-sm-6 bg-info">
				<label class="control-label"><?php echo $user->jenis_kelamin ?></label>
			</div>
		</div>
	</div>
	<div class="col-md-6 form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 control-label">Phone</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->phone ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">KTP</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->ktp ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Email</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->email ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">No. rekening</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->no_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Bank</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->bank ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama rekening</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->nama_rekening ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Nama ahli waris</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->nama_ahli_waris ?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 control-label">Hubungan keluarga</label>
			<div class="col-sm-6	bg-info">
				<label class="control-label"><?php echo $user->hubungan_keluarga ?></label>
			</div>
		</div>
	</div>
</div>

<!-- tampil jika detail member -->
<?php if($user->group_id==USER_MEMBER): ?>

<div class="col-md-12">

	<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Section A</a></li>
        <li><a data-toggle="tab" href="#sectionB">Section B</a></li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#dropdown1">Dropdown1</a></li>
                <li><a data-toggle="tab" href="#dropdown2">Dropdown2</a></li>
            </ul>
        </li>
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <h3>Section A</h3>
            <p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <h3>Section B</h3>
            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p>
        </div>
        <div id="dropdown1" class="tab-pane fade">
            <h3>Dropdown 1</h3>
            <p>WInteger convallis, nulla in sollicitudin placerat, ligula enim auctor lectus, in mollis diam dolor at lorem. Sed bibendum nibh sit amet dictum feugiat. Vivamus arcu sem, cursus a feugiat ut, iaculis at erat. Donec vehicula at ligula vitae venenatis. Sed nunc nulla, vehicula non porttitor in, pharetra et dolor. Fusce nec velit velit. Pellentesque consectetur eros.</p>
        </div>
        <div id="dropdown2" class="tab-pane fade">
            <h3>Dropdown 2</h3>
            <p>Donec vel placerat quam, ut euismod risus. Sed a mi suscipit, elementum sem a, hendrerit velit. Donec at erat magna. Sed dignissim orci nec eleifend egestas. Donec eget mi consequat massa vestibulum laoreet. Mauris et ultrices nulla, malesuada volutpat ante. Fusce ut orci lorem. Donec molestie libero in tempus imperdiet. Cum sociis natoque penatibus et magnis.</p>
        </div>
    </div>

</div>

<?php endif; ?>
