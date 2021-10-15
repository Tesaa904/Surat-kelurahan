<?php
	if (empty($_SESSION['id_user'])){
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}
	// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
	else {
		if (empty($_GET['modul'])){
			$get_modul = "home";
		} else {
			$get_modul = $_GET['modul'];
		}				
		$modul = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_menu where modul = '$get_modul'"));
		include "modul/$modul[path]";
	}
?>