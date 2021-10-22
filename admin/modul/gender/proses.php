<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_gender order by cast(id_gender as signed) desc limit 1"));
			$new_id = $last_record['id_gender']+1;
			$gender = $_POST['gender'];
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_gender (id_gender, nama_gender) values ('$new_id','$gender')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=gender_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$gender = $_POST['gender'];
			
			$sql_save = mysqli_query($mysqli,"update m_gender set nama_gender = '$gender' where id_gender='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=gender_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_gender where id_gender='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=gender_view&alert=4'</script>";
	}
?>