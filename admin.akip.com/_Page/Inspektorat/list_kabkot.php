<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['id_provinsi'])){
        $id_provinsi=$_POST['id_provinsi'];
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT * FROM wilayah_kabkot WHERE id_provinsi='$id_provinsi' ORDER BY kabkot ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_kabkot= $data['id_kabkot'];
            $kabkot= $data['kabkot'];
            echo '<option value="'.$id_kabkot.'">'.$kabkot.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>