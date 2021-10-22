<?php
include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*, b.nama,b.tmpt_lahir,b.tgl_lahir,b.no_kk,i.nama_dukuh,c.nama_agama,d.nama_gender,e.nama_pekerjaan,f.nama_pendidikan,g.nama_statuskawin,h.nama_jenis_surat FROM surat_ket_umum a LEFT JOIN m_penduduk b ON a.nik=b.nik
LEFT JOIN m_agama c ON b.id_agama=c.id_agama 
LEFT JOIN m_gender d ON b.id_gender=d.id_gender 
LEFT JOIN m_pekerjaan e ON b.id_pekerjaan=e.id_pekerjaan
LEFT JOIN m_pendidikan f ON b.id_pendidikan=f.id_pendidikan
LEFT JOIN m_statuskawin g ON b.id_statuskawin=g.id_statuskawin
LEFT JOIN m_jenis_surat h ON a.id_jenis_surat=h.id_jenis_surat
LEFT JOIN m_dukuh i ON b.id_dukuh=i.id_dukuh WHERE id_ket_umum='$get_id'"));
?>
<div class="col-md-8">
	<form method="POST" action="modul/ketumum/proses.php?act=edit">
		<div class="panel-heading no-collapse">
					UDAH DATA
				</div>
		
			<div class="form-group">
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_ket_umum'];?>">
			<input type="hidden" class="form-control" name="no_surat_imb"  value="<?php echo $data['no_surat_imb'];?>" >
			<input type="hidden" class="form-control" name="no_surat_skt" value="<?php echo $data['no_surat_skt'];?>">
			<input type="hidden" class="form-control" name="no_surat_skd" value="<?php echo $data['no_surat_skd'];?>">
			<input type="hidden" class="form-control" name="no_surat_skp" value="<?php echo $data['no_surat_skp'];?>">
			<input type="hidden" class="form-control" name="no_surat_sir" value="<?php echo $data['no_surat_sir'];?>">
			<input type="hidden" class="form-control" name="no_surat_sku" value="<?php echo $data['no_surat_sku'];?>"  readonly="readonly">
		</div>
		<div class="form-group">
			<label>Jenis Surat</label>
			 <select type="text"  readonly="readonly" name="id_jenis_surat"  class="form-control" placeholder="-">
              <option value="<?php echo $data['id_jenis_surat'] ?>"  readonly="readonly"><?php echo $data['nama_jenis_surat'] ?></option>
			<?php
				$sql_gender = mysqli_query($mysqli,"select * from m_jenis_surat order by id_jenis_surat asc");
				while ($gender = mysqli_fetch_array($sql_gender)){
					echo "<option value='$gender[id_jenis_surat]'>$gender[nama_jenis_surat]-($gender[id_jenis_surat])</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">			
			<label>Nama</label>
			<select type="text" name="nik"  readonly="readonly" class="form-control select2">
												<option value="<?php echo $data['nik'];?>" selected  readonly="readonly"><?php echo name_from_nik ($data['nik']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk ORDER BY nik");
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
												?>
											</select>
		</div>
		<div class="form-group">
			<label>Nama Ayah</label>
			<br>*) bagi pengajuan surat ket.Tidak Mampu
			<select type="text" name="nik_ayah" class="form-control select2">
												<option value="<?php echo $data['nik_ayah'];?>" selected autofocus="on"><?php echo name_from_nik ($data['nik_ayah']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where id_gender='1' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>
											</select>
		</div>
		
		<div class="form-group">
			<label>Nama Ibu</label>
			<br>*) bagi pengajuan surat ket.Tidak Mampu
			<select type="text" name="nik_ibu" class="form-control select2">
												<option value="<?php echo name_from_nik($data['nik_ibu'])?>" selected="selected" autofocus="on"><?php echo name_from_nik ($data['nik_ibu']) ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_penduduk where id_gender='2' ORDER BY nik");
												   // if(mysqli_num_rows($sql) != 0){
													while($row1 = mysqli_fetch_assoc($sql)){
													echo '<option value='.$row1['nik'].'>'.$row1['nama'].'-'.$row1['nik'].'</option>'; }
													//}
												?>
											</select>
		</div>
		<div class="form-group">
		<label class="control-label" type="text">Tanggal & Waktu Kegiatan</label>
		<br>*) bagi pengajuan surat Ijin Keramaian
		<div class="form-inline">
			<div class="input-group">
			<input class="datepicker form-control form-control-sm" name="tgl_keperluan" type="text" value="<?php echo $data['tgl_keperluan'];?>"  placeholder="-"/>
			<div class="input-group-addon">
				<span class="fa fa-calendar"></span> 
			</div>
		</div>
		<input type="time" class="form-control" name="pukul_kegiatan" placeholder="-" value="<?php echo $data['pukul_kegiatan'];?>" placeholder="-">
		</div>
	</div>
<div class="form-group">
	<label class="control-label">Untuk Keperluan </label>
	<input type="text" class="form-control" name="keperluan" value="<?php echo $data['keperluan'];?>" placeholder="-" >
</div>			
<div class="form-group">
	<label class="control-label">Nama Usaha</label>
	<br>*) bagi pengajuan surat ket.Usaha
	<input type="text" class="form-control" name="nama_usaha" value="<?php echo $data['nama_usaha'];?>" placeholder="-">
</div>
<div class="form-group">
	<label class="control-label">Alamat Usaha</label>
	<br>*) bagi pengajuan surat ket.Usaha
	<input type="text" class="form-control" name="alamat_usaha" value="<?php echo $data['alamat_usaha'];?>" placeholder="-">
</div>
<div class="form-group">
	<label class="control-label">Jenis Pembangunan </label>
	<br>*) bagi pengajuan surat Ijin mendirikan Bagunan
	<select type="text" class="form-control"name="jenis_bangunan" >
			<option value="<?php echo $data['jenis_bangunan'];?>" selected><?php echo $data['jenis_bangunan'] ?></option>
			<option value="Mendirikan Banguan Baru">Mendirikan Banguan Baru</option>
			<option value="Bangunan Tambah">Bangunan Tambah</option>
			<option value="Mengubah sebagian atau Seluruh bangunan">Mengubah sebagian atau Seluruh bangunan</option>
			<option value="Membongkar sebagian atau seluruh bangunan">Membongkar sebagian atau seluruh bangunan</option>
		</select>
	</div>
		<div class="form-group">
	<label class="control-label">Letak Luas Pembangunan </label>
	<br>*) bagi pengajuan surat  Ijin mendirikan Bagunan
	<input type="text" class="form-control" name="letak"  value="<?php echo $data['letak'];?>" placeholder="-">
</div>
<div class="form-group">
	<label class="control-label">Status Tanah </label>
	<br>*) bagi pengajuan surat  Ijin mendirikan Bagunan
	<input type="text" class="form-control" name="status_tanah" value="<?php echo $data['status_tanah'];?>">
	<div class="form-group">
	<label class="control-label">Data Yang Akan Diubah </label>
	<br>*) bagi pengajuan surat Ket Perubahan data
	<input type="text" class="form-control" name="data_ubah" value="<?php echo $data['data_ubah'];?>">
	<div class="form-group">
	<label class="control-label">Data benar </label>
	<br>*) bagi pengajuan surat ket Perubahan data
	<input type="text" class="form-control" name="data_benar" value="<?php echo $data['data_benar'];?>">
	<div class="form-group">
	<label class="control-label">Penghasilan </label>
	<br>*) bagi pengajuan surat  Ijin mendirikan Bagunan
	<input type="text" class="form-control" name="penghasilan" value="<?php echo $data['penghasilan'];?>">
								</div>
								<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
								</div>
						
				</form>
<?php
	}
?>