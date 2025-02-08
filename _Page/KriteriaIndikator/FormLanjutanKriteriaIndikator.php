<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['level'])){
        $level=$_POST['level'];
        if($level=="Level 1"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <label for="teks">Indikator</label>';
            echo '  </div>';
            echo '  <div class="col-md-12">';
            echo '      <input type="text" name="teks" id="teks" class="form-control">';
            echo '  </div>';
            echo '</div>';
        }else{
            if($level=="Level 2"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12">';
                echo '      <label for="level_1">Indikator</label>';
                echo '  </div>';
                echo '  <div class="col-md-12">';
                echo '      <select name="level_1" id="level_1" class="form-control">';
                echo '          <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $kode= $data['kode'];
                    $teks= $data['teks'];
                    echo '<option value="'.$kode.'">'.$teks.'</option>';
                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12">';
                echo '      <label for="teks">Sub Indikator</label>';
                echo '  </div>';
                echo '  <div class="col-md-12">';
                echo '      <input type="text" name="teks" id="teks" class="form-control">';
                echo '  </div>';
                echo '</div>';
            }else{
                if($level=="Level 3"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="level_1">Indikator</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-12">';
                    echo '      <select name="level_1" id="level_1" class="form-control">';
                    echo '          <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $kode= $data['kode'];
                        $teks= $data['teks'];
                        echo '<option value="'.$kode.'">'.$teks.'</option>';
                    }
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="level_2">Sub Indikator</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-12">';
                    echo '      <select name="level_2" id="level_2" class="form-control">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="teks">Kriteria</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-12">';
                    echo '      <input type="text" name="teks" id="teks" class="form-control">';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="bobot">Bobot (%)</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-12">';
                    echo '      <input type="text" name="bobot" id="bobot" class="form-control">';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    if($level=="Level 4"){
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="level_1">Indikator</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12">';
                        echo '      <select name="level_1" id="level_1" class="form-control">';
                        echo '          <option value="">Pilih</option>';
                        $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $kode= $data['kode'];
                            $teks= $data['teks'];
                            echo '<option value="'.$kode.'">'.$teks.'</option>';
                        }
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="level_2">Sub Indikator</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12">';
                        echo '      <select name="level_2" id="level_2" class="form-control">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="level_3">Kriteria</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12">';
                        echo '      <select name="level_3" id="level_3" class="form-control">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="teks">Pernyataan</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12">';
                        echo '      <input type="text" name="teks" id="teks" class="form-control">';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="keterangan">Keterangan</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12">';
                        echo '      <textarea class="form-control" name="keterangan"></textarea>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-12">';
                        echo '      <label for="alternatif_jawaban">Alternatif Jawaban</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-12" id="FormContainer1">';
                        echo '      <div class="input-group mb-3">';
                        echo '          <input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif">';
                        echo '          <input type="text" name="alt_label[]" class="form-control" placeholder="Label">';
                        echo '          <input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor">';
                        echo '          <button type="button" class="btn btn-sm btn-success" id="add_form1"><i class="bi bi-plus"></i></button>';
                        echo '      </div>';
                        echo '  </div>';
                        echo '</div>';
                    }else{
                        
                    }
                }
            }
        }
    }
?>
<script>
    //Kondisi Ketika Level Diubah
    $('#level_1').change(function(){
        var level_1 = $('#level_1').val();
        $('#level_2').html('<option>Loading...</option>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/KriteriaIndikator/ListLevel_2.php',
            data        :   {level_1: level_1},
            success     : function(data){
                $('#level_2').html(data);
            }
        });
    });
    $('#level_2').change(function(){
        var level_2 = $('#level_2').val();
        $('#level_3').html('<option>Loading...</option>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/KriteriaIndikator/ListLevel_3.php',
            data        :   {level_2: level_2},
            success     : function(data){
                $('#level_3').html(data);
            }
        });
    });
    $("#add_form1").click(function() {
        $("#FormContainer1").append('<div class="input-group mb-3"><input type="text" name="alt_char[]" class="form-control" placeholder="Alternatif"><input type="text" name="alt_label[]" class="form-control" placeholder="Label"><input type="text" name="alt_nilai[]" class="form-control" placeholder="Skor"><button type="button" class="btn btn-sm btn-danger remove1"><i class="bi bi-x"></i></button></div>');
    });
    $(document).on("click", ".remove1", function() {
        $(this).parent().remove();
    });
</script>