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
			<a href="?modul=pindahdatang_form&mode=add" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
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
								<th>No KK</th>
								<th>Nama Kepala keluarga</th>
								<th>Desa Tujuan</th>
								<th>Tanggal Datang</th>
								<th>NIK & Nama Yang Pindah</th>
								<th>Foto</th>
								<th>Status</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php								
								$no=0;
								$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
h.nama_propinsi,i.nama_klasifikasi,j.nama_jenis_pindh,k.nama_status_kk_pindh,l.nama_status_kk_tdkpindh,g.nama_status_surat,g.warna
FROM surat_pindah_datang a LEFT JOIN m_alasan_pindah b ON a.id_alasan_pindah=b.id_alasan_pindah
LEFT JOIN m_klasifikasi_pindh i ON a.id_klasifikasi_pindah=i.id_klasifikasi
LEFT JOIN m_jenis_pindh j ON a.id_jenis_pindh=j.id_jenis_pindh
LEFT JOIN m_status_kk_pindh k ON a.id_status_kk_pindh=k.id_status_kk_pindh
LEFT JOIN m_status_kk_tdkpindh l ON a.id_status_kk_tdkpindh=l.id_status_kk_tdkpindh
LEFT JOIN m_dukuh c ON a.id_dukuh=c.id_dukuh
LEFT JOIN wil_kelurahan d ON a.id_kelurahan_asal=d.id_kelurahan
LEFT JOIN wil_kecamatan e ON a.id_kecamatan_asal=e.id_kecamatan
LEFT JOIN wil_kabkota f ON a.id_kabkota_asal=f.id_kabkota
LEFT JOIN wil_propinsi h ON a.id_propinsi_asal=h.id_propinsi
left join m_status_surat g on a.id_status_surat=g.id_status_surat
WHERE CAST(a.tgl_surat_datang AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
								while ($data = mysqli_fetch_array($sql_data)){
									$no++;
									echo "
									<tr>
										<td>$no</td>
										<td>$data[no_kk]</td>
										<td>$data[nama_kepala_keluarga]</td>
										<td>$data[nama_dukuh]</td>
										<td>$data[tgl_datang]</td>
										<td>$data[nik] & $data[nama]</td>
										<td><img src='$data[suratdatang]' width='100' height='100'></td>
										<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
										<td>
											<div class='dropdown'>
											  <button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>Aksi<span class='caret'></span></button>
											  <ul class='dropdown-menu'>
												<li><a href='modul/pindahdatang/proses.php?act=verif&id=$data[id_datang]' onClick='return verif()'>Verifikasi</a></li>
												<li><a href='?modul=pindahdatang_show&mode=detail&id=$data[id_datang]'>Detail</a></li>
												<li><a href='?modul=pindahdatang_form&mode=edit&id=$data[id_datang]'>Ubah</a></li>
												<li><a href='modul/pindahdatang/cetak_srt_datang.php?nik=$data[nik]&mulai=$tgl_awal&sampai=$tgl_akhir&datang=$data[id_datang]' target='-new' >Cetak</a></li>
												<li><a href='modul/pindahdatang/proses.php?act=del&id=$data[id_datang]' onClick='return konfirmasi()'>Hapus</a></li>
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
