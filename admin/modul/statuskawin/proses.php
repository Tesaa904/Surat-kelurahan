<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_statuskawin order by cast(id_statuskawin as signed) desc limit 1"));
			$new_id = $last_record['id_statuskawin']+1;
			$statuskawin = $_POST['statuskawin'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_statuskawin (id_statuskawin, nama_statuskawin) values ('$new_id','$statuskawin')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=statuskawin_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$statuskawin = $_POST['statuskawin'];
			
			$sql_save = mysqli_query($mysqli,"update m_statuskawin set nama_statuskawin = '$statuskawin' where id_statuskawin='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=statuskawin_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_statuskawin where id_statuskawin='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=statuskawin_view&alert=4'</script>";
	}
?>