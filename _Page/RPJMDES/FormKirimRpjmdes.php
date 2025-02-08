<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Evaluasi
    if(empty($_POST['id_rpjmdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rpjmdes=$_POST['id_rpjmdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $periode_rpjmdes=$DataRpjmdes['periode'];
                $kepala_desa=$DataRpjmdes['kepala_desa'];
                $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                //Explode
                $explode=explode('-',$periode_rpjmdes);
                $periode_awal=$explode['0'];
                $periode_akhir=$explode['1'];
?>
                <input type="hidden" name="id_rpjmdes" value="<?php echo "$id_rpjmdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <b><?php echo "Periode $periode_rpjmdes"; ?></b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <code class="text-dark">
                            Apabila anda mengirim berkas RPJMDES ini, maka anda bersedia menunggu proses validasi pihak kecamatan.<br>
                            Dalam masa proses validasi, anda tidak bisa melakukan perubahan sampai dengan mendapatkan instruksi untuk melakukan perbaikan informasi.
                        </code>
                    </div>
                </div>
<?php
            }
        }
    }
?>