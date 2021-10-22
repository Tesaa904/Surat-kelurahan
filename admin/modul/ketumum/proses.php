<?php
	session_start();
	include "../../config/database.php";
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
                        $id_status_surat = $_POST['id_status_surat'];
			$tgl_surat= date("Y-m-d H:i:s");
		   
			$input = mysqli_query($mysqli,"SELECT * FROM surat_ket_umum WHERE id_ket_umum='$id_ket_umum'");

			if (mysqli_num_rows($input) > 0){
				?>
				<script type="text/javascript">
						alert('Maaf, data sudah ada');
						window.location.href='../../main.php?modul=ketumum_view';
				</script>
				<?php

			}else {
				// ambil data file
				$namaFile = $_FILES['file_suratketumum']['name'];
				$namaSementara = $_FILES['file_suratketumum']['tmp_name'];
				
				//nama file baru
				$ext = end(explode('.', $namaFile));
				$newName = $id_ket_umum.".".$ext;
				
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "../../file/surat_ketumum/";
				$url = $dirUpload.$newName;
				$url_db = "file/surat_ketumum/".$newName;

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $url);            
				
				$simpan= mysqli_query($mysqli,"INSERT INTO surat_ket_umum(id_ket_umum,no_surat_imb,no_surat_skt,no_surat_skd,no_surat_skp,no_surat_sir,no_surat_sku,nik,nik_ayah,nik_ibu,tgl_keperluan,pukul_kegiatan,id_jenis_surat,keperluan,nama_usaha,alamat_usaha,jenis_bangunan,letak,status_tanah,data_ubah,data_benar,penghasilan,id_status_surat,tgl_surat,suratumum) 
									VALUES ('$id_ket_umum','$no_surat_imb','$no_surat_skt','$no_surat_skd','$no_surat_skp','$no_surat_sir','$no_surat_sku','$nik','$nik_ayah','$nik_ibu','$tgl_keperluan','$pukul_kegiatan','$id_jenis_surat','$keperluan','$nama_usaha','$alamat_usaha','$jenis_bangunan','$letak','$status_tanah','$data_ubah','$data_benar','$penghasilan','$id_status_surat','$tgl_surat','$url_db')");
				if($simpan) { 
					echo "<script>
						window.alert('Data Berhasil Disimpan');
						window.location.href='../../main.php?modul=ketumum_view';
					</script>";
				}
			}
		}
	} else if ($get_act=="verif") {
		$id = $_GET['id'];
		$cek = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.id_ket_umum,a.id_akun,b.nik,b.email
					from surat_ket_umum a inner join m_akun_penduduk b on a.id_akun=b.id_akun where a.id_ket_umum='$id'"));
		$sql_save = mysqli_query($mysqli,"update surat_ket_umum set id_status_surat='2' where id_ket_umum='$id'");
		
		if ($sql_save)			
			//Kirim Email
			$from = $mail_sender;
			$to = $cek['email'];
			$subject = "Permintaan Diverifikasi";

			$message = "Permintaan anda berhasil diverifikasi oleh admin. Silahkan ambil surat anda di Kantor Kelurahan Kraguman pada Jam Kerja. Terima Kasih";

			$headers = "From:" . $from;

			//proses kirim
			$send_mail = mail($to,$subject,$message, $headers);	
			
			echo "<script>window.location.href='../../main.php?modul=ketumum_view';</script>";
	} else if ($get_act=="del") {
		$id = $_GET['id'];
		
		$sql_save = mysqli_query($mysqli,"delete from surat_ket_umum where id_ket_umum='$id'");
		
		if ($sql_save)
			echo "<script>window.location.href='../../main.php?modul=ketumum_view&alert=4'</script>";

	} else if ($get_act=="edit") {
		if (isset($_POST['simpan'])){
			$id= $_POST['id'];
			$no_surat_imb= $_POST['no_surat_imb'];
			$no_surat_skt= $_POST['no_surat_skt'];
			$no_surat_skd= $_POST['no_surat_skd'];
			$no_surat_skp= $_POST['no_surat_skp'];
			$no_surat_sir= $_POST['no_surat_sir'];
			$no_surat_sku= $_POST['no_surat_sku'];
			$id_jenis_surat= $_POST['id_jenis_surat'];
			$nik= $_POST['nik'];
			$nik_ayah= $_POST['nik_ayah'];
			$nik_ibu= $_POST['nik_ibu'];
			$tgl_keperluan= $_POST['tgl_keperluan'];
			$pukul_kegiatan= $_POST['pukul_kegiatan'];
			$keperluan= $_POST['keperluan'];
			$nama_usaha	=$_POST	['nama_usaha'];
			$alamat_usaha= $_POST['alamat_usaha'];
			$jenis_bangunan= $_POST['jenis_bangunan'];
			$letak= $_POST['letak'];
			$status_tanah= $_POST['status_tanah'];
			$data_ubah= $_POST['data_ubah'];
			$data_benar= $_POST['data_benar'];
			$penghasilan= $_POST['penghasilan'];

			$sql_save = mysqli_query($mysqli,"update surat_ket_umum set no_surat_imb='$no_surat_imb',no_surat_skt='$no_surat_skt',no_surat_skd='$no_surat_skd',no_surat_skp='$no_surat_skp',no_surat_sir='$no_surat_sir',no_surat_sku='$no_surat_sku',id_jenis_surat='$id_jenis_surat',nik='$nik',nik_ayah='$nik_ayah',nik_ibu='$nik_ibu',tgl_keperluan='$tgl_keperluan',pukul_kegiatan='$pukul_kegiatan',keperluan='$keperluan',nama_usaha='$nama_usaha',alamat_usaha='$alamat_usaha',jenis_bangunan='$jenis_bangunan',letak='$letak',status_tanah='$status_tanah',data_ubah='$data_ubah',data_benar='$data_benar',penghasilan='$penghasilan' where id_ket_umum='$id'");
			
			if ($sql_save)
				echo "<script>window.location.href='../../main.php?modul=ketumum_view&alert=3'</script>";


	}
}
?>