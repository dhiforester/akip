<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID APBDES
    if(empty($_POST['id_apbdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
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
?>
            <input type="hidden" name="id_apbdes" value="<?php echo "$id_apbdes"; ?>">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="file_excel">File Excel APBDES</label>
                    <input type="file" class="form-control" name="file_excel" id="file_excel">
                    <small class="credit" id="NotifikasiErrorFileExcelAPBDES">
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
    $('#file_excel').change(function(){
        // Membersihkan pesan error jika ada
        $('#NotifikasiErrorFileExcelAPBDES').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#NotifikasiErrorFileExcelAPBDES').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        var allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']; // Excel file types
        if (!allowedTypes.includes(file.type)) {
            $('#NotifikasiErrorFileExcelAPBDES').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file Excel (.xlsx atau .xls).</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#NotifikasiErrorFileExcelAPBDES').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        // Jika file memenuhi semua validasi, tampilkan notifikasi "File siap di-upload"
        $('#NotifikasiErrorFileExcelAPBDES').html('<code class="text-success">File siap di-upload.</code>');
    });
</script>