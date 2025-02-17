<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_kabkot'])){
        $id_kabkot=$_POST['id_kabkot'];
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM opd WHERE id_kabkot='$id_kabkot' ORDER BY nama_opd ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_opd= $data['id_opd'];
            $nama_opd= $data['nama_opd'];
            echo '<option value="'.$id_opd.'">'.$nama_opd.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>