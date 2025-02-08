<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-danger text-danger">ID Wilayah Tidak Boleh Kosong!</div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $Provinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        $Kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        $Kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
?>
    <input type="hidden" name="id_wilayah" value="<?php echo $id_wilayah; ?>">
    <div class="row mb-3">
        <div class="col-md-4">Provinsi</div>
        <div class="col-md-8">
            <code class="text text-grayish"><?php echo "$Provinsi"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Kabupaten/Kota</div>
        <div class="col-md-8">
            <code class="text text-grayish"><?php echo "$Kabupaten"; ?></code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Kecamatan</div>
        <div class="col-md-8">
            <code class="text text-grayish"><?php echo "$Kecamatan"; ?></code>
        </div>
    </div>
<?php } ?>