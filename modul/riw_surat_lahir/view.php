	<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> Riwayat Data Kelahiran </h3>
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
										<th>Nama Bayi</th>
										<th>Tempat, Tanggal Lahir</th>
										<th>Nama Ayah</th>
										<th>Nama Ibu</th>
										<th>Foto surat</th>
										<th>Status</th>
										<th>#</th>
									</tr>
									<?php								
										$no=0;
										$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama_gender,c.nama_jenis_lahir,d.nama_tempat_lahir,e.nama_penolong,f.nama_dukuh,
																g.nama_status_surat,g.warna
																FROM surat_lahir a LEFT JOIN m_gender b ON a.id_gender=b.id_gender
																LEFT JOIN m_jenis_lahir c ON a.id_jenis_lahir=c.id_jenis_lahir
																LEFT JOIN m_tempat_lahir d ON a.id_tempat_lahir=d.id_tempat_lahir
																LEFT JOIN m_penolong e ON a.id_penolong=e.id_penolong
																LEFT JOIN m_dukuh f ON a.id_dukuh=f.id_dukuh
																left join m_status_surat g on a.id_status_surat=g.id_status_surat
																WHERE a.id_akun='$_SESSION[id_akun]'");
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
												<td><img src='admin/$data[suratlahir]' width='100' height='100'></td>
												<td><a class='btn btn-sm btn-$data[warna]' style='color:white'>$data[nama_status_surat]</a></td>
												<td><a href='?modul=det_lahir&id=$data[id_lahir]' class='btn btn-primary'><i class='fa fa-search'></i>Detail</a></td>
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