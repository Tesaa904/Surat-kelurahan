<?php 
include "../../config/database.php";
include "../../config/jumlah.php";

if (isset($_POST['cari'])){
        $tgl_awal = $_POST['tgl_awal'];
        $tgl_akhir = $_POST['tgl_akhir']; 
        $post_dukuh = $_POST['nama_dukuh'];      
    } else {
        $tgl_awal = date('Y-m-d');
        $tgl_akhir = date('Y-m-d');
    }
    ?>
<!-- The Modal -->
<div class="row">
    <div class="col-md-8">
        <div class="text-right mb-4">
        </div>
        <form method="POST" action="">
                    <table>
                        <tr>
                            <td>
                                <div class="input-group">
                            <select name="nama_dukuh" class="form-control">
                                <option value="" selected="selected">Pilih</option>
                                <?php
                                    $sql_mapel = mysqli_query($mysqli,"select * from m_dukuh order by id_dukuh asc");
                                    while ($mapel = mysqli_fetch_array($sql_mapel)){
                                        if ($_POST['nama_dukuh']==$mapel['id_dukuh'])
                                            $pil_mapel = "selected";
                                        else
                                            $pil_kelas = "";
                                        echo "<option value='$mapel[id_dukuh]' $pil_mapel>$mapel[nama_dukuh]- RT $mapel[rt]/ RW $mapel[rw]</option>";
                                    }
                                ?>
                            </select>
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
                                                    <th >NO</th>
                                                    <th >Nik</th>
                                                    <th >Nama</th>
                                                    <th >No KK</th>
                                                    <th >Dukuh</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                  <?php 
                                            $no=0;
                                            $sql_data=mysqli_query($mysqli,"SELECT a.*, b.nama_agama, c.nama_dukuh,c.rt,c.rw, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk FROM m_penduduk a LEFT JOIN m_agama b ON a.id_agama = b.id_agama LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh LEFT JOIN m_gender d ON a.id_gender = d.id_gender LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk WHERE STATUS='1' AND a.id_dukuh='$post_dukuh'ORDER BY CAST(id_penduduk AS SIGNED)");
                                                while ($data = mysqli_fetch_array($sql_data)){
                  $no++;
                  echo "
                  <tr>
                    <td>$no</td>
                    <td>$data[nik]</td>
                    <td>$data[nama]</td>
                    <td>$data[no_kk]</td>
                    <td>$data[nama_dukuh]-RT $data[rt]/ RW $data[rw]</td>
                   
                  </tr>
                  ";
                }
              ?>

            </tbody>
             </table>
          </td>
           <div class="text-right">
            <a href="modul/laporan/cetak-rekap-pend.php?nama_dukuh=<?php echo $post_dukuh;?>" target="-new" class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i>Cetak</a>    
        </div>
    </div>
    </div>
</div>