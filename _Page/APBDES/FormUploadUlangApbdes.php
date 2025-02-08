<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID APBDES
    if(empty($_POST['id_apbdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID APBDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_apbdes=$_POST['id_apbdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_apbdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID APBDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_apbdes='$id_apbdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_apbdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID APBDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
?>
                <input type="hidden" name="id_apbdes" value="<?php echo "$id_apbdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="dokumen_apbdes2">Dokumen APBDES</label>
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="dokumen_apbdes2" id="dokumen_apbdes2" class="form-control">
                        <p><small id="errorContainer2"></small></p>
                        <small class="credit">
                            <code class="text-info">
                                Keterangan :
                                <ul>
                                    <li>Dokumen berformat PDF maksimal 5 mb</li>
                                    <li>Merupakan dokumen resmi yang sudah di tanda tangani dan melampirkan daftar hadir</li>
                                </ul>
                            </code>
                        </small>
                    </div>
                </div>
<?php
            }
        }
    }
?>
<script>
    // Menambahkan event listener untuk input file
    $('#dokumen_apbdes2').change(function(){
        // Membersihkan pesan error jika ada
        $('#errorContainer2').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#errorContainer2').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        if (file.type !== 'application/pdf') {
            $('#errorContainer2').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file PDF.</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#errorContainer2').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        $('#errorContainer2').html('<code class="text-success">File Siap Di Upload.</code>');
        return;
    });
</script>