<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Pengajuan Akses Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
        $email=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'email');
?>
        <input type="hidden" name="id_akses_pengajuan" value="<?php echo "$id_akses_pengajuan"; ?>">
        <div class="row mb-3">
            <div class="col col-md-12">
                <b>Identitas Pemohon</b>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Nama</div>
            <div class="col col-md-8">
                <code class="text text-grayish"><?php echo "$nama"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Email</div>
            <div class="col col-md-8">
                <code class="text text-grayish"><?php echo "$email"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="alasan_penolakan">
                    <b>Alasan Penolakan</b>
                </label>
                <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="checkbox" name="kirim_email" id="kirim_email" value="<?php echo "$email"; ?>">
                <label for="kirim_email">Kirim Email Penolakan Ke Pemohon</label>
            </div>
        </div>
<?php } ?>