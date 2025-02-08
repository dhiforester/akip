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
                        <div class="col-md-12">
                            <b>1. Informasi Perjanjian</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="tanggal">1.1 Tanggal</label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                            <small class="credit">
                                <code class="text-dark">Tanggal Perjanjian Kinerja Sesuai Dokumen</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="kategori">1.2 Kategori Perjanjian</label>
                        </div>
                        <div class="col-md-9">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Kades-Camat">Kepala Desa Dengan Camat</option>
                                <option value="Perangkat-Kades">Perangkat Desa Dengan Kepala Desa</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>2. Pihak Pertama</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="nama_1">2.1 Nama</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_1" id="nama_1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jabatan_1">2.2 Jabatan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jabatan_1" id="jabatan_1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>3. Pihak Kedua</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="nama_2">3.1 Nama</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_2" id="nama_2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jabatan_2">3.2 Jabatan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jabatan_2" id="jabatan_2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dokumen"><b>Dokumen</b></label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="dokumen" id="dokumen" class="form-control">
                            <p><small id="errorContainer"></small></p>
                            <small class="credit">
                                <code class="text-info">
                                    Keterangan :
                                    <ul>
                                        <li>Dokumen berformat PDF maksimal 5 mb</li>
                                        <li>Merupakan dokumen resmi yang sudah di tanda tangani dan melampirkan lembar pengesahan</li>
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
    $('#dokumen').change(function(){
        // Membersihkan pesan error jika ada
        $('#errorContainer').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#errorContainer').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        if (file.type !== 'application/pdf') {
            $('#errorContainer').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file PDF.</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#errorContainer').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        $('#errorContainer').html('<code class="text-success">File Siap Di Upload.</code>');
    });
</script>