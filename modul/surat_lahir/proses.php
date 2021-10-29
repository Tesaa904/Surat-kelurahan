<?php 
	session_start();
	
	include('../../config/koneksi.php'); 
	if(isset($_POST['simpan'])){ 
        $id_lahir= $_POST['id_lahir']; 
		$nik_kpl_kel= $_POST['nik_kpl_kel'];
        $nama= $_POST['nama'];
        $tmpt_lahir= $_POST['tmpt_lahir'];
        $hari= $_POST['hari'];
        $tgl_lahir= $_POST['tgl_lahir'];
        $gender= $_POST['gender'];
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
        $tglsurat= date("Y-m-d H:i:s");
        $id_akun = $_SESSION['id_akun'];
		
        $input = mysqli_query($mysqli,"SELECT * FROM surat_lahir WHERE nama='$nama'");

        if (mysqli_num_rows($input) > 0){
			?>
			<script type="text/javascript">
					alert('Maaf, data sudah ada');
					window.location='main.php?modul=surat_lahir';
			</script>
			<?php

        }else {
			// ambil data file
			$namaFile = $_FILES['file_suratlahir']['name'];
			$namaSementara = $_FILES['file_suratlahir']['tmp_name'];
			
			//nama file baru
			//$ext = pathinfo($namaFile, PATHINFO_EXTENSION);
			$exploded = explode('.', $namaFile);
			$ext = strtolower(end($exploded));
                        
			$newName = $id_lahir.".".$ext;
			
			// tentukan lokasi file akan dipindahkan
			$dirUpload = "../../admin/file/surat_lahir/";
			$url = $dirUpload.$newName;
			$url_db = "file/surat_lahir/".$newName;

			// pindahkan file
			$terupload = move_uploaded_file($namaSementara, $url);            
			
			$simpan= mysqli_query($mysqli,"INSERT INTO surat_lahir(id_lahir,no_surat_lahir,nik_kepala_keluarga,nama,tempat_lahir,hari,tgl_lahir,id_gender,pukul,id_jenis_lahir,
								id_tempat_lahir,anak_ke,id_penolong,berat,panjang,nik_ibu,nik_ayah,tgl_nikah,nik_pelapor,nik_saksi1,nik_saksi2,id_dukuh,tgl_surat,suratlahir,id_akun,id_status_surat)
								VALUES ('$id_lahir','0001','$nik_kpl_kel','$nama','$tmpt_lahir','$hari','$tgl_lahir','$gender','$pukul','$jenis_lahir',
								'$tmp_dilahir','$anak_ke','$penolong','$berat','$panjang','$nik_ibu','$nik_ayah','$tgl_nikah','$nik_pl','$nik_sk1','$nik_sk2','$id_dukuh',
								'$tglsurat','$url_db','$id_akun','1')");
            if($simpan) { 
				echo "<script>
					window.alert('Data Berhasil Disimpan.(*)Tunggu konfirmasinya melalui email anda dan CEk pada folder bagian SPAM');
					window.location.href='../../main.php?modul=surat_lahir';
				</script>";
                                
            	} else {
				echo "INSERT INTO surat_lahir(id_lahir,no_surat_lahir,nik_kepala_keluarga,nama,tempat_lahir,hari,tgl_lahir,id_gender,pukul,id_jenis_lahir,
								id_tempat_lahir,anak_ke,id_penolong,berat,panjang,nik_ibu,nik_ayah,tgl_nikah,nik_pelapor,nik_saksi1,nik_saksi2,id_dukuh,tgl_surat,suratlahir,id_akun,id_status_surat)
								VALUES ('$id_lahir','0001','$nik_kpl_kel','$nama','$tmpt_lahir','$hari','$tgl_lahir','$gender','$pukul','$jenis_lahir',
								'$tmp_dilahir','$anak_ke','$penolong','$berat','$panjang','$nik_ibu','$nik_ayah','$tgl_nikah','$nik_pl','$nik_sk1','$nik_sk2','$id_dukuh',
								'$tglsurat','$url_db','$id_akun','1')";
			}
		}
	}
?> 