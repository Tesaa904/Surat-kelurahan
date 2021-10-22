<?php
$_GET['nik'];
$_GET['mulai'];
$_GET['sampai'];
if ($_GET['nama_jenis']=='1')
		include "cetak_srt_domisili.php";
else if ($_GET['nama_jenis']=='2')
		include "cetak_srt_keramaian.php";
else if ($_GET['nama_jenis']=='3')
		include "cetak_srt_usaha.php";
else if ($_GET['nama_jenis']=='4')
		include "cetak_srt_tdkkmampu.php";
else if ($_GET['nama_jenis']=='5')
		include "cetak_srt_bangun.php";
else if ($_GET['nama_jenis']=='6')
		include "cetak_srt_perubahan.php";
?>