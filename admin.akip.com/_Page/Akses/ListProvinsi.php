<?php
    include "../../_Config/Connection.php";
    echo '<option value="">Pilih</option>';
    $query = mysqli_query($Conn, "SELECT*FROM wilayah_provinsi ORDER BY provinsi ASC");
    while ($data = mysqli_fetch_array($query)) {
        $id_provinsi= $data['id_provinsi'];
        $provinsi= $data['provinsi'];
        echo '<option value="'.$id_provinsi.'">'.$provinsi.'</option>';
    }
?>