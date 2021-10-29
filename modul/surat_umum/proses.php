<?php
	session_start();
	include "../../config/koneksi.php";
	$get_act = $_GET['act'];
	
	if ($get_act=="add"){
		if(isset($_POST['simpan'])){ 
			$id_ket_umum= $_POST['id_ket_umum']; 
			$no_surat_imb= $_POST['no_surat_imb'];
			$no_surat_skt= $_POST['no_surat_skt'];
			$no_surat_skd= $_POST['no_surat_skd'];
			$no_surat_skp= $_POST['no_surat_skp'];
			$no_surat_sir= $_POST['no_surat_sir'];
			$no_surat_sku= $_POST['no_surat_sku'];
			$nik= $_POST['nik'];
			$nik_ayah= $_POST['nik_ayah'];
			$nik_ibu= $_POST['nik_ibu'];
			$tgl_keperluan= $_POST['tgl_keperluan'];
			$pukul_kegiatan= $_POST['pukul_kegiatan'];
			$id_jenis_surat= $_POST['id_jenis_surat'];
			$keperluan= $_POST['keperluan'];
			$nama_usaha	=$_POST	['nama_usaha'];
			$alamat_usaha= $_POST['alamat_usaha'];
			$jenis_bangunan= $_POST['jenis_bangunan'];
			$letak= $_POST['letak'];
			$status_tanah= $_POST['status_tanah'];
			$data_ubah= $_POST['data_ubah'];
			$data_benar= $_POST['data_benar'];
			$penghasilan= $_POST['penghasilan'];
			$tgl_surat= date("Y-m-d H:i:s");
			 $id_akun = $_SESSION['id_akun'];
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_ket_umum WHERE id_ket_umum='$id_ket_umum'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=surat_umum';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratketumum']['name'];
				$namaSementara = $_FILES['file_suratketumum']['tmp_name'];
				
				//nama file baru
                                //$ext = pathinfo($namaFile, PATHINFO_EXTENSION);
                                $exploded = explode('.', $namaFile);
                                $ext = strtolower(end($exploded));
                        
				$newName = $id_ket_umum.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../admin/file/surat_ketumum/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_ketumum/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_ket_umum(id_ket_umum,no_surat_imb,no_surat_skt,no_surat_skd,no_surat_skp,no_surat_sir,no_surat_sku,nik,nik_ayah,nik_ibu,tgl_keperluan,pukul_kegiatan,id_jenis_surat,keperluan,nama_usaha,alamat_usaha,jenis_bangunan,letak,status_tanah,data_ubah,data_benar,penghasilan,tgl_surat,suratumum,id_akun) 
									VALUES ('$id_ket_umum','$no_surat_imb','$no_surat_skt','$no_surat_skd','$no_surat_skp','$no_surat_sir','$no_surat_sku','$nik','$nik_ayah','$nik_ibu','$tgl_keperluan','$pukul_kegiatan','$id_jenis_surat','$keperluan','$nama_usaha','$alamat_usaha','$jenis_bangunan','$letak','$status_tanah','$data_ubah','$data_benar','$penghasilan','$tgl_surat','$url_db','$id_akun')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan.(*)Tunggu konfirmasinya melalui email anda dan CEk pada folder bagian SPAM');
						window.location.href='../../main.php?modul=surat_umum';
					</script>";
				} else {
				echo "INSERT INTO surat_ket_umum(id_ket_umum,no_surat_imb,no_surat_skt,no_surat_skd,no_surat_skp,no_surat_sir,no_surat_sku,nik,nik_ayah,nik_ibu,tgl_keperluan,pukul_kegiatan,id_jenis_surat,keperluan,nama_usaha,alamat_usaha,jenis_bangunan,letak,status_tanah,data_ubah,data_benar,penghasilan,tgl_surat,suratumum,id_akun) 
									VALUES ('$id_ket_umum','$no_surat_imb','$no_surat_skt','$no_surat_skd','$no_surat_skp','$no_surat_sir','$no_surat_sku','$nik','$nik_ayah','$nik_ibu','$tgl_keperluan','$pukul_kegiatan','$id_jenis_surat','$keperluan','$nama_usaha','$alamat_usaha','$jenis_bangunan','$letak','$status_tanah','$data_ubah','$data_benar','$penghasilan','$tgl_surat','$url_db','$id_akun')";
                                }
                        }
		}
	} 
?>