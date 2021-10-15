 <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-left">
                            <div class="hamburger sidebar-toggle">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        <div class="float-right">
                           
                                <li class="header-icon dib"><span class="user-avatar"><img src="assets/images/avatar/6.png" height="30px">  <?php echo $_SESSION['nama'];?> <strong>(<?php echo nama_level($_SESSION['id_user']);?>)</strong> <i class="ti-angle-down f-s-10"></i></span>
                                    <div class="drop-down dropdown-profile">
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li><a href="profil.php?mode=prof&id=$_SESSION[id_user]"><i class="ti-user"></i> <span>Profil</span></a></li>
                                               
                                                <li><a href="logout.php"><i class="ti-power-off"></i> <span>Keluar</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>