<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_anggaran_rincian
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Anggaran Rincian Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
        $tahun=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'tahun');
        $kode=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'kode');
        $nama=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'nama');
        $sasaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'sasaran');
        $volume=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'volume');
        $satuan=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'satuan');
        $anggaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'anggaran');
        $durasi=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'durasi');
?>
    <input type="hidden" name="id_anggaran_rincian" id="id_anggaran_rincian" value="<?php echo "$id_anggaran_rincian" ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="sasaran">Sasaran</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="sasaran" id="sasaran" class="form-control" value="<?php echo "$sasaran" ?>">
            <small class="credit"><code class="text-grayish">Sasaran anggaran</code></small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="volume">Volume</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="volume" id="volume" class="form-control" value="<?php echo "$volume" ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="satuan">Satuan</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="satuan" id="satuan" class="form-control" value="<?php echo "$satuan" ?>">
            <small class="credit">
                ex: Unit, Paket, Bundle, dll
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="anggaran">Anggaran (Rp)</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="anggaran" id="anggaran" class="form-control" value="<?php echo "$anggaran" ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="durasi">Lama Pengerjaan</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="durasi" id="durasi" class="form-control" value="<?php echo "$durasi" ?>">
        </div>
    </div>
<?php 
    }

?>