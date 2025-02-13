<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_wilayah'])){
        $id_wilayah=$_POST['id_wilayah'];
        $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$kabupaten' AND kategori='Kecamatan'");
        while ($data = mysqli_fetch_array($query)) {
            $ListIdWilayah= $data['id_wilayah'];
            $kecamatan= $data['kecamatan'];
            echo '<option value="'.$ListIdWilayah.'">'.$kecamatan.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>