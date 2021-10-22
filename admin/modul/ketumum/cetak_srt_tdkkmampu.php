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
    $get_nik = $_GET['nik'];
    $post_surat = $_GET['nama_jenis'];
    $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user where id_level='LV001'"));
    $identitas = mysqli_fetch_array(mysqli_query($mysqli,"SELECT m_penduduk.*,m_pekerjaan.nama_pekerjaan FROM m_penduduk LEFT JOIN m_pekerjaan ON m_penduduk.id_pekerjaan=m_pekerjaan.id_pekerjaan LEFT JOIN surat_ket_umum ON m_penduduk.nik=surat_ket_umum.nik where m_penduduk.nik='$get_nik'"));
    $umum =mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_dukuh,c.rt,c.rw,d.nama_jenis_surat,e.email,d.keterangan FROM surat_ket_umum a LEFT JOIN m_penduduk b ON a.nik=b.nik LEFT JOIN m_jenis_surat d ON a.id_jenis_surat=d.id_jenis_surat LEFT JOIN m_dukuh c ON b.id_dukuh=c.id_dukuh LEFT JOIN m_akun_penduduk e ON a.id_akun =e.id_akun WHERE a.id_status_surat='2' AND a.id_jenis_surat='$post_surat' AND a.nik='$get_nik' AND CAST(a.tgl_surat AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
    $ayah = mysqli_fetch_array(mysqli_query($mysqli,"SELECT m_penduduk.*,m_pekerjaan.nama_pekerjaan,surat_ket_umum.nik_ayah FROM m_penduduk LEFT JOIN m_pekerjaan ON m_penduduk.id_pekerjaan=m_pekerjaan.id_pekerjaan LEFT JOIN surat_ket_umum ON m_penduduk.nik=surat_ket_umum.nik_ayah WHERE surat_ket_umum.id_status_surat='2' AND surat_ket_umum.id_jenis_surat='$post_surat'AND CAST(surat_ket_umum.tgl_surat AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
     $ibu = mysqli_fetch_array(mysqli_query($mysqli,"SELECT m_penduduk.*,m_pekerjaan.nama_pekerjaan,surat_ket_umum.nik_ibu FROM m_penduduk LEFT JOIN m_pekerjaan ON m_penduduk.id_pekerjaan=m_pekerjaan.id_pekerjaan LEFT JOIN surat_ket_umum ON m_penduduk.nik=surat_ket_umum.nik_ibu WHERE surat_ket_umum.id_status_surat='2' AND surat_ket_umum.id_jenis_surat='$post_surat'AND CAST(surat_ket_umum.tgl_surat AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
                        
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Rekap Pengajuan Surat Umum</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
       <img align="left"style="width: 13%;" src="../../assets/images/LOGO_KLATEN.png">
            <span style='font-size: 10pt;'align="center"><br>KANTOR DESA : KRAGUMAN/  KECAMATAN: JOGONALAN/<br> KABUPATEN : KLATEN/ PROVINSI : JAWA TENGAH <br>Jl Klaten-Jogja,Km 06 Kraguman,Jogonalan,Klaten<br> Kode Pos: 57461. /Telp : 0895400196516</span>
            </div>
            <span align="center" style='font-size: 12pt;'><br></span>
            <hr>
          <div id="isi">
            <table  align="center"> 
                 <tr>
                  <td><h4>SURAT KETERANGAN TIDAK MAMPU</h4></td>
                </tr>
                <tr>
                  <td align="center"> Nomer :<?php echo $umum['no_surat_skt'];?></td>
                </tr>
                </table>
                <hr>

           <table>
               <tr>
                 <td>Yang Bertanda Tangan dibawah ini:</td>
               </tr>
               <tr>
                   <td>Nama</td><td>: <?php echo $user['nama']; ?></td>
                 </tr>
                 <tr>
                   <td>Jabatan</td><td>: KEPALA DESA</td>
               </tr>
               <br>
               <br>
               <tr>
                 <td>Menerangkan bahwa :</td>
               </tr>
               <br>
             </table>
             <br>
             <br>
             <table>
                <tr>
                  <td>NIK </td><td></td><td>: <?php echo $umum['nik']; ?></td>
                </tr>
                <tr>
                  <td>Nama </td><td></td><td>: <?php echo $umum['nama']; ?></td>
                </tr>
                <tr>
                  <td>Tempat Lahir </td><td></td><td>: <?php echo $identitas['tmpt_lahir']; ?></td>
                 </tr>
                 <tr>
                  <td>Tanggal Lahir</td><td></td><td>: <?php echo $identitas['tgl_lahir']; ?></td>
                </tr>
                <tr>
                  <td>Pekerjaan</td><td></td><td>: <?php echo $identitas['nama_pekerjaan']; ?></td>
                </tr>
              </table>
                <table>
                <tr>
                  <br>
                  <td>
                    Adalah benar-benar anak dari orang tua:
                  </td>
                </tr>
              </table>
              <table>
                <tr>
                  <td>Nik Bapak</td><td>: <?php echo $ayah['nik_ayah'];      ?></td>
                </tr>
                <tr>
                  <td>Nama Bapak</td><td>: <?php echo $ayah['nik_ayah'];      ?></td>
                </tr>
                 <tr>
                  <td>Pekerjaan</td><td>: <?php echo $ayah['nama_pekerjaan'];      ?></td>
                </tr>
                <tr>
                  <td>Nik Ibu</td><td>: <?php echo $ibu['nik_ibu'];      ?></td>
                </tr>
                <tr>
                  <td>Nama Ibu</td><td>: <?php echo name_from_nik($ibu['nik_ayah']);      ?></td>
                </tr>
                 <tr>
                  <td>Pekerjaan</td><td>: <?php echo $ibu['nama_pekerjaan'];      ?></td>
                </tr>
                 <tr>
                  <td>Penghasilan</td><td>: <?php echo $umum['penghasilan']; ?></td>
                </tr>
                <tr>
                  <td>Keperluan</td><td>: <?php echo $umum['keperluan']; ?></td>
                </tr>
            </table>
            <br>
            <br>
            <table style="text-align: left;">
              <tr>
                <td>
                <p style="text-align: justify;">Menerangkan bahwa orang tersebut diatas adalah benar-benar warga desa kami dan <?php echo $umum['keterangan'];?>.<br> Demikian surat keterangan ini kami buat sebagaimana perlunya semoga dapat digunakan semestinya. Dan kepada yang berkepentingan agar menjadi maklum</p>
              </td>
              </tr>
            </table>
            <br>
            <nobreak>
              <br>
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
    $filename="surat_ket_tidakmampu.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
    //==========================================================================================================
    $content = ob_get_clean();
    $content = '<page style="font-family: freeserif">'.($content).'</page>';
    // panggil library html2pdf
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(20, 15, 15, 15));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    }
    catch(HTML2PDF_exception $e) { echo $e; }
?>


