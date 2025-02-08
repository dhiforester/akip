<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['KeywordBy'])){
        echo '<label for="keyword">Kata Kunci</label>';
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="akses"){
            echo '<label for="keyword">Kata Kunci</label>';
            echo '<select name="keyword" id="keyword" class="form-control">';
            echo '  <option value="">Pilih</option>';
            echo '  <option value="Admin">Admin</option>';
            echo '  <option value="Provinsi">Provinsi</option>';
            echo '  <option value="Kabupaten">Kabupaten</option>';
            echo '  <option value="Kecamatan">Kecamatan</option>';
            echo '  <option value="Desa">Desa</option>';
            echo '</select>';
        }else{
            echo '<label for="keyword">Kata Kunci</label>';
            echo '<input type="text" name="keyword" id="keyword" class="form-control">';
        }
    }
?>