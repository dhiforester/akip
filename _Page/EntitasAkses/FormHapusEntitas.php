<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_akses_entitas'])){
        echo '<span>ID Entitas Tidak Boleh Kosong! Proses mungkin akan gagal!</span>';
    }else{
        $id_akses_entitas=$_POST['id_akses_entitas'];
        $akses=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'akses');
        $entitas=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
        $standar_fitur=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
?>
        <input type="hidden" name="id_akses_entitas" value="<?php echo "$id_akses_entitas"; ?>">
        <b><?php echo "$entitas"; ?></b>
<?php } ?>