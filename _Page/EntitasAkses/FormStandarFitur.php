<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['akses'])){
        $akses=$_POST['akses'];
        echo '<label for="standar_fitur">Standar Fitur</label>';
        $no=1;
        $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM akses_fitur WHERE akses='$akses' ORDER BY kategori ASC");
        while ($data = mysqli_fetch_array($query)) {
            $kategori= $data['kategori'];
            echo '<div class="row">';
            echo '  <div class="col-md-12 ml-3">';
            echo '      '.$no.'. '.$kategori.'';
            echo '      <ul>';
            //List Fitur
            $query2 = mysqli_query($Conn, "SELECT * FROM akses_fitur WHERE kategori='$kategori' AND akses='$akses' ORDER BY nama ASC");
            while ($data2 = mysqli_fetch_array($query2)) {
                $id_akses_fitur =$data2['id_akses_fitur'];
                $NamaFitur=$data2['nama'];
                echo '<li>';
                echo '  <input type="checkbox" name="id_akses_fitur[]" id="id_akses_fitur'.$id_akses_fitur.'" value="'.$id_akses_fitur.'">';
                echo '  <label for="id_akses_fitur'.$id_akses_fitur.'">'.$NamaFitur.'</label>';
                echo '</li>';
            }
            echo '      </ul>';
            echo '  </div>';
            echo '</div>';
            $no++;
        }
    }
?>