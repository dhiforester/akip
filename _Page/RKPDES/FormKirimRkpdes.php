<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID RKPDES
    if(empty($_POST['id_rkpdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RKPDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rkpdes=$_POST['id_rkpdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rkpdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RKPDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $QryRkpdes = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRkpdes = mysqli_fetch_array($QryRkpdes);
            if(empty($DataRkpdes['id_rkpdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RKPDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $periode=$DataRkpdes['periode'];
?>
                <input type="hidden" name="id_rkpdes" value="<?php echo "$id_rkpdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <b><?php echo "RKPDES Periode $periode"; ?></b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <code class="text-dark">
                            Apabila anda mengirim berkas RKPDES ini, maka anda bersedia menunggu proses validasi pihak kecamatan.<br>
                            Dalam masa proses validasi, anda tidak bisa melakukan perubahan sampai dengan mendapatkan instruksi untuk melakukan perbaikan informasi.
                        </code>
                    </div>
                </div>
<?php
            }
        }
    }
?>