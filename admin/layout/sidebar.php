<?php
	$get_modul = $_GET['modul'];
	$sql_menu = mysqli_query($mysqli,"SELECT b.* FROM m_level_menu a INNER JOIN m_menu b ON a.id_menu=b.id_menu where a.id_level='$_SESSION[id_level]' ORDER BY b.id_menu ASC");
?>
	<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
		<div class="nano">
			<div class="nano-content">
				<div class="logo"><a href="index.html"><span class="fa fa-home"></span><span>SIDEKRA</span></a></div>
				<ul>
					<li class="label">Main Menu</li>
					<?php
						while ($menu = mysqli_fetch_array($sql_menu)){
							if ($menu['tipe']=='1'){
								if (($get_modul == $menu['modul']) or (str_replace("form","view",$get_modul) == $menu['modul']))
									$aktif = "class='active'";
								else
									$aktif = "";
								echo "<li $aktif><a href='main.php?modul=$menu[modul]'><i class='$menu[ikon]'></i> $menu[nama_menu] </a></li>";
							} else {
								$menu_induk = menu_parent($get_modul);
								if ($menu_induk == $menu['id_menu'])
									$menu_aktif = "class='open'";
								else
									$menu_aktif = "";
								
								echo "<li $menu_aktif><a class='sidebar-sub-toggle'><i class='$menu[ikon]'></i>  $menu[nama_menu]  <span class='sidebar-collapse-icon ti-angle-down'></span></a>";
								echo "<ul>";
								$sql_submenu = mysqli_query($mysqli,"select * from m_menu where parent='$menu[id_menu]' and tampil='Y'");
								while ($submenu = mysqli_fetch_array($sql_submenu)){
									if (($get_modul == $submenu['modul']) or (str_replace("form","view",$get_modul) == $submenu['modul']))
										$sub_aktif = "class='active'";
									else
										$sub_aktif = "";
									
									echo "<li $sub_aktif><a href='main.php?modul=$submenu[modul]'><i class='fa fa-bullseye'></i> $submenu[nama_menu] </a></li>";
								}
								echo "</ul>";
								echo "</li>";
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	<!-- /# sidebar -->