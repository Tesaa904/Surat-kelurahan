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
	$idmati = "SELECT max(id_mati) as maxKode FROM surat_mati";
	$hasil = mysqli_query($mysqli,$idmati);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$norut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$norut++;

	$char = "LT";
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
					  
					<form role="form" action="modul/ketmati/proses.php?act=add" method="post" enctype="multipart/form-data">
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
											<input class="form-control" id="nomorbaru" name="no_surat_mati" type="text" value="<?php echo $nomorbaru;?>"readonly="readonly"  />
										</div>
											<div class="form-group">
											<label>Kepala Keluarga</label>				
												<select type="text" class="form-control select2" name="nik_kepala_keluarga">
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
											<label>Nama</label>								
												<select type="text" class="form-control select2" name="nik" id="nik">
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
										 <div class="form-group">
											<label class="control-label">Anak Ke, Tanggal Kematian & Pukul</label>
											<div class="form-inline">
												<input class="form-control form-control-sm" name="anak_ke" type="text" placeholder="Anak Ke" />
												<div class="input-group">
													<input class="datepicker form-control form-control-sm" name="tgl_mati" type="text" placeholder="thn-bln-tgl"/>
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
												<select type="text" id="id_sebab_mati" name="id_sebab_mati" class="form-control select2">
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
												<input class="form-control form-control-sm" name="tempat_mati" type="text" placeholder="lokasi Kematian" onkeyup="this.value = this.value.toUpperCase()" />
												<div class="input-group">
													<input class="form-control form-control-sm" name="umur_mati" type="text"  placeholder="masukkan umur"/>
												</div>
										</div>

										<div class="form-group">
											<label class="control-label">Yang Menerangkan</label>
											<select type="text" name="id_penerang" class="form-control select2">
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
											<select type="text" name="nik_ayah" class="form-control select2">
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
									<td style="text-align:left">
												
										<div class="form-group">
											<label class="control-label">Nama Ibu</label>
											<select type="text" name="nik_ibu" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk WHERE status='1' and id_gender='2' ORDER BY nik ");
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
											<select type="text" name="nik_pelapor" class="form-control select2">
												<option value="" selected="selected" autofocus="on">Pilih</option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
									
										<div class="form-group">
											<label class="control-label">Nama Saksi 1: </label>
											<select type="text" name="nik_saksi1" class="form-control select2">
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
											<label class="control-label">Nama Saksi 2: </label>
											<select type="text" name="nik_saksi2" class="form-control select2">
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
		</div>
	</div>
</div>					
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,b.nama,b.tmpt_lahir,b.tgl_lahir,e.nama_gender,c.nama_sebab_mati,d.nama_penerang,f.nama_dukuh,f.rt,f.rw
FROM surat_mati a LEFT JOIN m_penduduk b ON a.nik=b.nik
LEFT JOIN m_sebab_mati c ON a.id_sebab_mati=c.id_sebab_mati
LEFT JOIN m_penerang d ON a.id_penerang=d.id_penerang
LEFT JOIN m_dukuh f ON b.id_dukuh=f.id_dukuh
LEFT JOIN m_gender e ON b.id_gender=e.id_gender WHERE id_mati='$get_id'"));
?>
	<form method="POST" action="modul/ketmati/proses.php?act=edit">
		<div class="panel-heading no-collapse">
					UDAH DATA
				</div>
		<tr>
			<td>
				<table class="table"> 
						<td>
									<div class="form-group">
										<label>No Surat Mati</label>
										<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_mati'];?>">
										<input type="text" class="form-control" name="no_surat_mati" readonly="readonly" value="<?php echo $data['no_surat_mati'];?>">
									</div>
										<div class="form-group">
											<label>Kepala Keluarga</label>	
												<select type="text" class="form-control select2" name="nik_kepala_keluarga" readonly="readonly">
													<option value="<?php echo $data['nik_kepala_keluarga'];?>" autofocus="on" selected><?php echo name_from_nik($data['nik_kepala_keluarga']) ?></option>
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
											<label class="control-label">Nama Jenaza</label>								   
											<select type="text" class="form-control select2" name="nik">
												<option value="<?php echo $data['nik'];?>" autofocus="on" selected><?php echo name_from_nik($data['nik']) ?></option>
													<?php
														$sql_kpl = mysqli_query($mysqli,"Select * from m_penduduk where id_shdk='1' order by nik asc");
														while ($kepala=mysqli_fetch_array($sql_kpl)){
															if ($kepala['nik']==$kepala['nama'])
												$select = "selected";
											else
												$select = "";
															echo "<option value='$kepala[nik]'>$kepala[nik] - $kepala[nama]</option>";
														}
													?>										   
												</select>
										</div>
										
										<div class="form-group">
											<label class="control-label">Anak Ke, Tanggal Mati dan Waktu Mati</label>
											<div class="form-inline">
												<input class="form-control" name="anak_ke" type="number" value="<?php echo $data['anak_ke'];?>" />
											<input class="form-control datepicker" name="tgl_mati" type="text" value="<?php echo $data['tgl_mati'];?>">
														<input class="form-control" name="waktu_mati" type='time' value="<?php echo $data['waktu_mati'];?>" />
													</div>
												</div>							
										<div class="form-group">
											<label class="control-label">Sebab Kematian</label>
											<select type="text" name="id_sebab_mati" class="form-control select2">
											<option value="<?php echo $data['id_sebab_mati'];?>" autofocus="on" selected><?php echo $data['nama_sebab_mati'] ?></option>
												<?php
										$sql_data1 = mysqli_query($mysqli,"select * from m_sebab_mati order by id_sebab_mati asc");
										while ($data1 = mysqli_fetch_array($sql_data1)){
											if ($data1['id_sebab_mati']==$data['nama_sebab_mati'])
												$select = "selected";
											else
												$select = "";
											echo "<option value='$data1[id_sebab_mati]' $select>$data1[nama_sebab_mati]</option>";
										}
									?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Tempat Kematian dan Umur Jenaza</label>
											<div class="form-inline">
												<input class="form-control" name="tempat_mati" type="text" value="<?php echo $data['tempat_mati'];?>" />
											<input class="form-control" name="umur_mati" type="number" value="<?php echo $data['umur_mati'];?>">
										</div>
									</div>

									</td>
									<td style="text-align:left">
										<div class="form-group">
											<label class="control-label">Penerang Pada Jenaza</label>
											<select type="text" name="id_penerang" class="form-control select2">
												<option value="<?php echo $data['id_penerang'];?>" selected><?php echo $data['nama_penerang'] ?></option>
												<?php
													$sql_data1 = mysqli_query($mysqli,"select * from m_penerang");
													while ($data1 = mysqli_fetch_array($sql_data1)){
														if ($data1['id_penerang']==$data['nama_penerang'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$data1[id_penerang]'$select>$data1[nama_penerang]</option>";
													}
												?>														
											</select>
										</div>	
										
										<div class="form-group">
											<label class="control-label">Nama Ayah</label>
											<select type="text" name="nik_ayah" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_ayah'];?>" selected><?php echo name_from_nik ($data['nik_ayah']) ?></option>
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
											<label class="control-label">Nama Ibu</label>
											<select type="text" name="nik_ibu" class="form-control select2">
												<option value="<?php echo $data['nik_ibu'];?>" selected="selected"><?php echo name_from_nik($data['nik_ibu']) ?></option>
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
											<label class="control-label">Nama Pelapor</label>
											<select type="text" name="nik_pelapor" class="form-control select2">
												<option value="<?php echo $data['nik_pelapor'];?>" selected ><?php echo name_from_nik ($data['nik_pelapor']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Saksi 1: </label>
											<select type="text" name="nik_saksi1" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_saksi1'];?>" selected><?php echo name_from_nik ($data['nik_saksi1']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where status='1' ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>		
										<div class="form-group">
											<label class="control-label">Nama Saksi 2: </label>
											<select type="text" name="nik_saksi2" class="form-control select2">
												<option autofocus="on" value="<?php echo $data['nik_saksi2'];?>" selected><?php echo name_from_nik ($data['nik_saksi2']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
										</div>	
									</td>
								</table>
							</td>
						</tr>		
					
								<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
								</div>
								
				</form>
<?php
	}
?>