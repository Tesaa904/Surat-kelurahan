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
                <th>Nama Bayi</th>
                <th>Tempat,tanggal Lahir</th>
               
               
              </tr>
            </thead>
            <tbody>
              <?php               
                $no=0;
                $sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh,h.no_KK,
                            g.nama_status_surat,g.warna
                            FROM surat_lahir a LEFT JOIN m_gender b ON a.id_gender=b.id_gender
                            LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
                            LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
                            LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
                            LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh
                            LEFT JOIN m_penduduk h ON a.nik_kepala_keluarga=h.nik
                            left join m_status_surat g on a.id_status_surat=g.id_status_surat 
                            WHERE a.id_status_surat like'%2%' AND cast(a.tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                while ($data = mysqli_fetch_array($sql_data)){
                  $no++;
                  echo "
                  <tr>
                    <td>$no</td>
                    <td>$data[no_KK]</td>
                    <td>".name_from_nik($data['nik_kepala_keluarga'])."</td>
                    <td>$data[nama]</td>
                    <td>$data[tempat_lahir], $data[tgl_lahir]</td>
                    
                  </tr>
                  ";
                }
              ?>
            </tbody>
          </table>
           <div class="text-right">
            <a href="modul/laporan/cetak-srt-lahir.php?mulai=<?php echo $tgl_awal;?>&sampai=<?php echo $tgl_akhir;?>"target='-new' class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i>Cetak</a>  
         
                                    </div>
          </td>
                      
        </div>
      </div>
    </div>
  </div>
</div>
