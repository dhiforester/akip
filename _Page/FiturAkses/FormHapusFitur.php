<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_akses_fitur'])){
        echo '<code>Data tidak diketahui, mungkin proses akan gagal!</code>';
    }else{
        $id_akses_fitur=$_POST['id_akses_fitur'];
        $NamaFitur=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'nama');
        echo '<b>'.$NamaFitur.'</b>';
        echo '<input type="hidden" name="id_akses_fitur" value="'.$id_akses_fitur.'">';
    }
?>