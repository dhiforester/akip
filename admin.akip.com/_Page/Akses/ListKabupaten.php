<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_provinsi'])){
        $id_provinsi=$_POST['id_provinsi'];
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM wilayah_kabkot WHERE id_provinsi='$id_provinsi'");
        while ($data = mysqli_fetch_array($query)) {
            $id_kabkot= $data['id_kabkot'];
            $kabkot= $data['kabkot'];
            echo '<option value="'.$id_kabkot.'">'.$kabkot.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>