<?php
	session_start();
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if(isset($_POST['simpan'])){ 
			$id_mati= $_POST['id_mati']; 
			$no_surat_mati= $_POST['no_surat_mati'];
			$nik_kepala_keluarga= $_POST['nik_kepala_keluarga'];
			$nik= $_POST['nik'];
			$anak_ke= $_POST['anak_ke'];
			$tgl_mati= $_POST['tgl_mati'];
			$waktu_mati= $_POST['waktu_mati'];
			$id_sebab_mati= $_POST['id_sebab_mati'];
			$tempat_mati= $_POST['tempat_mati'];
			$umur_mati= $_POST['umur_mati'];
			$id_penerang= $_POST['id_penerang'];
			$nik_ayah= $_POST['nik_ayah'];
			$nik_ibu= $_POST['nik_ibu'];
			$nik_pelapor= $_POST['nik_pelapor'];
			$nik_saksi1= $_POST['nik_saksi1'];
			$nik_saksi2= $_POST['nik_saksi2'];
                        $id_status_surat= $_POST['id_status_surat'];
			$tgl_surat= date("Y-m-d H:i:s");
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_mati WHERE nik='$nik'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=ketmati_view';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratmati']['name'];
				$namaSementara = $_FILES['file_suratmati']['tmp_name'];
				
				//nama file baru
				$ext = end(explode('.', $namaFile));
				$newName = $id_mati.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../file/surat_mati/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_mati/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_mati(id_mati,no_surat_mati,nik_kepala_keluarga,nik,anak_ke,tgl_mati,waktu_mati,id_sebab_mati,
									tempat_mati,umur_mati,id_penerang,nik_ayah,nik_ibu,nik_pelapor,nik_saksi1,nik_saksi2,id_status_surat,tgl_surat,suratmati)
									VALUES ('$id_mati','$no_surat_mati','$nik_kepala_keluarga','$nik','$anak_ke','$tgl_mati','$waktu_mati','$id_sebab_mati',
									'$tempat_mati','$umur_mati','$id_penerang','$nik_ayah','$nik_ibu','$nik_pelapor','$nik_saksi1','$nik_saksi2','$id_status_surat','$tgl_surat','$url_db')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location.href='../../main.php?modul=ketmati_view';
					</script>";
				}
			}
		}
	} else if ($get_act=="verif") {
		$id = $_GET['id'];
		$cek =mysqli_fetch_array(mysqli_query($mysqli,"select * from surat_mati where id_mati='$id'"));
		$cek_email = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.id_mati,a.id_akun,b.nik,b.email
														from surat_mati a inner join m_akun_penduduk b on a.id_akun=b.id_akun
														where a.id_mati='$id'"));
														
		$sql_save = mysqli_query($mysqli,"update surat_mati set id_status_surat='2' where id_mati='$id'");
		$sql_upd = mysqli_query($mysqli,"update m_penduduk set status='2' where nik='$cek[nik]'");
		
		if ($sql_save)
			//Kirim Email
			$from = $mail_sender;
			$to = $cek_email['email'];
			$subject = "Permintaan Diverifikasi";

			$message = "Permintaan anda berhasil diverifikasi oleh admin. Silahkan ambil surat anda di Kantor Kelurahan Kraguman dengan membawa bukti surat fisik keterangan dari RT/RW maupun pihak terkait pada Jam Kerja. Terima Kasih";

			$headers = "From:" . $from;

			//proses kirim
			$send_mail = mail($to,$subject,$message, $headers);				
			echo "<script>window.location.href='../../main.php?modul=ketmati_view';</script>";
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from surat_mati where id_mati='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=ketmati_view&alert=4'</script>";

	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id= $_POST['id']; 
			$no_surat_mati= $_POST['no_surat_mati'];
			$nik_kepala_keluarga= $_POST['nik_kepala_keluarga'];
			$nik= $_POST['nik'];
			$anak_ke= $_POST['anak_ke'];
			$tgl_mati= $_POST['tgl_mati'];
			$waktu_mati= $_POST['waktu_mati'];
			$id_sebab_mati= $_POST['id_sebab_mati'];
			$tempat_mati= $_POST['tempat_mati'];
			$umur_mati= $_POST['umur_mati'];
			$id_penerang= $_POST['id_penerang'];
			$nik_ayah= $_POST['nik_ayah'];
			$nik_ibu= $_POST['nik_ibu'];
			$nik_pelapor= $_POST['nik_pelapor'];
			$nik_saksi1= $_POST['nik_saksi1'];
			$nik_saksi2= $_POST['nik_saksi2'];

			$sql_save = mysqli_query($mysqli,"update surat_mati set no_surat_mati = '$no_surat_mati',nik_kepala_keluarga ='$nik_kepala_keluarga',nik ='$nik',anak_ke ='$anak_ke',tgl_mati ='$tgl_mati',waktu_mati ='$waktu_mati',id_sebab_mati ='$id_sebab_mati',
									tempat_mati ='$tempat_mati',umur_mati ='$umur_mati',id_penerang ='$id_penerang',nik_ayah ='$nik_ayah',nik_ibu ='$nik_ibu',nik_pelapor='$nik_pelapor',nik_saksi1='$nik_saksi1',nik_saksi2='$nik_saksi2' where id_mati='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=ketmati_view&alert=3'</script>";


	}
}
?>