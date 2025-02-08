<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_bidang_kegiatan
    if(empty($_POST['id_bidang_kegiatan'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Bidang/Kegiatan Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_bidang_kegiatan=$_POST['id_bidang_kegiatan'];
        $nama=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'nama');
?>
    <input type="hidden" name="id_bidang_kegiatan" value="<?php echo "$id_bidang_kegiatan"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama">Nama Bidang/Kegiatan</label>
            <input type="text" name="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
<?php } ?>