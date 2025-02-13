<?php
    include "../../_Config/Connection.php";
    echo '<option value="">Pilih</option>';
    $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Propinsi'");
    while ($data = mysqli_fetch_array($query)) {
        $id_wilayah= $data['id_wilayah'];
        $propinsi= $data['propinsi'];
        echo '<option value="'.$id_wilayah.'">'.$propinsi.'</option>';
    }
?>