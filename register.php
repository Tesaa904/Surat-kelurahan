<?php
	include "config/koneksi.php";
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Halaman Register | Sistem Informasi Kelurahan</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <!--STYLESHEET-->
        <!--=================================================-->
        <!--Roboto Slab Font [ OPTIONAL ] -->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400" rel="stylesheet">
        <!--Bootstrap Stylesheet [ REQUIRED ]-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--Jasmine Stylesheet [ REQUIRED ]-->
        <link href="css/style.css" rel="stylesheet">
        <!--Font Awesome [ OPTIONAL ]-->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!--Switchery [ OPTIONAL ]-->
        <link href="plugins/switchery/switchery.min.css" rel="stylesheet">
        <!--Bootstrap Select [ OPTIONAL ]-->
        <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <!--Demo [ DEMONSTRATION ]-->
        <link href="css/demo/jasmine.css" rel="stylesheet">
        <!--SCRIPT-->
        <!--=================================================-->
        <!--Page Load Progress Bar [ OPTIONAL ]-->
        <link href="plugins/pace/pace.min.css" rel="stylesheet">
        <script src="plugins/pace/pace.min.js"></script>
    </head>
    <!--TIPS-->
    <!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
    <body>
        <div id="container" class="cls-container">
            
            <!-- REGISTRATION FORM -->
            <!--===================================================-->
            <div class="lock-wrapper">
                <div class="panel lock-box">
                    <div class="center"> <img alt="" src="img/icon8.png" class="img-circle"/> </div>
                    <h4> Registrasi !</h4>

                    <div class="row">
						<?php
							include "alert.php";
							if ((empty($_GET['ac'])) or ($_GET['ac']=="cek_nik")){
						?>
                        <form id="registration" class="form-inline" action="" method="POST">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div id="demo-error-container"></div>
                            </div>
                            <div id="cek_nik" class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <label for="signupInputName" class="control-label">Masukan NIK</label>
                                    <input id="signupInputName" type="text" placeholder="Masukkan NIK" class="form-control" name="nik" autocomplete="off" />
                                </div>
								<button type="submit" class="btn btn-block btn-primary" name="cek_nik">Cek NIK</button>
                            </div>					
                        </form>
						<?php
							} else if ($_GET['ac']=="reg"){
								$nik_decrypt = $_GET['found'];
								$show = mysqli_fetch_array(mysqli_query($mysqli,"select * from m_penduduk where md5(nik)='$nik_decrypt'"));
						?>
                        <form id="registration" class="form-inline" action="" method="POST">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div id="demo-error-container"></div>
                            </div>
                            <div id="daftar" class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <label class="control-label">Nama NIK</label>
                                    <input type="text" class="form-control lock-input" name="nik_found" value="<?php echo $show['nama'];?>" readonly />
                                </div>  
                               <div class="text-left">
                                    <label for="signupInputEmail" class="control-label">Email </label>
                                    <input type="hidden" name="nik_found" value="<?php echo $show['nik'];?>"/>
                                    <input id="signupInputEmail" type="email" placeholder="Masukan akun gmail yang bisa dihubungi" class="form-control" name="email" />
                                </div>
                                <div class="text-left">
                                    <label for="signupInputPassword" class="control-label">Password</label>
                                    <input id="signupInputPassword" type="password" placeholder="Password" class="form-control lock-input" name="password" />
                                </div> 
								<button type="submit" class="btn btn-block btn-primary" name="daftar">Daftar</button>
							</div>						
                        </form>
						<?php
							} else if ($_GET['ac']=="success"){
								echo "<h4><i class='fa fa-check-circle fa-5x'></i></h4>";
								echo "<p>Registrasi akun berhasil, silahkan buka email anda kemudian klik link aktivasi agar akun anda bisa digunakan.</p>";
							}
							if (isset($_POST['cek_nik'])){
								$nik = $_POST['nik'];
								$nik_encrypt = md5($nik);
								$sql_cek = mysqli_query($mysqli,"select * from m_penduduk where nik='$nik'");
								
								$result = mysqli_num_rows($sql_cek);
								
								if($result<1){
									echo "<script>window.location.href='register.php?alert=5'</script>";
								} else {
									echo "<script>window.location.href='register.php?ac=reg&found=$nik_encrypt'</script>";
								}
							} else if (isset($_POST['daftar'])){
								$nik_found = $_POST['nik_found'];
								$email = $_POST['email'];
								$pass = $_POST['password'];
								
								$last_id= mysqli_fetch_array(mysqli_query($mysqli,"SELECT MAX(RIGHT(id_akun,3)) as 'id' FROM m_akun_penduduk"));
								$new_id	= "AK".str_pad(($last_id['id']+1), 3, "0", STR_PAD_LEFT);
								
								$save = mysqli_query($mysqli,"insert into m_akun_penduduk(id_akun,email,pass,nik,verifikasi,aktif) 
													value ('$new_id','$email','$pass','$nik_found','N','N')");
								//email pengirim
								$from = $mail_sender;
								
								//email penerima
								$to = $email;
								
								//subject email
								$subject = "Registrasi Berhasil";
								
								//isi email
								$message = "Registrasi akun anda berhasil, silahkan klik link berikut untuk melakukan aktivasi akun.
											".$mail_server."/act_account.php?a=".md5($nik_found);

								//header email (Judul)
								$headers = "From:" . $from;

								//proses kirim
								$send_mail = mail($to,$subject,$message, $headers);													
								if ($save && $send_mail)
									echo "<script>window.location.href='register.php?ac=success&alert=1'</script>";								
							}
						?>
                    </div>
                </div>
                <div class="registration"><a href="main.php?modul=beranda"> <span class="text-primary">[ Silahkan Kembali Halaman Utama ]</span> </a> </div>
            </div>
            <!--===================================================-->
            <!-- REGISTRATION FORM -->
        </div>
        <!--===================================================-->
        <!-- END OF CONTAINER -->
        <!--JAVASCRIPT-->
        <!--=================================================-->
        <!--jQuery [ REQUIRED ]-->
        <script src="js/jquery-2.1.1.min.js"></script>
        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="js/bootstrap.min.js"></script>
        <!--Fast Click [ OPTIONAL ]-->
        <script src="plugins/fast-click/fastclick.min.js"></script>
        <!--Switchery [ OPTIONAL ]-->
        <script src="plugins/switchery/switchery.min.js"></script>
        <!--Bootstrap Select [ OPTIONAL ]-->
        <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!--Bootstrap Validator [ OPTIONAL ]-->
        <script src="plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
		<script>
			window.setTimeout(function() { $(".alert").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 3000); 
		</script>	
    </body>
</html>