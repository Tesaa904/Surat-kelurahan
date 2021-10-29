<?php
	session_start();
	include "../../config/koneksi.php";
	
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
		$tgl_surat_datang= date("Y-m-d H:i:s");
	    $id_akun = $_SESSION['id_akun'];
	   
		$input = mysqli_query($mysqli,"SELECT * FROM surat_pindah_datang WHERE nik='$nik'");
		
		$jml = mysqli_num_rows($input);
		
		if ( $jml>= 1){
			?>
			<script type="text/javascript">
					alert('Maaf, data sudah ada');
					window.location='main.php?modul=pindahdatang';
			</script>
			<?php

		}else {
			// ambil data file
			$namaFile = $_FILES['file_suratdatang']['name'];
			$namaSementara = $_FILES['file_suratdatang']['tmp_name'];
			
			//nama file baru
			//$ext = pathinfo($namaFile, PATHINFO_EXTENSION);
			$exploded = explode('.', $namaFile);
			$ext = strtolower(end($exploded));	
				
			$newName = $id_datang.".".$ext;
			
			// tentukan lokasi file akan dipindahkan 
			$dirUpload = "../../admin/file/surat_datang/"; 
			$url = $dirUpload.$newName;
			$url_db = "file/surat_datang/".$newName;

			// pindahkan file
			$terupload = move_uploaded_file($namaSementara, $url);            
			
			$simpan= mysqli_query($mysqli,"INSERT INTO surat_pindah_datang(id_datang,no_kk,nama_kepala_keluarga,id_propinsi_asal,id_kabkota_asal,id_kecamatan_asal,id_kelurahan_asal,dukuh_asal,rt_asal,rw_asal,
								kode_pos,telpon,id_alasan_pindah,id_klasifikasi_pindah,id_jenis_pindh,id_status_kk_tdkpindh,id_status_kk_pindh,tgl_datang,nik,nama,nik_kel2,nama_kel2,nik_kel3,nama_kel3,nik_kel4,nama_kel4,nik_kel5,nama_kel5,id_dukuh,tgl_surat_datang,suratdatang,id_akun,id_status_surat)
								VALUES ('$id_datang','$no_kk','$nama_kepala_keluarga','$id_propinsi_asal','$id_kabkota_asal','$id_kecamatan_asal','$id_kelurahan_asal','$dukuh_asal','$rt_asal','$rw_asal',
								'$kode_pos','$telpon','$id_alasan_pindah','$id_klasifikasi_pindah','$id_jenis_pindh','$id_status_kk_tdkpindh','$id_status_kk_pindh','$tgl_datang','$nik','$nama','$nik_kel2','$nama_kel2','$nik_kel3','$nama_kel3','$nik_kel4','$nama_kel4','$nik_kel5','$nama_kel5','$id_dukuh','$tgl_surat_datang','$url_db','$id_akun','1')");
				
			if($simpan) { 
				echo "<script>
					window.alert('Data Berhasil Disimpan.(*)Tunggu konfirmasinya melalui email anda dan CEk pada folder bagian SPAM');
					window.location.href='../../main.php?modul=surat_datang';
				</script>";
			} else {
				echo "INSERT INTO surat_Pindah_datang(id_datang,no_kk,nama_kepala_keluarga,id_propinsi_asal,id_kabkota_asal,id_kecamatan_asal,id_kelurahan_asal,dukuh_asal,rt_asal,rw_asal,
								kode_pos,telpon,id_alasan_pindah,id_klasifikasi_pindah,id_jenis_pindh,id_status_kk_tdkpindh,id_status_kk_pindh,tgl_datang,nik,nama,nik_kel2,nama_kel2,nik_kel3,nama_kel3,nik_kel4,nama_kel4,nik_kel5,nama_kel5,id_dukuh,tgl_surat_datang,suratdatang,id_akun,id_status_surat)
								VALUES ('$id_datang','$no_kk','$nama_kepala_keluarga','$id_propinsi_asal','$id_kabkota_asal','$id_kecamatan_asal','$id_kelurahan_asal','$dukuh_asal','$rt_asal','$rw_asal',
								'$kode_pos','$telpon','$id_alasan_pindah','$id_klasifikasi_pindah','$id_jenis_pindh','$id_status_kk_tdkpindh','$id_status_kk_pindh','$tgl_datang','$nik','$nama','$nik_kel2','$nama_kel2','$nik_kel3','$nama_kel3','$nik_kel4','$nama_kel4','$nik_kel5','$nama_kel5','$id_dukuh','$tgl_surat_datang','$url_db','$id_akun','1')";
			}
		}
	}
?>