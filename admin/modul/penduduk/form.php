<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
 
<div class="row">
  <div class="col-md-12">
	<div class="panel panel-default">
	  <div class="panel-heading no-collapse">
	  </div>
		<div class="panel-body">
		<form method="POST"  action="modul/penduduk/proses.php?act=add">
			<div class="col-md-6"> 
			<div class="form-group">
				<tr>
			<td>
			<label>NIK</label>
			<input type="number" class="form-control" name="nik" autofocus="on" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="nama" autocomplete="off">
		</div>
		<div class="form-group">
			<label>Tempat Lahir</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="tmpt_lahir">
		</div>
		<div class="form-group">
			<label>Tgl Lahir</label>
			<div class="input-group">
			<div class="input-group">
			<input class="datepicker form-control form-control-sm" name="tgl_lahir" type="text" placeholder="0000-00-00(tahun-bulan-tanggal)" autocomplete="off"/>
			<div class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</div>
		</div>
		</div>
		<div class="form-group">
			<label>Gender</label>
			 <select type="text" name="id_gender" class="form-control selectpicker" data-live-search="true">
              <option value="" selected="selected" >pilih</option>
			<?php
				$sql_gender = mysqli_query($mysqli,"select * from m_gender order by id_gender asc");
				while ($gender = mysqli_fetch_array($sql_gender)){
					echo "<option value='$gender[id_gender]'>$gender[nama_gender]</option>";
				}
			?>
		</select>
		</div>

		<div class="form-group">
			<label>Golongan Darah</label>
			 <select type="text" name="id_goldarah" class="form-control selectpicker" data-live-search="true">
              <option value="" selected="selected" autofocus="on">pilih</option>
			<?php
				$sql_goldarah = mysqli_query($mysqli,"select * from m_goldarah order by id_goldarah asc");
				while ($goldarah = mysqli_fetch_array($sql_goldarah)){
					echo "<option value='$goldarah[id_goldarah]'>$goldarah[nama_goldarah]</option>";
				}
			?>
			</select>
		</div>
		</td>								
		<td style="text-align:right">
		<div class="form-group">
			<label>Agama</label>
			 <select type="text" name="id_agama" class="form-control selectpicker" data-live-search="true">
              <option value="" selected="selected" autofocus="on">pilih</option>
			<?php
				$sql_agama = mysqli_query($mysqli,"select * from m_agama order by id_agama asc");
				while ($agama = mysqli_fetch_array($sql_agama)){
					echo "<option value='$agama[id_agama]'>$agama[nama_agama]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>Pendidikan</label>
			 <select type="text" name="id_pendidikan" class="form-control select2">
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_pendidikan order by id_pendidikan asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_pendidikan]'>$data[nama_pendidikan]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>Status Kawin</label>
			 <select type="text" name="id_statuskawin" class="form-control">
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_statuskawin order by id_statuskawin asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_statuskawin]'>$data[nama_statuskawin]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>Pekerjaan</label>
			<select type="text" name="id_pekerjaan" class="form-control select2" data-live-search="true">
              <option value="" selected="selected" autofocus="on">pilih</option>
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_pekerjaan order by id_pekerjaan asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_pekerjaan]'>$data[nama_pekerjaan]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>Warganegara</label>
			 <select type="text" name="id_warganegara" class="form-control">
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_warganegara order by id_warganegara asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_warganegara]'>$data[nama_warganegara]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>No KK</label>
			<input type="text" class="form-control" name="no_kk">
		</div>
		<div class="form-group">
			<label>Status KK</label>
			 <select type="text" name="id_shdk" class="form-control select2">
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_shdk order by id_shdk asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_shdk]'>$data[nama_shdk]</option>";
				}
			?>
		</select>
		</div>
		<div class="form-group">
			<label>Dusun</label>
			 <select type="text" name="id_dukuh" class="form-control select2">
              <option value="" selected="selected" autofocus="on">pilih </option>
			<?php
				$sql_data = mysqli_query($mysqli,"select * from m_dukuh order by id_dukuh asc");
				while ($data = mysqli_fetch_array($sql_data)){
					echo "<option value='$data[id_dukuh]'>$data[nama_dukuh]- RT $data[rt]/ RW $data[rw]</option>";
				}
			?>
		</select>
		</div>
	</div>
</td>
		<td style="text-align:right">	
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
			<a href="javascript:history.back()" class="btn btn-warning">Batal</a>
		</div>
	</td>
	</tr>
	</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.*, b.nama_agama, c.nama_dukuh,c.rt,c.rw, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk, c.nama_dukuh, c.rt, c.rw FROM m_penduduk a LEFT JOIN m_agama b ON a.id_agama = b.id_agama LEFT JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh LEFT JOIN m_gender d ON a.id_gender = d.id_gender LEFT JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah LEFT JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan LEFT JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan LEFT JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin LEFT JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara LEFT JOIN m_shdk j ON a.id_shdk = j.id_shdk  WHERE id_penduduk = '$get_id'"));
?>
	<form method="POST" action="modul/penduduk/proses.php?act=edit">
		<div class="panel-heading no-collapse">
					UDAH DATA
				</div>
		<tr>
			<td>
				<table class="table"> 
						<td>
									
										<div class="form-group">
											<label>NIK</label>
											<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_penduduk'];?>">
											<input class="form-control" name="nik" value="<?php echo $data['nik'] ;?>" type="text" />
										</div>
										<div class="form-group">
											<label class="control-label">Nama</label>								   
											<input class="form-control" name="nama" value="<?php echo $data['nama'] ;?>" onkeyup="this.value = this.value.toUpperCase()" type="text" />
										</div>
										 							
										<div class="form-group">
											<label class="control-label">Tempat Lahir</label>
											<input class="form-control" name="tmpt_lahir" value="<?php echo $data['tmpt_lahir'] ;?>" onkeyup="this.value = this.value.toUpperCase()" type="text" />
										</div>
										<div class="form-group">
											<label class="control-label">Tanggal Lahir</label>
											<div class="form-inline">
												<div class="input-group">
													<input class="form-control datepicker" name="tgl_lahir" type="text" value="<?php echo $data['tgl_lahir'];?>">
													<div class="input-group-addon">
														<span class="fa fa-calendar"></span>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Jenis Kelamin</label>
											<select type="text" name="id_gender" class="form-control select2">
												<option value="<?php echo $data['id_gender'];?>" selected><?php echo $data['nama_gender'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_gender");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_gender']==$data['nama_gender'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_gender]'$select>$tm_lahir[nama_gender]</option>";
													}
												?>														
											</select>
										</div>			
										<div class="form-group">
											<label class="control-label">Golongan Darah</label>
											<select type="text" name="id_goldarah" class="form-control select2">
												<option value="<?php echo $data['id_goldarah'];?>" selected><?php echo $data['nama_goldarah'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_goldarah");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_goldarah']==$data['nama_goldarah'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_goldarah]'$select>$tm_lahir[nama_goldarah]</option>";
													}
												?>														
											</select>
										</div>				
										<div class="form-group">
											<label class="control-label">Agama</label>
											<select type="text" name="id_agama" class="form-control select2">
												<option value="<?php echo $data['id_agama'];?>" selected><?php echo $data['nama_agama'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_agama");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_agama']==$data['nama_agama'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_agama]'$select>$tm_lahir[nama_agama]</option>";
													}
												?>														
											</select>
										</div>				
									</td>
										<td style="text-align:left">
										
										<div class="form-group">
											<label class="control-label">Pendidikan</label>
											<select type="text" name="id_pendidikan" class="form-control select2">
												<option value="<?php echo $data['id_pendidikan'];?>" selected><?php echo $data['nama_pendidikan'] ?></option>
												<?php
													$sql_tm_lahir = mysqli_query($mysqli,"select * from m_pendidikan");
													while ($tm_lahir = mysqli_fetch_array($sql_tm_lahir)){
														if ($tm_lahir['id_pendidikan']==$data['nama_pendidikan'])
												$select = "selected";
											else
												$select = "";
														echo "<option value='$tm_lahir[id_pendidikan]'$select>$tm_lahir[nama_pendidikan]</option>";
													}
												?>														
											</select>
										</div>		
																			
										<div class="form-group">
											<label class="control-label">Status Perkawinan</label>
											<select type="text" name="id_statuskawin" class="form-control select2">
												<option value="<?php echo $data['id_statuskawin']?>" selected="selected" autofocus="on"><?php echo $data['nama_statuskawin'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_statuskawin ORDER BY id_statuskawin");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_statuskawin']==$data['nama_statuskawin'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_statuskawin]'$select>$row1[nama_statuskawin]</option>";
													}
												?>
											</select>
										</div>	
										
										<div class="form-group">
											<label class="control-label">Pekerjaan</label>
											<select type="text" name="id_pekerjaan" class="form-control select2">
												<option value="<?php echo $data['id_pekerjaan']?>" selected="selected" autofocus="on"><?php echo $data['nama_pekerjaan'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_pekerjaan ORDER BY id_pekerjaan");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_pekerjaan']==$data['nama_pekerjaan'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_pekerjaan]'$select>$row1[nama_pekerjaan]</option>";
													}
												?>
											</select>
										</div>									 <div class="form-group">
											<label class="control-label">Warga Negara</label>
											<select type="text" name="id_warganegara" class="form-control select2">
												<option value="<?php echo $data['id_warganegara']?>" selected="selected" autofocus="on"><?php echo $data['nama_warganegara'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_warganegara ORDER BY id_warganegara");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_warganegara']==$data['nama_warganegara'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_warganegara]'$select>$row1[nama_warganegara]</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">NO KK</label>
											<input class="form-control" name="no_kk" value="<?php echo $data['no_kk'] ;?>" type="text" />
										</div>
										<div class="form-group">
											<label class="control-label">Status Dalam KK</label>
											<select type="text" name="id_shdk" class="form-control select2">
												<option value="<?php echo $data['id_shdk']?>" selected="selected" autofocus="on"><?php echo $data['nama_shdk'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_shdk ORDER BY id_shdk");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_shdk']==$data['nama_shdk'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_shdk]'$select>$row1[nama_shdk]</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Dukuh</label>
											<select type="text" name="id_dukuh" class="form-control select2">
												<option value="<?php echo $data['id_dukuh']?>" selected="selected" autofocus="on"><?php echo $data['nama_dukuh'] ?> - RT <?php echo $data['rt'] ?></option>
												<?php
													$sql = mysqli_query($mysqli,"SELECT * FROM m_dukuh ORDER BY id_dukuh");
												  
													while($row1 = mysqli_fetch_assoc($sql)){
														if ($row1['id_dukuh']==$data['nama_dukuh'])
												$select = "selected";
											else
												$select = "";
													echo "<option value='$row1[id_dukuh]'>$row1[nama_dukuh]-RT $row1[rt]/ RW $row1[rw]</option>";
													}
												?>
											</select>
										</div>		
										</td>
								</table>
							
								<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
								</div>
								
						</td>
					</tr>
				</form>
<?php
	}
?>