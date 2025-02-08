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
            $nama_file=$Data['nama_file'];
            $type_file=$Data['type_file'];
            $url="$base_url/assets/img/Bukti/$nama_file";
            if($type_file=="PDF"){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      <iframe src="viewer.php?Folder=Bukti&File='.$nama_file.'" width="100%" height="600"></iframe>';
                echo '  </div>';
                echo '</div>';
            }else{
                if($type_file=="JPEG"||$type_file=="PNG"||$type_file=="GIF"){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      <image src="viewer.php?Folder=Bukti&File='.$nama_file.'" width="100%"></image>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center">';
                    echo '      File tidak bisa ditampilkan langsung pada browser. Silahkan Download file tersebut terlebih dulu';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center">';
                    echo '      <a href="'.$url.'" class="btn btn-sm btn-success">Download Dokumen</a>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        }
    }
?>