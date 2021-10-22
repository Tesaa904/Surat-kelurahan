<?php 
  include "../../config/database.php";
  $get_mode = $_GET['mode'];
   if($get_mode="detail"){
		$get_id = $_GET['id'];
		$query = "SELECT a.*,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh
                            FROM surat_lahir a LEFT JOIN m_gender b ON a.id_gender=b.id_gender
                            LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
                            LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
                            LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
                            LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh
                            WHERE id_lahir='$get_id'";

$hasil = mysqli_query($mysqli, $query);

$data = array();
		while ($row = mysqli_fetch_assoc($hasil)) {
  $data[] = $row;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="col-md-8">
				<h3>A. Data Bayi</h3>
				<table class="table table-striped">
				  <tr> 
					  <div class="form-group">
					<!--<th width="25%">NO Lahir</th>
					<td>:</td>
				   <!-- <td style="text-align:left"><?php echo $data[0]['no_lahir'] ?></td> -->
				  </tr>
				  <tr>
					<th width="25%">NIK Kepala keluarga</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_kepala_keluarga'] ?></td>
				  </tr>
				   <tr>
					<th width="25%">Nama</th>
					<td>:</td>
					<td style="text-align:left"><?php echo name_from_nik($data[0]['nik_kepala_keluarga']) ?></td>
				  </tr>
				  <tr>
					<th>Nama Bayi</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nama'] ?></td>
				  </tr>
				  <tr>
					<th>Tempat Lahir</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['tempat_lahir'] ?></td>
				  </tr>
				  <tr>
					<th>Hari,Tanggal Lahir</th>
					<td>:</td>
					<td style="text-align:left">
					  <?php echo $data[0]['hari'], date('d-m-Y', strtotime($data[0]['tgl_lahir']))?>
					</td>
				  </tr>
				  <tr>
					<th>Jenis Kelamin</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nama_gender'] ?></td>
				  </tr>
				  <tr>
					<th>Jenis Kelahiran</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nama_jenis_lahir'] ?></td>
				  </tr>
				  <tr>
					<th>Tempat Dilahirkan</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nama_tempat_lahir'] ?></td>
				  </tr>
					<tr>
					<th>Kelahiran Anak Ke</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['anak_ke'] ?></td>
				  </tr>
				   <tr>
					<th>Penolong Dalam Kelahiran</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nama_penolong'] ?></td>
				  </tr>
				  <tr>
					<th>Berat dan Panjang</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['berat']?> dan <?php echo $data[0]['panjang']?></td>
				  </tr>
				</div>
				</table>

				<h3>B. Data Orang Tua</h3>
				<table class="table table-striped">
				  <tr>
					  <div class="form-group">
					<th width="25%"> NIK Ayah</th>
					<td width="1%">:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_ayah'] ?></td>
				  </tr>
				   <tr>
					<th>Nama</th>
					<td>:</td>
					<td style="text-align:left"><?php echo name_from_nik($data[0]['nik_ayah']) ?></td>
				  </tr>
				   <tr>
					<th>NIK Ibu</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_ibu'] ?></td>
				  </tr>
				   <tr>
					<th>Nama</th>
					<td>:</td>
					<td style="text-align:left"><?php echo name_from_nik($data[0]['nik_ibu']) ?></td>
				  </tr>
				   <tr>
					<th>Tanggal Perkawinan</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['tgl_nikah'] ?></td>
				  </tr>
				</div>
				</table>

				<h3>C. Data Saksi Dan Pelapor</h3>
				<table class="table table-striped">
				  <tr>
					  <div class="form-group">
					<th width="25%">Pelapor</th>
					<td width="1%">:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_pelapor'] ?></td>
				  </tr>
					<tr>
					<th>Nama</th>
					<td>:</td>
					<td style="text-align:left"><?php echo name_from_nik($data[0]['nik_pelapor']) ?></td>
				  </tr>
				  <tr>
					<th> NIK Saksi 1</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_saksi1'] ?></td>
				  </tr>
				  <tr>
					<th>Nama</th>
					<td>:</td>
					<td style="text-align:left"><?php echo name_from_nik($data[0]['nik_saksi1']) ?></td>
				  </tr>
				  <tr>
					<th> NIK Saksi 2</th>
					<td>:</td>
					<td style="text-align:left"><?php echo $data[0]['nik_saksi2'] ?></td>
				  </tr>
				  <tr>
					<th>Nama</th>
					<td>:</td>
				   <td style="text-align:left"><?php echo name_from_nik($data[0]['nik_saksi2']) ?></td>
				  </tr>
				</div>
				</table>
				<h3>C. Data Daerah</h3>
				<table class="table table-striped">
				  <tr> 
					  <div class="form-group">
					<th width="25%">Dukuh</th>
					<td width="1%">:</td>
					<td style="text-align:left"><?php echo $data[0]['nama_dukuh'] ?></td>
				  </tr>
				  <tr>
					<th>Kelurahan</th>
					<td>:</td>
					<td style="text-align:left">KRAGUMAN</td>
				  </tr>
				  <tr>
					<th>Kecamatan</th>
					<td>:</td>
					<td style="text-align:left">JOGONALAN</td>
				  </tr>
				  <tr>
					<th>Kabupaten/Kota</th>
					<td>:</td>
					<td style="text-align:left">KLATEN</td>
				  </tr>
				  <tr>
					<th>Provinsi</th>
					<td>:</td>
					<td style="text-align:left">JAWA TENGAH</td>
				  </tr>
				</div>
				</table>
				</div>
				<a href="?modul=ketlahir_view" class="btn btn-warning">Kembali</a>			
			</div>
		</div>
	</div>
</div>	

<?php
}
?>