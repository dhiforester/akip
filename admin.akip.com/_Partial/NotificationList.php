<?php
    //Karena Ini Di running Dengan JS maka Panggil Ulang Koneksi
    include "../_Config/Connection.php";
    include "../_Config/Function.php";
    include "../_Config/Session.php";
    
    $JumlahPembelianMenunggu=0;
    $JumlahNotifikasi=0;
    //Apabila Tidak ada notifgikasi
    if(empty($JumlahNotifikasi)){
        echo '<li class="dropdown-header">';
        echo '  Tidak Ada Pemberitahuan Yang Tersedia';
        echo '</li>';
    }else{
        //Apabila Ada
        echo '<li class="dropdown-header">';
        echo '  Anda Mempunyai '.$JumlahNotifikasi.' pemberitahuan';
        echo '</li>';
        if(!empty($JumlahPembelianMenunggu)){
            echo '<li><hr class="dropdown-divider"></li>';
            echo '<li class="notification-item">';
            echo '  <i class="bi bi-exclamation-circle text-danger"></i>';
            echo '  <div>';
            echo '      <h4><a href="index.php?Page=Event">Event Belum Diatur</a></h4>';
            echo '      <p>Ada '.$JumlahPembelianMenunggu.' event belum memiliki data kategori</p>';
            echo '  </div>';
            echo '</li>';
        }
    }
?>