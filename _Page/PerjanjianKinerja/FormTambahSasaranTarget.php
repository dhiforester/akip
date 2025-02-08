<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'585q5gnPq7');
    if(empty($IjinAksesSaya)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Anda Tidak Memiliki Ijin Akses Untuk Masuk Ke Halaman Ini!';
        echo '  </div>';
        echo '</div>';
    }else{
        //Menangkap Data id_perjanjian_kinerja
        if(empty($_POST['id_perjanjian_kinerja'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Perjanjian Kinerja Data Tidak Boleh Kosong!';
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
                //Validasi Keberadaan Data Perjanjian Kinerja
                $Qry = mysqli_query($Conn,"SELECT * FROM perjanjian_kinerja WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'")or die(mysqli_error($Conn));
                $DataPerjanjianKinerja = mysqli_fetch_array($Qry);
                if(empty($DataPerjanjianKinerja['id_perjanjian_kinerja'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID Evaluasi Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                }else{
?>
                    <input type="hidden" name="id_perjanjian_kinerja" value="<?php echo "$id_perjanjian_kinerja"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="sasaran">Sasaran</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="sasaran" id="sasaran" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="indikator">Indikator</label>
                        </div>
                        <div class="col-md-12" id="FormContainer">
                            <div class="input-group mb-3">
                                <input type="text" name="indikator[]" id="indikator" class="form-control" placeholder="Indikator Sasaran">
                                <button type="button" class="btn btn-sm btn-success" id="add_form"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="target">Target</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="target" id="target" class="form-control">
                            <small class="credit">
                                <code class="text text-grayish" for="target">Target (Contoh : 100)</code>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="satuan" id="satuan" class="form-control">
                            <small class="credit">
                                <code class="text-grayish" for="satuan">Satuan (Contoh : Persen)</code>
                            </small>
                        </div>
                    </div>
                    <script>
                        $("#add_form").click(function() {
                            $("#FormContainer").append('<div class="input-group mb-3"><input type="text" name="indikator[]" class="form-control" placeholder="Indikator Sasaran"><button type="button" class="btn btn-sm btn-danger remove"><i class="bi bi-x"></i></button></div>');
                        });
                        $(document).on("click", ".remove", function() {
                            $(this).parent().remove();
                        });
                    </script>
<?php
                }
            }
        }
    }
?>