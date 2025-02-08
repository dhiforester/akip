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
        //Menangkap Data id_perjanjian_sasaran
        if(empty($_POST['id_perjanjian_sasaran'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Sasaran Perjanjian Kinerja Data Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_perjanjian_sasaran=$_POST['id_perjanjian_sasaran'];
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $id_perjanjian_sasaran)) {
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Sasaran Perjanjian Tidak Valid atau Mengandung Karakter Ilegal!';
                echo '  </div>';
                echo '</div>';
            }else{
                //Validasi Keberadaan Data Perjanjian Sasaran
                $Qry = mysqli_query($Conn,"SELECT * FROM perjanjian_sasaran WHERE id_perjanjian_sasaran='$id_perjanjian_sasaran'")or die(mysqli_error($Conn));
                $DataPerjanjianKinerja = mysqli_fetch_array($Qry);
                if(empty($DataPerjanjianKinerja['id_perjanjian_sasaran'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID Sasaran Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $sasaran=$DataPerjanjianKinerja['sasaran'];
                    $indikator=$DataPerjanjianKinerja['indikator'];
                    $target=$DataPerjanjianKinerja['target'];
                    $satuan=$DataPerjanjianKinerja['satuan_target'];
                    $dataArray = json_decode($indikator, true);
?>
                    <input type="hidden" name="id_perjanjian_sasaran" value="<?php echo "$id_perjanjian_sasaran"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="sasaran">Sasaran</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="sasaran" id="sasaran" class="form-control" value="<?php echo "$sasaran"; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="indikator">Indikator</label>
                        </div>
                        <div class="col-md-12" id="FormContainer2">
                            <?php
                                $no=1;
                                foreach ($dataArray as $item) {
                                    $IndikatorList=$item['indikator'];
                                    if($no==1){
                                        echo '<div class="input-group mb-3">';
                                        echo '  <input type="text" name="indikator[]" id="indikator" class="form-control" placeholder="Indikator Sasaran" value="'.$IndikatorList.'">';
                                        echo '  <button type="button" class="btn btn-sm btn-success" id="add_form2"><i class="bi bi-plus"></i></button>';
                                        echo '</div>';
                                    }else{
                                        echo '<div class="input-group mb-3">';
                                        echo '  <input type="text" name="indikator[]" id="indikator" class="form-control" placeholder="Indikator Sasaran" value="'.$IndikatorList.'">';
                                        echo '  <button type="button" class="btn btn-sm btn-danger remove2"><i class="bi bi-x"></i></button>';
                                        echo '</div>';
                                    }
                                    $no++;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="target">Target</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="target" id="target" class="form-control" value="<?php echo "$target"; ?>">
                            <small class="credit">
                                <code class="text text-grayish" for="target">Target (Contoh : 100)</code>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="satuan" id="satuan" class="form-control" value="<?php echo "$satuan"; ?>">
                            <small class="credit">
                                <code class="text-grayish" for="satuan">Satuan (Contoh : Persen)</code>
                            </small>
                        </div>
                    </div>
                    <script>
                        $("#add_form2").click(function() {
                            $("#FormContainer2").append('<div class="input-group mb-3"><input type="text" name="indikator[]" class="form-control" placeholder="Indikator Sasaran"><button type="button" class="btn btn-sm btn-danger remove2"><i class="bi bi-x"></i></button></div>');
                        });
                        $(document).on("click", ".remove2", function() {
                            $(this).parent().remove();
                        });
                    </script>
<?php
                }
            }
        }
    }
?>