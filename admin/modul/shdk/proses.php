<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_shdk order by cast(id_shdk as signed) desc limit 1"));
			$new_id = $last_record['id_shdk']+1;
			$shdk = $_POST['shdk'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_shdk (id_shdk, nama_shdk) values ('$new_id','$shdk')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=shdk_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$shdk = $_POST['shdk'];
			
			$sql_save = mysqli_query($mysqli,"update m_shdk set nama_shdk = '$shdk' where id_shdk='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=shdk_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_shdk where id_shdk='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=shdk_view&alert=4'</script>";
	}
?>