<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran_rab'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rab=$_POST['id_anggaran_rab'];
        $id_anggaran=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'id_anggaran');
        $id_anggaran_rincian=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'id_anggaran_rincian');
        $kode_rab=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'kode_rab');
        $kategori_program=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'kategori_program');
        $volume=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'volume');
        $satuan=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'satuan');
        $harga=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'harga');
        $uraian=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'uraian');
?>
        <input type="hidden" name="id_anggaran_rab" class="form-control" value="<?php echo "$id_anggaran_rab"; ?>">
        <input type="hidden" name="id_anggaran_rincian" class="form-control" value="<?php echo "$id_anggaran_rincian"; ?>">
        <input type="hidden" name="id_anggaran" class="form-control" value="<?php echo "$id_anggaran"; ?>">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="kode_rab">Kode RAB</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="kode_rab" class="form-control" value="<?php echo "$kode_rab"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="kategori_program">Kategori Program</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="kategori_program" class="form-control" value="<?php echo "$kategori_program"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="uraian">Uraian</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="uraian" class="form-control" value="<?php echo "$uraian"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="volume">Volume</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="volume" class="form-control" value="<?php echo "$volume"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="satuan">Satuan</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="satuan" class="form-control"  value="<?php echo "$satuan"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="harga">Harga (Rp)</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="harga" class="form-control"  value="<?php echo "$harga"; ?>">
            </div>
        </div>
<?php } ?>