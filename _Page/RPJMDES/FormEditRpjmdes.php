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
                    <div class="col-md-4">
                        <label for="periode_awal">Periode RPJMDES</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" step="1" name="periode_awal" id="periode_awal" class="form-control" value="<?php echo $periode_awal; ?>">
                        <small class="credit">Periode Tahun Awal</small>
                    </div>
                    <div class="col-md-4">
                        <input type="number" step="1" name="periode_akhir" id="periode_akhir" class="form-control" value="<?php echo $periode_akhir; ?>">
                        <small class="credit">Periode Tahun Awal</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="kepala_desa">Kepala Desa</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="kepala_desa" id="kepala_desa" class="form-control" value="<?php echo $kepala_desa; ?>">
                        <small class="credit">Nama lengkap dan gelar</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="sekretaris_desa">Sekretaris Desa</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="sekretaris_desa" id="sekretaris_desa" class="form-control" value="<?php echo $sekretaris_desa; ?>">
                        <small class="credit">Nama lengkap dan gelar</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="jumlah_anggaran">Jumlah Anggaran</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="jumlah_anggaran" id="jumlah_anggaran2" class="form-control" value="<?php echo $jumlah_anggaran; ?>">
                        <small class="credit">Jumlah Total Anggaran Pada RPJMDES</small>
                    </div>
                </div>
<?php
            }
        }
    }
?>
<script>
    $('#jumlah_anggaran2').on('input', function() {
        // Menghapus semua karakter selain angka
        var angka = $(this).val().replace(/\D/g, '');
        
        // Mengubah format angka menjadi ribuan (misal: 1000 menjadi 1.000)
        var formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        
        // Menetapkan nilai input dengan format yang diinginkan
        $(this).val(formattedAngka);
    });
</script>