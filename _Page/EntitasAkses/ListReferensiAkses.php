<?php
    //Koneksi
    include "../../_Config/Connection.php";
    if(empty($_POST['mitra'])){
        $mitra="";
    }else{
        $mitra=$_POST['mitra'];
    }
    $no=1;
    //Arraykan data referensi
    $QryReferensi = mysqli_query($Conn, "SELECT*FROM akses_referensi WHERE mitra='$mitra' ORDER BY kode_fitur ASC");
    while ($DataReferensi = mysqli_fetch_array($QryReferensi)) {
        $id_akses_referensi= $DataReferensi['id_akses_referensi'];
        $kode_fitur= $DataReferensi['kode_fitur'];
        $kategori_fitur= $DataReferensi['kategori_fitur'];
        $nama_fitur= $DataReferensi['nama_fitur'];
        echo '<tr>';
        echo '  <td class="text-left">';
        echo '      <input class="form-check-input checkall" type="checkbox" value="'.$kode_fitur.'" id="'.$kode_fitur.'" name="'.$kode_fitur.'">';
        echo '      '.$no.'.'.$kode_fitur.'';
        echo '  </td>';
        echo '  <td class="text-left">'.$kategori_fitur.'</td>';
        echo '  <td class="text-left">'.$nama_fitur.'</td>';
        echo '</tr>';
        $no++;
    }
?>