<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['level_2'])){
        echo '<option value="">No Data</option>';
    }else{
        $level_2=$_POST['level_2'];
        echo '<option value="">Pilih</option>';
        $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_2='$level_2' AND level='Level 3' ORDER BY teks ASC");
        while ($data = mysqli_fetch_array($query)) {
            $kode= $data['level_3'];
            $teks= $data['teks'];
            echo '<option value="'.$kode.'">'.$teks.'</option>';
        }
    }
?>