<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap Data id_capaian
    if(empty($_POST['id_capaian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Capaian Data Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $GetParameter=$_POST['id_capaian'];
        $Explode=explode(',',$GetParameter);
        $id_capaian=$Explode['0'];
        $indikator=$Explode['1'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_capaian)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Capaian Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data Evaluasi
            $Qry = mysqli_query($Conn,"SELECT * FROM capaian WHERE id_capaian='$id_capaian'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_capaian'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID capaian Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_capaian=$Data['id_capaian'];
                $jumlah=$Data['jumlah'];
                $target=$Data['target'];
                $capaian=$Data['capaian'];
                $persentase=$Data['persentase'];
                $status=$Data['status'];
                $catatan=$Data['catatan'];
                $json_data_fitur = ReferensiTargetCapaian();
?>
                    <input type="hidden" name="id_capaian" value="<?php echo "$id_capaian"; ?>">
                    <input type="hidden" name="indikator" value="<?php echo "$indikator"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-3">Indikator</div>
                        <div class="col-md-9">
                            <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_title'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="target_rt_miskin2">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_target'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="target" id="target_rt_miskin2" class="form-control" value="<?php echo "$target"; ?>">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_target'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jumlah_rt_miskin2">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_jumlah'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jumlah" id="jumlah_rt_miskin2" class="form-control" value="<?php echo "$jumlah"; ?>">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_jumlah'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="capaian_rt_miskin2">
                                <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'label_capaian'); ?>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="capaian" id="capaian_rt_miskin2" class="form-control" value="<?php echo "$capaian"; ?>">
                            <small class="credit">
                                <code class="text-dark">
                                    <?php echo CekParameterCapaianTarget($json_data_fitur,$indikator,'ket_capaian'); ?>
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="status_capaian">
                                Pilih Status Data
                            </label>
                        </div>
                        <div class="col-md-9">
                            <select name="status" id="status_capaian" class="form-control">
                                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                                <option <?php if($status=="Dikirim"){echo "selected";} ?> value="Dikirim">Dikirim</option>
                                <option <?php if($status=="Refisi"){echo "selected";} ?> value="Refisi">Refisi</option>
                                <option <?php if($status=="Valid"){echo "selected";} ?> value="Valid">Valid</option>
                            </select>
                            <small class="credit" id="KeteranganStatusCapaian">
                                <code class="text-dark">
                                    
                                </code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="catatan">
                                Catatan
                            </label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="catatan" id="catatan" class="form-control"><?php echo "$catatan"; ?></textarea>
                            <small class="credit">
                                <code class="text-dark">
                                    Catatan ini akan terlihat pada halaman lembar kerja desa.
                                </code>
                            </small>
                        </div>
                    </div>
<?php
            }
        }
    }
?>
<script>
    $('#status_capaian').change(function(){
        var status_capaian = $('#status_capaian').val();
        if(status_capaian=="Refisi"){
            $('#KeteranganStatusCapaian').html('<code class="text-danger">Dengan ini menyatakan bahwa data tersebut perlu memperoleh perbaikan</code>');
        }
        if(status_capaian=="Valid"){
            $('#KeteranganStatusCapaian').html('<code class="text-info">Dengan ini menyatakan bahwa data tersebut valid dan sudah sesuai</code>');
        }
        if(status_capaian=="Dikirim"){
            $('#KeteranganStatusCapaian').html('');
        }
        if(status_capaian==""){
            $('#KeteranganStatusCapaian').html('');
        }
    });
</script>