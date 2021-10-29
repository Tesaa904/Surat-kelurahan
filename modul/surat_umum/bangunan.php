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
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
include'config/no_umum.php';
	$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = "/IMB/".$romawi."/".$tahun;
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT max(no_surat_imb) as maxKode FROM surat_ket_umum";
$hasil = mysqli_query($mysqli,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;
//Membuat Nomor dengan awalan depan 0 misalnya , 01,02 
//Jika ingin 003 ,tinggal ganti %03
$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode.$nomor;
?>

<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Pengajuan Surat Keterangan Membangun Bangunan </h3>
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Isi Data Membangun Bangunan </h3>
					</div>
					<div class="panel-body">

						<div class="container">
							<div class="stepwizard col-md-12">
								<div class="stepwizard-row setup-panel">
								  <div class="stepwizard-step">
									<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
									<p>Data Diri</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
									<p>Data Berkas</p>
								  </div>
								</div>
							</div>
					  		
					<form role="form" action="modul/surat_umum/proses.php?act=add" method="post" enctype="multipart/form-data">
						<div class="row setup-content" id="step-1">
							<table class="table">
								<tr>
									<th colspan="2">
										<h3>Data Diri</h3>
									</th>
								</tr>
								<tr>
									<td style="text-align:left">
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">No Surat </label>
											<input class="form-control" id="id_ket_umum" name="id_ket_umum" value="<?php echo $kodeBarang;?>"  type="hidden"  />
											<input type="text" class="form-control" name="no_surat_imb" value="<?php echo $nomorbaru;?>" readonly="readonly">
											<input type="hidden" class="form-control" name="no_surat_skt"  readonly="readonly">
											<input type="hidden" class="form-control" name="no_surat_skd"  readonly="readonly">
											<input type="hidden" class="form-control" name="no_surat_skp"  readonly="readonly">
											<input type="hidden" class="form-control" name="no_surat_sir"  readonly="readonly">
											<input type="hidden" class="form-control" name="no_surat_sku"  readonly="readonly">
											
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Pemohon Surat</label>
											
											<select type="text" name="nik" class="form-control select2">
							
												<option value="<?php echo $_SESSION['nik'];?>" ><?php echo nama_pend($_SESSION['nik']);?></option>
											</select>
										</div>	
										<!--	<div class="form-group">
											<label class="control-label">Nama Ayah</label> -->
											
											<select type="text" name="nik_ayah" class="form-control hidden">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
								<!--		</div>	
										<div class="form-group">
											<label class="control-label">Nama Ibu</label> -->
											
											<select type="text" name="nik_ibu" class="form-control hidden">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
									<!--	</div>
										<div class="form-group">
											<label class="control-label" type="hidden">Tanggal keperluan</label> -->
										<div class="input-group">
													<input class="datepicker form-control form-control-sm" name="tgl_keperluan" type="hidden" placeholder="thn-bln-tgl"/>
													<!--<div class="input-group-addon">
														<span class="fa fa-calendar"></span> 
													</div> -->
												</div>
												<input type="hidden" class="form-control" name="pukul_kegiatan" >
											<!--	</div> -->
											
										<div class="form-group">
											<label class="control-label">Untuk Keperluan </label>

											<select type="hidden" name="id_jenis_surat" class="form-control hidden">
												
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_jenis_surat WHERE id_jenis_surat='5'ORDER BY id_jenis_surat");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_jenis_surat'].'>'.$row1['nama_jenis_surat'].'-'.$row1['id_jenis_surat'].'</option>'; }
												?>
											</select>	
											<input type="text" class="form-control" name="keperluan" placeholder="Keperluan Dalam pengajuan surat ini" >
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
										<h3> Data Bangunan & Berkas Pengajuan Surat</h3>
									</th>
								</tr>
								<tr>
									<td style="text-align:left">
										<div class="col-md-6">
										<div class="form-group">
											
											<input type="hidden" class="form-control" name="nama_usaha"  placeholder="Nama Usaha Yang dimiliki">
									
											<input type="hidden" class="form-control" name="alamat_usaha"  placeholder="Alamat Usaha">
										</div>		
										<div class="form-group">
											<label class="control-label">Jenis Bangunan Yang didirikan </label>
											<select type="text" class="form-control"name="jenis_bangunan" required="required">
													<option value="Mendirikan Banguan Baru">Mendirikan Banguan Baru</option>
													<option value="Bangunan Tambah">Bangunan Tambah</option>
													<option value="Mengubah sebagian atau Seluruh bangunan">Mengubah sebagian atau Seluruh bangunan</option>
													<option value="Membongkar sebagian atau seluruh bangunan">Membongkar sebagian atau seluruh bangunan</option>
												</select>
										</div>	
										<div class="form-group">
											<label class="control-label"> Terletak Diatas Pensil </label>
											<input type="text" class="form-control" name="letak"  placeholder="Letak luas tanah/banguan">
										</div>
										<div class="form-group">
											<label class="control-label"> Status Tanah </label>
											<input type="text" class="form-control" name="status_tanah"  placeholder="Status kepemilikan tanah">
											<input type="hidden" class="form-control" name="data_ubah"  placeholder="Status kepemilikan tanah">
											<input type="hidden" class="form-control" name="data_benar"  placeholder="Status kepemilikan tanah">
											<input type="hidden" class="form-control" name="penghasilan"  placeholder="Status kepemilikan tanah">
										</div>											
										<div class="form-group">
											<label class="control-label">Foto Surat </label>
											<input type="file" class="form-control" name="file_suratketumum"  placeholder="Masukan foto Pengantar RT/RW"> 
											<h7>*) Masukan foto Pengantar RT/RW </h7>
										</div>								
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
<?php
	}
?>