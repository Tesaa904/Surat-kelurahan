<?php
	if ($_GET['modul']=="beranda")
		include "modul/home/view.php";
        else if ($_GET['modul']=="info")
		include "modul/info/view.php";
        else if ($_GET['modul']=="syarat")
		include "modul/syarat/view.php";
	else if ($_GET['modul']=="surat_lahir")
		include "modul/surat_lahir/view.php";
	else if ($_GET['modul']=="surat_mati")
		include "modul/surat_mati/view.php";
	else if ($_GET['modul']=="surat_datang")
		include "modul/surat_datang/view.php";
	else if ($_GET['modul']=="surat_keluar")
		include "modul/surat_keluar/view.php";
	else if ($_GET['modul']=="surat_umum")
		include "modul/surat_umum/view.php";
	else if ($_GET['modul']=="surat_umum_domisili")
		include "modul/surat_umum/domisili.php";
	else if ($_GET['modul']=="skm_surat_umum") 
		include "modul/surat_umum/skm.php";
	else if ($_GET['modul']=="usaha_surat_umum")
		include "modul/surat_umum/usaha.php";
	else if ($_GET['modul']=="ramai_surat_umum")
		include "modul/surat_umum/ramai.php";
	else if ($_GET['modul']=="bangunan_surat_umum")
		include "modul/surat_umum/bangunan.php";
	else if ($_GET['modul']=="perubahan_surat_umum")
		include "modul/surat_umum/perubahan.php";
	else if ($_GET['modul']=="riw_surat_lahir")
		include "modul/riw_surat_lahir/view.php";
	else if ($_GET['modul']=="det_lahir")
		include "modul/riw_surat_lahir/detail.php";	
	else if ($_GET['modul']=="riw_surat_mati")
		include "modul/riw_surat_mati/view.php";
	else if ($_GET['modul']=="det_mati")
		include "modul/riw_surat_mati/detail.php";
	else if ($_GET['modul']=="riw_surat_datang")
		include "modul/riw_surat_datang/view.php";
	else if ($_GET['modul']=="det_datang")
		include "modul/riw_surat_datang/detail.php";
	else if ($_GET['modul']=="riw_surat_keluar")
		include "modul/riw_surat_keluar/view.php";
	else if ($_GET['modul']=="det_keluar")
		include "modul/riw_surat_keluar/detail.php";
		else if ($_GET['modul']=="riw_surat_umum")
	include "modul/riw_surat_umum/view.php";		
?> 