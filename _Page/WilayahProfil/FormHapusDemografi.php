<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah_demografi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah_demografi=$_POST['id_wilayah_demografi'];
        $periode=getDataDetail($Conn,'wilayah_demografi','id_wilayah_demografi',$id_wilayah_demografi,'periode');
?>
        <input type="hidden" name="id_wilayah_demografi" value="<?php echo "$id_wilayah_demografi"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "$periode"; ?></b>
            </div>
        </div>
<?php } ?>