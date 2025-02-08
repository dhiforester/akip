<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_wilayah'])){
        echo '<span class="text-danger">ID Wilayah tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM wilayah WHERE id_wilayah='$id_wilayah'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusRegionalDataBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>