<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID
    if(empty($_POST['id_capaian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Capaian Perjanjian Kinerja Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_capaian=$_POST['id_capaian'];
        //Cek Ketersediaan 
        $Qry= mysqli_query($Conn,"SELECT * FROM capaian WHERE id_capaian='$id_capaian'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_capaian'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Capaian Kinerja Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_capaian=$Data['id_capaian'];
            $dokumen=$Data['dokumen'];
            $url="$base_url/assets/img/Bukti/$dokumen";
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      <iframe src="viewer.php?Folder=Bukti&File='.$dokumen.'" width="100%" height="600"></iframe>';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>