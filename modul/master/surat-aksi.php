 <?php
	include "../../koneksi.php";
	$get_mode = $_GET['mode'];
	
	if ($get_mode=="edit"){
		if (isset($_POST['simpan'])){
			$id_surat = $_POST['id_surat'];
			$nm_surat = $_POST['nm_surat'];
			$keterangan = $_POST['keterangan'];
			
			$sql = mysql_query("update surat set nm_surat = '$nm_surat', keterangan = '$keterangan' where id_surat='$id_surat'");
			
			if ($sql){
				header("Location:../../index.php?modul=tmpl-surat&alert=1");
			} else {
				header("Location:../../index.php?modul=tmpl-surat&alert=2");
			}
		}
	} else 	if ($get_mode=="add"){
		if (isset($_POST['simpan'])){
			$id_surat = $_POST['id_surat'];
			$nm_surat = $_POST['nm_surat'];
			$keterangan = $_POST['keterangan'];
			
			$sql = mysql_query("insert into surat values('$id_surat','$nm_surat','$keterangan')");
			
			if ($sql){
				header("Location:../../index.php?modul=tmpl-surat&alert=1");
			} else {
				header("Location:../../index.php?modul=tmpl-surat&alert=2");
			}
		}
	} else if ($get_mode=="delete"){
		$id_surat = $_GET['id_surat'];
		
		$sql = mysql_query("delete from surat where Kd_kegiatan='$id'");
		
		if ($sql){
			header("Location:../../index.php?modul=Kegiatan&alert=3");
		} else {
			header("Location:../../index.php?modul=Kegiatan&alert=4");
		}
	}
?>