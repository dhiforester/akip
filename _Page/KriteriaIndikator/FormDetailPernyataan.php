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
        $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
        $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
        $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
        $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
        $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
        $keterangan=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'keterangan');
?>
    <div class="row mb-3">
        <div class="col col-md-4">Level</div>
        <div class="col col-md-8">
            <small class="credit"><code class="text text-grayish"><?php echo "$level"; ?></code></small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Kode</div>
        <div class="col col-md-8">
            <small class="credit"><code class="text text-grayish"><?php echo "$kode"; ?></code></small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-4">Pernyataan</div>
        <div class="col col-md-8">
            <small class="credit"><code class="text text-grayish"><?php echo "$teks"; ?></code></small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12">Alternatif</div>
        <div class="col col-md-12">
            <small class="credit">
                <code class="text text-grayish table table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Label</td>
                            <td>Alternatif</td>
                            <td>Skor</td>
                        </tr>
                        <?php
                            $data_array = json_decode($alternatif, true);
                            foreach ($data_array as $item) {
                                $charr=$item['char'];
                                $label=$item['label'];
                                $nilai=$item['nilai'];
                                echo '<tr>';
                                echo "  <td>$charr</td>";
                                echo "  <td>$label</td>";
                                echo "  <td>$nilai</td>";
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </code>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-12">Keterangan</div>
        <div class="col col-md-12">
            <textarea class="form-control" readonly><?php echo "$keterangan"; ?></textarea>
        </div>
    </div>
<?php } ?>