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
    $mati =mysqli_query($mysqli,"SELECT a.*,b.no_kk,b.nama,b.no_kk,c.nama_sebab_mati,d.nama_penerang,f.nama_dukuh,f.rt,f.rw,g.id_status_surat
            FROM surat_mati a LEFT JOIN m_penduduk b ON a.nik=b.nik
            LEFT JOIN m_sebab_mati c ON a.id_sebab_mati=c.id_sebab_mati
            LEFT JOIN m_penerang d ON a.id_penerang=d.id_penerang
            LEFT JOIN m_dukuh f ON b.id_dukuh=f.id_dukuh
            LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat WHERE a.id_status_surat like'2' AND cast(a.tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                        
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Rekap Surat Mati</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
    <img align="left"style="width: 15%;" src="../../assets/images/LOGO_KLATEN.png">
    <h2 align="center">REKAP KEMATIAN PENDUDUK</h2>
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
                    <th idth="100px" style="text-align:center;vertical-align:middle">KEPALA KELUARGA</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NO KK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NAMA JENAZA</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">TANGGAL KEMATIAN</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">WAKTU KEMATIAN</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">ALAMAT</th>
                    
                </tr>
                </thead>
                <tbody>
               <?php
               $num = mysqli_num_rows($mati); // Ambil jumlah data dari hasil eksekusi $sql
 
              if($num > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                while ($mati1=mysqli_fetch_array($mati))
                {
                $no++;
           echo "<tr>
                  <td>$no</td>
                  <td width='100'>".name_from_nik($mati1['nik_kepala_keluarga'])."</td> 
                  <td width='100'>$mati1[no_kk]</td>
                  <td width='100'>$mati1[nama]</td>
                  <td width='100'>$mati1[tgl_mati]</td>
                  <td width='50'>$mati1[waktu_mati]</td>
                  <td width='100' align='justify'>$mati1[nama_dukuh], RT:$mati1[rt]/ RW:$mati1[rw]</td>      
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
                        <img style="width:30%;" src="../../assets/images/cap.png"/>
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


