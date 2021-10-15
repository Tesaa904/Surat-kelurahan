<?php
    session_start();
    include "config/koneksi.php";
    include "config/function.php";
    include "config/fungsi_romawi.php";



?>
<?
$prof=$_SESSION['id_akun'];
        $query = "SELECT a.*,b.nama,b.tmpt_lahir,b.tgl_lahir,b.id_dukuh,c.nama_dukuh,c.rt,c.rw FROM m_akun_penduduk a LEFT JOIN
m_penduduk b ON a.nik=b.nik LEFT JOIN m_dukuh c ON b.id_dukuh=c.id_dukuh WHERE id_akun='$prof'";

$hasil = mysqli_query($mysqli, $query);
        while ($row = mysqli_fetch_assoc($hasil)) {
  echo'<div id="pages-register"></div>';
  echo'<br/>';
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
            <div class="center"> <img alt="" src="img/user96.png" class="img-circle"/> </div>

                        <form id="registration" class="form-inline" action="#">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div id="demo-error-container"></div>
                            </div>

              
                             <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> Informasi Akun</h3>
                                    
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><i class="fa fa-thumb-tack ph-5"></i></td>
                                                    <td> Nama  </td>
                                                    <td><strong><?php echo nama_pend($_SESSION['nik']);?></strong> </td>
                                                </tr>
                                                <tr>
                                                    <td><i></i> </td>
                                                    <td>NIK</td>
                                                    <td><strong><?php echo $row['nik'] ?></strong> </td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-envelope-o ph-5"></i></td>
                                                    <td> Email </td>
                                                    <td><strong><?php echo $row['email'] ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-home ph-5"></i></td>
                                                    <td> Alamat </td>
                                                    <td> <strong> <?php echo $row['nama_dukuh'] ?>, RT:<?php echo $row['rt'] ?> / RW:<?php echo $row['rw'] ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><a href="index.php" class="btn btn-sm btn-primary login-submit-cs"title="Kembali"><i class="fa fa-mail-reply-all ph-5"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?
                        }?>
                        </form>
                    </div>
                </div>
               
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
        <!--Demo script [ DEMONSTRATION ]-->
        <script src="js/demo/pages-register.js"></script>
    </body>
</html>