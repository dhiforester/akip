<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Evaluasi
    if(empty($_POST['id_rpjmdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rpjmdes=$_POST['id_rpjmdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $periode_rpjmdes=$DataRpjmdes['periode'];
                $kepala_desa=$DataRpjmdes['kepala_desa'];
                $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                //Explode
                $explode=explode('-',$periode_rpjmdes);
                $periode_awal=$explode['0'];
                $periode_akhir=$explode['1'];
?>
                <input type="hidden" name="id_rpjmdes" value="<?php echo "$id_rpjmdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="periode_tahun">Pilih Tahun Anggaran</label>
                        <select name="periode_tahun" id="periode_tahun" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                                for ($tahun = $periode_awal; $tahun <= $periode_akhir; $tahun++) {
                                    echo '<option value="'.$tahun.'">'.$tahun.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="file_rpjmdes_excel">File Excel RPJMDES</label>
                        <input type="file" class="form-control" name="file_rpjmdes_excel" id="file_rpjmdes_excel">
                        <small class="credit" id="NotifikasiErrorFileExcelRpjmdes">
                            <code class="text-info">File hanya boleh berformat excel</code>
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
    $('#file_rpjmdes_excel').change(function(){
        // Membersihkan pesan error jika ada
        $('#NotifikasiErrorFileExcelRpjmdes').html('');
        
        var file = this.files[0];
        
        // Melakukan validasi jika tidak ada file yang dipilih
        if (!file) {
            $('#NotifikasiErrorFileExcelRpjmdes').html('Silakan pilih file.');
            return;
        }

        // Melakukan validasi jenis file
        var allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']; // Excel file types
        if (!allowedTypes.includes(file.type)) {
            $('#NotifikasiErrorFileExcelRpjmdes').html('<code class="text-danger">Jenis file tidak didukung. Silakan pilih file Excel (.xlsx atau .xls).</code>');
            return;
        }

        // Melakukan validasi ukuran file (maksimum 5MB)
        var maxSize = 5 * 1024 * 1024; // 5 MB dalam bytes
        if (file.size > maxSize) {
            $('#NotifikasiErrorFileExcelRpjmdes').html('<code class="text-danger">Ukuran file terlalu besar. Maksimum 5 MB.</code>');
            return;
        }
        // Jika file memenuhi semua validasi, tampilkan notifikasi "File siap di-upload"
        $('#NotifikasiErrorFileExcelRpjmdes').html('<code class="text-success">File siap di-upload.</code>');
    });
</script>