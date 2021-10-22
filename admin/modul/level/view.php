<!-- The Modal -->
<div class="modal fade" id="modal_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Isi Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		<?php
			$last_kode = mysqli_fetch_array(mysqli_query($mysqli,"select max(right(id_level,3)) as 'kode' from m_level"));
			if (strlen($last_kode['kode'])<1)
				$last = 0;
			else
				$last = $last_kode['kode'];
				$new_kode = "LV".str_pad(($last+1),3,"0",STR_PAD_LEFT);
		?>
      <!-- Modal body -->
      <div class="modal-body">
		<form method="POST" action="modul/level/proses.php?act=add">
			<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>ID Level</label>
							<input type="text" class="form-control" name="id_level" autocomplete="off" value="<?php echo $new_kode?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Level</label>
							<input type="text" class="form-control" name="nama_level" autocomplete="off">
						</div>				
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>DAFTAR MENU</label><br>
							<?php
								$sql_menu = mysqli_query($mysqli,"select * from m_menu order by id_menu");
								while ($menu = mysqli_fetch_array($sql_menu)){
									echo "<input type='checkbox' name='id_menu[]' value='$menu[id_menu]'> $menu[nama_menu]<br>";
								}
							?>						
						</div>
					</div>
			</div>
			<div class="form-group">
				<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		</form>	  
      </div>

      <!-- Modal footer -->
    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="text-right mb-3">
			<a href="#modal_add" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</a>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID Level</th>
							<th>Nama Level</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							$sql_level = mysqli_query($mysqli,"select * from m_level");
							while ($level = mysqli_fetch_array($sql_level)){
								$no++;
								echo "<tr>
										<td>$no</td>
										<td>$level[id_level]</td>
										<td>$level[nama_level]</td>
										<td>
											<div class='btn-group'>
											<a href='#modal_edit_$level[id_level]' data-toggle='modal' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a>
											<a href='modul/level/proses.php?act=del&id=$level[id_level]' onClick='return konfirmasi()' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
										</div>
										</td>
									</tr>";
						?>
						<!-- Modal -->
						<div id="modal_edit_<?php echo $level['id_level']?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Data Ubah</h4>
							  </div>
							  <div class="modal-body">
								<form method="POST" action="modul/level/proses.php?act=edit">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>ID Level</label>
												<input type="text" class="form-control" name="id_level_ed" value="<?php echo $level['id_level'];?>" autocomplete="off" readonly>
											</div>
											<div class="form-group">
												<label>Nama Level</label>
												<input type="text" class="form-control" name="nama_level_ed" value="<?php echo $level['nama_level'];?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>DAFTAR MENU</label><br>
												<?php
													$sql_menu = mysqli_query($mysqli,"select a.id_menu,xx.id_level,a.nama_menu from m_menu a left join
																			(select * from m_level_menu where id_level='$level[id_level]')xx
																			on a.id_menu = xx.id_menu where a.tampil='Y'");
													while ($menu = mysqli_fetch_array($sql_menu)){
														if($menu['id_level']==$level['id_level'])
															$cek = "checked";
														else
															$cek = "";
														echo "<input type='checkbox' name='id_menu_ed[]' value='$menu[id_menu]' $cek> $menu[nama_menu]<br>";
													}
												?>						
											</div>
										</div>
										<div class="form-group col-md-8">
											<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
										</div>
									</div>
								</form>	
							  </div>
							</div>

						  </div>
						</div>						
						<?php
							}
						?>
					</tbody>
				</table>
			</div>				  
		  </div>
		</div>			
	</div>

