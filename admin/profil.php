<?
 error_reporting(0);
    session_start();
    //load function
    include "config/database.php";
  if (empty($_SESSION['username']) && empty($_SESSION['password'])){
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
  // update data
    if (isset($_POST['submit'])) {
     if ((!empty($_POST['id_user']))) {
$sql =mysqli_query($mysqli,"UPDATE m_user SET nama = '".$_POST['nama']."', 
    nip = '".$_POST['nip']."', id_level= '".$_POST['id_level']."', username= '".$_POST['username']."' WHERE id_user = '".$_SESSION['id_user']."'") or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
 // cek query
                          if ($sql) {
                              // jika berhasil tampilkan pesan berhasil update data
                              header("location: main.php?module=home/view.php&alert=3");
                          }
                           else {
                              // Jika gambar gagal diupload, tampilkan pesan gagal upload
                              header("location:main.php?module=home/view.php&alert=5");
                          }
                      }
                    }
        }
?>
<!DOCTYPE html>
<html lang="en">
  <?php
   
    include "config/function.php";
    include "config/fungsi_romawi.php";
    
    include "layout/header.php";
  ?>
    <body>
    <?php
      include "layout/sidebar.php";
      include "layout/navbar.php";
    ?>
        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 p-r-0 title-margin-right">
              <div class="page-title">  
       <?
$prof=$_SESSION['id_user'];
        $query = "SELECT a.*,b.nama_level FROM m_user a LEFT JOIN
m_level b ON a.id_level=b.id_level 
 WHERE id_user='$prof'";

$hasil = mysqli_query($mysqli, $query);
        while ($row = mysqli_fetch_assoc($hasil)) {
  echo'<br/>';
?>
<style>
p {
  border-bottom: 6px solid blue;
  background-color: lightgrey;
}
</style>

<h3 class="box-title margin text-center">Edit Profil</h3>
<center><p></p></center>
         
<br/>
<form class="form-horizontal" role="form" method="post">   
 <!--===================================================-->
          
                        
  <div class="form-group">
    <label class="col-sm-4 control-label">ID User </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_user" value="<?php echo $row['id_user']; ?>" >
    </div>
  </div> 
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Lengkap</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" autofocus="on"  name="nama" value="<?php echo $row['nama']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">NIP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required"name="nip" value="<?php echo $row['nip']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Level </label>
    <div class="col-sm-5">
     <select name="id_level" class="form-control select2">
        <?php
          $sql_level = mysqli_query($mysqli,"select * from m_level order by id_level asc");
          while ($level = mysqli_fetch_array($sql_level)){
            if ($data['id_level']==$level['id_level'])
              $sel = "selected";
            else
              $sel = "";
            echo "<option value='$level[id_level]' $sel>$level[nama_level]</option>";
          }
        ?>
      </select>
    </div>
  </div>
<hr/>
<div class="form-group">
    <label class="col-sm-4 control-label">Username</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="username" value="<?php echo $row['username']; ?>">
    </div>
  </div>  
 <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>   
    </div>
  </div>   


</form>
  <?
  }?>
</div>
</div>
</div>
</div>
</div>
</div>

    <?php
      include "layout/footer.php";
    ?>
    </body>

</html>
  