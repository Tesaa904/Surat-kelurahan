<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/dukuh/proses.php?act=add">
		<div class="form-group">
			<label>Nama Dukuh</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="dukuh">
		</div>
		<div class="form-group">
			<label>RT</label>
			<input type="text" class="form-control" name="rt">
		</div>
		<div class="form-group">
			<label>RW</label>
			<input type="text" class="form-control" name="rw">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_dukuh where id_dukuh='$get_id'"));
?>
	<form method="POST" action="modul/dukuh/proses.php?act=edit">
		<div class="form-group">
			<label>Nama Dukuh</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_dukuh'];?>">
			<input type="text" class="form-control" name="dukuh" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['nama_dukuh'];?>">
		</div>
		<div class="form-group">
			<label>RT</label>
			<input type="text" class="form-control" name="rt" value="<?php echo $data['rt'];?>">
		</div>
		<div class="form-group">
			<label>RW</label>
			<input type="text" class="form-control" name="rw" value="<?php echo $data['rw'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>