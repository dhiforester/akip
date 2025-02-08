<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Evaluasi Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_evaluasi=$_POST['id_evaluasi'];
        $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
?>
        <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b>Periode <?php echo "$periode"; ?></b>
            </div>
        </div>
<?php } ?>