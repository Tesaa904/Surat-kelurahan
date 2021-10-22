<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/alasan_pindah/proses.php?act=add">
		<div class="form-group">
			<label>Alasan Pindah</label>
			<input type="text" class="form-control" name="alasan_pindah">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_alasan_pindah where id_alasan_pindah='$get_id'"));
?>
	<form method="POST" action="modul/alasan_pindah/proses.php?act=edit">
		<div class="form-group">
			<label>Nama Alasan Pindah</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_alasan_pindah'];?>">
			<input type="text" class="form-control" name="alasan_pindah" value="<?php echo $data['nama_alasan_pindah'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>