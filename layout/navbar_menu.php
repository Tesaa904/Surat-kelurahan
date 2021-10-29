	<nav class="navbar navbar-default megamenu">
		<div class="navbar-header">
			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle">
			<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
			</button>

		</div>
		<!-- end navbar-header -->
		<div id="defaultmenu" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<!-- standard drop down -->
				<li>
					<a href="main.php?modul=beranda"><i class="fa fa-home"></i> Beranda </a>
				</li>
				 <li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-info"></i> Informasi Pelayanan<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="main.php?modul=info"><i class="fa fa-bar-chart"></i> Info Data Penduduk</a></li>
						<li><a href="main.php?modul=syarat"><i class="fa fa-list-alt"></i> Keterangan Pengajuan surat </a></li>
						
					</ul> 
					<!-- end dropdown-menu -->
				</li>
				
				
				 <!-- end standard drop down -->
				 <?php if (empty($_SESSION['id_akun']))
					echo "";
				else {
				 ?>
				 <li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-file"></i> Layanan Pengajuan Surat<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="main.php?modul=surat_lahir"><i class="fa fa-envelope-square"></i> Surat Ket Kelahiran </a></li>
						<li><a href="main.php?modul=surat_mati"><i class="fa fa-envelope-square"></i> Surat Ket Kematian </a></li>
						<li><a href="main.php?modul=surat_datang"><i class="fa fa-envelope-square"></i> Surat Ket Pindah Datang </a></li>
						<li><a href="main.php?modul=surat_keluar"><i class="fa fa-envelope-square"></i> Surat Ket Pindah Keluar </a></li>
						<li><a href="main.php?modul=surat_umum"><i class="fa fa-envelope-square"></i> Surat Ket Umum </a></li>
					</ul> 
					<!-- end dropdown-menu -->
				</li>
				 <li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-folder-open"></i> Riwayat Surat<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="main.php?modul=riw_surat_lahir"><i class="fa fa-save"></i> Surat Ket Kelahiran </a></li>
						<li><a href="main.php?modul=riw_surat_mati"><i class="fa fa-save"></i> Surat Ket Kematian </a></li>
						<li><a href="main.php?modul=riw_surat_datang"><i class="fa fa-save"></i> Surat Ket Pindah Datang </a></li>
						<li><a href="main.php?modul=riw_surat_keluar"><i class="fa fa-save"></i> Surat Ket Pindah Keluar </a></li>
						<li><a href="main.php?modul=riw_surat_umum"><i class="fa fa-save"></i> Surat Ket Umum </a></li>
					</ul>
					<!-- end dropdown-menu -->
				</li>				
				<?php } ?>
				
				<li><a href="admin" target="_new"><i class="fa fa-user"></i> Login Pegawai</a>
				</li>				
			</ul>
			<!-- end nav navbar-nav -->
		</div>
		<!-- end #navbar-collapse-1 -->
	</nav>