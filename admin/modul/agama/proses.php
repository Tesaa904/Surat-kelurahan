<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_agama order by cast(id_agama as signed) desc limit 1"));
			$new_id = $last_record['id_agama']+1;
			$agama = $_POST['agama'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_agama (id_agama, nama_agama) values ('$new_id','$agama')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=agama_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$agama = $_POST['agama'];
			
			$sql_save = mysqli_query($mysqli,"update m_agama set nama_agama = '$agama' where id_agama='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=agama_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_agama where id_agama='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=agama_view&alert=4'</script>";
	}
?>