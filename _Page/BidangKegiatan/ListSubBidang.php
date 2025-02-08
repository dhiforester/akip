<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['kode_bidang'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12">';
        echo '      <small class="credit text-danger">Kode Bidang Tidak Boleh Kosong!</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['id_wilayah'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <small class="credit text-danger">ID Wilayahh Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $kode_bidang=$_POST['kode_bidang'];
            $id_wilayah=$_POST['id_wilayah'];
            echo '<option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND kode_bidang='$kode_bidang' AND level='Sub Bidang' ORDER BY kode ASC");
            while ($data = mysqli_fetch_array($query)) {
                $kode= $data['kode_sub_bidang'];
                $nama= $data['nama'];
                echo '<option value="'.$kode.'">'.$kode.'. '.$nama.'</option>';
            }
        }
    }
?>