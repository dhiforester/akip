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
        if(empty($_POST['tahun_anggaran'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Tahun Anggaran Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggaran=$_POST['id_anggaran'];
            $tahun_anggaran=$_POST['tahun_anggaran'];
?>
        <input type="hidden" name="id_anggaran" value="<?php echo "$id_anggaran"; ?>">
        <input type="hidden" name="tahun_anggaran" value="<?php echo "$tahun_anggaran"; ?>">
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
                Apakah anda yakin akan melakukan export data anggaran tahun <b><?php echo "$tahun_anggaran"; ?></b> ini?
            </div>
        </div>
<?php }} ?>