<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_evaluasi_jawaban
    if(empty($_POST['id_evaluasi_jawaban'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      Parameter Jawaban Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_evaluasi_jawaban=$_POST['id_evaluasi_jawaban'];
        //Buka Detail Jawaban
        $id_kriteria_indikator=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'id_kriteria_indikator');
        $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
        $skor=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'skor');
        $bukti=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'bukti');
        $status=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'status');
        $keterangan=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan');
        //Detail Kriteria Indikator
        $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
        $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
        $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
        $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
        $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
?>
        <input type="hidden" name="id_evaluasi_jawaban" value="<?php echo "$id_evaluasi_jawaban"; ?>">
        <div class="row mb-3">
            <div class="col col-md-4">Level</div>
            <div class="col col-md-8">
                <small class="credit"><code class="text text-dark"><?php echo "$level"; ?></code></small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Kode</div>
            <div class="col col-md-8">
                <small class="credit"><code class="text text-dark"><?php echo "$kode"; ?></code></small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Pernyataan</div>
            <div class="col col-md-8">
                <small class="credit"><code class="text text-dark"><?php echo "$teks"; ?></code></small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Skor</div>
            <div class="col col-md-8">
                <small class="credit"><code class="text text-dark"><?php echo "$skor"; ?></code></small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Jawaban</div>
            <div class="col col-md-8">
                <small class="credit"><code class="text text-dark"><?php echo "$jawaban"; ?></code></small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-4">Lampiran Berkas</div>
            <div class="col col-md-8">
                <?php
                    if(!empty($bukti)){
                        echo '<small class="credit">';
                        echo '<a href="assets/berkas/'.$bukti.'" target="_blank">';
                        echo '  <code>'.$bukti.'</code>';
                        echo '</a>';
                        echo "</small>";
                    }else{
                        echo '<small class="credit">';
                        echo '  <code>Tidak Ada</code>';
                        echo "</small>";
                    }
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="status">Status</label>
            </div>
            <div class="col-md-8">
                <select name="status" id="status" class="form-control">
                    <option <?php if($status=="Dikirim"){echo "selected";} ?> value="Dikirim">Dikirim</option>
                    <option <?php if($status=="Selesai"){echo "selected";} ?> value="Selesai">Selesai</option>
                    <option <?php if($status=="Revisi"){echo "selected";} ?> value="Revisi">Revisi</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="keterangan">Keterangan</label>
            </div>
            <div class="col-md-8">
                <textarea name="keterangan" id="keterangan" class="form-control"><?php echo "$keterangan"; ?></textarea>
                <small class="credit">
                    <code class="text-dark">Isi keterangan untuk memberikan komentar kepada peserta rvaluasi</code>
                </small>
            </div>
        </div>
<?php } ?>