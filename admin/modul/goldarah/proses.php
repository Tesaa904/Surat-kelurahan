<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_goldarah order by cast(id_goldarah as signed) desc limit 1"));
			$new_id = $last_record['id_goldarah']+1;
			$goldarah = $_POST['goldarah'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_goldarah (id_goldarah, nama_goldarah) values ('$new_id','$goldarah')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=goldarah_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$goldarah = $_POST['goldarah'];
			
			$sql_save = mysqli_query($mysqli,"update m_goldarah set nama_goldarah = '$goldarah' where id_goldarah='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=goldarah_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_goldarah where id_goldarah='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=goldarah_view&alert=4'</script>";
	}
?>