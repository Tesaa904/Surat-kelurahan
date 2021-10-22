<?php
  if (isset($_POST['cari'])){
    $tgl_awal = $_POST['tgl_awal'];
    $tgl_akhir = $_POST['tgl_akhir'];   
  } else {
    $tgl_awal = date('Y-m-d');
    $tgl_akhir = date('Y-m-d');
  }
?>
<div class="row">
  <div class="col-md-12">
    <div class="text-right mb-3">
     
    </div>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="">
          <table>
            <tr>
              <td>Tahun Surat</td>
              <td>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="tgl_awal" value="<?php echo $tgl_awal;?>">
                  <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </td>
              <td>s.d.</td>
              <td>
                <div class="input-group">
                  <input type="text" class="datepicker form-control" name="tgl_akhir" value="<?php echo $tgl_akhir;?>">
                  <div class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </td>
              <td>
                <button type="submit" name="cari" class="btn btn-danger"><i class="fa fa-search"></i> Cari Data</button>
              </td>             
            </tr>
          </table>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>No KK</th>
                <th>Kepala Keluarga</th>
                <th>tanggal Datang</th>
                <th>Nama anggota</th>
               
              </tr>
            </thead>
            <tbody>
              <?php               
                $no=0;
                $sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
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
LEFT JOIN wil_propinsi h ON a.id_propinsi_asal=h.id_propinsi
LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat
WHERE a.id_status_surat like'%2%' AND CAST(a.tgl_surat_datang AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                while ($data = mysqli_fetch_array($sql_data)){
                  $no++;
                  echo "
                  <tr>
                    <td>$no</td>
                    <td>$data[no_KK]</td>
                    <td>$data[nama_kepala_keluarga]</td>
                    <td>$data[tgl_datang]</td>
                    <td>$data[nik_kel1], $data[nik_kel2]</td>
                   
                  </tr>
                  ";
                }
              ?>

            </tbody>
             </table>
          </td>
           <div class="text-right">
            <a href="modul/laporan/cetak-srt-pindahdatang.php?mulai=<?php echo $tgl_awal;?>&sampai=<?php echo $tgl_akhir;?>" target="-new" class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i>Cetak</a>    
        </div>
      </div>
    </div>
  </div> 
</div>