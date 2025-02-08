<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID perjanjian kinerja
    if(empty($_POST['id_perjanjian_kinerja'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Perjanjian Kinerja Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
        //Cek Ketersediaan 
        $Qry= mysqli_query($Conn,"SELECT * FROM perjanjian_kinerja WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_perjanjian_kinerja'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Perjanjian Kinerja Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_perjanjian_kinerja=$Data['id_perjanjian_kinerja'];
            $dokumen=$Data['dokumen'];
            $url="$base_url/assets/img/PerjanjianKinerja/$dokumen";
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      <iframe src="viewer.php?Folder=PerjanjianKinerja&File='.$dokumen.'" width="100%" height="600"></iframe>';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>