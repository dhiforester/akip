<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'uWNzEv9I7I');
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
                echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
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
                        <div class="col-md-3">
                            <label for="dokumen"><b>Dokumen</b></label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="dokumen" id="dokumen2" class="form-control">
                            <p><small id="errorContainer2"></small></p>
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
    $('#dokumen2').change(function(){
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
    });
</script>