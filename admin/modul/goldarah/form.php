<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/goldarah/proses.php?act=add">
		<div class="form-group">
			<label>Nama Golongan Darah</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="goldarah">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_goldarah where id_goldarah='$get_id'"));
?>
	<form method="POST" action="modul/goldarah/proses.php?act=edit">
		<div class="form-group">
			<label>Nama Golongan Darah</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_goldarah'];?>">
			<input type="text" class="form-control" name="goldarah" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['nama_goldarah'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>