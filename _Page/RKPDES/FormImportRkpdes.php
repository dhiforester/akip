<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID RKPDES
    if(empty($_POST['id_rkpdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
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
?>
            <input type="hidden" name="id_rkpdes" value="<?php echo "$id_rkpdes"; ?>">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="file_rkpdes_excel">File Excel RKPDES</label>
                    <input type="file" class="form-control" name="file_rkpdes_excel" id="file_rkpdes_excel">
                    <small class="credit" id="NotifikasiErrorFileExcelRkpdes">
                        <code class="text-info">File hanya boleh berformat excel</code>
                    </small>
                </div>
            </div>
<?php
        }
    }
?>
<script>
    // Menambahkan event listener untuk input file
    $('#file_rkpdes_excel').change(function(){
        // Membersihkan pesan error jika ada
        $('#NotifikasiErrorFileExcelRkpdes').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#NotifikasiErrorFileExcelRkpdes').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        var allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']; // Excel file types
        if (!allowedTypes.includes(file.type)) {
            $('#NotifikasiErrorFileExcelRkpdes').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file Excel (.xlsx atau .xls).</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#NotifikasiErrorFileExcelRkpdes').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        // Jika file memenuhi semua validasi, tampilkan notifikasi "File siap di-upload"
        $('#NotifikasiErrorFileExcelRkpdes').html('<code class="text-success">File siap di-upload.</code>');
    });
</script>