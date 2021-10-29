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
<?php 

$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = "/"."474.2/".$tahun;
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT max(no_surat_mati) as maxKode FROM surat_mati";
$hasil = mysqli_query($mysqli,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;
//Membuat Nomor dengan awalan depan 0 misalnya , 01,02 
//Jika ingin 003 ,tinggal ganti %03
$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode. $nomor;


	// mencari kode barang dengan nilai paling besar
	$query = "SELECT max(id_mati) as maxKode FROM surat_mati";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$norut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$norut++;

	$char = "LT";
	$kodeBarang = $char . sprintf("%03s", $norut);
?>
	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Input Data Kematian </h3>
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Form Data Kematian </h3>
					</div>
					<div class="panel-body">

						<div class="container">
							<div class="stepwizard col-md-12">
								<div class="stepwizard-row setup-panel">
								  <div class="stepwizard-step">
									<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
									<p>Data Jenaza </p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
									<p>Data Orang Tua</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
									<p>Data Pelapor</p>
								  </div>
								</div>
							</div>
							  
							<form role="form" action="modul/surat_mati/proses.php?act=add" method="post" enctype="multipart/form-data">
								<div class="row setup-content" id="step-1">
									<table class="table">
										<tr>
											<th colspan="2">
												<h3>Data Jenaza</h3>
											</th>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label>No surat mati</label>
													<input class="form-control" id="id_mati" name="id_mati" value="<?php echo $kodeBarang;?>" type="hidden"  />
													<input class="form-control" id="nomorbaru" name="no_surat_mati" type="text" value="<?php echo $nomorbaru;?>" readonly="readonly"  />
												</div>
													<div class="form-group">
													<label>Kepala Keluarga</label>				
														<select type="text" class="form-control selectpicker" data-live-search="true" name="nik_kepala_keluarga">
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
													<label>Nama</label>								
														<select type="text" class="form-control selectpicker" data-live-search="true" name="nik" id="nik">
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
												 <div class="form-group">
													<label class="control-label">Anak Ke, Tanggal Kematian & Pukul</label>
													<div class="form-inline">
														<input class="form-control form-control-sm" name="anak_ke" type="text" placeholder="Anak Ke" />
														<div class="input-group">
															<input class="datepicker form-control form-control-sm" name="tgl_mati" type="text" placeholder="thn-bln-tgl" autocomplete="off"/>
															<div class="input-group-addon">
																<span class="fa fa-calendar"></span>
															</div>
														</div>
														<input class="form-control form-control-sm" name="waktu_mati" type="time" placeholder="masukan pukul/waktu kematian" />
													</div>
												</div>

											</td>
											<td style="text-align:left">
												<div class="form-group">
													<label class="control-label">Sebab Kematian</label>
													<div class="form-inline">
														<select type="text" id="id_sebab_mati" name="id_sebab_mati" class="form-control selectpicker" data-live-search="true">
														<option value="">Pilih</option>
														<?php
															$sql_gend = mysqli_query($mysqli,"select * from m_sebab_mati order by id_sebab_mati");
															while ($gend = mysqli_fetch_array($sql_gend)){
																echo "<option name='id_sebab_mati' value='$gend[id_sebab_mati]'>$gend[nama_sebab_mati]</option>";
															}
														?>
													</select>
													</div>
												</div>											
												<div class="form-group">
													<label class="control-label">Tempat Kematian & Umur Jenaza</label>
													<div class="form-inline">
														<input class="form-control form-control-sm" name="tempat_mati" type="text" placeholder="lokasi Kematian"onkeyup="this.value = this.value.toUpperCase()" />
														<div class="input-group">
															<input class="form-control form-control-sm" name="umur_mati" type="text"  placeholder="masukkan umur"/>
														</div>
													</div>	
												</div>

												<div class="form-group">
													<label class="control-label">Yang Menerangkan</label>
													<select type="text" name="id_penerang" class="form-control selectpicker" data-live-search="true">
														<?php
															$sql_jen_lahir = mysqli_query($mysqli,"select * from m_penerang");
															while ($jen_lahir = mysqli_fetch_array($sql_jen_lahir)){
																echo "<option value='$jen_lahir[id_penerang]'>$jen_lahir[nama_penerang]</option>";
															}
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
												<h3>Data Orang Tua</h3>
											</th>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Nama Ayah</label>
													<select type="text" name="nik_ayah" class="form-control selectpicker" data-live-search="true">
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
											</td>
											<td style="text-align:left">
														
												<div class="form-group">
													<label class="control-label">Nama Ibu</label>
													<select type="text" name="nik_ibu" class="form-control selectpicker" data-live-search="true">
														<option value="" selected="selected" autofocus="on">Pilih</option>
														<?php
															$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk WHERE id_gender='2' ORDER BY nik ");
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
												<h3>Data Pelapor</h3>
											</th>
										</tr>
										<tr>
											<td>
												<div class="form-group">
													<label class="control-label">Nama Pelapor</label>
													<select type="text" name="nik_pelapor" class="form-control selectpicker" data-live-search="true">
														<option value="<?php echo $_SESSION['nik'];?>" selected ><?php echo nama_pend($_SESSION['nik']);?></option>
														<?php
															$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
															while($row1 = mysqli_fetch_assoc($sql)){
															echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
														?>
													</select>
												</div>		
											
												<div class="form-group">
													<label class="control-label">Nama Saksi 1: </label>
													<select type="text" name="nik_saksi1" class="form-control selectpicker" data-live-search="true">
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
													<label class="control-label">Nama Saksi 2: </label>
													<select type="text" name="nik_saksi2" class="form-control selectpicker" data-live-search="true">
														<option value="" selected="selected" autofocus="on">Pilih</option>
														<?php
															$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
															while($row1 = mysqli_fetch_assoc($sql)){
															echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label">Foto Surat </label>
													<input type="file" class="form-control" name="file_suratmati">
													<h7>*) Masukan foto Keteranngan Kematian Dari pihak Penerang/ pihak yang bersangkutan </h7>
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
				</section>
			</div>
		</div>					
	</div>
	
