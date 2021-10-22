<?php
error_reporting(0);
  session_start();
  ob_start();

include "../../config/database.php";
  // panggil fungsi untuk format tanggal
  include "../../config/fungsi_tanggal.php";
  include "../../config/function.php";

    $hari_ini = date("d-m-Y");
 

    $tgl_awal = $_GET['mulai'];
    $tgl_akhir = $_GET['sampai'];
    $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user where nama_user='kepala desa'"));
    $datang =mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
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
                        
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Rekap Pindah Datang</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
    <img align="left"style="width: 15%;" src="../../assets/images/LOGO_KLATEN.png">
    <h2 align="center">REKAP WARGA PINDAH DATANG</h2>
            <span style='font-size: 10pt;'align="center"><br>KANTOR DESA : KRAGUMAN/  KECAMATAN: JOGONALAN/<br> KABUPATEN : KLATEN/ PROVINSI : JAWA TENGAH <br>Jl Klaten-Jogja,Km 06 Kraguman,Jogonalan,Klaten<br> Kode Pos: 57461. /Telp : 0895400196516</span>
            </div>
            <span align="center" style='font-size: 12pt;'><br></span>
            <hr><br>
          <div id="isi">
            <table>
                 <tr>
                  <td>Tanggal Penggajuan surat</td><td>: <?php echo date('d-m-Y', strtotime($tgl_awal ));?> sampai ke<?php echo date('d-m-Y', strtotime($tgl_akhir ));?></td><td>&nbsp;</td><td></td><td></td>
                </tr>
                </table>
                <hr>
                <br>
                <br>
           <table width="100%" border="0.4" cellpadding="0" cellspacing="0">
               <thead style="background:#e8ecee">
                <tr>
                    <th idth="100px" style="text-align:center;vertical-align:middle">No</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NIK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NAMA</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NO KK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">ASAL ALAMAT</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">ALAMAT BARU</th>
                    
                </tr>
                </thead>
                <tbody>
               <?php
               $num = mysqli_num_rows($datang); // Ambil jumlah data dari hasil eksekusi $sql
 
              if($num > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                while ($datang1=mysqli_fetch_array($datang))
                {
                $no++;
           echo "<tr>
                  <td>$no</td>
                  <td>$datang1[nik]</td> 
                  <td width='100'>$datang1[nama]</td>
                  <td width='100'>$datang1[no_kk]</td>
                  <td width='200' align='justify'>$datang1[dukuh_asal], RT:$datang1[rt_asal]/ RW:$datang1[rw_asal], $datang1[nama_kelurahan],<br>$datang1[nama_kecamatan],$datang1[nama_kabkota], $datang1[nama_propinsi] </td>
                  <td width='200' align='justify'>$datang1[nama_dukuh], RT:$datang1[rt]/ RW:$datang1[rw]</td>      
              </tr>"; 
              } 
              }else{ // Jika data tidak ada
             echo "<tr><td colspan='4'>Data tidak ada</td></tr>"; 
            }
            ?> 
            </tbody>
            </table>
            <nobreak><br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:65%;"></td>
              <td style="width:35%; ">
                    <p>Klaten,<?php echo date('d-M-Y', time()); ?> <br>
                        Kepala Desa </p>
                        <br>
                        <br>
                        <?php echo $user['nama']; ?><br />
                        <hr/>
                     <?php echo $user['nip']; ?>              </td>
            </tr>
        </table>
    </nobreak>
    </div>
          
 </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
    $filename="Rekapdatang.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
    //==========================================================================================================
    $content = ob_get_clean();
    $content = '<page style="font-family: freeserif">'.($content).'</page>';
    // panggil library html2pdf
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 15, 15, 15));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    }
    catch(HTML2PDF_exception $e) { echo $e; }
?>


