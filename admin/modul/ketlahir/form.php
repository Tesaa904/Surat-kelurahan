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
<?php
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
        
     $bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = "/"."474.1/".$tahun;
// membaca kode  terbesar dari penomoran yang ada didatabase berdasarkan tanggal
$query = "SELECT max(no_surat_lahir) as maxKode FROM surat_lahir";
$hasil = mysqli_query($mysqli,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;
//Membuat Nomor dengan awalan depan 0 misalnya , 01,02 
//Jika ingin 003 ,tinggal ganti %03
$kode =  sprintf("%03s", $noUrut);
$nomorbaru = $kode. $nomor;


	// mencari kode barang dengan nilai paling besar
	$query = "SELECT max(id_lahir) as maxKode FROM surat_lahir";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$norut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$norut++;

	$char = "LH";
	$kodeBarang = $char . sprintf("%03s", $norut);
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
							<p>Data Bayi</p>
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
					  
					<form role="form" action="modul/ketlahir/proses.php?act=add" method="post" enctype="multipart/form-data">
						<div class="row setup-content" id="step-1">
							<table class="table">
								<tr>
									<th colspan="2">
										<h3>Data Bayi</h3>
									</th>
								</tr>
								<tr>
									<td>
                                                                                <div class="form-group">
											<label>No surat lahir</label>
											<input class="form-control" id="id_lahir" name="id_lahir" value="<?php echo $kodeBarang;?>" type="hidden"  />
											<input class="form-control" id="nomorbaru" name="no_surat_lahir" type="text" value="<?php echo $nomorbaru;?>"readonly="readonly"  />
										</div>
                                                                                
										<div class="form-group">
											<label>Kepala Keluarga</label>										 
												<select type="text" class="form-control select2" name="nik_kpl_kel">
													<option value="" autofocus="on">Pilih</option>
													<?php
														$sql_kpl = mysqli_query($mysqli,"Select * from m_penduduk where id_shdk='1' and status='1' order by nik asc");
														while ($kepala=mysqli_fetch_array($sql_kpl)){
															echo "<option value='$kepala[nik]'>$kepala[nik] - $kepala[nama]</option>";
														}
													?>										   
												</select>
										</div>
										<div class="form-group">
											<label class="control-label">Nama Bayi</label>								   
											<input class="form-control" name="nama" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="Nama Bayi"autocomplete="off" />
										</div>
										 <div class="form-group">
											<label class="control-label">Tempat, Tanggal, & Jam Lahir</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="tmpt_lahir" type="text" onkeyup="this.value = this.value.toUpperCase()" placeholder="Tempat Lahir" autocomplete="off"/>
												<div class="input-group">
													<input class="datepicker form-control form-control-sm" name="tgl_lahir" type="text" placeholder="thn-bln-tgl" autocomplete="off"/>
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
												<input class="form-control form-control-sm" name="pukul" type="time" placeholder="masukan nama bayi" />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Hari Lahir, Anak Ke</label>
											<div class="form-inline">
												<select type="text" class="form-control"name="hari" required="required">
													<option value="Senin">Senin</option>
													<option value="Selasa">Selasa</option>
													<option value="Rabu">Rabu</option>
													<option value="Kamis">Kamis</option>
													<option value="Jum'at">Jum'at</option>
													<option value="Sabtu">Sabtu</option>
													<option value="Minggu">Minggu</option>
												</select>
												<input class="form-control" name="anak_ke" type="number" placeholder="Anak Ke" />
											</div>
										</div>												
									</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Jenis Kelamin</label>
											<select type="text" name="id_gender" class="form-control select2">
												<option value="">Pilih</option>
												<?php
													$sql_gend = mysqli_query($mysqli,"select * from m_gender order by id_gender");
													while ($gend = mysqli_fetch_array($sql_gend)){
														echo "<option name='gender' value='$gend[id_gender]'>$gend[nama_gender]</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Jenis Kelahiran</label>
											<select type="text" name="jenis_lahir" class="form-control select2">
												<?php
													$sql_jen_lahir = mysqli_query($mysqli,"select * from m_jenis_lahir");
													while ($jen_lahir = mysqli_fetch_array($sql_jen_lahir)){
														echo "<option value='$jen_lahir[id_jenis_lahir]'>$jen_lahir[nama_jenis_lahir]</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Tempat Dilahirkan</label>
											<select type="text" name="tmp_dilahir" class="form-control select2">
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_tempat_lahir");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														echo "<option value='$tm_lahir[id_tempat_lahir]'>$tm_lahir[nama_tempat_lahir]</option>";
													}
												?>														
											</select>
										</div>										
										<div class="form-group">
											<label class="control-label">Penolong Kelahiran</label>
											<select type="text" name="penolong" class="form-control select2">
												<?php
													$sql_penolong = mysqli_query($mysqli,"select * from m_penolong");
													while ($penolong = mysqli_fetch_array($sql_penolong)){
														echo "<option value='$penolong[id_penolong]'>$penolong[nama_penolong]</option>";
													}
												?>													
											</select>
										</div>	
										<div class="form-group">
											<label class="control-label">Berat & Panjang Bayi</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="berat" type="text" placeholder=" berat badan bayi " />
												<input class="form-control form-control-sm" name="panjang" type="text" placeholder="Panjang bayi " />
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
										<h3>Data Orang Tua</h3>
									</th>
								</tr>
								<tr>
									<td>
										<div class="form-group">
											<label class="control-label">Nama Ibu</label>
											<select type="text" name="nik_ibu" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' and id_gender='2' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>
											</select>
										</div>									
										<div class="form-group">
											<label class="control-label">Tgl Pencatatan Perkawinan</label>
											<div class="form-inline">
												<div class="input-group">
													<input class="form-control datepicker" name="tgl_nikah" type="text" placeholder="thn-bln-tgl" />
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
											</div>
										</div>											
									</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Nama Ayah</label>
											<select type="text" name="nik_ayah" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' and id_gender='1' ORDER BY nik");
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
											<select type="text" name="nik_pl" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
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
																							
									</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Nama Saksi 1: </label>
											<select type="text" name="nik_sk1" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Saksi 2: </label>
											<select type="text" name="nik_sk2" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>
                                                                                <div class="form-group">
											<label class="control-label">Foto Surat Kelahiran</label>
											<input type="file" class="form-control" name="file_suratlahir">
											<h7>*) Masukan foto surat Keteranngan kelahiran Dari pihak yang bersangkutan </h7>
										</div>
                                                                                <input class="form-control" name="id_status_surat" type="hidden" value="2">
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
		$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh,f.rt
                            FROM surat_lahir a LEFT JOIN m_gender b ON a.id_gender=b.id_gender
                            LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
                            LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
                            LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
                            LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh WHERE id_lahir='$get_id'"));
?>
	<form method="POST" action="modul/ketlahir/proses.php?act=edit">
		<div class="panel-heading no-collapse">
					UDAH DATA
				</div>
		<tr>
			<td>
				<table class="table"> 
						<td>
									<div class="form-group">
										<label>No Surat Lahir</label>
										<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_lahir'];?>">
										<input type="text" class="form-control" name="no_surat_lahir" value="<?php echo $data['no_surat_lahir'];?>"readonly="readonly">
									</div>
										<div class="form-group">
											<label>Kepala Keluarga</label>	
												<select type="text" class="form-control select2" name="nik_kepala_keluarga">
													<?php
														$sql_kpl = mysqli_query($mysqli,"Select * from m_penduduk where id_shdk='1' and status='1' order by nik asc");
														while ($kepala=mysqli_fetch_array($sql_kpl)){
															if ($kepala['nik_kepala_keluarga']==$kepala['nama'])
												$select = "selected";
											else
												$select = "";
															echo "<option value='$kepala[nik]'>$kepala[nik] - $kepala[nama]</option>";
														}
													?>										   
												</select>
										</div>
										<div class="form-group">
											<label class="control-label">Nama Bayi</label>								   
											<input class="form-control" name="nama" value="<?php echo $data['nama'];?>" onkeyup="this.value = this.value.toUpperCase()" type="text" placeholder="Nama Bayi" />
										</div>
										 <div class="form-group">
											<label class="control-label">Tempat, Tanggal, & Jam Lahir</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="tempat_lahir" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['tempat_lahir'];?>" type="text" placeholder="Tempat Lahir" />
												<div class="input-group">
													<input class="datepicker form-control form-control-sm" name="tgl_lahir" value="<?php echo $data['tgl_lahir'];?>" type="text" placeholder="thn-bln-tgl"/>
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
												<input class="form-control form-control-sm" name="pukul" value="<?php echo $data['pukul'];?>" type="time" placeholder="masukan nama bayi" />
											</div>
										</div>
										</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Hari Lahir, Anak Ke</label>
											<div class="form-inline">
												<select type="text" class="form-control"name="hari" required="required">
													<option value="<?php echo $data['hari'];?>" selected><?php echo $data['hari'] ?></option>
													<option value="Senin">Senin</option>
													<option value="Selasa">Selasa</option>
													<option value="Rabu">Rabu</option>
													<option value="Kamis">Kamis</option>
													<option value="Jum'at">Jum'at</option>
													<option value="Sabtu">Sabtu</option>
													<option value="Minggu">Minggu</option>
												</select>
												<input class="form-control" name="anak_ke" type="number" value="<?php echo $data['anak_ke'];?>" placeholder="Anak Ke" />
											</div>
										</div>							
										<div class="form-group">
											<label class="control-label">Jenis Kelamin</label>
											<select type="text" name="id_gender" class="form-control select2">
											<option value="<?php echo $data['id_gender'];?>" autofocus="on" selected><?php echo $data['nama_gender'] ?></option>
												<?php
										$sql_gender = mysqli_query($mysqli,"select * from m_gender order by id_gender asc");
										while ($gender = mysqli_fetch_array($sql_gender)){
											if ($gender['id_gender']==$data['nama_gender'])
												$select = "selected";
											else
												$select = "";
											echo "<option value='$gender[id_gender]' $select>$gender[nama_gender]</option>";
										}
									?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Jenis Kelahiran</label>
											<select type="text" name="id_jenis_lahir" class="form-control select2">
												<option value="<?php echo $data['id_jenis_lahir'];?>" selected><?php echo $data['nama_jenis_lahir'] ?></option>
												<?php
													$sql_jen_lahir = mysqli_query($mysqli,"select * from m_jenis_lahir");
													while ($jen_lahir = mysqli_fetch_array($sql_jen_lahir)){
														if ($jen_lahir['id_jenis_lahir']==$data['nama_jenis_lahir'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$jen_lahir[id_jenis_lahir]' $select>$jen_lahir[nama_jenis_lahir]</option>";
													}
												?>
											</select>
										</div>

									
										<div class="form-group">
											<label class="control-label">Tempat Dilahirkan</label>
											<select type="text" name="id_tempat_lahir" class="form-control select2">
												<option value="<?php echo $data['id_tempat_dilahir'];?>" selected><?php echo $data['nama_tempat_lahir'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_tempat_lahir");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_tempat_lahir']==$data['nama_tempat_lahir'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_tempat_lahir]'$select>$tm_lahir[nama_tempat_lahir]</option>";
													}
												?>														
											</select>
										</div>	
										</td>
								</table>
							<table class="table">
								<tr>
									<td>
										<div class="form-group">
											<label class="control-label">Penolong Kelahiran</label>
											<select type="text" name="id_penolong" class="form-control select2">
												<option value="<?php echo $data['id_penolong'];?>" selected><?php echo $data['nama_penolong'] ?></option>
												<?php
													$sql_penolong = mysqli_query($mysqli,"select * from m_penolong order by id_penolong asc");
													while ($penolong = mysqli_fetch_array($sql_penolong)){
														if ($penolong['id_penolong']==$data['nama_penolong'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$penolong[id_penolong]'$select>$penolong[nama_penolong]</option>";
													}
												?>					
											</select>
										</div>	
										<div class="form-group">
											<label class="control-label">Berat & Panjang Bayi</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="berat" value="<?php echo $data['berat'];?>" type="text" placeholder=" berat badan bayi " />
												<input class="form-control form-control-sm" name="panjang" value="<?php echo $data['panjang'];?>" type="text" placeholder="Panjang bayi " />
											</div>
										</div>							
									
										<div class="form-group">
											<label class="control-label">Nama Ibu</label>
											<select type="text" name="nik_ibu" class="form-control select2">
												<option value="<?php echo $data['nik_ibu'];?>" selected="selected" autofocus="on"><?php echo name_from_nik ($data['nik_ibu']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where id_gender='2' and status='1' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>
											</select>
										</div>									
										<div class="form-group">
											<label class="control-label">Tgl Pencatatan Perkawinan</label>
											<div class="form-inline">
												<div class="input-group">
													<input class="form-control datepicker" name="tgl_nikah" type="text" value="<?php echo $data['tgl_nikah'];?>">
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
											</div>
										</div>											
									</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Nama Ayah</label>
											<select type="text" name="nik_ayah" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_ayah'];?>" selected><?php echo name_from_nik ($data['nik_ayah']);?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where id_gender='1' and status='1' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>
											</select>
										</div>						
										<div class="form-group">
											<label class="control-label">Nama Pelapor</label>
											<select type="text" name="nik_pl" class="form-control select2">
												<option value="<?php echo $data['nik_pelapor'];?>" selected ><?php echo $data['nik_pelapor'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where  status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Saksi 1: </label>
											<select type="text" name="nik_sk1" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_saksi1'];?>" selected><?php echo $data['nik_saksi1'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Saksi 2: </label>
											<select type="text" name="nik_sk2" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_saksi2'];?>" selected><?php echo $data['nik_saksi2'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>	
										<div class="form-group">
											<label class="control-label">Nama Dukuh Tinggal Bayi</label>
											<select type="text" name="id_dukuh" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['id_dukuh'];?>" selected><?php echo $data['nama_dukuh'] ?>- RT<?php echo $data['rt'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_dukuh ORDER BY id_dukuh");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['id_dukuh'].'>'.$row1['nama_dukuh'].'- RT'.$row1['rt'].'/ RW'.$row1['rw'].'</option>'; }
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