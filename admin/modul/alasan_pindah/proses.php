<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_alasan_pindah order by cast(id_alasan_pindah as signed) desc limit 1"));
			$new_id = $last_record['id_alasan_pindah']+1;
			$alasan_pindah = $_POST['alasan_pindah'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_alasan_pindah (id_alasan_pindah, nama_alasan_pindah) values ('$new_id','$alasan_pindah')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=alasan_pindah_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$alasan_pindah = $_POST['alasan_pindah'];
			
			$sql_save = mysqli_query($mysqli,"update m_alasan_pindah set nama_alasan_pindah = '$alasan_pindah' where id_alasan_pindah='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=alasan_pindah_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_alasan_pindah where id_alasan_pindah='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=alasan_pindah_view&alert=4'</script>";
	}
?>