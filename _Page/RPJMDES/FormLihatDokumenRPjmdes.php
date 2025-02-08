<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID RPJMDES
    if(empty($_POST['id_rpjmdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rpjmdes=$_POST['id_rpjmdes'];
        //Cek Ketersediaan Data RPJMDES
        $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
        $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
        if(empty($DataRpjmdes['id_rpjmdes'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RPJMDES Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_rpjmdes=$DataRpjmdes['id_rpjmdes'];
            $periode_rpjmdes=$DataRpjmdes['periode'];
            $kepala_desa=$DataRpjmdes['kepala_desa'];
            $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
            $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
            $status_rpjmdes=$DataRpjmdes['status'];
            $dokumen=$DataRpjmdes['dokumen'];
            $url="$base_url/assets/img/RPJMDES/$dokumen";
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      <iframe src="viewer.php?Folder=RPJMDES&File='.$dokumen.'" width="100%" height="600"></iframe>';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>