<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap id_referensi_bukti
    if(empty($_POST['id_referensi_bukti'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Referensi Parameter Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_referensi_bukti=$_POST['id_referensi_bukti'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_referensi_bukti)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Referensi Parameter Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM referensi_bukti WHERE id_referensi_bukti='$id_referensi_bukti'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_referensi_bukti'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '     ID Referensi Parameter Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $nama_bukti=$Data['nama_bukti'];
?>
                <input type="hidden" name="id_referensi_bukti" value="<?php echo "$id_referensi_bukti"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <b><?php echo "$nama_bukti"; ?></b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <code>Apabila anda setuju menghapus data parameter ini, maka parameter lampiran/dokumen bukti tersebut tidak akan lagi muncul pada lembar kerja.</code>
                    </div>
                </div>
<?php
            }
        }
    }
?>