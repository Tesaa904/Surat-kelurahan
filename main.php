<?php
	session_start();
	include "config/koneksi.php";
	include "config/function.php";
    include "config/fungsi_romawi.php";
?>
<!DOCTYPE html>
<html lang="en">
	<?php
		include "layout/header_css.php"; 
	?>
    <body>
        <div id="container" class="effect mainnav-full">
            <!--NAVBAR-->
            <!--===================================================-->
            <header id="navbar">
                <div id="navbar-container" class="boxed">
					<?php
						include "layout/navbar_header.php";
						include "layout/navbar_menu.php";
					?>
                </div>
            </header>
            <!--===================================================-->
            <!--END NAVBAR-->
            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
					<?php 
						include "content.php";
					?>
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
            </div>
			<?php
				include "layout/footer_text.php";
			?>
            <!--===================================================-->
        </div>
        <!--===================================================-->
        <!-- END OF CONTAINER -->
		<?php
			include "layout/footer_js.php";
		?>
    </body>
</html>