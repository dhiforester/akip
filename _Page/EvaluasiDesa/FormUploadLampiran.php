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
                    $id_evaluasi_jawaban=$explode['3'];
                    $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
                    $keterangan_desa=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'keterangan_desa');
                    $kode=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'kode');
                    $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
                    $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
                    $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
                    $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
                    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
                    <input type="hidden" name="id_evaluasi_jawaban" value="<?php echo "$id_evaluasi_jawaban"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="label_file"><b>Label/Nama File</b></label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="label_file" id="label_file" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="file_name"><b>Upload File</b></label>
                        </div>
                        <div class="col-md-12">
                            <input type="file" name="file_name" id="file_name" class="form-control">
                            <small class="credit" id="fileError" style="display: none;">
                                <code class="text-dark">
                                    File hanya boleh format PDF maksimal 5 mb
                                </code>
                            </small>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>

<script>
    $(document).ready(function() {
        $('#file_name').on('change', function() {
            var fileInput = $(this)[0];
            var file = fileInput.files[0];
            var fileError = $('#fileError');

            // Check if file is selected
            if (file) {
                var fileType = file.type;
                var fileSize = file.size;
                var maxSize = 5 * 1024 * 1024; // 5 MB in bytes

                // Check file type
                if (fileType !== 'application/pdf') {
                    fileError.html('<code class="text-danger">File harus berformat PDF.</code>');
                    fileError.show();
                    fileInput.value = ''; // Clear the file input
                    return;
                }

                // Check file size
                if (fileSize > maxSize) {
                    fileError.html('<code class="text-danger">Ukuran file tidak boleh lebih dari 5 MB.</code>');
                    fileError.show();
                    fileInput.value = ''; // Clear the file input
                    return;
                }
                // If file is valid
                fileError.html('<code class="text-success">File Siap Di Upload.</code>');
            }
        });
    });
</script>