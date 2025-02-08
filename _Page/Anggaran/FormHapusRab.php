<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran_rab'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rab=$_POST['id_anggaran_rab'];
        $uraian=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'uraian');
?>
        <input type="hidden" name="id_anggaran_rab" value="<?php echo "$id_anggaran_rab"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "$uraian"; ?></b>
            </div>
        </div>
<?php } ?>