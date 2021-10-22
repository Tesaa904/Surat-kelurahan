 <?php
	session_start();
	include "../../config/database.php";
	include "../../config/function.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if(isset($_POST['simpan'])){ 
			$id_lahir= $_POST['id_lahir'];
                        $no_surat_lahir= $_POST['no_surat_lahir'];
			$nik_kpl_kel= $_POST['nik_kpl_kel'];
			$nama= $_POST['nama'];
			$tmpt_lahir= $_POST['tmpt_lahir'];
			$hari= $_POST['hari'];
			$tgl_lahir= $_POST['tgl_lahir'];
			$id_gender= $_POST['id_gender'];
			$pukul= $_POST['pukul'];
			$jenis_lahir= $_POST['jenis_lahir'];
			$tmp_dilahir= $_POST['tmp_dilahir'];
			$anak_ke= $_POST['anak_ke'];
			$penolong= $_POST['penolong'];
			$berat= $_POST['berat'];
			$panjang= $_POST['panjang'];
			$nik_ibu= $_POST['nik_ibu'];
			$nik_ayah= $_POST['nik_ayah'];
			$tgl_nikah = $_POST['tgl_nikah'];
			$nik_pl= $_POST['nik_pl'];
			$nik_sk1= $_POST['nik_sk1'];
			$nik_sk2= $_POST['nik_sk2'];
			$id_dukuh = $_POST['id_dukuh'];
                        $id_status_surat = $_POST['id_status_surat'];
			$tglsurat= date("Y-m-d H:i:s");
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_lahir WHERE nama='$nama'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=ketlahir_view';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratlahir']['name'];
				$namaSementara = $_FILES['file_suratlahir']['tmp_name'];
				
				//nama file baru
				$ext = end(explode('.', $namaFile));
				$newName = $id_lahir.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../file/surat_lahir/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_lahir/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_lahir(id_lahir,no_surat_lahir,nik_kepala_keluarga,nama,tempat_lahir,hari,tgl_lahir,id_gender,pukul,id_jenis_lahir,
									id_tempat_lahir,anak_ke,id_penolong,berat,panjang,nik_ibu,nik_ayah,tgl_nikah,nik_pelapor,nik_saksi1,nik_saksi2,id_dukuh,id_status_surat,tgl_surat,suratlahir)
									VALUES ('$id_lahir','$no_surat_lahir','$nik_kpl_kel','$nama','$tmpt_lahir','$hari','$tgl_lahir','$id_gender','$pukul','$jenis_lahir',
									'$tmp_dilahir','$anak_ke','$penolong','$berat','$panjang','$nik_ibu','$nik_ayah','$tgl_nikah','$nik_pl','$nik_sk1','$nik_sk2','$id_dukuh','2',
									'$tglsurat','$url_db')");
				//save tb penduduk
				$save_penduduk = mysqli_query($mysqli,"insert into m_penduduk (nama, tmpt_lahir, tgl_lahir, id_gender, no_kk, id_shdk, id_dukuh,id_lahir)	VALUES('$nama','$tmpt_lahir','$tgl_lahir','$id_gender','".nokk($nik_kpl_kel)."','4','$id_dukuh','$id_lahir')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location.href='../../main.php?modul=ketlahir_view';
					</script>";
				}
			}
		}
	} else if ($get_act=="verif") {
		$id = $_GET['id'];
		$cek = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.id_lahir,a.id_akun,b.nik,b.email
														from surat_lahir a inner join m_akun_penduduk b on a.id_akun=b.id_akun
														where a.id_lahir='$id'"));		
		$sql_save = mysqli_query($mysqli,"update surat_lahir set id_status_surat='2' where id_lahir='$id'");
		
		if ($sql_save)
			//Kirim Email
			$from = $mail_sender;
			$to = $cek['email'];
			$subject = "Permintaan Diverifikasi";

			$message = "Permintaan anda berhasil diverifikasi oleh admin. Silahkan ambil surat anda di Kantor Kelurahan Kraguman dengan membawa bukti surat fisik keterangan dari RT/RW maupun pihak terkait pada Jam Kerja. Terima Kasih";

			$headers = "From:" . $from;

			//proses kirim
			$send_mail = mail($to,$subject,$message, $headers);	
			
			//save tb penduduk
			$save_penduduk = mysqli_query($mysqli,"insert into m_penduduk (nama, tmpt_lahir, tgl_lahir, id_gender, no_kk, id_shdk, id_dukuh,id_lahir)	(SELECT a.nama,a.tempat_lahir,a.tgl_lahir,a.id_gender,(SELECT no_kk FROM m_penduduk WHERE nik=a.nik_kepala_keluarga) AS 'no_kk',
				'4' AS 'id_shdk',a.id_dukuh,a.id_lahir
				FROM surat_lahir a WHERE a.id_lahir='$id')");
			if ($save_penduduk)
				echo "<script>window.location.href='../../main.php?modul=ketlahir_view';</script>";
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from surat_lahir where id_lahir='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=ketlahir_view&alert=4'</script>";

	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id= $_POST['id'];
			$no_surat_lahir= $_POST['no_surat_lahir']; 
			$nik_kepala_keluarga= $_POST['nik_kepala_keluarga'];
			$nama= $_POST['nama'];
			$tempat_lahir= $_POST['tempat_lahir'];
			$tgl_lahir= $_POST['tgl_lahir'];
			$pukul= $_POST['pukul'];
			$hari= $_POST['hari'];
			$anak_ke= $_POST['anak_ke'];
			$id_gender= $_POST['id_gender'];
			$id_jenis_lahir= $_POST['id_jenis_lahir'];
			$id_tempat_lahir= $_POST['id_tempat_lahir'];
			$id_penolong= $_POST['id_penolong'];
			$berat= $_POST['berat'];
			$panjang= $_POST['panjang'];
			$nik_ibu= $_POST['nik_ibu'];
			$tgl_nikah = $_POST['tgl_nikah'];
			$nik_ayah= $_POST['nik_ayah'];
			$nik_pl= $_POST['nik_pl'];
			$nik_sk1= $_POST['nik_sk1'];
			$nik_sk2= $_POST['nik_sk2'];
			$id_dukuh = $_POST['id_dukuh'];

			$sql_save = mysqli_query($mysqli,"update surat_lahir set no_surat_lahir = '$no_surat_lahir',nik_kepala_keluarga = '$nik_kepala_keluarga',nama ='$nama',tempat_lahir ='$tempat_lahir',tgl_lahir ='$tgl_lahir',pukul ='$pukul',hari ='$hari',anak_ke ='$anak_ke',id_gender ='$id_gender',id_jenis_lahir ='$id_jenis_lahir',id_tempat_lahir ='$id_tempat_lahir',id_penolong ='$id_penolong',berat='$berat',panjang='$panjang',nik_ibu ='$nik_ibu',tgl_nikah='$tgl_nikah',nik_ayah='$nik_ayah',nik_pelapor ='$nik_pl',nik_saksi1 ='$nik_sk1',nik_saksi2='$nik_sk2',id_dukuh ='$id_dukuh' where id_lahir='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=ketlahir_view&alert=3'</script>";


	}
}
?>