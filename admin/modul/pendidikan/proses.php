<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_pendidikan order by cast(id_pendidikan as signed) desc limit 1"));
			$new_id = $last_record['id_pendidikan']+1;
			$pendidikan = $_POST['pendidikan'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_pendidikan (id_pendidikan, nama_pendidikan) values ('$new_id','$pendidikan')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pendidikan_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$pendidikan = $_POST['pendidikan'];
			
			$sql_save = mysqli_query($mysqli,"update m_pendidikan set nama_pendidikan = '$pendidikan' where id_pendidikan='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pendidikan_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_pendidikan where id_pendidikan='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=pendidikan_view&alert=4'</script>";
	}
?>