<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['level_1'])){
        echo '<option value="">No Data</option>';
    }else{
        $level_1=$_POST['level_1'];
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1' AND level='Level 2' ORDER BY teks ASC");
        while ($data = mysqli_fetch_array($query)) {
            $kode= $data['level_2'];
            $teks= $data['teks'];
            echo '<option value="'.$kode.'">'.$teks.'</option>';
        }
    }
?>