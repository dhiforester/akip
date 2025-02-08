<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_struktur_organisasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_struktur_organisasi=$_POST['id_struktur_organisasi'];
        $nama=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'nama');
?>
        <input type="hidden" name="id_struktur_organisasi" value="<?php echo "$id_struktur_organisasi"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "$nama"; ?></b>
            </div>
        </div>
<?php } ?>