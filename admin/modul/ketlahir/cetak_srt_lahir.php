<?php
error_reporting(0);
  session_start();
  ob_start();

include "../../config/database.php";
  // panggil fungsi untuk format tanggal
  include "../../config/fungsi_tanggal.php";
  include "../../config/function.php";

    $hari_ini = date("d-m-Y");

    $get_id_lahir = $_GET['id_lahir'];
    $get_nik_ibu = $_GET['ibu'];
    $get_nik_ayah = $_GET['ayah'];
    $get_nik_pelapor = $_GET['pelapor'];
    $get_nik_saksi1 = $_GET['saksi1'];
    $get_nik_saksi2 = $_GET['saksi2'];
    $tgl_awal = $_GET['mulai'];
    $tgl_akhir = $_GET['sampai'];
   
     $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user where id_level='LV002'"));

	$ayah = mysqli_fetch_array(mysqli_query($mysqli,"select a.*,k.nik_ayah,b.nama_agama,c.nama_dukuh,c.rt,c.rw,d.nama_gender,e.nama_goldarah,f.nama_pekerjaan,g.nama_pendidikan,h.nama_statuskawin,i.nama_warganegara from m_penduduk a left join surat_lahir k on a.nik=k.nik_ayah
LEFT JOIN m_agama b ON a.id_agama = b.id_agama 
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_gender d ON a.id_gender = d.id_gender 
LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan 
LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan 
LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin 
LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara 
LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk where a.nik='$get_nik_ayah'")); 

$ibu = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,k.nik_ibu,b.nama_agama,c.nama_dukuh,c.rt,c.rw,d.nama_gender,i.nama_warganegara,e.nama_goldarah,f.nama_pekerjaan,g.nama_pendidikan,h.nama_statuskawin 
FROM m_penduduk a LEFT JOIN surat_lahir k ON a.nik=k.nik_ibu
LEFT JOIN m_agama b ON a.id_agama = b.id_agama 
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_gender d ON a.id_gender = d.id_gender 
LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan 
LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan 
LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin 
LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara 
LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk WHERE a.nik='$get_nik_ibu'")); 
	$bayi = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,h.nama,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh,g.nama_status_surat,g.warna FROM surat_lahir a 
		LEFT JOIN m_gender b ON a.id_gender=b.id_gender 
		LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
		LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
		LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
		LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh
		left join m_status_surat g on a.id_status_surat=g.id_status_surat
		LEFT JOIN m_penduduk h ON a.id_lahir=h.id_lahir WHERE a.id_status_surat='2'AND a.id_lahir='$get_id_lahir'AND CAST(a.tgl_surat AS DATE) BETWEEN '$tgl_awal'AND '$tgl_akhir'"));	

$pelapor = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,k.nik_pelapor,c.nama_dukuh,c.rt,c.rw,f.nama_pekerjaan FROM m_penduduk a LEFT JOIN surat_lahir k ON a.nik=k.nik_pelapor
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan where a.nik='$get_nik_pelapor'")); 
$saksi1 = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,k.nik_saksi1,c.nama_dukuh,c.rt,c.rw,f.nama_pekerjaan FROM m_penduduk a LEFT JOIN surat_lahir k ON a.nik=k.nik_saksi1
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan where a.nik='$get_nik_saksi1'")); 
$saksi2 = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*,k.nik_saksi2,c.nama_dukuh,c.rt,c.rw,f.nama_pekerjaan FROM m_penduduk a LEFT JOIN surat_lahir k ON a.nik=k.nik_saksi2
LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan where a.nik='$get_nik_saksi2'")); 
	

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Surat Lahir</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/laporan.css" />
    </head>
   <body>
        <div id="">
       <table>
				<tr>
					<td>Pemerintah Desa/Kelurahan</td><td> : Kraguman</td>
				</tr>
				<tr>
					<td>Kecamatan</td><td>: Jogonalan</td>			
				</tr>
				<tr>
					<td>Kabupaten/Kota</td><td>: Klaten</td>
				</tr>
				<tr>
					<td>Kode Wilayah</td><td>: 57452</td>
				</tr>							
			</table>
			<br>
		
            <h4 align="center">SURAT KETERANGAN KELAHIRAN
            	<br> NO: <?php echo $bayi['no_surat_lahir'];?></h4>

        </div>
        <div id="isi">
			<table align="center">
				<tr>
					<td>NAMA KEPALA KELUARGA</td><td>:<?php echo name_from_nik($bayi['nik_kepala_keluarga']);?></td>
				</tr>
				<tr>
					<td>Nomor Kartu Keluarga</td><td>:<?php echo $ayah['no_kk'];?></td>
				</tr>							
			</table>
			<hr>
			<h4>BAYI/ANAK</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>Nama</td><td>:<?php echo $bayi['nama'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Jenis Kelamin</td><td>:<?php echo $bayi['nama_gender'];?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat Dilahiran</td><td>:<?php echo $bayi['nama_tempat_lahir'];?></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Tempat Kelahiran</td><td>:<?php echo $bayi['tempat_lahir'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Hari Dan Tanggal lahir</td><td>:<?php echo $bayi['hari'];?> dan <?php echo date('d-m-Y',strtotime($bayi['tgl_lahir']));?> </td>
					</tr>
					<tr>
						<td>6.</td>
						<td>Pukul</td><td>:<?php echo $bayi['pukul'];?></td>
					</tr>
					<tr>
						<td>7.</td>
						<td>Jenis Kelahiran</td><td>:<?php echo $bayi['nama_jenis_lahir'];?></td>
					</tr>
					<tr>
						<td>8.</td>
						<td>Kelahiran Ke</td><td>:<?php echo $bayi['anak_ke'];?></td>
					</tr>
					<tr>
						<td>9.</td>
						<td>Penolong kelahiran</td><td>:<?php echo $bayi['nama_penolong'];?></td>
					</tr>
					<tr>
						<td>10.</td>
						<td>Berat Bayi</td><td>:<?php echo $bayi['berat'];?></td>
					</tr>
					<tr>
						<td>11.</td>
						<td>Panjang bayi</td><td>:<?php echo $bayi['panjang'];?></td>
					</tr>
				</table>
				<hr>
					<h4>IBU</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>NIK</td><td>:<?php echo $ibu['nik_ibu'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Nama</td><td>:<?php echo name_from_nik($ibu['nik_ibu']);?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat/Tanggal Lahir</td><td>:<?php echo $ibu['tmpt_lahir'];?>/<?php echo date('d-m-Y',strtotime($ibu['tgl_lahir']));?></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Pekerjaan</td><td>:<?php echo $ibu['nama_pekerjaan'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Alamat</td><td>:<?php echo $ibu['nama_dukuh'];?> dan RT <?php echo $ibu['rt'];?>/ RW <?php echo $ibu['rw'];?> </td>
					</tr>
					<tr>
						<td>6.</td>
						<td>Kewarganegaraan</td><td>:<?php echo $ibu['nama_warganegara'];?></td>
					</tr>
					<tr>
						<td>7.</td>
						<td>Kebangsaan</td><td>:INDONESIA</td>
					</tr>
					<tr>
						<td>8.</td>
						<td>Tgl.Pencatatan Perkawinan</td><td>:<?php echo date('d-m-Y',strtotime($bayi['tgl_nikah']));?></td>
					</tr>
					
				</table>
				<hr>
					<h4>AYAH</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>NIK</td><td>:<?php echo $ayah['nik_ayah'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Nama</td><td>:<?php echo name_from_nik($ayah['nik_ayah']);?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat/Tanggal Lahir</td><td>:<?php echo $ayah['tmpt_lahir'];?>/<?php echo date('d-m-Y',strtotime($ayah['tgl_lahir']));?></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Pekerjaan</td><td>:<?php echo $ayah['nama_pekerjaan'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Alamat</td><td>:<?php echo $ayah['nama_dukuh'];?> dan <?php echo $ayah['rt'];?>/ RW <?php echo $ayah['rw'];?> </td>
					</tr>
					<tr>
						<td>6.</td>
						<td>Kewarganegaraan</td><td>:<?php echo $ayah['nama_warganegara'];?></td>
					</tr>
					<tr>
						<td>7.</td>
						<td>Kebangsaan</td><td>:INDONESIA</td>
					</tr>
					</table>
						<hr>
					<h4>PELAPOR</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>NIK</td><td>:<?php echo $pelapor['nik_pelapor'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Nama</td><td>:<?php echo name_from_nik($pelapor['nik_pelapor']);?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat/Tanggal Lahir</td><td>:<?php echo $pelapor['tmpt_lahir'];?>/<?php echo date('d-m-Y',strtotime($pelapor['tgl_lahir']));?></td>
					</tr>
					
					<tr>
						<td>4.</td>
						<td>Pekerjaan</td><td>:<?php echo $pelapor['nama_pekerjaan'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Alamat</td><td>:<?php echo $pelapor['nama_dukuh'];?> dan <?php echo $pelapor['rt'];?>/ RW <?php echo $pelapor['rw'];?> </td>
					</tr>
					</table>
					<hr>
					<h4>SAKSI 1</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>NIK</td><td>:<?php echo $saksi1['nik_saksi1'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Nama</td><td>:<?php echo name_from_nik($saksi1['nik_saksi1']);?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat lahir/Tanggal Lahir</td><td>:<?php echo $saksi1['tmpt_lahir'];?>/<?php echo date('d-m-Y',strtotime( $saksi1['tgl_lahir']));?></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Pekerjaan</td><td>:<?php echo $saksi1['nama_pekerjaan'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Alamat</td><td>:<?php echo $saksi1['nama_dukuh'];?> dan RT <?php echo $saksi1['rt'];?>/ RW <?php echo $saksi1['rw'];?> </td>
					</tr>
					</table>
					<hr>
					<h4>SAKSI II</h4>
            <table>
					<tr>
						<td>1.</td>
						<td>NIK</td><td>:<?php echo $saksi2['nik_saksi2'];?></td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Nama</td><td>:<?php echo name_from_nik($saksi2['nik_saksi2']);?></td>
					</tr>
					<tr>
						<td>3.</td>
						<td>Tempat/Tanggal Lahir</td><td>:<?php echo $saksi2['tmpt_lahir'];?>/<?php echo date('d-m-Y',strtotime($saksi2['tgl_lahir']));?></td>
					</tr>
					<tr>
						<td>4.</td>
						<td>Pekerjaan</td><td>:<?php echo $saksi2['nama_pekerjaan'];?></td>
					</tr>
					<tr>
						<td>5.</td>
						<td>Alamat</td><td>:<?php echo $saksi2['nama_dukuh'];?> dan RT <?php echo $saksi2['rt'];?>/ RW <?php echo $saksi2['rw'];?> </td>
					</tr>
					</table>
					<hr>
               
            </div>
            	<br>
				<br>
			<table>
			<tr> 
			
			<td width="500">
                        <br>
				Mengetahui, <br>Kepala Desa/Lurah<br><br><br><br>

				<br><?php echo $user['nama']; ?></td>
		
 				<td width="500">
                    <p>Klaten, <?php echo date('d-M-Y', time()); ?><br>
                        Pelapor </p>

                       <br>
                   -------------------------<br/></td>

            </tr>

        </table>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
    $filename="suratlahir.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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
