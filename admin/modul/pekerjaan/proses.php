<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_pekerjaan order by cast(id_pekerjaan as signed) desc limit 1"));
			$new_id = $last_record['id_pekerjaan']+1;
			$pekerjaan = $_POST['pekerjaan'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_pekerjaan (id_pekerjaan, nama_pekerjaan) values ('$new_id','$pekerjaan')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pekerjaan_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$pekerjaan = $_POST['pekerjaan'];
			
			$sql_save = mysqli_query($mysqli,"update m_pekerjaan set nama_pekerjaan = '$pekerjaan' where id_pekerjaan='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pekerjaan_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_pekerjaan where id_pekerjaan='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=pekerjaan_view&alert=4'</script>";
	}
?>