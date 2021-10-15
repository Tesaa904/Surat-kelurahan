<?php
	//server database
    $db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "simdesa";
	
	//server mail
	//$mail_server = "http://kraguman.dx.am";
	//$mail_sender = "admin@kraguman.dx.am";
        
	$mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	 
	if(mysqli_connect_errno()){
		echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
	}
?>
