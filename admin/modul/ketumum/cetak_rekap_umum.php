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
    $umum =mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_dukuh,c.rt,c.rw,d.nama_jenis_surat,e.email
FROM surat_ket_umum a LEFT JOIN m_penduduk b ON a.nik=b.nik
LEFT JOIN m_jenis_surat d ON a.id_jenis_surat=d.id_jenis_surat
LEFT JOIN m_dukuh c ON b.id_dukuh=c.id_dukuh
LEFT JOIN m_akun_penduduk e ON a.id_akun=e.id_akun
WHERE id_status_surat='2' AND CAST(a.tgl_surat AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                        
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Rekap Pengajuan Surat Umum</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
    <img align="left"style="width: 15%;" src="../../assets/images/LOGO_KLATEN.png">
    <h2 align="center">REKAP Pengajuan Surat Umum</h2>
            <span style='font-size: 10pt;'align="center"><br>KANTOR DESA : KRAGUMAN/  KECAMATAN: JOGONALAN/<br> KABUPATEN : KLATEN/ PROVINSI : JAWA TENGAH <br>Jl Klaten-Jogja,Km 06 Kraguman,Jogonalan,Klaten<br> Kode Pos: 57461. /Telp : 0895400196516</span>
            </div>
            <span align="center" style='font-size: 12pt;'><br></span>
            <hr><br>
          <div id="isi">
            <table>
                 <tr>
                  <td>Tanggal</td><td>:<?php echo $tgl_awal['mulai'];?> sampai ke <?php echo $tgl_akhir['sampai'];?></td><td>&nbsp;</td><td></td><td></td>
                </tr>
                </table>
                <hr>
                <br>
                <br>
           <table width="100%" border="0.4" cellpadding="0" cellspacing="0">
               <thead style="background:#e8ecee">
                <tr>
                    <th idth="100px" style="text-align:center;vertical-align:middle">No</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Email</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NIK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Nama</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Jenis Surat</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">ALAMAT</th>
                    
                    
                </tr>
                </thead>
                <tbody>
               <?php
               $num = mysqli_num_rows($umum); // Ambil jumlah data dari hasil eksekusi $sql
 
              if($num > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                while ($umum1=mysqli_fetch_array($umum))
                {
                $no++;
           echo "<tr>
                  <td>$no</td>
                  <td width='100'>$umum1[email]</td>
                  <td>$umum1[nik]</td> 
                  <td width='100'>$umum1[nama]</td>
                 <td width='100'>$umum1[nama_jenis_surat]</td>
                  <td width='200' align='justify'>$umum1[nama_dukuh], RT:$umum1[rt]/ RW:$umum1[rw]</td>      
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


