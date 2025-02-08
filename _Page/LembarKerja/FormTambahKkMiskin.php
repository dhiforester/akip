<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'gJv4DZhCUf');
    if(empty($IjinAksesSaya)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Anda Tidak Memiliki Ijin Akses Untuk Masuk Ke Halaman Ini!';
        echo '  </div>';
        echo '</div>';
    }else{
        //Menangkap Data id_evaluasi
        if(empty($_POST['id_evaluasi'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Evaluasi Data Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $GetParameter=$_POST['id_evaluasi'];
            $Explode=explode(',',$GetParameter);
            $id_evaluasi=$Explode['0'];
            $indikator=$Explode['1'];
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $id_evaluasi)) {
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Capaian Tidak Valid atau Mengandung Karakter Ilegal!';
                echo '  </div>';
                echo '</div>';
            }else{
                //Validasi Keberadaan Data Evaluasi
                $QryEvaluasi = mysqli_query($Conn,"SELECT * FROM evaluasi WHERE id_evaluasi='$id_evaluasi'")or die(mysqli_error($Conn));
                $DataEvaluasi = mysqli_fetch_array($QryEvaluasi);
                if(empty($DataEvaluasi['id_evaluasi'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID Evaluasi Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $id_evaluasi=$DataEvaluasi['id_evaluasi'];
                    $PeriodeEvaluasi=$DataEvaluasi['periode'];
                    $json_data_fitur = ReferensiTargetCapaian();
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_wilayah" value="<?php echo "$SessionIdWilayah"; ?>">
                    <input type="hidden" name="indikator" value="<?php echo "$indikator"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-3">Indikator</div>
                        <div class="col-md-9">
                            <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_title'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="target_rt_miskin">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_target'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="target" id="target_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_target'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jumlah_rt_miskin">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_jumlah'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jumlah" id="jumlah_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_jumlah'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="capaian_rt_miskin">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_capaian'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="capaian" id="capaian_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_capaian'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dokumen_kk_miskin">Lampiran/Dokumen</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="dokumen" id="dokumen_kk_miskin" class="form-control">
                            <p><small id="error_kk_misin"></small></p>
                            <small class="credit">
                                <code class="text-dark">
                                    Keterangan :
                                    <ul>
                                        <li>Apabila lampiran dokumen terdiri dari beberapa file, silahkan di satukan terlebih dulu menjadi satu file.</li>
                                        <li>Dokumen berformat PDF maksimal 5 mb</li>
                                        <li>Merupakan dokumen resmi yang sesuai dengan indikator formulir</li>
                                    </ul>
                                </code>
                            </small>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>
<script>
    //Validasi Angka
    $('#jumlah_rt_miskin').on('input', function() {
        var value = $(this).val();
        if (!/^\d*\.?\d*$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });
    $('#target_rt_miskin').on('input', function() {
        var value = $(this).val();
        if (!/^\d*\.?\d*$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });
    $('#capaian_rt_miskin').on('input', function() {
        var value = $(this).val();
        if (!/^\d*\.?\d*$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });
    // Menambahkan event listener untuk input file
    $('#dokumen_kk_miskin').change(function(){
        // Membersihkan pesan error jika ada
        $('#error_kk_misin').html('');
        var file = this.files[0];
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#error_kk_misin').html('Silakan pilih file.');
            return;
        }
        // Melakukan validasi jenis file
        if (file.type !== 'application/pdf') {
            $('#error_kk_misin').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file PDF.</code>');
            return;
        }
        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#error_kk_misin').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        $('#error_kk_misin').html('<code class="text-success">File Siap Di Upload.</code>');
    });
    // Menghitung Capaian dan nilai bulat
    $('#target_rt_miskin').keyup(function(){
        var target_rt_miskin=$('#target_rt_miskin').val();
        var jumlah_rt_miskin=$('#jumlah_rt_miskin').val();
        if(jumlah_rt_miskin!==0||jumlah_rt_miskin!==""){
            var capaian_rt_miskin=(jumlah_rt_miskin/target_rt_miskin)*100;
            var hasil = capaian_rt_miskin.toFixed(2);
            $('#capaian_rt_miskin').val(hasil);
        }
    });
    $('#jumlah_rt_miskin').keyup(function(){
        var target_rt_miskin=$('#target_rt_miskin').val();
        var jumlah_rt_miskin=$('#jumlah_rt_miskin').val();
        if(jumlah_rt_miskin!==0||jumlah_rt_miskin!==""){
            var capaian_rt_miskin=(jumlah_rt_miskin/target_rt_miskin)*100;
            var hasil = capaian_rt_miskin.toFixed(2);
            $('#capaian_rt_miskin').val(hasil);
        }
    });
</script>