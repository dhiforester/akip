<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap Data id_capaian
    if(empty($_POST['id_capaian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Capaian Kinerja Data Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_capaian=$_POST['id_capaian'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_capaian)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Capaian Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
?>
                    <input type="hidden" name="id_capaian" value="<?php echo "$id_capaian"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="dokumen"><b>Dokumen</b></label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="dokumen" id="dokumen_upload_ulang" class="form-control">
                            <p><small id="errorContainerUploadUlang"></small></p>
                            <small class="credit">
                                <code class="text-info">
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
?>
<script>
    // Menambahkan event listener untuk input file
    $('#errorContainerUploadUlang').change(function(){
        // Membersihkan pesan error jika ada
        $('#errorContainerUploadUlang').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#errorContainerUploadUlang').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        if (file.type !== 'application/pdf') {
            $('#errorContainerUploadUlang').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file PDF.</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#errorContainerUploadUlang').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        $('#errorContainerUploadUlang').html('<code class="text-success">File Siap Di Upload.</code>');
    });
</script>