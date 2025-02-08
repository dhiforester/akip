<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['ParameterJawaban'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      Parameter Jawaban Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $ParameterJawaban=$_POST['ParameterJawaban'];
        $explode=explode(',',$ParameterJawaban);
        if(empty($explode['0'])){
            echo '<div class="row">';
            echo '  <div class="col col-md-12 text-center text-danger">';
            echo '      Kriteria Indikator Jawaban Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($explode['1'])){
                echo '<div class="row">';
                echo '  <div class="col col-md-12 text-center text-danger">';
                echo '      ID Evaluasi Jawaban Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                if(empty($explode['2'])){
                    echo '<div class="row">';
                    echo '  <div class="col col-md-12 text-center text-danger">';
                    echo '      ID Wilayah Jawaban Tidak Boleh Kosong!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $id_kriteria_indikator=$explode['0'];
                    $id_evaluasi=$explode['1'];
                    $id_wilayah=$explode['2'];
                    $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
                    $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
                    $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
                    $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
                    $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
                    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <?php echo '<b>'.$teks.'</b>'; ?>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>