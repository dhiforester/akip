<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    if(empty($_POST['kecamatan'])){
        echo '<option value="">Pilih</option>';
    }else{
        echo '<option value="">Pilih</option>';
        $kecamatan=$_POST['kecamatan'];
        $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kabupaten='$NamaWilayahOfficial' AND kecamatan='$kecamatan' ORDER BY desa ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_wilayah= $data['id_wilayah'];
            $desa= $data['desa'];
            echo '<option value="'.$id_wilayah.'">'.$desa.'</option>';
        }
    }
?>