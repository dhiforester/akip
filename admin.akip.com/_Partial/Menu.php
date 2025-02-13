<?php
    if(empty($_GET['Page'])){
        $PageMenu="";
    }else{
        $PageMenu=$_GET['Page'];
    }
    if(empty($_GET['Sub'])){
        $SubMenu="";
    }else{
        $SubMenu=$_GET['Sub'];
    }
?>
<aside id="sidebar" class="sidebar menu_background">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Dashboard"||$PageMenu!==""){echo "collapsed";} ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu=="FiturAkses"||$PageMenu=="Akses"||$PageMenu=="EntitasAkses"||$PageMenu=="AksesWilayahAdmin"||$PageMenu=="Aktivitas"){echo "";}else{echo "collapsed";} ?>" data-bs-target="#konponen-akses" data-bs-toggle="collapse" href="javascript:void(0);">
                <i class="bi bi-key"></i>
                <span>Akses</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="konponen-akses" class="nav-content collapse <?php if($PageMenu=="Akses"||$PageMenu=="Aktivitas"||$PageMenu=="PengajuanAkses"){echo "show";} ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?Page=Akses" class="<?php if($PageMenu=="Akses"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Daftar Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=Aktivitas" class="<?php if($PageMenu=="Aktivitas"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Log Akses</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=PengajuanAkses" class="<?php if($PageMenu=="PengajuanAkses"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Pengajuan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu=="SettingGeneral"||$PageMenu=="SettingEmail"){echo "";}else{echo "collapsed";} ?>" data-bs-target="#konten-pengaturan" data-bs-toggle="collapse" href="javascript:void(0);">
                <i class="bi bi-gear"></i>
                    <span>Pengaturan</span><i class="bi bi-chevron-down ms-auto">
                </i>
            </a>
            <ul id="konten-pengaturan" class="nav-content collapse <?php if($PageMenu=="SettingGeneral"||$PageMenu=="ApiKey"||$PageMenu=="SettingEmail"||$PageMenu=="SettingPayment"||$PageMenu=="SettingEmail"){echo "show";} ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?Page=SettingGeneral" class="<?php if($PageMenu=="SettingGeneral"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Umum</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=SettingEmail" class="<?php if($PageMenu=="SettingEmail"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Email Gateway</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">Aplikasi</li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Wilayah"){echo "collapsed";} ?>" href="index.php?Page=Wilayah">
                <i class="bi bi-map"></i>
                <span>Regional Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="PeriodeEvaluasi"){echo "collapsed";} ?>" href="index.php?Page=PeriodeEvaluasi">
                <i class="bi bi-calendar"></i>
                <span>Periode Evaluasi</span>
            </a>
        </li>
        <li class="nav-heading">Fitur Lainnya</li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Help"){echo "collapsed";} ?>" href="index.php?Page=Help&Sub=HelpData">
                <i class="bi bi-question"></i>
                <span>Bantuan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>