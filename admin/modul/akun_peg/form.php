	<script>
	  $( function() {
		$( ".datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true			
		});
		$('.datepicker').css("z-index","0");
		$('.select2').select2({
			width:'100%'
		});
	  } );
	</script>
<?php
	include "../../config/database.php";
	$get_mode = $_GET['mode'];
	if ($get_mode=="add"){
?>
	<form method="POST" action="modul/akun_peg/proses.php?act=add">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="username">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password">
		</div>
		<div class="form-group">
			<label>Level User</label>
			<select name="level" class="form-control select2">
				<?php
					$sql_level = mysqli_query($mysqli,"select * from m_level order by id_level asc");
					while ($level = mysqli_fetch_array($sql_level)){
						echo "<option value='$level[id_level]'>$level[nama_level]</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	} else if ($get_mode="edit"){
		$get_id = $_GET['id'];
		$id = "US".str_pad($get_id, 3, "0", STR_PAD_LEFT);
		$data = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_user where id_user='$id'"));
?>
	<form method="POST" action="modul/akun_peg/proses.php?act=edit">
		<div class="form-group">
			<label>Nama</label>
			<input type="hidden" class="form-control" name="id" value="<?php echo $data['id_user'];?>">
			<input type="text" class="form-control" name="nama" value="<?php echo $data['nama'];?>">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="username" value="<?php echo $data['username'];?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password" value="<?php echo base64_decode($data['password']);?>">
		</div>
		<div class="form-group">
			<label>Level User</label>
			<select name="level" class="form-control select2">
				<?php
					$sql_level = mysqli_query($mysqli,"select * from m_level order by id_level asc");
					while ($level = mysqli_fetch_array($sql_level)){
						if ($data['id_level']==$level['id_level'])
							$sel = "selected";
						else
							$sel = "";
						echo "<option value='$level[id_level]' $sel>$level[nama_level]</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</form>
<?php
	}
?>
