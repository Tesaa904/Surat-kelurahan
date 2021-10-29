<?php
	session_start();
	include "../../config/koneksi.php";
	
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
			$tgl_surat_luar= date("Y-m-d H:i:s");
	    $id_akun = $_SESSION['id_akun'];
	   
		$input = mysqli_query($mysqli,"SELECT * FROM surat_pindah_luar WHERE nik='$nik'");

		if (mysqli_num_rows($input) > 0){
			?>
			<script type="text/javascript">
					alert('Maaf, data sudah ada');
					window.location='main.php?modul=surat_keluar';
			</script>
			<?php

		}else {
			// ambil data file
				$namaFile = $_FILES['file_suratkeluar']['name'];
				$namaSementara = $_FILES['file_suratkeluar']['tmp_name'];
				
				//nama file baru
                                //$ext = pathinfo($namaFile, PATHINFO_EXTENSION);
                                $exploded = explode('.', $namaFile);
                                $ext = strtolower(end($exploded));	
                        
				$newName = $id_luar.".".$ext;
			
			// tentukan lokasi file akan dipindahkan
			$dirUpload = "../../admin/file/surat_keluar/"; 
			$url = $dirUpload.$newName;
			$url_db = "file/surat_keluar/".$newName;

			// pindahkan file
			$terupload = move_uploaded_file($namaSementara, $url);            
			
			$simpan= mysqli_query($mysqli,"INSERT INTO surat_pindah_luar(id_luar,nik_kepala_kel,nik,id_alasan_pindah,id_klasifikasi_pindh,id_jenis_pindh,tgl_rencana_pindah,
									id_status_kk_tdkpindh,id_status_kk_pindh,id_propinsi_tujuan,id_kabkota_tujuan,id_kecamatan_tujuan,id_kelurahan_tujuan,dukuh_tujuan,rt_tujuan,rw_tujuan,nik_kel1,nik_kel2,nik_kel3,nik_kel4,nik_kel5,tgl_surat_luar,suratkeluar,id_akun,id_status_surat)
								VALUES ('$id_luar','$nik_kepala_kel','$nik','$id_alasan_pindah','$id_klasifikasi_pindh','$id_jenis_pindh','$tgl_rencana_pindah',
									'$id_status_kk_tdkpindh','$id_status_kk_pindh','$id_propinsi_tujuan','$id_kabkota_tujuan','$id_kecamatan_tujuan','$id_kelurahan_tujuan','$dukuh_tujuan','$rt_tujuan','$rw_tujuan','$nik_kel1','$nik_kel2','$nik_kel3','$nik_kel4','$nik_kel5','$tgl_surat_luar','$url_db','$id_akun','1')");
				
			if($simpan) { 
				echo "<script>
					window.alert('Data Berhasil Disimpan.(*)Tunggu konfirmasinya melalui email anda dan CEk pada folder bagian SPAM');
					window.location.href='../../main.php?modul=surat_keluar';
				</script>";
                        } else {
				echo "INSERT INTO surat_pindah_luar(id_luar,nik_kepala_kel,nik,id_alasan_pindah,id_klasifikasi_pindh,id_jenis_pindh,tgl_rencana_pindah,
									id_status_kk_tdkpindh,id_status_kk_pindh,id_propinsi_tujuan,id_kabkota_tujuan,id_kecamatan_tujuan,id_kelurahan_tujuan,dukuh_tujuan,rt_tujuan,rw_tujuan,nik_kel1,nik_kel2,nik_kel3,nik_kel4,nik_kel5,tgl_surat_luar,suratkeluar,id_akun,id_status_surat)
								VALUES ('$id_luar','$nik_kepala_kel','$nik','$id_alasan_pindah','$id_klasifikasi_pindh','$id_jenis_pindh','$tgl_rencana_pindah',
									'$id_status_kk_tdkpindh','$id_status_kk_pindh','$id_propinsi_tujuan','$id_kabkota_tujuan','$id_kecamatan_tujuan','$id_kelurahan_tujuan','$dukuh_tujuan','$rt_tujuan','$rw_tujuan','$nik_kel1','$nik_kel2','$nik_kel3','$nik_kel4','$nik_kel5','$tgl_surat_luar','$url_db','$id_akun','1')";
                        }
		}
	}
?>