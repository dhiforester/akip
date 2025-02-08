<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<option value="">ID Wilayah Tidak Boleh Kosong</option>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        //Cari nama kabupatennya
        $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        //Buka ID wilayah kabupaten tersebut
        $QryWilayah = mysqli_query($Conn,"SELECT * FROM wilayah WHERE kabupaten='$kabupaten' AND kategori='Kabupaten'")or die(mysqli_error($Conn));
        $DataWilayah = mysqli_fetch_array($QryWilayah);
        if(empty($DataWilayah['id_wilayah'])){
            echo '<option value="">ID Kabupaten '.$kabupaten.' Tidak Ditemukang</option>';
        }else{
            $id_wilayah_kabupaten=$DataWilayah['id_wilayah'];
            echo '<option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah_kabupaten' AND level='Bidang' ORDER BY kode ASC");
            while ($data = mysqli_fetch_array($query)) {
                $kode= $data['kode'];
                $nama= $data['nama'];
                echo '<option value="'.$kode.'">'.$kode.'. '.$nama.'</option>';
            }
        }
        
    }
?>