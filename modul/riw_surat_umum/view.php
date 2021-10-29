	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Riwayat Data Pengajuan Surat Umum</h3>
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
										<th>NIK</th>
										<th>Nama</th>
										<th>TGL Pengajuan</th>
										<th>Nama Surat</th>
										<th>Foto</th>
										<th>Status</th>
										
									</tr>
									<?php								
										$no=0;
										$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_agama,d.nama_gender,e.nama_pekerjaan,f.nama_pendidikan,g.id_statuskawin,h.nama_jenis_surat,i.nama_status_surat,i.warna FROM surat_ket_umum a LEFT JOIN m_penduduk b ON a.nik=b.nik
LEFT JOIN m_agama c ON b.id_agama=c.id_agama 
LEFT JOIN m_gender d ON b.id_gender=d.id_gender 
LEFT JOIN m_pekerjaan e ON b.id_pekerjaan=e.id_pekerjaan
LEFT JOIN m_pendidikan f ON b.id_pendidikan=f.id_pendidikan
LEFT JOIN m_statuskawin g ON b.id_statuskawin=g.id_statuskawin
LEFT JOIN m_jenis_surat h ON a.id_jenis_surat=h.id_jenis_surat LEFT JOIN m_status_surat i ON a.id_status_surat=i.id_status_surat WHERE a.id_akun='$_SESSION[id_akun]'");
										while ($data = mysqli_fetch_array($sql_data)){
											$no++;
											echo "
											<tr>
												<td>$no</td>
												<td>$data[nik]</td>
												<td>".name_from_nik($data['nik'])."</td>
												<td> $data[tgl_surat]</td>
												<td> $data[nama_jenis_surat]</td>
												<td><img src='admin/$data[suratumum]' width='100' height='100'></td>
												<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
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