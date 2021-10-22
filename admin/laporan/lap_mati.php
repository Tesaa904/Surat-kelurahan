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
								<th>Nama Jenaza</th>
								<th>TGL Kematian</th>
								<th>Nama Ayah</th>
								<th>Nama Ibu</th>
								<th>Status</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php								
								$no=0;
								$sql_data = mysqli_query($mysqli,"SELECT a.*,b.nama,c.nama_sebab_mati,d.nama_penerang,f.nama_dukuh
						FROM surat_mati a LEFT JOIN m_penduduk b ON a.nik=b.nik
						LEFT JOIN m_sebab_mati c ON a.id_sebab_mati=c.id_sebab_mati
						LEFT JOIN m_penerang d ON a.id_penerang=d.id_penerang
						LEFT JOIN m_dukuh f ON b.id_dukuh=f.id_dukuh
						LEFT JOIN m_status_surat g ON a.id_status_surat=g.id_status_surat
						WHERE a.id_status_surat like'%2%' AND CAST(a.tgl_surat AS DATE) BETWEEN '$tgl_awal' AND '$tgl_akhir'");
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
										
									</tr>
									";
								}
							?>
						</tbody>

					</table>
					 <div class="text-right">
            <a href="modul/laporan/cetak-srt-mati.php?mulai=<?php echo $tgl_awal;?>&sampai=<?php echo $tgl_akhir;?>" target='-new' class="btn btn-sm btn-primary login-submit-cs"><i class="fa fa-print"></i>Cetak</a>    
        </div>
				</div>
			</div>
		</div>
	</div>
</div>