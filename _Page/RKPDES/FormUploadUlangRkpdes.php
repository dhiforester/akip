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
            $Qry = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_rkpdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RKPDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
?>
                <input type="hidden" name="id_rkpdes" value="<?php echo "$id_rkpdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="dokumen_rkpdes2">Dokumen RKPDES</label>
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="dokumen_rkpdes2" id="dokumen_rkpdes2" class="form-control">
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
    $('#dokumen_rkpdes2').change(function(){
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
    });
</script>