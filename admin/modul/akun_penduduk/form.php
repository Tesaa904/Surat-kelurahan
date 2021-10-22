<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<!--<form method="POST" action="modul/pekerjaan/proses.php?act=add">
		<div class="form-group">
			<label>Nama Pekerjaan</label>
			<input type="text" class="form-control" name="pekerjaan">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form> -->
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select *,m_penduduk.nik from m_akun_penduduk left join m_penduduk on m_akun_penduduk.nik=m_penduduk.nik where id_akun='$get_id'"));
?>
	<form method="POST" action="modul/akun_penduduk/proses.php?act=edit">
		<div class="form-group">
			<label>NIK</label>
			<input type="text" class="form-control" name="nik" value="<?php echo $data['nik'];?>">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo $data['email'];?>">
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>