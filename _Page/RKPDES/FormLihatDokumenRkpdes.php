<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID RKPDES
    if(empty($_POST['id_rkpdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RKPDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rkpdes=$_POST['id_rkpdes'];
        //Cek Ketersediaan Data RKPDES
        $Qry= mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_rkpdes'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RKPDES Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_rkpdes=$Data['id_rkpdes'];
            $dokumen=$Data['dokumen'];
            $url="$base_url/assets/img/RKPDES/$dokumen";
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      <iframe src="viewer.php?Folder=RKPDES&File='.$dokumen.'" width="100%" height="600"></iframe>';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>