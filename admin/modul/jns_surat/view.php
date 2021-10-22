<script>
	function show_add(a){
		var id = a;
		$('.modal-body').load('modul/jns_surat/form.php?mode=add',function(){
			$('#modal_global').modal('show');
		});
	}
	function show_edit(b){
		var id = b;
		$('.modal-body').load('modul/jns_surat/form.php?mode=edit&id='+id,function(){
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
        <h4 class="modal-title">Isi Data</h4>
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
	<div class="col-md-6">
		<div class="text-right mb-3">
			<a href="#" class="btn btn-primary btn-sm" onclick="show_add()"><i class="fa fa-plus"></i> Tambah</a>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis Surat</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							$sql_data = mysqli_query($mysqli,"select * from m_jenis_surat order by cast(id_jenis_surat as signed) asc");
							while ($data = mysqli_fetch_array($sql_data)){
								$no++;
								echo "
								<tr>
									<td>$no</td>
									<td>$data[nama_jenis_surat]</td>
									<td>$data[keterangan]</td>
									<td>
										<div class='btn-group'>
											<a href='#' onclick='show_edit($data[id_jenis_surat])' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a>
											<a href='modul/jns_surat/proses.php?act=del&id=$data[id_jenis_surat]' onClick='return konfirmasi()' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
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