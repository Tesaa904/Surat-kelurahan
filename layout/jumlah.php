<?php
	include('koneksi.php');

	// hitung warga
	$query_warga = "SELECT COUNT(*) AS total FROM penduduk";
	$hasil_warga = mysqli_query($conn, $query_warga);
	$jumlah_warga = mysqli_fetch_assoc($hasil_warga);

	// hitung kartu keluarga
	$query_lahir = "SELECT COUNT(*) AS total FROM srt_lahir";
	$hasil_lahir = mysqli_query($conn, $query_lahir);
	$jumlah_lahir = mysqli_fetch_assoc($hasil_lahir); 

	// hitung keluar
	$query_keluar = "SELECT COUNT(*) AS total FROM srt_pindah_luar";
	$hasil_keluar = mysqli_query($conn, $query_keluar);
	$jumlah_keluar = mysqli_fetch_assoc($hasil_keluar);

	// hitung mati
	$query_mati = "SELECT COUNT(*) AS total FROM srt_mati";
	$hasil_mati = mysqli_query($conn, $query_mati);
	$jumlah_mati = mysqli_fetch_assoc($hasil_mati); 

	// hitung warga laki-laki
	$query_warga_l = "SELECT COUNT(*) AS total FROM penduduk WHERE gender = 'Laki-Laki'";
	$hasil_warga_l = mysqli_query($conn, $query_warga_l);
	$jumlah_warga_l = mysqli_fetch_assoc($hasil_warga_l);

	// hitung warga perempuan
	$query_warga_p = "SELECT COUNT(*) AS total FROM penduduk WHERE gender = 'Perempuan'";
	$hasil_warga_p = mysqli_query($conn, $query_warga_p);
	$jumlah_warga_p = mysqli_fetch_assoc($hasil_warga_p);

	// hitung warga lebih dari 17 tahun
	$query_warga_ld_17 = "SELECT COUNT(*) AS total FROM penduduk WHERE TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 17 AND tgl_lahir != '0000-00-00'";
	$hasil_warga_ld_17 = mysqli_query($conn, $query_warga_ld_17);
	$jumlah_warga_ld_17 = mysqli_fetch_assoc($hasil_warga_ld_17);

	// hitung warga kurang dari 17 tahun
	$query_warga_kd_17 = "SELECT COUNT(*) AS total FROM penduduk WHERE TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) < 17 AND tgl_lahir != '0000-00-00'";
	$hasil_warga_kd_17 = mysqli_query($conn, $query_warga_kd_17);
	$jumlah_warga_kd_17 = mysqli_fetch_assoc($hasil_warga_kd_17);

?>