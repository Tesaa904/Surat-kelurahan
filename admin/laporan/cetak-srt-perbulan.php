<?php
error_reporting(0);
  session_start();
  ob_start();

include "../../config/database.php";
  // panggil fungsi untuk format tanggal
  include "../../config/fungsi_tanggal.php";
  include "../../config/function.php";

    $hari_ini = date("d-m-Y");
 

    $tgl_awal = $_GET['mulai'];
    $tgl_akhir = $_GET['sampai'];
    $no    = 0;
    $user= mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM m_user WHERE id_level='LV002'"));
    
    $penduduk =mysqli_query($mysqli,"SELECT a.*, b.nama_agama, c.nama_dukuh, d.nama_gender, e.nama_goldarah, f.nama_pekerjaan, g.nama_pendidikan, h.nama_statuskawin, i.nama_warganegara, j.nama_shdk, c.nama_dukuh, c.rt, c.rw 
FROM m_penduduk a INNER JOIN m_agama b ON a.id_agama = b.id_agama 
INNER JOIN m_dukuh c ON a.id_dukuh = c.id_dukuh 
INNER JOIN m_gender d ON a.id_gender = d.id_gender 
INNER JOIN m_goldarah e ON a.id_goldarah = e.id_goldarah 
INNER JOIN m_pekerjaan f ON a.id_pekerjaan = f.id_pekerjaan 
INNER JOIN m_pendidikan g ON a.id_pendidikan = g.id_pendidikan 
INNER JOIN m_statuskawin h ON a.id_statuskawin = h.id_statuskawin 
INNER JOIN m_warganegara i ON a.id_warganegara= i.id_warganegara
INNER JOIN m_shdk j ON a.id_shdk = j.id_shdk
LEFT JOIN surat_pindah_luar k ON a.nik=k.nik
LEFT JOIN surat_pindah_datang l ON a.nik=l.nik
LEFT JOIN surat_mati o ON a.nik=o.nik");

$query_warga = "SELECT COUNT(*) AS total FROM m_penduduk where status='1'";
$hasil_warga = mysqli_query($mysqli, $query_warga);
$jumlah_warga = mysqli_fetch_assoc($hasil_warga);
 

// hitung lahir total
$query_lahir = "SELECT COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON surat_lahir.id_lahir =m_penduduk.id_lahir LEFT JOIN m_gender ON surat_lahir.id_gender= m_gender.id_gender WHERE cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir = mysqli_fetch_assoc($hasil_lahir);

// hitung lahir total laki
$query_lahir = "SELECT COUNT(*) AS total FROM m_penduduk LEFT JOIN surat_lahir ON m_penduduk.id_lahir =surat_lahir.id_lahir LEFT JOIN m_gender ON surat_lahir.id_gender= m_gender.id_gender WHERE surat_lahir.id_gender='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_tot_l = mysqli_fetch_assoc($hasil_lahir);

// hitung lahir total perempuan
$query_lahir = "SELECT COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON surat_lahir.id_lahir =m_penduduk.id_lahir LEFT JOIN m_gender ON surat_lahir.id_gender= m_gender.id_gender WHERE surat_lahir.id_gender='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_tot_p = mysqli_fetch_assoc($hasil_lahir);

// hitung lahir perempuan wni
$query_lahir = "SELECT  COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON surat_lahir.id_lahir =m_penduduk.id_lahir LEFT JOIN m_gender ON surat_lahir.id_gender= m_gender.id_gender WHERE surat_lahir.id_gender='2' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_wni_p = mysqli_fetch_assoc($hasil_lahir); 

// hitung lahir laki wni
$query_lahir = "SELECT  COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON m_penduduk.id_lahir =surat_lahir.id_lahir LEFT JOIN m_gender ON surat_lahir.id_gender= m_gender.id_gender WHERE surat_lahir.id_gender='1' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_wni_l = mysqli_fetch_assoc($hasil_lahir); 

// hitung lahir perempuan wna
$query_lahir = "SELECT  COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON m_penduduk.id_lahir =surat_lahir.id_lahir LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_wna_p = mysqli_fetch_assoc($hasil_lahir); 

// hitung lahir laki wna
$query_lahir = "SELECT  COUNT(*) AS total FROM surat_lahir LEFT JOIN m_penduduk ON m_penduduk.id_lahir =surat_lahir.id_lahir LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_lahir = mysqli_query($mysqli, $query_lahir);
$lahir_wna_l = mysqli_fetch_assoc($hasil_lahir); 


// hitung datang total
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON surat_pindah_datang.nik =m_penduduk.nik  WHERE cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$jumlah_datang = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_datang_3 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung datang perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2'AND m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_datang_3 = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_datang_2 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung datang perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_datang_2 = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_datang_5 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung datang perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_datang_5 = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_datang_4 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung datang perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_datang_4 = mysqli_fetch_assoc($hasil_datang);



//total datang klasifikasi 2
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_datang_2 = mysqli_fetch_assoc($hasil_datang);
//total datang klasifikasi 3
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_datang_3 = mysqli_fetch_assoc($hasil_datang);
//total datang klasifikasi 4
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_datang_4 = mysqli_fetch_assoc($hasil_datang);
//total datang klasifikasi 5
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_datang.id_klasifikasi_pindah= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_datang_5 = mysqli_fetch_assoc($hasil_datang);





//klasifikasi keluar
// hitung keluar laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_luar_3 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung keluar perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_luar_3 = mysqli_fetch_assoc($hasil_datang);

// hitung luar laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_luar_2 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung luar perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_luar_2 = mysqli_fetch_assoc($hasil_datang);

// hitung luar laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1' AND m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_luar_5 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung luar perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2' AND m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_luar_5 = mysqli_fetch_assoc($hasil_datang);

// hitung luar laki klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='1'AND m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$l_luar_4 = mysqli_fetch_assoc($hasil_datang);
 
 // hitung luar perempuan klasifikasi
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_penduduk.id_gender='2'AND m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$p_luar_4 = mysqli_fetch_assoc($hasil_datang);




// hitung luar total klasifikasi 4
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='4' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_luar_4 = mysqli_fetch_assoc($hasil_datang);
// hitung luar total klasifikasi 5
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='5' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_luar_5 = mysqli_fetch_assoc($hasil_datang);
// hitung luar total klasifikasi 3
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='3' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_luar_3 = mysqli_fetch_assoc($hasil_datang);
// hitung luar total klasifikasi 2
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_luar 
LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik
LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender 
LEFT JOIN m_klasifikasi_pindh ON surat_pindah_luar.id_klasifikasi_pindh= m_klasifikasi_pindh.id_klasifikasi
WHERE m_klasifikasi_pindh.id_klasifikasi='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$tot_luar_2 = mysqli_fetch_assoc($hasil_datang);





// hitung datang laki wni
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON surat_pindah_datang.nik =m_penduduk.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$datang_wni_l = mysqli_fetch_assoc($hasil_datang);

// hitung datang perempuan wni
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON surat_pindah_datang.nik =m_penduduk.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$datang_wni_p = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki wna
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$datang_wna_l = mysqli_fetch_assoc($hasil_datang);

// hitung datang perempuan wna
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$datang_wna_p = mysqli_fetch_assoc($hasil_datang);

// hitung datang laki total
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$total_l = mysqli_fetch_assoc($hasil_datang);

// hitung datang perempuan total
$query_datang = "SELECT COUNT(*) AS total FROM surat_pindah_datang LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_datang.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND cast(tgl_surat_datang as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_datang = mysqli_query($mysqli, $query_datang);
$total_p = mysqli_fetch_assoc($hasil_datang);

// hitung keluar total
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$jumlah_keluar = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar wni laki
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_wni_l = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar wni perempuan
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_wni_p = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar wna laki
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_wna_l = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar wna perempuan
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_wna_p = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar laki total
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_total_l = mysqli_fetch_assoc($hasil_keluar);

// hitung keluar perempuan total
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_total_p = mysqli_fetch_assoc($hasil_keluar);


// hitung keluar total
$query_keluar = "SELECT COUNT(*) AS total FROM surat_pindah_luar LEFT JOIN m_penduduk ON m_penduduk.nik =surat_pindah_luar.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE cast(tgl_surat_luar as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_keluar = mysqli_query($mysqli, $query_keluar);
$keluar_tot = mysqli_fetch_assoc($hasil_keluar);

// hitung mati
$query_mati = " SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$mati = mysqli_fetch_assoc($hasil_mati);

// hitung mati laki
$query_mati = " SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$jumlah_mati_l = mysqli_fetch_assoc($hasil_mati);

//hitung mati perempuan
$query_mati = " SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender WHERE m_penduduk.id_gender='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$jumlah_mati_p = mysqli_fetch_assoc($hasil_mati);

// hitung mati laki wni
$query_mati = " SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender LEFT JOIN m_warganegara ON m_penduduk.id_warganegara=m_warganegara.id_warganegara WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$wni_mati_l = mysqli_fetch_assoc($hasil_mati);

//hitung mati perempuan wni
$query_mati = "SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender LEFT JOIN m_warganegara ON m_penduduk.id_warganegara=m_warganegara.id_warganegara WHERE m_penduduk.id_gender='2' AND m_penduduk.id_warganegara='1' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$wni_mati_p = mysqli_fetch_assoc($hasil_mati);


// hitung mati laki wna
$query_mati = " SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender LEFT JOIN m_warganegara ON m_penduduk.id_warganegara=m_warganegara.id_warganegara WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$wna_mati_l = mysqli_fetch_assoc($hasil_mati);

//hitung mati perempuan wna
$query_mati = "SELECT COUNT(m_penduduk.id_gender) AS total FROM surat_mati LEFT JOIN m_penduduk ON m_penduduk.nik =surat_mati.nik LEFT JOIN m_gender ON m_penduduk.id_gender= m_gender.id_gender LEFT JOIN m_warganegara ON m_penduduk.id_warganegara=m_warganegara.id_warganegara WHERE m_penduduk.id_gender='1' AND m_penduduk.id_warganegara='2' AND cast(tgl_surat as date) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$hasil_mati = mysqli_query($mysqli, $query_mati);
$wna_mati_p = mysqli_fetch_assoc($hasil_mati);

// hitung warga laki-laki wni awal bulan
$query_warga_l = "SELECT COUNT(*) AS total FROM m_penduduk LEFT JOIN m_gender ON m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '1' AND m_penduduk.status='1' AND id_warganegara='1'";
$hasil_warga_l = mysqli_query($mysqli, $query_warga_l);
$jumlah_warga_l = mysqli_fetch_assoc($hasil_warga_l);

// hitung warga laki-laki 
$warga_laki = "SELECT COUNT(*) AS total FROM m_penduduk LEFT JOIN m_gender ON m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '1' AND m_penduduk.status='1'";
$hasil_warga_laki = mysqli_query($mysqli, $warga_laki);
$jumlah_warga_laki = mysqli_fetch_assoc($hasil_warga_laki);

// hitung warga perempuan wni
$query_warga_p = "SELECT COUNT(*) AS total FROM m_penduduk left join m_gender on m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '2' and m_penduduk.status='1' AND id_warganegara='1'";
$hasil_warga_p = mysqli_query($mysqli, $query_warga_p);
$jumlah_warga_p = mysqli_fetch_assoc($hasil_warga_p);

// hitung warga perempuan 
$query_warga_p = "SELECT COUNT(*) AS total FROM m_penduduk left join m_gender on m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '2' and m_penduduk.status='1'";
$hasil_warga_p = mysqli_query($mysqli, $query_warga_p);
$warga_perempuan = mysqli_fetch_assoc($hasil_warga_p);


// hitung warga laki-laki WNA
$query_wna_l = "SELECT COUNT(*) AS total FROM m_penduduk LEFT JOIN m_gender ON m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '1' AND m_penduduk.status='1' AND m_penduduk.id_warganegara='2'";
$hasil_wna_l = mysqli_query($mysqli, $query_wna_l);
$jumlah_wna_l = mysqli_fetch_assoc($hasil_wna_l);

// hitung warga perempuan WNA
$query_wna_p = "SELECT COUNT(*) AS total FROM m_penduduk left join m_gender on m_penduduk.id_gender=m_gender.id_gender WHERE m_penduduk.id_gender = '2' and m_penduduk.status='1' AND m_penduduk.id_warganegara='2'";
$hasil_wna_p = mysqli_query($mysqli, $query_wna_p);
$jumlah_wna_p = mysqli_fetch_assoc($hasil_wna_p);
 
 //gender
$sql_gender =" SELECT COUNT(*)AS jumlah FROM m_penduduk WHERE m_penduduk.id_gender AND m_penduduk.status='1'";
$hasil_gender= mysqli_query($mysqli, $sql_gender);
$jml_gender= mysqli_fetch_assoc($hasil_gender);
?>
                        
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Rekap Data Kependudukan</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
    <div id="">
    <img align="left"style="width: 9%;" src="../../assets/images/LOGO_KLATEN.png">
    <h2 align="center">REKAP DATA KEPENDUDUKAN</h2>
            <span style='font-size: 10pt;'align="center"><br>KANTOR DESA : KRAGUMAN/  KECAMATAN: JOGONALAN/<br> KABUPATEN : KLATEN/ PROVINSI : JAWA TENGAH <br>Jl Klaten-Jogja,Km 06 Kraguman,Jogonalan,Klaten<br> Kode Pos: 57461. /Telp : 0895400196516</span>
            </div>
            <span align="center" style='font-size: 12pt;'><br></span>
            <hr><br>
          <div id="isi">
            
                <h4 align="text-left" style="text-align: left;">LAPORAN BULANAN DESA/KELURAHAN</h4>
               <table cellspacing="0" style="width: 100%; text-align: left;">
                  <tr>
                    <td>DESA</td><td>: KRAGUMAN</td>
                  </tr>
                   <tr>
                    <td>KECAMATAN</td><td>: JOGONALAN</td>
                  </tr>
                  <tr>
                     <td>Tanggal </td><td>: <?php echo date('d-m-Y', strtotime($tgl_awal ));?> sampai ke<?php echo date('d-m-Y', strtotime($tgl_akhir ));?></td><td>&nbsp;</td><td></td><td></td>
                  </tr>
                </table>
                  <br>
                  <br>
      <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
        <thead style="background:#e8ecee">
          <tr>
            <th rowspan="2" style="text-align:center;vertical-align:middle">No</th>
            <th rowspan="2" style="text-align:center;vertical-align:middle">PERINCIAN</th>
            <th colspan="2" style="text-align:center;vertical-align:middle">Warga Negara R.I</th>
            <th colspan="2" style="text-align:center;vertical-align:middle">Orang Asing</th>
            <th colspan="4" style="text-align:center;vertical-align:middle">Jumlah</th>
          </tr>
          <tr>
            <th width="100px" style="text-align:center;vertical-align:middle">Laki-Laki</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Perempuan</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Laki-laki</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Perempuan</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Laki-laki</th> 
            <th width="100px" style="text-align:center;vertical-align:middle">Perempuan</th>
             <th width="200px" style="text-align:center;vertical-align:middle">Laki-laki + Perempuan</th>

          </tr>
        </thead>

           
                <tbody>
               <?php
           echo "<tr>
                    <td align='center'>(1)</td>
                    <td align='center'>(2)</td>
                    <td align='center'>(3)</td>
                    <td align='center'>(4)</td>
                    <td align='center'>(5)</td>
                    <td align='center'>(6)</td>
                    <td align='center'>(7)</td>
                    <td align='center'>(8)</td>
                    <td align='center'>(9)</td>
                </tr>
            
              <tr>
                  <td align='center'>2</td>
                  <td>Kelahiran bulan ini</td>
                  <td align='center'>$lahir_wni_l[total]</td>
                  <td align='center'>$lahir_wni_p[total]</td>
                  <td align='center'>$lahir_wna_l[total]</td>
                  <td align='center'>$lahir_wna_p[total]</td>
                  <td align='center'>$lahir_tot_l[total]</td> 
                  <td align='center'>$lahir_tot_p[total]</td> 
                  <td align='center'>$lahir[total]</td>      
              </tr>
               <tr>
                <td align='center'>3</td>
                  <td>Kematian bulan ini</td>
                  <td align='center'>$wni_mati_l[total]</td> 
                  <td align='center'>$wni_mati_p[total]</td>
                  <td align='center'>$wna_mati_l[total]</td>
                  <td align='center'>$wna_mati_p[total]</td>
                  <td align='center'>$jumlah_mati_l[total]</td> 
                  <td align='center'>$jumlah_mati_p[total]</td> 
                  <td align='center'>$mati[total]</td>      
              </tr>
               <tr>
                <td align='center'>4</td>
                  <td>Pendatang bulan ini</td>
                  <td align='center'>$datang_wni_l[total]</td>
                  <td align='center'>$datang_wni_p[total]</td>
                  <td align='center'>$datang_wna_l[total]</td>
                  <td align='center'>$datang_wna_p[total]</td> 
                  <td align='center'>$total_l[total]</td> 
                  <td align='center'>$total_p[total]</td>
                  <td align='center'>$jumlah_datang[total]</td>      
              </tr>
               <tr>
                <td align='center'>5</td>
                  <td>Pindah bulan ini</td>
                  <td align='center'>$keluar_wni_l[total]</td>
                  <td align='center'>$keluar_wni_p[total]</td>
                  <td align='center'>$keluar_wna_l[total]</td>
                  <td align='center'>$keluar_wna_p[total]</td> 
                  <td align='center'>$keluar_total_l[total]</td> 
                  <td align='center'>$keluar_total_p[total]</td> 
                  <td align='center'>$keluar_tot[total]</td>      
              </tr>
               <tr>
                <td align='center'>6</td>
                  <td> Jumlah Penduduk saat ini</td>
                  <td width='100'align='center'>$jumlah_warga_l[total]</td> 
                  <td width='100'align='center'>$jumlah_warga_p[total]</td>
                  <td width='100'align='center'>$jumlah_wna_l[total]</td>
                  <td width='100'align='center'>$jumlah_wna_p[total]</td>
                  <td width='50'align='center'>$jumlah_warga_laki[total]</td>
                  <td width='50'align='center'>$warga_perempuan[total]</td>
                  <td width='50'align='center'>$jml_gender[jumlah]</td>     
              </tr>"; 
             
            
            ?> 
            </tbody>
            </table>

                  <nobreak><br>
                    <table cellspacing="0" style="width: 100%; text-align: left;">
                        <tr>
                            <td style="width:70%;"></td>
                          <td style="width:30%; ">
                                <p>Klaten,<?php echo date('d-M-Y', time()); ?> <br>
                                    Kepala Desa </p>
                                   
                                    <img style="width:20%;" src="../../assets/images/cap.png"/>
                                    <br>
                                    <?php echo $user['nama']; ?><br />
                                    <hr style="width:5%; >
                                 </td>
                        </tr>
                    </table>
                </nobreak>

            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
        <thead style="background:#e8ecee">
          <tr>
            <th rowspan="2" style="text-align:center;vertical-align:middle">No</th>
            <th rowspan="2" style="text-align:center;vertical-align:middle">MUTASI</th>
            <th colspan="3" style="text-align:center;vertical-align:middle">DATANG</th>
            <th colspan="3" style="text-align:center;vertical-align:middle">PINDAH/KELUAR</th>
          </tr>
          <tr>
            <th width="100px" style="text-align:center;vertical-align:middle">Laki-Laki</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Perempuan</th>
            <th width="100px" style="text-align:center;vertical-align:middle">JML</th>
            <th width="100px" style="text-align:center;vertical-align:middle">Laki-laki</th> 
            <th width="100px" style="text-align:center;vertical-align:middle">Perempuan</th>
             <th width="200px" style="text-align:center;vertical-align:middle">JML</th>

          </tr>
        </thead>
                
           
                <tbody>
               <?php
           echo "<tr>
                   
                  <td align='center'>1</td>
                  <td>Antar Desa/ Kelurahan</td>
                   <td align='center'>$l_datang_2[total]</td> 
                  <td align='center'>$p_datang_2[total]</td>
                  <td align='center'>$tot_datang_2[total]</td>
                  <td align='center'>$l_luar_2[total]</td>
                  <td align='center'>$p_luar_2[total]</td> 
                  <td align='center'>$tot_luar_2[total]</td>      
              </tr>
               <tr>
                <td align='center'>3</td>
                  <td>Antar Kecamatan</td>
                  <td align='center'>$l_datang_3[total]</td> 
                  <td align='center'>$p_datang_3[total]</td>
                  <td align='center'>$tot_datang_3[total]</td>
                  <td align='center'>$l_luar_3[total]</td>
                  <td align='center'>$p_luar_3[total]</td> 
                  <td align='center'>$tot_luar_3[total]</td> 
                       
              </tr>
               <tr>
                <td align='center'>4</td>
                  <td>Antar Dati II/ Kabupaten</td>
                  <td align='center'>$l_datang_4[total]</td>
                  <td align='center'>$l_datang_4[total]</td>
                  <td align='center'>$tot_datang_4[total]</td>
                  <td align='center'>$l_luar_4[total]</td> 
                  <td align='center'>$p_luar_4[total]</td> 
                  <td align='center'>$tot_luar_4[total]</td>
                     
              </tr>
               <tr>
                <td align='center'>5</td>
                  <td>Antar propinsi</td>
                  <td align='center'>$l_datang_5[total]</td>
                  <td align='center'>$l_datang_5[total]</td>
                  <td align='center'>$tot_datang_5[total]</td>
                  <td align='center'>$l_luar_5[total]</td> 
                  <td align='center'>$p_luar_5[total]</td> 
                  <td align='center'>$tot_luar_5[total]</td> 
                      
              </tr>"; 
              ?>
            </tbody>
               
            
            
            </table>
            
    </div>
          
 </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
    $filename="Rekapdatang.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
    //==========================================================================================================
    $content = ob_get_clean();
    $content = '<page style="font-family: freeserif">'.($content).'</page>';
    // panggil library html2pdf
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(10, 15, 15, 15));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    }
    catch(HTML2PDF_exception $e) { echo $e; }
?>


