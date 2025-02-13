<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_wilayah'])){
        $id_wilayah=$_POST['id_wilayah'];
        $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        //List Kabupaten
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kecamatan='$kecamatan' AND kategori='desa'");
        while ($data = mysqli_fetch_array($query)) {
            $ListIdWilayah= $data['id_wilayah'];
            $desa= $data['desa'];
            echo '<option value="'.$ListIdWilayah.'">'.$desa.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
    }
?>