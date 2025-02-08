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
?>
        <input type="hidden" name="id_akses_pengajuan" value="<?php echo "$id_akses_pengajuan"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo '"'.$nama.'"'; ?></b>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <small class="credit">
                    <code class="text text-grayish">
                        Dengan membatalkan penolakan ini, memungkinkan anda untuk mengatur ulang pengajuan tersebut.
                    </code>
                </small>
            </div>
        </div>
<?php } ?>