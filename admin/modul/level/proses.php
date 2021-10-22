<?php
	include "../../config/database.php";
	$get_mode = $_GET['act'];
	
	if ($get_mode=="add"){
		if (isset($_POST['simpan'])){
			$id_level = $_POST['id_level'];
			$nama_level = $_POST['nama_level'];
			$count_akses = count($_POST['id_menu']);
			
			$sql_save = mysqli_query($mysqli,"insert into m_level(id_level,nama_level) values ('$id_level','$nama_level')");
			
			if ($sql_save){
				for ($i=0;$i<$count_akses;$i++){
					$save_akses = mysqli_query($mysqli,"insert into m_level_menu(id_level,id_menu) values ('$id_level','".$_POST['id_menu'][$i]."')");
				}
				echo "<script>window.location.href='../../main.php?modul=level_view&alert=3'</script>";
			}
			else 
				echo "insert into tb_level(id_level,nama_level) values ('$id_level','$nama_level')";
		}
	} else if ($get_mode=="edit"){
		if (isset($_POST['simpan'])){
			$id_level = $_POST['id_level_ed'];
			$nama_level = $_POST['nama_level_ed'];
			$count_akses = count($_POST['id_menu_ed']);
			
			$sql_save = mysqli_query($mysqli,"update m_level set nama_level='$nama_level' where id_level='$id_level'");
			$del_akses = mysqli_query($mysqli,"delete from m_level_menu where id_level='$id_level'");
			
			if ($del_akses){
				for ($i=0;$i<$count_akses;$i++){
					$save_akses = mysqli_query($mysqli,"insert into m_level_menu(id_level,id_menu) values ('$id_level','".$_POST['id_menu_ed'][$i]."')");
				}
				echo "<script>window.location.href='../../main.php?modul=level_view&alert=3'</script>";
			}
			else 
				echo "insert into tb_level(id_level,nama_level) values ('$id_level','$nama_level')";
		}		
	} else if ($get_mode=="del") {
		$id = $_GET['id'];
		
		$del = mysqli_query($mysqli,"delete from m_level where id_level='$id'");
		$del_akses = mysqli_query($mysqli,"delete from m_level_menu where id_level='$id'");
		
		if ($del)
			echo "<script>window.location.href='../../main.php?modul=level_view&alert=3'</script>";
	}
?>