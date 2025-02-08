<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran=$_POST['id_anggaran'];
        $kepala_desa=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'kepala_desa');
        $sekretaris_desa=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'sekretaris_desa');
?>
        <input type="hidden" name="id_anggaran" value="<?php echo "$id_anggaran"; ?>">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="kepala_desa">Kades/Lurah</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="kepala_desa" id="kepala_desa" class="form-control" value="<?php echo "$kepala_desa"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="sekretaris_desa">Sekretaris</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="sekretaris_desa" id="sekretaris_desa" class="form-control" value="<?php echo "$sekretaris_desa"; ?>">
            </div>
        </div>
<?php } ?>