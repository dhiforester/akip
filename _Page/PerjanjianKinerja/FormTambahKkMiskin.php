<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'VsRJYFSwgl');
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
            $id_evaluasi=$_POST['id_evaluasi'];
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $id_evaluasi)) {
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
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
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jumlah_rt_miskin">Jumlah KK Miskin</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jumlah" id="jumlah_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">Jumlah KK Miskin dasil 1 dan 2 </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="target_rt_miskin">Target</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="target" id="target_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">Jumlah Target Penurunan</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="capaian_rt_miskin">Capaian</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="capaian" id="capaian_rt_miskin" class="form-control">
                            <small class="credit">
                                <code class="text-dark">Capaian Penurunan KK Miskin </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dokumen_kk_miskin">Dokumen</label>
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
</script>