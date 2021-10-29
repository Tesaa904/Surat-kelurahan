	  <!--Brand logo & name-->
		<!--================================-->
		<div class="navbar-header">
			<a href="#" class="navbar-brand">
				<div class="brand-title">
                 <img src="img/LOGO_KLATEN.jpg"> SIDEKRA
					<span class="brand-text"></span>
				</div>
			</a>
		</div>
		<!--================================-->
		<!--End brand logo & name-->
		<!--Navbar Dropdown-->
		<!--================================-->
		<div class="navbar-content clearfix">
			<ul class="nav navbar-top-links pull-left">
				<!--Messages Dropdown-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End message dropdown-->
				<!--Notification dropdown-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				
							
						<!--Dropdown footer-->
						
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End notifications dropdown-->
			</ul>
			<?php if (empty($_SESSION['id_akun']))
				echo "";
			else {
			?>
			<ul class="nav navbar-top-links pull-right">
				<li id="dropdown-user" class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
						<span class="pull-right"> <img class="img-circle img-user media-object" src="img/success.png" alt="Profile Picture"> </span>
						<div class="username text-xl"><strong><?php echo nama_pend($_SESSION['nik']);?></strong></div>
					</a>
					<div class="dropdown-menu dropdown-menu-right with-arrow">
						<!-- User dropdown menu -->
						<ul class="head-list">
							<li>
								<a href="infoprofil.php?mode=prof&id=$_SESSION[id_akun]"> <i class="fa fa-user fa-fw"></i> Profil </a>
							</li>
							
							<li>
								<a href="logout.php"> <i class="fa fa-sign-out fa-fw"></i> Keluar </a>
							</li>
						</ul>
					</div>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End user dropdown-->
			</ul>
			<?php } ?>
		</div>