<?php 
  include "../../config/database.php";
  $get_mode = $_GET['mode'];
   if($get_mode="detail"){
		$get_id = $_GET['id'];
		$query = "SELECT a.*,b.nama,b.tmpt_lahir,b.tgl_lahir,e.nama_gender,c.nama_sebab_mati,d.nama_penerang,f.nama_dukuh,f.rt,f.rw
FROM surat_mati a LEFT JOIN m_penduduk b ON a.nik=b.nik
LEFT JOIN m_sebab_mati c ON a.id_sebab_mati=c.id_sebab_mati
LEFT JOIN m_penerang d ON a.id_penerang=d.id_penerang
LEFT JOIN m_dukuh f ON b.id_dukuh=f.id_dukuh
LEFT JOIN m_gender e ON b.id_gender=e.id_gender WHERE id_mati='$get_id'";

$hasil = mysqli_query($mysqli, $query);

$data = array();
		while ($row = mysqli_fetch_assoc($hasil)) {
  $data[] = $row;
}
?>

<div class="col-md-8"> 
<h3>A. Data Jenaza</h3>
<table class="table table-striped">
  <tr> 
      <div class="form-group">
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
    <th>NIK Jenaza</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nik'] ?></td>
  </tr>
  <tr>
    <th width="25%">Nama Jenaza</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nik'] ?></td>
  </tr>
  <tr>
    <th>Tempat Lahir</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['tmpt_lahir'] ?></td>
  </tr>
  <tr>
    <th>Tanggal Lahir dan Umur</th>
    <td>:</td>
    <td style="text-align:left">
      <?php echo date('d-m-Y', strtotime($data[0]['tgl_lahir']))?> Dan <?php echo $data[0]['umur_mati']?>
    </td>
  </tr>
  <tr>
    <th>Jenis Kelamin</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_gender'] ?></td>
  </tr>
  <tr>
    <th>Anak ke</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['anak_ke'] ?></td>
  </tr>
   <tr>
    <th>Tanggal Mati Dan Waktu Mati</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['tgl_mati'] ?>DAN <?php echo $data[0]['waktu_mati']?></td>
  </tr>
  <tr>
    <th>Sebab Kematian</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_sebab_mati']?></td>
  </tr>
   <tr>
    <th>Tempat Kematian Terjadi</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['tempat_mati']?></td>
  </tr>
   <tr>
    <th>Penerang pada Jenaza</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_penerang']?></td>
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
    <th>RT</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['rt'] ?></td>
  </tr>
  <tr>
    <th>RW</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['rw'] ?></td>
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
<a href="?modul=ketmati_view" class="btn btn-warning">Kembali</a>
<?php
}
?>