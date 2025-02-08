<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
?>
        <input type="hidden" name="id_anggaran_rincian" value="<?php echo "$id_anggaran_rincian"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="format_export">Format Export</label>
                <select name="format_export" id="format_export" class="form-control">
                    <option value="Excel">Excel</option>
                    <option value="HTML">HTML</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                Apakah anda yakin akan melakukan export data ini?
            </div>
        </div>
<?php } ?>