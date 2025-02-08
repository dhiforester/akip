<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_kriteria_indikator
    if(empty($_POST['id_kriteria_indikator'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Kriteria & Indikator Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
        $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
        $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
        $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
        $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
        $keterangan=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'keterangan');
        //Inisiasi Kode
        if($level=="Level 1"){
            $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
            $LabelTeks="Indikator";
        }else{
            if($level=="Level 2"){
                $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                $LabelTeks="Sub Indikator";
            }else{
                if($level=="Level 3"){
                    $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_3');
                    $LabelTeks="Kriteria";
                }else{
                    if($level=="Level 4"){
                        $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_4');
                        $LabelTeks="Pernyataan";
                    }else{
                        $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
                        $LabelTeks="";
                    }
                }
            }
        }
?>
    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
    <input type="hidden" name="level" value="<?php echo "$level"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="kode">Kode Kriteria</label>
        </div>
        <div class="col-md-12">
            <input type="text" name="kode" class="form-control" value="<?php echo "$kode"; ?>">
            <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="teks"><?php echo "$LabelTeks"; ?></label>
        </div>
        <div class="col-md-12">
            <input type="text" name="teks" class="form-control" value="<?php echo "$teks"; ?>">
        </div>
    </div>
    <?php
        if($level=="Level 3"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <label for="bobot">Bobot (%)</label>';
            echo '  </div>';
            echo '  <div class="col-md-12">';
            echo '      <input type="text" name="bobot" id="bobot" class="form-control" value="'.$bobot.'">';
            echo '  </div>';
            echo '</div>';
        }
        if($level=="Level 4"){
            $data_array = json_decode($alternatif, true);
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <label for="keterangan">Keterangan</label>';
            echo '  </div>';
            echo '  <div class="col-md-12">';
            echo '      <textarea class="form-control" name="keterangan">'.$keterangan.'</textarea>';
            echo '  </div>';
            echo '</div>';
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <label for="alternatif_jawaban">Alternatif Jawaban</label>';
            echo '  </div>';
            echo '  <div class="col-md-12 mb-3">';
            echo '      <button type="button" class="btn btn-sm btn-success btn-block" id="add_form"><i class="bi bi-plus"></i> Tambah Form</button>';
            echo '  </div>';
            echo '  <div class="col-md-12" id="FormContainerEdit">';
            foreach ($data_array as $item) {
                $char=$item['char'];
                $label=$item['label'];
                $nilai=$item['nilai'];
                echo '      <div class="input-group mb-3">';
                echo '          <input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif" value="'.$char.'">';
                echo '          <input type="text" name="alt_label[]" class="form-control" placeholder="Label" value="'.$label.'">';
                echo '          <input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor" value="'.$nilai.'">';
                echo '          <button type="button" class="btn btn-sm btn-danger remove_edit"><i class="bi bi-x"></i></button>';
                echo '      </div>';
            }
            echo '  </div>';
            echo '</div>';
        }
    ?>
<?php } ?>
<script>
    $("#add_form").click(function() {
        $("#FormContainerEdit").append('<div class="input-group mb-3"><input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif"><input type="text" name="alt_label[]" class="form-control" placeholder="Label"><input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor"><button type="button" class="btn btn-sm btn-danger remove_edit"><i class="bi bi-x"></i></button></div>');
    });
    $(document).on("click", ".remove_edit", function() {
        $(this).parent().remove();
    });
</script>