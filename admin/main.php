<!DOCTYPE html>
<html lang="en">
	<?php
		error_reporting(0);
		session_start();
		//load function
		include "config/database.php";
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
								<h4><?php echo name_from_modul($_GET['modul']);?></h4>
								<hr>
							</div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <section id="main-content">
						<?php
							include "alert.php";
							include "content.php";
						?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer">
                                    <p>Kelurahan Kraguman © <?php echo date('Y');?>. All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
		<?php
			include "layout/footer.php";
		?>
    </body>

</html>
