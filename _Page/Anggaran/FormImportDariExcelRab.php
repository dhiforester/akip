<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-danger text-center">';
        echo '      ID Rincian Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
        //Mencari ID anggaran
        $id_anggaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'id_anggaran');
?>
    <input type="hidden" name="id_anggaran_rincian" class="form-control" value="<?php echo "$id_anggaran_rincian"; ?>">
    <input type="hidden" name="id_anggaran" class="form-control" value="<?php echo "$id_anggaran"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Download terlebih dulu file template excel untuk import data dari excel
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="_Page/Anggaran/Tamplate_RAB.xlsx" class="btn btn-md btn-success btn-block" target="_blank">
                Download Template
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="file_excel">Upload File</label>
        </div>
        <div class="col-md-12">
            <input type="file" name="file_excel" class="form-control">
        </div>
    </div>
<?php } ?>