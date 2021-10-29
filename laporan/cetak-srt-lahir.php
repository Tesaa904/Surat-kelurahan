<?php
    error_reporting(0);
    session_start();
    ob_start();
 
    // Panggil koneksi database.php untuk koneksi database
    include "../layout/koneksi.php";
    // panggil fungsi untuk format tanggal
    include "../fungsi/fungsi_tanggal.php";
?>
<!DOCTYPE html>
<html lang="en">
<title>Cetak Surat</title>
<?php
   include'layout/header.php';
   ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<body onload="window.print();">

<?php
    $hari_ini   = date("d-m-Y");

    $no    = 0;
    $datang = mysqli_fetch_array(mysqli_query($conn,"SELECT a.id_datang,a.nik, b.no_kk,b.nama,b.tmpt_lahir,b.hari,b.tgl_lahir,b.gender,a.tgl_pindah,a.alasan_datang,a.desa_asal,a.kelurhn_asal,a.tgl_datang,a.rt_asal,a.rw_asal,a.kode_pos,a.kecmtn_asal,a.kabtn_asal,a.tgl_srtdtg,a.prov_asal,c.nm_desa FROM srt_pindah_datang a INNER JOIN penduduk b ON a.id_datang=b.id_datang INNER JOIN desa c ON c.id_desa=a.id_desa"));
                        
?>

        <div id="">
            <h3 align="center">SURAT KETERANGAN PINDAH DATANG WNI</h3>
        </div>
        <hr>
        <h4 align="left">DATA DAERAH ASAL</h4>
        <div id="isi">
            <table>
                <tr>
                    <td>Nomor Kartu Keluarga</td><td>   :   <?php echo $datang['no_kk'];?></td><td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Nama Kepala Keluarga</td><td>   :   <?php echo $datang['nama'];?></td><td>&nbsp;</td>   
                </tr>
                <tr>
                    <td>Alamat</td><td> :   <?php echo $datang['nm_desa'];?>&nbsp;</td><td>RT: <?php echo $datang['rt_asal']?>&nbsp;/&nbsp;RW: <?php echo $datang['rw_asal']?>&nbsp;</td></td>
                </tr>
                <tr>
                    <td>a. Desa/Kelurahan</td><td>  : <?php echo $datang['kelurhn_asal'];?></td><td>&nbsp;b. Kota/Kabupaten : <?php echo $datang['kabtn_asal']?>&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>c. Kecamatan</td><td> : <?php echo $datang('kecmtn_asal');?></td>&nbsp;<td>d. provinsi :&nbsp;&nbsp;<?php echo $datang['prov_asal']?>&nbsp;&nbsp;</td>  
                </tr>
                <tr>
                    <td><td><td>Kode Pos</td><td> : <?php echo $datang('kode_pos');?></td></td></td>&nbsp;<td>Telpon</td><td> :</td>&nbsp;&nbsp;
                </tr>                               
            </table>
            <hr>
            <h4>DATA DAERAH ASAL</h4>
            <table border="0.3" cellpadding="0" cellspacing="0" width="50%">
                <thead style="background:#e8ecee">
                    <tr>
                        <th>No.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        while ($nilai=mysqli_fetch_array($datang)){
                            $no++;
                        echo "<tr>
                                <td>$no</td>
                                <td>$nilai[asalan_datang]</td>                          
                        </tr>"; 
                        }   
                    ?>
                </tbody>
                <tr>
                    <td>Alamat Tujuan Pindah </td><td> : </td><td><?php echo $datang['kelurhn_asal'];?></td>
                </tr>
                <tr>
                    <td><td>Desa/Kelurahan</td></td>
                </tr>
                <tr>
                    <td><td>Kecamatan</td></td>
                </tr>
                <tr>
                    <td><td><td>Kode Pos</td></td></td>
                </tr>
                
            </table>
            <h4>DATA KEPINDAHAN</h4>
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle">No</th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle">Mapel</th>
                        <th colspan="3" style="text-align:center;vertical-align:middle">Pengetahuan</th>
                        <th colspan="3" style="text-align:center;vertical-align:middle">Ketrampilan</th>
                    </tr>
                    <tr>
                        <th width="100px" style="text-align:center;vertical-align:middle">Nilai</th>
                        <th width="100px" style="text-align:center;vertical-align:middle">Predikat</th>
                        <th width="100px" style="text-align:center;vertical-align:middle">Deskripsi</th>
                        <th width="100px" style="text-align:center;vertical-align:middle">Nilai</th>
                        <th width="100px" style="text-align:center;vertical-align:middle">Predikat</th> 
                        <th width="100px" style="text-align:center;vertical-align:middle">Deskripsi</th>                                        
                    </tr>
                </thead>
                
            </table> 
            <h4>EKSTRAKULIKULER</h4>
            <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                <tr>
                    <th>No.</th>
                    <th>Kegiatan Ekstrakulikuler</th>
                    
                </tr>
                </thead>
                
            </table>      
            <h4>TINGGI DAN BERAT BADAN</h4>
            <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                <tr>
                    <th rowspan="2">No.</th>
                    <th colspan="2" align="center">Aspek Yang Dinilai</th>
                </tr>
                <tr>
                    <th>Berat (kg)</th>
                    <th>Tinggi (cm)</th>
                </tr>               
                </thead>
                
            </table>        
            <h4>KONDISI KESEHATAN</h4>
            <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                <tr>
                    <th>No.</th>
                    <th>Aspek Fisik</th>
                    <th>Keterangan</th>
                </tr>               
                </thead>
                
            </table>  
            <h4>PRESTASI</h4>
            <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
                
            </table> 
            <h4>KEHADIRAN</h4>
            <table width="50%" border="0.3" cellpadding="0" cellspacing="0">
                
            </table>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/><br/><br/>
            <table>
            <tr> 
            <td width="500">
                Mengetahui, <br>Orangtua/wali, <br><br><br><br><br>

            <br>-------------------------------------</td>
        
                <td width="500">
                    <p>Klaten, <?php echo date('d-M-Y', time()); ?><br>
                        Wali Kelas </p>
                      <br>
                   <?php echo $walikelas['nama_gr'];?><br/>
                      NIP.<?php echo $walikelas['nip'];?></td>

                      <br>
                      <br>
                      <table>
                    <tr>
                      <td width="600" align="center">
                    <p>Klaten, <?php echo date('d-M-Y', time()); ?><br>
                        Kepala Sekolah </p>
                            <br>
                         St. Karyanto, S.pd<br/>
                       NIP. 192 12576 1 137 </td></tr>
                       </table>
            </tr>

        </table>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

