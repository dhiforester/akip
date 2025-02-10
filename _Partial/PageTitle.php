<?php
    echo '<div class="pagetitle">';
    //Routing Page Title
    if(empty($_GET['Page'])){
        echo '<h1><a href=""><i class="bi bi-grid"></i> Dashboard</a></h1>';
        echo '<nav>';
        echo '  <ol class="breadcrumb">';
        echo '      <li class="breadcrumb-item active">Dashboard</li>';
        echo '  </ol>';
        echo '</nav>';
    }else{
        if($_GET['Page']=="MyProfile"){
            echo '<h1><a href=""><i class="bi bi-person-circle"></i> Profile Saya</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Profile Saya</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Dashboard"){
            echo '<h1><a href=""><i class="bi bi-grid"></i> Dashboard</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item active">Dashboard/'.$NamaWilayahOfficial.'</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Akses"){
            echo '<h1><a href=""><i class="bi bi-key"></i> Daftar Pengguna</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Daftar Pengguna</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="AksesWilayahAdmin"){
            echo '<h1><a href=""><i class="bi bi-person"></i> Akun Akses Wilayah</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Akun Akses Wilayah</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="PengajuanAkses"){
            echo '<h1><a href=""><i class="bi bi-inbox"></i> Pengajuan Akun</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Pengajuan Akun</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Aktivitas"){
            echo '<h1><a href=""><i class="bi bi-key"></i> Log Aktivitas</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Aktivitas</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="SettingGeneral"){
            echo '<h1><a href=""><i class="bi bi-gear"></i> Pengaturan Umum</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Pengaturan Umum</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="ApiKey"){
            echo '<h1><a href=""><i class="bi bi-gear"></i> Pengaturan API Key</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Pengaturan API Key</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="SettingEmail"){
            echo '<h1><a href=""><i class="bi bi-gear"></i> Pengaturan Email Gateway</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Pengaturan Email Gateway</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Wilayah"){
            echo '<h1><a href=""><i class="bi bi-map"></i> Regional Data</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Regional Data</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="BidangKegiatan"){
            echo '<h1><a href=""><i class="bi bi-google"></i> Bidang, Sub Bidang & Kegiatan</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Bidang & Kegiatan</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="KriteriaIndikator"){
            echo '<h1><a href=""><i class="bi bi-google"></i> Kriteria & Indikator</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Kriteria & Indikator</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="ApiDoc"){
            echo '<h1><i class="bi bi-file-code"></i> Dokumentasi API</h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Dokumentasi API</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Help"){
            echo '<h1><i class="bi bi-person-circle"></i> Bantuan</h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Bantuan</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Evaluasi"){
            echo '<h1><a href=""><i class="bi bi-star"></i> Evaluasi</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Bantuan</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        //Level Akses Desa
        if($_GET['Page']=="AksesWilayah"){
            echo '<h1><a href=""><i class="bi bi-key"></i> Daftar Pengguna</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Daftar Pengguna</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="WilayahProfil"){
            echo '<h1><a href=""><i class="bi bi-house-heart"></i> Profil Wilayah</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Daftar Pengguna</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="RPJMDES"){
            echo '<h1><a href=""><i class="bi bi-calendar"></i> RPJMDES</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">RPJMDES</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="RKPDES"){
            echo '<h1><a href=""><i class="bi bi-calendar-range-fill"></i> RKPDES</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">RKPDES</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="APBDES"){
            echo '<h1><a href=""><i class="bi bi-calendar-range-fill"></i> APBDES</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">APBDES</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="PerjanjianKinerja"){
            echo '<h1><a href=""><i class="bi bi-calendar-range-fill"></i> Perjanjian Kinerja</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Perjanjian Kinerja</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Anggaran"){
            echo '<h1><a href=""><i class="bi bi-calendar"></i> Anggaran</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Anggaran</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="WilayahProfilAdmin"){
            echo '<h1><a href=""><i class="bi bi-house-heart"></i> Profil Wilayah</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Daftar Pengguna</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="AnggaranAdmin"){
            echo '<h1><a href=""><i class="bi bi-calendar"></i> Anggaran</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Anggaran</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="LampiranBukti"){
            echo '<h1><a href=""><i class="bi bi-paperclip"></i> Lampiran Bukti</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Lampiran Bukti</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="EvaluasiDesa"){
            echo '<h1><a href=""><i class="bi bi-calendar"></i> Evaluasi</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Evaluasi</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Penduduk"){
            echo '<h1><a href=""><i class="bi bi-person-badge-fill"></i> Penduduk</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Penduduk</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="LembarKerja"){
            echo '<h1><a href=""><i class="bi bi-paperclip"></i> Lembar Kerja</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Lembar Kerja</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        //Level Akses Kecamatan
        if($_GET['Page']=="DesaByKecamatan"){
            echo '<h1><a href=""><i class="bi bi-house-heart"></i> Profil Desa</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Profil Desa</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="PendudukKecamatan"){
            echo '<h1><a href=""><i class="bi bi-people"></i> Penduduk</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Penduduk</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="LembarKerjaKec"){
            echo '<h1><a href=""><i class="bi bi-clipboard-check"></i> Lembar Penilaian Evaluasi</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Lembar Evaluasi</li>';
            echo '  </ol>';
            echo '</nav>';
        }
    }
    echo '</div>';
?>
