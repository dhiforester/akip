<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_wilayah'])){
        $id_wilayah=$_POST['id_wilayah'];
        $provinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE propinsi='$provinsi' AND kategori='Kabupaten'");
        while ($data = mysqli_fetch_array($query)) {
            $ListIdWilayah= $data['id_wilayah'];
            $kabupaten= $data['kabupaten'];
            echo '<option value="'.$ListIdWilayah.'">'.$kabupaten.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>