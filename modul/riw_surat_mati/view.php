	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Riwayat Data Kematian </h3>
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
										<th>No Surat</th>
										<th>Kepala Keluarga</th>
										<th>Nama Jenaza</th>
										<th>TGL Kematian</th>
										<th>Nama Ayah</th>
										<th>Nama Ibu</th>
										<th>Foto</th>
										<th>Status</th>
										<th>#</th>
									</tr>
									<?php								
										$no=0;
										$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_sebab_mati,d.nama_penerang,f.nama_dukuh,g.*
																		FROM surat_mati a LEFT JOIN m_penduduk b ON a.nik=b.nik
																		LEFT JOIN m_sebab_mati c ON a.id_sebab_mati=c.id_sebab_mati
																		LEFT JOIN m_penerang d ON a.id_penerang=d.id_penerang
																		LEFT JOIN m_dukuh f ON b.id_dukuh=f.id_dukuh
																		LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat
																		WHERE a.id_akun='$_SESSION[id_akun]'");
										while ($data = mysqli_fetch_array($sql_data)){
											$no++;
											echo "
											<tr>
												<td>$no</td>
												<td>$data[no_surat_mati]</td>
												<td>".name_from_nik($data['nik_kepala_keluarga'])."</td>
												<td>".name_from_nik($data['nik'])."</td>
												<td> $data[tgl_mati]</td>
												<td>".name_from_nik($data['nik_ayah'])."</td>
												<td>".name_from_nik($data['nik_ibu'])."</td>
												<td><img src='admin/$data[suratmati]' width='100' height='100'></td>
												<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
												<td><a href='?modul=det_mati&id=$data[id_mati]' class='btn btn-primary'><i class='fa fa-search'></i>Detail</a></td>
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