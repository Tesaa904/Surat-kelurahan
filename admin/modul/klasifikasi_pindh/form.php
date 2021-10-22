<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/klasifikasi_pindh/proses.php?act=add">
		<div class="form-group">
			<label>Jenis Klasifikasi</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="klasifikasi">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_klasifikasi_pindh where id_klasifikasi='$get_id'"));
?>
	<form method="POST" action="modul/klasifikasi_pindh/proses.php?act=edit">
		<div class="form-group">
			<label>Jenis Klasifikasi</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_klasifikasi'];?>">
			<input type="text" class="form-control" name="klasifikasi" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['nama_klasifikasi'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>
