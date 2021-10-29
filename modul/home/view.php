	
	<div style="padding:10px"></div>
	<div id="page-content">
		<div class="panel panel-default">
			<div class="panel-body" style="text-align:center">
				<h3>SISTEM INFORMASI PELAYANAN KELURAHAN KRAGUMAN</h3>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" >
							<div class="carousel-inner">
								<div class="item active">
									<img src="img/slider/1.jpg" alt="" />
								</div>
								<div class="item">
									<img src="img/slider/3.JPG" alt="" />
								</div>
							</div>
							<ol class="carousel-indicators ">
								 <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
									<li data-target="#carousel-example" data-slide-to="1"></li>
									
							</ol>
							<a class="left carousel-control" href="#carousel-example" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
							</a>
							<a class="right carousel-control" href="#carousel-example" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
							</a>
						</div>					
					</div>
				</div>
				<div style="padding:5px"></div>
				<div class="row">
					<div class="col-md-8">
						<div class="panel-group accordion" id="demo-acc-danger-outline">
							<div class="panel panel-bordered panel-danger">
								<!--Accordion title-->
							   <div class="panel-heading">
									<h4 class="panel-title">
									<a data-parent="#demo-acc-danger-outline" data-toggle="collapse" href="#demo-acd-danger-outline-1"> Keterangan Penggunaan Sistem</a>
									</h4>
								</div>
								<!--Accordion content-->
								<div class="panel-collapse collapse in" id="demo-acd-danger-outline-1">
									<div class="panel-body">
										<p>
										Sistem ini dikembangkan untuk membantu penduduk Kelurahan Kraguman dalam pelayanan pembuatan surat dari Kelurahan.
										<br><br>
										Untuk menikmati fitur yang ada pada sistem ini, masyarakat diharuskan login menggunakan akun yang sudah dimiliki. Jika belum memiliki
										akun, maka dapat melakukan registrasi pada tautan berikut:<br>
										<a class="btn btn-mint" href="register.php">Klik Daftar</a>
										</p>
									</div>
								</div>
							</div>
						</div> 					
					</div>
					<div class="col-md-4">
						<div class="panel-group accordion" id="demo-acc-danger-outline-2">
							<div class="panel panel-bordered panel-primary">
								<!--Accordion title-->
							   <div class="panel-heading">
									<h4 class="panel-title">
									<a data-parent="#demo-acc-danger-outline-2" data-toggle="collapse" href="#demo-acd-danger-outline-2"> SILAHKAN LOGIN</a>
									</h4>
								</div>
								<!--Accordion content-->
								<div class="panel-collapse collapse in" id="demo-acd-danger-outline-2">
									<div class="row" style="padding:5px">
										<div class="col-md-12">
											<form method="POST" action="">
												<div class="form-group">
													<label class="text-muted">Email </label>
													<input id="signupInputEmail1" type="email" placeholder="silakan masukan email" class="form-control" required name="email"autocomplete="off"/>
												</div>
												<div class="form-group">
													<label for="signupInputPassword" class="text-muted">Password</label>
													<input id="signupInputPassword" type="password" placeholder="Password" class="form-control lock-input" required name="password"/>
												</div>
												<button type="submit" class="btn btn-block btn-primary" name="login">Masuk</button>
											</form>										
											<?php
												
												if (isset($_POST['login'])){
													$email = $_POST['email'];
													$password = $_POST['password'];
													
													$sql_akun = mysqli_query($mysqli,"select * from m_akun_penduduk where email = '$email' and pass='$password' and verifikasi='Y' and aktif='Y'");
													$result = mysqli_num_rows($sql_akun);
													$akun = mysqli_fetch_array($sql_akun);
													
													if ($result<1)
														echo "<div class='alert alert-danger'>Username / Password Tidak Sesuai</div>";
													else {
														session_start();
														
														$_SESSION['id_akun']=$akun['id_akun'];
														$_SESSION['nik']=$akun['nik'];
														echo "<div class='alert alert-info'>Login Sukses</div>";
														echo "<meta http-equiv='refresh' content='1;url=main.php?modul=beranda'>";														
													}
												}
											?>										
											<br>
											<a href="forgot_password.php">Lupa Password?</a>
										</div>
									</div>
								</div>
							</div>
						</div> 			
					</div>
				</div>
			</div>
		</div>
	</div>