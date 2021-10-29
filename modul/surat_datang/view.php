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
<script src="js/jquery-2.1.1.min.js"></script>
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
	$query = "SELECT max(id_datang) as maxKode FROM surat_pindah_datang";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$noUrut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$noUrut++;

	$char = "Pd";
	$kodeBarang = $char . sprintf("%03s", $noUrut);
?>
	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Input Data Pindah Datang</h3>
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Form Data Warga Baru</h3>
					</div>
					<div class="panel-body">

						<div class="container">
							<div class="stepwizard col-md-12">
								<div class="stepwizard-row setup-panel">
								  <div class="stepwizard-step">
									<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
									<p>Data Warga Baru</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
									<p>Data Asal</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
									<p>Data Kepindahan</p>
								  </div>
								   <div class="stepwizard-step">
									<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
									<p>Data Daerah Tujuan</p>
								  </div>
								</div>
							</div>

							<form role="form" action="modul/surat_datang/proses.php" method="post" enctype="multipart/form-data">
								<div class="row setup-content" id="step-1">
									<table class="table">
										<tr>
											<th colspan="2">
												<h3>Data Baru</h3>
											</th>
										</tr>
										<tr>
											<td>
							  					<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">NO KK</label>		
													<input class="form-control" id="id_datang" name="id_datang" value="<?php echo $kodeBarang;?>" type="hidden"  />	
													<input class="form-control" name="no_kk" type="number" placeholder="masukkan no kk" />	
												</div>
													<div class="form-group">
													<label class="control-label">Nama Kepala Keluarga</label>   
														
													<input class="form-control" name="nama_kepala_keluarga" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="masukkan nama kepala keluarga" />
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
												<h3>Data Asal</h3>
											</th>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Propinsi Asal</label>
													
														<select type="text" name="id_propinsi_asal" class="form-control selectpicker" data-live-search="true" id="id_prop" onchange="show_kab()">
														<option value="" selected="selected">Pilih</option>
														<?php
															$sql_prop = mysqli_query($mysqli,"select * from wil_propinsi");
															while ($prop=mysqli_fetch_array($sql_prop)){
																echo "<option value='$prop[id_propinsi]'>$prop[nama_propinsi]</option>";
															}
														?>										
													</select>
												</div>											
												<div class="form-group">
													<label class="control-label">Kota/Kabupaten Asal</label>
													<select type="text" name="id_kabkota_asal" class="form-control" id="id_kab" onchange="show_kec()">
														<?php
															$sql_kab = mysqli_query($mysqli,"select * from wil_kabkota limit 10");
															while ($kab=mysqli_fetch_array($sql_kab)){
																echo "<option value='$kab[id_kabkota]'>$kab[nama_kabkota]</option>";
															}
														?>										
													</select>
												</div>	
												
												<div class="form-group">
													<label class="control-label">Kecamatan Asal</label>
													<select type="text" name="id_kecamatan_asal" class="form-control" id="id_kec" onchange="show_kel()">
														<?php
															$sql_kec = mysqli_query($mysqli,"select * from wil_kecamatan limit 10");
															while ($kec=mysqli_fetch_array($sql_kec)){
																echo "<option value='$kec[id_kecamatan]'>$kec[nama_kecamatan]</option>";
															}
														?>										
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">Kelurahan Asal</label>
													<select type="text" name="id_kelurahan_asal" class="form-control" id="id_kel">
														<?php
															$sql_kel = mysqli_query($mysqli,"select * from tb_kelurahan limit 10");
															while ($kel=mysqli_fetch_array($sql_kel)){
																echo "<option value='$kel[id_kelurahan]'>$kel[nama_kelurahan]</option>";
															}
														?>																	
													</select>
												</div>
													</td>								
												<td style="text-align:left">
													<div class="form-group">
													<label class="control-label">Dukuh Asal</label>
													<input class="form-control" name="dukuh_asal" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="" />
												</div>
												<div class="form-group">
													<label class="control-label">RT & RW Asal</label>
													<div class="form-inline">
														<input class="form-control form-control-sm" name="rt_asal" type="decimal" placeholder="RT" />
														<input class="form-control form-control-sm" name="rw_asal" type="decimal" placeholder="RW" />
													</div>
												</div>		
												<div class="form-group">
													<label class="control-label">Kode Pos & Telpon</label>
													<div class="form-inline">
														<input class="form-control form-control-sm" name="kode_pos" type="decimal" placeholder=" kode pos " />
														<input class="form-control form-control-sm" name="telpon" type="decimal" placeholder="nomer telpon/ hp" />
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">kembali</button>
												<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">lanjut</button>												
											</td>
										</tr>
									</table>
								</div>
								<div class="row setup-content" id="step-3">
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
													<select type="text" name="id_klasifikasi_pindah" class="form-control select2">
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
											</td>
											<td style="text-align:left">
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
													<div class="form-inline">
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
												</div>						
												<div class="form-group">
													<label class="control-label">Tanggal Datang</label>
													<div class="form-inline">
														<div class="input-group">
															<input class="form-control datepicker" name="tgl_datang" type="text" placeholder="thn-bln-tgl" />
															<div class="input-group-addon">
																<span class="fa fa-calendar"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">Warga yang Datang</label>	
												<div class="form-inline">
														<input class="form-control form-control-sm" name="nik" type="decimal" placeholder="Masukkan Nik Yang ikut" />=
														<input class="form-control form-control-sm" name="nama" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
														</div>	
													</div>		
												<div class="form-group">
													<label class="control-label">Nik Keluarga Yang Ikut Datang</label>
													<div class="form-inline">
														<input class="form-control form-control-sm" name="nik_kel1" type="number" placeholder="Masukkan Nik Yang ikut" />=
														<input class="form-control form-control-sm" name="nama_kel1" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
														</div>
														<div class="form-inline">
														<input class="form-control form-control-sm" name="nik_kel2" type="decimal" placeholder="Masukan Nik Yang Ikut" />=
														<input class="form-control form-control-sm" name="nama_kel2" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
													</div>
														<div class="form-inline">
														<input class="form-control form-control-sm" name="nik_kel3" type="decimal" placeholder="Masukan Nik Yang Ikut" />=
														<input class="form-control form-control-sm" name="nama_kel3" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
														</div>
														<div class="form-inline">
														<input class="form-control form-control-sm" name="nik_kel4" type="decimal" placeholder="Masukan Nik Yang Ikut" />=
														<input class="form-control form-control-sm" name="nama_kel4" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
														</div>
														<div class="form-inline">
														<input class="form-control form-control-sm" name="nik_kel5" type="decimal" placeholder="Masukan Nik Yang Ikut" />=
														<input class="form-control form-control-sm" name="nama_kel5" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Yang ikut" />
													</div>
												</div>		
											</td>
										</tr>

										<tr>
											<td colspan="2">
												<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">kembali</button>
												<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">lanjut</button>												
											</td>
										</tr>

									</table>
								</div>
								<div class="row setup-content" id="step-4">
									<table class="table">
										<tr>
											<th colspan="2">
												<h3>Data Daerah Tujuan</h3>
											</th>
										</tr>
										<tr>
											<td>	
												<div class="form-group">
													<label class="control-label">Dukuh Lokasi</label>
													<select type="text" name="id_dukuh" class="form-control select2">
														<option value="" selected="selected" autofocus="on">Pilih</option>
														<?php
															$sql = mysqli_query($mysqli,"SELECT * FROM m_dukuh ORDER BY id_dukuh");
															while($row1 = mysqli_fetch_assoc($sql)){
															echo '<option value='.$row1['id_dukuh'].'>'.$row1['nama_dukuh'].'- RT'.$row1['rt'].'/ RW'.$row1['rw'].'</option>'; }
														?>
													</select>
												</div>	
												
												<div class="form-group">
													<label class="control-label">Foto Surat KK</label>
													<input type="file" class="form-control" name="file_suratdatang">
                                                                                                        <h7>*) Masukan foto Keterangan pindah datang Dari pihak Penerang/ pihak yang bersangkutan </h7>
												</div>									
											</td>
										</tr>	
										<tr>
											<td colspan="2">
												<button class="btn btn-primary prevBtn btn-lg pull-left" type="button">kembali</button>
												<button class="btn btn-success btn-lg pull-right" type="submit" name="simpan">Simpan</button>											
											</td>
										</tr>										
									</table>
								</div>
							</form>
						  </div>
						</div>
					</section>
					</div>
				</div>
			</div>				
	
