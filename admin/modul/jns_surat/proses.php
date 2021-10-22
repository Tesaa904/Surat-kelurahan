<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_jenis_surat order by cast(id_jenis_surat as signed) desc limit 1"));
			$new_id = $last_record['id_jenis_surat']+1;
			$jns_surat = $_POST['jns_surat'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_jenis_surat (id_jenis_surat, nama_jenis_surat, keterangan) values ('$new_id','$jns_surat','$ketsurat')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=jns_surat_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$jns_surat = $_POST['jns_surat'];
			$ketsurat = $_POST['ketsurat'];

			$sql_save = mysqli_query($mysqli,"update m_jenis_surat set nama_jenis_surat = '$jns_surat',keterangan = '$ketsurat' where id_jenis_surat='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=jns_surat_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_jenis_surat where id_jenis_surat='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=jns_surat_view&alert=4'</script>";
	}
?>