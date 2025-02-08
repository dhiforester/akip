<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'krlPLqyU8Z');
    if(empty($IjinAksesSaya)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Anda Tidak Memiliki Ijin Akses Untuk Masuk Ke Halaman Ini!';
        echo '  </div>';
        echo '</div>';
    }else{
        //Menangkap Data Parameter
        if(empty($_POST['GetData'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Parameter Data Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $GetData=$_POST['GetData'];
            //Explode
            $explode1=explode(',',$GetData);
            $id_rpjmdes=$explode1['0'];
            $periode_rkpdes=$explode1['1'];
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
                echo '  </div>';
                echo '</div>';
            }else{
                //Validasi Keberadaan Data RPJMDES
                $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes'")or die(mysqli_error($Conn));
                $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
                if(empty($DataRpjmdes['id_rpjmdes'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $id_evaluasi=$DataRpjmdes['id_evaluasi'];
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_rpjmdes" value="<?php echo "$id_rpjmdes"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="periode_awal">Periode RKPDES</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" readonly name="periode_rkpdes" id="periode_rkpdes" class="form-control" value="<?php echo $periode_rkpdes;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="kepala_desa">Kepala Desa</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="kepala_desa" id="kepala_desa" class="form-control">
                            <small class="credit">Nama lengkap dan gelar</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="sekretaris_desa">Sekretaris Desa</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="sekretaris_desa" id="sekretaris_desa" class="form-control">
                            <small class="credit">Nama lengkap dan gelar</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="jumlah_anggaran">Jumlah Anggaran</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="jumlah_anggaran" id="jumlah_anggaran" class="form-control">
                            <small class="credit">Jumlah Total Anggaran Pada RPJMDES</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="dokumen">Dokumen RKPDES</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="dokumen" id="dokumen" class="form-control">
                            <p><small id="errorContainer"></small></p>
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
    }
?>
<script>
    $('#jumlah_anggaran').on('input', function() {
        // Menghapus semua karakter selain angka
        var angka = $(this).val().replace(/\D/g, '');
        
        // Mengubah format angka menjadi ribuan (misal: 1000 menjadi 1.000)
        var formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        
        // Menetapkan nilai input dengan format yang diinginkan
        $(this).val(formattedAngka);
    });
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
    });
</script>