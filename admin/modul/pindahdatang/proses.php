<?php
	session_start();
	include "../../config/database.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if(isset($_POST['simpan'])){ 
			$id_datang= $_POST['id_datang']; 
			$no_kk= $_POST['no_kk'];
			$nama_kepala_keluarga= $_POST['nama_kepala_keluarga'];
			$id_propinsi_asal= $_POST['id_propinsi_asal'];
			$id_kabkota_asal= $_POST['id_kabkota_asal'];
			$id_kecamatan_asal= $_POST['id_kecamatan_asal'];
			$id_kelurahan_asal= $_POST['id_kelurahan_asal'];
			$dukuh_asal= $_POST['dukuh_asal']; 
			$rt_asal= $_POST['rt_asal'];
			$rw_asal= $_POST['rw_asal'];
			$kode_pos= $_POST['kode_pos'];
			$telpon= $_POST['telpon'];
			$id_alasan_pindah= $_POST['id_alasan_pindah'];
			$id_klasifikasi_pindah= $_POST['id_klasifikasi_pindah'];
			$id_jenis_pindh= $_POST['id_jenis_pindh'];
			$id_status_kk_tdkpindh= $_POST['id_status_kk_tdkpindh'];
			$id_status_kk_pindh= $_POST['id_status_kk_pindh'];
			$tgl_datang = $_POST['tgl_datang'];
			$nik= $_POST['nik'];
			$nama= $_POST['nama'];
			$nik_kel2= $_POST['nik_kel2'];
			$nama_kel2= $_POST['nama_kel2'];
			$nik_kel3= $_POST['nik_kel3'];
			$nama_kel3= $_POST['nama_kel3'];
			$nik_kel4= $_POST['nik_kel4'];
			$nama_kel4= $_POST['nama_kel4'];
			$nik_kel5= $_POST['nik_kel5'];
			$nama_kel5= $_POST['nama_kel5'];
			$id_dukuh = $_POST['id_dukuh'];
                        $id_status_surat= $_POST['id_status_surat'];
			$tgl_surat_datang= date("Y-m-d H:i:s");
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_pindah_datang WHERE nik='$nik'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=pindahdatang_view';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratdatang']['name'];
				$namaSementara = $_FILES['file_suratdatang']['tmp_name'];
				
				//nama file baru
				$ext = end(explode('.', $namaFile));
				$newName = $id_datang.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../file/surat_datang/"; 
				$url = $dirUpload.$newName;
				$url_db = "file/surat_datang/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_pindah_datang(id_datang,no_kk,nama_kepala_keluarga,id_propinsi_asal,id_kabkota_asal,id_kecamatan_asal,id_kelurahan_asal,dukuh_asal,rt_asal,rw_asal,
									kode_pos,telpon,id_alasan_pindah,id_klasifikasi_pindah,id_jenis_pindh,id_status_kk_tdkpindh,id_status_kk_pindh,tgl_datang,nik,nama,nik_kel2,nama_kel2,nik_kel3,nama_kel3,nik_kel4,nama_kel4,nik_kel5,nama_kel5,id_dukuh,id_status_surat,tgl_surat_datang,suratdatang)
									VALUES ('$id_datang','$no_kk','$nama_kepala_keluarga','$id_propinsi_asal','$id_kabkota_asal','$id_kecamatan_asal','$id_kelurahan_asal','$dukuh_asal','$rt_asal','$rw_asal',
									'$kode_pos','$telpon','$id_alasan_pindah','$id_klasifikasi_pindah','$id_jenis_pindh','$id_status_kk_tdkpindh','$id_status_kk_pindh','$tgl_datang','$nik','$nama','$nik_kel2','$nama_kel2','$nik_kel3','$nama_kel3','$nik_kel4','$nama_kel4','$nik_kel5','$nama_kel5','$id_dukuh','$id_status_surat','$tgl_surat_datang','$url_db')");
					
					//save tb penduduk
				$save_penduduk = mysqli_query($mysqli,"insert into m_penduduk (nik, nama, no_kk, id_dukuh,id_datang)	VALUES('$nik','$nama','$no_kk','$id_dukuh','$id_datang')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location.href='../../main.php?modul=pindahdatang_view';
					</script>";
				}
			}
		}
	} else if ($get_act=="verif") {
		$id = $_GET['id'];
		$cek = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.id_datang,a.id_akun,b.nik,b.email
														from surat_pindah_datang a inner join m_akun_penduduk b on a.id_akun=b.id_akun
														where a.id_datang='$id'"));		
		$sql_save = mysqli_query($mysqli,"update surat_pindah_datang set id_status_surat='2' where id_datang='$id'");
		
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
			$save_penduduk = mysqli_query($mysqli,"insert into m_penduduk (nik, nama, no_kk, id_dukuh, id_datang)	(SELECT a.nik,a.nama,a.no_kk,a.id_dukuh,a.id_datang
				FROM surat_pindah_datang a WHERE a.id_datang='$id')");
			if ($save_penduduk)
				echo "<script>window.location.href='../../main.php?modul=pindahdatang_view';</script>";

} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from surat_pindah_datang where id_datang='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=pindahdatang_view&alert=4'</script>";

	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id= $_POST['id']; 
			$no_kk= $_POST['no_kk'];
			$nama_kepala_keluarga= $_POST['nama_kepala_keluarga'];
			$id_propinsi_asal= $_POST['id_propinsi_asal'];
			$id_kabkota_asal= $_POST['id_kabkota_asal'];
			$id_kecamatan_asal= $_POST['id_kecamatan_asal'];
			$id_kelurahan_asal= $_POST['id_kelurahan_asal'];
			$dukuh_asal= $_POST['dukuh_asal']; 
			$rt_asal= $_POST['rt_asal'];
			$rw_asal= $_POST['rw_asal'];
			$kode_pos= $_POST['kode_pos'];
			$telpon= $_POST['telpon'];
			$id_alasan_pindah= $_POST['id_alasan_pindah'];
			$id_klasifikasi_pindah= $_POST['id_klasifikasi_pindah'];
			$id_jenis_pindh= $_POST['id_jenis_pindh'];
			$id_status_kk_tdkpindh= $_POST['id_status_kk_tdkpindh'];
			$id_status_kk_pindh= $_POST['id_status_kk_pindh'];
			$tgl_datang = $_POST['tgl_datang'];
			$nik= $_POST['nik'];
			$nama= $_POST['nama'];
			$nik_kel2= $_POST['nik_kel2'];
			$nama_kel2= $_POST['nama_kel2'];
			$nik_kel3= $_POST['nik_kel3'];
			$nama_kel3= $_POST['nama_kel3'];
			$nik_kel4= $_POST['nik_kel4'];
			$nama_kel4= $_POST['nama_kel4'];
			$nik_kel5= $_POST['nik_kel5'];
			$nama_kel5= $_POST['nama_kel5'];
			$id_dukuh = $_POST['id_dukuh'];

			$sql_save = mysqli_query($mysqli,"update surat_pindah_datang set no_kk='$no_kk',nama_kepala_keluarga='$nama_kepala_keluarga',id_propinsi_asal='$id_propinsi_asal',id_kabkota_asal='$id_kabkota_asal',id_kecamatan_asal='$id_kecamatan_asal',id_kelurahan_asal='$id_kelurahan_asal',dukuh_asal='$dukuh_asal',rt_asal='$rt_asal',rw_asal='$rw_asal',
									kode_pos='$kode_pos',telpon='$telpon',id_alasan_pindah='$id_alasan_pindah',id_klasifikasi_pindah='$id_klasifikasi_pindah',id_jenis_pindh='$id_jenis_pindh',id_status_kk_tdkpindh='$id_status_kk_tdkpindh',id_status_kk_pindh='$id_status_kk_pindh',tgl_datang='$tgl_datang',nik='$nik',nama='$nama',nik_kel2='$nik_kel2',nama_kel2='$nama_kel2',nik_kel3='$nik_kel3',nama_kel3='$nama_kel3',nik_kel4='$nik_kel4',nama_kel4='$nama_kel4',nik_kel5='$nik_kel5',nama_kel5='$nama_kel5',id_dukuh='$id_dukuh' where id_datang='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=pindahdatang_view&alert=3'</script>";

		}
	}
?>