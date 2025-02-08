<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Menangkap ID Referensi Bukti
    if(empty($_POST['id_file_store'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID File Store Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_store=$_POST['id_file_store'];
        //Cek Ketersediaan Data RKPDES
        $Qry= mysqli_query($Conn,"SELECT * FROM file_store WHERE id_file_store='$id_file_store'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_file_store'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID File Store Tidak Ditemukan!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_file_store=$Data['id_file_store'];
            $id_referensi_bukti=$Data['id_referensi_bukti'];
            $nama_file=$Data['nama_file'];
            $type_file=$Data['type_file'];
            $url="$base_url/assets/img/Bukti/$nama_file";
            //Nama Draft Lampiran 
            $nama_bukti=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'nama_bukti');
            echo '<input type="hidden" name="id_file_store" value="'.$id_file_store.'">';
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      File '.$type_file.' ('.$nama_bukti.')';
            echo '  </div>';
            echo '</div>';
            
        }
    }
?>