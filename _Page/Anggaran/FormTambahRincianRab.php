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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Apabila anda mengisi data ini maka jumlah setiap item rincian anggaran tahunan akan mengikuti jumlah pada RAB
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kode_rab">Kode RAB</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kode_rab" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kategori_program">Kategori Program</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kategori_program" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="uraian">Uraian</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="uraian" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="volume">Volume</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="volume" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="satuan">Satuan</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="satuan" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="harga">Harga (Rp)</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="harga" class="form-control">
        </div>
    </div>
<?php } ?>