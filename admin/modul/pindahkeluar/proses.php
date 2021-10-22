<?php
	session_start();
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if(isset($_POST['simpan'])){ 
			$id_luar= $_POST['id_luar']; 
			$nik_kepala_kel= $_POST['nik_kepala_kel'];
			$nik= $_POST['nik'];
			$id_alasan_pindah= $_POST['id_alasan_pindah'];
			$id_klasifikasi_pindh= $_POST['id_klasifikasi_pindh'];
			$id_jenis_pindh= $_POST['id_jenis_pindh'];
			$tgl_rencana_pindah= $_POST['tgl_rencana_pindah'];
			$id_status_kk_tdkpindh= $_POST['id_status_kk_tdkpindh'];
			$id_status_kk_pindh= $_POST['id_status_kk_pindh'];
			$id_propinsi_tujuan= $_POST['id_propinsi_tujuan'];
			$id_kabkota_tujuan= $_POST['id_kabkota_tujuan'];
			$id_kecamatan_tujuan= $_POST['id_kecamatan_tujuan'];
			$id_kelurahan_tujuan= $_POST['id_kelurahan_tujuan'];
			$dukuh_tujuan= $_POST['dukuh_tujuan'];
			$rt_tujuan= $_POST['rt_tujuan'];
			$rw_tujuan = $_POST['rw_tujuan'];
			$nik_kel1= $_POST['nik_kel1'];
			$nik_kel2= $_POST['nik_kel2'];
			$nik_kel3= $_POST['nik_kel3'];
			$nik_kel4 = $_POST['nik_kel4'];
			$nik_kel5 = $_POST['nik_kel5'];
                        $id_status_surat = $_POST['id_status_surat'];
			$tgl_surat_luar= date("Y-m-d H:i:s");
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_pindah_luar WHERE nik='$nik'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=pindahkeluar_view';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratkeluar']['name'];
				$namaSementara = $_FILES['file_suratkeluar']['tmp_name'];
				
				//nama file baru
				$ext = end(explode('.', $namaFile));
				$newName = $id_luar.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../file/surat_keluar/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_keluar/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_pindah_luar(id_luar,nik_kepala_kel,nik,id_alasan_pindah,id_klasifikasi_pindh,id_jenis_pindh,tgl_rencana_pindah,
									id_status_kk_tdkpindh,id_status_kk_pindh,id_propinsi_tujuan,id_kabkota_tujuan,id_kecamatan_tujuan,id_kelurahan_tujuan,dukuh_tujuan,rt_tujuan,rw_tujuan,nik_kel1,nik_kel2,nik_kel3,nik_kel4,nik_kel5,id_status_surat,tgl_surat_luar,suratkeluar)
									VALUES ('$id_luar','$nik_kepala_kel','$nik','$id_alasan_pindah','$id_klasifikasi_pindh','$id_jenis_pindh','$tgl_rencana_pindah',
									'$id_status_kk_tdkpindh','$id_status_kk_pindh','$id_propinsi_tujuan','$id_kabkota_tujuan','$id_kecamatan_tujuan','$id_kelurahan_tujuan','$dukuh_tujuan','$rt_tujuan','$rw_tujuan','$nik_kel1','$nik_kel2','$nik_kel3','$nik_kel4','$nik_kel5','$id_status_surat','$tgl_surat_luar','$url_db')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location.href='../../main.php?modul=pindahkeluar_view';
					</script>";
				}
			}
		}
	} else if ($get_act=="verif") {
		$id = $_GET['id'];
		
		$cek =mysqli_fetch_array(mysqli_query($mysqli,"select * from surat_pindah_luar where id_luar='$id'"));

		$cek_email = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.id_luar,a.id_akun,b.nik,b.email
														from surat_pindah_luar a inner join m_akun_penduduk b on a.id_akun=b.id_akun
														where a.id_luar='$id'"));
		
		$sql_save = mysqli_query($mysqli,"update surat_pindah_luar set id_status_surat='2' where id_luar='$id'");
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
			
			echo "<script>window.location.href='../../main.php?modul=pindahkeluar_view';</script>";
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from surat_pindah_luar where id_luar='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=pindahkeluar_view&alert=4'</script>";

	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id= $_POST['id']; 
			$nik_kepala_kel= $_POST['nik_kepala_kel'];
			$nik= $_POST['nik'];
			$id_alasan_pindah= $_POST['id_alasan_pindah'];
			$id_klasifikasi_pindh= $_POST['id_klasifikasi_pindh'];
			$id_jenis_pindh= $_POST['id_jenis_pindh'];
			$tgl_rencana_pindah= $_POST['tgl_rencana_pindah'];
			$id_status_kk_tdkpindh= $_POST['id_status_kk_tdkpindh'];
			$id_status_kk_pindh= $_POST['id_status_kk_pindh'];
			$id_propinsi_tujuan= $_POST['id_propinsi_tujuan'];
			$id_kabkota_tujuan= $_POST['id_kabkota_tujuan'];
			$id_kecamatan_tujuan= $_POST['id_kecamatan_tujuan'];
			$id_kelurahan_tujuan= $_POST['id_kelurahan_tujuan'];
			$dukuh_tujuan= $_POST['dukuh_tujuan'];
			$rt_tujuan= $_POST['rt_tujuan'];
			$rw_tujuan = $_POST['rw_tujuan'];
			$nik_kel1= $_POST['nik_kel1'];
			$nik_kel2= $_POST['nik_kel2'];
			$nik_kel3= $_POST['nik_kel3'];
			$nik_kel4 = $_POST['nik_kel4'];
			$nik_kel5 = $_POST['nik_kel5'];

			$sql_save = mysqli_query($mysqli,"update surat_pindah_luar set nik_kepala_kel ='$nik_kepala_kel',nik ='$nik',id_alasan_pindah ='$id_alasan_pindah',id_klasifikasi_pindh ='$id_klasifikasi_pindh',id_jenis_pindh ='$id_jenis_pindh',tgl_rencana_pindah ='$tgl_rencana_pindah',id_status_kk_tdkpindh ='$id_status_kk_tdkpindh',id_status_kk_pindh ='$id_status_kk_pindh',id_propinsi_tujuan ='$id_propinsi_tujuan',id_kabkota_tujuan='$id_kabkota_tujuan',id_kecamatan_tujuan ='$id_kecamatan_tujuan',id_kelurahan_tujuan ='$id_kelurahan_tujuan',dukuh_tujuan ='$dukuh_tujuan',rt_tujuan ='$rt_tujuan',rw_tujuan ='$rw_tujuan',nik_kel1 ='$nik_kel1',nik_kel2='$nik_kel2',nik_kel3 ='$nik_kel3',nik_kel4 ='$nik_kel4',nik_kel5='$nik_kel5' where id_luar='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pindahkeluar_view&alert=3'</script>";

		}
	}
?>