<?php
  include "../../config/database.php";
  $get_mode = $_GET['mode'];
   if($get_mode="detail"){
		$get_id = $_GET['id'];
		$query = "SELECT a.*, b.nama_agama, c.nama_dukuh, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk, c.nama_dukuh, c.rt, c.rw FROM m_penduduk a LEFT JOIN m_agama b ON a.id_agama = b.id_agama LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh LEFT JOIN m_gender d ON a.id_gender = d.id_gender LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk  WHERE id_penduduk = $get_id order by cast(id_penduduk as signed)";

$hasil = mysqli_query($mysqli, $query);

$data = array();
		while ($row = mysqli_fetch_assoc($hasil)) {
  $data[] = $row;
}
?>

  <div class="col-md-8">
<h3>A. Data Pribadi</h3>
<table class="table table-striped">
  <tr>
    <div class="col-md-6"> 
      <div class="form-group">
    <th width="12%">NIK</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nik'] ?></td>
  </tr>
  <tr>
    <th>Nama Warga</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama'] ?></td>
  </tr>
  <tr>
    <th>Tempat Lahir</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['tmpt_lahir'] ?></td>
  </tr>
  <tr>
    <th>Tanggal Lahir</th>
    <td>:</td>
    <td style="text-align:left">
      <?php echo  date('d-m-Y', strtotime($data[0]['tgl_lahir']))?>
    </td>
  </tr>
  <tr>
    <th>Jenis Kelamin</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_gender'] ?></td>
  </tr>
</div>
</div>
</table>

<h3>B. Alamat</h3>
<table class="table table-striped">
  <tr>
    <div class="col-md-6"> 
      <div class="form-group">
    <th width="20%">Dukuh</th>
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
  <tr>
    <th>Negara</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_warganegara'] ?></td>
  </tr>
</div>
</div>
</table>

<h3>C. Data Lain-lain</h3>
<table class="table table-striped">
  <tr>
    <div class="col-md-6"> 
      <div class="form-group">
    <th width="20%">Agama</th>
    <td width="1%">:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_agama'] ?></td>
  </tr>
   <tr>
    <th>Golongan Darah</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_goldarah'] ?></td>
  </tr>
  <tr>
    <th>NO KK</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['no_kk'] ?></td>
  </tr>
  <tr>
    <th>Pendidikan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_pendidikan'] ?></td>
  </tr>
  <tr>
    <th>Pekerjaan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_pekerjaan'] ?></td>
  </tr>
  <tr>
    <th>Status Perkawinan</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_statuskawin'] ?></td>
  </tr>
  <tr>
    <th>Status KK</th>
    <td>:</td>
    <td style="text-align:left"><?php echo $data[0]['nama_shdk'] ?></td>
  </tr>
</div>
</div>
</td>
</table>
</div>

<a href="javascript:history.back()"class="btn btn-warning">Kembali</a>

<?php
}
?>