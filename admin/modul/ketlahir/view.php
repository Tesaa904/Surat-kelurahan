<?php
	if (isset($_POST['cari'])){
		$tgl_awal = $_POST['tgl_awal'];
		$tgl_akhir = $_POST['tgl_akhir'];		
	} else {
		$tgl_awal = date('Y-m-d');
		$tgl_akhir = date('Y-m-d');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="text-right mb-3">
			<a href="?modul=ketlahir_form&mode=add" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
		</div>
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
								<th>No Surat</th>
								<th>Kepala Keluarga</th>
								<th>Nama Bayi</th>
								<th>Tempat, Tanggal Lahir</th>
								<th>Nama Ayah</th>
								<th>Nama Ibu</th>
								<th>Foto surat</th>
								<th>Status</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php								
								$no=0;
								$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh,g.id_status_surat,
														g.nama_status_surat,g.warna
														FROM surat_lahir a LEFT JOIN m_gender b ON a.id_gender=b.id_gender
														LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
														LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
														LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
														LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh
														left join m_status_surat g on a.id_status_surat=g.id_status_surat
														left join m_penduduk h on a.id_lahir=h.id_lahir
														WHERE cast(a.tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
								while ($data = mysqli_fetch_array($sql_data)){
									$no++;
									echo "
									<tr>
										<td>$no</td>
										<td>$data[no_surat_lahir]</td>
										<td>".name_from_nik($data['nik_kepala_keluarga'])."</td>
										<td>$data[nama]</td>
										<td>$data[tempat_lahir], $data[tgl_lahir]</td>
										<td>".name_from_nik($data['nik_ayah'])."</td>
										<td>".name_from_nik($data['nik_ibu'])."</td>
										<td><img src='$data[suratlahir]' width='100' height='100'></td>
										<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>

										<td>
											<div class='dropdown'>
											  <button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>Aksi<span class='caret'></span></button>
											  <ul class='dropdown-menu'>
												<li><a href='modul/ketlahir/proses.php?act=verif&id=$data[id_lahir]' onClick='return verif()'>Verifikasi</a></li>
												 <li><a href='?modul=ketlahir_show&mode=detail&id=$data[id_lahir]'>Detail</a></li>
												  <li><a href='?modul=ketlahir_form&mode=edit&id=$data[id_lahir]'>Ubah</a></li>
												<li><a href='modul/ketlahir/cetak_srt_lahir.php?id_lahir=$data[id_lahir]&mulai=$tgl_awal&sampai=$tgl_akhir&ibu=$data[nik_ibu]&ayah=$data[nik_ayah]&pelapor=$data[nik_pelapor]&saksi1=$data[nik_saksi1]&saksi2=$data[nik_saksi2]' target='-new'>Cetak</a></li>
												<li><a href='modul/ketlahir/proses.php?act=del&id=$data[id_lahir]' onClick='return konfirmasi()'>Hapus</a></li>
											  </ul>
											</div>										
										</td>
									</tr>
									";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>