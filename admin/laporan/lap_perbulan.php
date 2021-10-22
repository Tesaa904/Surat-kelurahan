<?php 
include "../../config/database.php";
include "../../config/jumlah.php";

if (isset($_POST['cari'])){
        $tgl_awal = $_POST['tgl_awal'];
        $tgl_akhir = $_POST['tgl_akhir'];       
    } else {
        $tgl_awal = date('Y-m-d');
        $tgl_akhir = date('Y-m-d');
    }
    ?>
<!-- The Modal -->
<div class="row">
    <div class="col-md-12">
        <div class="text-right mb-4">
        </div>
        <form method="POST" action="">
                    <table>
                        <tr>
                            <td>Tanggal Surat</td>
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
                <div class="panel">
                    <div class="panel-body">
                        <div class="container">
                             <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm table-hover" border="1" cellpadding="0"> 
                                            <thead>
        
                                                <tr border='4'>
                                                   <th colspan="6" style="text-align:center;vertical-align:middle">Jumlah data</th>
                                                   <th rowspan="2" style="text-align:center;vertical-align:middle; border:'6'" >Total jumlah Penduduk</th>
                                               </tr>
                                               <tr>
                                                    <th  style="text-align:center;vertical-align:middle" > kelahiran</th>
                                                    <th  style="text-align:center;vertical-align:middle" > Pindah datang</th>
                                                    <th  style="text-align:center;vertical-align:middle" > Pindah keluar</th>
                                                    <th  style="text-align:center;vertical-align:middle"> kematian</th>
                                                    <th  style="text-align:center;vertical-align:middle"> Warga Laki-laki</th>
                                                    <th  style="text-align:center;vertical-align:middle"> Warga Perempuan</th>
                                                </tr>
                                                     

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
$query_warga = "SELECT COUNT(*) AS total FROM m_penduduk where status='1'";
$hasil_warga = mysqli_query($mysqli, $query_warga);
$jumlah_warga = mysqli_fetch_assoc($hasil_warga);

// hitung lahir
$query_lahir = "SELECT COUNT(*) AS total FROM surat_lahir WHERE cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$jumlah_lahir = mysqli_fetch_assoc($hasil_lahir); 

// hitung datang
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_datang WHERE cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$jumlah_datang = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar WHERE cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$jumlah_keluar = mysqli_fetch_assoc($hasil_keluar);

// hitung mati
$query_mati = "SELECT COUNT(*) AS total FROM surat_mati WHERE cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$jumlah_mati = mysqli_fetch_assoc($hasil_mati);

// hitung warga laki-laki
$query_warga_l = "SELECT COUNT(*) AS total FROM m_penduduk left join m_gender on m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '1' and m_penduduk.status='1'";
$hasil_warga_l = mysqli_query($mysqli, $query_warga_l);
$jumlah_warga_l = mysqli_fetch_assoc($hasil_warga_l);

// hitung warga perempuan
$query_warga_p = "SELECT COUNT(*) AS total FROM m_penduduk left join m_gender on m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '2' and m_penduduk.status='1'";
$hasil_warga_p = mysqli_query($mysqli, $query_warga_p);
$jumlah_warga_p = mysqli_fetch_assoc($hasil_warga_p);
?>
                                                <tr>
                                                    <td><?php echo $jumlah_lahir['total'] ?> orang</td>
                                                    <td><?php echo $jumlah_datang['total'] ?> orang</td>
                                                    <td><?php echo $jumlah_keluar['total'] ?> orang</td>
                                                    <td><?php echo $jumlah_mati['total'] ?> orang</td>
                                                  
                                                    <td><?php echo $jumlah_warga_l['total'] ?> orang</td>
                                                    <td><?php echo $jumlah_warga_p['total'] ?> orang</td>
                                                     <td><?php echo $jumlah_warga['total'] ?> orang</td>
                                                    
                                                </tr>

                                               
                                            </tbody>
                                            
                                        </table>
                                        
                                        <div class="text-right">
            <a href="modul/laporan/cetak-srt-perbulan.php?mulai=<?php echo $tgl_awal;?>&sampai=<?php echo $tgl_akhir;?>" target='-new'  class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print fa fa-print"></i> Cetak</a>
                        
        </div>
    </div>
    </div>
</div>
</div>
</div>
</div>
