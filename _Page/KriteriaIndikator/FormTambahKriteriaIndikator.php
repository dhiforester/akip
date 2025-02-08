<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
?>
<div class="row mb-3">
    <div class="col-md-12">
        <label for="kode">Kode Kriteria</label>
    </div>
    <div class="col-md-12">
        <input type="text" name="kode" class="form-control">
        <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <label for="level">Level</label>
    </div>
    <div class="col-md-12">
        <select name="level" id="level" class="form-control">
            <option value="">Pilih</option>
            <option value="Level 1">Indikator</option>
            <option value="Level 2">Sub Indikator</option>
            <option value="Level 3">Kriteria</option>
            <option value="Level 4">Pernyataan</option>
        </select>
    </div>
</div>
<div id="FormLanjutanKriteriaIndikator"></div>
<script>
    //Kondisi Ketika Level Diubah
    $('#level').change(function(){
        var level = $('#level').val();
        $('#FormLanjutanKriteriaIndikator').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/KriteriaIndikator/FormLanjutanKriteriaIndikator.php',
            data        :   {level: level},
            success     : function(data){
                $('#FormLanjutanKriteriaIndikator').html(data);
            }
        });
    });
</script>