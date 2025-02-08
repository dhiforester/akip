<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_kriteria_indikator
    if(empty($_POST['id_kriteria_indikator'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Kriteria & Indikator Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
        $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
?>
    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <b class="text-danger">
                <?php echo "$teks"; ?>
            </b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <code class="text-primary">
                Apakah anda yakin akan menghapus data ini?
            </code>
        </div>
    </div>
<?php } ?>