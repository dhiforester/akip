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
                $periode=$Data['periode'];
                $kepala_desa=$Data['kepala_desa'];
                $sekretaris_desa=$Data['sekretaris_desa'];
                $jumlah_anggaran=$Data['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
?>
                <input type="hidden" name="id_apbdes" value="<?php echo "$id_apbdes"; ?>">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="periode">Periode apbdes</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly name="periode" id="periode" class="form-control" value="<?php echo $periode;?>">
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
                        <small class="credit">Jumlah Total Anggaran Pada apbdes</small>
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