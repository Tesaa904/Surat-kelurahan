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
<script src="js/jquery.min.js"></script>
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
/* 		isi = "coba alert "+propinsi;
		window.alert(isi); */
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
	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Input Data Pindah Keluar </h3>
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Form Data Warga Keluar </h3>
					</div>
					<div class="panel-body">

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
							  
							<form role="form" action="modul/surat_keluar/proses.php?act=add" method="post" enctype="multipart/form-data">
								<div class="row setup-content" id="step-1">
									<table class="table">
										<tr>
											<th colspan="2">
												<h3>Data Warga Pindah Keluar</h3>
											</th>
										</tr>
										<tr>
											<td style="text-align:left">
												<div class="col-md-6">
										<div class="form-group">
											<label>Kepala Keluarga</label>										 
												<input class="form-control" id="id_luar" name="id_luar" value="<?php echo $kodeBarang;?>" type="hidden"  />
												<select type="text" class="form-control select2" name="nik_kepala_kel">
													<option value="">Pilih</option>
													<?php
														$sql_kpl = mysqli_query($mysqli,"Select * from m_penduduk where id_shdk='1' order by nik asc");
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>						   
												</select>
										</div>
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
											<input class="form-control" name="dukuh_tujuan" type="text" placeholder="" onkeyup="this.value = this.value.toUpperCase()" />
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
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
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Foto KK yang ingin pindah keluar</label>
											<input type="file" class="form-control" name="file_suratkeluar">
                                                                                        <h7>*) Masukan foto Keterangan RT/Rw yang menyatakan akan pindah keluar/pergi </h7>
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
	
