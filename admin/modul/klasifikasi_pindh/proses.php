<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_klasifikasi_pindh order by cast(id_klasifikasi as signed) desc limit 1"));
			$new_id = $last_record['id_klasifikasi']+1;
			$klasifikasi = $_POST['klasifikasi'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_klasifikasi_pindh (id_klasifikasi, nama_klasifikasi) values ('$new_id','$klasifikasi')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=klasifikasi_pindh_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$klasifikasi = $_POST['klasifikasi'];
			
			$sql_save = mysqli_query($mysqli,"update m_klasifikasi_pindh set nama_klasifikasi = '$klasifikasi' where id_klasifikasi='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=klasifikasi_pindh_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_klasifikasi_pindh where id_klasifikasi='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=klasifikasi_pindh_view&alert=4'</script>";
	}
?>