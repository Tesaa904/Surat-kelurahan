<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/jns_surat/proses.php?act=add">
		<div class="form-group">
			<label>Jenis Surat</label>
			<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" name="jns_surat">
		</div>
		<div class="form-group">
			<label>Keterangan Isi Surat</label>
			<input type="text" class="form-control" name="ketsurat">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_jenis_surat where id_jenis_surat='$get_id'"));
?>
	<form method="POST" action="modul/jns_surat/proses.php?act=edit">
		<div class="form-group">
			<label>Jenis surat</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_jenis_surat'];?>">
			<input type="text" class="form-control" name="jns_surat" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['nama_jenis_surat'];?>">
		</div>
		<div class="form-group">
			<label>Keterangan Isi Surat</label>
			<input type="text" class="form-control" name="ketsurat" value="<?php echo $data['keterangan'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>
