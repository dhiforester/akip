<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['KeywordBy'])){
        echo '<label for="keyword">Kata Kunci</label>';
        echo '<input type="text" name="keyword" id="keyword" class="form-control">';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="datetime_log"){
            echo '<label for="keyword">Kata Kunci</label>';
            echo '<input type="date" name="keyword" id="keyword" class="form-control">';
        }else{
            if($KeywordBy=="kategori_log"){
                echo '<label for="keyword">Kata Kunci</label>';
                echo '<select name="keyword" id="keyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT DISTINCT kategori_log FROM log");
                while ($data = mysqli_fetch_array($query)) {
                    $kategori_log= $data['kategori_log'];
                    echo '<option value="'.$kategori_log.'">'.$kategori_log.'</option>';
                }
                echo '</select>';
            }else{
                if($KeywordBy=="id_akses"){
                    echo '<label for="keyword">Kata Kunci</label>';
                    echo '<select name="keyword" id="keyword" class="form-control">';
                    echo '  <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT * FROM akses");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_akses= $data['id_akses'];
                        $nama= $data['nama'];
                        echo '<option value="'.$id_akses.'">'.$nama.'</option>';
                    }
                    echo '</select>';
                }else{
                    echo '<label for="keyword">Kata Kunci</label>';
                    echo '<input type="text" name="keyword" id="keyword" class="form-control">';
                }
            }
        }
    }
?>