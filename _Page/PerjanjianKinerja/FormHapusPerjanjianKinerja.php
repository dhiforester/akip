<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Perjanjian Kinerja
    if(empty($_POST['id_perjanjian_kinerja'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Perjanjian Kinerja Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_perjanjian_kinerja)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Perjanjian Kinerja Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM perjanjian_kinerja WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_perjanjian_kinerja'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Perjanjian Kinerja Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $tanggal=$Data['tanggal'];
?>
                <input type="hidden" name="id_perjanjian_kinerja" value="<?php echo "$id_perjanjian_kinerja"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <b><?php echo "Perjanjian Kinerja Tanggal $tanggal"; ?></b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <code class="text-danger">
                            Apabila anda setuju menghapus data ini, maka semua rincian yang terhubung dengan informasi Perjanjian Kinerja  
                            yang anda input sebelumnya akan dihapus dari database.
                        </code>
                    </div>
                </div>
<?php
            }
        }
    }
?>