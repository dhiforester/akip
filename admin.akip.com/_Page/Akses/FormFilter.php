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
            $query = mysqli_query($Conn, "SELECT DISTINCT akses FROM akses ORDER BY akses ASC");
            while ($data = mysqli_fetch_array($query)) {
                $akses= $data['akses'];
                echo '<option value="'.$akses.'">'.$akses.'</option>';
            }
            echo '</select>';
        }else{
            echo '<label for="keyword">Kata Kunci</label>';
            echo '<input type="text" name="keyword" id="keyword" class="form-control">';
        }
    }
?>