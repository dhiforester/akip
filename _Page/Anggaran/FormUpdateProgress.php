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
        $id_wilayah=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'id_wilayah');
        //Buka Data Progress
        $id_anggaran_progress=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'id_anggaran_progress');
        $status_pekerjaan=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'status_pekerjaan');
        $alokasi_anggaran=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'alokasi_anggaran');
        $keterangan=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'keterangan');
        //Ubah Dalam Format Rupiah
        if(!empty($alokasi_anggaran)){
            $AlokasiAnggaranRp="" . number_format($alokasi_anggaran, 0, ',', '.');
        }else{
            $AlokasiAnggaranRp="0";
        }
        
?>
    <input type="hidden" name="id_anggaran_rincian" class="form-control" value="<?php echo "$id_anggaran_rincian"; ?>">
    <input type="hidden" name="id_anggaran" class="form-control" value="<?php echo "$id_anggaran"; ?>">
    <input type="hidden" name="id_wilayah" class="form-control" value="<?php echo "$id_wilayah"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="status_pekerjaan">Status Anggaran</label>
            <select name="status_pekerjaan" id="status_pekerjaan" class="form-control">
                <option <?php if($status_pekerjaan==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status_pekerjaan=="Dalam Pengerjaan"){echo "selected";} ?> value="Dalam Pengerjaan">Dalam Pengerjaan</option>
                <option <?php if($status_pekerjaan=="Terkendala"){echo "selected";} ?> value="Terkendala">Terkendala</option>
                <option <?php if($status_pekerjaan=="Selesai"){echo "selected";} ?> value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="alokasi_anggaran">Jumlah Penyaluran</label>
            <input type="text" name="alokasi_anggaran" id="alokasi_anggaran" class="form-control" placeholder="Rp" value="<?php echo "$AlokasiAnggaranRp"; ?>">
            <small class="credit">
                <code class="text-grayish">Jumlah anggaran yang sudah disalurkan</code>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"><?php echo "$keterangan"; ?></textarea>
            <small class="credit">
                <code class="text-grayish">Keterangan mengenai kendala yang dihadapi dan penjelasan lain yang dibutuhkan</code>
            </small>
        </div>
    </div>
<?php } ?>