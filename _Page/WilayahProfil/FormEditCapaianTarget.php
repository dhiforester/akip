<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_target_capaian
    if(empty($_POST['id_target_capaian'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Demografi Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_target_capaian=$_POST['id_target_capaian'];
        $id_wilayah=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'id_wilayah');
        $periode=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'periode');
        $target_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_miskin');
        $capaian_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_miskin');
        $persen_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_miskin');
        $target_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_stunting');
        $capaian_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_stunting');
        $persen_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_stunting');
        $target_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_ikm');
        $capaian_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_ikm');
        $persen_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_ikm');
        $target_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_idm');
        $capaian_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_idm');
        $persen_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_idm');
        $updatetime=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'updatetime');
?>
    <input type="hidden" name="id_target_capaian" value="<?php echo "$id_target_capaian"; ?>">
    <div class="row mb-3">
        <div class="col-md-12"><b>A. Keluarga Miskin</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="target_miskin">1. Target</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="target_miskin" id="target_miskin" class="form-control" value="<?php echo "$target_miskin"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="capaian_miskin">2. Capaian</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="capaian_miskin" id="capaian_miskin" class="form-control" value="<?php echo "$capaian_miskin"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>B. Pencegahan Stunting</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="target_stunting">1. Target</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="target_stunting" id="target_stunting" class="form-control" value="<?php echo "$target_stunting"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="capaian_stunting">2. Capaian</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="capaian_stunting" id="capaian_stunting" class="form-control" value="<?php echo "$capaian_stunting"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>C. Indeks Kepuasan Masyarakat</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="target_ikm">1. Target</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="target_ikm" id="target_ikm" class="form-control" value="<?php echo "$target_ikm"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="capaian_ikm">2. Capaian</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="capaian_ikm" id="capaian_ikm" class="form-control" value="<?php echo "$capaian_ikm"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12"><b>D. Indeks Desa Membangun</b></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="target_idm">1. Target</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="target_idm" id="target_idm" class="form-control" value="<?php echo "$target_idm"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><label for="capaian_idm">2. Capaian</label></div>
        <div class="col-md-8">
            <input type="number" min="0" name="capaian_idm" id="capaian_idm" class="form-control" value="<?php echo "$capaian_idm"; ?>">
        </div>
    </div>
<?php } ?>