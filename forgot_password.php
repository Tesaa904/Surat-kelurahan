<?php
	include "config/koneksi.php";
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Lupa Password</title>
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
            <!-- Start Lock Screen  -->
            <!--===================================================-->
            <div class="lock-wrapper">
                <div class="panel lock-box">
                    <div class="center"> <img alt="" src="img/user.png" class="img-circle"/> </div>
                    <p class="text-center">Masukkan Email Anda!</p>
                    <div class="row">
                        <form method="POST" action="" class="form-inline">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <label for="signupInputPassword" class="text-muted">Email</label>
                                    <input id="signupInputPassword" type="email" placeholder="Email" name="email" class="form-control lock-input" required />
                                </div>
                                <button type="submit" class="btn btn-block btn-primary" name="send">Kirim Link Reset Password</button>
                            </div>
                        </form>
						<?php
							if (isset($_POST['send'])){
								ini_set('display_errors', 1 );
								error_reporting( E_ALL );
								
								$email_user = $_POST['email'];
								$sql_cek = mysqli_query($mysqli,"select * from m_akun_penduduk where email='$email_user'");
								$num_cek = mysqli_num_rows($sql_cek);
								$data_user = mysqli_fetch_array($sql_cek);
								
								if ($num_cek<1){
									echo "<script>window.alert('Email anda tidak terdaftar')</script>";
								} else {
									$bin_nik = md5($data_user['nik']);
									
									//email pengirim
									$from = $mail_sender;
									
									//email penerima
									$to = $email_user;
									
									//subject email
									$subject = "Reset Password";
									
									//isi email
									$message = "Permintaan reset password berhasil, silahkan klik link berikut untuk melanjutkan proses reset password.
												".$mail_server."/set_password.php?a=".$bin_nik;

									//header email (Judul)
									$headers = "From:" . $from;

									//proses kirim
									$send_mail = mail($to,$subject,$message, $headers);

									if ($send_mail)
										echo "Email Berhasil Dikirim, silahkan cek email anda.";
								}
							}
						?>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!-- End Login Screen -->
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
    </body>
</html>