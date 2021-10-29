	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Riwayat Data Pindah Keluar </h3>
	</div>

	<div id="page-content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-body">
						<div class="container">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-sm table-hover">
									<tr>
										<th>No</th>
										<th>NIK Kepala Keluarga</th>
										<th>NIK </th>
										<th>Nama </th>
										<th>Alasan Pindah</th>
										<th>Nama Dukuh</th>
										<th>Tanggal Rencana Pindah</th>
										<th>Foto</th>
										<th>Status</th>
										<th>#</th>
									</tr>
									<?php								
										$no=0;
										$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,d.nama_kelurahan,e.nama_kecamatan,f.nama_kabkota,
h.nama_propinsi,i.nama_klasifikasi,j.nama_jenis_pindh,k.nama_status_kk_pindh,l.nama_status_kk_tdkpindh,
g.nama_status_surat,g.warna
FROM surat_pindah_luar a LEFT JOIN m_alasan_pindah b ON a.id_alasan_pindah=b.id_alasan_pindah
LEFT JOIN m_klasifikasi_pindh i ON a.id_klasifikasi_pindh=i.id_klasifikasi
LEFT JOIN m_jenis_pindh j ON a.id_jenis_pindh=j.id_jenis_pindh
LEFT JOIN m_status_kk_pindh k ON a.id_status_kk_pindh=k.id_status_kk_pindh
LEFT JOIN m_status_kk_tdkpindh l ON a.id_status_kk_tdkpindh=l.id_status_kk_tdkpindh
LEFT JOIN m_penduduk o ON a.nik=o.nik
LEFT JOIN m_dukuh c ON o.id_dukuh=c.id_dukuh
LEFT JOIN wil_kelurahan d ON a.id_kelurahan_tujuan=d.id_kelurahan
LEFT JOIN wil_kecamatan e ON a.id_kecamatan_tujuan=e.id_kecamatan
LEFT JOIN wil_kabkota f ON a.id_kabkota_tujuan=f.id_kabkota
LEFT JOIN wil_propinsi h ON a.id_propinsi_tujuan=h.id_propinsi
LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat
														WHERE a.id_akun='$_SESSION[id_akun]'");
										while ($data = mysqli_fetch_array($sql_data)){
											$no++;
											echo "
											<tr>
												<td>$no</td>
												<td> $data[nik_kepala_kel]</td>
												<td> $data[nik]</td>
												<td>".name_from_nik($data['nik'])."</td>
												<td> $data[nama_alasan_pindah]</td>
												<td> $data[nama_dukuh]</td>
												<td> $data[tgl_rencana_pindah]</td>
												<td><img src='admin/$data[suratkeluar]' width='100' height='100'></td>
												<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
												<td><a href='?modul=det_keluar&id=$data[id_luar]' class='btn btn-primary'><i class='fa fa-search'></i>Detail</a></td>
											</tr>
											";
										}
									?>									
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>		