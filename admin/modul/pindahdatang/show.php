<?php 
  include "../../config/database.php";
  $get_mode = $_GET['mode'];
   if($get_mode="detail"){
		$get_id = $_GET['id'];
		$query = "SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
h.nama_propinsi,i.nama_klasifikasi,j.nama_jenis_pindh,k.nama_status_kk_pindh,l.nama_status_kk_tdkpindh
FROM surat_pindah_datang a LEFT JOIN m_alasan_pindah b ON a.id_alasan_pindah=b.id_alasan_pindah
LEFT JOIN m_klasifikasi_pindh i ON a.id_klasifikasi_pindah=i.id_klasifikasi
LEFT JOIN m_jenis_pindh j ON a.id_jenis_pindh=j.id_jenis_pindh
LEFT JOIN m_status_kk_pindh k ON a.id_status_kk_pindh=k.id_status_kk_pindh
LEFT JOIN m_status_kk_tdkpindh l ON a.id_status_kk_tdkpindh=l.id_status_kk_tdkpindh
LEFT JOIN m_dukuh c ON a.id_dukuh=c.id_dukuh
LEFT JOIN wil_kelurahan d ON a.id_kelurahan_asal=d.id_kelurahan
LEFT JOIN wil_kecamatan e ON a.id_kecamatan_asal=e.id_kecamatan
LEFT JOIN wil_kabkota f ON a.id_kabkota_asal=f.id_kabkota
LEFT JOIN wil_propinsi h ON a.id_propinsi_asal=h.id_propinsi WHERE id_datang='$get_id'";

$hasil = mysqli_query($mysqli, $query);

$data = array();
		while ($row = mysqli_fetch_assoc($hasil)) {
  $data[] = $row;
}
?>

<div class="col-md-8">
<h3>A. Data KK</h3>
<table class="table table-striped">
  <tr>
    <div class="form-group">
    <th width="25%">Nik Kepala Keluarga</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['no_kk'] ?></td>
  </tr>
   <tr>
    <th width="25%">Nama</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kepala_keluarga'] ?></td>
  </tr>
  <tr>
    <th>Nama Propinsi</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_propinsi'] ?></td>
  </tr>
   <tr>
    <th width="25%">Nama Kabupaten</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kabkota'] ?></td>
  </tr>
   <tr>
    <th width="25%">Nama Kecamatan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kecamatan'] ?></td>
  </tr>
   <tr>
    <th width="25%">Nama Kelurahan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kelurahan'] ?></td>
  </tr>
   <tr>
    <th width="25%">Nama Dukuh</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['dukuh_asal'] ?></td>
  </tr>
  <tr>
    <th width="25%">RT/ RW</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['rt_asal'] ?>/ <?php echo $data[0]['rw_asal'] ?></td>
  </tr>
</div>
</table>

<h3>B. Data Kepindahan</h3>
<table class="table table-striped">
  <tr>
      <div class="form-group">
    <th width="25%"> Alasan Pindah</th>
    <td width="1%">:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_alasan_pindah'] ?></td>
  </tr>
   <tr>
    <th>Klasifikasi</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_klasifikasi'] ?></td>
  </tr>
   <tr>
    <th>Jenis Kepindahan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_jenis_pindh'] ?></td>
  </tr>
   <tr>
    <th>Tanggal Rencana Pindah</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['tgl_rencana_pindah'] ?></td>
  </tr>
   <tr>
    <th>Status KK yang Tidak Pindah</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_status_kk_tdkpindh'] ?></td>
  </tr>
   <tr>
    <th>Status KK yang Pindah</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_status_kk_pindh'] ?></td>
  </tr>
</div>
</table>
  <h4>Daerah Yang Dituju</h4>
  <table class="table table-striped">
  <tr>
  <div class="form-group">
    <th width="25%"> Dukuh</th>
    <td width="1%">:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_dukuh']?></td>
  </tr>
   <tr>
    <th> RT </th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['rt']?></td>
  </tr>
  <tr>
    <th>RW</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['rw']?></td>
  </tr>
   <tr>
    <th>Kelurahan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kelurahan'] ?></td>
  </tr>
   <tr>
    <th>Kecamatan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kecamatan'] ?></td>
  </tr>
  <tr>
    <th>Kabupaten</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_kabkota'] ?></td>
  </tr>
</div>
</table>

<h3>C. Data Anggota Yang Ikut Pindah</h3>
<table class="table table-striped">
  <tr>
      <div class="form-group">
    <th width="25%">Anggota</th>
    <td width="1%">:</td>
    <td style="text-align:left"><?php echo name_from_nik($data[0]['nik_kel1']) ?></td>
  </tr>
  <tr>
    <td><?php echo name_from_nik($data[0]['nik_kel2']) ?></td>
  </tr>
    <tr>
    <td style="text-align:left"><?php echo name_from_nik($data[0]['nik_kel3']) ?></td>
  </tr>
  <tr>
    <td><?php echo name_from_nik($data[0]['nik_kel4']) ?></td>
  </tr>
  <tr>
    <td style="text-align:left"><?php echo name_from_nik($data[0]['nik_kel5']) ?></td>
  </tr>
</div>
</tr>
</table>
<h3>D. Data Daerah</h3>
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

<a href="?modul=pindahkeluar_view" class="btn btn-warning">Kembali</a>

<?php
}
?>