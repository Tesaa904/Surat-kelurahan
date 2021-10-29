<?php
	session_start();
	include "../../config/koneksi.php";
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
			$tgl_surat= date("Y-m-d H:i:s");
			 $id_akun = $_SESSION['id_akun'];
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_mati WHERE nik='$nik'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=surat_mati';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratmati']['name'];
				$namaSementara = $_FILES['file_suratmati']['tmp_name'];
				
				//nama file baru
				$exploded = explode('.', $namaFile);
                                $ext = strtolower(end($exploded));	
                        
				$newName = $id_mati.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../admin/file/surat_mati/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_mati/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_mati(id_mati,no_surat_mati,nik_kepala_keluarga,nik,anak_ke,tgl_mati,waktu_mati,id_sebab_mati,
									tempat_mati,umur_mati,id_penerang,nik_ayah,nik_ibu,nik_pelapor,nik_saksi1,nik_saksi2,tgl_surat,id_akun,suratmati,id_status_surat)
									VALUES ('$id_mati','$no_surat_mati','$nik_kepala_keluarga','$nik','$anak_ke','$tgl_mati','$waktu_mati','$id_sebab_mati',
									'$tempat_mati','$umur_mati','$id_penerang','$nik_ayah','$nik_ibu','$nik_pelapor','$nik_saksi1','$nik_saksi2','$tgl_surat','$id_akun','$url_db','1')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan.(*)Tunggu konfirmasinya melalui email anda dan CEk pada folder bagian SPAM');
						window.location.href='../../main.php?modul=surat_mati';
					</script>";
                             } else {
				echo "INSERT INTO surat_mati(id_mati,nik_kepala_keluarga,nik,anak_ke,tgl_mati,waktu_mati,id_sebab_mati,
									tempat_mati,umur_mati,id_penerang,nik_ayah,nik_ibu,nik_pelapor,nik_saksi1,nik_saksi2,tgl_surat,id_akun,suratmati,id_status_surat)
									VALUES ('$id_mati','$nik_kepala_keluarga','$nik','$anak_ke','$tgl_mati','$waktu_mati','$id_sebab_mati',
									'$tempat_mati','$umur_mati','$id_penerang','$nik_ayah','$nik_ibu','$nik_pelapor','$nik_saksi1','$nik_saksi2','$tgl_surat','$id_akun','$url_db','1')";
			}
		}
	}
     }
        
?>