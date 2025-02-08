<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID APBDES
    if(empty($_POST['id_apbdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID APBDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_apbdes=$_POST['id_apbdes'];
        //Cek Ketersediaan Data APBDES
        $Qry= mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_apbdes='$id_apbdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_apbdes'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID APBDES Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_apbdes=$Data['id_apbdes'];
            $dokumen=$Data['dokumen'];
            $url="$base_url/assets/img/APBDES/$dokumen";
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      <iframe src="viewer.php?Folder=APBDES&File='.$dokumen.'" width="100%" height="600"></iframe>';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>