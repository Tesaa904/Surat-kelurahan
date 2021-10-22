<script>
	function show_edit(b){
		var id = b;
		$('.modal-body').load('modul/akun_penduduk/form.php?mode=edit&id='+id,function(){
			$('#modal_global').modal('show');
		});
	}
</script>
<!-- The Modal -->
<div class="modal fade" id="modal_global">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-10">
		<div class="text-right mb-3">
			
		</div>
		<div class="card">
			<div class="card-body">
				<table class="datatable table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Penduduk</th>
							<th>Username</th>
							<th>NIK</th>
							<th>Verifikasi</th>
							<th>Aktif</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							$sql_data = mysqli_query($mysqli,"SELECT * FROM m_akun_penduduk a ORDER BY a.id_akun");
							while ($data = mysqli_fetch_array($sql_data)){
								$no++;
								echo "
								<tr>
									<td>$no</td>
									<td>".name_from_nik($data['nik'])."</td>
									<td>$data[email]</td>
									<td>$data[nik]</td>
									<td>$data[verifikasi]</td>
									<td>$data[aktif]</td>
									<td>
										<div class='btn-group'>
										<a href='modul/akun_penduduk/proses.php?act=del&id=$data[id_akun]'onClick='return konfirmasi()' class='btn btn-danger btn-sm'><i class='fa fa-trash'title='hapus'></i></a>
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
