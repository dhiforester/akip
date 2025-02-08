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
                    //Cek Apakah Jawaban Sudah Ada Atau Belum
                    $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                    $DataJawaban = mysqli_fetch_array($QryJawaban);
                    if(empty($DataJawaban['id_evaluasi_jawaban'])){
                        $id_evaluasi_jawaban="";
                        $jawaban="";
                        $keterangan_desa="";
                        $status="";
                    }else{
                        $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                        $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
                        $keterangan_desa=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan_desa');
                        $status=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'status');
                    }
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
                    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
                    <div class="row mb-3">
                        <div class="col col-md-12"><b>Pernyataan</b></div>
                        <div class="col col-md-12">
                            <small class="credit"><code class="text text-dark"><?php echo "$kode. $teks"; ?></code></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12"><b>Alternatif Jawaban</b></div>
                        <div class="col-md-12 table table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td align="center"><b>Pilih</b></td>
                                    <td align="center"><b>Label</b></td>
                                    <td align="center"><b>Alternatif</b></td>
                                </tr>
                                <?php
                                    $data_array = json_decode($alternatif, true);
                                    foreach ($data_array as $item) {
                                        $charr=$item['char'];
                                        $label=$item['label'];
                                        $nilai=$item['nilai'];
                                        echo '<tr>';
                                        if($jawaban==$charr){
                                            echo '  <td align="center"><input type="radio" checked name="jawaban" value="'.$charr.','.$nilai.'"></td>';
                                        }else{
                                            echo '  <td align="center"><input type="radio" name="jawaban" value="'.$charr.','.$nilai.'"></td>';
                                        }
                                        echo '  <td align="center">'.$charr.'</td>';
                                        echo "  <td>$label</td>";
                                        echo '</tr>';
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan_desa"><b>Keterangan/Catatan</b></label>
                        </div>
                        <div class="col-md-12">
                            <textarea name="keterangan_desa" id="keterangan_desa" class="form-control"><?php echo $keterangan_desa; ?></textarea>
                            <small class="credit">
                                <code class="text-dark">*Catatan khusus jika diperlukan</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="status"><b>Status</b></label>
                        </div>
                        <div class="col-md-12">
                            <select name="status" id="status" class="form-control">
                                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                                <option <?php if($status=="Refisi"){echo "selected";} ?> value="Refisi">Refisi</option>
                                <option <?php if($status=="Verifikasi"){echo "selected";} ?> value="Verifikasi">Verifikasi</option>
                            </select>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>