<?php
	// mencari kode barang dengan nilai paling besar
	$query = "SELECT max(id_ket_umum) as maxKode FROM surat_ket_umum";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];

	$noUrut = (int) substr($kodeBarang, 2, 3);

	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$noUrut++;

	$char = "SK";
	$kodeBarang = $char . sprintf("%03s", $noUrut);
?>