<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_akses_entitas'])){
        echo '<span class="text-danger">ID Entitas Tidak Boleh Kosong</span>';
    }else{
        $id_akses_entitas=$_POST['id_akses_entitas'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM akses_entitas WHERE id_akses_entitas='$id_akses_entitas'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusEntitasBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Clear Data Fail</span>';
        }
    }
?>