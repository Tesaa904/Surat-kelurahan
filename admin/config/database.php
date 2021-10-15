<?php
	// deklarasi parameter koneksi database
	$server   = "localhost";
	$username = "root";
	$password = "";
	$database = "simdesa";

	//server mail
	//$mail_server = "http://kraguman.dx.am";
	//$mail_sender = "admin@kraguman.dx.am";


	// koneksi database
	$mysqli = new mysqli($server, $username, $password, $database);

	// cek koneksi
	if ($mysqli->connect_error) {
		die('Koneksi Database Gagal : '.$mysqli->connect_error);
	}
?>
