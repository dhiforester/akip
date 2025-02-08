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
        $id_anggaran=$_POST['id_anggaran'];
        $periode_awal=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_awal');
        $periode_akhir=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_akhir');
?>
        <input type="hidden" name="id_anggaran" value="<?php echo "$id_anggaran"; ?>">
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <b><?php echo "Periode Anggaran<br> Tahun $periode_awal - $periode_akhir"; ?></b>
            </div>
        </div>
<?php } ?>