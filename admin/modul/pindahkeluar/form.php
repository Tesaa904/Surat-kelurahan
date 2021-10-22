<style>
	.stepwizard-step p {
		margin-top: 10px;
	}
	.stepwizard-row {
		display: table-row;
	}
	.stepwizard {
		display: table;
		width: 100%;
		position: relative;
	}
	.stepwizard-step button[disabled] {
		opacity: 1 !important;
		filter: alpha(opacity=100) !important;
	}
	.stepwizard-row:before {
		top: 14px;
		bottom: 0;
		position: absolute;
		content: " ";
		width: 100%;
		height: 1px;
		background-color: #ccc;
		z-order: 0;
	}
	.stepwizard-step {
		display: table-cell;
		text-align: center;
		position: relative;
	}
	.btn-circle {
		width: 30px;
		height: 30px;
		text-align: center;
		padding: 6px 0;
		font-size: 12px;
		line-height: 1.428571429;
		border-radius: 15px;
	}
</style>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function () {
	  var navListItems = $('div.setup-panel div a'),
			  allWells = $('.setup-content'),
			  allNextBtn = $('.nextBtn'),
			  allPrevBtn = $('.prevBtn');

	  allWells.hide();

	  navListItems.click(function (e) {
		  e.preventDefault();
		  var $target = $($(this).attr('href')),
				  $item = $(this);

		  if (!$item.hasClass('disabled')) {
			  navListItems.removeClass('btn-primary').addClass('btn-default');
			  $item.addClass('btn-primary');
			  allWells.hide();
			  $target.show();
			  $target.find('input:eq(0)').focus();
		  }
	  });
	  
	  allPrevBtn.click(function(){
		  var curStep = $(this).closest(".setup-content"),
			  curStepBtn = curStep.attr("id"),
			  prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

			  prevStepWizard.removeAttr('disabled').trigger('click');
	  });

	  allNextBtn.click(function(){
		  var curStep = $(this).closest(".setup-content"),
			  curStepBtn = curStep.attr("id"),
			  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			  curInputs = curStep.find("input[type='text'],input[type='url']"),
			  isValid = true;

		  $(".form-group").removeClass("has-error");
		  for(var i=0; i<curInputs.length; i++){
			  if (!curInputs[i].validity.valid){
				  isValid = false;
				  $(curInputs[i]).closest(".form-group").addClass("has-error");
			  }
		  }

		  if (isValid)
			  nextStepWizard.removeAttr('disabled').trigger('click');
	  });

	  $('div.setup-panel div a.btn-primary').trigger('click');
	});
</script>
<script type="text/javascript">
	function show_kab(){
		var propinsi = $("#id_prop").val();
		$.ajax({
		url: "config/data-wilayah.php?jenis=kab",
		data: "id_prop="+propinsi,
		cache: false,
		success: function(msg){
		$("#id_kab").html(msg);
		}
		});			
	}
	function show_kec(){
		var kota = $("#id_kab").val();
		$.ajax({
		url: "config/data-wilayah.php?jenis=kec",
		data: "id_kab="+kota,
		cache: false,
		success: function(msg){
		$("#id_kec").html(msg);
		}
		});			
	}
	function show_kel(){
		var kec = $("#id_kec").val();
		$.ajax({
		url: "config/data-wilayah.php?jenis=kel",
		data: "id_kec="+kec,
		cache: false,
		success: function(msg){
		$("#id_kel").html(msg);
		}
		});			
	}	 
</script>
<?php
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){

	// mencari kode barang dengan nilai paling besar
	$query = "SELECT max(id_luar) as maxKode FROM surat_pindah_luar";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$noUrut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$noUrut++;

	$char = "PK";
	$kodeBarang = $char . sprintf("%03s", $noUrut);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">

				<div class="container">
					<div class="stepwizard col-md-12">
						<div class="stepwizard-row setup-panel">
						  <div class="stepwizard-step">
							<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
							<p>Data Warga Pindah</p>
						  </div>
						  <div class="stepwizard-step">
							<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
							<p>Data Kepindahan</p>
						  </div>
						  <div class="stepwizard-step">
							<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
							<p>Data Anggota</p>
						  </div>
						</div>
					</div>
					  
					<form role="form" action="modul/pindahkeluar/proses.php?act=add" method="post" enctype="multipart/form-data">
						<div class="row setup-content" id="step-1">
							<table class="table">
								<tr>
									<th colspan="2">
										<h3>Data Warga Pindah Keluar</h3>
									</th>
								</tr>
								<tr>
									<td style="text-align:left">
										<div class="form-group">
											<label>Kepala Keluarga</label>										 
												<input class="form-control" id="id_luar" name="id_luar" value="<?php echo $kodeBarang;?>" type="hidden"  />
												<select type="text" class="form-control select2" name="nik_kepala_kel">
													<option value="">Pilih</option>
													<?php
														$sql_kpl = mysqli_query($mysqli,"Select * from m_penduduk where id_shdk='1' and status='1' order by nik asc");
														while ($kepala=mysqli_fetch_array($sql_kpl)){
															echo "<option value='$kepala[nik]'>$kepala[nik] - $kepala[nama]</option>";
														}
													?>										   
												</select>
										</div>
										<div class="form-group">
											<label>Nama yang Pindah</label>								
												<select type="text" class="form-control select2" name="nik">
													<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>						   
												</select>
										</div>
																			
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Lanjut</button>
									</td>
								</tr>
							</table>
						</div>
						<div class="row setup-content" id="step-2">
							<table class="table">
								<tr>
									<th colspan="2">
										<h3>Data Kepindahan</h3>
									</th>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label class="control-label">Alasan Pindah</label>
											<select type="text" name="id_alasan_pindah" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_alasan_pindah ORDER BY id_alasan_pindah");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_alasan_pindah'].'>'.$row1['nama_alasan_pindah'].'</option>'; }
													//}
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Klasifikasi Pindah</label>
											<select type="text" name="id_klasifikasi_pindh" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_klasifikasi_pindh ORDER BY id_klasifikasi");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_klasifikasi'].'>'.$row1['nama_klasifikasi'].'</option>'; }
													//}
												?>
											</select>
										</div>			
										<div class="form-group">
											<label class="control-label">Jenis Pindah</label>
											<select type="text" name="id_jenis_pindh" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_jenis_pindh ORDER BY id_jenis_pindh");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_jenis_pindh'].'>'.$row1['nama_jenis_pindh'].'</option>'; }
													//}
												?>
											</select>
										</div>											
										<div class="form-group">
											<label class="control-label">Tanggal Rencana Pindah</label>
											<div class="form-inline">
												<div class="input-group">
													<input class="form-control datepicker" name="tgl_rencana_pindah" type="text" placeholder="thn-bln-tgl" />
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
											</div>
										</div>			
										
										<div class="form-group">
											<label class="control-label">Status No KK Bagi Yang Tidak Pindah</label>
											<select type="text" name="id_status_kk_tdkpindh" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_status_kk_tdkpindh ORDER BY id_status_kk_tdkpindh");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_status_kk_tdkpindh'].'>'.$row1['nama_status_kk_tdkpindh'].'</option>'; }
													//}
												?>
											</select>
										</div>	
											
										<div class="form-group">
											<label class="control-label">Status No KK Bagi Yang Pindah</label>
											<select type="text" name="id_status_kk_pindh" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_status_kk_pindh ORDER BY id_status_kk_pindh");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_status_kk_pindh'].'>'.$row1['nama_status_kk_pindh'].'</option>'; }
													//}
												?>
											</select>
										</div>
										</td>
									<td style="text-align:left">	
										<div class="form-group">
											<label>Provinsi Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_propinsi_tujuan" id="id_prop" onchange="show_kab()">
												<?php
													$sql_prop = mysqli_query($mysqli,"select * from wil_propinsi");
													while ($prop=mysqli_fetch_array($sql_prop)){
														echo "<option value='$prop[id_propinsi]'>$prop[nama_propinsi]</option>";
													}
												?>										
											</select>
										</div>	
										
										<div class="form-group">
											<label>Kab / Kota Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kabkota_tujuan" id="id_kab" onchange="show_kec()">
												<?php
													$sql_kab = mysqli_query($mysqli,"select * from wil_kabkota limit 10");
													while ($kab=mysqli_fetch_array($sql_kab)){
														echo "<option value='$kab[id_kabkota]'>$kab[nama_kabkota]</option>";
													}
												?>										
											</select>
										</div>	
										
										<div class="form-group">
											<label>Kec Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kecamatan_tujuan" id="id_kec" onchange="show_kel()">
												<?php
													$sql_kec = mysqli_query($mysqli,"select * from wil_kecamatan limit 10");
													while ($kec=mysqli_fetch_array($sql_kec)){
														echo "<option value='$kec[id_kecamatan]'>$kec[nama_kecamatan]</option>";
													}
												?>										
											</select>
										</div>	
										<div class="form-group">
											<label>Kelurahan Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kelurahan_tujuan" id="id_kel">
												<?php
													$sql_kel = mysqli_query($mysqli,"select * from tb_kelurahan limit 10");
													while ($kel=mysqli_fetch_array($sql_kel)){
														echo "<option value='$kel[id_kelurahan]'>$kel[nama_kelurahan]</option>";
													}
												?>										
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Dukuh Tujuan</label>
											<input class="form-control" name="dukuh_tujuan" type="text" placeholder="" />
										</div>									
										<div class="form-group">
											<label class="control-label">RT & RW Tujuan</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="rt_tujuan" type="decimal" placeholder=" RT " />
												<input class="form-control form-control-sm" name="rw_tujuan" type="decimal" placeholder="RW " />
											</div>
										</div>								
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Kembali</button>
										<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Lanjut</button>												
									</td>
								</tr>										
							</table>
						</div>
						<div class="row setup-content" id="step-3">
							<table class="table">
								<tr>
									<th colspan="2">
										<h3>Data Anggota Keluarga ikut</h3>
									</th>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label class="control-label">Nama anggota 1</label>
											<select type="text" name="nik_kel1" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama anggota 2</label>
											<select type="text" name="nik_kel2" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama anggota 3</label>
											<select type="text" name="nik_kel3" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>
										</td>
									<td style="text-align:left">		
										<div class="form-group">
											<label class="control-label">Nama anggota 4</label>
											<select type="text" name="nik_kel4" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama anggota 5</label>
											<select type="text" name="nik_kel5" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
                                                                                        <input class="form-control" name="id_status_surat" type="hidden" value="2">
										</div>		
										<div class="form-group">
											<label class="control-label">Foto KK yang ingin pindah keluar</label>
											<input type="file" class="form-control" name="file_suratkeluar">
										</div>												
									</td>
								</tr>	
								<tr>
									<td colspan="2">
										<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Kembali</button>
										<button class="btn btn-success btn-lg pull-right" type="submit" name="simpan">Simpan</button>											
									</td>
								</tr>										
							</table>
						</div>
					</form>
				  
				</div>

			
			</div>
		</div>
	</div>
</div>					
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,o.nama,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
														h.nama_propinsi,i.nama_klasifikasi,j.nama_jenis_pindh,k.nama_status_kk_pindh,l.nama_status_kk_tdkpindh
														FROM surat_pindah_luar a LEFT JOIN m_alasan_pindah b ON a.id_alasan_pindah=b.id_alasan_pindah
														LEFT JOIN m_klasifikasi_pindh i ON a.id_klasifikasi_pindh=i.id_klasifikasi
														LEFT JOIN m_jenis_pindh j ON a.id_jenis_pindh=j.id_jenis_pindh
														LEFT JOIN m_status_kk_pindh k ON a.id_status_kk_pindh=k.id_status_kk_pindh
														LEFT JOIN m_status_kk_tdkpindh l ON a.id_status_kk_tdkpindh=l.id_status_kk_tdkpindh
														LEFT JOIN m_penduduk o ON a.nik=o.nik
														LEFT JOIN m_dukuh c ON o.id_dukuh=c.id_dukuh
														LEFT JOIN wil_kelurahan d ON a.id_kelurahan_tujuan=d.id_kelurahan
														LEFT JOIN wil_kecamatan e ON a.id_kecamatan_tujuan=e.id_kecamatan
														LEFT JOIN wil_kabkota f ON a.id_kabkota_tujuan=f.id_kabkota
														LEFT JOIN wil_propinsi h ON a.id_propinsi_tujuan=h.id_propinsi WHERE id_luar='$get_id'"));
?>
	<form method="POST" action="modul/pindahkeluar/proses.php?act=edit">
		<div class="panel-heading no-collapse">
					UBAH DATA
				</div>
		<tr>
			<td>
				<table class="table"> 
						<td>
									
										<div class="form-group">
											<label>Kepala Keluarga</label>
											<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_luar'];?>">
												<input class="form-control" name="nik_kepala_kel" value="<?php echo $data['nik_kepala_kel'] ;?>" type="text" readonly="readonly" />
										</div>
										<div class="form-group">
											<label class="control-label">NIK Yang Akan Pindah</label>								   
											<select type="text" name="nik" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik'];?>" selected><?php echo name_from_nik($data['nik']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>
										 							
										<div class="form-group">
											<label class="control-label">Alasan Pindah</label>
											<select type="text" name="id_alasan_pindah" autofocus class="form-control select2">
											<option value="<?php echo $data['id_alasan_pindah'];?>" selected><?php echo $data['nama_alasan_pindah'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_alasan_pindah");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_alasan_pindah']==$data['nama_alasan_pindah'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_alasan_pindh]'$select>$tm_lahir[nama_alasan_pindh]</option>";
													}
												?>				
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Klasifikasi Pindah</label>
											<select type="text" name="id_klasifikasi_pindh" class="form-control select2">
												<option value="<?php echo $data['id_klasifikasi_pindh']?>" selected="selected" autofocus="on"><?php echo $data['nama_klasifikasi'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_klasifikasi_pindh ORDER BY id_klasifikasi");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_klasifikasi']==$data['nama_klasifikasi'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_klasifikasi]'$select>$row1[nama_klasifikasi]</option>";
													}
												?>
											</select>
										</div>
									</td>
										<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Jenis Kepindahan</label>
											<select type="text" name="id_jenis_pindh" class="form-control select2">
												<option value="<?php echo $data['id_jenis_pindh'];?>" selected><?php echo $data['nama_jenis_pindh'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_jenis_pindh");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_jenis_pindh']==$data['nama_jenis_pindh'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_jenis_pindh]'$select>$tm_lahir[nama_jenis_pindh]</option>";
													}
												?>														
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Tgl Rencana Pindah</label>
											<div class="form-inline">
												<div class="input-group">
													<input class="form-control datepicker" name="tgl_rencana_pindah" type="text" value="<?php echo $data['tgl_rencana_pindah'];?>">
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
											</div>
										</div>					
								
										<div class="form-group">
											<label class="control-label">Status KK yang Tidak Pindah</label>
											<select type="text" name="id_status_kk_tdkpindh" class="form-control select2">
												<option value="<?php echo $data['id_status_kk_tdkpindh']?>" selected="selected" autofocus="on"><?php echo $data['nama_status_kk_tdkpindh'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_status_kk_tdkpindh ORDER BY id_status_kk_tdkpindh");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_status_kk_tdkpindh']==$data['nama_status_kk_tdkpindh'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_status_kk_tdkpindh]'$select>$row1[nama_status_kk_tdkpindh]</option>";
													}
												?>
											</select>
										</div>	
										
										<div class="form-group">
											<label class="control-label">Status KK Yang Pindah</label>
											<select type="text" name="id_status_kk_pindh" class="form-control select2">
												<option value="<?php echo $data['id_status_kk_pindh']?>" selected="selected" autofocus="on"><?php echo $data['nama_status_kk_pindh'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_status_kk_pindh ORDER BY id_status_kk_pindh");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_status_kk_pindh']==$data['nama_status_kk_pindh'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_status_kk_pindh]'$select>$row1[nama_status_kk_pindh]</option>";
													}
												?>
											</select>
										</div>									
										</td>
								</table>
							<hr>
							<table class="table">
								<tr>	
									<td>
										<div class="form-group">
											<label>Provinsi Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_propinsi_tujuan" id="id_prop" onchange="show_kab()">
												<option value="<?php echo $data['id_propinsi_tujuan'];?>" selected><?php echo $data['nama_propinsi'];?></option>
												<?php
													$sql_prop = mysqli_query($mysqli,"select * from wil_propinsi");
													while ($prop=mysqli_fetch_array($sql_prop)){
														echo "<option value='$prop[id_propinsi]'>$prop[nama_propinsi]</option>";
													}
												?>										
											</select>
										</div>	
										
										<div class="form-group">
											<label>Kab / Kota Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kabkota_tujuan" id="id_kab" onchange="show_kec()">
												<option value="<?php echo $data['id_kabkota_tujuan'];?>" selected><?php echo $data['nama_kabkota'];?></option>
												<?php
													$sql_kab = mysqli_query($mysqli,"select * from wil_kabkota limit 10");
													while ($kab=mysqli_fetch_array($sql_kab)){
														echo "<option value='$kab[id_kabkota]'>$kab[nama_kabkota]</option>";
													}
												?>										
											</select>
										</div>	
										
										<div class="form-group">
											<label>Kec Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kecamatan_tujuan" id="id_kec" onchange="show_kel()">
												<option value="<?php echo $data['id_kecamatan_tujuan'];?>" selected><?php echo $data['nama_kecamatan'];?></option>
												<?php
													$sql_kec = mysqli_query($mysqli,"select * from wil_kecamatan limit 10");
													while ($kec=mysqli_fetch_array($sql_kec)){
														echo "<option value='$kec[id_kecamatan]'>$kec[nama_kecamatan]</option>";
													}
												?>										
											</select>
										</div>	
										<div class="form-group">
											<label>Kelurahan Tujuan</label>
											<select class="select2 form-control form-control-sm" name="id_kelurahan_tujuan" id="id_kel">
												<option value="<?php echo $data['id_kelurahan_tujuan'];?>" selected><?php echo $data['nama_kelurahan'];?></option>
												<?php
													$sql_kel = mysqli_query($mysqli,"select * from tb_kelurahan limit 10");
													while ($kel=mysqli_fetch_array($sql_kel)){
														echo "<option value='$kel[id_kelurahan]'>$kel[nama_kelurahan]</option>";
													}
												?>										
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Dukuh Tujuan</label>
											<input class="form-control" value="<?php echo $data['dukuh_tujuan']?>" name="dukuh_tujuan" type="text" placeholder="" />
										</div>									
										<div class="form-group">
											<label class="control-label">RT & RW Tujuan</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" value="<?php echo $data['rt_tujuan']?>" name="rt_tujuan" type="number"  />
												<input class="form-control form-control-sm" value="<?php echo $data['rw_tujuan']?>" name="rw_tujuan" type="number"  />
											</div>
										</div>								
									</td>
										<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">NIK anggota 1</label>
											<select type="text" name="nik_kel1" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_kel1'];?>" selected><?php echo $data['nik_kel1'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">NIK anggota 2</label>
											<select type="text" name="nik_kel2" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_kel2'];?>" selected><?php echo $data['nik_kel2'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">NIK anggota 3</label>
											<select type="text" name="nik_kel3" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_kel3'];?>" selected><?php echo $data['nik_kel3'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">NIK anggota 4</label>
											<select type="text" name="nik_kel4" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_kel4'];?>" selected><?php echo $data['nik_kel4'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">NIK anggota 5</label>
											<select type="text" name="nik_kel5" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_kel5'];?>" selected><?php echo $data['nik_kel5'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
											
												?>
											</select>
										</div>
									</td>		
								</tr>									
							</table>
								<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
								</div>
								
						</td>
					</tr>
				</form>
<?php
	}
?>