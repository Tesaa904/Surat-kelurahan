<?php
	include "../../config/database.php";
	$get_act = $_GET['act'];
	 
	if ($get_act=="add"){
		if (isset($_POST['simpan'])){
			$last_record = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_penduduk order by cast(id_penduduk as signed) desc limit 1"));
			$new_id = $last_record['id_penduduk']+1;
			$nik = $_POST['nik'];
			$nama = $_POST['nama'];
			$tmpt_lahir = $_POST['tmpt_lahir'];
			$tgl_lahir = $_POST['tgl_lahir'];
			$id_gender = $_POST['id_gender'];
			$id_goldarah = $_POST['id_goldarah'];
			$id_agama = $_POST['id_agama'];
			$id_pendidikan = $_POST['id_pendidikan'];
			$id_statuskawin = $_POST['id_statuskawin'];
			$id_pekerjaan = $_POST['id_pekerjaan'];
			$id_warganegara = $_POST['id_warganegara'];
			$no_kk = $_POST['no_kk'];
			$id_shdk = $_POST['id_shdk'];
			$id_dukuh = $_POST['id_dukuh'];
			$tgl_masuk= date("Y-m-d H:i:s");
			
			$sql_save = mysqli_query($mysqli,"INSERT INTO m_penduduk (id_penduduk, nik,nama,tmpt_lahir,tgl_lahir,id_gender,id_goldarah,id_agama,id_pendidikan,id_statuskawin,id_pekerjaan,id_warganegara,no_kk,id_shdk,id_dukuh,tgl_masuk) values ('$new_id','$nik','$nama','$tmpt_lahir','$tgl_lahir','$id_gender','$id_goldarah','$id_agama','$id_pendidikan','$id_statuskawin','$id_pekerjaan','$id_warganegara','$no_kk','$id_shdk','$id_dukuh','$tgl_masuk')");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=penduduk_view&alert=3'</script>";
		}
	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id = $_POST['id'];
			$nik = $_POST['nik'];
			$nama = $_POST['nama'];
			$tmpt_lahir = $_POST['tmpt_lahir'];
			$tgl_lahir = $_POST['tgl_lahir'];
			$id_gender = $_POST['id_gender'];
			$id_goldarah = $_POST['id_goldarah'];
			$id_agama = $_POST['id_agama'];
			$id_pendidikan = $_POST['id_pendidikan'];
			$id_statuskawin = $_POST['id_statuskawin'];
			$id_pekerjaan = $_POST['id_pekerjaan'];
			$id_warganegara = $_POST['id_warganegara'];
			$no_kk = $_POST['no_kk'];
			$id_shdk = $_POST['id_shdk'];
			$id_dukuh = $_POST['id_dukuh'];
			
			$sql_save = mysqli_query($mysqli,"update m_penduduk set nik = '$nik',nama ='$nama',tmpt_lahir ='$tmpt_lahir',tgl_lahir ='$tgl_lahir',id_gender ='$id_gender',id_goldarah ='$id_goldarah',id_agama ='$id_agama',id_pendidikan ='$id_pendidikan',id_statuskawin ='$id_statuskawin',id_pekerjaan ='$id_pekerjaan',id_warganegara ='$id_warganegara',no_kk ='$no_kk',id_shdk ='$id_shdk',id_dukuh ='$id_dukuh' where id_penduduk='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=penduduk_view&alert=3'</script>";
		}
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from m_penduduk where id_penduduk='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=penduduk_view&alert=4'</script>";
	}
?>