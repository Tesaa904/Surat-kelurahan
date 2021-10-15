<?php
	include "config/koneksi.php";
	error_reporting(0);
	
	$a = $_GET['a'];
	$sql_cek = mysqli_query($mysqli,"select * from m_akun_penduduk where md5(nik)='$a'");
	$num_cek = mysqli_num_rows($sql_cek);
	$data_user = mysqli_fetch_array($sql_cek);
	$id_akun = $data_user['id_akun'];
	$email_user = $data_user['email'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Baru</title>
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
                    <p class="text-center">Masukkan Password Baru Anda!</p>
                    <div class="row">
                        <form method="POST" action="" class="form-inline">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
									<input type="hidden" name="id_akun" value="<?php echo $id_akun;?>">
									<input type="hidden" name="email" value="<?php echo $email_user;?>">
									
                                    <label for="signupInputPassword" class="text-muted">Password Baru</label>
                                    <input id="signupInputPassword" type="password" placeholder="Password" name="new_password" class="form-control lock-input" required />
                                </div>
                                <button type="submit" class="btn btn-block btn-primary" name="send">Reset Password</button>
                            </div>
                        </form>
						<?php
							if (isset($_POST['send'])){
								ini_set('display_errors', 1 );
								error_reporting( E_ALL );
								
								$new_password = $_POST['new_password'];
								$id_akun_ed = $_POST['id_akun'];
								$email_ed = $_POST['email'];
								
								$save_pass = mysqli_query($mysqli,"update m_akun_penduduk set pass='$new_password' where id_akun = '$id_akun_ed'");
								if ($save_pass){								
									//email pengirim
									$from = $mail_sender;
									
									//email penerima
									$to = $email_user;
									
									//subject email
									$subject = "Reset Password";
									
									//isi email
									$message = "Password Anda Berhasil Direset. Silahkan Kembali Login di <a href='".$mail_server."'>.";

									//header email (Judul)
									$headers = "From:" . $from;

									//proses kirim
									$send_mail = mail($to,$subject,$message, $headers);

									if ($send_mail)
										echo "<p><strong>Password Berhasil Direset, silahkan cek email anda pada folder Spam</strong></a></p>";
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