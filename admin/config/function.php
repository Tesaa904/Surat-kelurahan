<?php
	function name_from_nik($nik){
		include "koneksi.php";
		
		$name = mysqli_fetch_array(mysqli_query($mysqli,"select nama from m_penduduk where nik='$nik'"));
		return $name['nama'];
	}	
	function name_from_id_alasan_pindah($id_alasan_pindah){
		include "koneksi.php";
		
		$name = mysqli_fetch_array(mysqli_query($mysqli,"select nama_alasan_pindah from m_alasan_pindah where id_alasan_pindah='$id_alasan_pindah'"));
		return $name['nama_alasan_pindah'];
	}
	function name_from_dukuh($id_dukuh){
		include "koneksi.php";
		
		$name = mysqli_fetch_array(mysqli_query($mysqli,"SELECT a.nik,b.nama, i.nama_dukuh FROM surat_pindah_luar a LEFT JOIN m_penduduk b ON a.nik=b.nik LEFT JOIN m_dukuh i ON b.id_dukuh=i.id_dukuh where nik='$id_dukuh'"));
		return $name['nama_dukuh'];
	}

	function nama_pend($nikk){
		include "koneksi.php";
		$sql_nik = mysqli_query($mysqli,"select * from m_penduduk where nik='$nikk'");
		$nama_pend = mysqli_fetch_array($sql_nik);
		return $nama_pend['nama'];	
		}	
	function nokk($nik_pnd){
		include "koneksi.php";
		$sql_nik = mysqli_query($mysqli,"select * from m_penduduk where nik='$nik_pnd'");
		$no_kk = mysqli_fetch_array($sql_nik);
		return $nama_pend['no_kk'];	
		}			
?>