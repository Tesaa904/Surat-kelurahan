
<!-- The Modal -->
<div class="row">
	<div class="col-md-12">
		<div class="text-right mb-3">
			<a href="?modul=penduduk_form&mode=add" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
		</div>
		
			<div class="panel-body">
                <table id="demo-dt-delete" class="datatable table table-striped table-bordered">
					<thead>
		
                                                <tr>
                                                    <th >NO</th>
                                                    <th >Nik</th>
                                                    <th >Nama</th>
                                                    <th > Tempat/Tanggal Lahir</th>
                                                    <th >Jenis Kelamin</th>
                                                    <th >No KK</th>
                                                    <th>Status KK</th>
                                                    <th>Desa</th>
                                                    <th >#</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            	  <?php 
                                            $no=1;
                                            $sql_data=mysqli_query($mysqli,"SELECT a.*, b.nama_agama, c.nama_dukuh, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk FROM m_penduduk a LEFT JOIN m_agama b ON a.id_agama = b.id_agama LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh LEFT JOIN m_gender d ON a.id_gender = d.id_gender LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk WHERE STATUS='1' ORDER BY CAST(id_penduduk AS SIGNED)");
                                            $hitung=mysqli_num_rows($sql_data);
                                            if ($hitung>0) {
                                                while ($data= mysqli_fetch_assoc($sql_data)) {
                                             ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $data['nik']; ?></td>
                                                    <td><?php echo $data['nama']; ?></td>
                                                    <td><?php echo $data['tmpt_lahir']; ?>/<?php echo $data['tgl_lahir']; ?></td>
                                                    <td><?php echo $data['nama_gender']; ?></td>
                                                    <td><?php echo $data['no_kk']; ?></td>
                                                    <td><?php echo $data['nama_shdk']; ?></td>
                                                    <td><?php echo $data['nama_dukuh']; ?></td>
                                                  <td>                                            
										<div class='dropdown'>
											  <button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>Aksi<span class='caret'></span></button>
											  <ul class='dropdown-menu'>
											  <li><a href='?modul=penduduk_show&mode=detail&id=<?php echo $data['id_penduduk'];?>'>Detail</a></li>
											<li><a href='?modul=penduduk_form&mode=edit&id=<?php echo $data['id_penduduk'];?>'>Ubah</a></li>
											<li><a href='modul/penduduk/proses.php?act=del&id=<?php echo $data['id_penduduk'];?>' onClick='return konfirmasi()'>Hapus</a></li>
										</div>
									</td>
                                                    
                                                </tr>

                                                <?php $no++;
                                                 }}
                                                 ?>
                                            </tbody>
                                            
                                        </table>
						
								
			</div>
		</div>
	</div>
</div>
