<?php
  error_reporting(0);
  session_start();
  ob_start();

  include "../../config/database.php";
  // panggil fungsi untuk format tanggal
  include "../../config/fungsi_tanggal.php";
  include "../../config/function.php";

    $hari_ini = date("d-m-Y");
    $get_nik = $_GET['nik'];
    $get_id_datang = $_GET['datang'];
    $tgl_awal = $_GET['mulai'];
    $tgl_akhir = $_GET['sampai'];
    $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user where nama_user='kepala desa'"));
    $datang = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
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
LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat WHERE a.nik='$get_nik'AND a.id_datang='$get_id_datang' AND a.id_status_surat like'2'AND cast(a.tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'"));

   $identitas = mysqli_fetch_array(mysqli_query($mysqli,"select a.*,k.nik,b.nama_agama,c.nama_dukuh,c.rt,c.rw,d.nama_gender,e.nama_goldarah,f.nama_pekerjaan,g.nama_pendidikan,h.nama_statuskawin from m_penduduk a left join surat_pindah_datang k on a.nik=k.nik
LEFT JOIN m_agama b ON a.id_agama = b.id_agama 
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_gender d ON a.id_gender = d.id_gender 
LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan 
LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan 
LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin 
LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara 
LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk
where a.nik='$get_nik'")); 

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Surat Pindah Datang</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/laporan.css" />
    </head>
   <body>
        <div id="">
            <h4 align="center">SURAT KETERANGAN PINDAH DATANG</h4>
            <hr>
        </div>
        <div id="isi">
          <h4>DATA DAERAH ASAL</h4>
      <table align="left">
         <tr>
          <td>Nomor Kartu Keluarga</td><td>: <?php echo $datang['no_kk'];?></td>
        </tr>
        <tr>
          <td>NAMA KEPALA KELUARGA</td><td>: <?php echo $datang['nama_kepala_keluarga'];?></td>
        </tr>
        <tr>
        <td>Alamat</td>
      </tr>
         <tr>
          <td>Dukuh</td><td>: <?php echo $datang['dukuh_asal'];?></td>
          <td>RT</td><td>: <?php echo $datang['rt_asal'];?></td>/
          <td>RW</td><td>: <?php echo $datang['rw_asal'];?></td>
        </tr>
            <tr>
          <td>Desa/Kelurahan</td><td>: <?php echo $datang['nama_kelurahan'];?></td>
          <td>Kecamatan</td><td>: <?php echo $datang['nama_kecamatan'];?></td>
        </tr>
        <tr>
          <td>Kabupaten/Kota</td><td>:<?php echo $datang['nama_kabkota'];?></td>
          <td>Propinsi</td><td>: <?php echo $datang['nama_propinsi'];?></td>
        </tr> 
        <tr>
          <td>Kode Pos</td><td>: <?php echo $datang['kode_pos'];?></td>
          <td lang="right">Telpon</td><td lang="right">: <?php echo $datang['telpon'];?></td>
        </tr>       
      </table>
      <hr>
      <h4>DATA KEPINDAHAN</h4>
            <table>
          <tr>
            <td>1.</td>
            <td>Alasan Pindah</td><td>: <?php echo $datang['nama_alasan_pindah'];?></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Alamat Tujuan Pindah</td>
            </tr>
            <tr>
            <td></td>
            <td>Dukuh Tujuan</td><td>: <?php echo $datang['nama_dukuh'];?></td>
            <td>RT</td><td>: <?php echo $datang['rt'];?></td>/
            <td> RW</td><td>: <?php echo $datang['rw'];?></td>
          </tr>
          <tr>
            <td></td>
            <td>Desa/Kelurahan</td><td>: KRAGUMAN</td>
            <td>Kecamatan</td><td>: JOGONALAN</td>
            <td>Kode Pos</td><td>: 57452</td>
          </tr>
          <tr>
            <td></td>
             <td>Kabupaten</td><td>: KLATEN</td>
            <td>Propinsi</td><td>: JAWA TENGAH</td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Klasifikasi Pindah</td><td>: <?php echo $datang['nama_klasifikasi'];?></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Jenis Kepindahan</td><td>: <?php echo $datang['nama_jenis_pindh'];?></td>
          </tr>
          <tr>
            <td>5.</td>
            <td>Status No KK Bagi<br> Yang Tidak Pindah</td><td>: <?php echo $datang['nama_status_kk_pindh'];?></td>
          </tr>
          <tr>
            <td>6.</td>
            <td>Status No KK<br> Bagi Yang Pindah</td><td>: <?php echo $datang['nama_status_kk_tdkpindh'];?></td>
          </tr>
          <tr>
            <td>7.</td>
            <td>Rencana Tgl.Pindah</td><td>: <?php echo date('d-m-Y', strtotime ($datang['tgl_pindah']));?></td>
          </tr>
          
        </table>
        <hr>
          <h4>Warga Yang Datang</h4>
            <table>
          <tr>
            <td>1.</td>
            <td>NIK</td><td>: <?php echo $datang['nik'];?></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Nama</td><td>: <?php echo $datang['nama'];?></td>
          </tr>
        </table>
          <h4>Anggota Yang Ikut Pindah</h4>
          <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
        <thead style="background:#e8ecee">
        <tr>
          <th>No.</th>
          <th>NIK</th>
          <th>Nama</th>
        </tr>       
        </thead>
        <tbody>
          <?php
            echo "<tr>
                <td>1</td>
                <td width='200'>$datang[nik_kel2]</td>
                <td width='200'>$datang[nama_kel2]</td>             
            </tr>";
            echo "<tr>
                <td>2</td>
                <td width='200'>$datang[nik_kel3]</td>
                <td width='200'>$datang[nama_kel3]</td>              
            </tr>";   
            echo "<tr>
                <td>3</td>
                <td width='200'>$datang[nik_kel4]</td>
                <td width='200'>$datang[nama_kel4]</td>              
            </tr>";                
             echo "<tr>
                <td>4</td>
                <td width='200'>$datang[nik_kel5]</td>
                <td width='200'>$datang[nama_kel5]</td>              
            </tr>";                
             echo "<tr>
                <td>5</td>
                <td width='200'>$datang[nik_kel]</td>
                <td width='200'>$datang[gigi]</td>              
            </tr>";                   
          ?>
        </tbody>
        </table>
          <hr>
         </div>
         <br>
        <br>
      <table>
      <tr> 
      
      <td width="500">
        <p>Diketahui Oleh <br>Camat<br>

        Klaten, <?php echo date('d-M-Y', time()); ?></p><br><br><br>
         ---------------------</td>
    
        <td width="500">
                    <p>Diterima Oleh <br>
                        Kepala Desa
                       <br>Klaten, <?php echo date('d-M-Y', time()); ?> 
                  <br><br><br> <?php echo $user['nama'];?></p><br/></td>

            </tr>

        </table>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
    $filename="suratdatang.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
    //==========================================================================================================
    $content = ob_get_clean();
    $content = '<page style="font-family: freeserif">'.($content).'</page>';
    // panggil library html2pdf
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(15, 15, 15, 15));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    }
    catch(HTML2PDF_exception $e) { echo $e; }
?>


