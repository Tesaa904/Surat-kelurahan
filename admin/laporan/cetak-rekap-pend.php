<?php
error_reporting(0);
  session_start();
  ob_start();

include "../../config/database.php";
  // panggil fungsi untuk format tanggal
  include "../../config/fungsi_tanggal.php";
  include "../../config/function.php";

    $hari_ini = date("d-m-Y");
 

    $post_dukuh =$_GET['nama_dukuh'];
    $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user where nama_user='kepala desa'"));
    $pend =mysqli_query($mysqli,"SELECT a.*, b.nama_agama, c.nama_dukuh,c.rt,c.rw, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk FROM m_penduduk a LEFT JOIN m_agama b ON a.id_agama = b.id_agama LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh LEFT JOIN m_gender d ON a.id_gender = d.id_gender LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk WHERE STATUS='1' AND a.id_dukuh='$post_dukuh'ORDER BY CAST(id_penduduk AS SIGNED)");
   $dukuh= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_dukuh where id_dukuh='$post_dukuh'"));   
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>data penduduk</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
    <img align="left"style="width: 15%;" src="../../assets/images/LOGO_KLATEN.png">
    <h2 align="center">REKAP DATA PENDUDUK</h2>
            <span style='font-size: 10pt;'align="center"><br>KANTOR DESA : KRAGUMAN/  KECAMATAN: JOGONALAN/<br> KABUPATEN : KLATEN/ PROVINSI : JAWA TENGAH <br>Jl Klaten-Jogja,Km 06 Kraguman,Jogonalan,Klaten<br> Kode Pos: 57461. /Telp : 0895400196516</span>
            </div>
            <span align="center" style='font-size: 12pt;'><br></span>
            <hr><br>
          <div id="isi">
                <table>
                 <tr>
                  <td>Data Penduduk Dari Dukuh</td><td>: <?php echo $dukuh['nama_dukuh'];?> RT<?php echo $dukuh['rt'];?>/ RW<?php echo $dukuh['rw'];?></td><td>&nbsp;</td><td></td><td></td>
               </tr>
                </table>
                <hr>
                <br>
                <br>
           <table width="100%" border="0.4" cellpadding="0" cellspacing="0">
               <thead style="background:#e8ecee">
                <tr>
                    <th idth="100px" style="text-align:center;vertical-align:middle">No</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NO KK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NIK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">NAMA</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Tempat/TGL LAHIR </th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Jk</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Gol darah</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">Status KK</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">pekerjan</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">pendidikan</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">status</th>
                    <th idth="100px" style="text-align:center;vertical-align:middle">warganegara</th>
                  
                </tr>
                </thead>
                <tbody>
               <?php
               $num = mysqli_num_rows($pend); // Ambil jumlah data dari hasil eksekusi $sql
 
              if($num > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                while ($pend1=mysqli_fetch_array($pend))
                {
                $no++;
           echo "<tr>
                  <td>$no</td>
                  <td  width='100'>$pend1[no_kk]</td> 
                  <td  width='100'>$pend1[nik]</td>
                  <td  width='100'>$pend1[nama]</td>
                  <td  width='100'>$pend1[tmpt_lahir]/$pend1[tgl_lahir]</td>
                  <td  width='100'>$pend1[nama_gender]</td>
                  <td  width='50'>$pend1[nama_goldarah]</td>
                  <td  width='100'>$pend1[nama_shdk]</td>
                  <td  width='100'>$pend1[nama_pekerjaan]</td>
                  <td  width='100'>$pend1[nama_pendidikan]</td>
                  <td  width='50'>$pend1[nama_statuskawin]</td>
                  <td  width='50'>$pend1[nama_warganegara]</td>
                  
                        
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
        $html2pdf = new HTML2PDF('l','A4','en', false, 'ISO-8859-15',array(10, 15, 15, 15));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    }
    catch(HTML2PDF_exception $e) { echo $e; }
?>


