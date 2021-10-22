<?php
include "../../config/database.php";
$hari_ini = date("Y-m-d");
$bulan = date('m');

$query_register = "SELECT COUNT(*) AS total FROM m_akun_penduduk WHERE verifikasi='Y' AND aktif='Y'";
$hasil_register = mysqli_query($mysqli, $query_register);
$jumlah_register = mysqli_fetch_assoc($hasil_register);

//jumlah penduduk
$query_warga = "SELECT COUNT(*) AS total FROM m_penduduk where status='1'";
$hasil_warga = mysqli_query($mysqli, $query_warga);
$jumlah_warga = mysqli_fetch_assoc($hasil_warga);

//jumlah penggajuan surat lahr
$query_surat = "SELECT COUNT(*) as total,a.id_status_surat FROM surat_lahir a 
 LEFT JOIN m_akun_penduduk b ON a.id_akun=b.id_akun
 WHERE a.id_status_surat='1'";
$hasil_surat = mysqli_query($mysqli, $query_surat);
$jumlah_surat = mysqli_fetch_assoc($hasil_surat);

//jumlah penggajuan surat mati
$query_surat = "SELECT COUNT(*) as total,a.id_status_surat FROM surat_mati a 
 LEFT JOIN m_akun_penduduk b ON a.id_akun=b.id_akun
WHERE a.id_status_surat='1'";
$hasil_surat = mysqli_query($mysqli, $query_surat);
$mati_surat = mysqli_fetch_assoc($hasil_surat);

//jumlah penggajuan surat datang
$query_surat = "SELECT COUNT(*) as total,a.id_status_surat FROM surat_pindah_datang a 
 LEFT JOIN m_akun_penduduk b ON a.id_akun=b.id_akun
WHERE a.id_status_surat='1'";
$hasil_surat = mysqli_query($mysqli, $query_surat);
$datang_surat = mysqli_fetch_assoc($hasil_surat);

//jumlah penggajuan surat keluar
$query_surat = "SELECT COUNT(*) as total,a.id_status_surat FROM surat_pindah_luar a 
 LEFT JOIN m_akun_penduduk b ON a.id_akun=b.id_akun
WHERE a.id_status_surat='1'";
$hasil_surat = mysqli_query($mysqli, $query_surat);
$keluar_surat = mysqli_fetch_assoc($hasil_surat);

//jumlah penggajuan surat umum
$query_surat = "SELECT COUNT(*) as total,a.id_status_surat FROM surat_ket_umum a 
 LEFT JOIN m_akun_penduduk b ON a.id_akun=b.id_akun
WHERE a.id_status_surat='1'";
$hasil_surat = mysqli_query($mysqli, $query_surat);
$umum_surat = mysqli_fetch_assoc($hasil_surat);

//jumlah mutasi
$query_mutasi = "SELECT COUNT(*) AS total FROM m_penduduk where tgl_masuk='$bulan' and status='2'";
$hasil_mutasi = mysqli_query($mysqli, $query_mutasi);
$jumlah_mutasi = mysqli_fetch_assoc($hasil_mutasi);
?>
</head>
	<body>
	<div class="row">
		<div class="col-lg-3 col-xs-6">
                <a href="main.php?modul=akun_penduduk_view">
			<div class="card">
				<div class="stat-widget-two">
					<div class="stat-content">
						<div class="stat-text">JML Register saat ini </div>
						<div class="stat-digit"> <i class="fa fa-user"></i><?php echo $jumlah_register['total'];?></div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-danger w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
                        </a>
		</div>
		<div class="col-lg-3 col-xs-6"> 
                <a href="main.php?modul=penduduk_view">
			<div class="card">
				<div class="stat-widget-two">
					<div class="stat-content">
						<div class="stat-text">JML Penduduk 
						saat ini</div>
						<div class="stat-digit"> <i class="fa fa-male"></i><?php echo $jumlah_warga['total'];?></div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
                        </a>
		</div>
		
		<div class="col-lg-3 col-xs-6">
                
			<div class="card">
				<div class="stat-widget-two">
					<div class="stat-content">
						<div class="stat-text">Penduduk Mutasi saat ini </div>
						<div class="stat-digit"> <i class="fa fa-user-times"></i><?php echo $jumlah_mutasi['total'];?></div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-primary w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- /# column -->

	<!-- /# row -->

<div class="col-lg-3 col-xs-6">
<a href="">
			<div class="card">
				<div class="stat-widget-two">
					<div class="stat-content">
						<div class="stat-text">Pengajuan surat lahir saat ini</div>
                                    	<div class="stat-digit"> <i class="fa fa-envelope"></i><?php echo $jumlah_surat['total'];?></div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-warning w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
                              
			</div>
                     </a>
		</div>
		<div class="row"> 
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-4">
            	 <a href="">
              <div class="card bg-info text-gray shadow ">
                <div class="card-body">
                  <div class="row no-gutters info-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Pengajuan surat Kematian saat ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-plus-circle"></i> <?php echo $mati_surat['total'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-envelope fa-2x text-gray-300"></i>
                      
                    </div>
                  </div>
                </div>
              </div>
          </a>
            </div>

              <div class="col-xl-3 col-md-4">
              <a href="">
              <div class="card bg-warning shadow ">
                <div class="card-body">
                  <div class="row no-gutters warning-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Pengajuan surat Pindah Datang saat ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-plus-circle"></i> <?php echo $datang_surat['total'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-envelope fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
              <div class="col-xl-3 col-md-4">
              <a href="">
              <div class="card bg-success shadow">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-gray-80 text-uppercase mb-1">Pengajuan surat Pindah Keluar saat ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-plus-circle"></i> <?php echo $keluar_surat['total'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-envelope fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
              <div class="col-xl-3 col-md-4">
              <a href="">
              <div class="card bg-danger shadow">
                <div class="card-body">
                  <div class="row no-gutters danger-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">Pengajuan surat Ket Umum saat ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-plus-circle"></i> <?php echo $umum_surat['total'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-envelope fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>
        </div>

</div>
</body>
