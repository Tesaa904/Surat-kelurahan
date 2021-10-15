<?php
	include("koneksi.php");     
	if ($_GET['jenis']=="kab"){
		$propinsi = $_GET['id_prop'];
		$kota = mysqli_query($mysqli,"SELECT id_kabkota,nama_kabkota FROM wil_kabkota WHERE id_propinsi='$propinsi' order by nama_kabkota");
		echo "<option>-- Pilih Kabupaten/Kota --</option>";
		while($k = mysqli_fetch_array($kota)){
			echo "<option value=\"".$k['id_kabkota']."\">".$k['nama_kabkota']."</option>\n";
		}		
	} else if ($_GET['jenis']=="kec") {
		$kab = $_GET['id_kab'];
		$kec = mysqli_query($mysqli,"SELECT * FROM wil_kecamatan WHERE id_kabkota='$kab' order by nama_kecamatan");
		echo "<option>-- Pilih Kecamatan --</option>";
		while($k = mysqli_fetch_array($kec)){
			echo "<option value=\"".$k['id_kecamatan']."\">".$k['nama_kecamatan']."</option>\n";
		}			
	} else if ($_GET['jenis']=="kel") {
		$kec = $_GET['id_kec'];
		$kel = mysqli_query($mysqli,"SELECT * FROM wil_kelurahan WHERE id_kecamatan='$kec' order by nama_kelurahan");
		echo "<option>-- Pilih Kelurahan --</option>";
		while($k = mysqli_fetch_array($kel)){
			echo "<option value=\"".$k['id_kelurahan']."\">".$k['nama_kelurahan']."</option>\n";
		}			
	}
?>
