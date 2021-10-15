<?php
	if ($_GET['alert']=='1'){
		echo "<div class='alert alert-success role='alert'>
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Berhasil!</strong> Data berhasil disimpan.
				</div>";
	} elseif ($_GET['alert']=='2'){
		echo "<div class='alert alert-danger role='alert'>
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Gagal!</strong> Data gagal disimpan.
				</div>";		
	} elseif ($_GET['alert']=='3'){
		echo "<div class='alert alert-warning role='alert'>
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Berhasil!</strong> Data berhasil dihapus.
				</div>";
	}  elseif ($_GET['alert']=='4'){
		echo "<div class='alert alert-danger role='alert'>
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Gagal!</strong> Data gagal dihapus.
				</div>";
	}  elseif ($_GET['alert']=='5'){
		echo "<div class='alert alert-danger role='alert'>
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				  <strong>Not Found!</strong> NIK tidak ditemukan. Silahkan menghubungi kelurahan untuk pendaftaran akun.
				</div>";
	}	
?>
