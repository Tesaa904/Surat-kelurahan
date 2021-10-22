<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="del"){
		
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_akun_penduduk where id_akun='$id'");
		
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=akun_penduduk_view&alert=4'</script>";
	}
?>