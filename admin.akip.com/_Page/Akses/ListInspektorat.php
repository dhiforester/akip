<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_kabkot'])){
        $id_kabkot=$_POST['id_kabkot'];
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM inspektorat WHERE id_kabkot='$id_kabkot' ORDER BY nama_inspektorat ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_inspektorat= $data['id_inspektorat'];
            $nama_inspektorat= $data['nama_inspektorat'];
            echo '<option value="'.$id_inspektorat.'">'.$nama_inspektorat.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>