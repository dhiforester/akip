<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['akses'])){
        $akses=$_POST['akses'];
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM akses_entitas WHERE akses='$akses'");
        while ($data = mysqli_fetch_array($query)) {
            $id_akses_entitas= $data['id_akses_entitas'];
            $entitas= $data['entitas'];
            echo '<option value="'.$id_akses_entitas.'">'.$entitas.'</option>';
        }
    }
?>