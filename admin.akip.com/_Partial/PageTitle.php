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
            echo '<h1><a href=""><i class="bi bi-person-circle"></i> Profil Saya</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Profil Saya</li>';
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
        if($_GET['Page']=="PeriodeEvaluasi"){
            echo '<h1><a href=""><i class="bi bi-calendar"></i> Periode Evaluasi</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Periode Evaluasi</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Akses"){
            if(empty($_GET['Sub'])){
                echo '<h1><a href=""><i class="bi bi-person"></i> Akses</a></h1>';
                echo '<nav>';
                echo '  <ol class="breadcrumb">';
                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                echo '      <li class="breadcrumb-item active">Akses</li>';
                echo '  </ol>';
                echo '</nav>';
            }else{
                if($_GET['Sub']=="AturIjinAkses"){
                    echo '<h1><i class="bi bi-person-badge"></i> Atur ijin Akses</h1>';
                    echo '<nav>';
                    echo '  <ol class="breadcrumb">';
                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=Akses">Akses</a></li>';
                    echo '      <li class="breadcrumb-item active">Atur ijin Akses</li>';
                    echo '  </ol>';
                    echo '</nav>';
                }else{
                    if($_GET['Sub']=="DetailAkses"){
                        echo '<h1><i class="bi bi-person-badge"></i> Detail Akses</h1>';
                        echo '<nav>';
                        echo '  <ol class="breadcrumb">';
                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Akses">Akses</a></li>';
                        echo '      <li class="breadcrumb-item active">Detail Akses</li>';
                        echo '  </ol>';
                        echo '</nav>';
                    }
                }
            }
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
        
        if($_GET['Page']=="SettingEmail"){
            echo '<h1><a href=""><i class="bi bi-envelope"></i> Pengaturan Email</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Pengaturan Email</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="RegionalData"){
            echo '<h1><a href=""><i class="bi bi-map"></i> Referensi Wilayah</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Referensi Wilayah</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Aktivitas"){
            echo '<h1><a href=""><i class="bi bi-record-btn"></i> Log Aktivitas</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Log Aktivitas</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Help"){
            echo '<h1><a href=""><i class="bi bi-question"></i> Bantuan</a></h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Bantuan</li>';
            echo '  </ol>';
            echo '</nav>';
        }
        if($_GET['Page']=="Error"){
            echo '<h1><i class="bi bi-emoji-angry"></i> Error</h1>';
            echo '<nav>';
            echo '  <ol class="breadcrumb">';
            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
            echo '      <li class="breadcrumb-item active">Error</li>';
            echo '  </ol>';
            echo '</nav>';
        }
    }
    echo '</div>';
?>
