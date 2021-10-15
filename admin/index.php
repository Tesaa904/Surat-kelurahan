<?php
	session_start();
	
	if (empty($_SESSION['id_user'])){
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	} else {
		echo "<script>window.location.href='main.php?modul=home'</script>";
	}
?>