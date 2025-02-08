<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_evaluasi
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Event Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_evaluasi=$_POST['id_evaluasi'];
        $periode=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode');
        $periode_awal=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_awal');
        $periode_akhir=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'periode_akhir');
        $updatetime=getDataDetail($Conn,'evaluasi','id_evaluasi',$id_evaluasi,'updatetime');
?>
    <input type="hidden" name="id_evaluasi" id="id_evaluasi" class="form-control" value="<?php echo "$id_evaluasi"; ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="periode">Periode Evaluasi</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="periode" id="periode" class="form-control" value="<?php echo "$periode"; ?>">
            <small>Periode Tahun Evaluasi</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="periode_awal">Periode Awal</label>
        </div>
        <div class="col-md-8">
            <input type="date" name="periode_awal" id="periode_awal" class="form-control" value="<?php echo "$periode_awal"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="periode_akhir">Periode Akhir</label>
        </div>
        <div class="col-md-8">
            <input type="date" name="periode_akhir" id="periode_akhir" class="form-control" value="<?php echo "$periode_akhir"; ?>">
        </div>
    </div>
<?php } ?>