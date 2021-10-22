<?php
	if (isset($_POST['cari'])){
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];
		$post_surat = $_POST['nama_jenis'];			
	} else {
		$tgl_awal = date('Y-m-d');
		$tgl_akhir = date('Y-m-d');
	}
?>

     <div class="row">
		<div class="col-md-12">
		<table>		
			<td>			
				<div class="panel">
					<div class="panel-heading">
					   <div class="panel-body demo-jasmine-btn">
						<td>
							<a href="?modul=ketumum_formdomi&mode=add" class="list-group-item active">Surat KET Domisili <i class="icon-lg fa fa-envelope"></i></a>
						</td>
						<td>
							<a href="?modul=ketumum_formbea&mode=add" class="list-group-item active">Surat KET Tidak Mampu <i class="icon-lg fa fa-envelope"></i></a>
						</td>
						<td>
							<a href="?modul=ketumum_formusaha&mode=add" class="list-group-item active">Surat KET Usaha <i class="icon-lg fa fa-envelope"></i></a>
						</td>
						<td>
							<a href="?modul=ketumum_formramai&mode=add" class="list-group-item active">Surat Ijin Keramaian <i class="icon-lg fa fa-envelope"></i></a>
						   </td>
						   <td>
							<a href="?modul=ketumum_formbangun&mode=add" class="list-group-item active">Surat Permohonan Ijin Mendirikan Bangunan <i class="icon-lg fa fa-envelope"></i></a>
						</td>
						 <td>
							<a href="?modul=ketumum_formperubahan&mode=add" class="list-group-item active">Surat Pengantar Perubahan Data <i class="icon-lg fa fa-envelope"></i></a>
						</td>
						</div>
					</div>
				</div>
			</td>
		</table>
		
		<div class="card">
			<div class="card-body">
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
								<div class="input-group">
							<select name="nama_jenis" class="form-control">
								<option value="-" selected="selected">Pilih</option>
								<?php
									$sql_stat_surat = mysqli_query($mysqli,"select * from m_jenis_surat order by id_jenis_surat asc");
									while ($stat_surat = mysqli_fetch_array($sql_stat_surat)){
										if ($_POST['nama_jenis']==$stat_surat['id_jenis_surat'])
											$pil_stat_surat = "selected";
										else
											$pil_stat_surat = "";
										echo "<option value='$stat_surat[id_jenis_surat]' $pil_stat_surat>$stat_surat[nama_jenis_surat]</option>";
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
								<th>No</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Nama Surat</th>
								<th>Tanggal Surat</th>
								<th>Foto</th>
								<th>Status</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php								
								$no=0;
								$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_agama,d.nama_gender,e.nama_pekerjaan,f.nama_pendidikan,
																g.id_statuskawin,h.nama_jenis_surat,q.nama_status_surat,q.warna FROM surat_ket_umum a 
																LEFT JOIN m_penduduk b ON a.nik=b.nik
																LEFT JOIN m_agama c ON b.id_agama=c.id_agama 
																LEFT JOIN m_gender d ON b.id_gender=d.id_gender 
																LEFT JOIN m_pekerjaan e ON b.id_pekerjaan=e.id_pekerjaan
																LEFT JOIN m_pendidikan f ON b.id_pendidikan=f.id_pendidikan
																LEFT JOIN m_statuskawin g ON b.id_statuskawin=g.id_statuskawin
																LEFT JOIN m_jenis_surat h ON a.id_jenis_surat=h.id_jenis_surat
																LEFT JOIN m_status_surat q ON a.id_status_surat=q.id_status_surat
																WHERE cast(a.tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND  a.id_jenis_surat='$post_surat'");
								while ($data = mysqli_fetch_array($sql_data)){
									$no++;
									echo "
									<tr>
										<td>$no</td>
										<td>$data[nik]</td>
										<td>$data[nama]</td>
										<td>$data[nama_jenis_surat]</td>
										<td>$data[tgl_surat]</td>
										<td><img src='$data[suratumum]' width='100' height='100'></td>
										<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
										<td>
											<div class='dropdown'>
											  <button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>Aksi<span class='caret'></span></button>
											  <ul class='dropdown-menu'>
												<li><a href='modul/ketumum/proses.php?act=verif&id=$data[id_ket_umum]' onClick='return verif()'>Verifikasi</a></li>
												  <li><a href='?modul=ketumum_edit&mode=edit&id=$data[id_ket_umum]'>Ubah</a></li>
												<li><a href='modul/ketumum/proses_cetak.php?nik=$data[nik]&mulai=$tgl_awal&sampai=$tgl_akhir&nama_jenis=$post_surat'target='-new'>Cetak</a></li>
												<li><a href='modul/ketumum/proses.php?act=del&id=$data[id_ket_umum]' onClick='return konfirmasi()'>Hapus</a></li>
											  </ul>
											</div>										
										</td>
									</tr>
									";
								}
							?>
						</tbody>
					</table>
					<div class="text-right">
            <a href="modul/ketumum/cetak_rekap_umum.php?mulai=<?php echo $tgl_awal;?>&sampai=<?php echo $tgl_akhir;?>" target='-new' class="btn btn-sm btn-info login-submit-cs"><i class="fa fa-print"></i>Cetak</a>    
       			 </div>
				</div>
			</div>
		</div>

	</div>
</div>
