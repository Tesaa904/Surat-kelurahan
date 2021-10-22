<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/statuskawin/proses.php?act=add">
		<div class="form-group">
			<label>Status Kawin</label>
			<input type="text" class="form-control" name="statuskawin">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_statuskawin where id_statuskawin='$get_id'"));
?>
	<form method="POST" action="modul/statuskawin/proses.php?act=edit">
		<div class="form-group">
			<label>Status Kawin</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_statuskawin'];?>">
			<input type="text" class="form-control" name="statuskawin" value="<?php echo $data['nama_statuskawin'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>