	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Riwayat Data Pindah Datang </h3>
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
										<th>No KK</th>
										<th>Kepala Keluarga</th>
										<th>Nik Warga Baru</th>
										<th>Nama Warga Baru</th>
										<th>Nama Dukuh Yang dituju</th>
										<th>Foto surat</th>
										<th>Status</th>
										<th>#</th>
									</tr>
									<?php								
										$no=0;
										$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_alasan_pindah,c.nama_dukuh,c.rt,c.rw,i.nama_klasifikasi,j.nama_jenis_pindh,k.nama_status_kk_pindh,l.nama_status_kk_tdkpindh,g.nama_status_surat,g.warna
FROM surat_pindah_datang a LEFT JOIN m_alasan_pindah b ON a.id_alasan_pindah=b.id_alasan_pindah
LEFT JOIN m_klasifikasi_pindh i ON a.id_klasifikasi_pindah=i.id_klasifikasi
LEFT JOIN m_jenis_pindh j ON a.id_jenis_pindh=j.id_jenis_pindh
LEFT JOIN m_status_kk_pindh k ON a.id_status_kk_pindh=k.id_status_kk_pindh
LEFT JOIN m_status_kk_tdkpindh l ON a.id_status_kk_tdkpindh=l.id_status_kk_tdkpindh
LEFT JOIN m_dukuh c ON a.id_dukuh=c.id_dukuh
left join m_status_surat g on a.id_status_surat=g.id_status_surat WHERE a.id_akun='$_SESSION[id_akun]'");
										while ($data = mysqli_fetch_array($sql_data)){
											$no++;
											echo "
											<tr>
												<td>$no</td>
												<td>$data[no_kk]</td>
												<td>$data[nama_kepala_keluarga]</td>
												<td>$data[nik]</td>
												<td>$data[nama]</td>
												<td>$data[nama_dukuh]</td>
												<td><img src='admin/$data[suratdatang]' width='100' height='100'></td>
												<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
												<td><a href='?modul=det_datang&id=$data[id_datang]' class='btn btn-primary'><i class='fa fa-search'></i>Detail</a></td>
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