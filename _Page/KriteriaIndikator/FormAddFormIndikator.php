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
        $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
        $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
        //Inisiasi Kode
        if($level=="Level 1"){
            $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
            $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
            $RealLevel="Level 2";
        }else{
            if($level=="Level 2"){
                $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
                $KodeLevel1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                $QryTeks = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE level_1='$KodeLevel1' AND level='Level 1'")or die(mysqli_error($Conn));
                $DataTeks = mysqli_fetch_array($QryTeks);
                $TeksLevel1=$DataTeks['teks'];
                
                $RealLevel="Level 3";
            }else{
                if($level=="Level 3"){
                    $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_3');
                    $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');

                    $KodeLevel1=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_1');
                    $KodeLevel2=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level_2');
                    
                    $QryTeksLevel1 = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE level_1='$KodeLevel1' AND level='Level 1'")or die(mysqli_error($Conn));
                    $DataTeksLevel2 = mysqli_fetch_array($QryTeksLevel1);
                    $TeksLevel1=$DataTeksLevel2['teks'];

                    $QryTeksLevel2 = mysqli_query($Conn,"SELECT * FROM kriteria_indikator WHERE level_2='$KodeLevel2' AND level='Level 2'")or die(mysqli_error($Conn));
                    $DataTeksLevel2 = mysqli_fetch_array($QryTeksLevel2);
                    $TeksLevel2=$DataTeksLevel2['teks'];

                    $RealLevel="Level 4";
                }else{
                    $RealLevel="Level 1";
                }
            }
        }
?>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="level">Level</label>
        </div>
        <div class="col-md-12">
            <input type="text" readonly name="level" class="form-control" value="<?php echo "$RealLevel"; ?>">
        </div>
    </div>
    <?php if($level=="Level 1"){ ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Indikator</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_1" class="form-control" value="<?php echo "$kode"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_1" class="form-control" value="<?php echo "$teks"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kode">Kode</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="kode" class="form-control" value="">
                <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="teks">Sub Indikator</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="teks" class="form-control" value="">
            </div>
        </div>
    <?php } ?>
    <?php if($level=="Level 2"){ ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Indikator</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_1" class="form-control" value="<?php echo "$KodeLevel1"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_1" class="form-control" value="<?php echo "$TeksLevel1"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Sub Indikator</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_2" class="form-control" value="<?php echo "$kode"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_2" class="form-control" value="<?php echo "$teks"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kode">Kode</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="kode" class="form-control" value="">
                <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="teks">Kriteria</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="teks" class="form-control" value="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="bobot">Bobot</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="bobot" class="form-control" value="">
            </div>
        </div>
    <?php } ?>
    <?php if($level=="Level 3"){ ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Indikator</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_1" class="form-control" value="<?php echo "$KodeLevel1"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_1" class="form-control" value="<?php echo "$TeksLevel1"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Sub Indikator</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_2" class="form-control" value="<?php echo "$KodeLevel2"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_2" class="form-control" value="<?php echo "$TeksLevel2"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="level_1">Kriteria</label>
            </div>
            <div class="col-md-3">
                <input type="text" readonly name="level_3" class="form-control" value="<?php echo "$kode"; ?>">
                <small class="credit"><?php echo "$teks"; ?></small>
            </div>
            <div class="col-md-9">
                <input type="text" readonly name="teks_2" class="form-control" value="<?php echo "$teks"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kode">Kode</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="kode" class="form-control" value="">
                <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="teks">Pernyataan</label>
            </div>
            <div class="col-md-12">
                <input type="text" name="teks" class="form-control" value="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="keterangan">Keterangan</label>
            </div>
            <div class="col-md-12">
                <textarea name="keterangan" class="form-control" ></textarea>
            </div>
        </div>
        <?php
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <label for="alternatif_jawaban">Alternatif Jawaban</label>';
            echo '  </div>';
            echo '  <div class="col-md-12" id="FormContainer3">';
            echo '      <div class="input-group mb-3">';
            echo '          <input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif">';
            echo '          <input type="text" name="alt_label[]" class="form-control" placeholder="Label">';
            echo '          <input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor">';
            echo '          <button type="button" class="btn btn-sm btn-success" id="add_form3"><i class="bi bi-plus"></i></button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        ?>
    <?php } ?>
<?php } ?>

<script>
    $("#add_form3").click(function() {
        $("#FormContainer3").append('<div class="input-group mb-3"><input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif"><input type="text" name="alt_label[]" class="form-control" placeholder="Label"><input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor"><button type="button" class="btn btn-sm btn-danger remove3"><i class="bi bi-x"></i></button></div>');
    });
    $(document).on("click", ".remove3", function() {
        $(this).parent().remove();
    });
</script>