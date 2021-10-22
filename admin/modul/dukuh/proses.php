<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_dukuh order by cast(id_dukuh as signed) desc limit 1"));
			$new_id = $last_record['id_dukuh']+1;
			$dukuh = $_POST['dukuh'];
			$rt	= $_POST['rt'];
			$rw = $_POST['rw'];


			$sql_save = mysqli_query($mysqli,"INSERT INTO m_dukuh (id_dukuh, nama_dukuh,rt,rw) values ('$new_id','$dukuh','$rt','$rw')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=dukuh_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$dukuh = $_POST['dukuh'];
			$rt = $_POST['rt'];
			$rw = $_POST['rw'];
			
			$sql_save = mysqli_query($mysqli,"update m_dukuh set nama_dukuh='$dukuh', rt='$rt', rw='$rw' where id_dukuh='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=dukuh_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_dukuh where id_dukuh='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=dukuh_view&alert=4'</script>";
	}
?>