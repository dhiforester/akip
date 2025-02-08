<header id="header" class="header fixed-top d-flex align-items-center nav_background">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/<?php echo "$favicon"; ?>" alt="">
            <span class="d-none d-lg-block text-white"><?php echo "$title_page"; ?></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn text-white"></i>
    </div>
    <div class="search-bar">
        <form action="index.php?Page=Help&Sub=HelpHome" class="search-form d-flex align-items-center" method="POST">
            <input type="text" name="keyword" placeholder="Cari Bantuan" title="Cari Bantuan">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle text-light" href="javascript:void(0);">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon text-light" href="javascript:void(0);" data-bs-toggle="dropdown" id="MenampilkanBelNotifikasi">
                    
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" id="MenampilkanNotificationList">
                    
                </ul>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                            <h4>David Muldon</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                        <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>
                </ul>
            </li> -->
            <?php 
                if(!empty($SessionIdAkses)) { 
            ?>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <img src="assets/img/User/<?php echo $SessionGambar;?>" alt="Profile" class="rounded-circle" width="30px" height="30px">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-light"><?php echo $SessionNama;?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $SessionNama;?></h6>
                            <span><?php echo $SessionAkses;?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?Page=MyProfile">
                                <i class="bi bi-person"></i>
                                <span>Profile Saya</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?Page=MyProfile&Sub=EditProfile&id_akses=<?php echo "$SessionIdAkses"; ?>">
                                <i class="bi bi-gear"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?Page=MyProfile&Sub=ChangePassword&id_akses=<?php echo "$SessionIdAkses"; ?>">
                                <i class="bi bi-key"></i>
                                <span>Ganti Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?Page=Help&Sub=HelpHome">
                                <i class="bi bi-question-circle"></i>
                                <span>Butuh Bantuan?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </nav>
</header>