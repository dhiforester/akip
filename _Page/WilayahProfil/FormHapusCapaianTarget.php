<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_target_capaian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_target_capaian=$_POST['id_target_capaian'];
        $periode=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'periode');
?>
        <input type="hidden" name="id_target_capaian" value="<?php echo "$id_target_capaian"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "$periode"; ?></b>
            </div>
        </div>
<?php } ?>