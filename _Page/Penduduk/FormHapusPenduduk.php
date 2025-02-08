<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_penduduk'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Penduduk Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_penduduk=$_POST['id_penduduk'];
        $nama=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'nama');
?>
        <input type="hidden" name="id_penduduk" value="<?php echo "$id_penduduk"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "$nama"; ?></b>
            </div>
        </div>
<?php } ?>